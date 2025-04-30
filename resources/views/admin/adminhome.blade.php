@extends('layouts.app')

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar-wrapper">
        @include('components.sidebar')
    </div>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row justify-content-start mx-5">
            <div class="col-md-10">
                <div class="card shadow-lg border-0 ">
                    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                        <h4 class=" mb-0 ">{{ __('Admin Dashboard') }}</h4>
                    </div>
                    <div class="card-body text-center">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif
                        <p class="mb-0">{{ __('Welcome to the Admin Dashboard! Here you can manage the system.') }}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection