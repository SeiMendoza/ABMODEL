@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Pedidos-terminados')
@section('miga')
    <li class="breadcrumb-item text-sm text-dark" aria-current="page">
    <a class="text-dark" href="{{route('pedidost.pedido')}}">Caja</a></li>
@endsection
@section('content')
<div style="margin-left:25px; margin-top:15px; display:block; float:left;
        color: #333333;" class="nav-link-icon">                            
            <h4 class="h4"> <strong>Pedidos terminados</strong> </h4>
    </div>
 <!--Filtro de busqueda-->
 <div class="nav d-flex justify-content-end " style="margin:0px; display:block; float:rigth" >
        <div class="nav d-flex justify-content-end " style="height: 60px">
            <div class="" style="margin: 10px 0px 0px 10px;">
                <form action="{{ route('pedidost.search') }}" method="get" role="search" 
                    class="navbar-search" >
                    <div class="input-group">
                        <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 250px" 
                        placeholder="Buscar por nombre" aria-label="Search" 
                        aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($texto)) {echo $texto;} ?>"/>
                        <button class="bg-success border-radius-md" type="submit" 
                            style="border: 0; color:aliceblue;width:80px;"><strong>Buscar</strong>
                        </button>     
                        @if(isset($texto))
                    @if($texto != null)
                        <a href="{{route('terminados.terminados')}}" type="button" style="color:aliceblue; width:150px; padding:6px;"  
                        class="bg-secondary border-radius-md h-6 text-center"><strong style="">Borrar Busqueda</strong></a>
                        @endif
                        @endif
                    </div>   
                </form>
            </div>
            <div style="margin: 10px 25px 10px 25px;" class=" nav-link-icon">
                <a href="#" type="button" class="bg-light border-radius-md h-6 text-center text-success" 
                style="width:200px; padding:8px;" data-bs-toggle="modal" 
                data-bs-target="#exampleModalCenter">
                <i class="fa-solid fa-trash-can text-danger"></i> <strong>Eliminar pedidos</strong></a>
            </div>
        </div>
    </div>
<!-- Modal Eliminar-->
<form action="{{route('borrar.borrarDatos')}}" method="post" enctype="multipart/form-data">
    @method('delete')
   @csrf
    <div class="modal fade" id="exampleModalCenter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" 
        aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg-centered">
            <div class="modal-content">
                <div class="modal-header">
                <h4 style="text-color:red;" class="modal-title" id="exampleModalLongTitle">Eliminar Pedidos</h4>
            </div>
            <div class="modal-body">
                ¿Está seguro de eliminar los pedidos entregados?
            </div>
            <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
            <button type="submit" class="btn btn-danger">SÍ</button>
            </div>
        </div>
    </div>
</form>
 </div>
</div>
 
        <div class="">
    <div class="table-responsive container-fluid">
        <table class="table" id="table" style="">
            <thead class="" style="text-align:center;">
                <tr>
                <th scope="col">N</th>
                    <th scope="col">Número de mesa</th>
                    <th scope="col">Kiosko</th> 
                    <th scope="col">Nombre del cliente</th>
                    <th scope="col">Terminado</th>
                    <th scope="col">Detalles</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pedido as $i => $p)
                @if(($p->estado)=="3")
                <tr class="" style="text-align:center;">
                <td scope="col">{{++$i}}</td>
                         <td scope="col">{{$p->mesa_nombre}}</td>
                    <td scope="col">{{$p->quiosco}}</td> 
                    <td scope="col">{{$p->nombreCliente}}</td>
                    <td>
                        @if($p->estado == 3)
                        Entregado al cliente
                        @endif
                    </td>
                    <td>
                        <a type="button" href="{{route('terminados.detalle',['id'=>$p->id])}}">
                            <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
                        </a>
                    </td>
                </tr>
                @endif
                @empty
                <tr>
                    <td colspan="7" style="text-align: center;">No hay pedidos terminados</td>
                </tr>
                @endforelse
            </tbody>
        </table> 
        <div style="text-align: center;">
    <a class="btn btn-danger" href="{{route('pedidost.pedido')}}">Volver</a>
    <div class="pagination justify-content-end" style="display:inline-block; float:right;"> 
        {{$pedido->appends(['busqueda' => $texto])->links()}}
    </div>
</div>
    </div>
</div>   
@endsection
  