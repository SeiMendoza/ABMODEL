@extends('layouts.app')

@section('content')
    <style>
        .custom-error {
            font-size: 15px;
            font-weight: bold;
            background-color: #f93e47c7;
            color: #ffffff;
            padding: 10px;
            border-radius: 4px;
        }

        .custom-exit {
            font-size: 15px;
            font-weight: bold;
            color: #ffffff;
            padding: 10px;
            border-radius: 4px;
        }
    </style>

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-xl-8 col-md-10 col-sm-10">
                <div class="card">
                    <div class="card-header">
                        @if (session('status'))
                            <div class="alert alert-success custom-exit text-center" role="alert" id="error-success">
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
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input type="email" name="email" id="email"
                                            class="form-control border-radius-sm input_user
                                            @error('email') is-invalid @enderror"
                                            value="{{ old('email') }}" required autocomplete="email" placeholder="Correo"
                                            style="width:255px; padding: 8px" autofocus>

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
@endsection
