<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Product;
use App\Models\Category;
use App\Models\Contact;
use App\Models\ProductImage;

class DashboardController extends Controller
{
    // =========================
    // Dashboard
    // =========================
    public function dashboard()
    {
        $categories = Category::all();
        $products = Product::with(['category', 'images'])->get();

        return view('admin.dashboard', [
            'productCount'  => Product::count(),
            'categoryCount' => Category::count(),
            'messageCount'  => Contact::where('read', false)->count(),
            'categories'    => $categories,
            'products'      => $products,
        ]);
    }

    // =========================
    // Category Management
    // =========================
    public function storeCategory(Request $request)
    {
        $request->validate(['name' => 'required|unique:categories,name']);

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Category created.');
    }

    public function updateCategory(Request $request, Category $category)
    {
        $request->validate(['name' => 'required|unique:categories,name,' . $category->id]);

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
        ]);

        return redirect()->route('admin.dashboard')->with('success', 'Category updated.');
    }

    public function destroyCategory(Category $category)
    {
        $category->delete();
        return redirect()->route('admin.dashboard')->with('success', 'Category deleted.');
    }

    // =========================
    // Product Management
    // =========================
    public function storeProduct(Request $request)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|unique:products,slug',
            'price'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        $slug = $request->slug ? $this->generateUniqueSlug($request->slug) : $this->generateUniqueSlug($request->name);

        $product = Product::create([
            'name'        => $request->name,
            'slug'        => $slug,
            'price'       => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'is_active'   => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');

            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'is_primary' => true,
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Product added.');
    }

    public function updateProduct(Request $request, Product $product)
    {
        $request->validate([
            'name'        => 'required|string|max:255',
            'slug'        => 'nullable|unique:products,slug,' . $product->id,
            'price'       => 'required|numeric',
            'category_id' => 'required|exists:categories,id',
            'image'       => 'nullable|image|max:2048',
        ]);

        $slug = $request->slug ? $this->generateUniqueSlug($request->slug, $product->id) : $this->generateUniqueSlug($request->name, $product->id);

        $product->update([
            'name'        => $request->name,
            'slug'        => $slug,
            'price'       => $request->price,
            'description' => $request->description,
            'category_id' => $request->category_id,
            'is_active'   => $request->has('is_active'),
            'is_featured' => $request->has('is_featured'),
        ]);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->store('products', 'public');

            ProductImage::where('product_id', $product->id)->update(['is_primary' => false]);

            ProductImage::create([
                'product_id' => $product->id,
                'image_path' => $path,
                'is_primary' => true,
            ]);
        }

        return redirect()->route('admin.dashboard')->with('success', 'Product updated.');
    }

    public function destroyProduct(Product $product)
    {
        $product->images()->delete();
        $product->delete();

        return redirect()->route('admin.dashboard')->with('success', 'Product deleted.');
    }

    // =========================
    // Contact Messages
    // =========================
    public function messages()
    {
        $messages = Contact::latest()->get();
        return view('admin.messages', compact('messages'));
    }

    // =========================
    // Helper: Ensure Unique Slug
    // =========================
    private function generateUniqueSlug($nameOrSlug, $ignoreId = null)
    {
        $slug = Str::slug($nameOrSlug);
        $originalSlug = $slug;
        $counter = 1;

        while (Product::where('slug', $slug)->when($ignoreId, fn($q) => $q->where('id', '!=', $ignoreId))->exists()) {
            $slug = $originalSlug . '-' . $counter++;
        }

        return $slug;
    }
}
