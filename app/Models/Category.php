<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Category extends Model
{
    use HasFactory;

    // Mass assignable attributes
    protected $fillable = [
        'name',
        'slug',
        'description',
        'image',
        'is_active',
    ];

    // Casts for specific fields
    protected $casts = [
        'is_active' => 'boolean',
    ];

    /**
     * Relationship: A category has many products.
     */
    public function products()
    {
        return $this->hasMany(Product::class);
    }

    /**
     * Scope to get only active categories
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }
}
