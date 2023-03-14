@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Piscina-productos')
@section('activatedMenu')

<script>
        var msg = "{{Session::get('mensaje')}}";
        var exist = "{{Session::has('mensaje')}}";
        if(exist){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: msg,
                showConfirmButton: false,
                toast: true,
                background: '#fff',
                timer: 5500
            })
        }
    </script>

<div class="mb-0 col-12 text-start">

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
        <a style="position: absolute; right:150px;" href="{{route('piscina.create')}}" 
    class="btn btn-menu"><i class="fa-regular fa-newspaper" style="font-size:20px;"></i> Nuevo producto</a> 
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
                <td scope="col">{{$p->tipo_producto->descripcion}}</td>
                 
                <td>
                <a class="btn btn-success form btn-xs" href="{{ route('producto.edit', ['id' => $p->id]) }}">
                <i class="fa-regular fa-pen-to-square" style="font-size:15px;"></i> Editar</a>
                <button class="btn btn-danger form btn-xs" data-bs-toggle="modal" 
                                        data-bs-target="#staticBackdropE{{$p->id}}">
                <i class="fa-regular fa-pen-to-square" style="font-size:15px;"></i> eliminar</button>
                <form action="{{route('prodpiscina.destroy', ['id' => $p->id])}}" method="post" enctype="multipart/form-data">
                    @method('delete')
                                            @csrf
                                            <div class="modal fade" id="staticBackdropE{{$p->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" 
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" id="staticBackdropLabel">Eliminar producto</h5>
                                                        </div>
                                                        <div class="modal-body">
                                                            ¿Esta seguro de borrar el producto: {{$p->nombre}}?
                                                        </div>
                                                        <div class="modal-footer">
                                                        <input type="submit" class="btn btn-danger w-15" value="Si">
                                                <button onclick="setTimeout(function(){location.reload();}, 00);" type="button" class="btn btn-menu" data-bs-dismiss="modal">No</button>
                                            
                                                    </div>
                                                </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                        
                                </tr>
            @empty
            <tr>
                <td colspan="7" style="text-align: center;color: teal;">No hay productos</td>
            </tr>
            @endforelse
                </tbody>
            </table>
            <div style="display:block; float:right;"> 
            {{$prod->links()}}
            </div>
        </div>
    </div>
    

     
    @endsection