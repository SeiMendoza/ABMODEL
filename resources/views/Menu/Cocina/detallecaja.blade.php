@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalle de caja')
@section('miga')
<li class="breadcrumb-item opacity-5 text-sm text-white" aria-current="page">
    <a class="text-white" href="{{route('pedidos.caja')}}">Caja</a>
</li>
<li class="breadcrumb-item text-sm text-white" aria-current="page">
    <a class="text-white">Detalles</a>
</li>
@endsection
@section('tit','Detalles del pedido')
@section('b')
<div>
    <a href="{{route('pedidos.caja')}}" style="margin:0; padding:5px; width:150px;" type="button" class="bg-light border-radius-sm text-center"> <i class="fa fa-arrow-left"></i> Regresar
    </a>
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
        height: 40%;
        line-height: 190%;
    }
</style>
<div class="mb-0 col-12 text-start" style="position:absolute;top:0.2%;width:82%;">

    <table class="table" style="position: absolute;top:100%;width:100%;height:100%;">

        <h5 class="card text-lg" style="text-align:center; background:rgb(255,179,71); color:#fff;">
        </h5>
        <tr>
            <td class="titulo">Número de mesa: </td>
            <td class="informacion">{{$pedido->mesa_nombre->nombre}}</td>
            <td class="titulo">Kiosko:</td>
            <td class="informacion">{{$pedido->mesa_nombre->kiosko->codigo}}</td>
            <td class="titulo">Cambiar mesa:</td>
            <td class="">
                <form action="{{ route('cambiar_mesa', $pedido->id) }}" method="POST">
                    @csrf
                    <select style="width: max-content;" name="nueva_mesa" class="form-control" onchange="this.form.submit();">
                        @if (count($mesas) === 0)
                        <option>No hay mesas disponibles</option>
                        @else
                        <option>Selccione una mesa</option>
                        @foreach($mesas as $mesa)
                        <option value="{{$mesa->id}}">{{$mesa->nombre}} - {{$mesa->kiosko->codigo}}</option>
                        @endforeach
                        @endif
                    </select>
                    @error('nueva_mesa')
                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                    @enderror
                </form>
            </td>
        </tr>
        <tr>
            <td class="titulo">Nombre del cliente: </td>
            <td class="informacion">{{$pedido->nombreCliente}}</td>
            <td class="titulo">Estado:</td>
            <td class="informacion">
                @if ($pedido->estado_cocina == 1)
                Procesando
                @elseif($pedido->estado_cocina == 2 || $pedido->estado==2)
                Entregar
                @else
                Enviar

                @endif
            </td>
            <td class="titulo">Sub total:</td>
            <td class="informacion">L. {{$sub}}</td>
        </tr>
        <tr>
            <?php $diferencia = $pedido->created_at->diff($pedido->updated_at) ?>
            <td class="titulo">Hora del pedido: </td>
            <td class="informacion">{{date('h:i:s a',strtotime($pedido->created_at))}}</td>
            <td class="titulo">Tiempo transcurrido en cocina:</td>
            @if($pedido->estado_cocina==1)
            <td class="informacion" id="tiempo">
                @else
            <td class="informacion">
                @if($pedido->estado_cocina==2)
                @if ($diferencia->format('%H')!=0)
                @if ($diferencia->format('%H')==1)
                {{$diferencia->format('%H hora %i minutos %s segundos')}}
                @else
                {{$diferencia->format('%H horas %i minutos %s segundos')}}
                @endif
                @else
                {{$diferencia->format('%i minutos %s segundos')}}
                @endif
                @else
                HH:MM:SS
                @endif
            </td>
            @endif
            <td class="titulo">Impuesto: </td>
            <td class="informacion">L. {{$isv}}</td>
        </tr>
        <tr>
            <td class="titulo">Hora del finalizado en cocina: </td>
            <td class="informacion">@if($pedido->estado_cocina==2)
                {{date('h:i:s a',strtotime($pedido->updated_at))}}
                @else
                HH:MM:SS
                @endif
            </td>
            <td class="titulo">Tiempo transcurrido en caja:</td>
            <td class="informacion" id="tiempo{{$pedido->id}}">
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
                            texto = texto + minuto + ' minutos ';
                        } else {
                            texto = texto + minuto + ' minutos ' + segundos + ' segundos';
                        }


                        document.getElementById("tiempo{{$pedido->id}}").innerHTML = texto;
                    }, 100);
                </script>
            </td>
            <td class="titulo">Total:</td>
            <td class="informacion">L. {{$tot}}</td>
        </tr>
    </table>

    <div class="mb-0 col-9 text-start" style="position:absolute;top:330%;width:100%;">
        <table class="table" id="example" style="width:100%;height:100%;">
            <thead>
                @if($pedido->estado_cocina == 0)
                <a href="{{ route('Agregar',$pedido->id) }}" class="border-radius-sm text-center" style="background:rgba(255,179,71,0.6);position:absolute;left:62%;padding:5px; width:150px; z-index: 999;">
                    <i class="fa fa-plus-circle"></i> <strong>Nuevo</strong>
                </a>
                @endif
                <tr class="text-dark" style="background:rgba(255,179,71,0.6);">
                    <th scope="col" style="width:20%;text-align:center;">Nombre</th>
                    <th scope="col" style="width:20%; text-align:center;">Cantidad</th>
                    <th scope="col" style="width:20%; text-align:center;">Precio</th>
                    <th scope="col" style="width:20%; text-align:center;">Sub total</th>
                    @if($pedido->estado_cocina == 0)
                    <th scope="col" style="width:20%; text-align:center;">Acciones</th>
                    @endif
                </tr>
            </thead>
            <tbody class="col" style="overflow:auto;" id="">
                @foreach ($detapedido as $detalle)
                @if($detalle->estado === 0 || $detalle->estado === 1)
                <td scope="col" style="width:20%; text-align:center; height:20%;">{{$detalle->producto->nombre}}</td>
                <td scope="col" style=" width:20%; text-align:center; height:20%;">{{ $detalle->cantidad }}</td>
                <td scope="col" style="text-align:right; width:20%; height:20%;">L. {{ number_format($detalle->precio, 2, ".", ",") }}</td>
                <td scope="col" style="text-align:right; width:20%; height:20%;">L. {{ number_format($detalle->precio*$detalle->cantidad, 2, ".", ",") }}</td>
                @if($pedido->estado_cocina == 0 )
                <td scope="col" style="text-align:center; width:20%; height:20%;">
                    <div style="display: flex; justify-content: center; flex-direction: row;position: relative;">
                        <a href="{{ route('detallep.edit', ['pedido_id' => $pedido->id, 'detalle_id' => $detalle->id]) }}" style="margin-right: 10px;">
                            <i class="fa-solid fa-edit text-success" style="color: rgb(33, 195, 247);"></i>
                        </a>
                        <i data-bs-toggle="modal" data-bs-target="#staticBackdropE{{$detalle->id}}" class="fa-solid fa-trash-can text-danger" style="color:crimson;text-align:center;position: absolute; margin-left:20%; top: 50%;transform: translateY(-50%);"></i>
                        <form action="{{route('detallep.destroy', ['id' => $detalle->id])}}" method="post" enctype="multipart/form-data">
                            @method('delete')
                            @csrf
                            <div class="modal fade" id="staticBackdropE{{$detalle->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <h5 class="modal-title  font-weight-bolder" id="staticBackdropLabel">Eliminar producto</h5>
                                        </div>
                                        <div class="modal-body">
                                            ¿Está seguro de borrar el producto <strong>{{$detalle->producto->nombre}}</strong>?
                                        </div>
                                        <div class="modal-footer">
                                            <button type="submit" class="btn btn-danger">Si</button>
                                            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </td>
                @endif
                </tr>
                @endif
                @endforeach
            </tbody>
        </table>
    </div>

</div>
<script>
    setInterval(() => {
        var creacion = new Date('{{$pedido->updated_at}}')
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
@stop