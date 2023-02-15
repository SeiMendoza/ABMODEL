<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Usuario</title>

</head>
<link href="{{ asset("css/argon-dashboard.css") }}" rel="stylesheet">
 
<body>

    <div class="card" style="color: #035700">
        <h5 style="text-align: center">Menú del Dia</h5>
        <!-- Menú de comidas y bebidas -->
        <div style="display:block; float:right;">
            <form action="{{route('menu.search')}}" method="get" role="search" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                <div class="input-group">
                    <input class="form-control" type="text" id="busqueda" name="busqueda" style="width: 405px" placeholder="Buscar por nombre, tamaño o tipo de comida/bebida" aria-label="Buscar por nombre" aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($text)) echo $text; ?>" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="submit" id="b" type="button"><i class="fas fa-search"></i></button>
                        <a href="{{route('usuario_menu.index')}}" id="" class="btn btn-secondary">Borrar Busqueda</a>
                    </div>
                </div>
            </form>
        </div>
        <div class="table-responsive" style="height: 680px;">
            <section class="container-fluid">
                <br>
                <div class="tb">
                    @foreach ($menu as $m)
                    <div class="card mb-4" style="display:grid; border: 1px solid green; background-color: rgba(255, 0, 0, 0.6);
                       grid-auto-columns: 277px; justify-content: center; float: left; margin: 5px;">
                        <div class="row g-0">
                            <div class="col-md-4" style="display:flex;">
                                <img src="{{asset($m->imagen)}}" alt="..." style="display: block; margin:0.3%; width: 120%; max-height:120%; border-radius:10px 5px 5px 10px;">
                            </div>
                            <div class="col-md-8">
                                <div class="card-body">
                                    <div class="text-center" style="padding: 0px; margin:0px;">
                                        <!-- Nombre y tamaño-->
                                        <p style="padding: 0px; margin:0px;"><strong>{{$m->nombre}} {{$m->tamanio}}</strong></p>
                                        <!--tipo-->
                                        <p style="padding: 0px; margin:0px;"><strong>{{$m->tipo}}</strong></p>
                                        <!--descripcion-->
                                        <p style="padding: 0px; margin:0px;"><strong>{{$m->descripcion}}</strong></p>
                                        <!-- Precio-->
                                        <p><strong> L. {{$m->precio}}</strong></p>
                                        <button><strong>Agregar</strong></button><br />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

</body>

</html>