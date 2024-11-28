<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Team extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'naam',
        'adres',
        'max_spelers',
        'eigenaar_id',
    ];

    /**
     * Get the eigenaar (owner) of the team.
     */
    public function eigenaar()
    {
        return $this->belongsTo(Speler::class, 'eigenaar_id');
    }

    /**
     * Get the spelers (players) associated with the team.
     */
    public function spelers()
    {
        return $this->belongsToMany(Speler::class, 'spelers_teams')
            ->withPivot('status')
            ->withTimestamps();
    }
}
