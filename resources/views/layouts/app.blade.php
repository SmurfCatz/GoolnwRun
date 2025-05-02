<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GoolnwRun</title>
    <link rel="icon" href="{{ asset('images/logo2.png') }}" type="image/x-icon">


    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">


    <!-- Scripts -->
    @stack('scripts')
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
    <style>
        /* การตกแต่ง Navbar */
        .navbar {
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            background-color: #ffffff;
        }

        .navbar-light .navbar-nav .nav-link {
            color: #333;
            font-weight: 500;
        }

        .navbar-light .navbar-nav .nav-link:hover {
            color: #9400D3;
            transition: color 0.3s ease;
        }


        /* เพิ่มการแสดงเงาให้ Dropdown Menu */
        .dropdown-menu {
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        .dropdown-item:hover {
            background-color: #f1f1f1;
            transition: background-color 0.3s ease;
        }

        /* เพิ่มแอนิเมชันสำหรับการขยายขนาดปุ่ม */
        .navbar-toggler-icon {
            transition: transform 0.3s ease;
        }

        .navbar-toggler-icon:hover {
            transform: rotate(90deg);
        }

        .card-header {
            background-color: #6f42c1;
        }
    </style>
</head>

<body>
    <div id="app">
        @if (!View::hasSection('hide-navbar'))
        <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="{{ asset('images/logo2.png') }}"
                        alt="" width="30" height="26" class="d-inline-block align-text-top">
                    GoolnwRun
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent" style="height: 42px;">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                        @if (auth()->user()->member_role === 'admin')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('admin.home') }}">{{ __('Dashboard') }}</a>
                        </li>
                        @endif
                        @endauth

                        @auth('organizer')
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('organizer.home') }}">{{ __('Dashboard') }}</a>
                        </li>
                        <!-- <li class="nav-item">
                            <a class="nav-link" href="{{ route('organizer.home') }}">{{ __('Manage Events') }}</a>
                        </li> -->
                        @endauth
                    </ul>


                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto ">
                        @if (Auth::guard('web')->check())
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle p-2" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ Auth::check() ? (Auth::user()->member_image ? asset('storage/' . Auth::user()->member_image) : asset('images/default-avatar.png')) : asset('images/default-avatar.png') }}"
                                    alt="Profile Picture" class="profile-picture" width="30" height="26"
                                    style="object-fit: cover; border-radius: 50%;"> {{ Auth::guard('web')->user()->member_name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('profile.edit') }}">Edit Profile</a>
                                <a class="dropdown-item" href="{{ route('logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('user-logout-form').submit();">
                                    Logout
                                </a>
                                <form id="user-logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @elseif (Auth::guard('organizer')->check())
                        <li class="nav-item dropdown">
                            <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                <img src="{{ Auth::check() ? (Auth::user()->organizer_image ? asset('storage/' . Auth::user()->organizer_image) : asset('images/default-avatar.png')) : asset('images/default-avatar.png') }}"
                                    alt="Profile Picture" class="profile-picture" width="30" height="30"
                                    style="object-fit: cover; border-radius: 50%;"> {{ Auth::guard('organizer')->user()->organizer_name }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                <a class="dropdown-item" href="{{ route('organizer.profile.edit') }}">Edit Profile</a>
                                <a class="dropdown-item" href="{{ route('organizer.logout') }}"
                                    onclick="event.preventDefault(); document.getElementById('organizer-logout-form').submit();">
                                    Logout
                                </a>
                                <form id="organizer-logout-form" action="{{ route('organizer.logout') }}" method="POST"
                                    class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        @else
                        @if (Route::has('login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('login') }}">{{ __('Login | Register') }}</a>
                        </li>
                        @endif

                        @if (Route::has('auth.organizer_login'))
                        <li class="nav-item">
                            <a class="nav-link" href="{{ route('auth.organizer_login') }}">{{ __('Organizer') }}</a>
                        </li>
                        @endif
                        @endif
                    </ul>
                    <!-- Navbar Right Side -->
                    <ul class="navbar-nav ">
                        {{-- ปุ่มสลับภาษา --}}
                        <li class="nav-item dropdown">
                            <a id="langDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                🌐 {{ strtoupper(app()->getLocale()) }}
                            </a>
                            <div class="dropdown-menu dropdown-menu-end" aria-labelledby="langDropdown">
                                <a class="dropdown-item" href="{{ route('change.language', 'en') }}">
                                    🇺🇸 English
                                </a>
                                <a class="dropdown-item" href="{{ route('change.language', 'th') }}">
                                    🇹🇭 ภาษาไทย
                                </a>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
        </nav>
        @endif

        <main class="py-1">
            @yield('content')
        </main>
    </div>

</body>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener("DOMContentLoaded", function() {
        const deleteButtons = document.querySelectorAll('.delete-btn');

        deleteButtons.forEach(button => {
            button.addEventListener('click', function() {
                const form = this.closest('.delete-form');
                Swal.fire({
                    title: 'Are you sure?',
                    text: "This action cannot be undone.",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonColor: '#d33',
                    cancelButtonColor: '#6c757d',
                    confirmButtonText: 'Yes, delete it!',
                    reverseButtons: true,
                }).then((result) => {
                    if (result.isConfirmed) {
                        form.submit();
                    }
                });
            });
        });
    });
</script>

</html>