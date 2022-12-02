<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Wes Makmur</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-rbsA2VBKQhggwzxH7pPCaAqO46MgnOM80zW1RWuH61DGLwZJEdK2Kadq2F9CUG65" crossorigin="anonymous">


    <!-- Scripts -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-kenU1KFdBIe4zVF0s0G1M5b4hcpxyD9F7jL+jjXkk+Q2h455rYXK/7HAuoJl+0I4" crossorigin="anonymous"></script>

    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                @if(!Auth::check() || Auth::user()->role == "user")
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h2><strong> Wes Makmur</strong></h2>
                </a>
                <a class="nav-link ms-5" href="{{ url('/dasboard') }}">
                    Rekomendasi
                </a>
                @elseif(Auth::user()->role == "editor")
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h2><strong> Wes Makmur</strong></h2>
                </a>
                <a class="nav-link ms-5 me-3" href="{{ url('/dasboard') }}">
                    Rekomendasi
                </a>
                <a class="nav-link me-3" href="{{ url('/post') }}">
                    Posting
                </a>
                <a class="nav-link me-3" href="{{ url('/kategori') }}">
                    Kategori
                </a>
                <a class="nav-link me-3" href="{{ url('/produk') }}">
                    Produk
                </a>
                @elseif(Auth::user()->role == "admin")
                <a class="navbar-brand" href="{{ url('/') }}">
                    <h2><strong> Wes Makmur</strong></h2>
                </a>
                <a class="nav-link ms-5 me-3" href="{{ url('/dasboard') }}">
                    Rekomendasi
                </a>
                <a class="nav-link me-3" href="{{ url('/post') }}">
                    Posting
                </a>
                <a class="nav-link me-3" href="{{ url('/kategori') }}">
                    Kategori
                </a>
                <a class="nav-link me-3" href="{{ url('/produk') }}">
                    Produk
                </a>
                <a class="nav-link me-3" href="{{ url('/user') }}">
                    User
                </a>
                @endif
                
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav me-auto">

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
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>

                                <div class="dropdown-menu dropdown-menu-end" aria-labelledby="navbarDropdown">
                                    <a class="dropdown-item" href="{{ route('logout') }}"
                                       onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();">
                                        {{ __('Logout') }}
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

        <main class="py-4" style="min-height:80vh">
            @yield('content')
        </main>
        <footer>
            <div class="container-fluid px-5 bg-dark text-light d-flex align-items-center justify-content-between">
                <h3>Wes Makmur</h3>
                <h6>Designed by: Brian Marco Agustian</h6>
            </div>
        </footer>
    </div>
</body>
</html>
