<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achat extends Model
{
    use HasFactory;
    protected $fillable =["prix_total","fournisseur_id"] ;
    public function getRouteKeyName()
    {
        return "id";
    }
   
    public function fournisseur()
    {
        return $this->belongsTo(Fournisseur::class);
    }
    public function produits(){
        return $this->belongsToMany(Produit::class ,'achat_produit','achats_id','produits_id')->withPivot(['prix','quantite'])->withTimestamps();;
    }
}
