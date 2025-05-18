<?php

namespace App\Http\Controllers\Matches;

use App\Http\Controllers\Controller;
use App\Models\Matches;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    public function index(){
        return view('matches.create');
    }

    public function store(Request $request){
        $matches = $request->validate([
            'home_team' => 'required',
            'away_team' => 'required',
            'match_date' => 'required',
            'stadium' => 'required',
        ]);

        Matches::create($matches);
        return redirect()->route('matches.create')->with('success', 'Matches Updated Successfully');
    }


    public function show(){
        $matches = Matches::all();
        return view('matches.show', compact('matches'));
    }


    public function edit($id){
        $matches = Matches::findorFail($id);
        return view('matches.edit', compact('matches'));
    }

     public function update(Request $request, $id){
       $matches = $request->validate([
         'home_team' => 'required',
            'away_team' => 'required',
            'match_date' => 'required',
            'stadium' => 'required',
       ]);

       $matches= Matches::findorFail($id);
       $matches->update();

       return redirect()->route('matches.show')->with('success', 'Match Updated Successfully');

    }

      public function delete($id){
        $matches = Matches::findorFail($id);
        return view('matches.show', compact('matches'))->with('success', 'Match Updated Successfully');
    }
}
