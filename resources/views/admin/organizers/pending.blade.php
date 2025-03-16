@extends('layouts.app')

@section('content')
    <div class="container">
        <h2>รายการ Organizer ที่รอการอนุมัติ</h2>

        @if (session('status'))
            <div class="alert alert-success">{{ session('status') }}</div>
        @endif

        @if ($organizers->count() > 0)
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ชื่อผู้จัดงาน</th>
                        <th>Email</th>
                        <th>ดำเนินการ</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($organizers as $organizer)
                        <tr>
                            <td>{{ $organizer->organizer_name }}</td>
                            <td>{{ $organizer->organizer_email }}</td>
                            <td>
                                <form action="{{ route('admin.organizers.approve', $organizer->id) }}" method="POST">
                                    @csrf
                                    <button type="submit" class="btn btn-success">อนุมัติ</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        @else
            <p>ไม่มีผู้จัดงานที่รอการอนุมัติ</p>
        @endif
    </div>
@endsection
