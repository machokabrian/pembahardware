<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\CategoryController as AdminCategoryController;
use App\Http\Controllers\Admin\ProductController as AdminProductController;
use App\Http\Controllers\Site\ProductController as SiteProductController; // Import SiteProductController

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// -----------------------------
// ✅ Public Routes (Site)
// -----------------------------

// Home page
Route::get('/', [SiteProductController::class, 'index'])->name('home'); // Updated to SiteProductController

// Products listing page
Route::get('/products', [SiteProductController::class, 'index'])->name('products.index'); // Updated to SiteProductController

// Single product page
Route::get('/products/{slug}', [SiteProductController::class, 'show'])->name('products.show'); // Updated to SiteProductController

// Categories listing page
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');

// Display products by category slug
Route::get('/category/{slug}', [SiteProductController::class, 'showCategory'])->name('category.show'); // Updated to SiteProductController

// Shopping Cart page
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Contact page
Route::view('/contact', 'pages.contact')->name('contact');

// Subscribe to newsletter
Route::post('/newsletter/subscribe', [PageController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');

// -----------------------------
// ✅ Admin Routes
// -----------------------------

// Admin Dashboard Redirect
Route::redirect('/admin', '/admin/dashboard')->name('admin.redirect');

Route::prefix('admin')->name('admin.')->group(function () {
    // Dashboard
    Route::get('/dashboard', [DashboardController::class, 'dashboard'])->name('dashboard');

    // Categories Management
    Route::get('/categories', [AdminCategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [AdminCategoryController::class, 'store'])->name('categories.store');
    Route::put('/categories/{category}', [AdminCategoryController::class, 'update'])->name('categories.update');
    Route::delete('/categories/{category}', [AdminCategoryController::class, 'destroy'])->name('categories.destroy');

    // Products Management
    Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
    Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
    Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
    Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');

    // Contact Messages Management
    Route::get('/messages', [DashboardController::class, 'messages'])->name('messages');
});

// -----------------------------
// ✅ Authentication Routes
// -----------------------------

// Login Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login'])->name('login.post');
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

// Registration Routes
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register'])->name('register.post');

// -----------------------------
// ✅ Fallback for 404
// -----------------------------
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});

// -----------------------------
// ✅ Site Routes for Featured Products & AJAX
// -----------------------------

// Home page featured products with optional category filter
Route::get('/', [SiteProductController::class, 'index'])->name('home'); // Updated to SiteProductController

// Display products by category slug (for Site)
Route::get('/category/{slug}', [SiteProductController::class, 'showCategory'])->name('category.show'); // Updated to SiteProductController

// AJAX handler to load featured products dynamically (for Site)
Route::get('/featured-products/ajax', [SiteProductController::class, 'featuredProductsAjax'])->name('featured.products.ajax');

// AJAX preview for a specific product (for quick product details)
Route::get('/product/preview/{product}', [SiteProductController::class, 'preview'])->name('product.preview');

