@extends('layouts.admin.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">Inventory Management</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Inventory</li>
        </ol>
    </nav>
</div>

@if(session('success'))
<div class="alert alert-success alert-dismissible fade show" role="alert">
    {{ session('success') }}
    <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
</div>
@endif

{{-- Main Inventory Table --}}
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-list me-2"></i>Inventory List
    </div>
    <div class="card-body table-responsive">
        <table class="table table-hover align-middle">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Product Name</th>
                    <th>Description</th>
                    <th>Brand</th>
                    <th>Length</th>
                    <th>Width</th>
                    <th>Size</th>
                    <th>Category</th>
                    <th>Current Stock</th>
                    <th>Price</th>
                    <th>Value</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @foreach($inventories as $index => $inventory)
                    @php
                        $product = $inventory->stockIn->product ?? null;
                        $category = $product?->category?->category_name ?? 'N/A';
                        $stock = $inventory->quantity_on_hand;
                        $price = $product?->selling_price ?? 0;
                        $value = $stock * $price;
                        $status = $stock == 0
                            ? 'Out of Stock'
                            : ($stock < 15 ? 'Low Stock' : 'In Stock');
                    @endphp
                    <tr>
                        <td>{{ $index + 1 }}</td>
                        <td>{{ $product->product_name ?? '-' }}</td>
                        <td>{{ $product->description ?? '-' }}</td>
                        <td>{{ $product->brand ?? '-' }}</td>
                        <td>{{ $product->length ?? '-' }}</td>
                        <td>{{ $product->width ?? '-' }}</td>
                        <td>{{ $product->size ?? '-' }}</td>
                        <td>{{ $category }}</td>
                        <td>{{ $stock }}</td>
                        <td>P{{ number_format($price, 2) }}</td>
                        <td>P{{ number_format($value, 2) }}</td>
                        <td>
                            <span class="badge bg-{{ $status == 'Out of Stock' ? 'danger' : ($status == 'Low Stock' ? 'warning text-dark' : 'success') }}">
                                {{ $status }}
                            </span>
                        </td>
                        <td>
                            <button
                                class="btn btn-sm btn-primary edit-stock-btn"
                                data-id="{{ $inventory->inventory_id }}"
                                data-stock="{{ $stock }}"
                            >
                                <i class="fas fa-edit"></i>
                            </button>
                        </td>
                    </tr>
                @endforeach
                @if($inventories->isEmpty())
                    <tr>
                        <td colspan="13" class="text-center">No inventory records found.</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
</div>

{{-- Add Stock Button --}}
<div class="mb-4 d-flex justify-content-start gap-3">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStockModal">
        <i class="fas fa-plus-circle me-1"></i> Add Stock
    </button>
</div>

{{-- Pending Additions & Save All Form --}}
<form id="saveAllForm" method="POST" action="{{ route('admin.inventory.batchStore') }}">
    @csrf
    <div class="card mb-4" id="pendingAdditionsCard" style="display:none;">
        <div class="card-header d-flex justify-content-between align-items-center">
            <h5 class="mb-0">Pending Stock Additions</h5>
            <button type="submit" class="btn btn-success btn-sm" id="saveAllBtn" disabled>
                <i class="fas fa-save me-1"></i> Save All
            </button>
        </div>
        <div class="card-body table-responsive">
            <table class="table table-bordered align-middle" id="pendingAdditionsTable">
                <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>Product Name</th>
                        <th>Description</th>
                        <th>Brand</th>
                        <th>Length</th>
                        <th>Width</th>
                        <th>Size</th>
                        <th>Quantity</th>
                        <th>Remove</th>
                    </tr>
                </thead>
                <tbody>
                    {{-- JS will fill this --}}
                </tbody>
            </table>
        </div>
    </div>
</form>

{{-- Add Stock Modal --}}
<div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="addStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="addStockForm">
            @csrf
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="addStockModalLabel">Add Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="product_id_add" class="form-label">Product</label>
                        <select name="product_id" id="product_id_add" class="form-select" required>
                            <option value="">-- Select Product --</option>
                            @foreach($products as $product)
                                <option
                                    value="{{ $product->product_id }}"
                                    data-description="{{ $product->description }}"
                                    data-brand="{{ $product->brand }}"
                                    data-length="{{ $product->length }}"
                                    data-width="{{ $product->width }}"
                                    data-size="{{ $product->size }}"
                                >
                                    {{ $product->product_name }}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="quantity_on_hand_add" class="form-label">Quantity</label>
                        <input
                            type="number"
                            name="quantity_on_hand"
                            id="quantity_on_hand_add"
                            class="form-control"
                            required
                            min="1"
                        >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Add to List</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Update Stock Modal (optional, your existing) --}}
