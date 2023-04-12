@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalle de caja')
@section('content')


<style>
    .titulo{
        width: 20%;
        font-weight: bold;
        height: 60px;
        line-height: 50px;
    }
    .informacion{
        width: 20%;
        height: 60px;
        line-height: 50px;
    }
</style>
<div class="mb-0 col-11 text-start">

    <div class="row text-center container pt-6">
<h5 class="card class-4 text-lg text-center" style="background:rgb(255,179,71); color:#fff;
      position: relative;">Detalle de pedidos pendientes en caja de: {{$pedido->nombreCliente}}</h5>
            
    </div>


<table class="table">
    <tr>
        <td class="titulo">Numero de mesa: </td>
        <td class="informacion">{{$pedido->mesa_nombre->nombre}}</td>
        <td class="titulo">Quisco:</td>
        <td class="informacion">{{$pedido->quiosco}}</td>
    </tr>
    <tr>
        <td class="titulo">Nombre del cliente: </td>
        <td class="informacion">{{$pedido->nombreCliente}}</td>
        <td class="titulo">Estado:</td>
        <td class="informacion">
        @if ($pedido->estado_cocina == 1)
                    Procesando
                    @elseif($pedido->estado_cocina == 2 || $pedido->estado==2)
                     Entregar 
                    @else
                    Enviar
                      
                        @endif
           <!--- @if ($pedido->estado == 0)
                Pendiente en cocina
            @else
                @if ($pedido->estado == 1)
                    Pendiente en caja
                @else
                    Terminado
                @endif  
            @endif ---->
        </td>
    </tr>
    <script>
        setInterval(() => {
            var creacion = new Date('{{$pedido->updated_at}}')
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
        <?php $diferencia = $pedido->created_at->diff($pedido->updated_at)?>
        <td class="titulo">Hora del pedido: </td>
        <td class="informacion">{{date('h:i:s a',strtotime($pedido->created_at))}}</td>
        <td class="titulo">Tiempo transcurrido en cocina:</td>
        <td class="informacion">   
            @if ($diferencia->format('%H')!=0)
                @if ($diferencia->format('%H')==1)
                    {{$diferencia->format('%H hora %i minutos %s segundos')}}
                @else
                    {{$diferencia->format('%H horas %i minutos %s segundos')}}
                @endif
            @else
                {{$diferencia->format('%i minutos %s segundos')}}
            @endif
        </td>
    </tr>
    <tr>
        <td class="titulo">Hora del finalizado en cocina: </td>
        <td class="informacion">{{date('h:i:s a',strtotime($pedido->updated_at))}}</td>
        <td class="titulo">Tiempo transcurrido en caja:</td>
        <td class="informacion" id="tiempo"></td>
    </tr>
    <tr>
        <td class="titulo">Impuesto: </td>
        <td class="informacion">L. {{number_format($pedido->imp, 2, '.', ',')}}</td>
        <td class="titulo">Total:</td>
        <td class="informacion">L. {{number_format($pedido->total, 2, '.', ',')}}</td>
    </tr>
</table>

<a href="{{route('pedidos.caja')}}" class="btn btn-danger" type="buttom" style="float: right;">Regresar</a>

@stop