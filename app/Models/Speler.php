<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Speler extends Authenticatable
{
    use Notifiable;

    protected $fillable = [
        'naam',
        'achternaam',
        'email',
        'password',
        'leeftijd',
        'rugnummer',
        'positie',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];
}
