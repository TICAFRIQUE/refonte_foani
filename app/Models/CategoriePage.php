<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Haruncpi\LaravelIdGenerator\IdGenerator;


class CategoriePage extends Model
{
    use Sluggable;
    public $incrementing = false;  // decrementer l'incrementation automatique de l'id

    protected $fillable = ['libelle', 'slug','statut'];

    //ID GENERERATED
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'categorie_pages', 'length' => 10, 'prefix' =>
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
    //    une catégorie page peut avoir plusieurs pages
    public function pages()
    {
        return $this->hasMany(Page::class, 'categorie_page_id');
    }


    //scope pour les categories pages actives
    public function scopeActive($query)
    {
        return $query->where('statut', true);
    }
}
