@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Perfil')
@section('miga')
    <li class="breadcrumb-item text-sm text-white active m-0" aria-current="page">Perfil</li>
@endsection
@section('tit', 'Perfil de Usuario')

@section('content')
    <style>
        .img-perfil,
        .topbar .nav-item .nav-link .img-perfil {
            height: 13rem;
            width: 13rem;
        }

        .rounded-circ {
            border-radius: 50% !important;
        }

        .gradient-custom {
            background-image: linear-gradient(rgba(241, 249, 250, 0.364), rgba(245, 249, 248, 0.353));
            border-right: 1px solid #e9edf2;
        }

        .form-material .form-group {
            overflow: hidden;
        }

        .form-material .form-control {
            background-color: rgba(0, 0, 0, 0);
            background-position: center bottom, center calc(100% - 1px);
            background-repeat: no-repeat;
            background-size: 0 2px, 100% 1px;
            padding: 0;
            -webkit-transition: background 0s ease-out 0s;
            transition: background 0s ease-out 0s;
        }

        .form-material .form-control,
        .form-material .form-control.focus,
        .form-material .form-control:focus {
            background-image: -webkit-gradient(linear, left top, left bottom, from(#398bf7), to(#398bf7)), -webkit-gradient(linear, left top, left bottom, from(#e9edf2), to(#e9edf2));
            background-image: linear-gradient(#398bf7, #398bf7), linear-gradient(#e9edf2, #e9edf2);
            border: 0 none;
            border-radius: 0;
            -webkit-box-shadow: none;
            box-shadow: none;
            float: none;
        }

        .form-material .form-control.focus,
        .form-material .form-control:focus {
            background-size: 100% 2px, 100% 1px;
            outline: 0 none;
            -webkit-transition-duration: 0.3s;
            transition-duration: 0.3s;
        }

        .form-control-line .form-group {
            overflow: hidden;
        }

        .form-control-line .form-control {
            border: 0px;
            border-radius: 0px;
            padding-left: 0px;
            border-bottom: 1px solid #f6f9ff;
        }

        .form-control-line .form-control:focus {
            border-bottom: 1px solid rgba(111, 143, 175);
        }
    </style>

    <div class="">
        <div class="col col-lg-15 mb-5 mb-lg-0">
            <div class="card mb-1" style="border-radius: .5rem;">
                <div class="row g-0">
                    <div class="col-md-4 gradient-custom text-center text-white"
                        style="border-top-left-radius: .5rem; border-bottom-left-radius: .5rem;">
                        <BR> <BR>
                        <img src="/{{ $user->imagen }}" class="img-perfil rounded-circ" width="160px" />
                        <h4 style="margin-top:3%; "><strong>{{ $user->name }}</strong></h4>

                        <BR>

                        <div class="row justify-content-center">
                            <div style=" flex: 0 0 auto; width: 50%;">
                                <a href="{{ route('usuarios.editarPerfil', ['id' => $user->id]) }}"
                                    style="width: 70%;  margin-left:30% " class="btn btn-primary" id=""><i
                                        class="fa fa-edit pe-2"></i>Editar</a>
                            </div>
                            <div style=" flex: 0 0 auto; width: 50%;">
                                <a href="#" style="width: 70%;  margin-right:30% " class="btn btn-secondary"
                                    onclick="goBack('{{ $url }}')"><i
                                        class="fa fa-arrow-left pe-2"></i>Regresar</a>
                            </div>
                        </div>

                        <BR>


                    </div>
                    <div class="col-md-8">
                        <div class="card-body p-4">
                            <BR>
                            <form class="form-horizontal form-material mx-2" data-bitwarden-watching="1">
                                <div class="form-group">
                                    <label for="name" class="col-md-12"
                                        style="text-align: left; margin-top: 10px; margin-left: 1px">
                                        <b>Nombre Completo:</b></label>
                                    <div class="col-md-12">
                                        <input readonly type="name" value="{{ $user->name }}"
                                            class="form-control form-control-line" name="name" id="name">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="email" class="col-md-12"
                                        style="text-align: left; margin-top: 10px; margin-left: 1px">
                                        <b>Correo:</b></label>
                                    <div class="col-md-12">
                                        <input readonly type="email" value="{{ $user->email }}"
                                            class="form-control form-control-line" name="email" id="email">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="telephone" class="col-md-12"
                                        style="text-align: left; margin-top: 10px; margin-left: 1px">
                                        <b>Teléfono:</b></label>
                                    <div class="col-md-12">
                                        <input readonly type="telephone" value="{{ $user->telephone }}"
                                            class="form-control form-control-line" name="telephone" id="telephone">
                                    </div>
                                </div>

                                <div class="form-group">
                                    <label for="address" class="col-md-12"
                                        style="text-align: left; margin-top: 10px; margin-left: 1px">
                                        <b>Dirección:</b></label>
                                    <div class="col-md-12">
                                        <input readonly type="address" value="{{ $user->address }}"
                                            class="form-control form-control-line" name="address" id="address">
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

<script>
    function goBack(url) {
        // Retornar a la vista de la cual accedio

        var first = url.substring(0, 10);


        let dafaultRoute = "{{ route('index') }} ";
        var pastRoute = document.referrer;
        console.log(pastRoute);
        console.log(first);

        if (first == '/usuarios/' || first == '' || first == '/perfil')
            window.location.href = dafaultRoute;
        else
            window.history.back();


    }
</script>
