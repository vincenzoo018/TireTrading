@extends('layouts.admin.app')

@section('content')
<div class="page-header">
    <h1 class="page-title">Category Management</h1>
    <nav aria-label="breadcrumb">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="{{ route('admin.dashboard') }}">Dashboard</a></li>
            <li class="breadcrumb-item active" aria-current="page">Categories</li>
        </ol>
    </nav>
</div>

@if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <i class="fas fa-check-circle me-2"></i>{{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

@if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <i class="fas fa-exclamation-circle me-2"></i>{{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
@endif

<!-- Stats Cards -->
<div class="stats-container">
    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(74, 144, 226, 0.1); color: var(--primary);">
            <i class="fas fa-tags"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $totalCategories }}</h3>
            <p class="stat-label">Total Categories</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(40, 167, 69, 0.1); color: var(--success);">
            <i class="fas fa-box"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $totalProducts }}</h3>
            <p class="stat-label">Total Products</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(255, 193, 7, 0.1); color: var(--warning);">
            <i class="fas fa-layer-group"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $categoriesWithProducts }}</h3>
            <p class="stat-label">Active Categories</p>
        </div>
    </div>

    <div class="stat-card">
        <div class="stat-icon" style="background-color: rgba(108, 117, 125, 0.1); color: var(--secondary);">
            <i class="fas fa-folder"></i>
        </div>
        <div class="stat-content">
            <h3 class="stat-value">{{ $emptyCategories }}</h3>
            <p class="stat-label">Empty Categories</p>
        </div>
    </div>
</div>

<!-- Add Category Form -->
<div class="card mb-4">
    <div class="card-header">
        <i class="fas fa-plus-circle me-2"></i>Add New Category
    </div>
    <div class="card-body">
        <form action="{{ route('admin.categories.store') }}" method="POST">
            @csrf
            <div class="row">
                <div class="col-md-8">
                    <label for="categoryName" class="form-label">Category Name *</label>
                    <input type="text" class="form-control" id="categoryName" name="category_name"
                           placeholder="Enter category name" required>
                    @error('category_name')
                        <div class="text-danger small mt-1">{{ $message }}</div>
                    @enderror
                </div>
                <div class="col-md-4 d-flex align-items-end">
                    <button type="submit" class="btn btn-primary w-100">
                        <i class="fas fa-save me-2"></i>Add Category
                    </button>
                </div>
            </div>
        </form>
    </div>
</div>

<!-- Categories Table -->
<div class="card">
    <div class="card-header">
        <i class="fas fa-list me-2"></i>Category List
    </div>
    <div class="card-body">
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Category Name</th>
                        <th>Number of Products</th>
                        <th>Created Date</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($categories as $category)
                    <tr>
                        <td>{{ $loop->iteration }}</td>
                        <td>
                            <strong>{{ $category->category_name }}</strong>
                        </td>
                        <td>
                            <span class="badge bg-primary">{{ $category->products_count }} products</span>
                        </td>
                        <td>{{ $category->created_at->format('M d, Y') }}</td>
                        <td>
                            @if($category->products_count > 0)
                                <span class="badge bg-success">Active</span>
                            @else
                                <span class="badge bg-secondary">Empty</span>
                            @endif
                        </td>
                        <td>
                            <button class="btn btn-sm btn-primary action-btn edit-category"
                                    data-id="{{ $category->category_id }}"
                                    data-name="{{ $category->category_name }}"
                                    data-bs-toggle="tooltip" title="Edit Category">
                                <i class="fas fa-edit"></i>
                            </button>
                            <form action="{{ route('admin.categories.delete', $category->category_id) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-sm btn-danger action-btn"
                                        data-bs-toggle="tooltip" title="Delete Category"
                                        onclick="return confirm('Are you sure you want to delete this category?')">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </form>
                            @if($category->products_count > 0)
                                <a href="{{ route('admin.product', ['category' => $category->category_id]) }}"
                                   class="btn btn-sm btn-info action-btn" data-bs-toggle="tooltip" title="View Products">
                                    <i class="fas fa-eye"></i>
                                </a>
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        @if($categories->isEmpty())
        <div class="text-center py-4">
            <i class="fas fa-tags fa-3x text-muted mb-3"></i>
            <p class="text-muted">No categories found. Create your first category above.</p>
        </div>
        @endif
    </div>
</div>

<!-- Edit Category Modal -->
<div class="modal fade" id="editCategoryModal" tabindex="-1" aria-labelledby="editCategoryModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="editCategoryModalLabel">Edit Category</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form id="editCategoryForm" method="POST">
                @csrf
                @method('PUT')
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="editCategoryName" class="form-label">Category Name</label>
                        <input type="text" class="form-control" id="editCategoryName" name="category_name" required>
                        @error('category_name')
                            <div class="text-danger small mt-1">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="submit" class="btn btn-primary">Update Category</button>
                </div>
            </form>
        </div>
    </div>
</div>

<style>
    .action-btn {
        margin: 0 2px;
    }
</style>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Edit Category Modal
        const editCategoryButtons = document.querySelectorAll('.edit-category');
        const editCategoryModal = new bootstrap.Modal(document.getElementById('editCategoryModal'));
        const editCategoryForm = document.getElementById('editCategoryForm');

        editCategoryButtons.forEach(button => {
            button.addEventListener('click', function() {
                const categoryId = this.getAttribute('data-id');
                const categoryName = this.getAttribute('data-name');

                document.getElementById('editCategoryName').value = categoryName;
                editCategoryForm.action = `/admin/categories/${categoryId}`;
                editCategoryModal.show();
            });
        });
    });
</script>
@endsection
