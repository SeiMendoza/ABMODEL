@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Caja')
@section('miga')
     
<li class="breadcrumb-item text-sm text-dark active" aria-current="page">
<a class="text-dark" href="{{route('terminados.terminados')}}" onclick="cambia">Pedidos terminados</a></li>
@endsection
@section('content')
   
<div style="margin-left:25px; margin-top:15px; display:block; float:left;
        color: #333333;" class="nav-link-icon">                            
            <h4 class="h4"> <strong>Pedidos en caja</strong> </h4>
    </div>

<!--Filtro de busqueda-->
<div class="nav d-flex justify-content-end " style="margin:0px; display:block; float:rigth" >
        <div class="nav d-flex justify-content-end " style="height: 60px">
            <div class="" style="margin: 10px 0 0 10px">
                <form action="{{ route('pedidost.psearch') }}" method="get" role="search" 
                    class="navbar-search" >
                    <div class="input-group">
                        <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 250px" 
                        placeholder="Buscar por nombre" aria-label="Search" 
                        aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($texto)) {echo $texto;} ?>"/>
                        <button class="bg-success border-radius-md" type="submit" 
                            style="border: 0; color:aliceblue;width:80px;"><strong>Buscar</strong>
                        </button>     
                        @if(isset($texto))
                    @if($texto != null)
                        <a href="{{route('pedidost.pedido')}}" type="button" style="color:aliceblue; width:150px; padding:6px;"  
                        class="bg-secondary border-radius-md h-6 text-center"><strong style="">Borrar Busqueda</strong></a>
                        @endif
                        @endif
                    </div>   
                </form>
            </div>
            <div style="margin: 10px 25px 10px 25px;" class=" nav-link-icon">
                <a href="{{route('terminados.terminados')}}" type="button" class="bg-light border-radius-md h-6 text-center text-success" style="width:200px; padding:8px;">
                <i class="fa fa-newspaper"></i> <strong>Pedidos terminados</strong></a>
            </div>
        </div>
    </div>
<!--------Lista de pedidos---------------->
 
<div class="">
    <div class="table-responsive container-fluid">
        <table class="table" id="table" style="">
            <thead  class=""  style="text-align:center;">
                <tr>
                <th scope="col">N</th>
                    <th scope="col">Mesa</th>
                    <th scope="col">kiosko</th>
                    <th scope="col">Enviar a cocina</th>
                    <th scope="col">enviado de cocina</th>
                    <th scope="col">Terminar pedido</th>
                    <th scope="col">Detalles</th>
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
                        <a href="#"
                        id="envia_a_cocina" name="envia_a_cocina" 
                        data-bs-toggle="modal" data-bs-target="#static{{$p->id}}"> 
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
                    <div class="modal fade" id="staticBackdrop{{$p->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                    <input type="submit" class="btn btn-danger w-15" value="Si">
                                                <button type="button" class="btn btn-menu" data-bs-dismiss="modal">No</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
 <!-------Envia los pedidos por id a la cocina--------->
                                <div class="modal fade" id="static{{$p->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
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
                                                    <input type="submit" class="btn btn-danger w-15" value="Si">
                                                <button type="button" class="btn btn-menu" data-bs-dismiss="modal">No</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                @endif
                @empty
                <tr>
                    <td colspan="7" style="">No hay pedidos</td>
                </tr>
            @endforelse
            </tbody>
        </table>
        <div class="pagination justify-content-end"> 
        {{$pedido->appends(['busqueda' => $texto])->links()}}
        </div>
    </div>
</div>
 
@endsection
