<?php

namespace App\Http\Controllers;

use App\Models\BookingHistory;
use App\Models\Ticket;
use App\Models\TicketClass;
use Illuminate\Http\Request;
use App\Models\Transaction;
use App\Models\TicketPrice;
use Illuminate\Support\Str;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class TransactionController extends Controller
{
   public function showBookingForm()
{
    $classes = TicketClass::all(); // Get all ticket class options
    return view('customer.tickets.index', compact('classes'));
}

   public function getTicketPrice($class_id)
{
    $price = TicketPrice::where('class_id', $class_id)->value('price');
    return response()->json(['price' => $price]);
}

    public function storeBooking(Request $request)
    {
        $request->validate([
            'ticket_class' => 'required',
            'cost' => 'required|numeric',
            'payment_method' => 'required',
        ]);

        $user = Auth::user(); // Ensure user is logged in

        Transaction::create([
            'user_id' => $user->id,
            'total_amount' => $request->cost,
            'payment_method' => $request->payment_method,
            'payment_status' => 'paid', // can be changed later
        ]);

        return back()->with('booked', 'Ticket booked and saved successfully.');
    }

    public function store(Request $request)
{
    $request->validate([
        'ticket_class' => 'required|exists:ticket_classes,id',
        'payment_method' => 'required',
    ]);

    $user = Auth::user();
    $price = TicketPrice::where('class_id', $request->ticket_class)->value('price');

    $transaction = Transaction::create([
        'user_id' => $user->id,
        'total_amount' => $price,
        'payment_method' => $request->payment_method,
        'payment_status' => 'paid',
    ]);

    $ticket = Ticket::create([
        'user_id' => $user->id,
        'class_id' => $request->ticket_class,
        'ticket_code' => Str::upper(Str::random(8)),
        'transaction_id' => $transaction->id,
        'status' => 'booked',
    ]);

    BookingHistory::create([
    'ticket_id' => $ticket->id,
    'user_id' => $user->id,
    'date_booked' => now(),
    'status' => 'confirmed',
]);

    $pdf = Pdf::loadView('customer.tickets.pdf', [
        'user' => $user,
        'ticket' => $ticket,
        'class' => $ticket->ticketClass->name,
        'price' => $price,
        'transaction' => $transaction,
    ]);

    return $pdf->download('customer.tickets.pdf');
}

public function bookingHistory()
{
    $user = Auth::user();

    $histories = BookingHistory::with(['ticket', 'user'])
        ->where('user_id', $user->id)
        ->latest()
        ->get();

    return view('booking.history', compact('histories'));
}

public function deleteHistory($id)
{
    BookingHistory::destroy($id);
    return back()->with('deleted', 'Booking history deleted.');
}

public function admintransactions()
{
    $transactions = Transaction::with('user')->latest()->paginate(5); // paginate by 5
    return view('admin.transactions.index', compact('transactions'));
}


public function destroy($id)
{
    Transaction::destroy($id);
    return redirect()->route('admin.transactions')->with('delete', 'Transaction deleted successfully.');
}
public function salesReport()
{
    // Prices by class (assuming class_id 1 = VIP, 2 = General)
    $vipPrice = DB::table('ticket_prices')->where('class_id', 1)->value('price');
    $generalPrice = DB::table('ticket_prices')->where('class_id', 2)->value('price');

    // Count tickets
    $vipTicketsCount = Ticket::where('class_id', 1)->count();
    $generalTicketsCount = Ticket::where('class_id', 2)->count();

    // Revenue calculations
    $vipRevenue = $vipTicketsCount * $vipPrice;
    $generalRevenue = $generalTicketsCount * $generalPrice;
    $totalRevenue = $vipRevenue + $generalRevenue;

    // Calculate percentages
    $vipPercentage = $totalRevenue > 0 ? round(($vipRevenue / $totalRevenue) * 100) : 0;
    $generalPercentage = $totalRevenue > 0 ? round(($generalRevenue / $totalRevenue) * 100) : 0;

    // Get daily profits for the last 1 days
    $dailyProfits = Ticket::selectRaw('DATE(created_at) as date,
        SUM(CASE WHEN class_id = 1 THEN 1 ELSE 0 END) as vip_count,
        SUM(CASE WHEN class_id = 2 THEN 1 ELSE 0 END) as general_count'
    )
    ->where('created_at', '>=', now()->subDays(1))
    ->groupByRaw('DATE(created_at)')
    ->orderBy('date')
    ->get()
    ->map(function ($item) use ($vipPrice, $generalPrice) {
        return [
            'date' => $item->date,
            'vip_amount' => $item->vip_count * $vipPrice,
            'general_amount' => $item->general_count * $generalPrice,
        ];
    });

    // Calculate growth percentage (basic)
    $previousVip = Ticket::where('class_id', 1)
        ->whereBetween('created_at', [now()->subDays(60), now()->subDays(30)])
        ->count();
    $previousGeneral = Ticket::where('class_id', 2)
        ->whereBetween('created_at', [now()->subDays(60), now()->subDays(30)])
        ->count();
    $previousRevenue = ($previousVip * $vipPrice) + ($previousGeneral * $generalPrice);

    $growthPercentage = $previousRevenue > 0
        ? round((($totalRevenue - $previousRevenue) / $previousRevenue) * 100)
        : 100;

    // Get recent transactions
    $recentTransactions = Transaction::with(['tickets.ticketClass', 'user'])
        ->latest()
        ->take(1)
        ->get();

    return view('admin.report.index', compact(
        'totalRevenue',
        'vipRevenue',
        'generalRevenue',
        'vipTicketsCount',
        'generalTicketsCount',
        'vipPercentage',
        'generalPercentage',
        'growthPercentage',
        'dailyProfits',
        'recentTransactions'
    ));
}


public function downloadSalesReport()
{
    // Fetch or calculate all data as you already do in salesReport()
    $vipPrice = DB::table('ticket_prices')->where('class_id', 1)->value('price');
    $generalPrice = DB::table('ticket_prices')->where('class_id', 2)->value('price');

    $vipTicketsCount = Ticket::where('class_id', 1)->count();
    $generalTicketsCount = Ticket::where('class_id', 2)->count();

    $vipRevenue = $vipTicketsCount * $vipPrice;
    $generalRevenue = $generalTicketsCount * $generalPrice;
    $totalRevenue = $vipRevenue + $generalRevenue;

    // Get today's date
    $today = now()->toDateString();

    // Get daily profits only for today
    $dailyProfits = Ticket::selectRaw('DATE(created_at) as date,
        SUM(CASE WHEN class_id = 1 THEN 1 ELSE 0 END) as vip_count,
        SUM(CASE WHEN class_id = 2 THEN 1 ELSE 0 END) as general_count'
    )
    ->whereDate('created_at', $today)
    ->groupByRaw('DATE(created_at)')
    ->orderBy('date')
    ->get()
    ->map(function ($item) use ($vipPrice, $generalPrice) {
        return [
            'date' => $item->date,
            'vip_amount' => $item->vip_count * $vipPrice,
            'general_amount' => $item->general_count * $generalPrice,
        ];
    });

    // Load the PDF view with data
    $pdf = PDF::loadView('admin.sales_report_pdf', compact(
        'vipTicketsCount',
        'generalTicketsCount',
        'vipRevenue',
        'generalRevenue',
        'totalRevenue',
        'dailyProfits'
    ));

    // Return the PDF download response
    return $pdf->download('ticket-sales-report.pdf');
}
public function clearAll()
{
    Transaction::truncate(); // deletes all records quickly
    return redirect()->route('admin.transactions')->with('deleted', 'All transactions have been deleted successfully.');
}

}

