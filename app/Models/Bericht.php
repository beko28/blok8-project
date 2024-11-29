<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bericht extends Model
{
    protected $table = 'berichten';

    protected $fillable = [
        'ontvanger_id',
        'verzender_id',
        'inhoud',
    ];

    public function ontvanger()
    {
        return $this->belongsTo(Speler::class, 'ontvanger_id');
    }

    public function verzender()
    {
        return $this->belongsTo(Speler::class, 'verzender_id');
    }
}
