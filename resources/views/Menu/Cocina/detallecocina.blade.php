@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalle de cocina')
@section('miga')
<li class="breadcrumb-item opacity-5 text-sm text-dark" aria-current="page">
    <a class="text-dark" href="{{route('pedidosp.pedido')}}">Caja</a>
</li>
<li class="breadcrumb-item text-sm text-dark" aria-current="page">
    <a class="text-dark">Detalles</a>
</li>
@endsection
@section('content')

<style>
    .titulo{
        width: 20%;
        font-weight: bold;
        height: 70px;
        line-height: 60px;
    }
    .informacion{
        width: 20%;
        height: 70px;
        line-height: 60px;
    }
</style>
<div class="mb-0 col-12 text-start">
 
<table class="table">
     
<h5 class="card class-4 text-lg text-center" style="text-align:center;background:rgb(255,179,71); color:#fff;
      position: relative;">Detalles del pedido en cocina: {{$pedido->nombreCliente}}</h5>
    <tr>
        <td class="titulo">Número de mesa: </td>
        <td class="informacion">{{$pedido->mesa_nombre->nombre}}</td>
        <td class="titulo">Kiosko:</td>
        <td class="informacion">{{$pedido->quiosco}}</td>
    </tr>
    <tr>
        <td class="titulo">Nombre del cliente: </td>
        <td class="informacion">{{$pedido->nombreCliente}}</td>
        <td class="titulo">Estado:</td>
        <td class="informacion">
            @if ($pedido->estado == 0)
                Pendiente en cocina
            @else
                @if ($pedido->estado == 1)
                    Pendiente en caja
                @else
                    Terminado
                @endif  
            @endif
        </td>
    </tr>
    <script>
        setInterval(() => {
            var creacion = new Date('{{$pedido->created_at}}')
            var actual = new Date();
            var msr = actual - creacion;
            
            var hora =  Math.floor((msr)/1000/60/60);

            msr = msr-(hora*60*60*1000);

            var minuto = Math.floor((msr)/1000/60);
            msr = msr-(minuto*60*1000);

            var segundos =  Math.floor((msr)/1000);

            var texto = '';

            if (hora != 0) {
                if (hora == 1) {
                    texto = hora+' hora '
                } else {
                    texto = hora+' horas '
                }
            }
            
            texto = texto+minuto+' minutos '+segundos+' segundos';
            document.getElementById("tiempo").innerHTML = texto;
        }, 100);
    </script>
    <tr>
        <td class="titulo">Hora del pedido: </td>
        <td class="informacion">{{date('h:i:s a',strtotime($pedido->created_at))}}</td>
        <td class="titulo">Tiempo transcurrido en cocina:</td>
        
        <td class="informacion" id="tiempo">   
        </td>
    </tr>
    <tr>
        <td class="titulo">Impuesto: </td>
        <td class="informacion">L. {{number_format($pedido->imp, 2, '.', ',')}}</td>
        <td class="titulo">Total:</td>
        <td class="informacion">L. {{number_format($pedido->total, 2, '.', ',')}}</td>
    </tr>
</table>

<a href="{{route('pedidosp.pedido')}}" class="btn btn-danger" type="button" style="float: right;">Regresar</a>
@stop