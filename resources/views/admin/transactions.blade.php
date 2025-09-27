@extends('layouts.admin.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">Transaction Management</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Transactions</li>
        </ol>
    </nav>
</div>

<!-- Stats Cards -->
<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(74, 144, 226, 0.1); color: var(--primary);">
            <i class="fas fa-exchange-alt"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $totalTransactions }}</h3>
            <p class="stat-label">Total Transactions</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">P{{ number_format($totalAmount, 2) }}</h3>
            <p class="stat-label">Total Amount</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning);">
            <i class="fas fa-clock"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $pendingCount }}</h3>
            <p class="stat-label">Pending</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.1); color: var(--danger);">
            <i class="fas fa-times-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $failedCount }}</h3>
            <p class="stat-label">Failed</p>
        </div>
    </div>
</div>

<!-- Add Transaction Modal -->
<div class="modal fade" id="addTransactionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="transactionForm" action="{{ route('admin.transactions.store') }}" method="POST">
                @csrf
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="reference_num" class="form-label">Reference Number *</label>
                                <input type="text" class="form-control" id="reference_num" name="reference_num" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="product_name" class="form-label">Product Name *</label>
                                <input type="text" class="form-control" id="product_name" name="product_name" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="qty" class="form-label">Quantity *</label>
                                <input type="number" class="form-control" id="qty" name="qty" value="1" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="transaction_type" class="form-label">Type *</label>
                                <select class="form-select" id="transaction_type" name="transaction_type" required>
                                    <option value="sale">Sale</option>
                                    <option value="refund">Refund</option>
                                    <option value="payment">Payment</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="status" class="form-label">Status *</label>
                                <select class="form-select" id="status" name="status" required>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                    <option value="failed">Failed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="supplier_id" class="form-label">Supplier *</label>
                                <select class="form-select" id="supplier_id" name="supplier_id" required>
                                    <option value="">Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->supplier_id }}">{{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="payment_method" class="form-label">Payment Method *</label>
                                <select class="form-select" id="payment_method" name="payment_method" required>
                                    <option value="Cash">Cash</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="Check">Check</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="delivery_date" class="form-label">Delivery Date *</label>
                                <input type="date" class="form-control" id="delivery_date" name="delivery_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Delivery Status</label>
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="delivery_received" name="delivery_received" value="1">
                                    <label class="form-check-label" for="delivery_received">Delivery Received</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="delivery_fee" class="form-label">Delivery Fee *</label>
                                <input type="number" step="0.01" class="form-control" id="delivery_fee" name="delivery_fee" value="0" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="tax" class="form-label">Tax *</label>
                                <input type="number" step="0.01" class="form-control" id="tax" name="tax" value="0" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="sub_total" class="form-label">Sub Total *</label>
                                <input type="number" step="0.01" class="form-control" id="sub_total" name="sub_total" value="0" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="overall_total" class="form-label">Overall Total *</label>
                                <input type="number" step="0.01" class="form-control" id="overall_total" name="overall_total" value="0" min="0" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Save Transaction</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Edit Transaction Modal -->
