<?php

namespace App\Models;

use App\Models\Commune;
use App\Models\Ville;
use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Factories\HasFactory;

class villePointVente extends Model
{

    use HasFactory;

    protected $fillable = [
        'id_ville',
        'id_commune',
        'contact',
        'responsable',
        'quartier',
        'email',
        'google_map',
    ];

    public function ville()
    {
        return $this->belongsTo(Ville::class, 'id_ville');
    }

    public function commune()
    {
        return $this->belongsTo(Commune::class, 'id_commune');
    }
}
