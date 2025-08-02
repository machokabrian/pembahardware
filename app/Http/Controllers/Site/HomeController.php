<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Log;
use Illuminate\Pagination\LengthAwarePaginator;

class PageController extends Controller
{
    /**
     * Display the homepage with active categories and paginated featured products.
     *
     * Supports filtering products by category slug via query parameter.
     *
     * @param Request $request
     * @return \Illuminate\View\View
     */
    public function home(Request $request)
    {
        try {
            // Cache active categories for 1 hour to reduce DB load
            $categories = Cache::remember('categories_active', 3600, function () {
                return Category::where('is_active', 1)
                    ->orderBy('name')
                    ->get();
            });

            // Get optional category slug from query string (?category=slug)
            $categorySlug = $request->query('category');

            // Start building query for featured and active products with eager loading
            $featuredQuery = Product::with(['images', 'category'])
                ->where('is_featured', 1)
                ->where('is_active', 1)
                ->orderBy('created_at', 'desc');

            if ($categorySlug) {
                // Find category by slug in cached categories
                $category = $categories->firstWhere('slug', $categorySlug);

                if (!$category) {
                    // If invalid slug, abort with 404
                    abort(404, 'Category not found.');
                }

                // Filter products by category ID
                $featuredQuery->where('category_id', $category->id);
            }

            // Paginate featured products, 6 per page, keep query string
            $featuredProducts = $featuredQuery->paginate(6)->withQueryString();

            // Redirect to first page if no results and page > 1
            if ($featuredProducts->isEmpty() && $featuredProducts->currentPage() > 1) {
                return redirect()->route('home', array_merge($request->query(), ['page' => 1]));
            }

            // Return view with categories, products and the category slug filter
            return view('pages.home', compact('categories', 'featuredProducts', 'categorySlug'));
        } catch (\Exception $e) {
            Log::error('Homepage load error: ' . $e->getMessage());

            // Fallback: empty categories and products paginator to avoid breaking the view
            $featuredProducts = new LengthAwarePaginator(
                collect(),
                0,
                6,
                LengthAwarePaginator::resolveCurrentPage(),
                [
                    'path' => $request->url(),
                    'query' => $request->query(),
                ]
            );

            return view('pages.home', [
                'categories' => collect(),
                'featuredProducts' => $featuredProducts,
                'categorySlug' => null,
            ]);
        }
    }

    /**
     * Handle newsletter subscription.
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function subscribeNewsletter(Request $request)
    {
        $request->validate([
            'email' => 'required|email',
        ]);

        try {
            // TODO: Save email to database or external service

            return back()->with('newsletter_success', 'Thank you for subscribing!');
        } catch (\Exception $e) {
            Log::error('Newsletter subscription error: ' . $e->getMessage());

            return back()->with('newsletter_error', 'Subscription failed. Please try again later.');
        }
    }
}
