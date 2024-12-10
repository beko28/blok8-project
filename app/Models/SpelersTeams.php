<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SpelersTeams extends Model
{
    use HasFactory;

    protected $table = 'spelers_teams';

    protected $fillable = [
        'speler_id',
        'team_id',
        'status',
    ];

    public function speler()
    {
        return $this->belongsTo(Speler::class, 'speler_id');
    }

    public function team()
    {
        return $this->belongsTo(Team::class, 'team_id');
    }

}
