<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\InteractsWithMedia;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Categorie extends Model implements HasMedia
{
    use InteractsWithMedia, Sluggable, HasFactory;

    public $incrementing = false;  // decrementer l'incrementation automatique de l'id

    protected $fillable = [
        'libelle',
        'image'
    ];



    //ID GENERERATED
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'categories', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'libelle'
            ]
        ];
    }


    public function produits()
    {
        return $this->hasMany(Produit::class, 'categorie_id');
    }



    //scope pour les produits actifs
    public function scopeActif($query)
    {
        return $query->where('statut', true);
    }
}
