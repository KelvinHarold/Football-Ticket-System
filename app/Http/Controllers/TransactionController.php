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
    $histories = BookingHistory::with(['ticket', 'user'])->get();

    return view('booking.history', compact('histories'));
}

public function deleteHistory($id)
{
    BookingHistory::destroy($id);
    return back()->with('deleted', 'Booking history deleted.');
}


public function admintransactions()
{
    $transactions = Transaction::all();
    return view('admin.transactions.index', compact('transactions'));
}

public function destroy($id)
{
    Transaction::destroy($id);
    return redirect()->route('admin.transactions')->with('success', 'Transaction deleted successfully.');
}
}

