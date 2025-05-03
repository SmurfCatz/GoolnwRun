@extends('layouts.app')
@section('hide-navbar')
@section('content')

<div class="d-flex">
    <!-- Sidebar -->
    <div class="sidebar mt-4 " id="sidebar-wrapper">
        @include('components.sidebar')
    </div>
    <div class="container mt-4">
        <h1 class="mb-4">Edit Event</h1>

        {{-- ฟอร์มแก้ไขกิจกรรมหลัก --}}
        <form action="{{ route('admin.events.update', $event->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="form-group mb-3">
                <label for="event_name">Event Name</label>
                <input type="text" name="event_name" id="event_name" class="form-control @error('event_name') is-invalid @enderror" value="{{ old('event_name', $event->event_name) }}" required>
                @error('event_name')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="event_date">Event Date</label>
                <input type="date" name="event_date" id="event_date" class="form-control @error('event_date') is-invalid @enderror" value="{{ old('event_date', $event->event_date) }}" required>
                @error('event_date')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <div class="form-group mb-3">
                <label for="event_category">Category</label>
                <select name="event_category" id="event_category" class="form-control @error('event_category') is-invalid @enderror" required>
                    <option value="Race" {{ $event->event_category == 'Race' ? 'selected' : '' }}>Race</option>
                    <option value="Virtual Run" {{ $event->event_category == 'Virtual Run' ? 'selected' : '' }}>Virtual Run</option>
                </select>
                @error('event_category')
                <div class="invalid-feedback">{{ $message }}</div>
                @enderror
            </div>

            <button type="submit" class="btn btn-primary">Update Event</button>
        </form>

        <hr class="my-5">

        {{-- แสดงข้อมูลกิจกรรมย่อย --}}
        <div class="container mt-5">
            <div class="row justify-content-start mx-5">
                <div class="col-md-10">
                    <div class="card shadow-lg border-0">
                        <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                            <h4 class="mb-0">{{ __('Sub Events') }}</h4>
                            <a href="{{ route('admin.events.subEvents.create', $event->id) }}" class="btn btn-light btn-sm">
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

                            <!-- Check if Sub Events Exist -->
                            @if($event->subEvents->isEmpty())
                            <p class="text-center">{{ __('No sub events found.') }}</p>
                            @else
                            <table class="table table-striped table-hover">
                                <thead>
                                    <tr>
                                        <th>{{ __('Sub Event Name') }}</th>
                                        <th>{{ __('Distance (km)') }}</th>
                                        <th>{{ __('Registration Fee') }}</th>
                                        <th class="text-center">{{ __('Actions') }}</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($event->subEvents as $subEvent)
                                    <tr>
                                        <td>{{ $subEvent->sub_event_name }}</td>
                                        <td>{{ $subEvent->sub_event_distance }} km</td>
                                        <td>฿{{ number_format($subEvent->registration_fee, 2) }}</td>
                                        <td class="text-center">
                                            <a href="{{ route('admin.events.subEvents.edit', ['eventId' => $event->id, 'subEventId' => $subEvent->id]) }}" class="btn btn-warning btn-sm">
                                                <i class="bi bi-pencil-square"></i> {{ __('Edit') }}
                                            </a>
                                            <form action="{{ route('admin.events.subEvents.destroy', ['eventId' => $event->id, 'subEventId' => $subEvent->id]) }}" method="POST" style="display:inline-block;" onsubmit="return confirm('Are you sure you want to delete this sub event?')">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm">
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
</div>
@endsection
@endsection