<?php

namespace App\Models;

use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    use HasFactory;
    public $incrementing = false;
    protected $fillable = [
        'nom_prenoms',
        'bojet',
        'email',
        'telephone',
        'message',
    ];


    // génère automatiquement Id
    public static function boot()
    {
        parent::boot();
        self::creating(function ($model) {
            $model->id = IdGenerator::generate(['table' => 'communes', 'length' => 10, 'prefix' =>
            mt_rand()]);
        });
    }
}
