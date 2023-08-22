@extends('00_plantillas_Blade.plantilla_General2')
@section('content')
    <link id="pagestyle" href="/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
    <link href="/css/main.css" rel="stylesheet" media="all">
    <!doctype html>
    <html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <!-- CSRF Token -->
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', 'Laravel') }} - Error</title>

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
            <main class="py-4">

                <div class="container">

                    <div class="row justify-content-center">
                        <div class="col-xl-8 col-md-10 col-sm-10">
                            <div class="card">
                                <div class="row">
                                    <div class="col-xl-4 col-md-6 col-sm-12"
                                        style="display: flex; justify-content: center; ">
                                        <img src="@yield('img')" class="rounded" width="100%">
                                        {{-- <img src="/img/errorHomero.gif" class="rounded" width="100%"> --}}
                                    </div>
                                    <div class="col-xl-8 col-md-6 col-sm-12">

                                        <div class="card-header">
                                            @if (session('status'))
                                                <div class="alert alert-success custom-exit text-center" role="alert"
                                                    id="error-success">
                                                    {{ session('status') }}
                                                </div>
                                            @endif
                                        </div>

                                        <div>
                                            <h4 style="text-align: center"><strong>@yield('title')</strong></h4>
                                        </div>

                                        <div class="pt-3" style="text-align: center">
                                            @yield('message')
                                        </div>

                                        <div class="card-body">

                                            <div class="row justify-content-center">
                                                <div class="col-xl-6 col-md-10 col-sm-10">
                                                    <button onclick="back()" class="justify-content-center btn login_btn"><i
                                                            class="fa fa-arrow-left pe-2"></i>
                                                        {{ __('Regresar') }}
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>

                </div>
            </main>
        </div>
    </body>

    <script>
        function back() {

            console.log('Funcion back trabajando!');

            var url;

            if (document.referrer != '')
                url = document.referrer;
            else
                url = '{{ route('index') }}';

            window.location.href = url;
        }
    </script>

    </html>
@endsection
