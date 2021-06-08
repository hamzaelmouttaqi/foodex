<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Parametre extends Model
{
    use HasFactory;
    protected $fillable =["nom_magasin","icon","logo","text_footer","tele","titre","email"] ;
    public function getRouteKeyName()
    {
        return "id";
    }
}
