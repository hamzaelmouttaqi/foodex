<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class avis extends Model
{
    use HasFactory;
    protected $table='avis';
    protected $fillable=['description','user_id','note'];
    public function getRouteKeyName()
    {
        return "id";
    }

}
