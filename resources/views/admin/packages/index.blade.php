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
                    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                        <h4 class="mb-0">{{ __('Package Management') }}</h4>
                        <a href="{{ route('admin.packages.create') }}"
                            class="btn btn-light btn-sm">
                            <i class="bi bi-plus-circle"></i> {{ __('Add Package') }}
                        </a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            {{ session('success') }}
                            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                        </div>
                        @endif

                        @if ($packages->isEmpty())
                        <div class="text-center ">
                            <i class="bi bi-box-seam fs-1 text-muted"></i>
                            <p class="m-0">{{ __('No packages found.') }}</p>
                        </div>
                        @else
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('Name') }}</th>
                                    <th>{{ __('Price') }}</th>
                                    <th>{{ __('Max Participants') }}</th>
                                    <th>{{ __('Extra Fee/Person') }}</th>
                                    <th class="text-center">{{ __('Actions') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($packages as $package)
                                <tr>
                                    <td>{{ $package->package_name }}</td>
                                    <td>{{ number_format($package->package_price, 2) }}</td>
                                    <td>
                                        {{ $package->package_maxparticipants 
                                            ? $package->package_maxparticipants 
                                            : __('Unlimited') }}
                                    </td>
                                    <td>{{ number_format($package->package_extra_fee_per_person, 2) }}</td>
                                    <td class="text-center">
                                        <a href="{{ route('admin.packages.edit', $package->id) }}"
                                            class="btn btn-warning btn-sm">
                                            <i class="bi bi-pencil-square"></i> {{ __('Edit') }}
                                        </a>
                                        <form method="POST"
                                            action="{{ route('admin.packages.destroy', $package->id) }}"
                                            style="display: inline;">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger btn-sm"
                                                onclick="return confirm('{{ __('Are you sure you want to delete this package?') }}')">
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