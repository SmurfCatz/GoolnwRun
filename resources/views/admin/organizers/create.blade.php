@extends('layouts.app')
@section('hide-navbar')
@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar mt-4" id="sidebar">
        @include('components.sidebar')
    </div>
    <div class="container mt-4">
        <div class="row justify-content-start mx-1">
            <div class="col-mld-11">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header text-white rounded-top d-flex justify-content-between align-items-center" style="background-color: #6f42c1;">
                        <h4 class="mb-0"><i class="bi bi-person-plus-fill me-2"></i> Create New Organizer</h4>
                        <a href="{{ route('admin.organizers.index') }}" class="btn btn-light btn-sm">
                            Back
                        </a>
                    </div>

                    <div class="card-body bg-light">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <form action="{{ route('admin.organizers.store') }}" method="POST">
                            @csrf

                            <!-- Organizer Name -->
                            <div class="mb-3">
                                <label for="organizer_name" class="form-label">Organizer Name</label>
                                <input type="text" name="organizer_name" id="organizer_name"
                                    class="form-control @error('organizer_name') is-invalid @enderror"
                                    value="{{ old('organizer_name') }}" required>
                                @error('organizer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="organizer_email" class="form-label">Email</label>
                                <input type="email" name="organizer_email" id="organizer_email"
                                    class="form-control @error('organizer_email') is-invalid @enderror"
                                    value="{{ old('organizer_email') }}" required>
                                @error('organizer_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone Number -->
                            <div class="mb-3">
                                <label for="organizer_tel" class="form-label">Phone Number</label>
                                <input type="text" name="organizer_tel" id="organizer_tel"
                                    class="form-control @error('organizer_tel') is-invalid @enderror"
                                    value="{{ old('organizer_tel') }}" required>
                                @error('organizer_tel')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Approve -->
                            <div class="mb-3 form-check form-switch">
                                <!-- Hidden input ที่จะส่งค่า 0 ถ้า checkbox ไม่ถูกติ๊ก -->
                                <input type="hidden" name="is_approved" value="0">

                                <!-- Checkbox ที่จะ override ค่าข้างบนเป็น 1 ถ้ามีการติ๊ก -->
                                <input type="checkbox" name="is_approved" id="is_approved"
                                    class="form-check-input" value="1" {{ old('is_approved', $organizer->is_approved ?? false) ? 'checked' : '' }}>
                                <label for="is_approved" class="form-check-label">Approve Organizer</label>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="password" class="form-label">Password</label>
                                <input type="password" name="password" id="password"
                                    class="form-control @error('password') is-invalid @enderror" required>
                                @error('password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="password_confirmation" class="form-label">Confirm Password</label>
                                <input type="password" name="password_confirmation" id="password_confirmation"
                                    class="form-control" required autocomplete="off">
                            </div>

                            <!-- Submit -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-primary fw-bold">
                                    Create Organizer
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Optional Styling -->
<style>
    .btn-primary {
        background-color: #6f42c1;
        border: none;
    }

    .btn-primary:hover {
        background-color: #5a379e;
    }
</style>
@endsection
@endsection