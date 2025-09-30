<?php

namespace App\Models;

use App\Models\Categorie;
use App\Models\Type_offre;
use Cviebrock\EloquentSluggable\Sluggable;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;

class Produit extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia, Sluggable;

    public $incrementing = false;  // decrementer l'incrementation automatique de l'id
    protected $fillable = [
        'libelle',
        'type_offre_id',
        'categorie_id',
        'prix_de_vente',
        'frais_de_port',
        'stock',
        'description',
        'mots_cle',
        'prix_achat',
        'reduction_en_procentage',
        'visibilite',
        'slug',
    ];
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'libelle'
            ]
        ];
    }



    // Relation avec le modèle Categorie
    public function categories()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id');
    }

    // Relation avec le modèle Type_offre
    public function appreciation()
    {
        return $this->belongsTo(Type_offre::class, 'type_offre_id');
    }



    //ID GENERERATED
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'produits', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }
}
