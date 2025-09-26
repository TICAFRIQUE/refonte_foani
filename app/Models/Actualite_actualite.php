<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Actualite_actualite extends Model
{
    //
    protected $fillable = [
        'titre',
        'visibilite',
        'flash_info',
        'mot_cle',
        'image', //image de l'actualité
        'contenu'
    ];
}
