<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Team;
use App\Models\Competitie;
use App\Models\Poule;

class CompetitieController extends Controller
{
    public function genereerCompetitie()
{
    $bekerCompetitie = Competitie::firstOrCreate(['naam' => 'Beker Competitie', 'type' => 'beker']);
    $leagueCompetitie = Competitie::firstOrCreate(['naam' => 'League', 'type' => 'league']);

    $this->genereerPoules($bekerCompetitie, 12);
    $this->genereerPoules($leagueCompetitie, 24);
}

private function genereerPoules($competitie, $maxTeamsPerPoule)
{
    $teams = Team::all();
    $pouleNummer = 1;

    foreach ($teams->chunk($maxTeamsPerPoule) as $chunk) {
        $poule = Poule::create([
            'naam' => "Poule $pouleNummer",
            'competitie_id' => $competitie->id,
        ]);

        foreach ($chunk as $team) {
            $poule->teams()->attach($team->id);
        }

        $pouleNummer++;
    }
}

}
