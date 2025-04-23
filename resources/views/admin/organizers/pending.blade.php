@extends('layouts.app')

@section('content')
<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar" id="sidebar">
        @include('components.sidebar')
    </div>

    <!-- Main Content -->
    <div class="container mt-5">
        <div class="row justify-content-start mx-5">
            <div class="col-md-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header bg-primary text-white d-flex justify-content-between align-items-center">
                        <h4 class="mb-0 ">{{ __('Pending Organizer Approvals') }}</h4>
                    </div>

                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success">
                            {{ session('status') }}
                        </div>
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
                                        <form action="{{ route('admin.organizers.approve', $organizer->id) }}" method="POST" style="display: inline;">
                                            @csrf
                                            <button type="submit" class="btn btn-success btn-sm">
                                                {{ __('Approve') }}
                                            </button>
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