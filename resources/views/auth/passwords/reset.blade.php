@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">
                        <hr>
                    </div>
                    <div>
                        <h4 style="text-align: center"><strong>{{ __('Restablecer Contraseña') }}</strong></h4>
                    </div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('password.update') }}">
                            @csrf

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="row justify-content-center">
                                <div class="col-xl-6 col-md-10 col-sm-10">
                                    <div class="input-group mb-3">

                                        <div class="text-md-end">
                                            <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                                        </div>
                                        <input id="email" type="email"
                                            class="form-control border-radius-sm input_user @error('email') is-invalid @enderror"
                                            name="email" value="{{ $email ?? old('email') }}" required
                                            autocomplete="email" autofocus style="width:255px; padding: 8px">
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
                                    <div class="input-group mb-3">

                                        <div class="text-md-end">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>

                                        <input id="password" type="password"
                                            class="form-control border-radius-sm input_user @error('password') is-invalid @enderror"
                                            name="password" required autocomplete="new-password"
                                            placeholder="Nueva contraseña" style="width:255px; padding: 8px">

                                        @error('password')
                                            <span class="invalid-feedback" role="alert">
                                                <strong>{{ $message }}</strong>
                                            </span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-xl-6 col-md-10 col-sm-10">
                                    <div class="input-group mb-3">

                                        <div class="text-md-end">
                                            <span class="input-group-text"><i class="fas fa-key"></i></span>
                                        </div>

                                        <input id="password-confirm" type="password"
                                            class="form-control border-radius-sm input_user" name="password_confirmation"
                                            required autocomplete="new-password" placeholder="Confirma la nueva contraseña"
                                            style="width:255px; padding: 8px">

                                    </div>
                                </div>
                            </div>

                            <div class="row justify-content-center">
                                <div class="col-xl-6 col-md-10 col-sm-10">
                                    <button type="submit" class="btn login_btn">
                                        {{ __('Restablecer') }}
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
