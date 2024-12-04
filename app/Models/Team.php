<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'naam',
        'adres',
        'max_spelers',
        'eigenaar_id',
    ];

    public function eigenaar()
    {
        return $this->belongsTo(Speler::class, 'eigenaar_id');
    }

    public function spelers()
    {
        return $this->belongsToMany(Speler::class, 'spelers_teams')
            ->withPivot('status')
            ->withTimestamps();
    }

    public function poule()
    {
        return $this->belongsTo(Poule::class);
    }

    // Automatische toewijzing aan een poule
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($team) {
            // Zoek een beschikbare poule met minder dan 12 teams
            $poule = Poule::withCount('teams')->where('teams_count', '<', 12)->first();

            if (!$poule) {
                // Maak een nieuwe poule aan als er geen beschikbare poule is
                $poule = Poule::create([
                    'naam' => 'Poule ' . (Poule::count() + 1),
                ]);
            }

            // Koppel het team aan de poule
            $team->poule_id = $poule->id;
        });
    }
}
