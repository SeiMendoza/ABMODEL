<link id="pagestyle" href="/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
<link href="/css/main.css" rel="stylesheet" media="all">

<!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

<!DOCTYPE html>
<html>

<head>
    <title> Login</title>
    <link href="/assets/css/fontawesome.css" rel="stylesheet">
    <link href="/assets/css/solid.css" rel="stylesheet">
    <link href="/assets/css/brands.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/login.css">
</head>

<body>
    <div class="">
        <div class="d-flex justify-content-center h-100">
            <div class="reg_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="/img/Villacrisol.png" class="brand_logo" alt="Logo">
                    </div>
                </div>

                <div class="d-flex justify-content-center form_container">
                    <form action="/login" method="POST">
                        @csrf
                        <div class="mb-3">
                            <h4 style="text-align: center"><strong>Iniciar sesión</strong></h4>
                        </div>

                        <div class=" input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" name="email" class="form-control border-radius-sm input_user"
                                value="{{ old('email') }}" placeholder="Correo" 
                                style="width:255px; padding: 8px">
                        </div>

                        <div class="input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-key"></i></span>
                            </div>
                                <input type="password" name="password" class="form-control border-radius-sm input_pass"
                                    value="{{ old('password') }}"  placeholder="Contraseña" 
                                    style="width:255px; padding: 8px">
                        </div>
                        
                        @error('password')
                            <span class="menerr" role="alert" style="color:red;display: block; width: 255px; margin: 1px 0; ">
                                <strong >Estos campos son obligatorios.</strong>
                            </span>
                        @enderror

                        <div class="form-group">
                        </div>
                        <div class="justify-content-center">
                            <button type="submit" class="btn login_btn">Ingresar</button>
                        </div>
                    </form>
                </div>

                <div class="mt-1">
                    <hr>
                    <div class="d-flex justify-content-center links">
                        <a type="button" href="{{ route('password.update') }}">¿Olvidó su contraseña?</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>

</html>
