@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Piscina-productos')
@section('activatedMenu')

<div class="mb-0 col-11 text-start">

    <div class="row text-center container pt-2">
        <h3 style="background:rgb(0,191,255);" class=" card text-white text-uppercase p-2">Productos para Piscina
        </h3>
    </div>

    <!--Filtro de busqueda-->

    <div class="nav-item" style="margin: 10px 25px 10px 25px;">
        <form action="{{route('producto.search')}}" method="get" role="search" 
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 350px" 
                placeholder="Buscar pedido por nombre del producto" aria-label="Search" 
                aria-describedby="basic-addon2" maxlength="50" 
                required value="<?php if (isset($text)) { echo $text; } ?>" />
                <button class="btn btn-menu my-2 my-sm-0" type="submit"><strong>Buscar</strong></button>
                @if(isset($text))
                    @if($text != null)
                <a href="{{route('prodpiscina.index')}}" style="display:block; float:right" class="btn btn-secondary my-2 my-sm-0">Borrar Busqueda</a>
                @endif
                 @endif
            </div>
        </form>
        <a style="position: absolute; right:180px;" href="{{route('piscina.create')}}" 
    class="btn btn-menu"> <i class="ni ni-single-copy-04 text-success text-sm opacity-10">
    </i> Nuevo producto</a> 
    </div>
    
    <h5 class="card class-4 text-lg text-center" style="background:rgb(0,191,255); color:#fff;
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
                        <th scope="col">Opciones</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($prod as $p)
                <tr class="border border-light" style="color:teal; text-align:center">
                <td scope="col">{{$p->id}}</td>
                <td scope="col">{{$p->nombre}}</td>
                <td>{{$p->tipo_producto->descripcion}}</td>
                <td>
                <a class="btn btn-success form btn-xs" href="{{ route('producto.edit', ['id' => $p->id]) }}">
                     Editar</a>

                </td>
            </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;color: teal;">No hay productos</td>
            </tr>
            @endforelse
                </tbody>

            </table>
        </div>
    </div>
    

     
    @endsection