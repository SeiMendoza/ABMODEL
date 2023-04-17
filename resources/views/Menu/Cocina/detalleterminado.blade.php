@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalle de caja')
@section('miga')
<li class="breadcrumb-item text-sm text-dark active" aria-current="page">
    <a class="text-dark" href="{{route('terminados.terminados')}}">Pedidos terminados</a>
</li>
@endsection


@section('b')
<div style="position:absolute; right:1%; top:30%">
    <a href="{{route('terminados.terminados')}}" class="btn btn-danger" type="buttom" style="float: right;">Regresar</a>

</div>
@endsection

@section('content')

<style>
    .titulo {
        width: 20%;
        font-weight: bold;
        height: 70px;
        line-height: 60px;
    }

    .informacion {
        width: 20%;
        height: 70px;
        line-height: 60px;
    }
</style>
<div class="mb-0 col-12 text-start">

    <table class="table">
        @php
        $sum = 0;
        @endphp
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
            <td class="informacion">L. <?= number_format($impuesto, 2, ".", ",") ?></td>
            <td class="titulo">Total:</td>
            <td class="informacion">L. <?= number_format($total_con_impuesto, 2, ".", ",") ?> </td>
        </tr>
    </table>
</div>



<table class="table" id="example">
    @php
    $sum = 0;
    @endphp
    <thead style="padding-top: 2px;">
        <tr class="text-dark">
            <th scope="col" style="width:20%; text-align:center;">Nombre</th>
            <th scope="col" style="width:20%; text-align:center;">Cantidad</th>
            <th scope="col" style="width:20%; text-align:center;">Precio</th>
            <th scope="col" style="width:20%; text-align:center;">Sub-total</th>
        </tr>
    </thead>
    <tbody class="col" style="overflow:auto;" id="">
        @forelse($detapedido as $i => $detalle)

        <tr>
            <td scope="" class="" style="width:20%; text-align:center; height:32px;">{{$detalle->nombre}}</td>
            <td scope="" style=" width:20%; text-align:center; height:42px;">{{ $detalle->cantidad }}</td>
            <td scope="col" style="text-align:right; width:20%; height:30px;">L. {{ number_format($detalle->precio, 2, ".", ",") }}</td>
            <td scope="col" style="text-align:right; width:20%; height:30px;">L. {{ number_format($detalle->precio*$detalle->cantidad, 2, ".", ",") }}</td>

            <!---   <td scope="col" style="text-align: center; height:42px;">
                   
                      <form action="{{route('cliente_detalles.destroy', ['id' => $detalle->id])}}" id="borrar" method="post" enctype="multipart/form-data">
                                        @method('delete')
                                        @csrf
                                        <button onclick="borrar()"  style="border: 0; padding:0; margin:0;" >
                                            <i class="fa-solid fa-trash-can text-danger" style="border: 0; padding:0; margin:0;"></i></button>
                                    </form> 
                </td>--->
        </tr>

        @empty

        @endforelse


</table>


@stop