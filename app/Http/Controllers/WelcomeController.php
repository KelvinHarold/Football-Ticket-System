<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TicketClass;

class WelcomeController extends Controller
{
 public function index()
    {
        $tickets = TicketClass::with('price')->get();
        return view('welcome', compact('tickets'));
    }
}