<div class="modal fade" id="editTransactionModal" tabindex="-1" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Transaction</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editTransactionForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_reference_num" class="form-label">Reference Number *</label>
                                <input type="text" class="form-control" id="edit_reference_num" name="reference_num" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_product_name" class="form-label">Product Name *</label>
                                <input type="text" class="form-control" id="edit_product_name" name="product_name" required>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_qty" class="form-label">Quantity *</label>
                                <input type="number" class="form-control" id="edit_qty" name="qty" min="1" required>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_transaction_type" class="form-label">Type *</label>
                                <select class="form-select" id="edit_transaction_type" name="transaction_type" required>
                                    <option value="sale">Sale</option>
                                    <option value="refund">Refund</option>
                                    <option value="payment">Payment</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-4">
                            <div class="mb-3">
                                <label for="edit_status" class="form-label">Status *</label>
                                <select class="form-select" id="edit_status" name="status" required>
                                    <option value="pending">Pending</option>
                                    <option value="completed">Completed</option>
                                    <option value="failed">Failed</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_supplier_id" class="form-label">Supplier *</label>
                                <select class="form-select" id="edit_supplier_id" name="supplier_id" required>
                                    <option value="">Select Supplier</option>
                                    @foreach($suppliers as $supplier)
                                        <option value="{{ $supplier->supplier_id }}">{{ $supplier->supplier_name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_payment_method" class="form-label">Payment Method *</label>
                                <select class="form-select" id="edit_payment_method" name="payment_method" required>
                                    <option value="Cash">Cash</option>
                                    <option value="Credit Card">Credit Card</option>
                                    <option value="Bank Transfer">Bank Transfer</option>
                                    <option value="Check">Check</option>
                                </select>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label for="edit_delivery_date" class="form-label">Delivery Date *</label>
                                <input type="date" class="form-control" id="edit_delivery_date" name="delivery_date" required>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="mb-3">
                                <label class="form-label">Delivery Status</label>
                                <div class="form-check mt-2">
                                    <input type="checkbox" class="form-check-input" id="edit_delivery_received" name="delivery_received" value="1">
                                    <label class="form-check-label" for="edit_delivery_received">Delivery Received</label>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="edit_delivery_fee" class="form-label">Delivery Fee *</label>
                                <input type="number" step="0.01" class="form-control" id="edit_delivery_fee" name="delivery_fee" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="edit_tax" class="form-label">Tax *</label>
                                <input type="number" step="0.01" class="form-control" id="edit_tax" name="tax" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="edit_sub_total" class="form-label">Sub Total *</label>
                                <input type="number" step="0.01" class="form-control" id="edit_sub_total" name="sub_total" min="0" required>
                            </div>
                        </div>
                        <div class="col-md-3">
                            <div class="mb-3">
                                <label for="edit_overall_total" class="form-label">Overall Total *</label>
                                <input type="number" step="0.01" class="form-control" id="edit_overall_total" name="overall_total" min="0" required>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Transaction</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Transactions Table -->
<div class="card">
    <div class="card-header">
        <i class="fas fa-list me-2"></i>Transaction List
        <button class="btn btn-primary btn-sm float-end" data-bs-toggle="modal" data-bs-target="#addTransactionModal">
            <i class="fas fa-plus me-2"></i>Add New Transaction
        </button>
    </div>
    <div class="card-body">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @if($errors->any())
            <div class="alert alert-danger alert-dismissible fade show" role="alert">
                <ul class="mb-0">
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        <div class="table-container">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Transaction ID</th>
                        <th>Date</th>
                        <th>Supplier</th>
                        <th>Product</th>
                        <th>Qty</th>
                        <th>Type</th>
                        <th>Amount</th>
                        <th>Payment Method</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($transactions as $transaction)
                    <tr>
                        <td>#{{ $transaction->reference_num }}</td>
                        <td>{{ $transaction->created_at->format('M j, Y') }}</td>
                        <td>{{ $transaction->supplier->supplier_name ?? 'N/A' }}</td>
                        <td>{{ $transaction->product_name }}</td>
                        <td>{{ $transaction->qty }}</td>
                        <td>{!! $transaction->type_badge !!}</td>
                        <td>P{{ number_format($transaction->overall_total, 2) }}</td>
                        <td>{{ $transaction->payment_method }}</td>
                        <td>{!! $transaction->status_badge !!}</td>
                        <td>
                            <button class="btn btn-sm btn-info action-btn view-btn"
                                    title="View"
                                    data-id="{{ $transaction->transaction_id }}">
                                <i class="fas fa-eye"></i>
                            </button>
                            <button class="btn btn-sm btn-warning action-btn edit-btn"
                                    title="Edit"
                                    data-id="{{ $transaction->transaction_id }}"
                                    data-bs-toggle="modal"
                                    data-bs-target="#editTransactionModal">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.transactions.destroy', $transaction->transaction_id) }}"
                                  method="POST" style="display: inline-block;">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger action-btn" title="Delete"
                                        onclick="return confirm('Are you sure you want to delete this transaction?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Edit transaction functionality
    const editButtons = document.querySelectorAll('.edit-btn');

    editButtons.forEach(button => {
        button.addEventListener('click', function() {
            const transactionId = this.getAttribute('data-id');

            fetch(`/admin/transactions/${transactionId}`)
                .then(response => response.json())
                .then(transaction => {
                    // Populate the edit form with transaction data
                    document.getElementById('edit_reference_num').value = transaction.reference_num;
                    document.getElementById('edit_product_name').value = transaction.product_name;
                    document.getElementById('edit_qty').value = transaction.qty;
                    document.getElementById('edit_transaction_type').value = transaction.transaction_type;
                    document.getElementById('edit_status').value = transaction.status;
                    document.getElementById('edit_supplier_id').value = transaction.supplier_id;
                    document.getElementById('edit_payment_method').value = transaction.payment_method;
                    document.getElementById('edit_delivery_date').value = transaction.delivery_date;
                    document.getElementById('edit_delivery_fee').value = transaction.delivery_fee;
                    document.getElementById('edit_tax').value = transaction.tax;
                    document.getElementById('edit_sub_total').value = transaction.sub_total;
                    document.getElementById('edit_overall_total').value = transaction.overall_total;
                    document.getElementById('edit_delivery_received').checked = transaction.delivery_received;

                    // Update form action
                    document.getElementById('editTransactionForm').action = `/admin/transactions/${transactionId}`;
                })
                .catch(error => {
                    console.error('Error fetching transaction:', error);
                    alert('Error loading transaction data');
                });
        });
    });

    // Set today's date as default for delivery date
    const today = new Date().toISOString().split('T')[0];
    document.getElementById('delivery_date').value = today;
    document.getElementById('edit_delivery_date').value = today;

    // Auto-calculate overall total when sub_total, tax, or delivery_fee changes
    function calculateOverallTotal() {
        const subTotal = parseFloat(document.getElementById('sub_total').value) || 0;
        const tax = parseFloat(document.getElementById('tax').value) || 0;
        const deliveryFee = parseFloat(document.getElementById('delivery_fee').value) || 0;
        const overallTotal = subTotal + tax + deliveryFee;
        document.getElementById('overall_total').value = overallTotal.toFixed(2);
    }

    // Add event listeners for auto-calculation
    document.getElementById('sub_total')?.addEventListener('input', calculateOverallTotal);
    document.getElementById('tax')?.addEventListener('input', calculateOverallTotal);
    document.getElementById('delivery_fee')?.addEventListener('input', calculateOverallTotal);

    // Similar for edit form
    function calculateEditOverallTotal() {
        const subTotal = parseFloat(document.getElementById('edit_sub_total').value) || 0;
        const tax = parseFloat(document.getElementById('edit_tax').value) || 0;
        const deliveryFee = parseFloat(document.getElementById('edit_delivery_fee').value) || 0;
        const overallTotal = subTotal + tax + deliveryFee;
        document.getElementById('edit_overall_total').value = overallTotal.toFixed(2);
    }

    document.getElementById('edit_sub_total')?.addEventListener('input', calculateEditOverallTotal);
    document.getElementById('edit_tax')?.addEventListener('input', calculateEditOverallTotal);
    document.getElementById('edit_delivery_fee')?.addEventListener('input', calculateEditOverallTotal);
});
</script>
@endsection
