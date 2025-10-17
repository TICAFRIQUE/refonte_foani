<?php

namespace App\Models;

use App\Models\Categorie_page;
use Cviebrock\EloquentSluggable\Sluggable;
use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Haruncpi\LaravelIdGenerator\IdGenerator;

class Page extends Model implements HasMedia
{
    use InteractsWithMedia ,  Sluggable;
    public $incrementing = false;  // decrementer l'incrementation automatique de l'id


    protected $fillable = [
        'libelle',
        'slug',
        'mot_cle',
        'categorie_page_id',
        'statut',
        'description',
    ];


     //ID GENERERATED
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'pages', 'length' => 10, 'prefix' =>
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



    // Une page appartient à une categorie
    public function categorie()
    {
        return $this->belongsTo(CategoriePage::class, 'categorie_page_id');
    }


   

    //scope pour les pages actives
    public function scopeActive($query)
    {
        return $query->where('statut', true);
    }
}
