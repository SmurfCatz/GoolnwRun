@extends('layouts.app')

@section('content')
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card shadow-lg border-0">
                    <div class="card-header d-flex justify-content-between align-items-center bg-primary text-white">
                        <h5 class="mb-0">{{ __('กิจกรรมทั้งหมด') }}</h5>
                        <a href="{{ route('organizer.events.create') }}"
                            class="btn btn-light btn-sm">{{ __('Add Event') }}</a>
                    </div>

                    <div class="card-body">
                        @if (session('success'))
                            <div class="alert alert-success">
                                {{ session('success') }}
                            </div>
                        @endif
                        
                        @if ($allEvents->isEmpty())
                            <p class="text-center">{{ __('No events found.') }}</p>
                        @else
                        <table class="table table-striped table-hover">
                            <thead>
                                <tr>
                                    <th>{{ __('ชื่อกิจกรรม') }}</th>
                                    <th>{{ __('วันที่จัด') }}</th>
                                    <th>{{ __('หมวดหมู่') }}</th>
                                    <th>{{ __('สถานะ') }}</th>
                                    <th>{{ __('จัดการ') }}</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach ($allEvents as $event)
                                    <tr>
                                        <td>{{ $loop->iteration }}</td>
                                        <td>{{ $event->event_date->format('d/m/Y') }}</td>
                                        <td>{{ $event->category }}</td>
                                        <td>
                                            @if ($event->event_date < now())
                                                <span class="badge bg-danger">{{ __('หมดอายุ') }}</span>
                                            @else
                                                <span class="badge bg-success">{{ __('ยังไม่หมดอายุ') }}</span>
                                            @endif
                                        </td>
                                        <td>
                                            <form action="{{ route('organizer.events.createPost', $event->id) }}"
                                                method="POST">
                                                @csrf
                                                <button type="submit"
                                                    class="btn btn-primary btn-sm">{{ __('สร้างโพสต์') }}</button>
                                            </form>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
                @endif
            </div>
        </div>
    </div>
@endsection
