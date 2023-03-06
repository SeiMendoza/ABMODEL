@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Pedidos-cocina')
@section('activatedMenu')
   
 <script>
        var msg = '{{Session::get('mensaje')}}';
        var exist = '{{Session::has('mensaje')}}';
        if(exist){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: msg,
                showConfirmButton: false,
                toast: true,
                background: '#fff',
                timer: 5500
            })
        }
    </script>
    
<h5 class="card class-2 text-lg text-center" 
 style="background-color: #fff; color:#fff; background:rgb(255,179,71); position: relative;"
 >Lista de pedidos pendientes en caja</h5>

 <!--Filtro de busqueda-->

 <div class="nav-item" style="margin: 10px 25px 10px 25px;">
    <form action="{{ route("pedidost.pedido") }}" method="get" role="search" 
        class="navbar-search">
        <div class="input-group">
            <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 350px" 
            placeholder="Buscar pedido por nombre del cliente" aria-label="Search" 
            aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($texto)) {echo $texto;} ?>" />
            <button class="btn btn-menu my-2 my-sm-0" type="submit"><strong>Buscar</strong></button>    
            @if(isset($texto))
                @if($texto != null)
                    <a href="{{route('pedidost.pedido')}}" style="display:block; float:right"  
                    class="btn btn-secondary my-2 my-sm-0">Borrar Busqueda</a>
                @endif
            @endif
        </div>   
    </form>
</div>
 
<!--------Lista de pedidos---------------->
 
<div class="card-body">
    <div class="table-responsive container-fluid">
        <table class="table" id="table" style="background-color: #fff;">
            <thead class="card-header border " style="background-color: #fff; color:teal; text-align:center;">
                <tr>
                    <th scope="col">Número de mesa</th>
                    <th scope="col">Nombre del cliente</th>
                    <th scope="col">Orden</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Terminado</th>
                    <th scope="col">Detalles</th>
                </tr>
            </thead>
            <tbody>
                @forelse($pedido as $p)
                @if(($p->estado)=="0")
                <tr class="border border-light" style="background-color: #fff; color:teal; text-align:center;">
                    <th scope="col">{{$p->mesa}}</th>
                    <td scope="col">{{$p->nombreCliente}}</td>
                    <td></td>
                         <td></td>
                         @foreach($p->detalle as $d)
                         <td scope="col">{{$d->producto_id}}</td>
                         <td scope="col">{{$d->cantidad}}</td>
                         @endforeach
                         
                    <td ><input type="checkbox" name="term" {{ !old('term') ?: 'checked' }} data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$p->id}}"
                    style="background:#ffffff; width:20px; height:20px;">
                </td>
                <td>
                    <a type="buttom" class="btn btn-light" href="{{route('pedidost.detalle',['id'=>$p->id])}}">
                        <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
                    </a>
                </td>
            </tr>
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
                                                        <input type="text" id="estado" name="estado" value="2">
                                                    </div>
                                                    <input type="submit" class="btn btn-primary w-15" value="Si">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                            </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                @endif
                @empty
                <tr>
                    <td colspan="7" style="text-align: center;color:white;">No hay pedidos</td>
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
