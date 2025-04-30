@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="card">
        <div class="card-header bg-primary text-white">
            <h4>{{ __('Select Package') }}</h4>
        </div>
        <div class="card-body">
            <form action="{{ route('admin.events.create.step1') }}" method="POST">
                @csrf
                <label for="package" class="form-label">{{ __('Package') }}</label>
                <select name="package" id="package" class="form-select" required>
                    <option value="" disabled selected>{{ __('Select a package') }}</option>
                    @foreach ($packages as $package)
                    <option value="{{ $package->id }}">{{ $package->package_name }} - ฿{{ number_format($package->package_price, 2) }}</option>
                    @endforeach
                </select>
                <button type="submit" class="btn btn-primary mt-3">{{ __('Next') }}</button>
            </form>
        </div>
    </div>
</div>
@endsection