@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header  text-white rounded-top d-flex justify-content-between align-items-center">
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
                            <label for="name" class="form-label">Organizer Name</label>
                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror" required>
                            @error('name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Email -->
                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" name="email" id="email" class="form-control @error('email') is-invalid @enderror" required>
                            @error('email')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Password -->
                        <div class="mb-4">
                            <label for="password" class="form-label">Password</label>
                            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror" required>
                            @error('password')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- confirm Password -->
                        <div class="mb-4">
                            <label for="password_confirmation" class="form-label">Confirm Password</label>
                            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control" required autocomplete="off">
                        </div>

                        <!-- Submit Button -->
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

<!-- Optional Styling -->
<style>
    .card-header {
        background-color: #6f42c1;
    }

    .btn-primary {
        background-color: #6f42c1;
        border: none;
    }

    .btn-primary:hover {
        background-color: #6f42c1;
    }
</style>
@endsection