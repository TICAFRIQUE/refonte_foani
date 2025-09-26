<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Client extends Model
{

    protected $fillable = [
        'nom',
        'prenoms',
        'contact',
        'email',
        'ed_commune',
        'date_inscription',
        'mot_de_passe',
        'quartier',
    ];
}
