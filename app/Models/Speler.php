<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Speler extends Authenticatable
{
    use Notifiable;

    // Rollen constanten
    public const ROLE_SPELER = 'speler';
    public const ROLE_TEAMEIGENAAR = 'teameigenaar';
    public const ROLE_ADMIN = 'admin';

    public const ROLES = [
        self::ROLE_SPELER,
        self::ROLE_TEAMEIGENAAR,
        self::ROLE_ADMIN,
    ];

    protected $fillable = [
        'voornaam',
        'achternaam',
        'email',
        'password',
        'leeftijd',
        'rugnummer',
        'positie',
        'role',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    public function acceptedTeams(){
    return $this->belongsToMany(Team::class, 'spelers_teams')
        ->withPivot('status')
        ->wherePivot('status', 'geaccepteerd')
        ->withTimestamps();
    }

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    public function teamEigenaar()
    {
        return $this->hasOne(Team::class, 'eigenaar_id');
    }

    public function teams()
    {
        return $this->belongsToMany(Team::class, 'spelers_teams')
            ->withPivot('status')
            ->withTimestamps();
    }

    public static function isValidRole(string $role): bool
    {
        return in_array($role, self::ROLES);
    }

    public function verstuurdeBerichten()
    {
        return $this->hasMany(Bericht::class, 'afzender_id');
    }

    public function ontvangenBerichten()
    {
        return $this->hasMany(Bericht::class, 'ontvanger_id');
    }

    public function isPouleEigenaar()
    {
        return $this->teams()->exists();
    }

    public function isEigenaar()
    {
        return $this->role === self::ROLE_TEAMEIGENAAR;
    }
    


}
