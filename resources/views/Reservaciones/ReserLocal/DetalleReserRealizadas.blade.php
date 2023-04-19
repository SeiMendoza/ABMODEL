@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalles de la reservación')
@section('miga')
    <li class="breadcrumb-item text-sm">
        <a class="opacity-5 text-white" href="">Reservaciones del Local</a></li>
    <li class="breadcrumb-item text-sm">
        <a class="opacity-5 text-white" href="{{route('realizadas.realizadas')}}">Eventos Realizados</a></li>    
<li class="breadcrumb-item text-sm text-white active m-0" aria-current="page" >Detalles</li>
@endsection
@section('miga')
<li class="breadcrumb-item text-sm text-dark" aria-current="page">  
    <a class="opacity-5 text-dark" href="{{route('cliente.reservaLocal')}}">Eventos Realizados</a></li>
<li class="breadcrumb-item text-sm"><a class=" text-dark">Detalles Reservación</a></li>
@endsection

@section('content')
<style>
    .titulo{
        width: 25%;
        font-size: 17px;
        height: 30px;
        line-height: 30px;
    }

    
    .informacion{
        width: 20%;
        height: 30px;
        font-size: 17px;
        line-height: 30px;
    }
</style>

<div class="wrapper wrapper--w960">
    <div >
         <div class="card shadow items-center"> <BR>
            <h3 class=" font-weight-bold" style="color: teal; text-align:center; text-transform: uppercase"> 
                Reservación realizada de: {{$reservar->Nombre_Cliente}} </h3>
            <div class="card-body">
                <table class="table" >
                    <thead style="background-color: rgba(81, 255, 0, 0.182)">
                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo"><strong>Datos</strong></td>
                            <td class="informacion"></td>
                            <td class="titulo"><strong>Información</strong></td>
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
                            <td class="titulo">L 0.00</td>
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

                <div style="background-color: rgba(81, 255, 0, 0.182);text-align:center; font-size:16px">
                    <a href="{{route('realizadas.realizadas')}}" class=" " 
                     style=" width:915px; " ><strong>Regresar</strong></a>
                </div>

            </div>  
        </div>
    </div>
@stop
