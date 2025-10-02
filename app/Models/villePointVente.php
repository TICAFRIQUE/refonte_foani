<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class villePointVente extends Model
{
    protected $fillable = [
        'id_ville',
        'id_commune',
        'contact',
        'responsable',
        'quartier',
        'email',
        'google_map',
    ];
}
