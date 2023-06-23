@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalle de caja')
@section('miga')
<li class="breadcrumb-item text-sm opacity-5 text-white active" aria-current="page">
    <a class="text-white" href="{{route('terminados.terminados')}}">Pedidos terminados</a>
</li>
<li class="breadcrumb-item text-sm text-white" aria-current="page">
    <a class="text-white">Detalles</a>
</li>
@endsection


@section('b')
<div>
    <a href="{{route('terminados.terminados')}}" style="margin:0; padding:5px; width:150px;" type="button" class="bg-light border-radius-sm text-center"> <i class="fa fa-arrow-left"></i> Regresar</a>
</div>
@endsection

@section('content')

<style>
    .titulo {
        width: 20%;
        font-weight: bold;
        height: 40%;
        line-height: 190%;
    }

    .informacion {
        width: 20%;
        height: 40%;
        line-height: 190%;
    }
</style>
<div class="mb-0 col-12 text-start" style="position:absolute;top:0.2%;width:82%;">

    <table class="table" style="position: absolute;top:100%;width:100%;height:100%;">
        @php
        $sum = 0;
        @endphp
        <h5 class="card class-4 text-lg text-center" style="background:rgb(255,179,71); color:#fff;">
            Detalle del pedido terminado: {{$pedido->nombreCliente}}</h5>
        <tr>
            <td class="titulo">Número de mesa: </td>
            <td class="informacion">{{$pedido->mesa_nombre->nombre}}</td>
            <td class="titulo">Kiosko:</td>
            <td class="informacion">{{$pedido->quiosco}}</td>
            <td class="titulo">Sub total:</td>
            <td class="informacion">L. <?= number_format($sub, 2, ".", ",") ?> </td>
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
            <td class="titulo">Impuesto: </td>
            <td class="informacion">L. <?= number_format($isv, 2, ".", ",") ?></td>
        </tr>
        <tr>
            <td class="titulo">Hora del pedido: </td>
            <td class="informacion">{{date('h:i:s a',strtotime($pedido->created_at))}}</td>
            <td class="titulo">Hora de entrega:</td>
            <td class="informacion" id="tiempo"> {{date('h:i:s a',strtotime($pedido->updated_at))}} </td>
            <td class="titulo">Total:</td>
            <td class="informacion">L. <?= number_format($tot, 2, ".", ",") ?> </td>
        </tr>
        </tbody>
    </table>
    <div class="mb-0 col-9 text-start" style="position:absolute;top:260%;width:100%;">
        <table class="table" id="example" style="width:100%;height:100%;">
            @php
            $sum = 0;
            @endphp
            <thead>
                <tr class="text-dark" style="background:rgba(255,179,71,0.6);">
                    <th scope="col" style="width:20%; text-align:center;">Nombre</th>
                    <th scope="col" style="width:20%; text-align:center;">Cantidad</th>
                    <th scope="col" style="width:20%; text-align:center;">Precio</th>
                    <th scope="col" style="width:20%; text-align:center;">Sub total</th>
                </tr>
            </thead>
            <tbody class="col" style="overflow:auto;" id="">
                @forelse($detapedido as $i => $detalle)

                <tr>
                    <td scope="" class="" style="width:20%; text-align:center; height:20%;">{{$detalle->producto->nombre}}</td>
                    <td scope="" style=" width:20%; text-align:center; height:20%;">{{ $detalle->cantidad }}</td>
                    <td scope="col" style="text-align:right; width:20%; height:20%;">L. {{ number_format($detalle->precio, 2, ".", ",") }}</td>
                    <td scope="col" style="text-align:right; width:20%; height:20%;">L. {{ number_format($detalle->precio*$detalle->cantidad, 2, ".", ",") }}</td>

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

    </div>

</div>
@stop