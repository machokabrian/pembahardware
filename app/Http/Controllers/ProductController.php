<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;

class ProductController extends Controller
{
    // 🧭 Product Listing with Filters
    public function index(Request $request)
    {
        $categories = Category::all();

        $products = Product::query()->with('category');

        // 🔍 Filter by multiple categories
        if ($request->filled('categories')) {
            $products->whereIn('category_id', (array) $request->categories);
        }

        // 💰 Filter by price range
        if ($request->filled('price_min')) {
            $products->where('price', '>=', $request->price_min);
        }

        if ($request->filled('price_max')) {
            $products->where('price', '<=', $request->price_max);
        }

        // 🔎 Search by name or description
        if ($request->filled('search')) {
            $products->where(function ($query) use ($request) {
                $query->where('name', 'like', '%' . $request->search . '%')
                      ->orWhere('description', 'like', '%' . $request->search . '%');
            });
        }

        // 📦 Filter by availability
        if ($request->filled('availability')) {
            if ($request->availability === 'in') {
                $products->where('stock', '>', 0);
            } elseif ($request->availability === 'out') {
                $products->where('stock', '<=', 0);
            }
        }

        // 🧾 Sort & paginate
        $products = $products->latest()->paginate(12)->withQueryString();

        return view('products.index', compact('products', 'categories'));
    }

    // ⚡ AJAX Modal Preview
    public function preview(Product $product)
    {
        return response()->json([
            'id' => $product->id,
            'name' => $product->name,
            'image' => asset('storage/' . $product->image),
            'price' => $product->price,
            'description' => $product->description,
            'category' => $product->category->name ?? 'Uncategorized',
            'availability' => $product->stock > 0 ? 'In Stock' : 'Out of Stock',
        ]);
    }
}
