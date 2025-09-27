<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Transaction;
use App\Models\Supplier;
use App\Models\Customer;
use Illuminate\Http\Request;

class TransactionController extends Controller
{
    public function index()
    {
        $transactions = Transaction::with(['supplier'])
            ->orderBy('created_at', 'desc')
            ->get();

        // Calculate stats
        $totalTransactions = $transactions->count();
        $totalAmount = $transactions->sum('overall_total');
        $pendingCount = $transactions->where('status', 'pending')->count();
        $failedCount = $transactions->where('status', 'failed')->count();

        $suppliers = Supplier::all();

        return view('admin.transactions', compact(
            'transactions',
            'totalTransactions',
            'totalAmount',
            'pendingCount',
            'failedCount',
            'suppliers'
        ));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'reference_num' => 'required|unique:transactions',
            'product_name' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'delivery_date' => 'required|date',
            'delivery_fee' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'sub_total' => 'required|numeric|min:0',
            'overall_total' => 'required|numeric|min:0',
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'transaction_type' => 'required|in:sale,refund,payment',
            'status' => 'required|in:completed,pending,failed',
            'payment_method' => 'required|string|max:100',
            'delivery_received' => 'sometimes|boolean'
        ]);

        // Set delivery_received to false if not checked
        $validated['delivery_received'] = $request->has('delivery_received');

        Transaction::create($validated);

        return redirect()->route('admin.transactions')
            ->with('success', 'Transaction created successfully.');
    }

    public function update(Request $request, $id)
    {
        $transaction = Transaction::findOrFail($id);

        $validated = $request->validate([
            'reference_num' => 'required|unique:transactions,reference_num,' . $transaction->transaction_id . ',transaction_id',
            'product_name' => 'required|string|max:255',
            'qty' => 'required|integer|min:1',
            'delivery_date' => 'required|date',
            'delivery_fee' => 'required|numeric|min:0',
            'tax' => 'required|numeric|min:0',
            'sub_total' => 'required|numeric|min:0',
            'overall_total' => 'required|numeric|min:0',
            'supplier_id' => 'required|exists:suppliers,supplier_id',
            'transaction_type' => 'required|in:sale,refund,payment',
            'status' => 'required|in:completed,pending,failed',
            'payment_method' => 'required|string|max:100',
            'delivery_received' => 'sometimes|boolean'
        ]);

        // Set delivery_received to false if not checked
        $validated['delivery_received'] = $request->has('delivery_received');

        $transaction->update($validated);

        return redirect()->route('admin.transactions')
            ->with('success', 'Transaction updated successfully.');
    }

    public function destroy($id)
    {
        $transaction = Transaction::findOrFail($id);
        $transaction->delete();

        return redirect()->route('admin.transactions')
            ->with('success', 'Transaction deleted successfully.');
    }

    public function show($id)
    {
        $transaction = Transaction::with(['supplier'])->findOrFail($id);
        return response()->json($transaction);
    }
}
