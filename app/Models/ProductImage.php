<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     */
    protected $fillable = [
        'product_id',
        'image_path',
        'is_primary',
    ];

    /**
     * Get the product that owns this image.
     */
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    /**
     * Accessor: Get full URL of the image or a fallback placeholder.
     */
    public function getUrlAttribute()
    {
        if ($this->image_path && Storage::disk('public')->exists($this->image_path)) {
            return asset('storage/' . $this->image_path);
        }

        // Fallback image if file doesn't exist
        return asset('images/no-image.png'); // ensure you have public/images/no-image.png
    }

    /**
     * Scope: Only primary image
     */
    public function scopePrimary($query)
    {
        return $query->where('is_primary', true);
    }

    /**
     * Delete image file from storage when record is deleted.
     */
    protected static function booted()
    {
        static::deleting(function ($image) {
            if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
        });
    }
}
