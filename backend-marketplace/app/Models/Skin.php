<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Skin extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'category_id',
        'image_path',
        'description',
        'popularity'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class, 'user_skins')
            ->withPivot('price', 'for_sale');
    }

    public function sales()
    {
        return $this->hasMany(Sale::class);
    }
}
