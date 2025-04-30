@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Create New Organizer') }}</div>

                <div class="card-body">
                    <form action="{{ route('admin.organizers.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">{{ __('Organizer Name') }}</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="email">{{ __('Email') }}</label>
                            <input type="email" name="email" id="email" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="password">{{ __('Password') }}</label>
                            <input type="password" name="password" id="password" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary mt-3">{{ __('Create Organizer') }}</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
