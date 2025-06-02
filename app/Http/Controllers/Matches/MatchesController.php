<?php

namespace App\Http\Controllers\Matches;

use App\Http\Controllers\Controller;
use App\Models\Matches;
use App\Models\PastMatch;
use Illuminate\Http\Request;

class MatchesController extends Controller
{
    public function index()
    {
        return view('matches.create');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'home_team' => 'required',
            'away_team' => 'required',
            'match_date' => 'required',
            'stadium' => 'required',
        ]);

        Matches::create($data);
        return redirect()->route('matches.show')->with('success', 'Match Added Successfully');
    }

    public function show()
    {
        $matches = Matches::all();
        return view('matches.show', compact('matches'));
    }

    public function edit($id)
    {
        $matches = Matches::findOrFail($id);
        return view('matches.edit', compact('matches'));
    }

    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'home_team' => 'required',
            'away_team' => 'required',
            'match_date' => 'required',
            'stadium' => 'required',
        ]);

        $match = Matches::findOrFail($id);
        $match->update($data);

        return redirect()->route('matches.show')->with('success', 'Match Updated Successfully');
    }

    public function delete($id)
    {
        $match = Matches::findOrFail($id);
        $match->delete();

        return redirect()->route('matches.show')->with('success', 'Match Deleted Successfully');
    }

    public function clear()
    {
        PastMatch::truncate();
        return redirect()->route('matches.show')->with('success', 'All Matches Deleted Successfully');
    }

    public function past()
    {
        $matches = PastMatch::all();
        return view('matches.pastmatches', compact('matches'));
    }

    public function savePastMatch(Request $request)
    {
        $data = $request->validate([
            'home_team' => 'required',
            'away_team' => 'required',
            'match_date' => 'required',
            'stadium' => 'required',
            'result' => 'required',
        ]);

        PastMatch::create($data);
        return redirect()->route('matches.show')->with('success', 'Match Added Successfully');
    }

    public function Pastmatches(){
        $matches = PastMatch::all();
        return view('customer.pastmatches', compact('matches'));
    }
}
