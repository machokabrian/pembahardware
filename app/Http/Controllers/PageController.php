<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class PageController extends Controller
{
    /**
     * Show the home page.
     */
    public function home()
    {
        // Get featured products with pagination (6 per page)
        $featuredProducts = Product::where('is_featured', true)->paginate(6);

        // Pass the paginated products to the view
        return view('pages.home', compact('featuredProducts'));
    }

    /**
     * Show an about page.
     */
    public function about()
    {
        return view('pages.about'); // Adjust the view path as necessary
    }
}
