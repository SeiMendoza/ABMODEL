@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalles de la reservación')
@section('miga')
<li class="breadcrumb-item text-sm text-dark" aria-current="page">  
    <a class="opacity-5 text-dark" href="{{route('kiosko_res.index')}}">Reservación del Kiosko</a></li>
<li class="breadcrumb-item text-sm"><a class=" text-dark">Detalles </a></li>
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
    <div class="row d-flex justify-content-center">
         <div class="card shadow items-center"> <BR><BR>
            <h3 class=" font-weight-bold" style="color: teal; text-align:center"> 
                Detalles de la reservación de: {{$reservacion->nombre}} </h3>
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
                            <td class="titulo">{{$reservacion->nombre}}</td>
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
                            <td class="titulo">Hora</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$reservacion->hora}} </td>
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
                            <td class="titulo">Cantidad</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$reservacion->cantidad}} </td>
                            <td class="informacion"></td>
                        </tr> 

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Precio</td>
                            <td class="informacion"></td>
                            <td class="titulo">L {{ number_format($reservacion->precio, 2, '.', ',') }} </td>
                            <td class="informacion"></td>
                        </tr> 

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Total</td>
                            <td class="informacion"></td>
                            <td class="titulo"> L {{ number_format($reservacion->total, 2, '.', ',') }}  </td>
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
                            <td class="titulo">L {{ number_format($reservacion->pendiente, 2, '.', ',') }}  </td>
                            <td class="informacion"></td>
                        </tr> 

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Forma de pago</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$reservacion->formaPago}} </td>
                            <td class="informacion"></td>
                        </tr> 

                    </tbody>
                </table>

                <div style="background-color: rgba(81, 255, 0, 0.182);text-align:center; font-size:16px">
                    <a href="{{route('kiosko_res.index')}}" class=" " 
                     style=" width:915px; " ><strong>Regresar</strong></a>
                </div>

            </div>  
        </div>
    </div>
@stop