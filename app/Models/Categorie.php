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
        'slug',
        'description',
        'position',
        'statut',
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

// Une catégorie peut avoir plusieurs produits
    public function produits()
    {
        return $this->hasMany(Produit::class, 'categorie_id');
    }



    //scope pour les produits actifs
    public function scopeActive($query)
    {
        return $query->where('statut', true);
    }

    //les categorie par ordre alphabetique
    public function scopeAlphabetique($query)
    {
        return $query->orderBy('libelle', 'asc');
    }
    //les categorie par ordre position
    public function scopePosition($query)
    {
        return $query->orderBy('position', 'asc');
    }
}
