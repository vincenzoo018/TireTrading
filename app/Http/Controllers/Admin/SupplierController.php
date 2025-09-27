<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Supplier;

class SupplierController extends Controller
{
    public function index()
    {
        $suppliers = Supplier::all();
        // Make sure the view path matches your actual view file location
        // If your view is at resources/views/admin/supplier.blade.php
        return view('admin.supplier', compact('suppliers')); // Correct variable name

        // If your view is at resources/views/admin/suppliers/index.blade.php
        // return view('admin.suppliers.index', compact('suppliers'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'payment_terms' => 'required|string',
        ]);

        Supplier::create($request->all());

        return redirect()->route('admin.supplier.index')->with('success', 'Supplier added successfully.');
    }

    public function update(Request $request, $id)
    {
        $supplier = Supplier::findOrFail($id);

        $request->validate([
            'supplier_name' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'address' => 'required|string',
            'contact_number' => 'required|string|max:20',
            'email' => 'required|email|max:255',
            'payment_terms' => 'required|string',
        ]);

        $supplier->update($request->all());

        return redirect()->route('admin.supplier.index')->with('success', 'Supplier updated successfully.');
    }

    public function destroy($id)
    {
        $supplier = Supplier::findOrFail($id);
        $supplier->delete();

        return redirect()->route('admin.supplier.index')->with('success', 'Supplier deleted successfully.');
    }
}