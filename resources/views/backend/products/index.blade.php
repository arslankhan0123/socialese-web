@extends('layouts.backend.main')
@section('title', 'Products')
@section('meta')
<meta name="description" content="Quick News Global AI - Stay informed with AI-powered news summaries in under 9 seconds. Get verified, concise news updates without the noise." />
<meta name="robots" content="index, follow" />
@endsection

@section('content')
<div class="dashboard-main-body">
    <div
        class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Products</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a
                    href="{{route('dashboard')}}"
                    class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon
                        icon="solar:home-smile-angle-outline"
                        class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">Products</li>
        </ul>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(session('error'))
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong> {{ session('error') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if($errors->any())
    <div class="alert alert-danger alert-dismissible fade show" role="alert">
        <strong>Error!</strong>
        <ul class="mb-0">
            @foreach($errors->all() as $error)
            <li>{{ $error }}</li>
            @endforeach
        </ul>
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    <!-- Category Filter -->
    <div class="card mb-3">
        <div class="card-body">
            <div class="row align-items-center">
                <div class="col-md-2">
                    <label for="categoryFilter" class="form-label fw-semibold mb-0">Filter by Category:</label>
                </div>
                <div class="col-md-4">
                    <select id="categoryFilter" class="form-select">
                        <option value="{{route('products.index')}}" {{!$selectedCategory ? 'selected' : ''}}>All Products</option>
                        @foreach($categories as $category)
                        <option value="{{route('products.index', ['category' => $category->id])}}" {{$selectedCategory && $selectedCategory == $category->id ? 'selected' : ''}}>
                            {{$category->name}}
                        </option>
                        @endforeach
                    </select>
                </div>
            </div>
        </div>
    </div>

    <div class="card basic-data-table">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">Products 
                @if($selectedCategory)
                    <small class="text-muted">({{$categories->where('id', $selectedCategory)->first()->name ?? ''}})</small>
                @else
                    <small class="text-muted">(All)</small>
                @endif
            </h5>
            <div class="d-flex align-items-center gap-2">
                <button id="bulkDeleteBtn" onclick="bulkDelete()" class="btn btn-danger fw-semibold px-3 py-2.5 rounded d-inline-flex align-items-center" style="display: none; border: none; white-space: nowrap; box-shadow: 0 4px 6px -1px rgba(220, 53, 69, 0.3); transition: all 0.3s ease; font-size: 15px;">
                    <iconify-icon icon="mingcute:delete-2-line" class="icon me-2" style="font-size: 20px;"></iconify-icon>
                    Delete Selected
                </button>
                <a href="{{route('products.create')}}" class="btn text-white fw-semibold px-3 py-2.5 rounded d-inline-flex align-items-center" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #a855f7 100%); border: none; white-space: nowrap; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3); transition: all 0.3s ease; font-size: 15px;">
                    <iconify-icon icon="solar:add-circle-bold" class="icon me-2" style="font-size: 20px;"></iconify-icon>
                    Create Product
                </a>
            </div>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table
                    class="table bordered-table mb-0"
                    id="dataTable"
                    data-page-length="10">
                    <thead>
                        <tr>
                            <th scope="col">
                                <div
                                    class="form-check style-check d-flex align-items-center">
                                    <input
                                        id="selectAllCheckbox"
                                        class="form-check-input"
                                        type="checkbox" />
                                    <label class="form-check-label">
                                        S.L
                                    </label>
                                </div>
                            </th>
                            <th scope="col">Name</th>
                            <th scope="col">Category</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>
                                <div
                                    class="form-check style-check d-flex align-items-center">
                                    <input
                                        class="form-check-input product-checkbox"
                                        type="checkbox"
                                        data-id="{{$product->id}}" />
                                    <label class="form-check-label">
                                        {{$product->id}}
                                    </label>
                                </div>
                            </td>
                            <td>{{$product->name}}</td>
                            <td>{{$product->category->name ?? 'N/A'}}</td>
                            <td>{{$product->description ?? 'N/A'}}</td>
                            <td>
                                <a
                                    href="{{route('products.edit', $product->id)}}"
                                    class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                    title="Edit">
                                    <iconify-icon
                                        icon="lucide:edit"></iconify-icon>
                                </a>
                                <a
                                    href="{{route('products.delete', $product->id)}}"
                                    class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                    title="Delete"
                                    onclick="return confirm('Are you sure you want to delete this product?');">
                                    <iconify-icon
                                        icon="mingcute:delete-2-line"></iconify-icon>
                                </a>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    <!-- Showing Text and Pagination -->
    <div class="mt-3">
        <div class="d-flex align-items-center position-relative">
            <div class="text-start position-absolute start-0">
                <p class="small text-muted mb-0">
                    Showing
                    <span class="fw-semibold">{{ $products->firstItem() ?? 0 }}</span>
                    to
                    <span class="fw-semibold">{{ $products->lastItem() ?? 0 }}</span>
                    of
                    <span class="fw-semibold">{{ $products->total() }}</span>
                    results
                </p>
            </div>
            @if($products->hasPages())
            <div class="w-100 d-flex justify-content-center">
                {{ $products->links('pagination::bootstrap-5') }}
            </div>
            @endif
        </div>
    </div>
</div>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const selectAllCheckbox = document.getElementById('selectAllCheckbox');
        const productCheckboxes = document.querySelectorAll('.product-checkbox');
        const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');

        // Select All functionality
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                productCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                toggleBulkDeleteButton();
            });
        }

        // Individual checkbox change
        productCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateSelectAllCheckbox();
                toggleBulkDeleteButton();
            });
        });

        // Update select all checkbox based on individual checkboxes
        function updateSelectAllCheckbox() {
            if (selectAllCheckbox && productCheckboxes.length > 0) {
                const allChecked = Array.from(productCheckboxes).every(checkbox => checkbox.checked);
                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = false;
            }
        }

        // Toggle bulk delete button visibility
        function toggleBulkDeleteButton() {
            const checkedBoxes = document.querySelectorAll('.product-checkbox:checked');
            if (bulkDeleteBtn) {
                bulkDeleteBtn.style.display = checkedBoxes.length > 0 ? 'inline-flex' : 'none';
            }
        }
    });

    // Bulk delete function
    function bulkDelete() {
        const checkedBoxes = document.querySelectorAll('.product-checkbox:checked');
        const ids = Array.from(checkedBoxes).map(checkbox => checkbox.getAttribute('data-id'));

        if (ids.length === 0) {
            alert('Please select at least one product to delete.');
            return;
        }

        if (!confirm(`Are you sure you want to delete ${ids.length} product${ids.length > 1 ? 's' : ''}?`)) {
            return;
        }

        // Create a form and submit it
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("products.bulk-delete") }}';

        // Add CSRF token
        const csrfInput = document.createElement('input');
        csrfInput.type = 'hidden';
        csrfInput.name = '_token';
        csrfInput.value = '{{ csrf_token() }}';
        form.appendChild(csrfInput);

        // Add method spoofing for DELETE
        const methodInput = document.createElement('input');
        methodInput.type = 'hidden';
        methodInput.name = '_method';
        methodInput.value = 'DELETE';
        form.appendChild(methodInput);

        // Add IDs
        ids.forEach(id => {
            const idInput = document.createElement('input');
            idInput.type = 'hidden';
            idInput.name = 'ids[]';
            idInput.value = id;
            form.appendChild(idInput);
        });

        document.body.appendChild(form);
        form.submit();
    }

    // Category filter dropdown
    document.addEventListener('DOMContentLoaded', function() {
        const categoryFilter = document.getElementById('categoryFilter');
        if (categoryFilter) {
            categoryFilter.addEventListener('change', function() {
                window.location.href = this.value;
            });
        }
    });
</script>
@endsection