<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Transaction;
use App\Models\Ticket;
use App\Models\TicketClass;

class IndexController extends Controller
{
    public function index()
    {
        $transactionsCount = Transaction::count();
        $usersCount = User::count();

        $vipClassId = TicketClass::where('name', 'VIP')->value('id');
        $generalClassId = TicketClass::where('name', 'General')->value('id');

        $vipTicketsCount = Ticket::where('class_id', $vipClassId)->count();
        $generalTicketsCount = Ticket::where('class_id', $generalClassId)->count();

        return view('admin.index', compact(
            'transactionsCount',
            'usersCount',
            'vipTicketsCount',
            'generalTicketsCount'
        ));
    }
}
