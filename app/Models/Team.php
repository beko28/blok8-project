<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    protected $fillable = [
        'naam',
        'poule_id',
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
            ->withPivot('id', 'status')
            ->withTimestamps();
    }
    
    public function poules()
    {
        return $this->belongsToMany(Poule::class, 'poule_team')->withTimestamps();
    }
    
    

}
