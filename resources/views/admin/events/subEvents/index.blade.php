@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Manage Sub Events</h1>
    <a href="{{ route('admin.events.subEvents.create') }}" class="btn btn-primary mb-3">Add New Sub Event</a>

    @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
    @endif

    <table class="table table-bordered">
        <thead>
            <tr>
                <th>Sub Event Name</th>
                <th>Event</th>
                <th>Distance (km)</th>
                <th>Registration Fee</th>
                <th>Actions</th>
            </tr>
        </thead>
        <tbody>
            @forelse($subEvents as $subEvent)
            <tr>
                <td>{{ $subEvent->sub_event_name }}</td>
                <td>{{ $subEvent->event->event_name ?? '-' }}</td>
                <td>{{ $subEvent->sub_event_distance }}</td>
                <td>฿{{ number_format($subEvent->registration_fee, 2) }}</td>
                <td>
                    <a href="{{ route('admin.events.subEvents.edit', $subEvent->id) }}" class="btn btn-warning btn-sm">Edit</a>
                    <form action="{{ route('admin.events.subEvents.destroy', $subEvent->id) }}" method="POST" style="display:inline-block;">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('Are you sure?')">Delete</button>
                    </form>
                </td>
            </tr>
            @empty
            <tr>
                <td colspan="5" class="text-center">No Sub Events Found</td>
            </tr>
            @endforelse
        </tbody>
    </table>
</div>
@endsection