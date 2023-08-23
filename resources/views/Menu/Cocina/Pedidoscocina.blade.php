@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Cocina')
@section('miga')
<li class="breadcrumb-item text-sm text-white active" aria-current="page">
    <a class="text-white" href="#">Pedidos</a>
</li>
@endsection
@section('tit','Pedidos en cocina')
@section('b')
 
@endsection
@section('content')

<!--------Lista de pedidos---------------->

<div class="">
    <div class="table-responsive">
        <table class="table" id="example">
            <thead>
                <tr>
                    <th scope="col" style="text-align:center">N</th>
                    <th scope="col" style="text-align:center">Mesa</th>
                    <th scope="col" style="text-align:center">Kiosko</th>
                    <th scope="col" style="text-align:center;text-transform:initial;">Nombre del cliente</th>
                    <th scope="col" style="text-align:center;text-transform:initial;">Tiempo transcurrido</th>
                    <th scope="col" style="text-align:center;text-transform:initial;">Enviar a caja</th>
                    <th scope="col" style="text-align:center">Elementos</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pedido as $i => $p)
                @if(($p->estado_cocina)=="1")
                <tr class="" style="text-align:center">
                    <td scope="col">{{++$i}}</td>
                    <td scope="col">Mesa- {{$p->mesa_nombre->nombre}}</td>
                    <td scope="col">{{$p->mesa_nombre->kiosko->codigo}}</td>
                    <td scope="col">{{$p->nombreCliente}}</td>
                    <td scope="col" id="tiempo{{$p->id}}"></td>
                    <!--Funcion para el tiempo transcurrido en cocina-->
                    <script>
                        setInterval(() => {
                            var creacion = new Date('{{$p->created_at}}')
                            var actual = new Date();
                            var msr = actual - creacion;
                            
                            var hora =  Math.floor((msr)/1000/60/60);
                
                            msr = msr-(hora*60*60*1000);
                
                            var minuto = Math.floor((msr)/1000/60);
                            msr = msr-(minuto*60*1000);
                
                            var segundos =  Math.floor((msr)/1000);
                
                            var texto = '';
                
                            if (hora != 0) {
                                if (hora == 1) {
                                    texto = hora+' hora '
                                } else {
                                    texto = hora+' horas '
                                }
                                texto = texto+minuto+' minutos ';
                            }else{
                                texto = texto+minuto+' minutos '+segundos+' segundos';
                            }
                            
                            
                            document.getElementById("tiempo{{$p->id}}").innerHTML = texto;
                        }, 100);
                    </script>

                    <td>
                        <!-----icono que envia el pedido de regreso a caja con un estado=2 y estado_cocina=2------>
                      <!---  <a href="#" id="envia_de_cocina" name="envia_de_cocina" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$p->id}}"> 
                          </a>-->
                            <i data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$p->id}}" class="fa-solid fa-truck-fast text-success"></i>
                            <form action="{{route('pedidosPendientes_Cocina.pedidosPendientes_Cocina', ['id'=>$p->id])}}" method="POST">
                                    @method('put')
                                    @csrf
                                    <div class="modal fade" id="staticBackdrop{{$p->id}}" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title  font-weight-bolder" id="staticBackdropLabel">Completar pedido</h5>
                                    </div>
                                    <div class="modal-body">
                                        ¿Pedido completado para: {{$p->nombreCliente}}?
                                    </div>
                                    <div class="modal-footer">
                                    <div style="display: none">
                                        <input type="text" id="estado" name="estado" value="2">
                                        <input type="text" id="estado_cocina" name="estado_cocina" value="2">
                                        <input type="text" id="estC" name="estC" value="1">
                                    </div>
                                        <button type="submit" class="btn btn-danger">Si</button>
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                    </td>
                    <td style="text-align:center; width:20%; height:20%;">
                    <div style="display: flex; justify-content: center; flex-direction: row;position: relative;">
                        <a type="buttom" href="{{route('pedidosp.detalle',['id'=>$p->id])}}">
                            <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
                        </a> 
                        <i data-bs-toggle="modal" data-bs-target="#stat{{$p->id}}" class="fa-solid fa-trash-can text-danger" style="font-size:15px;text-align:center;position: absolute; margin-left:20%; top: 50%;transform: translateY(-50%);"></i>
                        <form action="{{route('eliminar.pedido', ['id'=>$p->id])}}" method="POST">
                        @method('post')
                        @csrf
                        <div class="modal fade" id="stat{{$p->id}}" data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                    </div>
                    </td>
                </tr>
                @endif
                @empty

                @endforelse
            </tbody>
        </table>
    </div>
</div>
</div>
@endsection