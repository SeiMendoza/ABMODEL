@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Cocina')
@section('miga')

@endsection
@section('b')
<h3 class="font-weight-bolder opacity-8  text-gray mb-0" style="position: absolute; top:100%;left:1%;">Pedidos en cocina</h3>
@endsection
@section('content')

<!--------Lista de pedidos---------------->

<div class="">
    <div class="table-responsive">
        <table class="" id="example" style="">
            <thead>
                <tr>
                    <th scope="col" style="text-align:center">N</th>
                    <th scope="col" style="text-align:center">Mesa</th>
                    <th scope="col" style="text-align:center">Kiosko</th>
                    <th scope="col" style="text-align:center">Nombre del cliente</th>
                    <th scope="col" style="text-align:center">Enviar a caja</th>
                    <th scope="col" style="text-align:center">Detalles</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pedido as $i => $p)
                @if(($p->estado_cocina)=="1")
                <tr class="" style="text-align:center">
                    <td scope="col">{{++$i}}</td>
                    <td scope="col">{{$p->mesa_nombre->nombre}}</td>
                    <td scope="col">{{$p->quiosco}}</td>
                    <td scope="col">{{$p->nombreCliente}}</td>

                    <td>
                        <!-----icono que envia el pedido de regreso a caja con un estado=2 y estado_cocina=2------>
                        <a href="#" id="envia_de_cocina" name="envia_de_cocina" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$p->id}}">
                            <i class="fa-solid fa-truck-fast text-success"></i>
                        </a>
                    </td>
                    <td>
                        <a type="buttom" href="{{route('pedidosp.detalle',['id'=>$p->id])}}">
                            <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
                        </a>
                    </td>
                </tr>
                <div class="modal fade" id="staticBackdrop{{$p->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Completar pedido</h1>
                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                            </div>
                            <div class="modal-body" style="color:teal">
                                ! pedido completado ¡ para: <strong>{{$p->nombreCliente}}</strong>?
                            </div>
                            <div class="modal-footer">
                                <form action="{{route('pedidosPendientes_Cocina.pedidosPendientes_Cocina', ['id'=>$p->id])}}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div style="display: none">
                                        <input type="text" id="estado" name="estado" value="2">
                                        <input type="text" id="estado_cocina" name="estado_cocina" value="2">
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
</div>
</div>
@endsection