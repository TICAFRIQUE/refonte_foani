<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Membres extends Model
{
   protected $fillable = [
    'nom_prenoms',
    'emails',
    'matricule',
    'photo',
    'contact',
    'mot_de_passe',
    'role'
   ];
}
