@extends('layouts.app')

@section('hide-navbar')
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
                <div class="card shadow-lg border-0">
                    <div class="card-header d-flex justify-content-between align-items-center text-white" style="background-color: #6f42c1;">
                        <h4 class="mb-0">{{ __('Admin Dashboard') }}</h4>
                    </div>
                    <div class="card-body">
                        @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                        @endif

                        <div class="row text-center">
                            <!-- Total Members -->
                            <div class="col-md-3 mb-3">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h5>Total Members</h5>
                                        <h2>{{ $totalMembers }}</h2>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Organizers -->
                            <div class="col-md-3 mb-3">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h5>Total Organizers</h5>
                                        <h2>{{ $totalOrganizers }}</h2>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Events -->
                            <div class="col-md-3 mb-3">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h5>Total Events</h5>
                                        <h2>{{ $totalEvents }}</h2>
                                    </div>
                                </div>
                            </div>

                            <!-- Total Packages -->
                            <div class="col-md-3 mb-3">
                                <div class="card border-0 shadow-sm">
                                    <div class="card-body">
                                        <h5>Total Packages</h5>
                                        <h2>{{ $totalPackages }}</h2>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <!-- Recent Users & Events -->
                        <div class="row mt-4">
                            <div class="col-md-6">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-light fw-bold">Recent Members</div>
                                    <ul class="list-group list-group-flush">
                                        @foreach ($recentMembers as $member)
                                        <li class="list-group-item">
                                            {{ $member->member_name }} <br>
                                            <small>{{ $member->email }}</small>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="card shadow-sm">
                                    <div class="card-header bg-light fw-bold">Recent Events</div>
                                    <ul class="list-group list-group-flush">
                                        @foreach ($recentEvents as $event)
                                        <li class="list-group-item">
                                            {{ $event->event_name }} <br>
                                            <small>{{ $event->created_at->format('d M Y') }}</small>
                                        </li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@endsection