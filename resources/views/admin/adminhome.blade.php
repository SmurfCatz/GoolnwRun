@extends('layouts.app')

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar mt-4" id="sidebar-wrapper">
        @include('components.sidebar')
    </div>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row justify-content-start mx-1">
            <div class="col-md-11">
                <div class="card shadow-lg border-0 ">
                    <div class="card-header d-flex justify-content-between align-items-center text-white">
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

<style>
    .card-header {
        background-color: #6f42c1;
    }
</style>
@endsection