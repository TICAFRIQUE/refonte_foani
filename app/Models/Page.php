<?php

namespace App\Models;

use App\Models\Categorie_page;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
    public $incrementing = false;  // decrementer l'incrementation automatique de l'id
    protected $attributes = [
        'visibilite' => true,
    ];


    protected $fillable = [
        'titre',
        'mot_cle',
        'id_categorie_page',
        'visibilite',
        'image',
        'contenu',
    ];



    // Une page appartient à une categorie
    public function categorie()
    {
        return $this->belongsTo(Categorie_page::class, 'id_categorie_page');
    }


    //ID GENERERATED
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'pages', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }
}
