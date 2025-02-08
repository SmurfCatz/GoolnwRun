@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 shadow-lg">
                    <h2 class="text-center mb-4">แก้ไขโปรไฟล์</h2>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- รูปโปรไฟล์ -->
                            <div class="col-md-4 text-center">
                                <div class="profile-picture-container text-center mb-3">
                                    <!-- แสดงรูปโปรไฟล์ปัจจุบันหรือรูปภาพดีฟอลต์ -->
                                    <img id="profile_picture_preview"
                                        src="{{ $Member->member_image ? asset('storage/' . $Member->member_image) : asset('images/default-avatar.png') }}"
                                        alt="Profile Picture" class="profile-picture" width="150" height="150"
                                        style="border-radius: 50%; object-fit: cover;">
                                </div>

                                <!-- ฟอร์มอัปโหลดไฟล์รูปโปรไฟล์ใหม่ -->
                                <input type="file" class="form-control mt-2" id="member_image" name="member_image"
                                    onchange="previewImage(event)">


                                <!-- แสดงข้อความข้อผิดพลาดจากการอัปโหลดรูป -->
                                @if ($errors->has('member_image'))
                                    <div class="text-danger mt-2">{{ $errors->first('member_image') }}</div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <!-- ชื่อผู้ใช้ -->
                                <div class="mb-3">
                                    <label for="member_name" class="form-label">ชื่อผู้ใช้</label>
                                    <input type="text" class="form-control" id="member_name" name="member_name"
                                        value="{{ old('member_name', $Member->member_name) }}" required>
                                    @if ($errors->has('member_name'))
                                        <div class="text-danger">{{ $errors->first('member_name') }}</div>
                                    @endif
                                </div>

                                <!-- อีเมล -->
                                <div class="mb-3">
                                    <label for="member_email" class="form-label">อีเมล</label>
                                    <input type="email" class="form-control" id="member_email" name="member_email"
                                        value="{{ old('member_email', $Member->member_email) }}" required>
                                    @if ($errors->has('member_email'))
                                        <div class="text-danger">{{ $errors->first('member_email') }}</div>
                                    @endif
                                </div>

                                <!-- เบอร์โทรศัพท์ -->
                                <div class="mb-3">
                                    <label for="member_tel" class="form-label">เบอร์โทรศัพท์</label>
                                    <input type="text" class="form-control" id="member_tel" name="member_tel"
                                        value="{{ old('member_tel', $Member->member_tel) }}">
                                </div>

                                <!-- เพศ -->
                                <div class="mb-3">
                                    <label for="member_gender" class="form-label">เพศ</label>
                                    <select class="form-control" id="member_gender" name="member_gender">
                                        <option value="male" {{ $Member->member_gender === 'male' ? 'selected' : '' }}>
                                            ชาย
                                        </option>
                                        <option value="female" {{ $Member->member_gender === 'female' ? 'selected' : '' }}>
                                            หญิง</option>
                                        <option value="other" {{ $Member->member_gender === 'other' ? 'selected' : '' }}>
                                            อื่นๆ</option>
                                    </select>
                                </div>

                                <!-- วันเกิด -->
                                <div class="mb-3">
                                    <label for="member_dob" class="form-label">วันเกิด</label>
                                    <input type="date" class="form-control" id="member_dob" name="member_dob"
                                        value="{{ old('member_dob', $Member->member_dob) }}">
                                </div>

                                <!-- ปุ่มบันทึกโปรไฟล์ -->
                                <div class="mb-3 text-center">
                                    <button type="submit" class="btn btn-primary">อัปเดตโปรไฟล์</button>
                                </div>
                            </div>
                        </div>
                    </form>


                    <!-- การแสดงที่อยู่ -->
                    <div class="form-group">
                        <h4>ที่อยู่ในการจัดส่ง</h4>
                        @foreach ($Member->addresses as $address)
                            <div class="card mb-3 shadow-sm address-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="address-summary">
                                            <strong>บ้านเลขที่:</strong>
                                            {{ $address->address_house_number ?? 'ไม่มีข้อมูล' }}<br>
                                            <strong>ตำบล/แขวง:</strong>
                                            {{ $address->address_subdistrict ?? 'ไม่มีข้อมูล' }}<br>
                                            <strong>อำเภอ/เขต:</strong>
                                            {{ $address->address_district ?? 'ไม่มีข้อมูล' }}<br>
                                            <strong>จังหวัด:</strong>
                                            {{ $address->address_province ?? 'ไม่มีข้อมูล' }}<br>
                                            <strong>รหัสไปรษณีย์:</strong>
                                            {{ $address->address_postal_code ?? 'ไม่มีข้อมูล' }}
                                        </div>

                                        <div class="address-actions">

                                            <!-- ปุ่มแก้ไข -->
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal"
                                                data-bs-target="#editAddressModal{{ $address->id }}">แก้ไข</button>

                                            <!-- ปุ่มลบ -->
                                            <form action="{{ route('address.delete', $address->id) }}" method="POST"
                                                class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm"
                                                    onclick="return confirm('คุณต้องการลบที่อยู่นี้หรือไม่?')">ลบ</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal แก้ไขที่อยู่ (เหมือนเดิม) -->
                            <div class="modal fade" id="editAddressModal{{ $address->id }}" tabindex="-1"
                                aria-labelledby="editAddressModalLabel{{ $address->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editAddressModalLabel{{ $address->id }}">
                                                แก้ไขที่อยู่</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal"
                                                aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('address.update', $address->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')

                                                <!-- บ้านเลขที่ -->
                                                <div class="mb-3">
                                                    <label for="address_house_number"
                                                        class="form-label">บ้านเลขที่</label>
                                                    <input type="text" class="form-control" id="address_house_number"
                                                        name="address_house_number"
                                                        value="{{ $address->address_house_number }}" required>
                                                </div>

                                                <!-- หมู่ที่ -->
                                                <div class="mb-3">
                                                    <label for="address_village" class="form-label">หมู่ที่</label>
                                                    <input type="text" class="form-control" id="address_village"
                                                        name="address_village" value="{{ $address->address_village }}">
                                                </div>

                                                <!-- ตรอก/ซอย -->
                                                <div class="mb-3">
                                                    <label for="address_alley" class="form-label">ตรอก/ซอย</label>
                                                    <input type="text" class="form-control" id="address_alley"
                                                        name="address_alley" value="{{ $address->address_alley }}">
                                                </div>

                                                <!-- ถนน -->
                                                <div class="mb-3">
                                                    <label for="address_road" class="form-label">ถนน</label>
                                                    <input type="text" class="form-control" id="address_road"
                                                        name="address_road" value="{{ $address->address_road }}">
                                                </div>

                                                <!-- ตำบล/แขวง -->
                                                <div class="mb-3">
                                                    <label for="address_subdistrict" class="form-label">ตำบล/แขวง</label>
                                                    <input type="text" class="form-control" id="address_subdistrict"
                                                        name="address_subdistrict"
                                                        value="{{ $address->address_subdistrict }}" required>
                                                </div>

                                                <!-- อำเภอ/เขต -->
                                                <div class="mb-3">
                                                    <label for="address_district" class="form-label">อำเภอ/เขต</label>
                                                    <input type="text" class="form-control" id="address_district"
                                                        name="address_district" value="{{ $address->address_district }}"
                                                        required>
                                                </div>

                                                <!-- จังหวัด -->
                                                <div class="mb-3">
                                                    <label for="address_province" class="form-label">จังหวัด</label>
                                                    <input type="text" class="form-control" id="address_province"
                                                        name="address_province" value="{{ $address->address_province }}"
                                                        required>
                                                </div>

                                                <!-- รหัสไปรษณีย์ -->
                                                <div class="mb-3">
                                                    <label for="address_postal_code"
                                                        class="form-label">รหัสไปรษณีย์</label>
                                                    <input type="text" class="form-control" id="address_postal_code"
                                                        name="address_postal_code"
                                                        value="{{ $address->address_postal_code }}" required>
                                                </div>

                                                <!-- ปุ่มบันทึกการแก้ไข -->
                                                <button type="submit" class="btn btn-primary">บันทึกการแก้ไข</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endforeach


                        <!-- ปุ่มเพิ่มที่อยู่ใหม่ -->
                        <button type="button" class="btn btn-secondary mt-3" data-bs-toggle="modal"
                            data-bs-target="#addressModal">เพิ่มที่อยู่ใหม่</button>
                    </div>
                </div>
            </div>
            </form>
            @include('profile.address_modal')
        </div>
    </div>
    </div>
    </div>
@endsection

<script>
    // ฟังก์ชันสำหรับแสดงตัวอย่างรูปภาพก่อนอัปโหลด
    function previewImage(event) {
        const reader = new FileReader();
        reader.onload = function() {
            // แสดงรูปภาพที่เลือกใน element
            document.getElementById('profile_picture_preview').src = reader.result;
        }
        reader.readAsDataURL(event.target.files[0]);
    }
</script>
<style>
    .profile-picture-container {
        transition: transform 0.3s ease;
    }

    .profile-picture-container:hover {
        transform: scale(1.1);
    }

    .address-card {
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .address-card:hover {
        background-color: #f8f9fa;
        transform: translateY(-5px);
    }

    .btn {
        transition: background-color 0.3s ease, transform 0.3s ease;
    }

    .btn:hover {
        transform: scale(1.05);
    }
</style>
