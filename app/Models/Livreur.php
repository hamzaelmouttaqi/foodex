<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livreur extends Model
{
    use HasFactory;
    protected $fillable=(['nom','status','code_postal']);
    protected $casts=([
        'status'=>'boolean'
    ]);
       public function livraisons()
       {
           return $this->belongsTo(Livraison::class);
       }
       public function commandes()
       {
           return $this->hasMany(Commande::class,'id_livreur','id');
       }
}
