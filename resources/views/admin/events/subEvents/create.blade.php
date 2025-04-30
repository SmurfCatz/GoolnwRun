@extends('layouts.app')

@section('content')
<div class="container mt-5">
    <h1 class="mb-4">Add New Sub Event</h1>
    <form action="{{ route('admin.events.subEvents.store', ['eventId' => $eventId]) }}" method="POST">
        @csrf
        <div class="form-group">
            <label for="sub_event_name">Sub Event Name</label>
            <input type="text" name="sub_event_name" id="sub_event_name" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="sub_event_distance">Distance (km)</label>
            <input type="number" name="sub_event_distance" id="sub_event_distance" class="form-control" required>
        </div>
        <div class="form-group">
            <label for="registration_fee">Registration Fee</label>
            <input type="number" name="registration_fee" id="registration_fee" class="form-control" required>
        </div>
        <button type="submit" class="btn btn-primary">Create Sub Event</button>
    </form>
</div>
@endsection