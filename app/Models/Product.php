<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Product extends Model
{
    use HasFactory;

    protected $fillable = [
        'category_id',
        'name',
        'slug',
        'sku',
        'description',
        'short_description',
        'long_description',
        'price',
        'discount_price',
        'stock',
        'unit',
        'image',
        'is_featured',
        'is_active',
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }
}
