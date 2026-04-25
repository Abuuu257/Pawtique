<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'subtitle',
        'price',
        'rating',
        'reviews',
        'description',
        'images',
    ];

    protected $casts = [
        'images' => 'array',
        'price' => 'float',
        'rating' => 'float',
    ];

    public function favoritedBy()
    {
        return $this->belongsToMany(User::class, 'favorites');
    }
}
