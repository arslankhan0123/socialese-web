@extends('layouts.backend.main')
@section('title', 'Create Blog')
@section('meta')
<meta name="description" content="Quick News Global AI - Stay informed with AI-powered news summaries in under 9 seconds. Get verified, concise news updates without the noise." />
<meta name="robots" content="index, follow" />
@endsection

@section('content')
<div class="dashboard-main-body">
    <div
        class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Create Blog</h6>
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
                    <h5 class="card-title mb-0">Create Blog</h5>
                </div>
                <div class="card-body">
                    <form
                        action="{{route('blogs.store')}}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="row gy-3 needs-validation"
                        novalidate>
                        @csrf
                        <div class="col-md-12">
                            <label class="form-label">Blog Title <span class="text-danger">*</span></label>
                            <div class="icon-field has-validation">
                                <span class="icon">
                                    <iconify-icon
                                        icon="solar:document-bold"></iconify-icon>
                                </span>
                                <input
                                    type="text"
                                    name="title"
                                    id="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    placeholder="Enter Blog Title"
                                    value="{{old('title')}}"
                                    required />
                                @error('title')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @else
                                    <div class="invalid-feedback">
                                        Please provide blog title
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Featured Image</label>
                            <div id="imagePreview" class="mb-2" style="display: none;">
                                <img id="previewImg" src="" alt="Preview" style="max-width: 200px; height: auto; border-radius: 4px; border: 1px solid #e0e0e0;">
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
                            <label class="form-label fw-bold text-neutral-900">Short Description</label>
                            <div class="border border-neutral-200 radius-8 overflow-hidden">
                                <div class="height-200">
                                    <!-- Editor Toolbar Start -->
                                    <div id="toolbar-container-short_description">
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
                                            <button class="ql-header" value="1"></button>
                                            <button class="ql-header" value="2"></button>
                                            <button class="ql-blockquote"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-list" value="ordered"></button>
                                            <button class="ql-list" value="bullet"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <select class="ql-align"></select>
                                            <button class="ql-link"></button>
                                            <button class="ql-image"></button>
                                        </span>
                                        <span class="ql-formats">
                                            <button class="ql-clean"></button>
                                        </span>
                                    </div>
                                    <!-- Editor Toolbar End -->
                                    <!-- Editor Container Start -->
                                    <div id="editor-short_description"></div>
                                    <!-- Editor Container End -->
                                </div>
                            </div>
                            <textarea name="short_description" id="short_description" style="display: none;">{{old('short_description')}}</textarea>
                            @error('short_description')
                                <div class="invalid-feedback d-block">
                                    {{$message}}
                                </div>
                            @enderror
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
                            <label class="form-label">Multiple Images</label>
                            <div id="multipleImagesPreview" class="mb-2 d-flex flex-wrap gap-2"></div>
                            <div class="has-validation">
                                <input
                                    type="file"
                                    name="multiple_images[]"
                                    id="multipleImagesInput"
                                    class="form-control @error('multiple_images.*') is-invalid @enderror"
                                    accept="image/*"
                                    multiple />
                                <small class="text-muted">You can select multiple images</small>
                                @error('multiple_images.*')
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
                                Save Blog
                            </button>
                            <a href="{{route('blogs.index')}}" class="btn btn-secondary ms-2">
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

            // Initialize Quill Editor for Short Description
            const quillShortDescription = new Quill('#editor-short_description', {
                modules: {
                    syntax: true,
                    toolbar: '#toolbar-container-short_description',
                },
                placeholder: 'Enter short description...',
                theme: 'snow',
            });

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
            @if(old('short_description'))
                const oldShortContent = {!! json_encode(old('short_description')) !!};
                quillShortDescription.root.innerHTML = oldShortContent;
                document.getElementById('short_description').value = oldShortContent;
            @endif

            @if(old('long_description'))
                const oldLongContent = {!! json_encode(old('long_description')) !!};
                quillLongDescription.root.innerHTML = oldLongContent;
                document.getElementById('long_description').value = oldLongContent;
            @endif

            // Update hidden textarea on content change
            quillShortDescription.on('text-change', function() {
                const content = quillShortDescription.root.innerHTML;
                document.getElementById('short_description').value = content;
            });

            quillLongDescription.on('text-change', function() {
                const content = quillLongDescription.root.innerHTML;
                document.getElementById('long_description').value = content;
            });

            // Update hidden textarea before form submit
            const form = document.querySelector('form');
            if (form) {
                form.addEventListener('submit', function(e) {
                    const shortDescriptionContent = quillShortDescription.root.innerHTML;
                    const longDescriptionContent = quillLongDescription.root.innerHTML;
                    document.getElementById('short_description').value = shortDescriptionContent;
                    document.getElementById('long_description').value = longDescriptionContent;
                }, false);
                
                // Also update on button click as backup
                const submitBtn = form.querySelector('button[type="submit"]');
                if (submitBtn) {
                    submitBtn.addEventListener('click', function() {
                        setTimeout(function() {
                            const shortDescriptionContent = quillShortDescription.root.innerHTML;
                            const longDescriptionContent = quillLongDescription.root.innerHTML;
                            document.getElementById('short_description').value = shortDescriptionContent;
                            document.getElementById('long_description').value = longDescriptionContent;
                        }, 100);
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

    // Single image preview
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

    // Multiple images preview
    document.getElementById('multipleImagesInput')?.addEventListener('change', function(e) {
        const files = e.target.files;
        const previewContainer = document.getElementById('multipleImagesPreview');
        previewContainer.innerHTML = '';
        
        if (files.length > 0) {
            Array.from(files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const img = document.createElement('img');
                    img.src = e.target.result;
                    img.style.maxWidth = '100px';
                    img.style.height = 'auto';
                    img.style.borderRadius = '4px';
                    img.style.border = '1px solid #e0e0e0';
                    img.style.marginRight = '8px';
                    img.style.marginBottom = '8px';
                    previewContainer.appendChild(img);
                }
                reader.readAsDataURL(file);
            });
        }
    });
</script>
@endsection

