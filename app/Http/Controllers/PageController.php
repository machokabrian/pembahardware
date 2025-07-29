<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;

class PageController extends Controller
{
    /**
     * Display the homepage with categories and featured products.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function home(Request $request)
    {
        try {
            // Cache active categories for 1 hour
            $categories = Cache::remember('categories_active', 3600, function () {
                return Category::where('is_active', 1)
                    ->orderBy('name')
                    ->get();
            });

            // Get the selected category from query string
            $categoryFilter = $request->query('category');

            // Prepare query for featured products
            $featuredQuery = Product::where('is_featured', 1)
                ->where('is_active', 1)
                ->orderBy('created_at', 'desc');

            // Apply category filter if set
            if ($categoryFilter) {
                $featuredQuery->where('category', $categoryFilter);
            }

            // Paginate featured products (6 per page)
            $featuredProducts = $featuredQuery->paginate(6)->withQueryString();

            return view('pages.home', compact('categories', 'featuredProducts'));
        } catch (\Exception $e) {
            Log::error('Failed to load homepage data: ' . $e->getMessage());

            return view('pages.home', [
                'categories' => collect(),
                'featuredProducts' => collect(),
            ]);
        }
    }

    /**
     * Handle newsletter subscription.
     *
     * @param  Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribeNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        try {
            // TODO: Add subscription logic here (e.g., save to DB or send to mailing service)

            // For now, just flash success message
            return back()->with('newsletter_success', 'Thank you for subscribing!');
        } catch (\Exception $e) {
            Log::error('Newsletter subscription failed: ' . $e->getMessage());

            return back()->with('newsletter_error', 'Sorry, we could not process your subscription right now.');
        }
    }
}
