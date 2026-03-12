@extends('layouts.backend.main')
@section('title', 'Product Categories')
@section('meta')
<meta name="description" content="Quick News Global AI - Stay informed with AI-powered news summaries in under 9 seconds. Get verified, concise news updates without the noise." />
<meta name="robots" content="index, follow" />
@endsection

@section('content')
<div class="dashboard-main-body">
    <div
        class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Product Categories</h6>
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
            <li class="fw-medium">Product Categories</li>
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

    <div class="card basic-data-table">
        <div class="card-header d-flex align-items-center justify-content-between">
            <h5 class="card-title mb-0">Product Categories</h5>
            <div class="d-flex align-items-center gap-2">
                <button id="bulkDeleteBtn" onclick="bulkDelete()" class="btn btn-danger fw-semibold px-3 py-2.5 rounded d-inline-flex align-items-center" style="display: none; border: none; white-space: nowrap; box-shadow: 0 4px 6px -1px rgba(220, 53, 69, 0.3); transition: all 0.3s ease; font-size: 15px;">
                    <iconify-icon icon="mingcute:delete-2-line" class="icon me-2" style="font-size: 20px;"></iconify-icon>
                    Delete Selected
                </button>
                <a href="{{route('categories.create')}}" class="btn text-white fw-semibold px-3 py-2.5 rounded d-inline-flex align-items-center" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #a855f7 100%); border: none; white-space: nowrap; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3); transition: all 0.3s ease; font-size: 15px;">
                    <iconify-icon icon="solar:add-circle-bold" class="icon me-2" style="font-size: 20px;"></iconify-icon>
                    Create Category
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
                            <th scope="col" style="width: 50px;">
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
                            <th scope="col" style="width: 50px;">Order</th>
                            <th scope="col">Name</th>
                            <th scope="col">Description</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody id="sortable-categories">
                        @foreach ($productCategories as $productCategory)
                        <tr data-id="{{$productCategory->id}}" style="cursor: move;">
                            <td>
                                <div
                                    class="form-check style-check d-flex align-items-center">
                                    <input
                                        class="form-check-input category-checkbox"
                                        type="checkbox"
                                        data-id="{{$productCategory->id}}" />
                                    <label class="form-check-label">
                                        {{$productCategory->order}}
                                    </label>
                                </div>
                            </td>
                            <td>
                                <iconify-icon
                                    icon="solar:sort-by-alphabet-bold"
                                    class="icon text-lg"
                                    style="cursor: move; color: #6c757d;"></iconify-icon>
                            </td>
                            <!-- <td>
                            <div class="d-flex align-items-center">
                                <img
                                    src="{{asset('backend/assets/images/user-list/user-list1.png')}}"
                                    alt="Image"
                                    class="flex-shrink-0 me-12 radius-8" />
                                <h6
                                    class="text-md mb-0 fw-medium flex-grow-1">
                                    Kathryn Murphy
                                </h6>
                            </div>
                        </td> -->
                            <td>{{$productCategory->name}}</td>
                            <td>{{$productCategory->description ?? 'N/A'}}</td>
                            <td>
                                <a
                                    href="{{route('categories.edit', $productCategory->id)}}"
                                    class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                    title="Edit">
                                    <iconify-icon
                                        icon="lucide:edit"></iconify-icon>
                                </a>
                                <a
                                    href="{{route('categories.delete', $productCategory->id)}}"
                                    class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                    title="Delete"
                                    onclick="return confirm('Are you sure you want to delete this category?');">
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
</div>

<!-- SortableJS Library -->
<script src="https://cdn.jsdelivr.net/npm/sortablejs@latest/Sortable.min.js"></script>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const tbody = document.getElementById('sortable-categories');
        const selectAllCheckbox = document.getElementById('selectAllCheckbox');
        const categoryCheckboxes = document.querySelectorAll('.category-checkbox');
        const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');

        // Select All functionality
        if (selectAllCheckbox) {
            selectAllCheckbox.addEventListener('change', function() {
                categoryCheckboxes.forEach(checkbox => {
                    checkbox.checked = this.checked;
                });
                toggleBulkDeleteButton();
            });
        }

        // Individual checkbox change
        categoryCheckboxes.forEach(checkbox => {
            checkbox.addEventListener('change', function() {
                updateSelectAllCheckbox();
                toggleBulkDeleteButton();
            });
        });

        // Update select all checkbox based on individual checkboxes
        function updateSelectAllCheckbox() {
            if (selectAllCheckbox && categoryCheckboxes.length > 0) {
                const allChecked = Array.from(categoryCheckboxes).every(checkbox => checkbox.checked);
                selectAllCheckbox.checked = allChecked;
                selectAllCheckbox.indeterminate = false;
            }
        }

        // Toggle bulk delete button visibility
        function toggleBulkDeleteButton() {
            const checkedBoxes = document.querySelectorAll('.category-checkbox:checked');
            if (bulkDeleteBtn) {
                bulkDeleteBtn.style.display = checkedBoxes.length > 0 ? 'inline-flex' : 'none';
            }
        }

        // Drag and drop functionality
        if (tbody) {
            const sortable = Sortable.create(tbody, {
                handle: 'td:nth-child(2), iconify-icon', // Drag handle
                animation: 150,
                ghostClass: 'sortable-ghost',
                chosenClass: 'sortable-chosen',
                dragClass: 'sortable-drag',
                onEnd: function(evt) {
                    // Get all category IDs in new order
                    const rows = Array.from(tbody.querySelectorAll('tr'));
                    const order = rows.map(row => row.getAttribute('data-id'));

                    // Send AJAX request to update order
                    fetch('{{ route("categories.update-order") }}', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}',
                                'Accept': 'application/json'
                            },
                            body: JSON.stringify({
                                order: order
                            })
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.success) {
                                // Update displayed order numbers in the table
                                const rows = Array.from(tbody.querySelectorAll('tr'));
                                rows.forEach((row, index) => {
                                    const orderLabel = row.querySelector('td:first-child .form-check-label');
                                    if (orderLabel) {
                                        orderLabel.textContent = index + 1;
                                    }
                                });
                                // Optional: Show success message
                                alert('Order updated successfully');
                            } else {
                                alert('Failed to update order');
                                // Reload page to revert changes
                                location.reload();
                            }
                        })
                        .catch(error => {
                            console.error('Error:', error);
                            // Reload page to revert changes
                            location.reload();
                        });
                }
            });
        }
    });

    // Bulk delete function
    function bulkDelete() {
        const checkedBoxes = document.querySelectorAll('.category-checkbox:checked');
        const ids = Array.from(checkedBoxes).map(checkbox => checkbox.getAttribute('data-id'));

        if (ids.length === 0) {
            alert('Please select at least one category to delete.');
            return;
        }

        if (!confirm(`Are you sure you want to delete ${ids.length} categor${ids.length > 1 ? 'ies' : 'y'}?`)) {
            return;
        }

        // Create a form and submit it
        const form = document.createElement('form');
        form.method = 'POST';
        form.action = '{{ route("categories.bulk-delete") }}';

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
</script>

<style>
    .sortable-ghost {
        opacity: 0.4;
        background-color: #f0f0f0;
    }

    .sortable-chosen {
        cursor: move;
    }

    .sortable-drag {
        opacity: 0.8;
    }

    #sortable-categories tr:hover {
        background-color: #f8f9fa;
    }

    #sortable-categories tr td:nth-child(2) {
        cursor: move;
        user-select: none;
    }
</style>
@endsection