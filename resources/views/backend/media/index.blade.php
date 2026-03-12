@extends('layouts.backend.main')
@section('title', 'Media')
@section('meta')
<meta name="description" content="Quick News Global AI - Stay informed with AI-powered news summaries in under 9 seconds. Get verified, concise news updates without the noise." />
<meta name="robots" content="index, follow" />
@endsection

@section('content')
<div class="dashboard-main-body">
    <div
        class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Media</h6>
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
            <li class="fw-medium">Media</li>
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
            <h5 class="card-title mb-0">All Media</h5>
            <div class="d-flex align-items-center gap-2">
                <a href="{{route('media.create')}}" class="btn text-white fw-semibold px-3 py-2.5 rounded d-inline-flex align-items-center" style="background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 50%, #a855f7 100%); border: none; white-space: nowrap; box-shadow: 0 4px 6px -1px rgba(79, 70, 229, 0.3); transition: all 0.3s ease; font-size: 15px;">
                    <iconify-icon icon="solar:add-circle-bold" class="icon me-2" style="font-size: 20px;"></iconify-icon>
                    Create Media
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
                            <th scope="col">Title</th>
                            <th scope="col">Type</th>
                            <th scope="col">Media</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($media as $data)
                        <tr>
                            <td>
                                <div
                                    class="form-check style-check d-flex align-items-center">
                                    <input
                                        class="form-check-input product-checkbox"
                                        type="checkbox"
                                        data-id="{{$data->id}}" />
                                    <label class="form-check-label">
                                        {{$data->id}}
                                    </label>
                                </div>
                            </td>
                            <td>{{$data->title ?? 'N/A'}}</td>
                            <td>{{$data->type ?? 'N/A'}}</td>
                            <td>
                                @php
                                    $mediaSrc = $data->media_url
                                        ? asset($data->media_url)
                                        : ($data->medial_name ? asset('backend/media/' . $data->medial_name) : null);
                                @endphp

                                @if(!$mediaSrc)
                                    <span class="text-muted">N/A</span>
                                @elseif(($data->type ?? '') === 'image')
                                    <a
                                        href="javascript:void(0)"
                                        class="media-preview-trigger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#mediaPreviewModal"
                                        data-type="image"
                                        data-src="{{$mediaSrc}}"
                                        data-title="{{$data->title ?? 'Media'}}">
                                        <img
                                            src="{{$mediaSrc}}"
                                            alt="Image"
                                            style="width: 56px; height: 56px; object-fit: cover; border-radius: 8px; border: 1px solid #e0e0e0;">
                                    </a>
                                @elseif(($data->type ?? '') === 'video')
                                    <a
                                        href="javascript:void(0)"
                                        class="d-inline-flex align-items-center gap-2 media-preview-trigger"
                                        data-bs-toggle="modal"
                                        data-bs-target="#mediaPreviewModal"
                                        data-type="video"
                                        data-src="{{$mediaSrc}}"
                                        data-title="{{$data->title ?? 'Media'}}">
                                        <span class="w-40-px h-40-px bg-primary-focus text-primary-main rounded-circle d-inline-flex align-items-center justify-content-center">
                                            <iconify-icon icon="solar:videocamera-bold"></iconify-icon>
                                        </span>
                                        <span class="text-decoration-underline">View Video</span>
                                    </a>
                                @else
                                    <span class="text-muted">{{$data->medial_name ?? 'N/A'}}</span>
                                @endif
                            </td>
                            <td>
                                <a
                                    href="{{route('media.edit', $data->id)}}"
                                    class="w-32-px h-32-px bg-success-focus text-success-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                    title="Edit">
                                    <iconify-icon
                                        icon="lucide:edit"></iconify-icon>
                                </a>
                                <form
                                    action="{{route('media.destroy', $data->id)}}"
                                    method="POST"
                                    class="d-inline"
                                    onsubmit="return confirm('Are you sure you want to delete this media?');">
                                    @csrf
                                    @method('DELETE')
                                    <button
                                        type="submit"
                                        class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center border-0"
                                        title="Delete">
                                        <iconify-icon icon="mingcute:delete-2-line"></iconify-icon>
                                    </button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<!-- Media Preview Modal -->
<div class="modal fade" id="mediaPreviewModal" tabindex="-1" aria-labelledby="mediaPreviewModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg modal-dialog-centered">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="mediaPreviewModalLabel">Media Preview</h5>
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <div class="modal-body">
                <img
                    id="mediaPreviewImage"
                    src=""
                    alt="Preview"
                    style="max-width: 100%; height: auto; border-radius: 10px; display: none;" />

                <video
                    id="mediaPreviewVideo"
                    controls
                    playsinline
                    style="width: 100%; border-radius: 10px; display: none;">
                </video>
            </div>
        </div>
    </div>
</div>

<script>
    (function () {
        const modalEl = document.getElementById('mediaPreviewModal');
        if (!modalEl) return;

        const modalTitle = document.getElementById('mediaPreviewModalLabel');
        const imgEl = document.getElementById('mediaPreviewImage');
        const videoEl = document.getElementById('mediaPreviewVideo');

        modalEl.addEventListener('show.bs.modal', function (event) {
            const trigger = event.relatedTarget;
            if (!trigger) return;

            const type = trigger.getAttribute('data-type');
            const src = trigger.getAttribute('data-src');
            const title = trigger.getAttribute('data-title') || 'Media Preview';

            if (modalTitle) modalTitle.textContent = title;

            if (type === 'image') {
                if (videoEl) {
                    videoEl.pause();
                    videoEl.removeAttribute('src');
                    videoEl.load();
                    videoEl.style.display = 'none';
                }
                if (imgEl) {
                    imgEl.src = src;
                    imgEl.style.display = 'block';
                }
            } else if (type === 'video') {
                if (imgEl) {
                    imgEl.removeAttribute('src');
                    imgEl.style.display = 'none';
                }
                if (videoEl) {
                    videoEl.src = src;
                    videoEl.style.display = 'block';
                    videoEl.load();
                    setTimeout(function () {
                        videoEl.play().catch(function () {});
                    }, 200);
                }
            }
        });

        modalEl.addEventListener('hidden.bs.modal', function () {
            if (videoEl) {
                videoEl.pause();
                videoEl.removeAttribute('src');
                videoEl.load();
                videoEl.style.display = 'none';
            }
            if (imgEl) {
                imgEl.removeAttribute('src');
                imgEl.style.display = 'none';
            }
            if (modalTitle) modalTitle.textContent = 'Media Preview';
        });
    })();
</script>
@endsection