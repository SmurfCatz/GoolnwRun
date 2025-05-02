@extends('layouts.app')

@section('content')

<div style="background: #ffffff; min-height: 100vh; padding: 2rem 0;">
    <div class="d-flex">
        <!-- Sidebar -->
        <div class="sidebar" style="margin-left: 100px;">
            @include('components.usersidebar')
        </div>

        <!-- Main Content -->
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8">
                    <div class="card p-4 shadow-lg" style="min-height: 700px;">
                        <h1 class="text-center mb-4">{{ __('messages.profile') }}</h1>

                        @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                        @endif

                        <form id="profileForm" method="POST" action="{{ route('profile.update') }}" enctype="multipart/form-data">
                            @csrf
                            @method('PUT')

                            <div class="d-flex align-items-center mb-4">
                                <!-- รูปโปรไฟล์ -->
                                <div class="col-md-2 text-center">
                                    <div class="profile-picture-container text-center mb-3">
                                        <img id="profile_picture_preview"
                                            src="{{ $Member->member_image ? asset('storage/' . $Member->member_image) : asset('images/default-avatar.png') }}"
                                            alt="Profile Picture" class="profile-picture" width="100" height="100"
                                            style="border-radius: 50%; object-fit: cover;">
                                    </div>
                                </div>

                                <!-- ปุ่มอัปโหลดและลบรูปภาพ -->
                                <div class="buttons-container ">
                                    <div class="d-flex ">
                                        <input type="file" id="member_image" name="member_image" accept="image/*" style="display: none;" onchange="previewImage(event)">
                                        <label for="member_image" class="btn-picupload me-2">{{ __('messages.upload picture') }}</label>
                                        <button type="button" class="btn-delete btn-danger" onclick="submitRemoveImageForm()">{{ __('messages.delete picture') }}</button>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <!-- ชื่อผู้ใช้ -->
                                <div class="mb-3 w-50">
                                    <label for="member_name" class="form-label">{{ __('messages.user name') }}</label>
                                    <input type="text" class="form-control" id="member_name" name="member_name" value="{{ old('member_name', $Member->member_name) }}" required>
                                    @if ($errors->has('member_name'))
                                    <div class="text-danger">{{ $errors->first('member_name') }}</div>
                                    @endif
                                </div>

                                <!-- อีเมล -->
                                <div class="mb-3 w-50">
                                    <label for="member_email" class="form-label">{{ __('messages.email') }}</label>
                                    <input type="email" class="form-control" id="member_email" name="member_email" value="{{ old('member_email', $Member->member_email) }}" required>
                                    @if ($errors->has('member_email'))
                                    <div class="text-danger">{{ $errors->first('member_email') }}</div>
                                    @endif
                                </div>

                                <!-- เบอร์โทรศัพท์ -->
                                <div class="mb-3 w-50">
                                    <label for="member_tel" class="form-label">{{ __('messages.telephone') }}</label>
                                    <input type="text" class="form-control" id="member_tel" name="member_tel" value="{{ old('member_tel', $Member->member_tel) }}">
                                </div>

                                <!-- เพศ -->
                                <div class="mb-3 w-50">
                                    <label for="member_gender" class="form-label">{{ __('messages.gender') }}</label>
                                    <select class="form-control" id="member_gender" name="member_gender">
                                        <option value="male" {{ $Member->member_gender === 'male' ? 'selected' : '' }}>ชาย</option>
                                        <option value="female" {{ $Member->member_gender === 'female' ? 'selected' : '' }}>หญิง</option>
                                    </select>
                                </div>

                                <!-- วันเกิด -->
                                <div class="mb-3 w-50">
                                    <label for="member_dob" class="form-label">{{ __('messages.birthdate') }}</label>
                                    <input type="date" class="form-control" id="member_dob" name="member_dob" value="{{ old('member_dob', $Member->member_dob) }}">
                                </div>

                                <!--สัญชาติ -->
                                <div class="mb-3 w-50">
                                    <label for="member_nationality" class="form-label">{{ __('messages.nationality') }}</label>
                                    <select class="form-control" id="member_nationality" name="member_nationality">
                                        <option value="">-- กรุณาเลือกสัญชาติ --</option>
                                        <option value="Afghan" {{ old('member_nationality', $Member->member_nationality) == 'Afghan' ? 'selected' : '' }}>Afghan</option>
                                        <option value="Albanian" {{ old('member_nationality', $Member->member_nationality) == 'Albanian' ? 'selected' : '' }}>Albanian</option>
                                        <option value="Algerian" {{ old('member_nationality', $Member->member_nationality) == 'Algerian' ? 'selected' : '' }}>Algerian</option>
                                        <option value="American" {{ old('member_nationality', $Member->member_nationality) == 'American' ? 'selected' : '' }}>American</option>
                                        <option value="Argentinian" {{ old('member_nationality', $Member->member_nationality) == 'Argentinian' ? 'selected' : '' }}>Argentinian</option>
                                        <option value="Australian" {{ old('member_nationality', $Member->member_nationality) == 'Australian' ? 'selected' : '' }}>Australian</option>
                                        <option value="Austrian" {{ old('member_nationality', $Member->member_nationality) == 'Austrian' ? 'selected' : '' }}>Austrian</option>
                                        <option value="Bangladeshi" {{ old('member_nationality', $Member->member_nationality) == 'Bangladeshi' ? 'selected' : '' }}>Bangladeshi</option>
                                        <option value="Belgian" {{ old('member_nationality', $Member->member_nationality) == 'Belgian' ? 'selected' : '' }}>Belgian</option>
                                        <option value="Brazilian" {{ old('member_nationality', $Member->member_nationality) == 'Brazilian' ? 'selected' : '' }}>Brazilian</option>
                                        <option value="British" {{ old('member_nationality', $Member->member_nationality) == 'British' ? 'selected' : '' }}>British</option>
                                        <option value="Burmese" {{ old('member_nationality', $Member->member_nationality) == 'Burmese' ? 'selected' : '' }}>Burmese</option>
                                        <option value="Cambodian" {{ old('member_nationality', $Member->member_nationality) == 'Cambodian' ? 'selected' : '' }}>Cambodian</option>
                                        <option value="Canadian" {{ old('member_nationality', $Member->member_nationality) == 'Canadian' ? 'selected' : '' }}>Canadian</option>
                                        <option value="Chinese" {{ old('member_nationality', $Member->member_nationality) == 'Chinese' ? 'selected' : '' }}>Chinese</option>
                                        <option value="Colombian" {{ old('member_nationality', $Member->member_nationality) == 'Colombian' ? 'selected' : '' }}>Colombian</option>
                                        <option value="Danish" {{ old('member_nationality', $Member->member_nationality) == 'Danish' ? 'selected' : '' }}>Danish</option>
                                        <option value="Dutch" {{ old('member_nationality', $Member->member_nationality) == 'Dutch' ? 'selected' : '' }}>Dutch</option>
                                        <option value="Egyptian" {{ old('member_nationality', $Member->member_nationality) == 'Egyptian' ? 'selected' : '' }}>Egyptian</option>
                                        <option value="Emirati" {{ old('member_nationality', $Member->member_nationality) == 'Emirati' ? 'selected' : '' }}>Emirati</option>
                                        <option value="Filipino" {{ old('member_nationality', $Member->member_nationality) == 'Filipino' ? 'selected' : '' }}>Filipino</option>
                                        <option value="Finnish" {{ old('member_nationality', $Member->member_nationality) == 'Finnish' ? 'selected' : '' }}>Finnish</option>
                                        <option value="French" {{ old('member_nationality', $Member->member_nationality) == 'French' ? 'selected' : '' }}>French</option>
                                        <option value="German" {{ old('member_nationality', $Member->member_nationality) == 'German' ? 'selected' : '' }}>German</option>
                                        <option value="Greek" {{ old('member_nationality', $Member->member_nationality) == 'Greek' ? 'selected' : '' }}>Greek</option>
                                        <option value="Hungarian" {{ old('member_nationality', $Member->member_nationality) == 'Hungarian' ? 'selected' : '' }}>Hungarian</option>
                                        <option value="Indian" {{ old('member_nationality', $Member->member_nationality) == 'Indian' ? 'selected' : '' }}>Indian</option>
                                        <option value="Indonesian" {{ old('member_nationality', $Member->member_nationality) == 'Indonesian' ? 'selected' : '' }}>Indonesian</option>
                                        <option value="Iranian" {{ old('member_nationality', $Member->member_nationality) == 'Iranian' ? 'selected' : '' }}>Iranian</option>
                                        <option value="Iraqi" {{ old('member_nationality', $Member->member_nationality) == 'Iraqi' ? 'selected' : '' }}>Iraqi</option>
                                        <option value="Irish" {{ old('member_nationality', $Member->member_nationality) == 'Irish' ? 'selected' : '' }}>Irish</option>
                                        <option value="Israeli" {{ old('member_nationality', $Member->member_nationality) == 'Israeli' ? 'selected' : '' }}>Israeli</option>
                                        <option value="Italian" {{ old('member_nationality', $Member->member_nationality) == 'Italian' ? 'selected' : '' }}>Italian</option>
                                        <option value="Japanese" {{ old('member_nationality', $Member->member_nationality) == 'Japanese' ? 'selected' : '' }}>Japanese</option>
                                        <option value="Kazakh" {{ old('member_nationality', $Member->member_nationality) == 'Kazakh' ? 'selected' : '' }}>Kazakh</option>
                                        <option value="Korean" {{ old('member_nationality', $Member->member_nationality) == 'Korean' ? 'selected' : '' }}>Korean</option>
                                        <option value="Lao" {{ old('member_nationality', $Member->member_nationality) == 'Lao' ? 'selected' : '' }}>Lao</option>
                                        <option value="Lebanese" {{ old('member_nationality', $Member->member_nationality) == 'Lebanese' ? 'selected' : '' }}>Lebanese</option>
                                        <option value="Malaysian" {{ old('member_nationality', $Member->member_nationality) == 'Malaysian' ? 'selected' : '' }}>Malaysian</option>
                                        <option value="Mexican" {{ old('member_nationality', $Member->member_nationality) == 'Mexican' ? 'selected' : '' }}>Mexican</option>
                                        <option value="Moroccan" {{ old('member_nationality', $Member->member_nationality) == 'Moroccan' ? 'selected' : '' }}>Moroccan</option>
                                        <option value="Nepali" {{ old('member_nationality', $Member->member_nationality) == 'Nepali' ? 'selected' : '' }}>Nepali</option>
                                        <option value="New Zealander" {{ old('member_nationality', $Member->member_nationality) == 'New Zealander' ? 'selected' : '' }}>New Zealander</option>
                                        <option value="Nigerian" {{ old('member_nationality', $Member->member_nationality) == 'Nigerian' ? 'selected' : '' }}>Nigerian</option>
                                        <option value="Norwegian" {{ old('member_nationality', $Member->member_nationality) == 'Norwegian' ? 'selected' : '' }}>Norwegian</option>
                                        <option value="Pakistani" {{ old('member_nationality', $Member->member_nationality) == 'Pakistani' ? 'selected' : '' }}>Pakistani</option>
                                        <option value="Palestinian" {{ old('member_nationality', $Member->member_nationality) == 'Palestinian' ? 'selected' : '' }}>Palestinian</option>
                                        <option value="Peruvian" {{ old('member_nationality', $Member->member_nationality) == 'Peruvian' ? 'selected' : '' }}>Peruvian</option>
                                        <option value="Philippine" {{ old('member_nationality', $Member->member_nationality) == 'Philippine' ? 'selected' : '' }}>Philippine</option>
                                        <option value="Polish" {{ old('member_nationality', $Member->member_nationality) == 'Polish' ? 'selected' : '' }}>Polish</option>
                                        <option value="Portuguese" {{ old('member_nationality', $Member->member_nationality) == 'Portuguese' ? 'selected' : '' }}>Portuguese</option>
                                        <option value="Qatari" {{ old('member_nationality', $Member->member_nationality) == 'Qatari' ? 'selected' : '' }}>Qatari</option>
                                        <option value="Russian" {{ old('member_nationality', $Member->member_nationality) == 'Russian' ? 'selected' : '' }}>Russian</option>
                                        <option value="Saudi" {{ old('member_nationality', $Member->member_nationality) == 'Saudi' ? 'selected' : '' }}>Saudi</option>
                                        <option value="Singaporean" {{ old('member_nationality', $Member->member_nationality) == 'Singaporean' ? 'selected' : '' }}>Singaporean</option>
                                        <option value="South African" {{ old('member_nationality', $Member->member_nationality) == 'South African' ? 'selected' : '' }}>South African</option>
                                        <option value="Spanish" {{ old('member_nationality', $Member->member_nationality) == 'Spanish' ? 'selected' : '' }}>Spanish</option>
                                        <option value="Sri Lankan" {{ old('member_nationality', $Member->member_nationality) == 'Sri Lankan' ? 'selected' : '' }}>Sri Lankan</option>
                                        <option value="Swedish" {{ old('member_nationality', $Member->member_nationality) == 'Swedish' ? 'selected' : '' }}>Swedish</option>
                                        <option value="Swiss" {{ old('member_nationality', $Member->member_nationality) == 'Swiss' ? 'selected' : '' }}>Swiss</option>
                                        <option value="Syrian" {{ old('member_nationality', $Member->member_nationality) == 'Syrian' ? 'selected' : '' }}>Syrian</option>
                                        <option value="Taiwanese" {{ old('member_nationality', $Member->member_nationality) == 'Taiwanese' ? 'selected' : '' }}>Taiwanese</option>
                                        <option value="Thai" {{ old('member_nationality', $Member->member_nationality) == 'Thai' ? 'selected' : '' }}>Thai</option>
                                        <option value="Turkish" {{ old('member_nationality', $Member->member_nationality) == 'Turkish' ? 'selected' : '' }}>Turkish</option>
                                        <option value="Ukrainian" {{ old('member_nationality', $Member->member_nationality) == 'Ukrainian' ? 'selected' : '' }}>Ukrainian</option>
                                        <option value="Vietnamese" {{ old('member_nationality', $Member->member_nationality) == 'Vietnamese' ? 'selected' : '' }}>Vietnamese</option>
                                        <option value="Yemeni" {{ old('member_nationality', $Member->member_nationality) == 'Yemeni' ? 'selected' : '' }}>Yemeni</option>
                                    </select>
                                </div>
                            </div>
                        </form>

                        <!-- ลบรูปภาพ -->
                        <form id="formRemoveImage" action="{{ route('profile.removeImage') }}" method="POST" style="display: none;" onsubmit="return confirm('คุณแน่ใจหรือไม่ว่าจะลบรูปภาพนี้?')">
                            @csrf
                            @method('DELETE')
                        </form>

                        <!-- การแสดงที่อยู่ -->
                        <div class="form-group mt-4">
                            <h4>ที่อยู่ในการจัดส่ง</h4>

                            @foreach ($Member->addresses as $address)
                            <div class="card mb-3 shadow-sm address-card">
                                <div class="card-body">
                                    <div class="d-flex justify-content-between align-items-center">
                                        <div class="address-summary">
                                            <strong>บ้านเลขที่:</strong> {{ $address->address_house_number ?? 'ไม่มีข้อมูล' }}<br>
                                            <strong>ตำบล/แขวง:</strong> {{ $address->address_subdistrict ?? 'ไม่มีข้อมูล' }}<br>
                                            <strong>อำเภอ/เขต:</strong> {{ $address->address_district ?? 'ไม่มีข้อมูล' }}<br>
                                            <strong>จังหวัด:</strong> {{ $address->address_province ?? 'ไม่มีข้อมูล' }}<br>
                                            <strong>รหัสไปรษณีย์:</strong> {{ $address->address_postal_code ?? 'ไม่มีข้อมูล' }}
                                        </div>
                                        <div class="address-actions">
                                            <button type="button" class="btn btn-warning btn-sm" data-bs-toggle="modal" data-bs-target="#editAddressModal{{ $address->id }}">แก้ไข</button>
                                            <form action="{{ route('address.delete', $address->id) }}" method="POST" class="d-inline-block">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger btn-sm" onclick="return confirm('คุณต้องการลบที่อยู่นี้หรือไม่?')">ลบ</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Modal แก้ไขที่อยู่ (เหมือนเดิม) -->
                            <div class="modal fade" id="editAddressModal{{ $address->id }}" tabindex="-1" aria-labelledby="editAddressModalLabel{{ $address->id }}" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title" id="editAddressModalLabel{{ $address->id }}">แก้ไขที่อยู่</h5>
                                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                        </div>
                                        <div class="modal-body">
                                            <form action="{{ route('address.update', $address->id) }}" method="POST">
                                                @csrf
                                                @method('PUT')
                                                <div class="mb-3">
                                                    <label for="address_house_number" class="form-label">บ้านเลขที่</label>
                                                    <input type="text" class="form-control" id="address_house_number" name="address_house_number" value="{{ $address->address_house_number }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address_village" class="form-label">หมู่ที่</label>
                                                    <input type="text" class="form-control" id="address_village" name="address_village" value="{{ $address->address_village }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address_alley" class="form-label">ตรอก/ซอย</label>
                                                    <input type="text" class="form-control" id="address_alley" name="address_alley" value="{{ $address->address_alley }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address_road" class="form-label">ถนน</label>
                                                    <input type="text" class="form-control" id="address_road" name="address_road" value="{{ $address->address_road }}">
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address_subdistrict" class="form-label">ตำบล/แขวง</label>
                                                    <input type="text" class="form-control" id="address_subdistrict" name="address_subdistrict" value="{{ $address->address_subdistrict }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address_district" class="form-label">อำเภอ/เขต</label>
                                                    <input type="text" class="form-control" id="address_district" name="address_district" value="{{ $address->address_district }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address_province" class="form-label">จังหวัด</label>
                                                    <input type="text" class="form-control" id="address_province" name="address_province" value="{{ $address->address_province }}" required>
                                                </div>
                                                <div class="mb-3">
                                                    <label for="address_postal_code" class="form-label">รหัสไปรษณีย์</label>
                                                    <input type="text" class="form-control" id="address_postal_code" name="address_postal_code" value="{{ $address->address_postal_code }}" required>
                                                </div>
                                                <div class="d-grid gap-2 col-6 mx-auto">
                                                    <button class="btn btn-primary" type="submit">บันทึก</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            @endforeach

                            <!-- ปุ่มเพิ่มที่อยู่ใหม่ -->
                            <div class="mb-3">
                                <button type="button" class="btn-add-address" data-bs-toggle="modal" data-bs-target="#addressModal"> + เพิ่มที่อยู่ใหม่</button>
                            </div>


                            <div class="text-center mt-4">
                                <button type="button" class="btn-submit px-5" onclick="submitProfileForm()">บันทึกข้อมูลทั้งหมด</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @include('profile.address_modal')
        </div>
        @endsection



        <script>
            function previewImage(event) {
                const reader = new FileReader();
                reader.onload = function() {
                    document.getElementById('profile_picture_preview').src = reader.result;
                }
                reader.readAsDataURL(event.target.files[0]);
            }

            function submitRemoveImageForm() {
                const confirmDelete = confirm('คุณแน่ใจหรือไม่ว่าจะลบรูปภาพนี้?');
                if (confirmDelete) {
                    document.getElementById('formRemoveImage').submit();
                }
            }

            function submitProfileForm() {
                document.getElementById('profileForm').submit();
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
                background-color: rgb(255, 255, 255);
                transform: translateY(-5px);
            }

            .btn {
                transition: background-color 0.3s ease, transform 0.3s ease;
            }

            .btn:hover {
                transform: scale(1.05);
            }

            .btn-add-address {
                background-color: rgb(225, 216, 238);
                color: rgb(130, 66, 225);
                border: none;
                border-radius: 12px;
                font-weight: 500;
                font-size: 16px transition: background-color 0.3s ease;
            }

            .btn-add-address:hover {
                background-color: rgb(225, 216, );
                transform: scale(1.05);
            }

            .btn-picupload {
                background-color: rgb(130, 66, 225);
                color: rgb(255, 255, 255);
                border: none;
                padding: 8px 16px;
                border-radius: 12px;
                font-weight: 500;
                font-size: 16px transition: background-color 0.3s ease;
            }

            .btn-picupload:hover {
                background-color: rgb(130, 66, 225);
                transform: scale(1.05);
            }

            .btn-delete {
                background-color: rgb(225, 216, 238);
                color: rgb(130, 66, 225);
                border: none;
                border-radius: 12px;
                font-weight: 500;
                font-size: 16px transition: background-color 0.3s ease;
            }

            .btn-delete:hover {
                background-color: rgb(225, 216, );
                transform: scale(1.05);
            }

            .btn-submit {
                background-color: rgb(130, 66, 225);
                color: rgb(255, 255, 255);
                border: none;
                padding: 8px 16px;
                border-radius: 12px;
                font-weight: 500;
                font-size: 16px transition: background-color 0.3s ease;
            }

            .btn-submit:hover {
                background-color: rgb(130, 66, 225);
                transform: scale(1.05);
            }
        </style>