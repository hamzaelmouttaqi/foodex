<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livraison extends Model
{
    use HasFactory;
    public function livreurs()
    {
        return $this->hasMany(Livreur::class,'code_postal','code_postal');
    }
}
