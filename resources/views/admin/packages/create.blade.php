@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>Add Package</h2>
        <form method="POST" action="{{ route('admin.packages.store') }}">
            @csrf

            <div class="mb-3">
                <label for="package_name" class="form-label">Package Name</label>
                <input type="text" class="form-control" id="package_name" name="package_name" required>
            </div>

            <div class="mb-3">
                <label for="package_price" class="form-label">Price</label>
                <input type="number" class="form-control" id="package_price" name="package_price" required>
            </div>

            <div class="mb-3">
                <label for="package_maxparticipants" class="form-label">Max Participants</label>
                <input type="number" class="form-control" id="package_maxparticipants" name="package_maxparticipants">
            </div>

            <div class="mb-3">
                <label for="package_extra_fee_per_person" class="form-label">Extra Fee/Person</label>
                <input type="number" class="form-control" id="package_extra_fee_per_person"
                    name="package_extra_fee_per_person" required>
            </div>

            <button type="submit" class="btn btn-primary">Save</button>
        </form>
    </div>
@endsection
