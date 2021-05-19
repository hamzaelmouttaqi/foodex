<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AlimentaireCommande extends Model
{
    use HasFactory;
    protected $table='alimentaire_commande';
    protected $fillable=['alimentaire_id','commande_id','composantCommande',
    'prixAlimentaire','prixSupplement',
    'prixSize','sizeAlimentaire','supplementCommande'];
    protected $casts = [
        'composantCommande' => 'array', 
        'supplementCommande'=>'array'
    ];
}
