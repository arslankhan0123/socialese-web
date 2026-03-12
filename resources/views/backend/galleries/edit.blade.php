@extends('layouts.backend.main')

@section('title', 'Edit Gallery')

@section('meta')
<meta name="description" content="Quick News Global AI - Stay informed with AI-powered news summaries in under 9 seconds.">
<meta name="robots" content="index, follow" />
@endsection


@section('content')

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
                                    src="{{asset('storage/'.$gallery->feature_image)}}"
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

                                @foreach(json_decode($gallery->gallery_images) as $image)

                                <div style="position:relative">

                                    <img
                                        src="{{asset('storage/'.$image)}}"
                                        style="width:100px;height:100px;object-fit:cover;border-radius:6px;border:1px solid #ddd">

                                    <label
                                        style="
position:absolute;
top:-8px;
right:-8px;
background:red;
color:white;
border-radius:50%;
width:22px;
height:22px;
font-size:12px;
text-align:center;
cursor:pointer;
line-height:22px;
">

                                        <input
                                            type="checkbox"
                                            name="delete_images[]"
                                            value="{{$image}}"
                                            style="display:none">

                                        ×
                                    </label>

                                </div>

                                @endforeach

                            </div>


                            <input
                                type="file"
                                name="gallery_images[]"
                                class="form-control"
                                multiple
                                accept="image/*">


                            <small class="text-muted">
                                Upload more images if needed
                            </small>

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