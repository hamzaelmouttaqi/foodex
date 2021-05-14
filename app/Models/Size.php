<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Size extends Model
{
    use HasFactory;
    protected $table='sizes';
    protected $fillable=(['title']);

    /**
     * The alimentaire that belong to the Size
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany
     */
    public function alimentaire(): BelongsToMany
    {
        return $this->belongsToMany(alimentaire::class, 'alimentaire_size_table', 'size_id', 'alimentaire_id');
    }
}
