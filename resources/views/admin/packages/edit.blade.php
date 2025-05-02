@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-lg-8">
            <div class="card shadow-lg border-0 rounded-4">
                <div class="card-header text-white d-flex justify-content-between align-items-center rounded-top">
                    <h4 class="mb-0"><i class="bi bi-pencil-square me-2"></i> Edit Package</h4>
                    <a href="{{ route('admin.packages.index') }}" class="btn btn-light btn-sm">
                        Back
                    </a>
                </div>
                <div class=" card-body bg-light">
                    <form action="{{ route('admin.packages.update', $package->id) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <!-- Package Name -->
                        <div class="mb-3">
                            <label for="package_name">Package Name</label>
                            <input type="text" name="package_name" id="package_name" class="form-control @error('package_name') is-invalid @enderror" value="{{ old('package_name', $package->package_name) }}" required>
                            @error('package_name')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Package price -->
                        <div class="mb-3">
                            <label for="package_price">Price</label>
                            <input type="text" name="package_price" id="package_price" class="form-control @error('package_price') is-invalid @enderror" value="{{ old('package_price', $package->package_price) }}" required>
                            @error('package_price')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Package maxparticipants -->
                        <div class="mb-3">
                            <label for="package_maxparticipants">Maxparticipants</label>
                            <input type="text" name="package_maxparticipants" id="package_maxparticipants" class="form-control @error('package_maxparticipants') is-invalid @enderror" value="{{ old('package_maxparticipants', $package->package_maxparticipants) }}" required>
                            @error('package_maxparticipants')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <!-- Package extra_fee_per_person -->
                        <div class="mb-4">
                            <label for="package_extra_fee_per_person">Extra fee per person</label>
                            <input type="text" name="package_extra_fee_per_person" id="package_extra_fee_per_person" class="form-control @error('package_extra_fee_per_person') is-invalid @enderror" value="{{ old('package_extra_fee_per_person', $package->package_extra_fee_per_person) }}" required>
                        </div>
                        <div class="d-flex justify-content-end">
                            <button type="submit" class="btn btn-purple text-white fw-bold">Update Package</button>
                    </form>
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