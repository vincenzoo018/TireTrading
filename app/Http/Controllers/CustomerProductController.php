<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Category;
use App\Models\Inventory;

class CustomerProductController extends Controller
{
    public function index(Request $request)
    {
        // Get all inventories with stockIn and product
        $inventoryQuery = \App\Models\Inventory::with(['stockIn.product.category']);

        // Filtering
        if ($request->filled('category')) {
            $inventoryQuery->whereHas('stockIn.product', function ($q) use ($request) {
                $q->where('category_id', $request->category);
            });
        }
        if ($request->filled('brand')) {
            $inventoryQuery->whereHas('stockIn.product', function ($q) use ($request) {
                $q->where('brand', $request->brand);
            });
        }
        if ($request->filled('search')) {
            $inventoryQuery->whereHas('stockIn.product', function ($q) use ($request) {
                $q->where('product_name', 'like', '%' . $request->search . '%');
            });
        }
        // Sorting
        if ($request->filled('sort')) {
            switch ($request->sort) {
                case 'price_asc':
                    $inventoryQuery->join('stock_ins', 'inventories.stock_in_id', '=', 'stock_ins.stock_in_id')
                        ->join('products', 'stock_ins.product_id', '=', 'products.product_id')
                        ->orderBy('products.selling_price', 'asc');
                    break;
                case 'price_desc':
                    $inventoryQuery->join('stock_ins', 'inventories.stock_in_id', '=', 'stock_ins.stock_in_id')
                        ->join('products', 'stock_ins.product_id', '=', 'products.product_id')
                        ->orderBy('products.selling_price', 'desc');
                    break;
                case 'name_asc':
                    $inventoryQuery->join('stock_ins', 'inventories.stock_in_id', '=', 'stock_ins.stock_in_id')
                        ->join('products', 'stock_ins.product_id', '=', 'products.product_id')
                        ->orderBy('products.product_name', 'asc');
                    break;
                case 'name_desc':
                    $inventoryQuery->join('stock_ins', 'inventories.stock_in_id', '=', 'stock_ins.stock_in_id')
                        ->join('products', 'stock_ins.product_id', '=', 'products.product_id')
                        ->orderBy('products.product_name', 'desc');
                    break;
            }
        }

        $inventories = $inventoryQuery->get();
        $categories = Category::all();
        $brands = Product::select('brand')->distinct()->pluck('brand');

        return view('customer.products', [
            'inventories' => $inventories,
            'categories' => $categories,
            'brands' => $brands,
        ]);
    }
}
