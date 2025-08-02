<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    // Show dashboard with categories + forms for create/edit
    public function index(Request $request)
    {
        $categories = Category::orderBy('created_at', 'desc')->paginate(10);

        $editCategory = null;
        if ($request->has('edit')) {
            $editCategory = Category::find($request->query('edit'));
        }

        // Load products with their category and images relations
        $products = Product::with(['category', 'images'])->get();

        return view('admin.dashboard', [
            'categories'    => $categories,
            'editCategory'  => $editCategory,
            'products'      => $products,
            'productCount'  => Product::count(),
            'categoryCount' => Category::count(),
            'messageCount'  => Contact::where('read', false)->count(),
        ]);
    }

    // Store a new category
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name',
            'description' => 'nullable|string',
        ]);

        $data = $request->only('name', 'description');
        $data['slug'] = Str::slug($data['name']);

        Category::create($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category created successfully.');
    }

    // Update an existing category
    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => 'required|string|max:255|unique:categories,name,' . $category->id,
            'description' => 'nullable|string',
        ]);

        $data = $request->only('name', 'description');
        $data['slug'] = Str::slug($data['name']);

        $category->update($data);

        return redirect()->route('admin.categories.index')->with('success', 'Category updated successfully.');
    }

    // Delete a category
    public function destroy(Category $category)
    {
        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Category deleted successfully.');
    }
}
