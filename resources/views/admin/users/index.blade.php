@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-10">
            <div class="card shadow-lg border-0">
                <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                    <h5 class="mb-0">{{ __('Members Management') }}</h5>
                    <a href="{{ route('admin.users.create') }}" class="btn btn-light btn-sm">{{ __('Create New Member') }}</a>
                </div>

                <div class="card-body">
                    @if(session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if($Member->isEmpty())
                        <p class="text-center">{{ __('No members found.') }}</p>
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
                                @foreach($Member as $member)
                                    <tr>
                                        <td>{{ $member->member_name }}</td>
                                        <td>{{ $member->member_email }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.users.edit', $member->id) }}" class="btn btn-warning btn-sm">{{ __('Edit') }}</a>
                                            <form action="{{ route('admin.users.destroy', $member->id) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('{{ __('Are you sure you want to delete this member?') }}')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">{{ __('Delete') }}</button>
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
