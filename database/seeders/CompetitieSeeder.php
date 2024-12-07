<?php

use Illuminate\Database\Seeder;
use App\Models\Competitie;

class CompetitieSeeder extends Seeder
{
    public function run()
    {
        Competitie::create(['naam' => 'Beker Competitie', 'type' => 'beker']);
        Competitie::create(['naam' => 'League', 'type' => 'league']);
    }
}
