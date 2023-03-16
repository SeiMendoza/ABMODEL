@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalle de caja')
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
<div class="mb-0 col-11 text-start">

    <div class="row text-center container pt-6">
<h5 class="card class-4 text-lg text-center" style="background:rgb(255,179,71); color:#fff;
      position: relative;">Detalle de pedidos terminado de: {{$pedido->nombreCliente}}</h5>
             
    </div>


<table class="table">
    <tr>
        <td class="titulo">Numero de mesa: </td>
        <td class="informacion">{{$pedido->mesa}}</td>
        <td class="titulo">Quisco:</td>
        <td class="informacion">{{$pedido->quiosco}}</td>
    </tr>
    <tr>
        <td class="titulo">Nombre del cliente: </td>
        <td class="informacion">{{$pedido->nombreCliente}}</td>
        <td class="titulo">Estado:</td>
        <td class="informacion">
            @if ($pedido->estado == 0)
                Pendiente en cocina
            @else
                @if ($pedido->estado == 1)
                    Pendiente en caja
                @else
                    Terminado
                @endif  
            @endif
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