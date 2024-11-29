<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Aanvraag extends Model
{
    protected $table = 'aanvragen'; // Verbind het model met de juiste tabel

    protected $fillable = [
        'speler_id',
        'team_id',
    ];

    // Relatie met speler
    public function speler()
    {
        return $this->belongsTo(Speler::class);
    }

    // Relatie met team
    public function team()
    {
        return $this->belongsTo(Team::class);
    }
}
