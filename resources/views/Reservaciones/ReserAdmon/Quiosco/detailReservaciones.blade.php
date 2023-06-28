@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalles de la reservación')
@section('miga')
<li class="breadcrumb-item text-sm " aria-current="page">  
    <a class="opacity-5 text-white" href="{{route('kiosko_res.index')}}">Reservacines de Kioskos</a></li>
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
    <div class="row d-flex justify-content-center" >
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
                            <td class="titulo">{{$reservacion->nombreCliente}}</td>
                            <td class="informacion"></td>
                        </tr>
                    
                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Celular</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$reservacion->celular}} </td>
                            <td class="informacion"></td>
                        </tr>

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Fecha</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{\Carbon\Carbon::parse($reservacion->fecha)->locale("es")->isoFormat("DD MMMM YYYY")}}</td>
                            <td class="informacion"></td>
                        </tr>

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Hora Inicio</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$reservacion->horaI}} </td>
                            <td class="informacion"></td>
                        </tr>

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Hora Final</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$reservacion->horaF}} </td>
                            <td class="informacion"></td>
                        </tr>

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Tipo</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$reservacion->tipo}} </td>
                            <td class="informacion"></td>
                        </tr> 

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Cantidad Adultos</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$reservacion->cantidadAdultos }} </td>
                            <td class="informacion"></td>
                        </tr> 
                        
                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Precio Adultos</td>
                            <td class="informacion"></td>
                            <td class="titulo">L {{ number_format($reservacion->precioAdultos, 2, '.', ',') }} </td>
                            <td class="informacion"></td>
                        </tr>

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Cantidad Niños</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$reservacion->cantidadNinios}} </td>
                            <td class="informacion"></td>
                        </tr> 

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Precio Niños</td>
                            <td class="informacion"></td>
                            <td class="titulo">L {{ number_format($reservacion->precioNinios, 2, '.', ',') }} </td>
                            <td class="informacion"></td>
                        </tr> 

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Total</td>
                            <td class="informacion"></td>
                            @php
                                $total = $reservacion->precioNinios * $reservacion->cantidadNinios +
                                $reservacion->precioAdultos * $reservacion->cantidadAdultos;
                            @endphp
                            <td class="titulo"> L {{ number_format($total, 2, '.', ',') }}  </td>
                            <td class="informacion"></td>
                        </tr> 

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Anticipo</td>
                            <td class="informacion"></td>
                            <td class="titulo">L {{ number_format($reservacion->anticipo, 2, '.', ',') }} </td>
                            <td class="informacion"></td>
                        </tr> 

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Pendiente</td>
                            <td class="informacion"></td>
                            <td class="titulo">L {{ number_format($total - $reservacion->anticipo, 2, '.', ',') }}  </td>
                            <td class="informacion"></td>
                        </tr> 

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Forma de pago</td>
                            <td class="informacion"></td>
                            <td class="titulo">
                            @if ($reservacion->formaPago === 1)
                                Efectivo
                            @else
                                Transferencia
                            @endif </td>
                            <td class="informacion"></td>
                        </tr> 

                    </tbody>
                </table>

                <div style="text-align:center; font-size:16px">
                    <a href="{{route('kiosko_res.index')}}" class="btn" 
                     style="background-color: rgba(111, 143, 175, 0.600);" ><strong>Regresar</strong></a>
                </div>

            </div>  
        </div>
    </div>
@stop