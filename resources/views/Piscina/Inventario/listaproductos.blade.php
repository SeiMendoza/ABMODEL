@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Pedidos-cocina')
@section('activatedMenu')

<div class="mb-0 col-11 text-start">

    <div class="row text-center container pt-2">
        <h3 style="background:rgb(255,179,71);" class=" card text-white text-uppercase p-2">Productos para Piscina
        </h3>
    </div>

    <!--Filtro de busqueda-->

    <div class="nav-item" style="margin: 10px 25px 10px 25px;">
        <form action="" method="get" role="search" class="navbar-search">
            <div class="input-group">
                <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 350px" placeholder="Buscar pedido por nombre del producto" aria-label="Search" aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($texto)) {
                                                                                                                                                                                                                                                        echo $texto;
                                                                                                                                                                                                                                                    } ?>" />
                <button class="btn btn-menu my-2 my-sm-0" type="submit"><strong>Buscar</strong></button>
                @if(isset($texto))
                @if($texto != null)
                <a href="{{route('pedidosp.pedido')}}" style="display:block; float:right" class="btn btn-secondary my-2 my-sm-0">Borrar Busqueda</a>
                @endif
                @endif
            </div>
        </form>
    </div>


    <h5 class="card class-4 text-lg text-center" style="background:rgb(255,179,71); color:#fff;
      position: relative;">Lista de productos</h5>

    <!--------Lista de pedidos---------------->

    <div class="card-body">
        <div class="table-responsive container-fluid">
            <table class="table" id="table" style="background-color: #fff;">
                <thead class="card-header border border-radius" style="color:teal; text-align:center">
                    <tr>
                        <th scope="col">N</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Tipo de producto</th>
                        <th scope="col">Detalles</th>
                    </tr>
                </thead>
                <tbody>

                </tbody>

            </table>
        </div>
    </div>
    


    @endsection