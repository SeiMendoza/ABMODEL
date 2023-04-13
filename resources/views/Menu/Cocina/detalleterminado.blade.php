@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalle de caja')
@section('miga')
<li class="breadcrumb-item text-sm text-dark active" aria-current="page">
    <a class="text-dark" href="{{route('terminados.terminados')}}">Pedidos terminados</a>
</li>
@endsection
@section('content')
 
<style>
    .titulo{
        width: 20%;
        font-weight: bold;
        height: 70px;
        line-height: 60px;
    }
    .informacion{
        width: 20%;
        height: 70px;
        line-height: 60px;
    }
</style>
<div class="mb-0 col-12 text-start">
 
<table class="table">
<h5 class="card class-4 text-lg text-center" style="background:rgb(255,179,71); color:#fff;
      position: relative;">Detalle del pedido terminado: {{$pedido->nombreCliente}}</h5>
    <tr>
        <td class="titulo">Número de mesa: </td>
        <td class="informacion">{{$pedido->mesa_nombre->nombre}}</td>
        <td class="titulo">Kiosko:</td>
        <td class="informacion">{{$pedido->quiosco}}</td>
    </tr>
    <tr>
        <td class="titulo">Nombre del cliente: </td>
        <td class="informacion">{{$pedido->nombreCliente}}</td>
        <td class="titulo">Estado:</td>
        <td class="informacion">
        @if($pedido->estado == 3)
                    Entregado al cliente
                    @endif
           <!--- @if ($pedido->estado == 0)
                Pendiente en cocina
            @else
                @if ($pedido->estado == 1)
                    Pendiente en caja
                @else
                    Terminado
                @endif  
            @endif--->
        </td>
    </tr>
    <tr>
        <td class="titulo">Hora del pedido: </td>
        <td class="informacion">{{date('h:i:s a',strtotime($pedido->created_at))}}</td>
        <td class="titulo">Hora de entrega:</td>
        <td class="informacion" id="tiempo"> {{date('h:i:s a',strtotime($pedido->updated_at))}} </td>
    </tr>
    <tr>
        <td class="titulo">Impuesto: </td>
        <td class="informacion">L. {{number_format($pedido->imp, 2, '.', ',')}}</td>
        <td class="titulo">Total:</td>
        <td class="informacion">L. {{number_format($pedido->total, 2, '.', ',')}}</td>
    </tr>
</table>

<a href="{{route('terminados.terminados')}}" class="btn btn-danger" type="buttom" style="float: right;">Regresar</a>

@stop