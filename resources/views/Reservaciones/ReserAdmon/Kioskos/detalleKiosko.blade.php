@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalle de Kiosko')
@section('miga')
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="{{ route('kiosko.index') }}">Administración de
            Kioskos</a></li>
    <li class="breadcrumb-item text-sm active text-white active">Detalle</li>
@endsection
@section('tit', 'Detalle de kiosko')
@section('b')
    <div>
        <a href="{{ route('kiosko.index') }}" style="margin:0; padding:5px; width:160px;" type="button"
            class="bg-light border-radius-sm text-center ">
            <i class="fa fa-arrow-left"></i> Regresar
        </a>
    </div>
@endsection
@section('content')

    <div class="wrapper wrapper--w960">
        <div class="row d-flex justify-content-center">
            <div class="card shadow items-center" style="margin: 0">
                <div class="card-body">
                    <table class="table">
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
                                <td class="titulo"><strong>Codigo</strong></td>
                                <td class="informacion"></td>
                                <td class="titulo">{{ $kiosko->codigo }}</td>
                                <td class="informacion"></td>
                            </tr>

                            <tr>
                                <td class="informacion"></td>
                                <td class="titulo"><strong>Descripción</strong></td>
                                <td class="informacion"></td>
                                <td class="titulo">{{ $kiosko->descripcion }} </td>
                                <td class="informacion"></td>
                            </tr>

                            <tr>
                                <td class="informacion"></td>
                                <td class="titulo"><strong>Estado para hoy</strong></td>
                                <td class="informacion"></td>
                                @foreach ($reservacion as $r)
                                    @if ($now == $r->fecha)
                                        @php
                                            $now = 0;
                                            $cliente = $r->nombreCliente;
                                        @endphp
                                    @endif
                                @endforeach
                                @if ($now == 0)
                                    <td class="titulo"><a class="text-danger"
                                            href="{{ route('kiosko.detail', ['id' => $r->id]) }}">Ocupado por
                                            <strong>{{ $cliente }}</strong></a>
                                    </td>
                                @else
                                    <td class="titulo text-success">Disponible</td>
                                @endif


                                <td class="informacion"></td>
                            </tr>

                            <tr>
                                <td class="informacion"></td>
                                <td class="titulo"><strong>Mesas Contenidas</strong></td>
                                <td class="informacion"></td>
                                <td class="titulo">
                                    @forelse ($mesas as $m)
                                        <a href="{{ route('mesas_reg.edit', ['id' => $m->id]) }}">{{ $m->nombre }}, </a>
                                    @empty
                                        <div class="row">
                                            <div class="col">
                                                <p>No hay mesas en este kiosko
                                            </div>
                                            <div class="col" style="text-align: end;"><a
                                                    href="{{ route('mesas_reg.create') }}"
                                                    style="margin:0; padding:5px; width:110px;" type="button"
                                                    class="bg-light border-radius-sm text-center ">
                                                    <i class="fa fa-plus-circle"></i> Agregar
                                                </a></p>
                                            </div>
                                        </div>
                                    @endforelse
                                </td>
                                <td class="informacion"></td>
                            </tr>

                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

@endsection
