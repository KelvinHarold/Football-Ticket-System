<?php

namespace App\Http\Controllers;

use App\Models\TicketClass;
use App\Models\TicketPrice;
use Illuminate\Http\Request;

class TicketViewController extends Controller
{
    public function index()
{
    $ticketPrices = TicketPrice::with('ticketClass')->get();
    $ticketClasses = TicketClass::all();

    return view('admin.tickets.index', compact('ticketPrices', 'ticketClasses'));
}


    public function create()
    {
        $ticketClasses = TicketClass::all(); // fetch all existing classes (VIP, General)
        return view('admin.tickets.create', compact('ticketClasses'));
    }

   public function store(Request $request)
{
    $request->validate([
        'class_id' => 'required|exists:ticket_classes,id',
        'price' => 'required|numeric|min:0',
    ]);

    // Check if price already exists for the class
    $existing = TicketPrice::where('class_id', $request->class_id)->first();

    if ($existing) {
        return redirect()->back()->with('error', 'Price already exists for this ticket class. Please edit it instead.');
    }

    TicketPrice::create([
        'class_id' => $request->class_id,
        'price' => $request->price,
    ]);

    return redirect()->back()->with('success', 'Ticket price added successfully.');
}

public function edit($id)
{
    $price = TicketPrice::findOrFail($id);
    $ticketClasses = TicketClass::all();

    return view('admin.tickets.edit', compact('price', 'ticketClasses'));
}

public function update(Request $request, $id)
{
    $request->validate([
        'class_id' => 'required|exists:ticket_classes,id',
        'price' => 'required|numeric|min:0',
    ]);

    $price = TicketPrice::findOrFail($id);

    // Prevent changing to a class that already has a price (except itself)
    $duplicate = TicketPrice::where('class_id', $request->class_id)
                            ->where('id', '!=', $id)
                            ->first();

    if ($duplicate) {
        return redirect()->back()->with('error', 'Another price is already set for this ticket class.');
    }

    $price->update([
        'class_id' => $request->class_id,
        'price' => $request->price,
    ]);

    return redirect()->route('admin.tickets.index')->with('success', 'Ticket price updated.');
}

public function storeClass(Request $request)
{
    $request->validate([
        'name' => 'required|in:General,VIP|unique:ticket_classes,name',
        'description' => 'nullable|string|max:255',
    ]);

    TicketClass::create([
        'name' => $request->name,
        'description' => $request->description,
    ]);

    return back()->with('success', 'Ticket class added successfully.');
}

}