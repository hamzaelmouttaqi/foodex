<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use phpDocumentor\Reflection\Types\Boolean;

class Commande extends Model
{
    use HasFactory;
    protected $fillable=['id_client','date_commande','status','montant','nom_clients'];
    protected $casts=['status'=>'boolean'];
    public function getRouteKeyName()
    {
        return "id";
    }
    public function clients()
    {
        return $this->belongsTo(Client::class);
    }

}
