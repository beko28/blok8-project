<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SpelersTeams;
use App\Models\Speler;
use App\Models\Team;
use App\Models\Poule;

class TeamManagerController extends Controller
{
    // Team Manager Index: Overzicht van teamleden, aanvragen en poule-uitnodigingen
    public function index(Request $request)
    {
        $speler = auth()->user();

        // Controleer of de gebruiker een eigenaar is
        if ($speler->role !== 'eigenaar' || !$speler->teamEigenaar) {
            return redirect()->back()->withErrors('Je bent geen eigenaar van een team.');
        }

        $team = $speler->teamEigenaar;

        // Haal teamleden op (geaccepteerde spelers)
        $teamleden = $team->spelers()->wherePivot('status', 'geaccepteerd')->get();

        // Haal aanvragen op (status aangevraagd)
        $aanvragen = $team->spelers()->wherePivot('status', 'aangevraagd')->get();

        // Haal poule-uitnodigingen op
        $uitnodigingen = \DB::table('team_uitnodigingen')
            ->join('poules', 'team_uitnodigingen.poule_id', '=', 'poules.id')
            ->where('team_uitnodigingen.team_id', $team->id)
            ->select('team_uitnodigingen.id', 'poules.naam as poule_naam', 'team_uitnodigingen.status')
            ->get();

        return view('teammanager.index', compact('team', 'teamleden', 'aanvragen', 'uitnodigingen'));
    }

    // Accepteer aanvraag van speler
    public function accepteren($pivotId)
    {
        $speler = auth()->user();
        $aanvraag = SpelersTeams::findOrFail($pivotId);

        if ($aanvraag->team->eigenaar_id !== $speler->id) {
            return redirect()->back()->withErrors('Je bent niet de eigenaar van dit team.');
        }

        $aanvraag->update(['status' => 'geaccepteerd']);
        return redirect()->back()->with('success', 'Speler geaccepteerd in het team!');
    }

    // Weiger aanvraag van speler
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

    // Speler uitnodigen voor het team
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

        $existing = SpelersTeams::where('speler_id', $teUitnodigen->id)
            ->where('team_id', $team->id)
            ->exists();

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

    // Update teamgegevens
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
