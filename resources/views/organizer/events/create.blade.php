@extends('layouts.app')

@section('content')
    <div class="container py-4">
        <h1 class="text-center mb-4">สร้างกิจกรรมใหม่</h1>

        @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <form action="{{ route('organizer.events.store') }}" method="POST" enctype="multipart/form-data">
            @csrf

            <!-- Step 1: เลือกแพ็กเกจ -->
            <div class="step" id="step-1">
                <h3 class="text-center mb-4">ขั้นตอนที่ 1: เลือกแพ็กเกจ</h3>

                <div class="row">
                    @foreach ($packages as $package)
                        <div class="col-md-4 mb-3">
                            <div class="card shadow-sm package-card" data-id="{{ $package->id }}">
                                <div class="card-body">
                                    <h5 class="card-title">{{ $package->package_name }}</h5>
                                    <p class="card-text">ราคา: {{ number_format($package->package_price, 2) }} บาท</p>
                                    <p class="card-text">จำนวนผู้เข้าร่วมสูงสุด: {{ $package->package_maxparticipants }} คน
                                    </p>
                                    <p class="card-text">ค่าสมัครเพิ่มเติม:
                                        {{ number_format($package->package_extra_fee_per_person, 2) }} บาท</p>
                                    <button type="button" class="btn btn-outline-primary select-package"
                                        data-id="{{ $package->id }}">เลือกแพ็กเกจนี้</button>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>

                <input type="hidden" id="selected_package_id" name="package_id">
                <div class="text-right">
                    <button type="button" class="btn btn-primary" id="next-1" disabled>ถัดไป</button>
                </div>
                <div id="package-warning" class="alert alert-warning mt-3" style="display: none;">
                    กรุณาเลือกแพ็กเกจก่อน
                </div>
            </div>

            <!-- Step 2: กรอกข้อมูลกิจกรรม -->
            <div class="step" id="step-2" style="display:none;">
                <h3 class="text-center mb-4">ขั้นตอนที่ 2: กรอกข้อมูลกิจกรรม</h3>

                <div class="mb-3">
                    <label for="name" class="form-label">ชื่อกิจกรรม</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="event_date" class="form-label">วันที่จัดกิจกรรม</label>
                    <input type="date" name="event_date" id="event_date" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="category" class="form-label">หมวดหมู่</label>
                    <select name="category" id="category" class="form-control" required>
                        <option value="Race">Race</option>
                        <option value="Virtual Run">Virtual Run</option>
                    </select>
                </div>

                <div class="mb-3">
                    <label for="location" class="form-label">สถานที่</label>
                    <input type="text" name="location" id="location" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="registration_start" class="form-label">วันเริ่มรับสมัคร</label>
                    <input type="date" name="registration_start" id="registration_start" class="form-control" required>
                </div>

                <div class="mb-3">
                    <label for="registration_end" class="form-label">วันสิ้นสุดรับสมัคร</label>
                    <input type="date" name="registration_end" id="registration_end" class="form-control" required>
                </div>

                <div class="text-left">
                    <button type="button" class="btn btn-secondary" id="prev-2">ย้อนกลับ</button>
                    <button type="button" class="btn btn-primary" id="next-2">ถัดไป</button>
                </div>
            </div>

            <!-- Step 3: กรอกข้อมูลการแข่งขัน -->
            <div class="step" id="step-3" style="display:none;">
                <h3 class="text-center mb-4">ขั้นตอนที่ 3: กรอกข้อมูลการแข่งขัน</h3>

                <div id="competition-types">
                    <label class="form-label">ประเภทการแข่งขัน</label>
                    <div class="mb-3">
                        <input type="text" name="competition_types[0][name]" class="form-control mb-2"
                            placeholder="ชื่อประเภท">
                        <input type="text" name="competition_types[0][distance]" class="form-control mb-2"
                            placeholder="ระยะทาง">
                        <input type="number" name="competition_types[0][fee]" class="form-control"
                            placeholder="ค่าสมัคร (บาท)">
                    </div>
                </div>

                <button type="button" id="add-competition-type" class="btn btn-secondary mb-3">+
                    เพิ่มประเภทการแข่งขัน</button>

                <div class="mb-3">
                    <label for="shirt_image" class="form-label">อัปโหลดรูปเสื้อ</label>
                    <input type="file" name="shirt_image" id="shirt_image" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="modal_image" class="form-label">อัพโหลดรูปเหรียญรางวัล</label>
                    <input type="file" name="modal_image" id="modal_image" class="form-control">
                </div>

                <div class="mb-3">
                    <label for="additional_details" class="form-label">รายละเอียดเพิ่มเติม</label>
                    <textarea name="additional_details" id="additional_details" class="form-control" rows="3"
                        placeholder="กรุณาใส่รายละเอียดเพิ่มเติมเกี่ยวกับกิจกรรม"></textarea>
                </div>

                <div class="text-left">
                    <button type="button" class="btn btn-secondary" id="prev-3">ย้อนกลับ</button>
                    <button type="submit" class="btn btn-primary">บันทึกกิจกรรม</button>
                </div>
            </div>
        </form>
    </div>

    <script>
        let counter = 1;

        // เพิ่มประเภทการแข่งขัน
        document.getElementById('add-competition-type').addEventListener('click', function() {
            const container = document.getElementById('competition-types');
            const html = `
            <div class="mb-3">
                <input type="text" name="competition_types[${counter}][name]" class="form-control mb-2" placeholder="ชื่อประเภท">
                <input type="text" name="competition_types[${counter}][distance]" class="form-control mb-2" placeholder="ระยะทาง">
                <input type="number" name="competition_types[${counter}][fee]" class="form-control" placeholder="ค่าสมัคร (บาท)">
            </div>`;
            container.insertAdjacentHTML('beforeend', html);
            counter++;
        });

        // ไปขั้นตอนถัดไป
        document.getElementById('next-1').addEventListener('click', function() {
            const packageId = document.getElementById('selected_package_id').value;
            if (packageId) {
                document.getElementById('step-1').style.display = 'none';
                document.getElementById('step-2').style.display = 'block';
                document.getElementById('package-warning').style.display = 'none'; // ซ่อนข้อความเตือน
            } else {
                document.getElementById('package-warning').style.display = 'block'; // แสดงข้อความเตือน
            }
        });

        document.getElementById('next-2').addEventListener('click', function() {
            document.getElementById('step-2').style.display = 'none';
            document.getElementById('step-3').style.display = 'block';
        });

        // ย้อนกลับ
        document.getElementById('prev-2').addEventListener('click', function() {
            document.getElementById('step-2').style.display = 'none';
            document.getElementById('step-1').style.display = 'block';
        });

        document.getElementById('prev-3').addEventListener('click', function() {
            document.getElementById('step-3').style.display = 'none';
            document.getElementById('step-2').style.display = 'block';
        });

        // เลือกแพ็กเกจ
        const selectPackageButtons = document.querySelectorAll('.select-package');
        selectPackageButtons.forEach(button => {
            button.addEventListener('click', function() {
                const packageId = this.getAttribute('data-id');
                document.getElementById('selected_package_id').value = packageId;

                // ตั้งค่า package_id ใน session ผ่าน AJAX
                fetch("{{ route('organizer.events.setPackage') }}", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/json",
                            "X-CSRF-TOKEN": document.querySelector('meta[name="csrf-token"]')
                                .getAttribute('content')
                        },
                        body: JSON.stringify({
                            package_id: packageId
                        })
                    }).then(response => response.json())
                    .then(data => {
                        console.log(data.message); // ตรวจสอบการตั้งค่า
                    });

                // ลบคลาสที่เลือกจากทุกแพ็กเกจ
                const allPackages = document.querySelectorAll('.package-card');
                allPackages.forEach(pkg => pkg.classList.remove('selected-package'));

                // เพิ่มคลาสที่เลือกให้กับแพ็กเกจที่เลือก
                this.closest('.package-card').classList.add('selected-package');

                // เปิดปุ่มถัดไป
                document.getElementById('next-1').disabled = false;
            });
        });
    </script>

    <style>
        /* CSS สำหรับเปลี่ยนสีของแพ็กเกจที่ถูกเลือก */
        .selected-package {
            border: 2px solid #007bff;
            background-color: #e7f3ff;
        }
    </style>
@endsection
