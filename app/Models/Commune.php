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
        'ville_id',
        'libelle',
        'statut'
    ];

    // relation entre commune et ville
    public function ville()
    {
        return $this->belongsTo(Ville::class, 'ville_id');
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

    //scope active
    public function scopeActive($query)
    {
        return $query->where('statut', true);
    }

    //scope ordre alphabetique
    public function scopeAlphabetique($query)
    {
        return $query->orderBy('libelle', 'asc');
    }
}
