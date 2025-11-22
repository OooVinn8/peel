<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'name',
        'category_id',
        'description',
        'price',
        'stock',
        'rating',
        'reviews',
        'discount',
        'image',
        'is_recommendation',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class, 'category_id');
    }
}
