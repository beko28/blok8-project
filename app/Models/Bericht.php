<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Bericht extends Model
{
    protected $table = 'berichten';

    protected $fillable = [
        'afzender_id',
        'ontvanger_id',
        'inhoud',
        'read_at'
    ];
    
    protected $dates = [
        'read_at'
    ];
    

    public function afzender()
    {
        return $this->belongsTo(Speler::class, 'afzender_id');
    }

    public function ontvanger()
    {
        return $this->belongsTo(Speler::class, 'ontvanger_id');
    }
}
