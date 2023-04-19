@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Pedidos-terminados')
@section('miga')
<li class="breadcrumb-item opacity-5 text-sm text-white" aria-current="page">
    <a class="text-white" href="{{route('pedidos.caja')}}">Caja</a>
</li>
<li class="breadcrumb-item text-sm text-white" aria-current="page">
    <a class="text-white">Pedidos terminados </a>
</li>
@endsection
@section('tit','Pedidos terminados')
@section('b')
 <div class=""> 
    <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalCenter" style="margin:0; padding:5px; width:150px;" 
    type="button" class="bg-light border-radius-sm text-center">
        <i class="fa-solid fa-trash-can text-danger"></i> Eliminar pedidos
    </a> 
</div>
<!----<div class="" style="position:absolute; right:0%; top:16%">    
<a href="#" type="button" class="bg-light border-radius-md h-6 text-center text-success" 
                style="width:200px; padding:6px;" data-bs-toggle="modal" 
                data-bs-target="#exampleModalCenter">
                <i class="fa-solid fa-trash-can text-danger"></i> <strong>Eliminar pedidos</strong></a>
    </div>---->

@endsection
@section('content')
<div class="table-responsive">
    <table class="table" id="example">
        <thead>
            <tr>
                <th scope="col" style="text-align:center">N</th>
                <th scope="col" style="text-align:center">Número de mesa</th>
                <th scope="col" style="text-align:center">Kiosko</th>
                <th scope="col" style="text-align:center">Nombre del cliente</th>
                <th scope="col" style="text-align:center">Terminado</th>
                <th scope="col" style="text-align:center">Detalles</th>
            </tr>
        </thead>
        <tbody>
            @forelse($pedido as $i => $p)
            @if(($p->estado)=="3")
            <tr class="" style="text-align:center;">
                <td scope="col">{{++$i}}</td>
                <td scope="col">{{$p->mesa_nombre->nombre}}</td>
                <td scope="col">{{$p->quiosco}}</td>
                <td scope="col">{{$p->nombreCliente}}</td>
                <td>
                    @if($p->estado == 3)
                    Entregado al cliente
                    @endif
                </td>
                <td>
                    <a type="button" href="{{route('terminados.detalle',['id'=>$p->id])}}">
                        <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
                    </a>
                </td>
            </tr>
            @endif
            @empty
            @endforelse
        </tbody>
    </table>
    <!----<a class="btn btn-danger" href="{{route('pedidos.caja')}}">Volver</a>----->
</div>
</div>
<!-- Modal Eliminar-->
<form action="{{route('borrar.borrarDatos')}}" method="post" enctype="multipart/form-data">
    @method('delete')
    @csrf
    <div class="modal fade" id="exampleModalCenter" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
        <div class="modal-dialog modal-lg-centered">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 style="text-color:red;" class="modal-title" id="exampleModalLongTitle">Eliminar Pedidos</h4>
                </div>
                <div class="modal-body">
                    ¿Está seguro de eliminar los pedidos entregados?
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-danger">SÍ</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                </div>
            </div>
        </div>
</form>

@endsection