<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class categorie extends Model
{
    use HasFactory;
    protected $fillable = ["nomCat","status"];
    protected $casts = [
        'status' => 'boolean'
     ];
    public function getRouteKeyName()
    {
        return "id";
    }
    public function alimentaires()
    {
        return $this->hasMany(alimentaire::class,'categorie_id','id');
    }
}
