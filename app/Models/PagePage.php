<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PagePage extends Model
{
    //
    protected $fillable = [
        'titre',
        'mot_cle',
        'id_categorie_page',
        'visilibite',
        "image",
        'contenu'
    ];
}
