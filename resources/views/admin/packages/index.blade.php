@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                        <h5 class="mb-0">{{ __('Package Management') }}</h5>
                        <a href="{{ route('admin.packages.create') }}"
                            class="btn btn-light btn-sm">{{ __('Add Package') }}</a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif

                        @if ($packages->isEmpty())
                            <p class="text-center">{{ __('No packages found.') }}</p>
                        @else
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('Name') }}</th>
                                        <th>{{ __('Price') }}</th>
                                        <th>{{ __('Max Participants') }}</th>
                                        <th>{{ __('Extra Fee/Person') }}</th>
                                        <th>{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($packages as $package)
                                        <tr>
                                            <td>{{ $package->package_name }}</td>
                                            <td>{{ $package->package_price }}</td>
                                            <td>{{ $package->package_maxparticipants ?? 'Unlimited' }}</td>
                                            <td>{{ $package->package_extra_fee_per_person }}</td>
                                            <td>
                                                <a href="{{ route('admin.packages.edit', $package->id) }}"
                                                    class="btn btn-warning btn-sm">{{ __('Edit') }}</a>
                                                <form method="POST"
                                                    action="{{ route('admin.packages.destroy', $package->id) }}"
                                                    style="display: inline;">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button class="btn btn-danger btn-sm"
                                                        onclick="return confirm('Are you sure?')">{{ __('Delete') }}</button>
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
@endsection
