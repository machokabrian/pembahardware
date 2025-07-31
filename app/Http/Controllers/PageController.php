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
     * Display the homepage with categories and paginated featured products.
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

            // Read and validate category filter
            $categoryFilter = $request->query('category');
            if ($categoryFilter) {
                if (!is_numeric($categoryFilter)) {
                    abort(400, 'Invalid category filter.');
                }

                $categoryExists = Category::where('is_active', 1)
                    ->where('id', $categoryFilter)
                    ->exists();

                if (!$categoryExists) {
                    abort(404, 'Category not found.');
                }
            }

            // Build featured product query
            $featuredQuery = Product::where('is_featured', 1)
                ->where('is_active', 1)
                ->orderBy('created_at', 'desc');

            // Apply category filter
            if ($categoryFilter) {
                $featuredQuery->where('category_id', $categoryFilter);
            }

            // Paginate featured products (6 per page)
            $featuredProducts = $featuredQuery
                ->paginate(6)
                ->withQueryString();

            // Gracefully handle out-of-range pagination (e.g. ?page=999)
            if ($featuredProducts->isEmpty() && $featuredProducts->currentPage() > 1) {
                return redirect()->route('home');
            }

            return view('pages.home', compact('categories', 'featuredProducts'));

        } catch (\Exception $e) {
            Log::error('Homepage load error: ' . $e->getMessage());

            // Empty paginator fallback
            $featuredProducts = new LengthAwarePaginator(
                collect(),        // empty items
                0,                // total items
                6,                // per page
                LengthAwarePaginator::resolveCurrentPage(),
                [
                    'path' => request()->url(),
                    'query' => request()->query(),
                ]
            );

            return view('pages.home', [
                'categories' => collect(),
                'featuredProducts' => $featuredProducts,
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
            // TODO: Save email to DB or external service (e.g., Mailchimp)

            return back()->with('newsletter_success', 'Thank you for subscribing!');
        } catch (\Exception $e) {
            Log::error('Newsletter subscription error: ' . $e->getMessage());

            return back()->with('newsletter_error', 'Subscription failed. Please try again later.');
        }
    }
}
