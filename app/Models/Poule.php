<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Poule extends Model
{
    protected $fillable = ['naam', 'competitie_id'];

    public function teams()
    {
        return $this->hasMany(Team::class, 'poule_id');
    }

    public function competitie()
    {
        return $this->belongsTo(Competitie::class);
    }
}
