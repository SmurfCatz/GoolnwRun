@extends('layouts.app')
@section('hide-navbar')
@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar mt-4" id="sidebar-wrapper">
        @include('components.sidebar')
    </div>
    <div class="container mt-4">
        <div class="row justify-content-start mx-1">
            <div class="col-md-11">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header text-white d-flex justify-content-between align-items-center rounded-top">
                        <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Edit Member</h4>
                        <a href="{{ route('admin.users.index') }}" class="btn btn-light btn-sm">
                            Back
                        </a>
                    </div>
                    <div class=" card-body bg-light">
                        <form action="{{ route('admin.users.update', $Member->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="member_name" class="form-label">Name</label>
                                <input type="text" name="member_name" id="member_name"
                                    class="form-control @error('member_name') is-invalid @enderror"
                                    value="{{ old('member_name', $Member->member_name) }}" required>
                                @error('member_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="member_email" class="form-label">Email</label>
                                <input type="email" name="member_email" id="member_email"
                                    class="form-control @error('member_email') is-invalid @enderror"
                                    value="{{ old('member_email', $Member->member_email) }}" required>
                                @error('member_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password <small class="text-muted">(leave blank to keep current)</small></label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror"
                                    autocomplete="off">
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" autocomplete="off">
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-purple text-white fw-bold">
                                    Update Member
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<style>
    .card-header {
        background-color: #6f42c1;
    }

    .btn-purple {
        background-color: #6f42c1;
        border: none;
    }

    .btn-purple:hover {
        background-color: #7a00b8;
    }
</style>
@endsection
@endsection