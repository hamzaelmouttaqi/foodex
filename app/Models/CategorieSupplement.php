<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CategorieSupplement extends Model
{
    use HasFactory;
    protected $table='categorie_supplements';
    protected $fillable=['title'];
    public function getRouteKeyName()
    {
        return 'id';
    }
    public function getsupp()
    {
       return $this->hasMany(Supplement::class,'categorie_id','id');
    }
}
