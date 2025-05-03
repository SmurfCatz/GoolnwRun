@extends('layouts.app')
@section('hide-navbar')
@section('content')

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar mt-4 " id="sidebar-wrapper">
        @include('components.sidebar')
    </div>
    <div class="container mt-4">
        <div class="card">
            <div class="card-header bg-primary text-white">
                <h4>{{ __('Select Package') }}</h4>
            </div>
            @if ($errors->any())
            <div class="alert alert-danger mt-3">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <div class="card-body">
                <form action="{{ route('admin.events.create.step1') }}" method="POST">
                    @csrf
                    <div class="row">
                        @foreach ($packages as $package)
                        <div class="col-md-4">
                            <div class="card mb-4">
                                <div class="card-header bg-secondary text-white text-center">
                                    <h5 class="card-title">{{ $package->package_name }}</h5>
                                </div>
                                <div class="card-body">
                                    <p><strong>{{ __('Price:') }}</strong> ฿{{ number_format($package->package_price, 2) }}</p>
                                    <p>
                                        <strong>{{ __('Max Participants:') }}</strong>
                                        {{ $package->package_maxparticipants > 0 ? $package->package_maxparticipants : __('Unlimited') }}
                                    </p>
                                    <p>
                                        <strong>{{ __('Extra Fee per Person:') }}</strong>
                                        ฿{{ number_format($package->package_extra_fee_per_person, 2) }}
                                    </p>
                                </div>
                                <div class="card-footer text-center">
                                    <label>
                                        <input type="radio" name="package" value="{{ $package->id }}" required>
                                        {{ __('Select this package') }}
                                    </label>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                    <div class="text-center">
                        <button type="submit" class="btn btn-primary mt-3">{{ __('Next') }}</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
@endsection