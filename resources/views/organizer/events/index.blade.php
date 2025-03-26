@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>กิจกรรมที่หมดอายุ</h1>

        @if (session('success'))
            <div class="alert alert-success">{{ session('success') }}</div>
        @endif

        @if ($expiredActivities->isEmpty())
            <p>ยังไม่มีกิจกรรมที่หมดอายุ</p>
        @else
            <table class="table">
                <thead>
                    <tr>
                        <th>#</th>
                        <th>ชื่อกิจกรรม</th>
                        <th>วันที่จัด</th>
                        <th>หมวดหมู่</th>
                        <th>จัดการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($expiredActivities as $activity)
                        <tr>
                            <td>{{ $loop->iteration }}</td>
                            <td>{{ $activity->name }}</td>
                            <td>{{ $activity->event_date->format('d/m/Y') }}</td>
                            <td>{{ $activity->category }}</td>
                            <td>
                                <form action="{{ route('organizer.activities.createPost', $activity->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-primary">สร้างโพสต์</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @endif
    </div>
@endsection
