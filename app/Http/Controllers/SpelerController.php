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
        $spelers = Speler::all();
        return view('spelers.index', compact('spelers'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('spelers.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'achternaam' => 'required|string|max:255',
            'positie' => 'required|string|max:50',
            'rugnummer' => 'nullable|integer|min:0',
            'leeftijd' => 'required|integer|min:0',
            'email' => 'required|string|email|max:255|unique:spelers'
        ]);

        Speler::create($request->all());

        return redirect()->route('spelers.index')->with('success', 'Speler succesvol toegevoegd.');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Speler $speler)
    {
        return view('spelers.edit', compact('speler'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Speler $speler)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'positie' => 'required|string|max:50',
            'rugnummer' => 'nullable|integer|min:0',
            'leeftijd' => 'required|integer|min:0',
        ]);

        $speler->update($request->all());

        return redirect()->route('spelers.index')->with('success', 'Speler succesvol bijgewerkt.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Speler $speler)
    {
        $speler->delete();

        return redirect()->route('spelers.index')->with('success', 'Speler succesvol verwijderd.');
    }
}
