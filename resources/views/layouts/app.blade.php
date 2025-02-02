<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>GoolnwRun</title>
    <link rel="icon"
        href="https://img.freepik.com/premium-vector/run-running-people-human-man-sport-logo-vector-icon-illustration_7688-4400.jpg"
        type="image/x-icon">
    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">

    <!-- Scripts -->
    @vite(['resources/sass/app.scss', 'resources/js/app.js'])
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    <img src="https://img.freepik.com/premium-vector/run-running-people-human-man-sport-logo-vector-icon-illustration_7688-4400.jpg"
                        alt="" width="30" height="24" class="d-inline-block align-text-top">
                    GoolnwRun
                </a>

                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">
                        @auth
                            @if (auth()->user()->member_role === 'admin')
                                <!-- Admin Menu -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('admin.home') }}">{{ __('Dashboard') }}</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('admin.users.index') }}">{{ __('User Management') }}</a>
                                </li>
                            @elseif (auth()->user()->member_role === 'organizer')
                                <!-- Organizer Menu -->
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('organizer.home') }}">{{ __('Dashboard') }}</a>
                                </li>
                                {{-- <li class="nav-item">
                                    <a class="nav-link"
                                        href="{{ route('organizer.events.index') }}">{{ __('Manage Events') }}</a>
                                </li> --}}
                            @endif
                        @endauth
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ms-auto">
                        <!-- Authentication Links -->
                        @guest
                            @if (Route::has('login'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                                </li>
                            @endif

                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('organizer.login') }}">{{ __('Organizer Login') }}</a>
                            </li>                            
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->member_name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('profile.edit') }}">
                                        Edit Profile
                                    </a>
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                        onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                        Logout
                                    </a>

                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                        @csrf
                                    </form>
                                </div>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>


        <main class="py-4">
            @yield('content')
        </main>
    </div>

</body>

</html>
