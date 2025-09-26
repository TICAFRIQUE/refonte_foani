<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{

    protected $fillable = [
        'titre',
        'id_categorie',
        'prix_de_vente',
        'frais_de_port',
        'id_appreciation',
        'stock',
        'description',
        'photo_de_couverture', //image de couverture
        'galerie', //image de galerie
        'mots_cle',
        'prix_achat',
        'reduction_en_procentage',
        'visibite' // rendre public  : oui || non
    ];
}
