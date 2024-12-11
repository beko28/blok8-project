<?php

namespace App\Http\Controllers;

use App\Models\Speler;
use Illuminate\Http\Request;

class SpelerController extends Controller
{
    public function index(Request $request)
    {
        $spelers = Speler::with(['acceptedTeams'])->get();

        $query = Speler::query();

        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->where(function($q) use ($search) {
                $q->where('voornaam', 'like', '%'.$search.'%')
                  ->orWhere('achternaam', 'like', '%'.$search.'%')
                  ->orWhere('email', 'like', '%'.$search.'%');
            });
        }
    
        $spelers = $query->get();
    
        return view('spelers.index', compact('spelers'));
    
    }
    

    public function create()
    {
        return view('spelers.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'voornaam' => 'required|string|max:255',
            'achternaam' => 'required|string|max:255',
            'positie' => 'required|string|max:50',
            'rugnummer' => 'nullable|integer|min:0',
            'leeftijd' => 'required|integer|min:0',
            'email' => 'required|string|email|max:255|unique:spelers',
            'password' => 'required|string|min:8|confirmed',
        ]);

        Speler::create($request->all());

        return redirect()->route('spelers.index')->with('success', 'Speler succesvol toegevoegd.');
    }

    public function edit(Speler $speler)
    {
        return view('spelers.edit', compact('speler'));
    }

    public function update(Request $request, Speler $speler)
    {
        $request->validate([
            'voornaam' => 'required|string|max:255',
            'achternaam' => 'required|string|max:255',
            'positie' => 'required|string|max:50',
            'rugnummer' => 'nullable|integer|min:0',
            'leeftijd' => 'required|integer|min:0',
        ]);

        $speler->update($request->all());

        return redirect()->route('spelers.index')->with('success', 'Speler succesvol bijgewerkt.');
    }

    public function destroy(Speler $speler)
    {
        $speler->delete();

        return redirect()->route('spelers.index')->with('success', 'Speler succesvol verwijderd.');
    }

    public function show($id)
    {

        $speler = Speler::with('acceptedTeams', 'teamEigenaar')->findOrFail($id);
        return view('spelers.show', compact('speler'));
        
    }

}
