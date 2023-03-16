@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Pedidos-Anteriores')
@section('content')



<div class="mb-0 col-11 text-start">
<div class="row text-center container pt-2">
        <h3 style="background:#2ff67b;" class="card text-white text-uppercase p-2" >PEDIDOS ANTERIORES
        </h3>
</div>

 <!--Filtro de busqueda-->

<div class="nav-item" style="margin: 10px 25px 10px 25px; right:180px;">
    <!-- <div> 
    <form class="d-inline " data-bs-toggle="modal" method="post" enctype="multipart/form-data">
        @csrf
            <button class="btn btn-danger" type="submit"  data-bs-toggle="modal">Eliminar Datos</button>
    </form>
    </div>  -->

    <form action="{{ route('pedidoant.pedidos_anteriores')}}" method="get" role="search" 
        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
        <div class="input-group">
            <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 350px" 
            placeholder="Buscar pedido por nombre del cliente" aria-label="Search" 
            aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($texto)) {echo $texto;} ?>" />
            <button class="btn btn-menu my-2 my-sm-0" type="submit"><strong>Buscar</strong></button>    
            @if(isset($texto))
                @if($texto != null)
                    <a href="{{route('pedidoant.pedidos_anteriores')}}" style="display:block; float:right"  
                    class="btn btn-secondary my-2 my-sm-0">Borrar Busqueda</a>
                @endif
            @endif
        </div>   
    </form>
    <a style="position: absolute; right:180px;" class="btn btn-menu"> 
        <i></i> Regresar</a>
</div>
 
    <div class="card-body">
    <div class="table-responsive container-fluid">
        <table class="table" id="table" style="background-color:#2ff67b ;">
            <thead class="card-header border border-light" style="background-color: #fff; color:teal;text-align:center;">
                <tr>
                    <th scope="col">Nombre del Cliente</th>
                    <th scope="col">Entregado</th>
                    <th scope="col">Pagado</th>
                    <th scope="col">Total</th>
                    <th scope="col">Detalles</th> 
                </tr>
            </thead>
            <tbody>

        <tbody>
                @forelse($pedido as $p)
                @if(($p->estado)=="2")
                <tr class="border border-light" style="background-color: #fff; color:rgb(12, 12, 12);text-align:center;">
                    <th scope="col">{{$p->nombreCliente}}</th>
                    <td><input disabled type="checkbox" name="entregado" {{ old('entregado') ?: 'checked' }} data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$p->id}}"
                    style="background:#ffffff; width:20px; height:20px;"></input></td>
                    <td><input disabled type="checkbox" name="pagado" {{ old('pagado') ?: 'checked' }} data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$p->id}}"
                        style="background:#ffffff; width:20px; height:20px;"></input></td>
                    <th scope="col">{{$p->total}}</th>
                    <td>
                        <a type="buttom" class="btn btn-light" href="{{route('pedidoAnterior.detalle',['id'=>$p->id])}}">
                            <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
                        </a>
                    </td>
                </tr>
            
                @endif
                @empty
                <tr>
                    <td colspan="7" style="text-align: center;color:teal;"><h5>Cliente no encontrado</h5></td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
 @endsection


 
                
            