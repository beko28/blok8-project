<?php

namespace App\Http\Controllers;

use App\Models\Speler;
use Illuminate\Http\Request;

class SpelerController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        // Haal alle spelers op en stuur ze naar de view
        $spelers = Speler::all();
        return view('spelers.index', compact('spelers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Toon het formulier voor het toevoegen van een nieuwe speler
        return view('spelers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validatie van het formulier
        $request->validate([
            'naam' => 'required|string|max:255',
            'achternaam' => 'required|string|max:255',
            'positie' => 'required|string|max:50',
            'rugnummer' => 'nullable|integer|min:0',
            'leeftijd' => 'required|integer|min:0',
            'email' => 'required|string|email|max:255|unique:spelers'
        ]);

        // Nieuwe speler aanmaken
        Speler::create($request->all());

        // Redirect terug naar de indexpagina met een succesbericht
        return redirect()->route('spelers.index')->with('success', 'Speler succesvol toegevoegd.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Speler $speler)
    {
        // Toon het formulier om een speler te bewerken
        return view('spelers.edit', compact('speler'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Speler $speler)
    {
        // Validatie van het formulier
        $request->validate([
            'naam' => 'required|string|max:255',
            'positie' => 'required|string|max:50',
            'rugnummer' => 'nullable|integer|min:0',
            'leeftijd' => 'required|integer|min:0',
        ]);

        // Speler bijwerken
        $speler->update($request->all());

        // Redirect terug naar de indexpagina met een succesbericht
        return redirect()->route('spelers.index')->with('success', 'Speler succesvol bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Speler $speler)
    {
        // Speler verwijderen
        $speler->delete();

        // Redirect terug naar de indexpagina met een succesbericht
        return redirect()->route('spelers.index')->with('success', 'Speler succesvol verwijderd.');
    }
}
