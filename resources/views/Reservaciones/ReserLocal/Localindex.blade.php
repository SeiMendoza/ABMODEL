@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Reservacion-Local')
@section('miga')
<li class="breadcrumb-item text-sm text-white active m-0" aria-current="page">Reservaciones del Local</li>
@endsection
@section('tit','Reservaciones del Local')
@section('b')
    <div class="" style="">    
        <a href="{{route('ReserLocal.create')}}" style="margin:0; padding:5px; width:150px; font-size:15px" type="button" 
           class="bg-light border-radius-sm text-center">
             <i class="fa fa-plus-circle"></i> Agregar
         </a> 

         <a href="{{route('realizadas.realizadas')}}" style="margin:0; padding:5px; width:200px; font-size:15px" type="button" 
           class="bg-light border-radius-sm text-center">
             <i class="ni ni-laptop"></i> Eventos Realizados
         </a> 
    </div>
@endsection

@section('content')
<div class="table-responsive" style="">
    <table class="table" id="example" style="">
        <thead style="">
            <tr>
                <th scope="col" style="text-align:center;" >N</th>
                <th scope="col" style="text-align: left;  ">Cliente</th>
                <th scope="col" style="text-align: right; ">Celular</th>
                <th scope="col" style="text-align: right;width:15% ">Fecha</th>
                <th scope="col" style="text-align: right; width:12%  ">Total</th>
                <th scope="col" style="text-align: right; ">Pendiente</th>
                <th scope="col" style="text-align: center; ">Realizado</th>
                <th scope="col" style="text-align: center;">Detalles</th>
                <th scope="col" style="text-align: center; width:10% ">Editar</th>
            </tr>
        </thead>

        <tbody>
            @forelse($reservacion as $m => $r)
            @if(($r->estado)=="0") 
            <tr style=" height:46px">
                <td scope="col" style="  text-align: center">{{++$m}}</td>
                <td scope="col" style="text-align: left;">{{$r->Nombre_Cliente}} </td>
                <td scope="col" style="text-align: right;">{{$r->Contacto}}</td>
                <td scope="col" style="text-align: right;">{{ \Carbon\Carbon::parse($r->Fecha)->isoFormat('DD') }} de
                    {{ \Carbon\Carbon::parse($r->Fecha)->isoFormat('MMMM') }},
                    {{ \Carbon\Carbon::parse($r->Fecha)->isoFormat('YYYY') }}</td> 
                <td scope="col" style="text-align: right;">L {{ number_format($r->Total, 2, '.', ',') }}</td>
                <td scope="col" style="text-align: right;">L {{ number_format($r->Pendiente, 2, '.', ',') }}</td>
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
                
                <td scope="col" style="text-align: center;"><a type="buttom" href="{{ route('detalle.reservacion', ['id'=>$r->id]) }}">
                       <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
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