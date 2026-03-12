@extends('layouts.backend.main')
@section('title', 'Create Product')
@section('meta')
<meta name="description" content="Quick News Global AI - Stay informed with AI-powered news summaries in under 9 seconds. Get verified, concise news updates without the noise." />
<meta name="robots" content="index, follow" />
@endsection

@section('content')
<div class="dashboard-main-body">
    <div
        class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Create Product</h6>
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
            <li class="fw-medium">Create</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Create Product</h5>
                </div>
                <div class="card-body">
                    <form
                        action="{{route('products.store')}}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="row gy-3 needs-validation"
                        novalidate>
                        @csrf
                        <div class="col-md-12">
                            <label class="form-label">Product Name <span class="text-danger">*</span></label>
                            <div class="icon-field has-validation">
                                <span class="icon">
                                    <iconify-icon
                                        icon="solar:box-bold"></iconify-icon>
                                </span>
                                <input
                                    type="text"
                                    name="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter Product Name"
                                    value="{{old('name')}}"
                                    required />
                                @error('name')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @else
                                    <div class="invalid-feedback">
                                        Please provide product name
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Product Image</label>
                            <div id="imagePreview" class="mb-2" style="display: none;">
                                <img id="previewImg" src="" alt="Preview" style="max-width: 200px; height: auto; border-radius: 8px; border: 1px solid #e0e0e0;">
                            </div>
                            <div class="has-validation">
                                <input
                                    type="file"
                                    name="image"
                                    id="imageInput"
                                    class="form-control @error('image') is-invalid @enderror"
                                    accept="image/*" />
                                @error('image')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Type</label>
                            <div class="icon-field has-validation">
                                <span class="icon">
                                    <iconify-icon
                                        icon="solar:tag-bold"></iconify-icon>
                                </span>
                                <select
                                    name="type"
                                    class="form-control @error('type') is-invalid @enderror">
                                    <option value="">Select Type</option>
                                    <option value="Main Product" {{old('type') == 'Main Product' ? 'selected' : ''}}>Main Product</option>
                                    <option value="Child Product" {{old('type') == 'Child Product' ? 'selected' : ''}}>Child Product</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Category <span class="text-danger">*</span></label>
                            <div class="icon-field has-validation">
                                <span class="icon">
                                    <iconify-icon
                                        icon="solar:tag-bold"></iconify-icon>
                                </span>
                                <select
                                    name="category_id"
                                    id="category_id"
                                    class="form-control @error('category_id') is-invalid @enderror"
                                    required>
                                    <option value="">Select Category</option>
                                    @foreach($categories as $category)
                                        <option value="{{$category->id}}" {{old('category_id') == $category->id ? 'selected' : ''}}>
                                            {{$category->name}}
                                        </option>
                                    @endforeach
                                </select>
                                @error('category_id')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @else
                                    <div class="invalid-feedback">
                                        Please select a category
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Parent Product (Optional)</label>
                            <div class="icon-field has-validation">
                                <span class="icon">
                                    <iconify-icon
                                        icon="solar:box-bold"></iconify-icon>
                                </span>
                                <select
                                    name="parent_id"
                                    id="parent_id"
                                    class="form-control @error('parent_id') is-invalid @enderror">
                                    <option value="">Select Parent Product (Optional)</option>
                                </select>
                                <small class="form-text text-muted">Select a parent product if this is a child product</small>
                                @error('parent_id')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Short Description</label>
                            <div class="has-validation">
                                <textarea
                                    name="short_description"
                                    class="form-control @error('short_description') is-invalid @enderror"
                                    rows="3"
                                    placeholder="Enter short description">{{old('short_description')}}</textarea>
                                @error('short_description')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label fw-bold text-neutral-900">Long Description</label>
                            <div class="border border-neutral-200 radius-8 overflow-hidden">
                                <div class="height-200">
                                    <!-- Editor Toolbar Start -->
                                    <div id="toolbar-container-long_description">
                                        <span class="ql-formats">
                                            <select class="ql-font"></select>
                                            <select class="ql-size"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-bold"></button>
                                            <button class="ql-italic"></button>
                                            <button class="ql-underline"></button>
                                            <button class="ql-strike"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <select class="ql-color"></select>
                                            <select class="ql-background"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-script" value="sub"></button>
                                            <button class="ql-script" value="super"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-header" value="1"></button>
                                            <button class="ql-header" value="2"></button>
                                            <button class="ql-blockquote"></button>
                                            <button class="ql-code-block"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                            <button class="ql-indent" value="-1"></button>
                                            <button class="ql-indent" value="+1"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-direction" value="rtl"></button>
                                            <select class="ql-align"></select>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                            <button class="ql-video"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-clean"></button>
                                        </span>
                                    </div>
                                    <!-- Editor Toolbar End -->
                                    <!-- Editor Container Start -->
                                    <div id="editor-long_description"></div>
                                    <!-- Editor Container End -->
                                </div>
                            </div>
                            <textarea name="long_description" id="long_description" style="display: none;">{{old('long_description')}}</textarea>
                            @error('long_description')
                                <div class="invalid-feedback d-block">
                                    {{$message}}
                                </div>
                            @enderror
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <div class="has-validation">
                                <textarea
                                    name="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    rows="4"
                                    placeholder="Enter product description">{{old('description')}}</textarea>
                                @error('description')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button
                                class="btn btn-primary-600 d-inline-flex align-items-center"
                                type="submit">
                                <iconify-icon icon="solar:diskette-bold" class="icon me-2"></iconify-icon>
                                Save Product
                            </button>
                            <a href="{{route('products.index')}}" class="btn btn-secondary ms-2">
                                Cancel
                            </a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Quill Editor Scripts -->
