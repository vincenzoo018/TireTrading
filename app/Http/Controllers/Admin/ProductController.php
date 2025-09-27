<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index()
    {
        // Fetch all products with their associated category
        $products = Product::with('category')->get();

        // Fetch all categories
        $categories = Category::all();

        // Calculate stats
        $totalProduct = $products->count();
        $activeProducts = $products->where('status', 'active')->count();
        $totalCategories = $categories->count();
        $productCategories = Category::has('products')->count();

        // Pass data to the view
        return view('admin.product', compact(
            'products',
            'categories',
            'totalProduct',
            'activeProducts',
            'totalCategories',
            'productCategories'
        ));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'brand' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'status' => 'nullable|in:active,inactive',
        ]);

        Product::create($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully.');
    }

    public function update(Request $request, $productId)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category_id' => 'required|exists:categories,category_id',
            'brand' => 'nullable|string|max:255',
            'size' => 'nullable|string|max:255',
            'length' => 'nullable|numeric',
            'width' => 'nullable|numeric',
            'description' => 'nullable|string',
            'base_price' => 'required|numeric|min:0',
            'selling_price' => 'required|numeric|min:0',
            'status' => 'nullable|in:active,inactive',
        ]);

        $product = Product::findOrFail($productId);
        $product->update($request->all());

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully.');
    }

    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully.');
    }
}
