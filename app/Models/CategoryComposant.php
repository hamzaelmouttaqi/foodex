<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class CategoryComposant extends Model
{
    use HasFactory;

    protected $table='category_composants';
    protected $fillable=['title'];
    public function getRouteKeyName()
    {
        return 'id';
    }
    public function getcom()
    {
       return $this->hasMany(composants::class,'Category_id','id');
    }
    
}
