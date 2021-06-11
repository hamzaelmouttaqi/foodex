<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Fournisseur extends Model
{
    use HasFactory;
    protected $fillable =["nom","adresse","tele","email"] ;
    public function getRouteKeyName()
    {
        return "id";
    }
    public function produits()
    {
        return $this->belongsToMany(Produit::class,'fournisseur_produit', 'fournisseur_id', 'produit_id')->withTimestamps()->withPivot(['prix_unitaire']);;
    }
   
    public function achats()
    {
        return $this->hasMany(Achat::class, 'fournisseur_id', 'id');
    }
}
