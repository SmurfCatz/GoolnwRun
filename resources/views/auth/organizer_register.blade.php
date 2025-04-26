@extends('layouts.app')

@section('content')

<div class="container d-flex shadow-lg my-3 max-w-sm mx-auto p-0" style="width: 1080px;">
    <div class=" row w-100 m-0">
        <!-- Left Side: Form -->
        <div class="col-12 col-md-6 d-flex justify-content-center align-items-center p-0 overflow-hidden">
            <img src=" {{ asset('images\register organizer.jpg') }}" alt="Login Illustration" class="img-fluid d-none d-md-block"
                style="width: 540px; height: 100%;">
        </div>

        <!-- Right Side: Image -->
        <div class="col-12 col-md-6 d-flex flex-column justify-content-center align-items-center p-5 m-0">
            <div class="w-100 px-3 px-md-5">
                <h1 class="fw-bold mb-2 text-center text-md-start">REGISTER ORGANIZER</h1>
                <form method="POST" action="{{ route('organizer.register') }}">
                    @csrf

                    @if (session('error'))
                    <div class="alert alert-danger alert-dismissible fade show" role="alert">
                        <strong>{{ session('error') }}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                    @endif

                    <div class="mb-3">
                        <label for="organizer_name" class="form-label">Name</label>
                        <input type="text" id="organizer_name" name="organizer_name"
                            class="form-control @error('organizer_name') is-invalid @enderror"
                            value="{{ old('organizer_name') }}" required autocomplete="name" autofocus
                            placeholder="Enter your name">
                        @error('organizer_name')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

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
                        <label for="organizer_tel" class="form-label">Phone Number</label>
                        <input type="tel" id="organizer_tel" name="organizer_tel"
                            class="form-control @error('organizer_tel') is-invalid @enderror"
                            value="{{ old('organizer_tel') }}" required autocomplete="tel" autofocus
                            placeholder="Enter your phone number">
                        @error('organizer_tel')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password" class="form-label">Password</label>
                        <input type="password" id="password" name="password"
                            class="form-control @error('password') is-invalid @enderror" required
                            autocomplete="new-password" placeholder="********">
                        @error('password')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                        @enderror
                    </div>

                    <div class="mb-3">
                        <label for="password-confirm" class="form-label">Confirm Password</label>
                        <input id="password-confirm" type="password" class="form-control"
                            name="password_confirmation" required placeholder="********">
                    </div>

                    <div class="d-flex justify-content-between align-items-center mb-3">
                        <div class="d-flex justify-content-between align-items-center">
                            <input type="checkbox" id="remember" name="remember" {{ old('remember') ? 'checked' : '' }} class="me-1">
                            <label for="remember" class="form-check-label">Remember me</label>
                        </div>
                    </div>

                    <div class="d-grid gap-3">
                        <button type="submit" class="btn btn-primary btn-lg">Sign up</button>
                        <button type="submit" class="btn btn-danger btn-lg">Sign up with Google</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
<script src="https://cdn.jsdelivr.net/npm/inputmask@5.0.6/dist/inputmask.min.js"></script>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        const phoneInput = document.querySelector('#organizer_tel');
        if (phoneInput) {
            Inputmask({
                mask: '999-999-9999'
            }).mask(phoneInput);
        }
    });
</script>