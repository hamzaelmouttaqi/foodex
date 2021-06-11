<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Supplement extends Model
{
    use HasFactory;
    protected $fillable=['titre','prix','status','categorie_id','categorie','image'];
    protected $casts = [
        'status' => 'boolean'
     ];
     public function getRouteKeyName()
     {
         return "id";
     }
     public function categorie_supplements()
    {
        return $this->belongsTo(CategorieSupplement::class);
    }
}
