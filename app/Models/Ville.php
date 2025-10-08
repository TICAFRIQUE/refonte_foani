<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Ville extends Model
{

    public $incrementing = false;  // decrementer l'incrementation automatique de l'id
    protected $fillable = [
        'libelle'

    ];

    // génère automatiquement Id
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'villes', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }
}
