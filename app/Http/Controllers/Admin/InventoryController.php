<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Inventory;
use App\Models\Product;
use App\Models\StockIn;

class InventoryController extends Controller
{
    public function index()
    {
        $inventories = Inventory::with('stockIn.product.category')->get();
        $products = Product::all(); // for Add Stock modal
        return view('admin.inventory', compact('inventories', 'products'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'product_id' => 'required|exists:products,product_id',
            'quantity_on_hand' => 'required|integer|min:1',
        ]);

        $stockIn = StockIn::firstOrCreate(
            ['product_id' => $request->product_id],
            ['transaction_id' => null, 'quantity' => $request->quantity_on_hand]
        );

        Inventory::create([
            'stock_in_id' => $stockIn->stock_in_id,
            'quantity_on_hand' => $request->quantity_on_hand,
            'last_updated' => now(),
        ]);

        return redirect()->route('admin.inventory.index')->with('success', 'Stock added successfully.');
    }

    public function update(Request $request, Inventory $inventory)
    {
        $request->validate([
            'quantity_on_hand' => 'required|integer|min:0',
        ]);

        $inventory->update([
            'quantity_on_hand' => $request->quantity_on_hand,
            'last_updated' => now(),
        ]);

        return redirect()->route('admin.inventory.index')->with('success', 'Stock updated successfully.');
    }
}
