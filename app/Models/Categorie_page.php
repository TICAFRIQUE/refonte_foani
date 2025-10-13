<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Haruncpi\LaravelIdGenerator\IdGenerator;


class Categorie_page extends Model
{
    public $incrementing = false;  // decrementer l'incrementation automatique de l'id

    protected $fillable = ['titre'];


//    une catégorie page peut avoir plusieurs pages
public function pages(){
    return $this->hasMany(Page::class,'id_categorie_page');
}


    //ID GENERERATED
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'categorie_pages', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }
}
