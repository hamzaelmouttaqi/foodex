<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Produit extends Model
{
    use HasFactory;
    protected $fillable =["titre"] ;
    public function getRouteKeyName()
    {
        return "id";
    }
    public function fournisseurs()
    {
        return $this->belongsToMany(Fournisseur::class,'fournisseur_produit', 'produit_id', 'fournisseur_id');
    }
}
