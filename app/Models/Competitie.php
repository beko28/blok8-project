<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Competitie extends Model
{
    protected $fillable = ['naam', 'type'];

    public function poules()
    {
        return $this->hasMany(Poule::class);
    }
}
