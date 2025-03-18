@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Organizer Register') }}</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('organizer.register') }}">
                            @csrf
                            <div class="row mb-3">
                                <label for="organizer_name"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Name') }}</label>
                                <div class="col-md-6">
                                    <input id="organizer_name" type="text" class="form-control" name="organizer_name"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="organizer_email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-6">
                                    <input id="organizer_email" type="email" class="form-control" name="organizer_email"
                                        required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password" type="password" class="form-control" name="password" required>
                                </div>
                            </div>
                            <div class="row mb-3">
                                <label for="password-confirm"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Confirm Password') }}</label>
                                <div class="col-md-6">
                                    <input id="password-confirm" type="password" class="form-control"
                                        name="password_confirmation" required>
                                </div>
                            </div>
                            <div class="row mb-0">
                                <div class="col-md-6 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Register as Organizer') }}
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- ✅ SweetAlert2 และ Modal Loading --}}
    @push('scripts')
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

        @if (session('waiting_for_approval') === true)
            <script>
                document.addEventListener("DOMContentLoaded", function() {
                    console.log("DOM content loaded");

                    if ("{{ session('waiting_for_approval') ? 'true' : 'false' }}" === "true") {
                        console.log("Session waiting_for_approval is true");

                        Swal.fire({
                            title: "รอการอนุมัติ",
                            text: "บัญชีของคุณถูกสร้างเรียบร้อยแล้ว กรุณารอให้แอดมินอนุมัติก่อนเข้าสู่ระบบ",
                            icon: "info",
                            allowOutsideClick: false,
                            allowEscapeKey: false,
                            showConfirmButton: false,
                            didOpen: () => {
                                Swal.showLoading(); // แสดงการโหลด
                            }
                        });

                        setInterval(() => {
                            checkApproval();
                        }, 5000);
                    } else {
                        console.log("Session waiting_for_approval is not true");
                    }
                });

                function checkApproval() {
                    console.log("Checking approval status...");

                    fetch("{{ route('check.approval') }}", {
                            method: 'GET',
                            headers: {
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}', // หากใช้ CSRF Token
                                // 'Authorization': 'Bearer ' + token,  // หากใช้ Token (เช่นกับ Laravel Sanctum)
                            }
                        })
                        .then(response => response.json())
                        .then(data => {
                            if (data.approved) {
                                Swal.fire({
                                    title: 'อนุมัติสำเร็จ!',
                                    text: 'บัญชีของคุณได้รับการอนุมัติแล้ว',
                                    icon: 'success',
                                    confirmButtonText: 'เข้าสู่ระบบ'
                                }).then(() => {
                                    window.location.href = "{{ route('organizer.login') }}";
                                });
                            } else {
                                Swal.fire({
                                    title: 'ยังไม่ได้รับการอนุมัติ',
                                    text: 'บัญชีของคุณยังคงรอการอนุมัติจากผู้ดูแล',
                                    icon: 'warning'
                                });
                            }
                        })
                        .catch(error => {
                            console.error('There was a problem with the fetch operation:', error);
                        });
                }
            </script>
        @endif
    @endpush
@endsection
