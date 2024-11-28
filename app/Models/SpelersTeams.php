<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpelersTeams extends Model
{
    use HasFactory;

    // Geef de tabelnaam expliciet op als deze niet standaard is
    protected $table = 'spelers_teams';

    // Velden die mogen worden ingevuld
    protected $fillable = [
        'speler_id',
        'team_id',
        'status',
    ];

    // Relatie met Speler
    public function speler()
    {
        return $this->belongsTo(Speler::class, 'speler_id');
    }

    // Relatie met Team
    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }
}
