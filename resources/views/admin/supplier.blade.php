@extends('layouts.admin.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">Manage Suppliers</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Suppliers</li>
        </ol>
    </nav>
</div>

@if(session('success'))
<div class="alert alert-success">{{ session('success') }}</div>
@endif

<!-- Add New Supplier Button -->
<div class="mb-3 text-end">
    <button class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#addSupplierModal">
        <i class="fas fa-plus-circle"></i> Add New Supplier
    </button>
</div>

<!-- Suppliers Table -->
<div class="card">
    <div class="card-header">
        <i class="fas fa-list me-2"></i>Supplier List
    </div>
    <div class="card-body">
        <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Company</th>
                    <th>Contact Person</th>
                    <th>Address</th>
                    <th>Email</th>
                    <th>P_Term</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($suppliers as $supplier)
                <tr>
                    <td>{{ $loop->iteration }}</td>
                    <td>{{ $supplier->supplier_name }}</td>
                    <td>{{ $supplier->contact_person }}</td>
                    <td>{{ $supplier->address }}</td>
                    <td>{{ $supplier->email }}</td>
                    <td><span class="badge bg-info">{{ $supplier->payment_terms }}</span></td>
                    <td>
                        <button
                            class="btn btn-sm btn-primary edit-btn"
                            data-id="{{ $supplier->supplier_id }}"
                            data-name="{{ $supplier->supplier_name }}"
                            data-contact_person="{{ $supplier->contact_person }}"
                            data-address="{{ $supplier->address }}"
                            data-contact_number="{{ $supplier->contact_number }}"
                            data-email="{{ $supplier->email }}"
                            data-payment_terms="{{ $supplier->payment_terms }}"
                            data-bs-toggle="modal"
                            data-bs-target="#editSupplierModal"
                            title="Edit"
                        >
                            <i class="fas fa-edit"></i>
                        </button>

                        <form action="{{ route('admin.supplier.destroy', $supplier->supplier_id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete this supplier?');">
                            @csrf
                            @method('DELETE')
                            <button class="btn btn-sm btn-danger" title="Delete">
                                <i class="fas fa-trash"></i>
                            </button>
                        </form>
                    </td>
                </tr>
                @empty
                <tr><td colspan="7" class="text-center">No suppliers found.</td></tr>
                @endforelse
            </tbody>
        </table>
        </div>
    </div>
</div>

<!-- Add Supplier Modal -->
<div class="modal fade" id="addSupplierModal" tabindex="-1" aria-labelledby="addSupplierLabel" aria-hidden="true">
  <div class="modal-dialog">
    <!-- Add Supplier Form -->
<form method="POST" action="{{ route('admin.supplier.store') }}">
    @csrf
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Add New Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form fields -->
                <div class="mb-3">
                    <label for="supplier_name" class="form-label">Company Name</label>
                    <input type="text" name="supplier_name" id="supplier_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="contact_person" class="form-label">Contact Person</label>
                    <input type="text" name="contact_person" id="contact_person" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="address" class="form-label">Address</label>
                    <textarea name="address" id="address" class="form-control" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="contact_number" class="form-label">Phone</label>
                    <input type="tel" name="contact_number" id="contact_number" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label">Email</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="payment_terms" class="form-label">Payment Terms</label>
                    <select name="payment_terms" id="payment_terms" class="form-select" required>
                        <option value="">Select Payment Terms</option>
                        <option value="Net 15">Net 15</option>
                        <option value="Net 30">Net 30</option>
                        <option value="Net 60">Net 60</option>
                        <option value="COD">COD</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Add Supplier</button>
            </div>
        </div>
    </form>
  </div>
</div>

<!-- Edit Supplier Modal -->
<div class="modal fade" id="editSupplierModal" tabindex="-1" aria-labelledby="editSupplierLabel" aria-hidden="true">
  <div class="modal-dialog">
    <form method="POST" id="editSupplierForm">
        @csrf
        @method('PUT')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit Supplier</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <!-- Form fields -->
                <div class="mb-3">
                    <label for="edit_supplier_name" class="form-label">Company Name</label>
                    <input type="text" name="supplier_name" id="edit_supplier_name" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="edit_contact_person" class="form-label">Contact Person</label>
                    <input type="text" name="contact_person" id="edit_contact_person" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="edit_address" class="form-label">Address</label>
                    <textarea name="address" id="edit_address" class="form-control" rows="2" required></textarea>
                </div>
                <div class="mb-3">
                    <label for="edit_contact_number" class="form-label">Phone</label>
                    <input type="tel" name="contact_number" id="edit_contact_number" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="edit_email" class="form-label">Email</label>
                    <input type="email" name="email" id="edit_email" class="form-control" required>
                </div>
                <div class="mb-3">
                    <label for="edit_payment_terms" class="form-label">Payment Terms</label>
                    <select name="payment_terms" id="edit_payment_terms" class="form-select" required>
                        <option value="">Select Payment Terms</option>
                        <option value="Net 15">Net 15</option>
                        <option value="Net 30">Net 30</option>
                        <option value="Net 60">Net 60</option>
                        <option value="COD">COD</option>
                    </select>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                <button type="submit" class="btn btn-primary">Update Supplier</button>
            </div>
        </div>
    </form>
  </div>
</div>

@endsection

@section('scripts')
<script>
document.addEventListener('DOMContentLoaded', function () {
    const editButtons = document.querySelectorAll('.edit-btn');
    const editForm = document.getElementById('editSupplierForm');

    editButtons.forEach(btn => {
        btn.addEventListener('click', () => {
            const id = btn.getAttribute('data-id');
            const name = btn.getAttribute('data-name');
            const contact_person = btn.getAttribute('data-contact_person');
            const address = btn.getAttribute('data-address');
            const contact_number = btn.getAttribute('data-contact_number');
            const email = btn.getAttribute('data-email');
            const payment_terms = btn.getAttribute('data-payment_terms');

            editForm.action = `/admin/suppliers/${id}`;
            document.getElementById('edit_supplier_name').value = name;
            document.getElementById('edit_contact_person').value = contact_person;
            document.getElementById('edit_address').value = address;
            document.getElementById('edit_contact_number').value = contact_number;
            document.getElementById('edit_email').value = email;
            document.getElementById('edit_payment_terms').value = payment_terms;
        });
    });
});
</script>
@endsection
