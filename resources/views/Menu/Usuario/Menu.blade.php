<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Menú Usuario</title>

</head>

<body>
    <!-- Menú de comidas y bebidas -->
    <div style="display:block; float:left;">
        <form action="" method="get" role="search" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input class="form-control" type="text" id="busqueda" name="busqueda" style="width: 410px" placeholder="Buscar por nombre, tamaño o tipo de comida/bebida" aria-label="Buscar por nombre" aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($text)) echo $text; ?>" />
                <div class="input-group-append">
                    <button class="btn btn-primary" type="submit" id="b" type="button"><i class="fas fa-search"></i></button>
                    <a href=" " id="" class="btn btn-secondary">Borrar Busqueda</a>
                </div>
            </div>
        </form>
    </div>
    <div class="card" style="color: #035700">
        <h5 style="text-align: center">Menú del Dia</h5>
        <div class="table-responsive" style="height: 680px;">
            <section class="container-fluid">
                <br>
                <div class="tb">
                    @foreach ($menu as $m)
                    <div style="display:grid; grid-auto-columns: 277px; justify-content: space-evenly; float: left; margin: 5px;">
                        <div class="card" style="border: 1px solid green; background-color: rgba(255, 0, 0, 0.6)">
                            <!-- imagen-->
                            <img class="card-img-top" src="/images/{{$m->imagen}}" width="00px" height="150px" alt="imagen" />
                            <div class="" style="text-align:center ;">
                                <div class="text-center" style="padding: 0px; margin:0px;">
                                    <!--tipo-->
                                    <p style="padding: 0px; margin:0px;"><strong>{{$m->tipo}}</strong></p>
                                    <!-- Nombre y tamaño-->
                                    <p style="padding: 0px; margin:0px;"><strong>{{$m->nombre}} {{$m->tamanio}}</strong></p>
                                    <!--descripcion-->
                                    <p style="padding: 0px; margin:0px;"><strong>{{$m->descripcion}}</strong></p>
                                    <!-- Precio-->
                                    <p><strong> L. {{$m->precio}}</strong></p><br />
                                </div>
                            </div>
                        </div>
                    </div>
                    @endforeach
                </div>
            </section>

</body>

</html>