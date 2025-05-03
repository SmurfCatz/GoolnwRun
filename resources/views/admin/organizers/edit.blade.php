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
            <div class="col-md-11">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header text-white d-flex justify-content-between align-items-center rounded-top">
                        <h4 class="mb-0"><i class="bi bi-person-lines-fill me-2"></i> Edit Organizer</h4>
                        <a href="{{ route('admin.organizers.index') }}" class="btn btn-light btn-sm">
                            Back
                        </a>
                    </div>
                    <div class="card-body bg-light">
                        <form action="{{ route('admin.organizers.update', $organizer->id) }}" method="POST">
                            @csrf
                            @method('PUT')

                            <!-- Name -->
                            <div class="mb-3">
                                <label for="organizer_name">Name</label>
                                <input type="text" name="organizer_name" id="organizer_name"
                                    class="form-control @error('organizer_name') is-invalid @enderror"
                                    value="{{ old('organizer_name', $organizer->organizer_name) }}" required>
                                @error('organizer_name')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Email -->
                            <div class="mb-3">
                                <label for="organizer_email">Email</label>
                                <input type="email" name="organizer_email" id="organizer_email"
                                    class="form-control @error('organizer_email') is-invalid @enderror"
                                    value="{{ old('organizer_email', $organizer->organizer_email) }}" required>
                                @error('organizer_email')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Phone Number -->
                            <div class="mb-3">
                                <label for="organizer_tel">Phone Number</label>
                                <input type="text" name="organizer_tel" id="organizer_tel"
                                    class="form-control @error('organizer_tel') is-invalid @enderror"
                                    value="{{ old('organizer_tel', $organizer->organizer_tel) }}" required>
                                @error('organizer_tel')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Approve -->
                            <div class="mb-3 form-check form-switch">
                                <input type="checkbox" name="is_approved" id="is_approved" class="form-check-input"
                                    {{ $organizer->is_approved ? 'checked' : '' }}>
                                <label for="is_approved" class="form-check-label">Approve</label>
                            </div>

                            <!-- Password -->
                            <div class="mb-3">
                                <label for="organizer_password">Password</label>
                                <input type="password" name="organizer_password" id="organizer_password"
                                    class="form-control @error('organizer_password') is-invalid @enderror">
                                @error('organizer_password')
                                <div class="invalid-feedback">{{ $message }}</div>
                                @enderror
                            </div>

                            <!-- Confirm Password -->
                            <div class="mb-4">
                                <label for="organizer_password_confirmation">Confirm Password</label>
                                <input type="password" name="organizer_password_confirmation"
                                    id="organizer_password_confirmation" class="form-control">
                            </div>

                            <!-- Submit Button -->
                            <div class="d-flex justify-content-end">
                                <button type="submit" class="btn btn-purple text-white fw-bold">Update Organizer</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Custom Styling -->
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