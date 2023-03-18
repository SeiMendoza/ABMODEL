@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Pedidos-terminados')
@section('miga')
    <li class="breadcrumb-item text-sm text-dark" aria-current="page">
    <a class="text-dark" href="{{route('pedidost.pedido')}}">Caja</a></li>
@endsection
@section('content')
 
        <div style="margin-left:25px; margin-top:15px; display:block; float:left;
        color: #333333;font-family: Georgia, Serif;" class="nav-link-icon">                            
            <h4>Pedidos terminados</h4>
        </div>
 <!--Filtro de busqueda-->
 
 <div class="nav d-flex justify-content-end">
            <div class="" style="margin: 10px 25px 10px 25px;">
    <form action="{{ route('pedidost.search')}}" method="get" role="search" 
        class="navbar-search">
        <div class="input-group">
            <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 350px" 
            placeholder="Buscar pedido por nombre del cliente" aria-label="Search" 
            aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($texto)) {echo $texto;} ?>" />
            <button class="border-radius-md" type="submit" style="border: 0; color:aliceblue; background:rgb(255,179,71);">
            <strong>Buscar</strong></button>    
            @if(isset($texto))
                @if($texto != null)
                    <a href="{{route('terminados.terminados')}}" style="display:block; float:right"  
                    class="btn btn-secondary my-2 my-sm-0">Borrar Busqueda</a>
                @endif
            @endif
        </div>   
    </form>
</div>
 </div>
 
 
        <div class="card-body">
    <div class="table-responsive container-fluid">
        <table class="table" id="table" style="background-color: #ff9999;">
            <thead class="card-header border border-light" style="background-color: #fff; color:teal;text-align:center;">
                <tr style="font-family: Georgia, Serif;font-size:19px">
                    <th scope="col">Número de mesa</th>
                    <th scope="col">Quiosco</th> 
                    <th scope="col">Nombre del cliente</th>
                    <th scope="col">Terminado</th>
                    <th scope="col">Detalles</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pedido as $p)
                @if(($p->estado)=="2")
                <tr class="border border-light" style="background-color: #fff; color:teal;text-align:center;">
                    <th scope="col">{{$p->mesa}}</th>
                    <td scope="col">{{$p->quiosco}}</td> 
                    <td scope="col">{{$p->nombreCliente}}</td>
                    <td><input disabled type="checkbox" name="term" {{ old('term') ?: 'checked' }} data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$p->id}}"
                    style="background:#ffffff; width:20px; height:20px;"></input></td>
                    <td>
                        <a type="buttom" class="btn btn-light" href="{{route('terminados.detalle',['id'=>$p->id])}}">
                            <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
                        </a>
                    </td>
                </tr>
                @endif
                @empty
                <tr>
                    <td colspan="7" style="text-align: center;color:teal;">No hay pedidos terminados</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
<div style="text-align: center;">
<a class="btn btn-danger" href="{{route('pedidost.pedido')}}">Volver</a>
</div>    
 @endsection