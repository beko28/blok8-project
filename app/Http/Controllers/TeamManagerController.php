<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpelersTeams;
use App\Models\Speler;

class TeamManagerController extends Controller
{
    public function index(Request $request)
{
    $speler = auth()->user();

    // Controleer of deze speler een eigenaar is en een team heeft.
    if ($speler->role !== 'eigenaar' || !$speler->teamEigenaar) {
        return redirect()->back()->withErrors('Je bent geen eigenaar van een team.');
    }

    $team = $speler->teamEigenaar;

    // Haal spelers op die geaccepteerd zijn
    $teamleden = $team->spelers()->wherePivot('status', 'geaccepteerd')->get();

    // Haal aanvragen op
    $aanvragen = $team->spelers()->wherePivot('status', 'aangevraagd')->get();

    // Haal uitnodigingen op (optioneel)
    $uitnodigingen = $team->spelers()->wherePivot('status', 'uitgenodigd')->get();

    return view('teammanager.index', compact('team', 'teamleden', 'aanvragen', 'uitnodigingen'));
}
public function accepteren($pivotId)
{
    $speler = auth()->user();
    $aanvraag = SpelersTeams::findOrFail($pivotId);

    // Controleer of deze speler de eigenaar is van het team in deze pivot
    if ($aanvraag->team->eigenaar_id !== $speler->id) {
        return redirect()->back()->withErrors('Je bent niet de eigenaar van dit team.');
    }

    $aanvraag->update(['status' => 'geaccepteerd']);
    return redirect()->back()->with('success', 'Speler geaccepteerd in het team!');
}

public function weigeren($pivotId)
{
    $speler = auth()->user();
    $aanvraag = SpelersTeams::findOrFail($pivotId);

    if ($aanvraag->team->eigenaar_id !== $speler->id) {
        return redirect()->back()->withErrors('Je bent niet de eigenaar van dit team.');
    }

    $aanvraag->update(['status' => 'geweigerd']);
    return redirect()->back()->with('success', 'Aanvraag geweigerd.');
}
public function uitnodigen(Request $request)
{
    $request->validate([
        'email' => 'required|email'
    ]);

    $speler = auth()->user();
    $team = $speler->teamEigenaar;

    $teUitnodigen = Speler::where('email', $request->email)->first();
    if (!$teUitnodigen) {
        return redirect()->back()->withErrors('Speler met dit emailadres bestaat niet.');
    }

    // Check of niet al een relatie bestaat
    $existing = SpelersTeams::where('speler_id', $teUitnodigen->id)
                            ->where('team_id', $team->id)
                            ->first();
    if ($existing) {
        return redirect()->back()->withErrors('Deze speler is al verbonden met het team.');
    }

    SpelersTeams::create([
        'speler_id' => $teUitnodigen->id,
        'team_id' => $team->id,
        'status' => 'uitgenodigd',
    ]);

    return redirect()->back()->with('success', 'Uitnodiging verstuurd!');
}
public function updateTeam(Request $request)
{
    $request->validate([
        'naam' => 'required|string|max:255',
        'adres' => 'required|string|max:255'
    ]);

    $speler = auth()->user();
    $team = $speler->teamEigenaar;

    $team->update([
        'naam' => $request->naam,
        'adres' => $request->adres,
    ]);

    return redirect()->back()->with('success', 'Teamgegevens bijgewerkt!');
}

}
