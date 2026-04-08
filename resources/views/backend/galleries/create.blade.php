@extends('layouts.backend.main')
@section('title', 'Create Gallery')
@section('meta')
<meta name="description" content="Quick News Global AI - Stay informed with AI-powered news summaries in under 9 seconds. Get verified, concise news updates without the noise." />
<meta name="robots" content="index, follow" />
@endsection

@section('content')
<div class="dashboard-main-body">
    <div
        class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Create Gallery</h6>
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
                    <h5 class="card-title mb-0">Create Gallery</h5>
                </div>
                <div class="card-body">
                    <form
                        action="{{route('gallery.store')}}"
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
                                    name="name"
                                    id="name"
                                    class="form-control @error('name') is-invalid @enderror"
                                    placeholder="Enter Gallery Name"
                                    value="{{old('name')}}"
                                    required />
                                @error('name')
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
                                    name="feature_image"
                                    id="imageInput"
                                    class="form-control @error('feature_image') is-invalid @enderror"
                                    accept="image/*" />
                                @error('feature_image')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Gallery Images</label>
                            <div id="multipleImagesPreview" class="mb-2 d-flex flex-wrap gap-2"></div>
                            <div class="has-validation">
                                <input
                                    type="file"
                                    name="gallery_images[]"
                                    id="multipleImagesInput"
                                    class="form-control @error('gallery_images.*') is-invalid @enderror"
                                    accept="image/*"
                                    multiple />
                                <small class="text-muted">You can select multiple images</small>
                                @error('gallery_images.*')
                                    <div class="invalid-feedback">
                                        {{$message}}
                                    </div>
                                @enderror
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Gallery Videos</label>
                            <div id="multipleVideosPreview" class="mb-2 d-flex flex-wrap gap-2"></div>
                            <div class="has-validation">
                                <input
                                    type="file"
                                    name="gallery_videos[]"
                                    id="multipleVideosInput"
                                    class="form-control @error('gallery_videos.*') is-invalid @enderror"
                                    accept="video/*"
                                    multiple />
                                <small class="text-muted">You can select multiple videos (mp4, webm, etc.)</small>
                                @error('gallery_videos.*')
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
                                Save Gallery
                            </button>
                            <a href="{{route('gallery.index')}}" class="btn btn-secondary ms-2">
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
document.addEventListener('DOMContentLoaded', function() {
    // Single Image Preview
    const imageInput = document.getElementById('imageInput');
    const imagePreview = document.getElementById('imagePreview');
    const previewImg = document.getElementById('previewImg');

    if(imageInput) {
        imageInput.addEventListener('change', function() {
            const file = this.files[0];
            if (file) {
                const reader = new FileReader();
                reader.onload = function(e) {
                    previewImg.src = e.target.result;
                    imagePreview.style.display = 'block';
                }
                reader.readAsDataURL(file);
            }
        });
    }

    // Multiple Images Preview
    const multipleImagesInput = document.getElementById('multipleImagesInput');
    const multipleImagesPreview = document.getElementById('multipleImagesPreview');

    if(multipleImagesInput) {
        multipleImagesInput.addEventListener('change', function() {
            multipleImagesPreview.innerHTML = '';
            Array.from(this.files).forEach(file => {
                const reader = new FileReader();
                reader.onload = function(e) {
                    const div = document.createElement('div');
                    div.innerHTML = `<img src="${e.target.result}" style="width:80px;height:80px;object-fit:cover;border-radius:4px;border:1px solid #ddd">`;
                    multipleImagesPreview.appendChild(div);
                }
                reader.readAsDataURL(file);
            });
        });
    }

    // Multiple Videos Preview
    const multipleVideosInput = document.getElementById('multipleVideosInput');
    const multipleVideosPreview = document.getElementById('multipleVideosPreview');

    if(multipleVideosInput) {
        multipleVideosInput.addEventListener('change', function() {
            multipleVideosPreview.innerHTML = '';
            Array.from(this.files).forEach(file => {
                const div = document.createElement('div');
                div.style.position = 'relative';
                const video = document.createElement('video');
                video.src = URL.createObjectURL(file);
                video.style.width = '80px';
                video.style.height = '80px';
                video.style.objectFit = 'cover';
                video.style.borderRadius = '4px';
                video.style.border = '1px solid #ddd';
                div.appendChild(video);
                
                const icon = document.createElement('div');
                icon.innerHTML = '<i class="fas fa-play" style="position:absolute;top:50%;left:50%;transform:translate(-50%,-50%);color:white;font-size:10px;"></i>';
                div.appendChild(icon);
                
                multipleVideosPreview.appendChild(div);
            });
        });
    }
});
</script>


@endsection

