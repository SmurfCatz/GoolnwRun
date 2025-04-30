@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Edit Package</h1>
    <form action="{{ route('admin.packages.update', $package->id) }}" method="POST">
        @csrf
        @method('PUT')
        <div class="form-group mb-3">
            <label for="package_name">Package Name</label>
            <input type="text" name="package_name" id="package_name" class="form-control @error('package_name') is-invalid @enderror" value="{{ old('package_name', $package->package_name) }}" required>
            @error('package_name')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="package_price">Price</label>
            <input type="text" name="package_price" id="package_price" class="form-control @error('package_price') is-invalid @enderror" value="{{ old('package_price', $package->package_price) }}" required>
            @error('package_price')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="package_maxparticipants">Maxparticipants</label>
            <input type="text" name="package_maxparticipants" id="package_maxparticipants" class="form-control @error('package_maxparticipants') is-invalid @enderror" value="{{ old('package_maxparticipants', $package->package_maxparticipants) }}" required>
            @error('package_maxparticipants')
            <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>
        <div class="form-group mb-3">
            <label for="package_extra_fee_per_person">Extra fee per person</label>
            <input type="text" name="package_extra_fee_per_person" id="package_extra_fee_per_person" class="form-control @error('package_extra_fee_per_person') is-invalid @enderror" value="{{ old('package_extra_fee_per_person', $package->package_extra_fee_per_person) }}" required>
        </div>
        <button type="submit" class="btn btn-warning">Update Package</button>
    </form>
</div>
@endsection