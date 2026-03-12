@extends('layouts.backend.main')
@section('title', 'Blogs')
@section('meta')
<meta name="description" content="Quick News Global AI - Stay informed with AI-powered news summaries in under 9 seconds. Get verified, concise news updates without the noise." />
<meta name="robots" content="index, follow" />
@endsection

@php
use Illuminate\Support\Str;
@endphp

@section('content')
<div class="dashboard-main-body">
    <div
        class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Blogs</h6>
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
            <li class="fw-medium">Blogs</li>
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
            <h5 class="card-title mb-0">Blogs</h5>
            <div class="d-flex align-items-center gap-2">
                <button id="bulkDeleteBtn" onclick="bulkDelete()" class="btn btn-danger fw-semibold px-3 py-2.5 rounded d-inline-flex align-items-center" style="display: none; border: none; white-space: nowrap; box-shadow: 0 4px 6px -1px rgba(220, 53, 69, 0.3); transition: all 0.3s ease; font-size: 15px;">
                    <iconify-icon icon="mingcute:delete-2-line" class="icon me-2" style="font-size: 20px;"></iconify-icon>
                    Delete Selected
                </button>
                <a href="{{route('blogs.create')}}" class="btn text-white fw-semibold px-3 py-2.5 rounded d-inline-flex align-items-center" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #a855f7 100%); border: none; white-space: nowrap; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3); transition: all 0.3s ease; font-size: 15px;">
                    <iconify-icon icon="solar:add-circle-bold" class="icon me-2" style="font-size: 20px;"></iconify-icon>
                    Create Blog
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
                        <th scope="col">Image</th>
                        <th scope="col">Title</th>
                        <!-- <th scope="col">Slug</th> -->
                        <th scope="col">Short Description</th>
                        <th scope="col">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($blogs as $blog)
                    <tr>
                        <td>
                            <div
                                class="form-check style-check d-flex align-items-center">
                                <input
                                    class="form-check-input blog-checkbox"
                                    type="checkbox"
                                    data-id="{{$blog->id}}" />
                                <label class="form-check-label">
                                    {{$blog->id}}
                                </label>
                            </div>
                        </td>
                        <td>
                            @if($blog->image)
                                <img src="{{asset($blog->image)}}" alt="{{$blog->title}}" style="width: 50px; height: 50px; object-fit: cover; border-radius: 4px;">
                            @else
                                <span class="text-muted">No Image</span>
                            @endif
                        </td>
                        <td>{{Str::limit($blog->title ?? 'N/A', 20)}}</td>
                        <!-- <td>{{$blog->slug}}</td> -->
                        <td>{{Str::limit(strip_tags($blog->short_description ?? 'N/A'), 50)}}</td>
                        <td>
                            <a
                                href="{{route('blogs.edit', $blog->id)}}"
                                class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                title="Edit">
                                <iconify-icon
                                    icon="lucide:edit"></iconify-icon>
                            </a>
                            <a
                                href="{{route('blogs.delete', $blog->id)}}"
                                class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                title="Delete"
                                onclick="return confirm('Are you sure you want to delete this blog?');">
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

<script>
document.addEventListener('DOMContentLoaded', function() {
    const selectAllCheckbox = document.getElementById('selectAllCheckbox');
    const blogCheckboxes = document.querySelectorAll('.blog-checkbox');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    
    // Select All functionality
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            blogCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            toggleBulkDeleteButton();
        });
    }
    
    // Individual checkbox change
    blogCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateSelectAllCheckbox();
            toggleBulkDeleteButton();
        });
    });
    
    // Update select all checkbox based on individual checkboxes
    function updateSelectAllCheckbox() {
        if (selectAllCheckbox && blogCheckboxes.length > 0) {
            const allChecked = Array.from(blogCheckboxes).every(checkbox => checkbox.checked);
            selectAllCheckbox.checked = allChecked;
            selectAllCheckbox.indeterminate = false;
        }
    }
    
    // Toggle bulk delete button visibility
    function toggleBulkDeleteButton() {
        const checkedBoxes = document.querySelectorAll('.blog-checkbox:checked');
        if (bulkDeleteBtn) {
            bulkDeleteBtn.style.display = checkedBoxes.length > 0 ? 'inline-flex' : 'none';
        }
    }
});

// Bulk delete function
function bulkDelete() {
    const checkedBoxes = document.querySelectorAll('.blog-checkbox:checked');
    const ids = Array.from(checkedBoxes).map(checkbox => checkbox.getAttribute('data-id'));
    
    if (ids.length === 0) {
        alert('Please select at least one blog to delete.');
        return;
    }
    
    if (!confirm(`Are you sure you want to delete ${ids.length} blog${ids.length > 1 ? 's' : ''}?`)) {
        return;
    }
    
    // Create a form and submit it
    const form = document.createElement('form');
    form.method = 'POST';
    form.action = '{{ route("blogs.bulk-delete") }}';
    
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
@endsection

