<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poule extends Model
{
    protected $fillable = ['naam', 'competitie_id'];

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'poule_team');
    }

    public function competitie()
    {
        return $this->belongsTo(Competitie::class);
    }
}
