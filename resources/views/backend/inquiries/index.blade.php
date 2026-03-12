@extends('layouts.backend.main')
@section('title', 'Inquiries')
@section('meta')
<meta name="description" content="Inquiries Management" />
<meta name="robots" content="index, follow" />
@endsection

@php
use Illuminate\Support\Str;
@endphp

@section('content')
<div class="dashboard-main-body">
    <div
        class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Inquiries</h6>
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
            <li class="fw-medium">Inquiries</li>
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
            <h5 class="card-title mb-0">Inquiries</h5>
        </div>
        <div class="card-body">
            <div class="table-responsive">
                <table
                    class="table bordered-table mb-0"
                    id="dataTable"
                    data-page-length="10">
                    <thead>
                        <tr>
                            <th scope="col">S.L</th>
                            <th scope="col">Name</th>
                            <th scope="col">Email</th>
                            <th scope="col">Phone</th>
                            <th scope="col">Company</th>
                            <th scope="col">Budget</th>
                            <th scope="col">Timeline</th>
                            <th scope="col">Project Description</th>
                            <th scope="col">Date</th>
                            <th scope="col">Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($inquiries as $inquiry)
                        <tr>
                            <td>{{$inquiry->id}}</td>
                            <td>{{$inquiry->name ?? 'N/A'}}</td>
                            <td>{{$inquiry->email ?? 'N/A'}}</td>
                            <td>{{$inquiry->phone ?? 'N/A'}}</td>
                            <td>{{$inquiry->company ?? 'N/A'}}</td>
                            <td>{{$inquiry->budget ?? 'N/A'}}</td>
                            <td>{{$inquiry->timeline ?? 'N/A'}}</td>
                            <td>{{Str::limit($inquiry->project_description ?? 'N/A', 50)}}</td>
                            <td>{{$inquiry->created_at ? $inquiry->created_at->format('Y-m-d H:i') : 'N/A'}}</td>
                            <td>
                                <a
                                    href="{{route('inquiries.delete', $inquiry->id)}}"
                                    class="w-32-px h-32-px bg-danger-focus text-danger-main rounded-circle d-inline-flex align-items-center justify-content-center"
                                    title="Delete"
                                    onclick="return confirm('Are you sure you want to delete this inquiry?');">
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

