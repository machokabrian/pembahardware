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

    /**
     * Get the category that this product belongs to.
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Get all images associated with this product.
     */
    public function images()
    {
        return $this->hasMany(ProductImage::class);
    }
}
