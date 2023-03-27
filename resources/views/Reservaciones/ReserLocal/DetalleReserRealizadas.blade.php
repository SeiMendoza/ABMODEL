@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalles de la reservación')
@section('miga')
<li class="breadcrumb-item text-sm text-dark" aria-current="page">  
    <a class="opacity-5 text-dark" href="{{route('cliente.reservaLocal')}}">Reservación del Local</a></li>
<li class="breadcrumb-item text-sm"><a class=" text-dark">Detalles Reservación</a></li>
@endsection


@section('content')
<style>
    .title{
        width: 25%;
        font-weight: bold;
        height: 50px;
        line-height: 60px;
    }
    .info{
        width: 30%;
        height: 50px;
        line-height: 60px;
        color:rgb(98, 177, 154);
    }
</style>



<div class="card shadow mb-4 " style="margin-right:20px; margin-left:25px">
    <div class="card-header" style="background: #3c9a716f; border-radius:6px 6px 0 0;">
        <div style="text-align:center">
            <h4 class="m-0 font-weight-bold" style="color: white"> Información detallada de la reservación de:      {{$reservar->Nombre_Cliente}}</h4>
        </div>
    </div>
    
         <div class="container">
            <div class="m-0 font-weight-bold">
            <table class="table">
                <tr>
                    <td class="title">NOMBRE: </td>
                    <td class="info">{{$reservar->Nombre_Cliente}}</td>
                    <td class="title">APELLIDO: </td>
                    <td class="info">{{$reservar->Apellido_Cliente}}</td>
                </tr>

                <tr>
                    <td class="title">CELULAR:</td>
                    <td class="info">{{$reservar->Contacto}}</td>
                    <td class="title">TIPO DE RESERVACIÓN:</td>
                    <td class="info">{{$reservar->Tipo_Reservacion}}</td>
                </tr>

                <tr>
                    <td class="title">TIPO DE EVENTO: </td>
                    <td class="info">{{$reservar->Tipo_Evento}}</td>
                    <td class="title">FECHA DEL EVENTO:</td>
                    <td class="info">{{$reservar->Fecha}}</td>
                </tr>

                <tr>
                    <td class="title">HORA DE LLEGADA: </td>
                    <td class="info">{{$reservar->Hora}}</td>
                    <td class="title">FORMA DE PAGO:</td>
                    <td class="info">{{$reservar->FormaPago}}</td>
                </tr>

                <tr>
                    <td class="title">PRECIOS DE ENTRADA: </td>
                    <td class="info">{{$reservar->PrecioEntrada}}</td>
                    <td class="title">CANTIDAD DE PERSONAS: </td>
                    <td class="info">{{$reservar->Cantidad}} </td>
                </tr>

                <tr>
                    <td class="title">COSTO DE LA RESERVACIÓN:</td>
                    <td class="info">{{$reservar->Total}}</td>
                    <td class="title">CANTIDAD ANTICIPADA: </td>
                    <td class="info">{{$reservar->Anticipo}} </td>
                </tr>

                <tr>
                    <td class="title">SALDO PENDIENTE:</td>
                    <td class="info">{{$reservar->Pendiente}}</td>
                    <td>
                    <div style=""><br>
                        <a href="{{route('realizadas.realizadas')}}" class="btn btn-danger" type="buttom" 
                         style="float: right; width:180px; padding:10px;" >Regresar</a>
                    </div>
                    </td>
                </tr>
            </table>
        </div> 
    </div>
@endsection