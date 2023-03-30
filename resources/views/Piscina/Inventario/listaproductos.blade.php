@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Piscina-productos')
@section('miga')
    <li class="breadcrumb-item text-sm active text-dark active">
    <a class="opacity-5 text-dark" href="{{route('piscina.store')}}">Nuevo producto</a>
    </li>
@endsection
@section('content')
<div style="margin-left:25px; margin-top:15px; display:block; float:left;
        color: #333333;" class="nav-link-icon">                            
            <h4 class="h4"> <strong>Productos de piscina</strong> </h4>
    </div>

<!--Filtro de busqueda-->
<div class="nav d-flex justify-content-end " style="margin:0px; display:block; float:rigth" >
        <div class="nav d-flex justify-content-end " style="height: 60px">
            <div class="" style="margin: 10px 0 0 10px">
                <form action="{{ route('producto.search') }}" method="get" role="search" 
                    class="navbar-search" >
                    <div class="input-group">
                        <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 250px" 
                        placeholder="Buscar por nombre" aria-label="Search" 
                        aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($text)) {echo $text;} ?>"/>
                        <button class="bg-success border-radius-md" type="submit" 
                            style="border: 0; color:aliceblue;width:80px;"><strong>Buscar</strong>
                        </button>     
                        @if(isset($text))
                    @if($text != null)
                        <a href="{{route('prodpiscina.index')}}" type="button" style="color:aliceblue; width:150px; padding:6px;"  
                        class="bg-secondary border-radius-md h-6 text-center"><strong style="">Borrar Busqueda</strong></a>
                        @endif
                        @endif
                    </div>   
                </form>
            </div>
            <div style="margin: 10px 25px 10px 25px;" class=" nav-link-icon">
                <a href="{{route('piscina.create')}}" type="button" class="bg-light border-radius-md h-6 text-center text-success" style="width:200px; padding:8px;">
                <i class="fa fa-newspaper"></i> <strong>Nuevo producto</strong></a>
            </div>
        </div>
    </div>
    
    <!--------Lista de pedidos---------------->

    <div class="">
        <div class="table-responsive container-fluid">
            <table class="table" id="table" style="">
                <thead class="" style="text-align:center">
                    <tr>
                        <th scope="col">N</th>
                        <th scope="col">Producto</th>
                        <th scope="col">Tipo de producto</th>
                        <th scope="col">Cantidad</th>  
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                @forelse($prod as $i => $p)
                <tr class="" style="text-align:center;">
                <td scope="col">{{++$i}}</td>
                <td scope="col">{{$p->nombre}}</td>
                <td scope="col">{{$p->tipo_producto->descripcion}}</td>
                <td scope="col">{{$p->peso}} Kg</td>
                <td>
                <a  href="{{ route('producto.edit', ['id' => $p->id]) }}">
                <i class="fa-solid fa-edit text-success" style="color:rgb(33, 195, 247)"></i>
                </td>
                <td>
                <i data-bs-toggle="modal" data-bs-target="#staticBackdropE{{$p->id}}"  class="fa-solid fa-trash-can text-danger" style="color:crimson"></i>
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
                                                <button   type="button" class="btn btn-menu" data-bs-dismiss="modal">No</button>
                                            
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