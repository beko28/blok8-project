<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Poule; // Correcte import van het model
use App\Models\Team; // Correcte import van het model
use App\Models\Competitie; // Correcte import van het model

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

    public function uitnodigen(Request $request, $team_id)
    {
        $request->validate([
            'poule_id' => 'required|exists:poules,id',
        ]);
    
        $poule = Poule::findOrFail($request->poule_id);
        $team = Team::findOrFail($team_id);
    
        if (auth()->user()->id !== $poule->eigenaar_id) {
            return redirect()->back()->with('error', 'Je hebt geen rechten om teams uit te nodigen.');
        }
    
        $existingInvitation = DB::table('team_uitnodigingen')
            ->where('poule_id', $poule->id)
            ->where('team_id', $team->id)
            ->exists();
    
        if ($existingInvitation) {
            return redirect()->back()->with('error', 'Dit team is al uitgenodigd voor deze poule.');
        }
    
        DB::table('team_uitnodigingen')->insert([
            'poule_id' => $poule->id,
            'team_id' => $team->id,
            'status' => 'pending',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    
        return redirect()->back()->with('success', 'Team is succesvol uitgenodigd!');
    }

    public function acceptUitnodiging($uitnodigingId)
    {
        DB::table('team_uitnodigingen')
            ->where('id', $uitnodigingId)
            ->update(['status' => 'geaccepteerd']);

        return redirect()->back()->with('success', 'Uitnodiging geaccepteerd!');
    }

    public function weigerUitnodiging($uitnodigingId)
    {
        DB::table('team_uitnodigingen')
            ->where('id', $uitnodigingId)
            ->update(['status' => 'geweigerd']);

        return redirect()->back()->with('success', 'Uitnodiging geweigerd.');
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

public function index()
{
    $competities = Competitie::with(['poules.teams.eigenaar' => function ($query) {
        $query->select('id', 'naam');
    }])->get();

    return view('poules.index', compact('competities'));
}

}
