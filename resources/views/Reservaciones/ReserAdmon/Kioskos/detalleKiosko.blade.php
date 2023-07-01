@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalle de Kiosko')
@section('miga')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="{{route('kiosko.index')}}">Administración de Kioskos</a></li>
<li class="breadcrumb-item text-sm active text-white active">Detalle</li>
@endsection
@section('tit', 'Detalle de kiosko')
@section('b')
<div>
    <a href="{{ route('kiosko.index') }}" style="margin:0; padding:5px; width:160px;" type="button" class="bg-light border-radius-sm text-center ">
        <i class="fa fa-arrow-left"></i>  Regresar
    </a>
</div>
@endsection
@section('content')

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
                            <td class="titulo">Codigo</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$kiosko->codigo}}</td>
                            <td class="informacion"></td>
                        </tr>
                    
                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Descripción</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{$kiosko->descripcion}} </td>
                            <td class="informacion"></td>
                        </tr>

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Disponible</td>
                            <td class="informacion"></td>
                            <td class="titulo">{{ $kiosko->disponible }} </td>
                            <td class="informacion"></td>
                        </tr> 

                        <tr>
                            <td class="informacion"></td>
                            <td class="titulo">Mesas Contenidas</td>
                            <td class="informacion"></td>
                            <td class="titulo">
                                @forelse ($mesas as $m)
                                <a href="{{ route('mesas_reg.edit', ['id' => $m->id]) }}">{{ $m->nombre }}, </a> 
                                @empty
                            
                                @endforelse </td>
                            <td class="informacion"></td>
                        </tr>       

                    </tbody>
                </table>
            </div>  
        </div>
    </div>
</div>

@endsection