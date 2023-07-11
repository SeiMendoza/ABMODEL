@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalles de la reservación realizada')
@section('miga')
<li class="breadcrumb-item text-sm">  
    <a class="opacity-5 text-white" href="{{route('cliente.reservaLocal')}}">Eventos Realizados</a></li>
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
    .titulo{
        width: 25%;
        font-size: 17px;
        height: 30px;
        line-height: 30px;
        color:rgba(111, 143, 175);
    }
    .informacion{
        width: 20%;
        height: 30px;
        font-size: 17px;
        line-height: 30px;
    }
</style>

<div class="wrapper wrapper--w960">
    <div class="row d-flex justify-content-center">
         <div class="card shadow items-center" style="margin: 0">
            <div class="card-body">
                <table class="table" >
                    <thead style="background-color: rgba(111, 143, 175, 0.600)">
                        <tr>
                            <td class="informacion"></td>
                            <td class="text-white"><strong>Datos</strong></td>
                            <td class="informacion"></td>
                            <td class="text-white"><strong>Información</strong></td>
                            <td class="informacion"></td>
                        </tr>
                    </thead>

                    <tbody>
                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Cliente</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$reservar->Nombre_Cliente}} {{$reservar->Apellido_Cliente}}</td>
                            <td class="informacion"></td>
                        </tr>
                    
                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Celular</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$reservar->Contacto}} </td>
                            <td class="informacion"></td>
                        </tr>

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Tipo de reservación</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$reservar->Tipo_Reservacion}} </td>
                            <td class="informacion"></td>
                        </tr>

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Evento</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$reservar->Tipo_Evento}} </td>
                            <td class="informacion"></td>
                        </tr>

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Cantidad de personas</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$reservar->Cantidad}} </td>
                            <td class="informacion"></td>
                        </tr>

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Fecha</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{\Carbon\Carbon::parse($reservar->Fecha)->locale("es")->isoFormat("DD MMMM YYYY")}}</td>
                            <td class="informacion"></td>
                        </tr>

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Hora de llegada</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$reservar->HoraEntrada}} </td>
                            <td class="informacion"></td>
                        </tr>

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Hora de salida</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$reservar->HoraSalida}} </td>
                            <td class="informacion"></td>
                        </tr>

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Forma de pago</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$reservar->FormaPago}} </td>
                            <td class="informacion"></td>
                        </tr>

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Costo de la reservación</td>
                            <td class="informacion"></td>
                            <td class="titulo">L {{ number_format($reservar->Total, 2, '.', ',') }}</td>
                            <td class="informacion"></td>
                        </tr>

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Anticipo</td>
                            <td class="informacion"></td>
                            <td class="titulo">L {{ number_format($reservar->Anticipo, 2, '.', ',') }}</td>
                            <td class="informacion"></td>
                        </tr>

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Saldo pendiente</td>
                            <td class="informacion"></td>
                            <td class="titulo">L {{ number_format($reservar->Pendiente, 2, '.', ',') }}</td>
                            <td class="informacion"></td>
                        </tr>

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Estado</td>
                            <td class="informacion"></td>
                            <td class="titulo">Cancelado</td>
                            <td class="informacion"></td>
                        </tr>
                    </tbody>
                </table>

                <div style="background-color: rgba(111, 143, 175, 0.600);text-align:center; font-size:17px">
                    <a href="{{route('realizadas.realizadas')}}" class="text-white " 
                     style=" width:915px; " ><strong>Regresar</strong></a>
                </div>

            </div>  
        </div>
    </div>
@stop
