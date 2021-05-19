<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryComposant;


class alimentaire extends Model
{
    use HasFactory;
    protected $fillable = ["titre","description","image","categorie_id","categorie"];
    public function getRouteKeyName()
    {
        return "id";
    }
    public function composants()
    {
        return $this->belongsToMany(composants::class,'alimentaire_composant', 'alimentaire_id', 'composant_id');
    }
   
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'alimentaire_size', 'alimentaire_id', 'size_id')->withTimestamps()->withPivot(['prix']);
    }
    public function categorie()
    {
        return $this->belongsTo(categorie::class);
    }
    public function commandes()
    {
        return $this->belongsToMany(Commande::class, 'alimentaire_commande', 'alimentaire_id', 'commande_id');
    }
}
