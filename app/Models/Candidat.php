<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;

class Candidat extends Model
{
    public $incrementing = false;  // decrementer l'incrementation automatique de l'id

    protected $fillable = [
        'nom_prenom',
        'email',
        'objet',
        'cv',
        'captcha'
    ];






    //ID GENERERATED
    public static function boot()
    {
        parent::boot();
        self::creating(function ($candidat) {
            $candidat->id = IdGenerator::generate(['table' => 'candidats', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }
}
