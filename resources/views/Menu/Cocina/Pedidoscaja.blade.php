@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Caja')
@section('miga')
<li class="breadcrumb-item text-sm text-dark active" aria-current="page">
    <a class="text-dark" href="{{route('terminados.terminados')}}">Pedidos terminados</a>
</li>
@endsection
@section('b')
<h3 class="font-weight-bolder opacity-8  text-gray mb-0" style="position: absolute; top:100%;">Pedidos en caja</h3>
<div class="" style="position:absolute; right:0%; top:16%">
    <a href="{{route('terminados.terminados')}}" style="margin:0;width:200px; padding:6px;" class="bg-light border-radius-md h-6 text-center text-gray font-weight-bolder">
        <i class="fa fa-plus-circle"></i> Pedidos terminados
    </a>
</div>
@endsection
@section('content')

<!--------Lista de pedidos---------------->

<div class="table-responsive">
    <table class="table" id="example" style="">
        <thead>
            <tr>
                <th scope="col" style="text-align:center">N</th>
                <th scope="col" style="text-align:center">Mesa</th>
                <th scope="col" style="text-align:center">kiosko</th>
                <th scope="col" style="text-align:center">Enviar a cocina</th>
                <th scope="col" style="text-align:center">enviado de cocina</th>
                <th scope="col" style="text-align:center">Terminar pedido</th>
                <th scope="col" style="text-align:center">Detalles</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pedido as $i => $p)
            @if(($p->estado)=="0" || $p->estado==1 || $p->estado==2 )
            <tr style="text-align:center">
                <td scope="col">{{++$i}}</td>
                <td scope="col">{{$p->mesa_nombre->nombre}}</td>
                <td scope="col">{{$p->quiosco}}</td>
                <td scope="col">
                    <!-----si existe en la columna estado_cocina 1 o 2 mostrara un texto o mostrar un icono para enviar------>
                    @if ($p->estado_cocina == 1)
                    Enviado
                    @elseif($p->estado_cocina == 2 || $p->estado==2)
                    Entregar
                    @else
                    <a href="#" id="envia_a_cocina" name="envia_a_cocina" data-bs-toggle="modal" data-bs-target="#static{{$p->id}}">
                        <i class="fa-solid fa-truck-fast text-success"></i>
                    </a>
                    @endif
                </td>
                <!-----si existe en la columna estado_cocina 1 o 2 mostrara un texto------>
                <td scope="col">
                    @if ($p->estado_cocina == 1)
                    Pendiente
                    @elseif ($p->estado_cocina == 2)
                    Terminado
                    @else

                    @endif
                </td>
                <td scope="col">
                    <!-----si existe en la columna estado_cocina 2 mostrara un icono para terminar el pedido------>
                    @if($p->estado_cocina == 2)
                    <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$p->id}}">
                        <i class="fa-solid fa-truck-fast text-success"></i>
                    </a>
                    @elseif($p->estado_cocina == 1)
                    Esperando
                    @else
                    @endif
                <td scope="col">
                    <a href="{{route('pedidost.detalle',['id'=>$p->id])}}">
                        <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
                    </a>
                </td>
            </tr>
            <!-------Termina los pedidos y los envia a pedidos terminados-------->
            <div class="modal fade" id="staticBackdrop{{$p->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Terminar pedido</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="color: teal;">
                            ¿Está seguro de terminar el pedido de: <strong>{{$p->nombreCliente}}</strong>?
                        </div>
                        <div class="modal-footer">
                            <form action="{{route('terminar.terminarp', ['id'=>$p->id])}}" method="POST">
                                @method('put')
                                @csrf
                                <div style="display: none">
                                    <input type="text" id="estado" name="estado" value="3">
                                </div>
                                <button type="submit" class="btn btn-danger">Si</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            <!-------Envia los pedidos por id a la cocina--------->
            <div class="modal fade" id="static{{$p->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="staticBackdropLabel">Enviar pedido a cocina</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body" style="color: teal;">
                            !El pedido para¡ <strong>{{$p->nombreCliente}}</strong> se enviara a cocina
                        </div>
                        <div class="modal-footer">
                            <form action="{{route('env.env_a_cocina', ['id'=>$p->id])}}" method="POST">
                                @method('put')
                                @csrf
                                <div style="display: none">
                                    <input type="text" id="estado_cocina" name="estado_cocina" value="1">
                                    <input type="text" id="estado" name="estado" value="1">
                                </div>
                                <button type="submit" class="btn btn-danger">Si</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
            @endif
            @empty

            @endforelse
        </tbody>
    </table>
</div>

@endsection