<script src="{{asset('backend/assets/js/editor.highlighted.min.js')}}"></script>
<script src="{{asset('backend/assets/js/editor.quill.js')}}"></script>
<script src="{{asset('backend/assets/js/editor.katex.min.js')}}"></script>

<script>
    (function() {
        // Wait for Quill to be available
        function initQuill() {
            if (typeof Quill === 'undefined') {
                setTimeout(initQuill, 100);
                return;
            }

            // Initialize Quill Editor for Long Description
            const quillLongDescription = new Quill('#editor-long_description', {
                modules: {
                    syntax: true,
                    toolbar: '#toolbar-container-long_description',
                },
                placeholder: 'Enter detailed description...',
                theme: 'snow',
            });

            // Set initial content if old value exists
            @if(old('long_description'))
                const oldContent = {!! json_encode(old('long_description')) !!};
                quillLongDescription.root.innerHTML = oldContent;
                document.getElementById('long_description').value = oldContent;
            @endif

            // Update hidden textarea on content change
            quillLongDescription.on('text-change', function() {
                const content = quillLongDescription.root.innerHTML;
                document.getElementById('long_description').value = content;
            });

            // Update hidden textarea before form submit (multiple methods for reliability)
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const longDescriptionContent = quillLongDescription.root.innerHTML;
                    document.getElementById('long_description').value = longDescriptionContent;
                }, false);
                
                // Also update on button click as backup
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.addEventListener('click', function() {
                        setTimeout(function() {
                            const longDescriptionContent = quillLongDescription.root.innerHTML;
                            document.getElementById('long_description').value = longDescriptionContent;
                        }, 10);
                    });
                }
            }
        }

        // Start initialization
        if (document.readyState === 'loading') {
            document.addEventListener('DOMContentLoaded', initQuill);
        } else {
            initQuill();
        }
    })();

    // Image preview
    document.getElementById('imageInput')?.addEventListener('change', function(e) {
        const file = e.target.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                document.getElementById('previewImg').src = e.target.result;
                document.getElementById('imagePreview').style.display = 'block';
            }
            reader.readAsDataURL(file);
        } else {
            document.getElementById('imagePreview').style.display = 'none';
        }
    });

    // Load products by category
    document.getElementById('category_id')?.addEventListener('change', function() {
        const categoryId = this.value;
        const parentProductSelect = document.getElementById('parent_id');
        
        // Clear existing options except the first one
        parentProductSelect.innerHTML = '<option value="">Select Parent Product (Optional)</option>';
        
        if (!categoryId) {
            return;
        }

        // Show loading state
        parentProductSelect.disabled = true;
        parentProductSelect.innerHTML = '<option value="">Loading products...</option>';

        // Fetch products for selected category
        fetch(`{{route('api.products-by-category')}}?category_id=${categoryId}`, {
            method: 'GET',
            headers: {
                'X-Requested-With': 'XMLHttpRequest',
                'Accept': 'application/json',
            }
        })
        .then(response => response.json())
        .then(data => {
            parentProductSelect.innerHTML = '<option value="">Select Parent Product (Optional)</option>';
            
            if (data.products && data.products.length > 0) {
                data.products.forEach(product => {
                    const option = document.createElement('option');
                    option.value = product.id;
                    option.textContent = product.name;
                    parentProductSelect.appendChild(option);
                });
            } else {
                const option = document.createElement('option');
                option.value = '';
                option.textContent = 'No products found in this category';
                parentProductSelect.appendChild(option);
            }
            
            parentProductSelect.disabled = false;
        })
        .catch(error => {
            console.error('Error fetching products:', error);
            parentProductSelect.innerHTML = '<option value="">Error loading products</option>';
            parentProductSelect.disabled = false;
        });
    });

    // Load products on page load if category is already selected (for old values)
    @if(old('category_id'))
        document.addEventListener('DOMContentLoaded', function() {
            const categorySelect = document.getElementById('category_id');
            if (categorySelect.value) {
                categorySelect.dispatchEvent(new Event('change'));
            }
        });
    @endif
</script>
@endsection
