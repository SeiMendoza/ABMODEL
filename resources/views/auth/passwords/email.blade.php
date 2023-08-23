<link id="pagestyle" href="/css/argon-dashboard.css?v=2.0.4" rel="stylesheet" />
<link href="/css/main.css" rel="stylesheet" media="all">

<!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

<!DOCTYPE html>
<html>

<head>
    <title>Restablecer contraseña</title>
    <link href="/assets/css/fontawesome.css" rel="stylesheet">
    <link href="/assets/css/solid.css" rel="stylesheet">
    <link href="/assets/css/brands.css" rel="stylesheet">
    <link rel="stylesheet" href="/assets/css/login.css">
</head>

<body>

    <style>
        .custom-error {
            font-size: 15px;
            font-weight: bold;
            background-color: #f93e47c7;
            color: #ffffff;
            padding: 10px;
            border-radius: 4px;
        }
<!--<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>-->

        .custom-exit {
            font-size: 15px;
            font-weight: bold;
            color: #ffffff;
            padding: 10px;
            border-radius: 4px;
        }
    </style>

    <div class="">
        <div class="d-flex justify-content-center h-100">
            <div class="reg_card">
                <div class="d-flex justify-content-center">
                    <div class="brand_logo_container">
                        <img src="/img/Villacrisol.png" class="brand_logo" alt="Logo">
                    </div>
                </div>

                <div class="d-flex justify-content-center form_container">
                    <form action="{{ route('password.email') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <h4 style="text-align: center"><strong>Restablecer contraseña</strong></h4>  
                        </div>

                        <div class="mb-3">
                            <div style="text-align: center"><strong>Enviaremos un email con la información <br>
                                para restablecer tu contraseña.</strong></div>  
                        </div>

                        <div class=" input-group mb-3">
                            <div class="input-group-prepend">
                                <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                            </div>
                            <input type="email" name="email" id="email" 
                                class="form-control border-radius-sm input_user @error('email') is-invalid @enderror"
                                value="{{ old('email') }}" required autocomplete="email" placeholder="Correo" 
                                style="width:255px; padding: 8px" autofocus>
                        </div>
                        @error('email')
                            <span class="invalid-feedback" role="alert" style="color:red; display: block; width: 255px; ">
                                <strong style="font-size: 13px;">{{ $message }}</strong>
                            </span>
                        @enderror

                        <div class="">
                            @if (session('status'))
                                <div class="alert alert-success custom-exit text-center" role="alert" id="error-success">
                                    {{ session('status') }}
                                </div>
                            @endif
                        </div>                                     
              
                        <div class="form-group">
                        </div>
                        <div class="justify-content-center">
                            <button type="submit" class="btn login_btn">Enviar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</body>

</html>