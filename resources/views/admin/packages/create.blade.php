@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header  text-white d-flex justify-content-between align-items-center rounded-top">
                    <h4 class="mb-0"><i class="bi bi-box-seam me-2"></i> Add Package</h4>
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-light btn-sm">
                        Back
                    </a>
                </div>

                <div class="card-body bg-light">
                    @if(session('success'))
                    <div class="alert alert-success">
                        {{ session('success') }}
                    </div>
                    @endif

                    <form method="POST" action="{{ route('admin.packages.store') }}">
                        @csrf

                        <div class="mb-3">
                            <label for="package_name" class="form-label">Package Name</label>
                            <input type="text" class="form-control @error('package_name') is-invalid @enderror" id="package_name" name="package_name" value="{{ old('package_name') }}" required>
                            @error('package_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="package_price" class="form-label">Price</label>
                            <input type="number" step="0.01" class="form-control @error('package_price') is-invalid @enderror" id="package_price" name="package_price" value="{{ old('package_price') }}" required>
                            @error('package_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="package_maxparticipants" class="form-label">Max Participants</label>
                            <input type="number" class="form-control @error('package_maxparticipants') is-invalid @enderror" id="package_maxparticipants" name="package_maxparticipants" value="{{ old('package_maxparticipants') }}">
                            @error('package_maxparticipants')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-4">
                            <label for="package_extra_fee_per_person" class="form-label">Extra Fee/Person</label>
                            <input type="number" step="0.01" class="form-control @error('package_extra_fee_per_person') is-invalid @enderror" id="package_extra_fee_per_person" name="package_extra_fee_per_person" value="{{ old('package_extra_fee_per_person') }}" required>
                            @error('package_extra_fee_per_person')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-success fw-bold">
                                Save Package
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

    .btn-success {
        background-color: #6f42c1;
        border: none;
    }

    .btn-success:hover {
        background-color: #6f42c1;
    }
</style>
@endsection