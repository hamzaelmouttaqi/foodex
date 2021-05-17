<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;
    protected $fillable =["nom","Prenom","adresse","date_de_naissance","tele","code_postal","email"] ;
    public function getRouteKeyName()
    {
        return "id";
    }
    public function commandes()
    {
        return $this->hasMany(Commande::class, 'id_client', 'id');
    }

}
