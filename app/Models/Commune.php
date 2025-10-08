<?php

namespace App\Models;

use App\Models\VilleLivraison;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Commune extends Model
{
    public $incrementing = false;  // decrementer l'incrementation automatique de l'id
    protected $fillable = [
        'frais_de_port',
        'id_ville',
        'libelle'
    ];

    // relation entre commune et ville
    public function ville()
    {
        return $this->belongsTo(Ville::class, 'id_ville');
    }


    // génère automatiquement Id
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'communes', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }
}
