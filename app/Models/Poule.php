<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poule extends Model
{
    use HasFactory;

    protected $fillable = ['naam', 'eigenaar_id'];

    public function eigenaar()
    {
        return $this->belongsTo(User::class, 'eigenaar_id');
    }

    public function deelnemers()
    {
        return $this->belongsToMany(User::class, 'poule_user');
    }

    public function teams()
    {
        return $this->hasMany(Team::class, 'poule_id');
    }

    protected static function boot()
{
    parent::boot();

    static::creating(function ($team) {
        // Zoek een beschikbare poule met minder dan 12 teams
        $poule = Poule::withCount('teams')->where('teams_count', '<', 12)->first();

        if (!$poule) {
            // Maak een nieuwe poule aan
            $poule = Poule::create([
                'naam' => 'Poule ' . (Poule::count() + 1),
            ]);
        }

        // Koppel het team aan de poule
        $team->poule_id = $poule->id;
    });
}


}
