@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalle Piscina-productos')
@section('miga')
<li class="breadcrumb-item opacity-5 text-sm text-white" aria-current="page">
    <a class="text-white" href="{{route('prodpiscina.index')}}">Productos Piscina</a>
</li>
<li class="breadcrumb-item text-sm text-white" aria-current="page">
    <a class="text-white">Detalles</a>
</li>
@endsection

@section('b')
<div>
    <a href="{{route('prodpiscina.index')}}" style="margin:0; padding:5px; width:150px;" type="button" class="bg-light border-radius-sm text-center"> Regresar
    </a>
</div>
@endsection

@section('content')


<style>
    .titulo {
        width: 20%;
        font-weight: bold;
        height: 40%;
        line-height: 190%;
    }

    .informacion {
        width: 20%;
        height: 40%;
        line-height: 190%;
    }
</style>
<div class="mb-0 col-12 text-start" style="position:absolute;top:0.2%;width:82%;">

    <table class="table" style="position: absolute;top:100%;width:100%;height:100%;">

        <h5 class="card text-lg" style="text-align:center; background:rgb(126, 123, 126); color:#fff;">
            Detalles del producto de piscina: {{$piscina->nombre}}</h5>
        <tbody>
            <tr>
                <td class="titulo"></td>
                <td class="informacion"></td>
                <td class="titulo">Tipo de producto: </td>
                <td class="informacion">{{$piscina->tipo_producto->descripcion}}</td>
                <td class="titulo"></td>
                <td class="informacion"></td>
            </tr>
            <tr>
                <td class="titulo"></td>
                <td class="informacion"></td>
                <td class="titulo">Peso:</td>
                <td class="informacion">{{$piscina->peso}} @if ($piscina->tipo_producto->id == 1) Libras @else Onzas @endif</td>
                <td class="informacion"></td>
                <td class="informacion"></td>
            </tr>
            <tr>
                <td class="titulo"></td>
                <td class="informacion"></td>
                <td class="titulo">Uso: </td>
                <td class="informacion">{{$piscina->uso_piscina->descripcion}}</td>
                <td class="titulo"></td>
                <td class="informacion"></td>
            </tr>
        </tbody>
    </table>

</div>
@stop