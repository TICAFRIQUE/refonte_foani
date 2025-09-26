<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Commune_livraison extends Model
{
    //
    protected $fillable = ['frais_de_port', 'id_ville_livraison', 'commune'];
}
