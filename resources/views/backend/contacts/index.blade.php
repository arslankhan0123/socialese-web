@extends('layouts.backend.main')
@section('title', 'Contacts')
@section('meta')
<meta name="description" content="Quick News Global AI - Stay informed with AI-powered news summaries in under 9 seconds. Get verified, concise news updates without the noise." />
<meta name="robots" content="index, follow" />
@endsection

@php
use Illuminate\Support\Str;
@endphp

<script>
document.addEventListener('DOMContentLoaded', function() {
    // Clean URL parameters after showing message
    if (window.location.search.includes('deleted=success')) {
        setTimeout(function() {
            const url = new URL(window.location);
            url.searchParams.delete('deleted');
            url.searchParams.delete('count');
            window.history.replaceState({}, '', url);
        }, 100);
    }

    const selectAllCheckbox = document.getElementById('selectAllCheckbox');
    const contactCheckboxes = document.querySelectorAll('.contact-checkbox');
    const bulkDeleteBtn = document.getElementById('bulkDeleteBtn');
    
    // Select All functionality
    if (selectAllCheckbox) {
        selectAllCheckbox.addEventListener('change', function() {
            contactCheckboxes.forEach(checkbox => {
                checkbox.checked = this.checked;
            });
            toggleBulkDeleteButton();
        });
    }
    
    // Individual checkbox change
    contactCheckboxes.forEach(checkbox => {
        checkbox.addEventListener('change', function() {
            updateSelectAllCheckbox();
            toggleBulkDeleteButton();
        });
    });
    
    // Update select all checkbox based on individual checkboxes
    function updateSelectAllCheckbox() {
        if (selectAllCheckbox && contactCheckboxes.length > 0) {
            const allChecked = Array.from(contactCheckboxes).every(checkbox => checkbox.checked);
            selectAllCheckbox.checked = allChecked;
            selectAllCheckbox.indeterminate = false;
        }
    }
    
    // Toggle bulk delete button visibility
    function toggleBulkDeleteButton() {
        const checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');
        if (bulkDeleteBtn) {
            bulkDeleteBtn.style.display = checkedBoxes.length > 0 ? 'inline-flex' : 'none';
        }
    }
});

// Bulk delete function
function bulkDelete() {
    const checkedBoxes = document.querySelectorAll('.contact-checkbox:checked');
    const ids = Array.from(checkedBoxes).map(checkbox => checkbox.getAttribute('data-id'));

    if (ids.length === 0) {
        alert('Please select at least one contact to delete.');
        return;
    }

    if (!confirm(`Are you sure you want to delete ${ids.length} contact${ids.length > 1 ? 's' : ''}?`)) {
        return;
    }

    fetch('{{ route("contacts.bulk-delete") }}', {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': '{{ csrf_token() }}',
            'Accept': 'application/json'
        },
        body: JSON.stringify({ ids: ids })
    })
    .then(response => {
        if (!response.ok) {
            return response.json().then(data => {
                throw new Error(data.message || 'Network response was not ok');
            });
        }
        return response.json();
    })
    .then(data => {
        if (data.success) {
            // Redirect with success message in URL parameter
            window.location.href = '{{ route("contacts.index") }}?deleted=success&count=' + ids.length;
        } else {
            // Show error alert
            const errorAlert = document.createElement('div');
            errorAlert.className = 'alert alert-danger alert-dismissible fade show';
            errorAlert.setAttribute('role', 'alert');
            errorAlert.innerHTML = '<strong>Error!</strong> ' + (data.message || 'Something went wrong') + 
                '<button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>';
            document.querySelector('.dashboard-main-body').insertBefore(errorAlert, document.querySelector('.card'));
        }
    })
    .catch(error => {
        console.error('Error:', error);
        alert('An error occurred while deleting contacts: ' + error.message);
    });
}
</script>

@section('content')
<div class="dashboard-main-body">
    <div
        class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Contacts</h6>
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
            <li class="fw-medium">Contacts</li>
        </ul>
    </div>

    <!-- Success/Error Messages -->
    @if(session('success'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> {{ session('success') }}
        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
    </div>
    @endif

    @if(request()->get('deleted') == 'success')
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        <strong>Success!</strong> 
        @php
            $count = request()->get('count', 1);
        @endphp
        {{ $count > 1 ? $count . ' contacts deleted successfully.' : 'Contact deleted successfully.' }}
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
            <h5 class="card-title mb-0">Contacts</h5>
            <!-- <div class="d-flex align-items-center gap-2">
                <button id="bulkDeleteBtn" onclick="bulkDelete()" class="btn btn-danger fw-semibold px-3 py-2.5 rounded d-inline-flex align-items-center" style="display: none; border: none; white-space: nowrap; box-shadow: 0 4px 6px -1px rgba(220, 53, 69, 0.3); transition: all 0.3s ease; font-size: 15px;">
                    <iconify-icon icon="mingcute:delete-2-line" class="icon me-2" style="font-size: 20px;"></iconify-icon>
                    Delete Selected
                </button>
            </div> -->
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
                            <th scope="col">Email</th>
                            <th scope="col">Phone Number</th>
                            <th scope="col">Subject</th>
                            <th scope="col">Message</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($contacts as $contact)
                        <tr>
                            <td>
                                <div
                                    class="form-check style-check d-flex align-items-center">
                                    <input
                                        class="form-check-input contact-checkbox"
                                        type="checkbox"
                                        data-id="{{$contact->id}}" />
                                    <label class="form-check-label">
                                        {{$contact->id}}
                                    </label>
                                </div>
                            </td>
                            <td>{{$contact->name ?? 'N/A'}}</td>
                            <td>{{$contact->email ?? 'N/A'}}</td>
                            <td>{{$contact->phone_number ?? 'N/A'}}</td>
                            <td>{{Str::limit($contact->msg_subject ?? 'N/A', 30)}}</td>
                            <td>{{Str::limit($contact->message ?? 'N/A', 50)}}</td>
                            <td>{{$contact->created_at ? $contact->created_at->format('Y-m-d H:i') : 'N/A'}}</td>
                            <td>
                                <a
                                    href="{{route('contacts.delete', $contact->id)}}"
                                    class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                    title="Delete"
                                    onclick="return confirm('Are you sure you want to delete this contact?');">
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
@endsection