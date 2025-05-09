@extends('layouts.app')
@section('hide-navbar')
@section('content')

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar mt-4 " id="sidebar-wrapper">
        @include('components.sidebar')
    </div>

    <!-- Main Content -->
    <div class="container mt-4">
        <div class="row justify-content-start mx-1">
            <div class="col-md-11">
                <div class="card shadow-lg border-0 rounded-4">
                    <div class="card-header d-flex justify-content-between align-items-center text-white">
                        <h4 class="mb-0">{{ __('Event Management') }}</h4>
                        <a href="{{ route('admin.events.create.step1') }}" class="btn btn-light btn-sm">
                            <i class="bi bi-plus-circle"></i> {{ __('Create New Event') }}
                        </a>
                    </div>

                    <div class="card-body">
                        <!-- Display Success Message -->
                        @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <!-- Check if Events Exist -->
                        @if($events->isEmpty())
                        <p class="text-center">{{ __('No events found.') }}</p>
                        @else
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('Event Name') }}</th>
                                    <th>{{ __('Event Date') }}</th>
                                    <th>{{ __('Category') }}</th>
                                    <th>{{ __('Status') }}</th>
                                    <th class="text-center">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($events as $event)
                                <tr>
                                    <td>{{ $event->event_name }}</td>
                                    <td>{{ $event->event_date }}</td>
                                    <td>{{ $event->event_category }}</td>
                                    <td>{{ ucfirst($event->event_status) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.events.edit', $event->id) }}" class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i> {{ __('Edit') }}
                                        </a>
                                        <form action="{{ route('admin.events.destroy', $event->id) }}" method="POST"
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

@endsection
@endsection