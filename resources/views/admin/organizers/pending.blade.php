@extends('layouts.app')
@section('hide-navbar')
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
                    <div class="card-header text-white d-flex justify-content-between align-items-center" style="background-color: #6f42c1;">
                        <h4 class="mb-0">{{ __('Pending Organizer Approvals') }}</h4>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success">{{ session('success') }}</div>
                        @endif

                        @if (session('error'))
                        <div class="alert alert-danger">{{ session('error') }}</div>
                        @endif

                        @if ($organizers->count() > 0)
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('Organizer Name') }}</th>
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
                                        <form action="{{ route('admin.organizers.approve', $organizer->id) }}" method="POST" style="display:inline-block;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">{{ __('Approve') }}</button>
                                        </form>

                                        <form action="{{ route('admin.organizers.cancel', $organizer->id) }}" method="POST" style="display:inline-block; margin-left: 5px;">
                                            @csrf
                                            <button type="submit" class="btn btn-danger btn-sm">{{ __('Cancel') }}</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                        @else
                        <p class="text-center m-0">{{ __('No organizers pending approval.') }}</p>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endsection