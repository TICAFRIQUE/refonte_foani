<?php

namespace App\Models;

use App\Models\VilleLivraison;
use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class CommuneLivraison extends Model
{
    public $incrementing = false;  // decrementer l'incrementation automatique de l'id
    protected $fillable = [
        'frais_de_port',
        'id_ville_livraison',
        'libelle'
    ];

    // relation entre commune et ville
    public function ville()
    {
        return $this->belongsTo(VilleLivraison::class, 'id_ville_livraison');
    }


    // génère automatiquement Id
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'commune_livraisons', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }
}
