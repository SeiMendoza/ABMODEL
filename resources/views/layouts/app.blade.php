<link id="pagestyle" href="/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
<link href="/css/main.css" rel="stylesheet" media="all">
<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="icon" type="image/png" href="/img/faviconVillaCrisol.png">
    <link rel="dns-prefetch" href="//fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=Nunito" rel="stylesheet">
    <link href="/assets/css/fontawesome.css" rel="stylesheet">
    <link href="/assets/css/solid.css" rel="stylesheet">
    <link href="/assets/css/brands.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/login.css">

    <!-- Scripts -->
    {{-- @vite(['resources/sass/app.scss', 'resources/js/app.js']) --}}
    {{-- @vite(['public/manifest.json', 'resources/sass/app.scss', 'resources/js/app.js']) --}}
    {{-- @vite('main') --}}
    {{-- <link rel="stylesheet" href="{{ mix('css/app.css') }}">
    <script src="{{ mix('js/app.js') }}"></script> --}}

</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                    aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
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

                            {{-- @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif --}}
                        @else
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button"
                                    data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
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

        <main class="py-4">

            <div class="container">
                <div class="row justify-content-center">
                    <div class="col-xl-8 col-md-10 col-sm-10">
                        <div class="card">
                            <div class="card-header">
                                @if (session('status'))
                                    <div class="alert alert-success custom-exit text-center" role="alert"
                                        id="error-success">
                                        {{ session('status') }}
                                    </div>
                                @endif
                            </div>

                            <div>
                                <h4 style="text-align: center"><strong>{{ __('Restablecer Contraseña') }}</strong></h4>
                            </div>

                            <div class="pt-3" style="text-align: center">
                                Enviaremos un email con la información para restablecer tu
                                contraseña
                            </div>

                            <div class="card-body">

                                <form method="POST" action="{{ route('password.email') }}">
                                    @csrf

                                    <div class="row justify-content-center">
                                        <div class="col-xl-6 col-md-10 col-sm-10">
                                            <div class="input-group mb-3">
                                                <div class="text-md-end">
                                                    <span class="input-group-text"><i
                                                            class="fas fa-envelope"></i></span>
                                                </div>
                                                <input type="email" name="email" id="email"
                                                    class="form-control border-radius-sm input_user
                                            @error('email') is-invalid @enderror"
                                                    value="{{ old('email') }}" required autocomplete="email"
                                                    placeholder="Correo" style="width:255px; padding: 8px" autofocus>

                                                @error('email')
                                                    <span class="invalid-feedback" role="alert">
                                                        <strong>{{ $message }}</strong>
                                                    </span>
                                                @enderror
                                            </div>
                                        </div>
                                    </div>


                                    <div class="row justify-content-center">
                                        <div class="col-xl-6 col-md-10 col-sm-10">
                                            <button type="submit" class="justify-content-center btn login_btn">
                                                {{ __('Enviar') }}
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </main>
    </div>
</body>

</html>
