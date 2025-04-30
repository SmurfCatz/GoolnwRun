@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <h1 class="mb-4">Edit Organizer</h1>
        <form action="{{ route('admin.organizers.update', $organizer->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="form-group mb-3">
                <label for="organizer_name">Name</label>
                <input type="text" name="organizer_name" id="organizer_name"
                    class="form-control @error('organizer_name') is-invalid @enderror"
                    value="{{ old('organizer_name', $organizer->organizer_name) }}" required>
                @error('organizer_name')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="organizer_email">Email</label>
                <input type="email" name="organizer_email" id="organizer_email"
                    class="form-control @error('organizer_email') is-invalid @enderror"
                    value="{{ old('organizer_email', $organizer->organizer_email) }}" required>
                @error('organizer_email')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="organizer_password">Password</label>
                <input type="password" name="organizer_password" id="organizer_password"
                    class="form-control @error('organizer_password') is-invalid @enderror">
                @error('organizer_password')
                    <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="organizer_password_confirmation">Confirm Password</label>
                <input type="password" name="organizer_password_confirmation" id="organizer_password_confirmation"
                    class="form-control">
            </div>

            <button type="submit" class="btn btn-warning">Update Organizer</button>
        </form>
    </div>
@endsection
