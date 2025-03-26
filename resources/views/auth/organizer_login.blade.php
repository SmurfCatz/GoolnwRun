@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Organizer Login') }}</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('organizer.login') }}">
                            @csrf

                            @if (session('error'))
                                <div class="alert alert-danger alert-dismissible fade show" role="alert">
                                    <strong>{{ session('error') }}</strong>
                                    <button type="button" class="btn-close" data-bs-dismiss="alert"
                                        aria-label="Close"></button>
                                </div>
                            @endif

                            <div class="row mb-3">
                                <label for="organizer_email"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Email Address') }}</label>
                                <div class="col-md-6">
                                    <input id="organizer_email" type="email"
                                        class="form-control @error('organizer_email') is-invalid @enderror"
                                        name="organizer_email" value="{{ old('organizer_email') }}" required
                                        autocomplete="email" autofocus>
                                    @error('organizer_email')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <label for="organizer_password"
                                    class="col-md-4 col-form-label text-md-end">{{ __('Password') }}</label>
                                <div class="col-md-6">
                                    <input id="organizer_password" type="password"
                                        class="form-control @error('organizer_password') is-invalid @enderror"
                                        name="organizer_password" required autocomplete="current-password">
                                    @error('organizer_password')
                                        <span class="invalid-feedback" role="alert">
                                            <strong>{{ $message }}</strong>
                                        </span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row mb-3">
                                <div class="col-md-6 offset-md-4">
                                    <div class="form-check">
                                        <input class="form-check-input" type="checkbox" name="remember" id="remember"
                                            {{ old('remember') ? 'checked' : '' }}>
                                        <label class="form-check-label" for="remember">
                                            {{ __('Remember Me') }}
                                        </label>
                                    </div>
                                </div>
                            </div>

                            <div class="row mb-0">
                                <div class="col-md-8 offset-md-4">
                                    <button type="submit" class="btn btn-primary">
                                        {{ __('Login') }}
                                    </button>

                                    @if (Route::has('password.request'))
                                        <a class="btn btn-link" href="{{ route('password.request') }}">
                                            {{ __('Forgot Your Password?') }}
                                        </a>
                                    @endif


                                </div>
                            </div>
                        </form>
                    </div>
                    <div>
                        <a class="btn btn-link btn-sm mb-3 text-end float-end"
                            href="{{ route('auth.organizer_register') }}">
                            {{ __('หากยังไม่ได้สมัครสมาชิกโปรด ลงทะเบียน') }}
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
{{-- <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
@if (session('error'))
    <div class="alert alert-danger">
        {{ session('error') }}
    </div>
@endif --}}
