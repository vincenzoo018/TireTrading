<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function categories()
    {
        $categories = Category::withCount('products')->get();

        $stats = [
            'totalCategories' => Category::count(),
            'totalProducts' => Product::count(),
            'categoriesWithProducts' => Category::has('products')->count(),
            'emptyCategories' => Category::doesntHave('products')->count(),
        ];

        return view('admin.categories', compact('categories') + $stats);
    }

    public function storeCategory(Request $request)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name',
        ]);

        Category::create($request->only('category_name'));

        return redirect()->route('admin.categories')
            ->with('success', 'Category created successfully.');
    }

    public function updateCategory(Request $request, $categoryId)
    {
        $request->validate([
            'category_name' => 'required|string|max:255|unique:categories,category_name,' . $categoryId . ',category_id',
        ]);

        $category = Category::findOrFail($categoryId);
        $category->update($request->only('category_name'));

        return redirect()->route('admin.categories')
            ->with('success', 'Category updated successfully.');
    }

    public function deleteCategory($categoryId)
    {
        $category = Category::findOrFail($categoryId);

        if ($category->products()->count() > 0) {
            return redirect()->route('admin.categories')
                ->with('error', 'Cannot delete category that has products assigned.');
        }

        $category->delete();

        return redirect()->route('admin.categories')
            ->with('success', 'Category deleted successfully.');
    }
}