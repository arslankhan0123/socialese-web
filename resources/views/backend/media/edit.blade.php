@extends('layouts.backend.main')
@section('title', 'Edit Media')
@section('meta')
<meta name="description" content="Quick News Global AI - Stay informed with AI-powered news summaries in under 9 seconds. Get verified, concise news updates without the noise." />
<meta name="robots" content="index, follow" />
@endsection

@section('content')
<div class="dashboard-main-body">
    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Edit Media</h6>
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
            <li class="fw-medium">Edit</li>
        </ul>
    </div>

    @php
        $mediaSrc = $media->media_url
            ? asset($media->media_url)
            : ($media->medial_name ? asset('backend/media/' . $media->medial_name) : null);
    @endphp

    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Media</h5>
                </div>
                <div class="card-body">
                    <form
                        action="{{route('media.update', $media->id)}}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="row gy-3 needs-validation"
                        novalidate>
                        @csrf
                        @method('PUT')

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
                                    value="{{old('title', $media->title)}}"
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
                                    value="{{old('description', $media->description)}}" />
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
                                    @php
                                        $selectedType = old('type', $media->type);
                                    @endphp
                                    <option value="">Select Type</option>
                                    <option value="image" {{$selectedType == 'image' ? 'selected' : ''}}>Image</option>
                                    <option value="video" {{$selectedType == 'video' ? 'selected' : ''}}>Video</option>
                                </select>
                                @error('type')
                                    <div class="invalid-feedback">{{$message}}</div>
                                @else
                                    <div class="invalid-feedback">Please select a type</div>
                                @enderror
                            </div>
                        </div>

                        <div class="col-md-12">
                            <label class="form-label">Current Media</label>
                            <div class="border rounded p-2" style="max-width: 520px;">
                                @if(!$mediaSrc)
                                    <span class="text-muted">N/A</span>
                                @elseif(($selectedType ?? '') === 'image')
                                    <img src="{{$mediaSrc}}" alt="Current Image" style="max-width: 100%; height: auto; border-radius: 8px;">
                                @elseif(($selectedType ?? '') === 'video')
                                    <video src="{{$mediaSrc}}" controls style="width: 100%; border-radius: 8px;"></video>
                                @else
                                    <a href="{{$mediaSrc}}" target="_blank" class="text-decoration-underline">Open Media</a>
                                @endif
                            </div>
                            <small class="text-muted d-block mt-1">If you upload a new file, old file will be deleted from public folder.</small>
                        </div>

                        <div class="col-md-12" id="imageField" style="display: none;">
                            <label class="form-label">Replace Image</label>
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
                            <label class="form-label">Replace Video</label>
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
                                Update Media
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
        toggleFields();

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



