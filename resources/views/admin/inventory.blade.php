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

{{-- Flash Message --}}
@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

{{-- Stats Cards --}}
@php
    $totalItems = $inventories->sum('quantity_on_hand');
    $totalValue = $inventories->reduce(function ($carry, $item) {
        $price = $item->stockIn->product->selling_price ?? 0;
        return $carry + ($item->quantity_on_hand * $price);
    }, 0);

    $lowStockCount = $inventories->filter(fn($inv) => $inv->quantity_on_hand > 0 && $inv->quantity_on_hand < 15)->count();
    $outOfStockCount = $inventories->filter(fn($inv) => $inv->quantity_on_hand == 0)->count();
@endphp

<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(74, 144, 226, 0.1); color: var(--primary);">
            <i class="fas fa-boxes"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $totalItems }}</h3>
            <p class="stat-label">Total Items</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success);">
            <i class="fas fa-check-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">P{{ number_format($totalValue, 2) }}</h3>
            <p class="stat-label">Inventory Value</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning);">
            <i class="fas fa-exclamation-triangle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $lowStockCount }}</h3>
            <p class="stat-label">Low Stock Items</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(220, 53, 69, 0.1); color: var(--danger);">
            <i class="fas fa-times-circle"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $outOfStockCount }}</h3>
            <p class="stat-label">Out of Stock</p>
        </div>
    </div>
</div>

{{-- Action Buttons --}}
<div class="row mb-4">
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-plus-circle fa-3x text-primary mb-3"></i>
                <h5>Add Stock</h5>
                <p class="text-muted">Add new inventory items</p>
                <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addStockModal">
                    Add Now
                </button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        {{-- You could optionally also open the update modal from here if desired --}}
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-sync-alt fa-3x text-success mb-3"></i>
                <h5>Update Stock</h5>
                <p class="text-muted">Use the Edit button in the list below</p>
                <button class="btn btn-success" disabled>Use Edit Below</button>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-body text-center">
                <i class="fas fa-file-export fa-3x text-info mb-3"></i>
                <h5>Export Data</h5>
                <p class="text-muted">Export inventory reports</p>
                <button class="btn btn-info" disabled>Coming Soon</button>
            </div>
        </div>
    </div>
</div>

{{-- Inventory Table --}}
<div class="card">
    <div class="card-header">
        <i class="fas fa-list me-2"></i>Inventory List
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
    <tr>
        <th>#</th>
        <th>Product</th>
        <th>Brand</th>
        <th>Size</th>
        <th>Length</th>
        <th>Width</th>
        <th>Description</th>
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
            <td>{{ $product->brand ?? '-' }}</td>
            <td>{{ $product->size ?? '-' }}</td>
            <td>{{ $product->length ?? '-' }}</td>
            <td>{{ $product->width ?? '-' }}</td>
            <td>{{ $product->description ?? '-' }}</td>
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
</div>

{{-- Add Stock Modal --}}
<div class="modal fade" id="addStockModal" tabindex="-1" aria-labelledby="addStockModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <form action="{{ route('admin.inventory.store') }}" method="POST">
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
                                <option value="{{ $product->product_id }}">
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
                    <button type="submit" class="btn btn-primary">Add Stock</button>
                </div>
            </div>
        </form>
    </div>
</div>

{{-- Update Stock Modal --}}
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

{{-- JS to bind update modal --}}
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // For each edit button, open update modal and set form action & existing value
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
