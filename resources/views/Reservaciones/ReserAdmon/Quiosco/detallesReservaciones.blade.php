@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalles de la reservación')
@section('miga')
<li class="breadcrumb-item text-sm " aria-current="page">  
    <a class="opacity-5 text-white" href="{{route('kiosko_res.index')}}">Reservacines de Kioskos</a></li>
    <li class="breadcrumb-item text-sm " aria-current="page">  
        <a class="opacity-5 text-white" href="{{route('kiosko_res_t.index')}}">Reservaciones Terminadas</a></li>
<li class="breadcrumb-item text-sm"><a class="text-white ">Detalles de la reservación </a></li>
@endsection

@section('tit', "Detalles de la reservación") 
@section('b')
    <div class="" style="">    
        <a href="{{route('kiosko_res.index')}}" style="margin:0; padding:5px; width:150px; font-size:15px" type="button" 
        class="bg-light border-radius-sm text-center">
        <i class="fa fa-arrow-left"></i> Regresar
       </a> 
    </div>
@endsection

@section('content')
<style>
    .data-value{
        font-size: 15px;
        color: rgba(111, 143, 175);
    }
 
    .data-label{
        font-size: 15px;
        color: rgb(111, 143, 175);
    }

</style>

<div class="wrapper wrapper--w960" >
    <div class="card">
        <div class="card-body">

            <h4 class="font-robo t" style="margin: 0; padding:0">Datos del cliente: </h4>
                <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
    
                <div class="row row-spacer">
                    <div class="col-md-8">
                        <label class="data-label">Nombre:</label>
                        <span class="data-value">{{$reservacion->nombreCliente}}</span>
                    </div>
    
                    <div class="col-md-4">
                        <label class="data-label">Celular:</label>
                        <span class="data-value">{{$reservacion->celular}}</span>
                    </div>
                </div>

                <h4 class="font-robo t" style="margin-top: 1%;">Datos de la reservación:</h4>
                <hr class="m-1" style="border: 0.1px solid rgba(111, 143, 175, 0.600)">
    
                <div class="row row-spacer">
                    <div class="col-md-4">
                        <label class="data-label">Tipo:</label>
                        <span class="data-value">{{$reservacion->tipo}} </span>
                    </div>
    
                    <div class="col-md-4"  >
                        <label class="data-label"> Fecha: </label>
                        <span class="data-value">{{\Carbon\Carbon::parse($reservacion->fecha)->locale("es")->isoFormat("DD MMMM YYYY")}}</span>
                    </div>

                    <div class="col-md-4"  >
                        <label class="data-label"> Hora inicio: </label>
                        <span class="data-value">{{$reservacion->horaI}}</span>
                    </div> 
                </div>

                <div class="row row-spacer" >
                    <div class=" col-md-4"  >
                        <label class="data-label"> Hora final: </label>
                        <span class="data-value">{{$reservacion->horaF}}</span>
                    </div>

                    <div class=" col-md-4"  >
                        <label class="data-label"> Estado: </label>
                        <span class="data-value">
                            @if ($reservacion->Estado == 1)
                               Reservación pendiente
                            @else
                               Reservación terminada
                            @endif
                        </span>
                    </div>
                </div>
    
                <h4 class="font-robo t" style="margin-top: 1%;">Costo de la reservación: </h4>
                <hr class="m-1" style="border: 0.1px solid rgba(111, 143, 175, 0.600)">

                <div class="row row-spacer" >
                    <div class=" col-md-4"  >
                        <label class="data-label"> Cantidad adultos: </label>
                        <span class="data-value">{{$reservacion->cantidadAdultos }}</span>
                    </div>

                    <div class=" col-md-4"  >
                        <label class="data-label"> Precio adultos: </label>
                        <span class="data-value">L {{ number_format($reservacion->precioAdultos, 2, '.', ',') }}</span>
                    </div> 

                    <div class=" col-md-4"  >
                        <label class="data-label"> Cantidad niños: </label>
                        <span class="data-value">{{$reservacion->cantidadNinios}}</span>
                    </div> 
                </div>

                <div class="row row-spacer" >
                    <div class=" col-md-4"  >
                        <label class="data-label"> Precio niños: </label>
                        <span class="data-value">L {{ number_format($reservacion->precioNinios, 2, '.', ',') }} </span>
                    </div>

                    <div class=" col-md-4"  >
                        <label class="data-label"> Total: </label>
                        @php
                            $total = $reservacion->precioNinios * $reservacion->cantidadNinios +
                            $reservacion->precioAdultos * $reservacion->cantidadAdultos;
                        @endphp
                        <span class="data-value">L {{ number_format($total, 2, '.', ',') }}</span>
                    </div> 

                    <div class=" col-md-4"  >
                        <label class="data-label"> Anticipo: </label>
                        <span class="data-value">L {{ number_format($reservacion->anticipo, 2, '.', ',') }} </span>
                    </div> 
                </div>

                <div class="row row-spacer" >
                    <div class=" col-md-4"  >
                        <label class="data-label"> Pendiente: </label>
                        <span class="data-value">L 0.00</span>
                    </div> 
                    
                    <div class=" col-md-4"  >   
                        <label class="data-label"> Forma de pago: </label>
                        <span class="data-value">
                            @if ($reservacion->formaPago === 1)
                                Efectivo
                            @else
                                Transferencia
                            @endif
                        </span>
                    </div>
                </div>

                <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600); margin-top: 10px;">
    
                <div class="d-flex justify-content-end mt-2">
                    <a href="{{route('kiosko_res_t.index')}}" class="btn btn-secondary"><strong>Regresar</strong></a>
                </div>
            </div>
        </div>
    </div>
@stop

<!--<td class="informacion"></td>
<td class="titulo">Total</td>
<td class="informacion"></td>
@php
    $total = $reservacion->precioNinios * $reservacion->cantidadNinios +
    $reservacion->precioAdultos * $reservacion->cantidadAdultos;
@endphp
<td class="titulo"> L {{ number_format($total, 2, '.', ',') }}  </td>
<td class="informacion"></td>-->                        
                        