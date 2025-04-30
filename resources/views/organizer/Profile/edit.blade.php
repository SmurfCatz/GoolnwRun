@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card p-4 shadow-lg">
                    <h2 class="text-center mb-4">แก้ไขโปรไฟล์ผู้จัดงาน</h2>

                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    <form method="POST" action="{{ route('organizer.profile.update') }}" enctype="multipart/form-data">
                        @csrf
                        @method('PUT')
                        <div class="row">
                            <!-- รูปโปรไฟล์ -->
                            <div class="col-md-4 text-center">
                                <div class="profile-picture-container text-center mb-3">
                                    <img id="profile_picture_preview"
                                        src="{{ $Organizer->organizer_image ? asset('storage/' . $Organizer->organizer_image) : asset('images/default-avatar.png') }}"
                                        alt="Profile Picture" class="profile-picture" width="150" height="150"
                                        style="border-radius: 50%; object-fit: cover;">

                                </div>

                                <input type="file" class="form-control mt-2" id="organizer_image" name="organizer_image"
                                    onchange="previewImage(event)">

                                @if ($errors->has('organizer_image'))
                                    <div class="text-danger mt-2">{{ $errors->first('organizer_image') }}</div>
                                @endif
                            </div>
                            <div class="col-md-8">
                                <!-- ชื่อองค์กร -->
                                <div class="mb-3">
                                    <label for="organizer_name" class="form-label">ชื่อองค์กร</label>
                                    <input type="text" class="form-control" id="organizer_name" name="organizer_name"
                                        value="{{ old('organizer_name', $Organizer->organizer_name) }}" required>
                                    @if ($errors->has('organizer_name'))
                                        <div class="text-danger">{{ $errors->first('organizer_name') }}</div>
                                    @endif
                                </div>

                                <!-- อีเมล -->
                                <div class="mb-3">
                                    <label for="organizer_email" class="form-label">อีเมล</label>
                                    <input type="email" class="form-control" id="organizer_email" name="organizer_email"
                                        value="{{ old('organizer_email', $Organizer->organizer_email) }}" required>
                                    @if ($errors->has('organizer_email'))
                                        <div class="text-danger">{{ $errors->first('organizer_email') }}</div>
                                    @endif
                                </div>

                                <!-- เบอร์โทรศัพท์ -->
                                <div class="mb-3">
                                    <label for="organizer_tel" class="form-label">เบอร์โทรศัพท์</label>
                                    <input type="text" class="form-control" id="organizer_tel" name="organizer_tel"
                                        value="{{ old('organizer_tel', $Organizer->organizer_tel) }}">
                                </div>

                                <!-- รายละเอียดองค์กร -->
                                <div class="mb-3">
                                    <label for="organizer_details" class="form-label">รายละเอียดองค์กร</label>
                                    <textarea class="form-control" id="organizer_details" name="organizer_details" rows="3">{{ old('organizer_details', $Organizer->organizer_details) }}</textarea>
                                </div>

                                <!-- ปุ่มบันทึกโปรไฟล์ -->
                                <div class="mb-3 text-center">
                                    <button type="submit" class="btn btn-primary">อัปเดตโปรไฟล์</button>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
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
