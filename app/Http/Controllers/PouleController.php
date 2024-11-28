<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poule; // Correcte import van het model

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
}
