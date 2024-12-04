<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Speler extends Authenticatable
{
    use Notifiable;

    // Toegestane rollen
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

    public function team()
    {
        return $this->belongsTo(Team::class);
    }

    /**
     * Controleer of een rol geldig is.
     */
    public static function isValidRole(string $role): bool
    {
        return in_array($role, self::ROLES);
    }

    public function teamEigenaar()
{
    return $this->hasOne(Team::class, 'eigenaar_id'); // Koppel via het 'eigenaar_id'-veld
}

}
