@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Member</h1>
    <form action="{{ route('admin.users.update', $Member->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="member_name">Name</label>
            <input type="text" name="member_name" id="member_name" class="form-control @error('member_name') is-invalid @enderror" value="{{ old('member_name', $Member->member_name) }}" required>
            @error('member_name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="member_email">Email</label>
            <input type="email" name="member_email" id="member_email" class="form-control @error('member_email') is-invalid @enderror" value="{{ old('member_email', $Member->member_email) }}" required>
            @error('member_email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="password">Password</label>
            <input type="password" name="password" id="password" class="form-control @error('password') is-invalid @enderror">
            @error('password')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="password_confirmation">Confirm Password</label>
            <input type="password" name="password_confirmation" id="password_confirmation" class="form-control">
        </div>
        <button type="submit" class="btn btn-warning">Update Member</button>
    </form>
</div>
@endsection
