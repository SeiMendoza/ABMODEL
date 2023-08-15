@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Caja')
@section('miga')
<li class="breadcrumb-item text-sm text-white active" aria-current="page">
    <a class="text-white" href="#">Pedidos</a>
</li>
@endsection
@section('tit','Pedidos en caja')
@section('b')
<div>
    <a href="{{route('terminados.terminados')}}" style="margin:0; padding:5px; width:150px;" type="button" class="bg-light border-radius-sm text-center">
        <i class="fa-regular fa-check-double"></i> Pedidos terminados
    </a>
</div>
@endsection
@section('content')

<!--------Lista de pedidos---------------->

<div class="table-responsive">
    <table class="table" id="example">
        <thead>
            <tr>
                <th scope="col" style="text-align:center">N</th>
                <th scope="col" style="text-align:center">Mesa</th>
                <th scope="col" style="text-align:center">kiosko</th>
                <th scope="col" style="text-align:center;text-transform:initial;">Enviar a cocina</th>
                <th scope="col" style="text-align:center;text-transform:initial;">Enviado de cocina</th>
                <th scope="col" style="text-align:center;text-transform:initial;">Terminar pedido</th>
                <th scope="col" style="text-align:center">Elementos</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pedido as $i => $p)
            @if ($p->detalles->count() > 0)
            @if($p->estado==1 || $p->estado==2)
            <tr style="text-align:center">
                <td scope="col">{{++$i}}</td>
                <td scope="col">Mesa- {{$p->mesa_nombre->nombre}}</td>
                <td scope="col">{{$p->mesa_nombre->kiosko->codigo}}</td>
                <td scope="col">
                    <!---enviar a cocina--si existe en la columna estado_cocina 1 o 2 mostrara un texto o mostrar un icono para enviar------>
                    @if ($p->estado_cocina == 1)
                    <!--Enviado-->
                    <i class="fa fa-check text-success"></i>
                    @elseif($p->estado_cocina == 2 || $p->estado==2)
                    <!--Entregar-->
                    <i class="fa fa-check-double text-success"></i>
                    @else
                    <!--- <a href="#" id="envia_a_cocina" name="envia_a_cocina" data-bs-toggle="modal" data-bs-target="#static{{$p->id}}">
                        <i class="fa-solid fa-truck-fast text-success"></i> 
                    </a>--->
                    <i data-bs-toggle="modal" data-bs-target="#static{{$p->id}}" class="fa-solid fa-truck-fast text-success"></i>
                    <form action="{{route('env.env_a_cocina', ['id'=>$p->id])}}" method="POST">
                        @method('put')
                        @csrf
                        <div class="modal fade" id="static{{$p->id}}" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title  font-weight-bolder" id="staticBackdropLabel">Enviar pedido a cocina</h5>
                                    </div>
                                    <div class="modal-body">
                                        ¿Enviar pedido a cocina para: {{$p->nombreCliente}}?
                                    </div>
                                    <div class="modal-footer">
                                        <div style="display: none">
                                            <input type="text" id="estado_cocina" name="estado_cocina" value="1">
                                            <input type="text" id="estado" name="estado" value="1">
                                        </div>
                                        <button type="submit" class="btn btn-danger">Si</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @endif
                </td>
                <!--- enviado de cocina--si existe en la columna estado_cocina 1 o 2 mostrara un texto------>
                <td scope="col">
                    @if ($p->estado_cocina == 1)
                    <!--Pendiente-->
                    <i class="fa fa-check"></i>
                    @elseif ($p->estado_cocina == 2)
                    <!--Terminado-->
                    <i class="fa fa-check-double text-success"></i>
                    @else

                    @endif
                </td>
                <td scope="col">
                    <!---terminar en caja--si existe en la columna estado_cocina 2 mostrara un icono para terminar el pedido------>
                    @if($p->estado_cocina == 2)
                    <!-- <a href="#" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$p->id}}">
                        <i class="fa-solid fa-truck-fast text-success"></i>
                    </a>-->
                    <i data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$p->id}}" class="fa-solid fa-truck-fast text-success"></i>
                    <form action="{{route('terminar.terminarp', ['id'=>$p->id])}}" method="POST">
                        @method('put')
                        @csrf
                        <div class="modal fade" id="staticBackdrop{{$p->id}}" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title  font-weight-bolder" id="staticBackdropLabel">Terminar pedido</h5>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro de terminar el pedido de: {{$p->nombreCliente}}?
                                    </div>
                                    <div class="modal-footer">
                                        <div style="display: none">
                                            <input type="text" id="estado" name="estado" value="3">
                                            <input type="hidden" name="mesa" value="{{ $p->mesa_id }}">
                                        </div>
                                        <button type="submit" class="btn btn-danger">Si</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @elseif($p->estado_cocina == 1)
                    <!--Esperando de cocina-->
                    <i class="fa fa-check"></i>
                    @else
                    @endif
                <td style="text-align:center; width:20%; height:20%;">
                    <div style="display: flex; justify-content: center; flex-direction: row;position: relative;">
                        <a href="{{route('pedidost.detalle',['id'=>$p->id])}}">
                            <i style="margin-right: 15px;" class="ni ni-single-copy-04 text-success opacity-10"></i>
                        </a>
                        @if($p->estado_cocina == 0)
                        <i data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$p->id}}" class="fa-solid fa-trash-can text-danger" style="font-size:15px;text-align:center;position: absolute; margin-left:20%; top: 50%;transform: translateY(-50%);"></i>
                        <form action="{{route('eliminar.pedido', ['id'=>$p->id])}}" method="POST">
                        @method('post')
                        @csrf
                        <div class="modal fade" id="staticBackdrop{{$p->id}}" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title  font-weight-bolder" id="staticBackdropLabel">Eliminar pedido</h5>
                                    </div>
                                    <div class="modal-body">
                                        ¿Está seguro de eliminar el pedido de: {{$p->nombreCliente}}?
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" class="btn btn-danger">Si</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    @else
                    <i class="fa-solid fa-trash-can text-gray" style="font-size: 15px;text-align:center;position: absolute; margin-left:20%; top: 50%;transform: translateY(-50%);"></i>
                    @endif
                    </div>
                </td>
            </tr>
            <!-------Termina los pedidos y los envia a pedidos terminados 
            <div class="modal fade" id="staticBackdrop{{$p->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  font-weight-bolder" id="staticBackdropLabel">Terminar pedido</h5>
                        </div>
                        <div class="modal-body" style="text-align: center;">
                            ¿Está seguro de terminar el pedido de: <strong>{{$p->nombreCliente}}</strong>?
                        </div>
                        <div class="modal-footer">
                            <form action="{{route('terminar.terminarp', ['id'=>$p->id])}}" method="POST">
                                @method('put')
                                @csrf
                                <div style="display: none">
                                    <input type="text" id="estado" name="estado" value="3">
                                    <input type="hidden" name="mesa" value="{{ $p->mesa_id }}">
                                </div>
                                <button type="submit" class="btn btn-danger">Si</button>
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                        </div>
                        </form>
                    </div>
                </div>
            </div>-------->
            <!-------Envia los pedidos por id a la cocina 
            <div class="modal fade" id="static{{$p->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                <div class="modal-dialog">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title  font-weight-bolder" id="staticBackdropLabel">Enviar pedido a cocina</h5>
                        </div>
                        <div class="modal-body">
                            ¿Enviar pedido a cocina para: {{$p->nombreCliente}}?
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
                    </div>
                </div>
            </div>
        </div>
</form>--------->
            @endif
            @endif
            @empty

            @endforelse
        </tbody>
    </table>
</div>

@endsection