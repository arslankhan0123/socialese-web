@extends('layouts.backend.main')
@section('title', 'Settings')
@section('meta')
<meta name="description" content="Update your password" />
<meta name="robots" content="index, follow" />
@endsection

@section('content')
<div class="dashboard-main-body">
    <div
        class="d-flex flex-wrap align-items-center justify-content-between gap-3 mb-24">
        <h6 class="fw-semibold mb-0">Settings</h6>
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
            <li class="fw-medium">Settings</li>
        </ul>
    </div>

    <div class="row gy-4">
        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Update Password</h5>
                </div>
                <div class="card-body">
                    @if(session('status') === 'password-updated')
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Password updated successfully!
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                    @endif

                    <form
                        action="{{route('password.update')}}"
                        method="POST"
                        class="row gy-3 needs-validation"
                        novalidate>
                        @csrf
                        @method('put')
                        <div class="col-md-12">
                            <label class="form-label">Current Password <span class="text-danger">*</span></label>
                            <div class="icon-field has-validation">
                                <span class="icon">
                                    <iconify-icon
                                        icon="solar:lock-password-bold"></iconify-icon>
                                </span>
                                <input
                                    type="password"
                                    name="current_password"
                                    id="current_password"
                                    class="form-control @if($errors->updatePassword->has('current_password')) is-invalid @endif"
                                    placeholder="Enter current password"
                                    required />
                                @if($errors->updatePassword->has('current_password'))
                                    <div class="invalid-feedback">
                                        {{$errors->updatePassword->first('current_password')}}
                                    </div>
                                @else
                                    <div class="invalid-feedback">
                                        Please provide your current password
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">New Password <span class="text-danger">*</span></label>
                            <div class="icon-field has-validation">
                                <span class="icon">
                                    <iconify-icon
                                        icon="solar:lock-password-bold"></iconify-icon>
                                </span>
                                <input
                                    type="password"
                                    name="password"
                                    id="password"
                                    class="form-control @if($errors->updatePassword->has('password')) is-invalid @endif"
                                    placeholder="Enter new password"
                                    required />
                                @if($errors->updatePassword->has('password'))
                                    <div class="invalid-feedback">
                                        {{$errors->updatePassword->first('password')}}
                                    </div>
                                @else
                                    <div class="invalid-feedback">
                                        Please provide a new password
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="form-label">Confirm Password <span class="text-danger">*</span></label>
                            <div class="icon-field has-validation">
                                <span class="icon">
                                    <iconify-icon
                                        icon="solar:lock-password-bold"></iconify-icon>
                                </span>
                                <input
                                    type="password"
                                    name="password_confirmation"
                                    id="password_confirmation"
                                    class="form-control"
                                    placeholder="Confirm new password"
                                    required />
                                <div class="invalid-feedback">
                                    Please confirm your new password
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button
                                class="btn btn-primary-600 d-inline-flex align-items-center"
                                type="submit">
                                <iconify-icon icon="solar:diskette-bold" class="icon me-2"></iconify-icon>
                                Update Password
                            </button>
                            <a href="{{route('dashboard')}}" class="btn btn-secondary ms-2">
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

