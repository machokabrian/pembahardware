<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// Public Pages

// Home page
Route::get('/', [PageController::class, 'home'])->name('home');

// Products listing and details
Route::get('/products', [ProductController::class, 'index'])->name('products.index');
Route::get('/products/{slug}', [ProductController::class, 'show'])->name('products.show');

// Categories listing and detail
Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::get('/categories/{slug}', [CategoryController::class, 'show'])->name('categories.show');

// Cart page
Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

// Contact page
Route::view('/contact', 'pages.contact')->name('contact');

// Newsletter subscription (POST)
Route::post('/newsletter/subscribe', [PageController::class, 'subscribeNewsletter'])->name('newsletter.subscribe');


// Admin Routes (grouped under /admin prefix)
Route::prefix('admin')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
    Route::get('/categories', [AdminController::class, 'categories'])->name('admin.categories');
    Route::get('/products', [AdminController::class, 'products'])->name('admin.products');
    Route::get('/messages', [AdminController::class, 'messages'])->name('admin.messages');
});


// Fallback Route (404)
Route::fallback(function () {
    return response()->view('errors.404', [], 404);
});
