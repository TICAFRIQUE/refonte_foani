<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune extends Model
{

    protected $fillable = [
        'commune',
        'id_ville',
        'frais_de_port'
    ];
}
