<?php

namespace App\Http\Controllers\Site;

use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class ProductController extends Controller
{
    /**
     * Display the home page with filtered products.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\View\View|\Illuminate\Http\JsonResponse
     */
    public function index(Request $request)
    {
        // Fetch all categories to display in the filter dropdown
        $categories = Category::all();
        
        // Get the category slug from the request (for filtering)
        $categorySlug = $request->get('category');

        // Fetch products based on selected category, or all products if no category is selected
        if ($categorySlug) {
            // Find the category by slug and fetch products for that category
            $category = Category::where('slug', $categorySlug)->firstOrFail();
            $featuredProducts = Product::where('category_id', $category->id)
                ->orderBy('created_at', 'desc') // Sort by latest products
                ->paginate(10);
        } else {
            // If no category is selected, fetch all products, ordered by latest
            $featuredProducts = Product::orderBy('created_at', 'desc')->paginate(10);
        }

        // Loop through the products and get the primary image URL
        foreach ($featuredProducts as $product) {
            // Get the primary image for the product
            $primaryImage = $product->images()->primary()->first();
            $product->primary_image_url = $primaryImage ? $primaryImage->url : asset('images/no-image.png'); // Default to placeholder if no image
        }

        // If the request is an AJAX request, return a JSON response with the updated product list
        if ($request->ajax()) {
            return response()->json([
                'html' => view('partials.product-list', compact('featuredProducts'))->render(),
                'pagination' => (string) $featuredProducts->links(), // Include pagination links for AJAX updates
            ]);
        }

        // For non-AJAX requests, return the main home view with products and categories
        return view('pages.home', compact('featuredProducts', 'categories'));
    }
}
