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

}
