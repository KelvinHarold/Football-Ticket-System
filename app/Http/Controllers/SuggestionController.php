<?php

namespace App\Http\Controllers;

use App\Models\Suggestion;
use Illuminate\Container\Attributes\Auth;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth as FacadesAuth;

use function Laravel\Prompts\suggest;

class SuggestionController extends Controller
{
    public function suggestion()
    {
        return view('suggestions.index');
    }


    public function post(Request $request)
    {
        $validated = $request->validate([
            'content' => 'required|string|max:10000',
        ]);

        Suggestion::create([
            'user_id' => FacadesAuth::id(),
            'content' => $validated['content'],
        ]);


        return redirect()->back()->with('uploaded', 'Matches Uploaded Successfully');
    }

    public function adminsuggestions()
    {
        $suggestions = Suggestion::with('user')->latest()->get(); // eager load users
        return view('suggestions.admin', compact('suggestions'));
    }

    public function adminsuggestionsdelete($id){
        $suggestions = Suggestion::findOrFail($id);
        $suggestions->delete();
        return redirect()->back()->with('deleted', 'Suggestion Deleted Successfully');
    }
}
