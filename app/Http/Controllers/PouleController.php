<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poule;
use App\Models\Team;
use App\Models\Competitie;

class PouleController extends Controller
{

    public function create()
    {
        return view('poules.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'naam' => 'required|string|max:255',
            'max_teams' => 'required|integer|min:1|max:50',
            'competitie_id' => 'required|integer|exists:competities,id',
        ]);
    
        Poule::create([
            'naam' => $request->naam,
            'competitie_id' => $request->input('competitie_id'),
            'max_teams' => $request->max_teams,
        ]);
    
        return redirect()->route('poules.index')->with('success', 'Nieuwe poule succesvol aangemaakt!');
    }

    public function voegTeamToe(Request $request, Poule $poule)
    {
        $request->validate([
            'team_id' => 'required|exists:teams,id',
        ]);
    
        $team = Team::findOrFail($request->team_id);
    
        $team->poule_id = $poule->id;
        $team->save();
    
        return redirect()->route('poules.index', $poule->id)->with('success', 'Team succesvol toegevoegd aan de poule.');
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
    $beschikbareTeams = Team::whereNull('poule_id')->get();

    return view('poules.show', compact('poule', 'beschikbareTeams'));
}


public function verwijderTeam(Poule $poule, Team $team)
{
    if ($team->poule_id !== $poule->id) {
        return redirect()->back()->with('error', 'Team hoort niet bij deze poule.');
    }
    

    $team->update(['poule_id' => null]);

    return redirect()->route('poules.index', $poule->id)->with('success', 'Team succesvol verwijderd uit de poule.');
}


public function index()
{
    $competities = Competitie::with(['poules.teams.eigenaar' => function ($query) {
        $query->select('id', 'naam');
    }])->get();

    $beschikbareTeams = Team::whereNull('poule_id')->get();
    $alleTeams = Team::all();

    return view('poules.index', compact('competities', 'beschikbareTeams', 'alleTeams'));
}

}
