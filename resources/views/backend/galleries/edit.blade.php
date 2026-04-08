@extends('layouts.backend.main')

@section('title', 'Edit Gallery')

@section('meta')
<meta name="description" content="Quick News Global AI - Stay informed with AI-powered news summaries in under 9 seconds.">
<meta name="robots" content="index, follow" />
<script>
document.addEventListener('DOMContentLoaded', function() {
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


@section('content')
<style>
    .delete-overlay {
        position: absolute;
        top: -8px;
        right: -8px;
        background: #ef4444;
        color: white;
        border-radius: 50%;
        width: 22px;
        height: 22px;
        font-size: 12px;
        text-align: center;
        cursor: pointer;
        line-height: 22px;
        box-shadow: 0 2px 4px rgba(0,0,0,0.1);
        transition: 0.3s;
    }
    .delete-overlay:has(input:checked) {
        background: #1e293b;
        transform: scale(0.9);
    }
    .video-play-hint {
        position: absolute;
        top: 50%;
        left: 50%;
        transform: translate(-50%, -50%);
        color: white;
        text-shadow: 0 2px 4px rgba(0,0,0,0.5);
        pointer-events: none;
    }
</style>


<div class="dashboard-main-body">

    <div class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Edit Gallery</h6>

        <ul class="d-flex align-items-center gap-2">
            <li class="fw-medium">
                <a href="{{route('dashboard')}}" class="d-flex align-items-center gap-1 hover-text-primary">
                    <iconify-icon icon="solar:home-smile-angle-outline" class="icon text-lg"></iconify-icon>
                    Dashboard
                </a>
            </li>

            <li>-</li>
            <li class="fw-medium">Edit</li>
        </ul>
    </div>


    <div class="row gy-4">

        <div class="col-lg-12">

            <div class="card">

                <div class="card-header">
                    <h5 class="card-title mb-0">Edit Gallery</h5>
                </div>


                <div class="card-body">

                    <form
                        action="{{route('gallery.update',$gallery->id)}}"
                        method="POST"
                        enctype="multipart/form-data"
                        class="row gy-3">

                        @csrf


                        {{-- Name --}}

                        <div class="col-md-12">

                            <label class="form-label">
                                Gallery Name
                                <span class="text-danger">*</span>
                            </label>

                            <input
                                type="text"
                                name="name"
                                class="form-control"
                                value="{{ old('name',$gallery->name) }}"
                                required>

                        </div>



                        {{-- Feature Image --}}

                        <div class="col-md-12">

                            <label class="form-label">Feature Image</label>

                            @if($gallery->feature_image)

                            <div class="mb-2">

                                <img
                                    src="{{asset($gallery->feature_image)}}"
                                    style="width:150px;height:150px;object-fit:cover;border-radius:6px;border:1px solid #ddd">

                            </div>

                            @endif

                            <input
                                type="file"
                                name="feature_image"
                                class="form-control"
                                accept="image/*">

                            <small class="text-muted">
                                Upload if you want to change feature image
                            </small>

                        </div>



                        {{-- Gallery Images --}}
                        <div class="col-md-12">
                            <label class="form-label">Gallery Images</label>
                            <div class="d-flex flex-wrap gap-3 mb-3">
                                @php
                                    $images = is_array($gallery->gallery_images) ? $gallery->gallery_images : [];
                                @endphp
                                @foreach($images as $image)
                                    @if(is_string($image))
                                    <div style="position:relative">
                                        <img src="{{asset($image)}}"
                                            style="width:100px;height:100px;object-fit:cover;border-radius:6px;border:1px solid #ddd">
                                        <label class="delete-overlay">
                                            <input type="checkbox" name="delete_images[]" value="{{$image}}" style="display:none">
                                            ×
                                        </label>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            <div id="multipleImagesPreview" class="mb-2 d-flex flex-wrap gap-2"></div>
                            <input type="file" name="gallery_images[]" id="multipleImagesInput" class="form-control" multiple accept="image/*">
                            <small class="text-muted">You can select multiple images. Selecting new images will replace existing ones.</small>
                        </div>

                        {{-- Gallery Videos --}}
                        <div class="col-md-12">
                            <label class="form-label">Gallery Videos</label>
                            <div class="d-flex flex-wrap gap-3 mb-3">
                                @php
                                    $videos = is_array($gallery->gallery_videos) ? $gallery->gallery_videos : [];
                                @endphp
                                @foreach($videos as $video)
                                    @if(is_string($video))
                                    <div style="position:relative">
                                        <video style="width:100px;height:100px;object-fit:cover;border-radius:6px;border:1px solid #ddd">
                                            <source src="{{asset($video)}}">
                                        </video>
                                        <label class="delete-overlay">
                                            <input type="checkbox" name="delete_videos[]" value="{{$video}}" style="display:none">
                                            ×
                                        </label>
                                        <div class="video-play-hint"><i class="fas fa-play"></i></div>
                                    </div>
                                    @endif
                                @endforeach
                            </div>
                            <div id="multipleVideosPreview" class="mb-2 d-flex flex-wrap gap-2"></div>
                            <input type="file" name="gallery_videos[]" id="multipleVideosInput" class="form-control" multiple accept="video/*">
                            <small class="text-muted">You can select multiple videos. Selecting new videos will replace existing ones.</small>
                        </div>





                        {{-- Buttons --}}

                        <div class="col-md-12">

                            <button
                                class="btn btn-primary-600 d-inline-flex align-items-center"
                                type="submit">

                                <iconify-icon icon="solar:diskette-bold" class="icon me-2"></iconify-icon>

                                Update Gallery

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

@endsection