@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Reservacion-Local')
@section('b')
<h3 class="font-weight-bolder opacity-8  text-gray mb-0" style="position: absolute; top:130%; margin-left:15px ">Reservaciones del Local</h3> 
    <div class="" style="position:absolute; right:0%; top:16%"> 
        <a href="{{route('ReserLocal.create')}}"  class="bg-light border-0 border-radius-sm h-6 text-center text-gray font-weight-bolder" style="margin:0;width:200px; padding:6px;">
            <i class="fa fa-plus-circle"></i> Agregar</a>

        <a href="{{route('realizadas.realizadas')}}" class="bg-light border-0 border-radius-sm h-6 text-center text-gray font-weight-bolder" style="margin:0;width:300px; padding:6px;">
        <i class="ni ni-laptop"></i> Eventos Realizados</a>

    </div>
@endsection

@section('content')
<div class="table-responsive">
    <table class="table" id="example">
        <thead style="">
            <tr>
                <th scope="col" style="">N°</th>
                <th scope="col" style="text-align: left;  ">Cliente</th>
                <th scope="col" style="text-align: right;width:15% ">Fecha</th>
                <th scope="col" style="text-align: right; width:12%  ">Total</th>
                <th scope="col" style="text-align: right; ">Pendiente</th>
                <th scope="col" style="text-align: center; ">Realizado</th>
                <th scope="col" style="text-align: center;">Detalles</th>
                <th scope="col" style="text-align: center; width:12% ">Editar</th>
            </tr>
        </thead>

        <tbody>
            @forelse($reservacion as $m => $r)
            @if(($r->estado)=="0") 
            <tr>
                <th scope="col" style="  ">{{++$m}}</th>
                <td scope="col" style="text-align: left;">{{$r->Nombre_Cliente}} </td>
                <td scope="col" style="text-align: right;">{{ \Carbon\Carbon::parse($r->Fecha)->isoFormat('DD') }} de
                    {{ \Carbon\Carbon::parse($r->Fecha)->isoFormat('MMMM') }},
                    {{ \Carbon\Carbon::parse($r->Fecha)->isoFormat('YYYY') }}</td> 
                <td scope="col" style="text-align: right;">{{$r->Total}}</td>
                <td scope="col" style="text-align: right;">{{$r->Pendiente}}</td>
                <td scope="col" style="text-align: center;"><input type="checkbox" id="list" name="list" {{!old('list') ?: 'checked'}} data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$r->id}}" style="background:teal; width:15px; height:15px;">
                   <div class="modal fade" id="staticBackdrop{{$r->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                       <div class="modal-dialog">
                           <div class="modal-content">
                                <div class="modal-header">
                                    <h1 class="modal-title fs-5" id="staticBackdropLabel">Reservación Realizada</h1>
                                   <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                               </div>
                               <div class="modal-body" style="color:teal">
                                 <p>¿Está seguro que el evento de <strong>{{$r->Nombre_Cliente}}</strong> ya se realizó?</p>
                               </div>
                               <div class="modal-footer">
                                   <form action="{{route('reservacionRealizada', ['id'=>$r->id])}}" method="POST">
                                       @method('put')
                                       @csrf
                                       <div style="display: none">
                                           <input type="text" id="estado" name="estado" value="1">
                                       </div>
                                       <button type="submit" class="btn btn-danger" data-bs-dismiss="modal">Sí</button>
                                       <button onclick="setTimeout(function(){location.reload();}, 00);" type="button" class="btn btn-success" data-bs-dismiss="modal">No</button>
                                   </div>
                               </form>
                           </div>
                       </div>
                   </div>
               </td>
                
                <td scope="col" style="text-align: center;"><a type="buttom" class="ni ni-light" href="{{ route('detalle.reservacion', ['id'=>$r->id]) }}">
                       <i class="ni ni-single-copy-04 text-pink text-sm opacity-8"></i>
                   </a> 
                </td>
                <td style="text-align: center;"><a href="{{ route('ResCliente.editar', ['id'=>$r->id]) }}"><i class="fa fa-edit text-success"></i></a> </td>
            </tr>
            @endif

            @empty
            @endforelse
        </tbody>
    </table>

</div>
@endsection