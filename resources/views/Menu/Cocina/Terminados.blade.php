@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Pedidos-cocina')
@section('activatedMenu')
<div> 
    <h5 class="card class-4 text-lg text-center" style="background:rgb(255,179,71); color:#fff; position: relative;
 ">Lista de pedidos terminados</h5>
 
        <div class="card-body">
    <div class="table-responsive container-fluid">
        <table class="table" id="table" style="background-color: #ff9999;">
            <thead class="card-header border border-light" style="background-color: #fff; color:teal;text-align:center;">
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
                @if(($p->estado)=="2")
                <tr class="border border-light" style="background-color: #fff; color:teal;text-align:center;">
                    <th scope="col">{{$p->mesa}}</th>
                    <td scope="col">{{$p->nombreCliente}}</td>
                    <td></td>
                         <td></td>
                         @foreach($p->detalle as $d)
                         <td scope="col">{{$d->producto_id}}</td>
                         <td scope="col">{{$d->cantidad}}</td>
                         @endforeach
                    <td><input disabled type="checkbox" name="term" {{ old('term') ?: 'checked' }} data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$p->id}}"
                    style="background:#ffffff; width:20px; height:20px;"></input></td>
                    <td></td>
                </tr>
                @endif
                @empty
                <tr>
                    <td colspan="7" style="text-align: center;color:white;">No hay pedidos terminados</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
        </div>
 @endsection