@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalles de la reservación realizada')
@section('miga')
<li class="breadcrumb-item text-sm">  
    <a class="opacity-5 text-white" href="{{route('realizadas.realizadas')}}">Eventos Realizados</a></li>
<li class="breadcrumb-item text-sm text-dark active text-white" aria-current="page">Detalles</li>
@endsection
@section('tit', 'Detalles de la Reservación Realizada ')
@section('b')
<div>
    <a  href="{{route('realizadas.realizadas')}}" style="margin:0; padding:5px; width:160px;" type="button" class="bg-light border-radius-sm text-center ">
        <i class="fa fa-arrow-left"></i>  Regresar
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
                        <span class="data-value">{{ $reservar->Nombre_Cliente}} {{ $reservar->Apellido_Cliente}}</span>
                    </div>
    
                    <div class="col-md-4">
                        <label class="data-label">Celular:</label>
                        <span class="data-value">{{ $reservar->Contacto }}</span>
                    </div>
                </div>

                <h4 class="font-robo t" style="margin-top: 1%;">Datos de la reservación:</h4>
                <hr class="m-1" style="border: 0.1px solid rgba(111, 143, 175, 0.600)">
    
                <div class="row row-spacer">
                    <div class="col-md-4">
                        <label class="data-label">Tipo de reservación:</label>
                        <span class="data-value">{{ $reservar->Tipo_Reservacion}}</span>
                    </div>
    
                    <div class="col-md-4">
                        <label class="data-label">Evento:</label>
                        <span class="data-value">{{ $reservar->Tipo_Evento}}</span>
                    </div>
    
                    <div class="col-md-4">
                        <label class="data-label">Cantidad de personas:</label>
                        <span class="data-value">{{ $reservar->Cantidad }}</span>
                    </div>
                </div>

                <div class="row row-spacer" >
                    <div class="col-md-4"  >
                        <label class="data-label"> Fecha: </label>
                        <span class="data-value">{{\Carbon\Carbon::parse($reservar->Fecha)->locale("es")->isoFormat("DD MMMM YYYY")}}</span>
                    </div>

                    <div class="col-md-4"  >
                        <label class="data-label"> Hora de llegada: </label>
                        <span class="data-value">{{ date('h:i A', strtotime($reservar->HoraEntrada)) }}</span>
                    </div> 

                    <div class=" col-md-4"  >
                        <label class="data-label"> Hora de salida: </label>
                        <span class="data-value">{{ date('h:i A', strtotime($reservar->HoraSalida)) }}</span>
                    </div>
                </div>

                <div class="row row-spacer" >
                    <div class=" col-md-4"  >
                        <label class="data-label"> Estado: </label>
                        <span class="data-value">
                            @if ($reservar->Estado == 1)
                               Pendiente
                            @else
                              Cancelado
                            @endif
                        </span>
                    </div>
                </div>

                <h4 class="font-robo t" style="margin-top: 1%;">Costo de la reservación: </h4>
                <hr class="m-1" style="border: 0.1px solid rgba(111, 143, 175, 0.600)">

                <div class="row row-spacer" >
                    <div class=" col-md-4"  >
                        <label class="data-label"> Forma de pago: </label>
                        <span class="data-value">{{$reservar->FormaPago}}</span>
                    </div>

                    <div class=" col-md-4"  >
                        <label class="data-label"> Total: </label>
                        <span class="data-value">L. {{ number_format($reservar->Total, 2, '.', ',') }}</span>
                    </div> 

                    <div class=" col-md-4"  >
                        <label class="data-label"> Anticipo: </label>
                        <span class="data-value">L. {{ number_format($reservar->Anticipo, 2, '.', ',') }}</span>
                    </div> 
                </div>

                <div class="row row-spacer" >
                    <div class=" col-md-4"  >
                        <label class="data-label"> Saldo Pendiente: </label>
                        <span class="data-value">L. {{ number_format($reservar->Pendiente, 2, '.', ',') }}</span>
                    </div>
                </div>

                <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600); margin-top: 10px;">
    
                <div class="d-flex justify-content-end mt-2">
                    <a href="{{ route('realizadas.realizadas') }}" class="btn btn-secondary"><strong>Regresar</strong></a>
                </div>
            </div>
        </div>
    </div>
@stop
