<?php

namespace App\Http\Controllers;

use App\Models\Team;
use App\Models\Speler;
use App\Models\SpelersTeams;
use Illuminate\Http\Request;

class TeamController extends Controller
{
    // Laat alle teams zien
    public function index()
    {
        $teams = Team::with('eigenaar')->get(); // Haal teams en hun eigenaren op
        return view('teams.index', compact('teams'));
    }

    // Meld een speler aan bij een team
    public function aanmelden(Request $request, $teamId)
    {
        // Controleer of de speler al een record heeft
        $existing = SpelersTeams::where('speler_id', $request->speler_id)
            ->where('team_id', $teamId)
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Je hebt je al aangemeld voor dit team.');
        }

        // Maak een nieuwe aanmelding aan
        SpelersTeams::create([
            'speler_id' => $request->speler_id,
            'team_id' => $teamId,
            'status' => 'aangevraagd',
        ]);

        return redirect()->back()->with('success', 'Aanmelding verzonden!');
    }

    // Accepteer een aanmelding of uitnodiging
    public function accepteren(Request $request, $teamId)
    {
        $spelerTeam = SpelersTeams::where('team_id', $teamId)
            ->where('speler_id', $request->speler_id)
            ->first();

        if (!$spelerTeam) {
            return redirect()->back()->with('error', 'Aanmelding niet gevonden.');
        }

        $spelerTeam->update(['status' => 'geaccepteerd']);
        return redirect()->back()->with('success', 'Speler is geaccepteerd in het team!');
    }

    // Weiger een aanmelding of uitnodiging
    public function weigeren(Request $request, $teamId)
    {
        $spelerTeam = SpelersTeams::where('team_id', $teamId)
            ->where('speler_id', $request->speler_id)
            ->first();

        if (!$spelerTeam) {
            return redirect()->back()->with('error', 'Aanmelding niet gevonden.');
        }

        $spelerTeam->update(['status' => 'geweigerd']);
        return redirect()->back()->with('success', 'Aanmelding is geweigerd.');
    }

    // Nodig een speler uit voor een team
    public function uitnodigen(Request $request, $teamId)
    {
        $existing = SpelersTeams::where('speler_id', $request->speler_id)
            ->where('team_id', $teamId)
            ->first();

        if ($existing) {
            return redirect()->back()->with('error', 'Deze speler is al uitgenodigd of heeft zich al aangemeld.');
        }

        SpelersTeams::create([
            'speler_id' => $request->speler_id,
            'team_id' => $teamId,
            'status' => 'uitgenodigd',
        ]);

        return redirect()->back()->with('success', 'Uitnodiging verstuurd!');
    }
}
