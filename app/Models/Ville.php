<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Ville extends Model
{
    use HasFactory;

    public $incrementing = false;  // decrementer l'incrementation automatique de l'id
    protected $fillable = [
        'libelle',
        'statut'
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

    // relation entre ville et commune
    public function communes()
    {
        return $this->hasMany(Commune::class, 'ville_id');
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
