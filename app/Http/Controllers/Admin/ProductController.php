<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    /**
     * Display all products and categories.
     */
    public function index()
    {
        // ✅ Eager load category relationship
        $products = Product::with('category')->get();

        // ✅ Fetch all categories for the dropdown
        $categories = Category::all();

        return view('admin.product', compact('products', 'categories'));
    }

    /**
     * Store a new product.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'product_name'   => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,category_id',
            'brand'          => 'required|string|max:255',
            'size'           => 'required|string|max:255',
            'length'         => 'nullable|string|max:255',
            'width'          => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'supplier_price'     => 'required|numeric|min:0',
            'selling_price'  => 'required|numeric|min:0',
            // 'stock_quantity' => 'required|integer|min:0',
            'status'         => 'required|in:active,inactive',
        ]);

        Product::create($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product added successfully!');
    }

    /**
     * Update product details.
     */
    public function update(Request $request, $productId)
    {
        $validated = $request->validate([
            'product_name'   => 'required|string|max:255',
            'category_id'    => 'required|exists:categories,category_id',
            'brand'          => 'required|string|max:255',
            'size'           => 'required|string|max:255',
            'length'         => 'nullable|string|max:255',
            'width'          => 'nullable|string|max:255',
            'description'    => 'nullable|string',
            'supplier_price'     => 'required|numeric|min:0',
            'selling_price'  => 'required|numeric|min:0',
            // 'stock_quantity' => 'required|integer|min:0',
            'status'         => 'required|in:active,inactive',
        ]);

        $product = Product::findOrFail($productId);
        $product->update($validated);

        return redirect()->route('admin.products.index')->with('success', 'Product updated successfully!');
    }

    /**
     * Delete a product.
     */
    public function destroy($productId)
    {
        $product = Product::findOrFail($productId);
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Product deleted successfully!');
    }
}
