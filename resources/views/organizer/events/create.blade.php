@extends('layouts.app')

@section('content')
    <div class="container">
        <h1>สร้างกิจกรรมใหม่</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('organizer.activities.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- เลือกแพ็กเกจ -->
            <div class="mb-3">
                <label for="package_id" class="form-label">เลือกแพ็กเกจ</label>
                <select name="package_id" id="package_id" class="form-control" required>
                    <option value="">-- เลือกแพ็กเกจ --</option>
                    @foreach ($packages as $package)
                        <option value="{{ $package->id }}">{{ $package->name }} - {{ number_format($package->price, 2) }}
                            บาท</option>
                    @endforeach
                </select>
            </div>

            <!-- ชื่อกิจกรรม -->
            <div class="mb-3">
                <label for="name" class="form-label">ชื่อกิจกรรม</label>
                <input type="text" name="name" id="name" class="form-control" required>
            </div>

            <!-- วันที่จัดกิจกรรม -->
            <div class="mb-3">
                <label for="event_date" class="form-label">วันที่จัดกิจกรรม</label>
                <input type="date" name="event_date" id="event_date" class="form-control" required>
            </div>

            <!-- หมวดหมู่ -->
            <div class="mb-3">
                <label for="category" class="form-label">หมวดหมู่</label>
                <input type="text" name="category" id="category" class="form-control" required>
            </div>

            <!-- ประเภทการแข่งขัน -->
            <div id="competition-types">
                <label class="form-label">ประเภทการแข่งขัน</label>
                <div class="mb-3">
                    <input type="text" name="competition_types[0][name]" class="form-control mb-2"
                        placeholder="ชื่อประเภท">
                    <input type="number" name="competition_types[0][fee]" class="form-control"
                        placeholder="ค่าสมัคร (บาท)">
                </div>
            </div>
            <button type="button" id="add-competition-type" class="btn btn-secondary mb-3">+ เพิ่มประเภทการแข่งขัน</button>

            <!-- สถานที่ -->
            <div class="mb-3">
                <label for="location" class="form-label">สถานที่</label>
                <input type="text" name="location" id="location" class="form-control" required>
            </div>

            <!-- ช่วงเวลารับสมัคร -->
            <div class="mb-3">
                <label for="registration_start" class="form-label">วันเริ่มรับสมัคร</label>
                <input type="date" name="registration_start" id="registration_start" class="form-control" required>
            </div>

            <div class="mb-3">
                <label for="registration_end" class="form-label">วันสิ้นสุดรับสมัคร</label>
                <input type="date" name="registration_end" id="registration_end" class="form-control" required>
            </div>

            <!-- ของที่ระลึก -->
            <div class="mb-3">
                <label for="souvenirs" class="form-label">ของที่ระลึก</label>
                <input type="text" name="souvenirs[]" class="form-control mb-2">
                <input type="text" name="souvenirs[]" class="form-control mb-2">
            </div>

            <!-- รูปเสื้อ -->
            <div class="mb-3">
                <label for="shirt_image" class="form-label">อัปโหลดรูปเสื้อ</label>
                <input type="file" name="shirt_image" id="shirt_image" class="form-control">
            </div>

            <!-- ปุ่มบันทึก -->
            <button type="submit" class="btn btn-primary">บันทึกกิจกรรม</button>
        </form>
    </div>

    <script>
        let counter = 1;
        document.getElementById('add-competition-type').addEventListener('click', function() {
            const container = document.getElementById('competition-types');
            const html = `
            <div class="mb-3">
                <input type="text" name="competition_types[${counter}][name]" class="form-control mb-2" placeholder="ชื่อประเภท">
                <input type="number" name="competition_types[${counter}][fee]" class="form-control" placeholder="ค่าสมัคร (บาท)">
            </div>`;
            container.insertAdjacentHTML('beforeend', html);
            counter++;
        });
    </script>
@endsection
