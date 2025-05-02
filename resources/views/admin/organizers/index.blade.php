@extends('layouts.app')

@section('content')

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar mt-4" id="sidebar">
        @include('components.sidebar')
    </div>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row justify-content-start mx-1">
            <div class="col-md-11">
                <div class="card shadow-lg border-0">
                    <div class="card-header d-flex justify-content-between align-items-center text-white">
                        <h4 class="mb-0">{{ __('Organizer Management') }}</h4>
                        <a href="{{ route('admin.organizers.create') }}" class="btn btn-light btn-sm"><i class="bi bi-plus-circle"></i> {{ __('Create New Organizer') }}</a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        @if ($organizers->isEmpty())
                        <p class="text-center mb-0">{{ __('No organizers found.') }}</p>
                        @else
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Email') }}</th>
                                    <th class="text-center">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($organizers as $organizer)
                                <tr>
                                    <td>{{ $organizer->organizer_name }}</td>
                                    <td>{{ $organizer->organizer_email }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.organizers.edit', $organizer->id) }}" class="btn btn-warning btn-sm"><i class="bi bi-pencil-square"></i> {{ __('Edit') }}</a>
                                        <form action="{{ route('admin.organizers.destroy', $organizer->id) }}" method="POST"
                                            class="d-inline delete-form">
                                            @csrf
                                            @method('DELETE')
                                            <button type="button" class="btn btn-danger btn-sm delete-btn">
                                                <i class="bi bi-trash"></i> {{ __('Delete') }}
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @endif
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