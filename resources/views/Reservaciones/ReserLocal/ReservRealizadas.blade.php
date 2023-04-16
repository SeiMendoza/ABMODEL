@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Reservaciones Realizadas')

 @section('miga')
    <li class="breadcrumb-item text-sm text-dark" aria-current="page" >
        <a class="text-dark" href="{{route('cliente.reservaLocal')}}">Reservaciones del local</a></li>
@endsection

@section('b')
<h3 class="font-weight-bolder opacity-8  text-gray mb-0" style="position: absolute; top:100%; margin-left:15px">Eventos Realizados</h3> 
<div class="" style="position:absolute; right:0%; top:16%">
    <a href="{{route('cliente.reservaLocal')}}" class="bg-light border-0 border-radius-sm h-6 text-center text-gray font-weight-bolder" style="margin:0;width:400px;padding:6px;">
        <i class="ni ni-palette"></i> Regresar</a>
</div>

@endsection
@section('content')
     <div class="">
         <table class="table" id="example" style="">
             <thead style="">
                 <tr>
                     <th scope="col" style="">N°</th>
                     <th scope="col" style="text-align:  left; ">Cliente</th>
                     <th scope="col" style="text-align: right;width:15% ">Fecha</th>
                     <th scope="col" style="text-align: right;width:11% ">Total</th>
                     <th scope="col" style="text-align: center;">Pendiente</th>
                     <th scope="col" style="text-align: center;">Realizado</th>
                     <th scope="col" style="text-align: center;">Detalles</th>
                     <th scope="col"  style="text-align: center;">Eliminar</th>
                </tr>
             </thead>
                 <tbody>
                     @forelse($reservacion as $m => $r)
                     @if(($r->estado)=="1") 
                     <tr>
                        <th scope="col"  style="">{{++$m}}</th>
                        <td scope="col" style="text-align: left">{{$r->Nombre_Cliente}}</td>
                        <td scope="col" style="text-align: right">{{ \Carbon\Carbon::parse($r->Fecha)->isoFormat('DD') }} de
                            {{ \Carbon\Carbon::parse($r->Fecha)->isoFormat('MMMM') }},
                            {{ \Carbon\Carbon::parse($r->Fecha)->isoFormat('YYYY') }}</td> 
                        <td scope="col" style="text-align: right">{{$r->Total}}</td>
                        <td scope="col" style="text-align: center;">Cancelado</td>
                        <td scope="col" style="text-align: center;"><input disabled type="checkbox" id="list" name="list" {{ old('list') ?: 'checked'}} data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$r->id}}" 
                            style="background:teal; width:15px; height:15px;"> </td>
                         
                         <td scope ="col" style="text-align: center;"><a type="buttom" class="ni ni-light" href="{{ route('detalle.realizadas', ['id'=>$r->id]) }}">
                                <i class="ni ni-single-copy-04 text-pink text-sm opacity-8"></i> </a>
                         </td>

                        <td scope="col" style="text-align: center;">
                            <!-- Button trigger modal eliminar-->
                            <a
                            class="" type="button" data-bs-toggle="modal" 
                            data-bs-target="#exampleModal{{$r->id}}"><i class="fa-solid fa-trash-can text-danger"></i>
                            </a>
                            <!-- Modal Eliminar-->
                            <form action="{{route('cliente.destroy', ['id' => $r->id])}}" method="post" enctype="multipart/form-data">
                                @method('delete')
                                @csrf
                                <div class="modal fade" id="exampleModal{{$r->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" 
                                    aria-labelledby="exampleModalTitle" aria-hidden="true">
                                    <div class="modal-dialog ">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLongTitle"><strong>Eliminar Reservación</strong></h4>
                                        </div>
                                        <div class="modal-body">
                                            ¿Esta seguro de eliminar la reservación de {{$r->Nombre_Cliente}}?             
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-success" data-bs-dismiss="modal">NO</button>
                                        <button type="submit" class="btn btn-danger" >SÍ</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                     </tr>
                     @endif
                     @empty
                     @endforelse
                 </tbody>
            </table>
        </div>
@endsection