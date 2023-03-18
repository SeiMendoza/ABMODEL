@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Piscina-productos')
@section('content')

<div style="margin-left:20px; margin-top:10px; display:block; float:left;
        color: #333333;font-family: Georgia, Serif;" class="nav-link-icon">
    <h3>Productos de piscina</h3>
</div>
<div class="nav d-flex justify-content-end " style="">
    <div class="nav-item" style="margin: 10px 10px 10px 25px;">
        <form action="{{ route('producto.search')}}" method="get" role="search" 
            class="navbar-search">
            <div class="input-group">
                <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 350px" 
                placeholder="Buscar pedido por nombre del cliente" aria-label="Search" 
                aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($text)) {echo $text;} ?>" />
                <button class="border-radius-md" type="submit" style="border: 0; color:aliceblue; background:rgb(33, 195, 247 );"><strong>Buscar</strong></button>    
                @if(isset($text))
                    @if($text != null)
                        <a href="{{route('prodpiscina.index')}}" style="display:block; float:right"  
                        class="btn btn-secondary my-2 my-sm-0">Borrar Busqueda</a>
                    @endif
                @endif
            </div>   
            </form>
    </div>
    <a style="margin: 10px 23px 10px 25px;border: 0; color:aliceblue; background:rgb(33, 195, 247);" href="{{route('piscina.create')}}" 
    class="btn badge-light"><i class="fa-regular fa-newspaper" style="font-size:15px;"></i> Nuevo producto</a> 
</div>
    
    <!--------Lista de pedidos---------------->

    <div class="card-body">
        <div class="table-responsive container-fluid">
            <table class="table" id="table" style="background-color: #fff;">
                <thead class="card-header border border-radius" style="color:teal; text-align:center">
                    <tr style="font-family: Georgia, Serif;font-size:19px">
                        <th scope="col">N</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Tipo de producto</th> 
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($prod as $p)
                <tr class="border border-light" style="color:teal; text-align:center; font-size:18px;">
                <td scope="col">{{$p->id}}</td>
                <td scope="col">{{$p->nombre}}</td>
                <td scope="col">{{$p->tipo_producto->descripcion}}</td>
                 
                <td>
                <a  href="{{ route('producto.edit', ['id' => $p->id]) }}">
                <i class="fa-regular fa-pen-to-square" style="font-size:25px;color:rgb(33, 195, 247)"></i>
                </td>
                <td> 
                <i data-bs-toggle="modal" data-bs-target="#staticBackdropE{{$p->id}}"  class="fa fa-trash" style="font-size:25px; color:crimson"></i>
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