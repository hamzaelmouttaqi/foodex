<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\CategoryComposant;


class alimentaire extends Model
{
    use HasFactory;
    protected $casts = [
        'composants' => 'array'
    ];
    protected $fillable = ["titre","description","image","composants"];
    public function getRouteKeyName()
    {
        return "id";
    }
    public function composants()
    {
        return $this->belongToMany(composants::class);
    }
   
    public function sizes()
    {
        return $this->belongsToMany(Size::class, 'alimentaire_size', 'alimentaire_id', 'size_id')->withTimestamps()->withPivot(['prix']);
    }
}
