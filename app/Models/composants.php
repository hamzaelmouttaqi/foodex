<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class composants extends Model
{
    use HasFactory;
    protected $fillable=["nomComposant","image","categorie","Category_id","prix"];
    public function getRouteKeyName()
    {
        return "id";
    }
     
    /**
     * Get the user that owns the composants
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category_composants()
    {
        return $this->belongsTo(CategoryComposant::class);
    }
    public function alimentaires()
    {
        return $this->belongToMany(alimentaire::class,'alimentaire_composant', 'alimentaire_id', 'composant_id');
    }
}
