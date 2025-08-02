<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\ProductImage;
use Illuminate\Support\Facades\Storage;

class ProductController extends Controller
{
    // Method for storing a new product
    public function store(Request $request)
    {
        // ✅ Validate form input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // ✅ Generate unique slug from name
        $slug = Str::slug($validated['name']);
        $originalSlug = $slug;
        $counter = 1;

        while (Product::where('slug', $slug)->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        // ✅ Create product (now with slug)
        $product = Product::create([
            'name' => $validated['name'],
            'slug' => $slug,
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'description' => $validated['description'] ?? null,
        ]);

        // ✅ Handle image upload and save to product_images table
        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'is_primary' => true,
            ]);
        }

        return redirect()->back()->with('success', 'Product added successfully.');
    }

    // Method for updating an existing product
    public function update(Request $request, Product $product)
    {
        // ✅ Validate form input
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'category_id' => 'required|integer|exists:categories,id',
            'price' => 'required|numeric|min:0',
            'description' => 'nullable|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
        ]);

        // ✅ Update the product details
        $product->update([
            'name' => $validated['name'],
            'category_id' => $validated['category_id'],
            'price' => $validated['price'],
            'description' => $validated['description'] ?? null,
        ]);

        // ✅ Handle image upload and save to product_images table
        if ($request->hasFile('image')) {
            // Delete the old image if it exists
            $primaryImage = $product->images->firstWhere('is_primary', true);
            if ($primaryImage && Storage::disk('public')->exists($primaryImage->image_path)) {
                Storage::disk('public')->delete($primaryImage->image_path);
            }

            // Store the new image
            $path = $request->file('image')->store('products', 'public');

            // Save the new image to the product_images table
            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'is_primary' => true,
            ]);
        }

        return redirect()->back()->with('success', 'Product updated successfully.');
    }

    // Method for deleting a product
    public function destroy(Product $product)
    {
        // ✅ Delete all related images and their files
        foreach ($product->images as $image) {
            if ($image->image_path && Storage::disk('public')->exists($image->image_path)) {
                Storage::disk('public')->delete($image->image_path);
            }
            $image->delete();
        }

        // ✅ Delete the product itself
        $product->delete();

        return redirect()->back()->with('success', 'Product deleted successfully.');
    }
}
