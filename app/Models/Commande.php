<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class Commande extends Model
{
    use HasFactory;
    protected $fillable=['id_client','status','montant','nom_client','id_livreur'];
    protected $casts=['status'=>'boolean',
    'alimentaire'=>'array','composantCommande'=>'array'];
    public function getRouteKeyName()
    {
        return "id";
    }
    
    public function clients()
    {
        return $this->belongsTo(Client::class);
    }
    public function alimentaires()
    {
        return $this->belongsToMany(alimentaire::class, 'alimentaire_commande', 'commande_id', 'alimentaire_id')->withTimestamps()->withPivot(['composantCommande','prixAlimentaire','prixSupplement',
        'prixSize','sizeAlimentaire','supplementCommande','quantite','id']);
    }
    public function livreur()
    {
        return $this->belongsTo(Livreur::class);
    }
}
