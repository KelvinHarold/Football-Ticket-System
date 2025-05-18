<?php

namespace App\Http\Controllers\Customer;

use App\Http\Controllers\Controller;
use App\Models\Matches;
use Illuminate\Http\Request;

class CustomerMatchesController extends Controller
{
    public function matchindex(){
        $matches = Matches::all();
        return view('matches.customermatches', compact('matches'));
    }
}
