@extends('layouts.backend.main')
@section('title', 'Gallery')
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
        <h6 class="fw-semibold mb-0">Gallery</h6>
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
            <li class="fw-medium">Galleries</li>
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
            <h5 class="card-title mb-0">Galleries</h5>
            <div class="d-flex align-items-center gap-2">
                <a href="{{route('gallery.create')}}" class="btn text-white fw-semibold px-3 py-2.5 rounded d-inline-flex align-items-center" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #a855f7 100%); border: none; white-space: nowrap; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3); transition: all 0.3s ease; font-size: 15px;">
                    <iconify-icon icon="solar:add-circle-bold" class="icon me-2" style="font-size: 20px;"></iconify-icon>
                    Create Gallery
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
                            <th scope="col">Feature Image</th>
                            <th scope="col">Gallery Images</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($galleries as $gallery)
                        <tr>
                            <td>
                                <div class="form-check style-check d-flex align-items-center">
                                    <input
                                        class="form-check-input gallery-checkbox"
                                        type="checkbox"
                                        data-id="{{$gallery->id}}" />
                                    <label class="form-check-label">
                                        {{$gallery->id}}
                                    </label>
                                </div>
                            </td>
                            <td>{{$gallery->name}}</td>

                            {{-- Feature Image --}}
                            <td>
                                <img
                                    src="{{ asset($gallery->feature_image) }}"
                                    style="width:60px;height:60px;object-fit:cover;border-radius:6px;border:1px solid #ddd;">
                            </td>

                            {{-- Gallery Images --}}
                            <td>
                                @php
                                    $images = is_array($gallery->gallery_images) ? $gallery->gallery_images : [];
                                @endphp
                                @foreach ($images as $image)
                                <img
                                    src="{{ asset($image) }}"
                                    style="width:60px;height:60px;object-fit:cover;border-radius:6px;margin-right:5px;border:1px solid #ddd;">
                                @endforeach
                            </td>

                            <td>
                                <a
                                    href="{{route('gallery.edit', $gallery->id)}}"
                                    class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                    title="Edit">
                                    <iconify-icon icon="lucide:edit"></iconify-icon>
                                </a>

                                <a
                                    href="{{route('gallery.delete', $gallery->id)}}"
                                    class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                    title="Delete"
                                    onclick="return confirm('Are you sure you want to delete this Gallery?');">
                                    <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
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
        form.action = '';

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