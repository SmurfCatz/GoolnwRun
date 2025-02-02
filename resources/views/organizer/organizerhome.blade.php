@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card shadow-lg border-0">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <span class="h5">{{ __('Dashboard Organizer') }}</span>
                </div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                    {{ __('You are logged in!') }}

                    You are logged in Organizer!
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
