<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ville_point_vente extends Model
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
