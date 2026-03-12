@extends('layouts.backend.main')
@section('title', 'Create Media')
@section('meta')
<meta name="description" content="Quick News Global AI - Stay informed with AI-powered news summaries in under 9 seconds. Get verified, concise news updates without the noise." />
<meta name="robots" content="index, follow" />
@endsection

@section('content')
<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Create Media</h6>
        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{route('dashboard')}}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>
            <li>-</li>
            <li class="fw-medium">
                <a href="{{route('media.index')}}" class="d-flex align-items-center gap-1 hover-text-primary">
                    Media
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
                    <h5 class="card-title mb-0">Create Media</h5>
                </div>
                <div class="card-body">
                    <form
                        action="{{route('media.store')}}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="row gy-3 needs-validation"
                        novalidate>
                        @csrf

                        <div class="col-md-12">
                            <label class="form-label">Title <span class="text-danger">*</span></label>
                            <div class="icon-field has-validation">
                                <span class="icon">
                                    <iconify-icon icon="solar:document-bold"></iconify-icon>
                                </span>
                                <input
                                    type="text"
                                    name="title"
                                    class="form-control @error('title') is-invalid @enderror"
                                    placeholder="Enter Title"
                                    value="{{old('title')}}"
                                    required />
                                @error('title')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @else
                                    <div class="invalid-feedback">Please provide a title</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Description</label>
                            <div class="icon-field has-validation">
                                <span class="icon">
                                    <iconify-icon icon="solar:chat-square-bold"></iconify-icon>
                                </span>
                                <input
                                    type="text"
                                    name="description"
                                    class="form-control @error('description') is-invalid @enderror"
                                    placeholder="Enter Description (optional)"
                                    value="{{old('description')}}" />
                                @error('description')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Type <span class="text-danger">*</span></label>
                            <div class="icon-field has-validation">
                                <span class="icon">
                                    <iconify-icon icon="solar:tag-bold"></iconify-icon>
                                </span>
                                <select
                                    name="type"
                                    id="mediaType"
                                    class="form-control @error('type') is-invalid @enderror"
                                    required>
                                    <option value="">Select Type</option>
                                    <option value="image" {{old('type') == 'image' ? 'selected' : ''}}>Image</option>
                                    <option value="video" {{old('type') == 'video' ? 'selected' : ''}}>Video</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @else
                                    <div class="invalid-feedback">Please select a type</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12" id="imageField" style="display: none;">
                            <label class="form-label">Image <span class="text-danger">*</span></label>
                            <div id="imagePreview" class="mb-2" style="display: none;">
                                <img id="previewImg" src="" alt="Preview" style="max-width: 220px; height: auto; border-radius: 8px; border: 1px solid #e0e0e0;">
                            </div>
                            <div class="has-validation">
                                <input
                                    type="file"
                                    name="image"
                                    id="imageInput"
                                    class="form-control @error('image') is-invalid @enderror"
                                    accept="image/*" />
                                @error('image')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <small class="text-muted d-block mt-1">Max 5MB</small>
                        </div>

                        <div class="col-md-12" id="videoField" style="display: none;">
                            <label class="form-label">Video <span class="text-danger">*</span></label>
                            <div class="has-validation">
                                <input
                                    type="file"
                                    name="video"
                                    id="videoInput"
                                    class="form-control @error('video') is-invalid @enderror"
                                    accept="video/*" />
                                @error('video')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @enderror
                            </div>
                            <small class="text-muted d-block mt-1">Allowed: mp4/mov/avi/mkv (max 50MB)</small>
                        </div>

                        <div class="col-md-12">
                            <button class="btn btn-primary-600 d-inline-flex align-items-center" type="submit">
                                <iconify-icon icon="solar:diskette-bold" class="icon me-2"></iconify-icon>
                                Save Media
                            </button>
                            <a href="{{route('media.index')}}" class="btn btn-secondary ms-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        const typeSelect = document.getElementById('mediaType');
        const imageField = document.getElementById('imageField');
        const videoField = document.getElementById('videoField');

        const imageInput = document.getElementById('imageInput');
        const videoInput = document.getElementById('videoInput');

        function toggleFields() {
            const val = typeSelect?.value || '';

            if (val === 'image') {
                imageField.style.display = 'block';
                videoField.style.display = 'none';
                if (videoInput) videoInput.value = '';
            } else if (val === 'video') {
                imageField.style.display = 'none';
                videoField.style.display = 'block';
                if (imageInput) imageInput.value = '';
                document.getElementById('imagePreview').style.display = 'none';
            } else {
                imageField.style.display = 'none';
                videoField.style.display = 'none';
                if (imageInput) imageInput.value = '';
                if (videoInput) videoInput.value = '';
                document.getElementById('imagePreview').style.display = 'none';
            }
        }

        typeSelect?.addEventListener('change', toggleFields);
        toggleFields(); // initial (keeps old('type') working)

        // Image preview
        imageInput?.addEventListener('change', function(e) {
            const file = e.target.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(ev) {
                    document.getElementById('previewImg').src = ev.target.result;
                    document.getElementById('imagePreview').style.display = 'block';
                }
                reader.readAsDataURL(file);
            } else {
                document.getElementById('imagePreview').style.display = 'none';
            }
        });
    })();
</script>
@endsection


