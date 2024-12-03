<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Speler;
use App\Models\SpelersTeams;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    public function index()
    {
        $teams = Team::with('eigenaar')->get();
        return view('teams.index', compact('teams'));
    }

    public function show($id)
{
    $team = Team::with('spelers', 'eigenaar')->findOrFail($id);
    return view('teams.show', compact('team'));
}

public function aanmelden(Request $request, $teamId)
{
    $existing = Speler::where('speler_id', $request->speler_id)
        ->where('team_id', $teamId)
        ->first();

    SpelersTeams::create([
        'speler_id' => $request->speler_id,
        'team_id' => $teamId,
        'status' => 'aangevraagd',
    ]);
    
    return redirect()->back()->with('success', 'Aanmelding verzonden!');
}

    public function accepteren(Request $request, $teamId)
    {
        $spelerTeam = SpelersTeams::where('team_id', $teamId)
            ->where('speler_id', $request->speler_id)
            ->first();

        $spelerTeam->update(['status' => 'geaccepteerd']);
        return redirect()->back()->with('success', 'Speler is geaccepteerd in het team!');
    }

    public function weigeren(Request $request, $teamId)
    {
        $spelerTeam = SpelersTeams::where('team_id', $teamId)
            ->where('speler_id', $request->speler_id)
            ->first();

        $spelerTeam->update(['status' => 'geweigerd']);
        return redirect()->back()->with('success', 'Aanmelding is geweigerd.');
    }

    public function uitnodigen(Request $request, $teamId)
    {
        $existing = SpelersTeams::where('speler_id', $request->speler_id)
            ->where('team_id', $teamId)
            ->first();

        SpelersTeams::create([
            'speler_id' => $request->speler_id,
            'team_id' => $teamId,
            'status' => 'uitgenodigd',
        ]);

        return redirect()->back()->with('success', 'Uitnodiging verstuurd!');
    }
}
