<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poule; // Correcte import van het model
use App\Models\Team; // Correcte import van het model

class PouleController extends Controller
{
    public function index()
    {
        $poules = Poule::with('deelnemers')->get();
        return view('poules.index', compact('poules'));
    }

    public function create()
    {
        return view('poules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
        ]);

        Poule::create([
            'naam' => $request->naam,
        ]);

        return redirect()->route('poules.index')->with('success', 'Poule toegevoegd!');
    }

    public function edit(Poule $poule)
    {
        return view('poules.edit', compact('poule'));
    }

    public function update(Request $request, Poule $poule)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
        ]);

        $poule->update($request->only('naam'));

        return redirect()->route('poules.index')->with('success', 'Poule bijgewerkt!');
    }

    public function destroy(Poule $poule)
    {
        $poule->delete();
        return redirect()->route('poules.index')->with('success', 'Poule verwijderd!');
    }

    public function assignTeamsToPoules()
{
    $teams = Team::whereNull('poule_id')->get();

    if ($teams->isEmpty()) {
        return redirect()->route('poules.index')->with('error', 'Geen teams beschikbaar om toe te wijzen.');
    }

    foreach ($teams as $team) {
        $poule = Poule::withCount('teams')->where('teams_count', '<', 12)->first();

        if (!$poule) {
            $poule = Poule::create([
                'naam' => 'Poule ' . (Poule::count() + 1),
            ]);
        }

        $team->update(['poule_id' => $poule->id]);
    }

    return redirect()->route('poules.index')->with('success', 'Teams succesvol toegewezen aan poules.');
}

public function show(Poule $poule)
{
    return view('poules.show', compact('poule'));
}


}
