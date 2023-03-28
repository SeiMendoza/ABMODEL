@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Cocina')
@section('miga')
 
@endsection
@section('content') 
<div style="margin-left:25px; margin-top:15px; display:block; float:left;" class="nav-link-icon">
    <h4>Pedidos en cocina</h4>
</div>

<!--Filtro de busqueda-->
<div> 
<div class="nav d-flex justify-content-end">
    <div class="nav-item" style="margin: 10px 25px 10px 25px;">
        <form action="{{ route('pedidosp.pcsearch')}}" method="get" role="search" 
            class="navbar-search">
            <div class="input-group">
                <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 350px" 
                placeholder="Buscar pedido por nombre del cliente" aria-label="Search" 
                aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($texto)) {echo $texto;} ?>" />
                <button class="border-radius-md" type="submit" style="border: 0; color:aliceblue; background:rgb(255,179,71);"><strong>Buscar</strong></button>    
                @if(isset($texto))
                    @if($texto != null)
                        <a href="{{route('pedidosp.pedido')}}" style="display:block; float:right"  
                        class="btn btn-secondary my-2 my-sm-0">Borrar Busqueda</a>
                    @endif
                @endif
            </div>   
            </form>
    </div>
</div>
     <!--------Lista de pedidos---------------->

     <div class="card-body">
         <div class="table-responsive container-fluid">
             <table class="table" id="table" style="background-color: #fff;">
                 <thead class="card-header border border-radius" style="text-align:center">
                     <tr>
                         <th scope="col">Número de mesa</th>
                         <th scope="col">Quiosco</th>
                         <th scope="col">Nombre del cliente</th>
                         <th scope="col">Terminado</th>
                         <th scope="col">Detalles</th>
                     </tr>
                 </thead>
                 <tbody>
                     @forelse($pedido as $p)
                     @if(($p->estado_cocina)=="1") 
                     <tr class="border border-light" style="text-align:center">
                         <th scope="col">{{$p->mesa}}</th>
                         <td scope="col">{{$p->quiosco}}</td> 
                         <td scope="col">{{$p->nombreCliente}}</td> 
                               
                              <td>
                                <!-----icono que envia el pedido de regreso a caja con un estado=2 y estado_cocina=2------>
                                <a href="#" id="envia_de_cocina" name="envia_de_cocina" 
                              {{!old('envia_de_cocina') ?: 'checked'}} data-bs-toggle="modal" 
                              data-bs-target="#staticBackdrop{{$p->id}}">
                              <i class="fa-solid fa-truck-fast text-danger"></i>
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
                                            <input type="submit" class="btn btn-danger w-15" value="Si">
                                            <button onclick="setTimeout(function(){location.reload();}, 00);" type="button" class="btn btn-menu" data-bs-dismiss="modal">No</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center;">No hay pedidos</td>
                        </tr>
                     @endforelse
                 </tbody>
                </table>
            </div>
     </div>
</div> 
@endsection
@section('pie')
    <div class="pagination justify-content-end"> 
        <div style="display:block; float:right;"> 
        {{$pedido->appends(['busqueda' => $texto])->links()}}
        </div>
    </div>
@endsection