<div class="modal fade" id="updateStockModal" tabindex="-1" aria-labelledby="updateStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form id="updateStockForm" method="POST">
            @csrf
            @method('PUT')
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="updateStockModalLabel">Update Stock</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="edit_quantity" class="form-label">Quantity</label>
                        <input
                            type="number"
                            name="quantity_on_hand"
                            id="edit_quantity"
                            class="form-control"
                            required
                            min="0"
                        >
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-success">Update Stock</button>
                </div>
            </div>
        </form>
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const addStockForm = document.getElementById('addStockForm');
    const pendingAdditionsCard = document.getElementById('pendingAdditionsCard');
    const pendingAdditionsTableBody = document.querySelector('#pendingAdditionsTable tbody');
    const saveAllBtn = document.getElementById('saveAllBtn');
    const productSelect = document.getElementById('product_id_add');
    const quantityInput = document.getElementById('quantity_on_hand_add');

    let pendingAdditions = [];

    addStockForm.addEventListener('submit', function (e) {
        e.preventDefault();

        const selectedOption = productSelect.options[productSelect.selectedIndex];
        const productId = productSelect.value;
        if (!productId) {
            alert('Please select a product.');
            return;
        }
        const productName = selectedOption.text;
        const description = selectedOption.getAttribute('data-description') || '-';
        const brand = selectedOption.getAttribute('data-brand') || '-';
        const length = selectedOption.getAttribute('data-length') || '-';
        const width = selectedOption.getAttribute('data-width') || '-';
        const size = selectedOption.getAttribute('data-size') || '-';
        const quantity = quantityInput.value;

        if (!quantity || quantity < 1) {
            alert('Please enter a valid quantity.');
            return;
        }

        // Check if product already added, increment quantity if yes
        const existsIndex = pendingAdditions.findIndex(item => item.product_id == productId);
        if (existsIndex !== -1) {
            pendingAdditions[existsIndex].quantity += parseInt(quantity);
        } else {
            pendingAdditions.push({
                product_id: productId,
                product_name: productName,
                description,
                brand,
                length,
                width,
                size,
                quantity: parseInt(quantity),
            });
        }

        renderPendingAdditions();

        addStockForm.reset();

        // Close modal
        const modalEl = document.getElementById('addStockModal');
        const modal = bootstrap.Modal.getInstance(modalEl);
        modal.hide();
    });

    function renderPendingAdditions() {
        pendingAdditionsTableBody.innerHTML = '';

        if (pendingAdditions.length === 0) {
            pendingAdditionsCard.style.display = 'none';
            saveAllBtn.disabled = true;
            return;
        }

        pendingAdditionsCard.style.display = 'block';
        saveAllBtn.disabled = false;

        pendingAdditions.forEach((item, idx) => {
            const tr = document.createElement('tr');
            tr.innerHTML = `
                <td>${idx + 1}</td>
                <td>${item.product_name}</td>
                <td>${item.description}</td>
                <td>${item.brand}</td>
                <td>${item.length}</td>
                <td>${item.width}</td>
                <td>${item.size}</td>
                <td>${item.quantity}</td>
                <td>
                    <button type="button" class="btn btn-danger btn-sm btn-remove" data-index="${idx}">
                        <i class="fas fa-trash"></i>
                    </button>
                </td>
                <input type="hidden" name="products[${idx}][product_id]" value="${item.product_id}">
                <input type="hidden" name="products[${idx}][quantity_on_hand]" value="${item.quantity}">
            `;
            pendingAdditionsTableBody.appendChild(tr);
        });

        // Remove button handler
        document.querySelectorAll('.btn-remove').forEach(button => {
            button.addEventListener('click', function () {
                const idx = parseInt(this.getAttribute('data-index'));
                pendingAdditions.splice(idx, 1);
                renderPendingAdditions();
            });
        });
    }

    // Existing update stock button functionality (optional)
    document.querySelectorAll('.edit-stock-btn').forEach(button => {
        button.addEventListener('click', function () {
            const inventoryId = this.getAttribute('data-id');
            const stock = this.getAttribute('data-stock');

            const form = document.getElementById('updateStockForm');
            form.action = `/admin/inventory/${inventoryId}/update`;

            const input = document.getElementById('edit_quantity');
            input.value = stock;

            const modal = new bootstrap.Modal(document.getElementById('updateStockModal'));
            modal.show();
        });
    });
});
</script>
@endsection
