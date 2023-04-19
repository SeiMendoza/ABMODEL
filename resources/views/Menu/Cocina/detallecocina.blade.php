@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalle de cocina')
@section('miga')
<li class="breadcrumb-item opacity-5 text-sm text-white" aria-current="page">
    <a class="text-white" href="{{route('pedidosp.pedido')}}">Cocina</a>
</li>
<li class="breadcrumb-item text-sm text-white" aria-current="page">
    <a class="text-white">Detalles</a>
</li>
@endsection

@section('b')
<div>
    <a href="{{route('pedidosp.pedido')}}" style="margin:0; padding:5px; width:150px;" 
        type="button" class="bg-light border-radius-sm text-center">Regresar</a> 
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

        <h5 class="card class-4 text-lg text-center" style="text-align:center;background:rgb(255,179,71); color:#fff;">
        Detalles del pedido en cocina: {{$pedido->nombreCliente}}</h5>
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
                @if ($pedido->estado_cocina == 1 || $pedido->estado == 1)
                    Pendiente en cocina
                @else
                    Terminado
                @endif
            </td>
        </tr>
        <script>
            setInterval(() => {
                var creacion = new Date('{{$pedido->created_at}}')
                var actual = new Date();
                var msr = actual - creacion;

                var hora = Math.floor((msr) / 1000 / 60 / 60);

                msr = msr - (hora * 60 * 60 * 1000);

                var minuto = Math.floor((msr) / 1000 / 60);
                msr = msr - (minuto * 60 * 1000);

                var segundos = Math.floor((msr) / 1000);

                var texto = '';

                if (hora != 0) {
                    if (hora == 1) {
                        texto = hora + ' hora '
                    } else {
                        texto = hora + ' horas '
                    }
                }

                texto = texto + minuto + ' minutos ' + segundos + ' segundos';
                document.getElementById("tiempo").innerHTML = texto;
            }, 100);
        </script>
        <tr>
            <td class="titulo">Hora del pedido: </td>
            <td class="informacion">{{date('h:i:s a',strtotime($pedido->created_at))}}</td>
            <td class="titulo">Tiempo transcurrido en cocina:</td>

            <td class="informacion" id="tiempo">
            </td>
        </tr>
        <tr>
            <td class="titulo">Impuesto: </td>
            <td class="informacion">L. <?=number_format($impuesto, 2, ".", ",") ?></td>
            <td class="titulo">Total:</td>
            <td class="informacion">L. <?=number_format($total_con_impuesto, 2, ".", ",") ?></td>
        </tr>
        </tbody>
    </table>
    <div class="mb-0 col-9 text-start" style="position:absolute;top:260%;width:100%;">
    <table class="table" id="example" style="width:100%;height:100%;">
                    <thead>
                        <tr class="text-dark" style="background:rgba(255,179,71,0.6);">
                            <th scope="col" style="width:20%; text-align:center;">Nombre</th>
                            <th scope="col" style="width:20%; text-align:center;">Cantidad</th>
                            <th scope="col" style="width:20%; text-align:center;">Precio</th>
                            <th scope="col" style="width:20%; text-align:center;">Sub-total</th>
                        </tr>
                    </thead>
                    <tbody class="col" style="overflow:auto;" id="">
                        @php
                            $sum = 0;
                        @endphp
                        @forelse($detapedido as $i => $detalle)
                            
                            <tr>
                            <td scope="" class="" style="width:20%; text-align:center; height:32px;">{{$detalle->nombre}}</td>
                                <td scope=""  style=" width:20%; text-align:center; height:42px;">{{ $detalle->cantidad }}</td>
                                <td scope="col" style="text-align:right; width:20%; height:30px;">L. {{ number_format($detalle->precio, 2, ".", ",") }}</td>
                                <td scope="col" style="text-align:right; width:20%; height:30px;">L. {{ number_format($detalle->precio*$detalle->cantidad, 2, ".", ",") }}</td>
                                  
                            <!---   <td scope="col" style="text-align: center; height:42px;">
                                {{$detalle->pedido->mesa_nombre->nombre}}
                                     <form action="{{route('cliente_detalles.destroy', ['id' => $detalle->id])}}" id="borrar" method="post" enctype="multipart/form-data">
                                        @method('delete')
                                        @csrf
                                        <button onclick="borrar()"  style="border: 0; padding:0; margin:0;" >
                                            <i class="fa-solid fa-trash-can text-danger" style="border: 0; padding:0; margin:0;"></i></button>
                                    </form> 
                                </td> --->
                            </tr>
                            @php
                                $sum += $detalle->precio*$detalle->cantidad;
                            @endphp
                            
                        @empty
                            
                        @endforelse
                    </tbody>
                    </table>
                    </div>

</div>
    @stop