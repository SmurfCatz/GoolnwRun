@extends('layouts.app')

@section('content')

<div class="container d-flex shadow-lg my-3 max-w-sm mx-auto p-0" style="width: 1080px; border-radius: 20px;">
    <div class=" row w-100 m-0">
        <!-- Left Side: Form -->
        <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center p-5 m-0">
            <div class="w-100 px-3 px-md-5">
                <h1 class="fw-bold mb-2 text-center text-md-start">WELCOME ORGANIZER</h1>
                <p class="text-muted mb-4 text-center text-md-start">Welcome Organizer!!! Please enter your details.</p>
                <form method="POST" action="{{ route('organizer.login') }}">
                    @csrf

                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label for="organizer_email" class="form-label">Email</label>
                        <input type="email" id="organizer_email" name="organizer_email"
                            class="form-control @error('organizer_email') is-invalid @enderror"
                            value="{{ old('organizer_email') }}" required autocomplete="email" autofocus
                            placeholder="Enter your email">
                        @error('organizer_email')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="organizer_password" class="form-label">Password</label>
                        <input type="password" id="organizer_password" name="organizer_password"
                            class="form-control @error('organizer_password') is-invalid @enderror" required
                            autocomplete="current-password" placeholder="********">
                        @error('organizer_password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} class="me-1">
                            <label for="remember" class="form-check-label">Remember me</label>
                        </div>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" class="text-decoration-none">Forgot password</a>
                        @endif
                    </div>

                    <div class="d-grid gap-3">
                        <button type="submit" class="btn btn-primary btn-lg">Sign in</button>
                        <button type="submit" class="btn btn-danger btn-lg">Sign in with Google</button>

                    </div>
                </form>
                <p class="mt-4 text-center text-muted">
                    Don’t have an account? <a href="{{ route('auth.organizer_register') }}" class="text-danger text-decoration-none">Sign up for free!</a>
                </p>
            </div>
        </div>
        <!-- Right Side: Image -->
        <div class="col-12 col-md-6 d-flex justify-content-center align-items-center p-0 overflow-hidden ">
            <img src=" {{ asset('images\login organizer.jpg') }}" alt="Login Illustration" class="img-fluid d-none d-md-block"
                style="width: 540px; height: 640px; border-radius: 0 20px 20px 0; object-fit: cover;">
        </div>
    </div>
</div>
@endsection