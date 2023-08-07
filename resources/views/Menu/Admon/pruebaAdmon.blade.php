@extends('00_plantillas_Blade.plantilla_General2')
@section('content')
    <button id="boton" class="btn btn-success">Hola</button>
    <table class="table" id="table">
        <thead>
            <tr>
                <th scope="col">N</th>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Editar</th>
                <th scope="col">Boton</th>
            </tr>
        </thead>
        <tbody>
            <!-- codigo incrustado por ajax -->
        </tbody>
    </table>

    <!-- ========== Modal para eliminar ========== -->
    <div class="modal fade" id="modalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Eliminar producto</h4>
                </div>
                <div class="modal-body text-center">
                    <strong>¿Está seguro de eliminar el complemento?</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnConfirmDeleteProduct" class="btn btn-danger">Si</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== Scrips ========== -->
    <script src="/JQuery/jquery-3.7.0.js"></script>
    <script src="/JQuery/jquery-3.7.0.min.js"></script>
    <br>
    <script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
    <script src="/DataTables/DataTables-1.13.4/js/jquery.dataTables.js"></script>
    <script src="/DataTables/DataTables-1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/pruebaAdmon.js"></script>
    <script src="js/admonMenu.js"></script>

    <!-- ========== Start Section codigo Javascript para URL========== -->
    <script src="/JQuery/jquery-3.7.0.js"></script>
    <script src="/JQuery/jquery-3.7.0.min.js"></script>
    <script>
        $(function() {
            console.log("{{ URL::previous() }}");

            $(document).on('click', '#back', function(e) {
                console.log('Funcionando!');
                var url = "{{ URL::previous() }}";

                if (url == '/usuarios/{id}/editando/perfil') {

                    url = '/';
                }

                window.location.href = url;
            })

        })
    </script>
    <!-- ========== End Section codigo Javascript para URL========== -->
@endsection

<!-- ========== Start Bebidas ========== -->



@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Reservaciones de Kiosko')
@section('miga')
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="{{ route('kiosko.index') }}">Administración de
            Kioskos</a></li>
    <li class="breadcrumb-item text-sm active text-white active">Detalle de reservación de kiosko </li>
@endsection
@section('tit', 'Detalle de reservación del kiosko ' . $kiosko->codigo)
@section('b')
    <div>
        <a href="{{ route('kiosko.reservacioneshistorial', ['id' => $kiosko->id]) }}"
            style="margin:10px; padding:5px; width:190px;" type="button" class="bg-light border-radius-sm text-center ">
            <i class="fa-solid fa-clock-rotate-left"></i> Historial de Reservaciones
        </a>

        <a href="{{ $url }}" style="margin:0; padding:5px; width:160px;" type="button"
            class="bg-light border-radius-sm text-center ">
            <i class="fa fa-arrow-left"></i> Regresar
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

    <br>
    @php
        $rHoy = false;
        $h = $reservaciones->where('fecha', '=', $now)->count();
        if ($h > 0) {
            $rHoy = true;
        }
    @endphp

    @if ($rHoy)

        <h3 class="font-weight-bolder" style="margin:0">Reservaciones del día </h3>
        <!-- ========== Reservaciones Actuales ========== -->
        <div class="table-responsive" style="">
            <table class="table" id="" style="">
                <thead style="">
                    <tr>
                        <th scope="col" style="text-align:center">N</th>
                        <th scope="col">Fecha</th>
                        <th scope="col" style="text-align: center;">Celular</th>
                        <th scope="col" style="text-align: center;">Cantidad</th>
                        <th scope="col">Cliente</th>
                        <th scope="col" style="text-align:right;">Pago</th>
                        <th scope="col" style="text-align:right;">Anticipo</th>
                        <th scope="col" style="text-align:right;"> Detalle</th>
                        <th scope="col" style="text-align: center;">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($reservaciones as $r)
                        @php
                            $rHoy = false;
                            $i = 0;
                        @endphp
                        @if ($r->fecha == $now)
                            <tr style=" height:46px">
                                <td scope="col" style="text-align: center">{{ ++$i }}</td>
                                <td scope="col" style="text-align:left;">
                                    {{ \Carbon\Carbon::parse($r->fecha)->isoFormat('DD') }} de
                                    {{ \Carbon\Carbon::parse($r->fecha)->isoFormat('MMMM') }},
                                    {{ \Carbon\Carbon::parse($r->fecha)->isoFormat('YYYY') }}</td>
                                @php
                                    $total = $r->precioNinios * $r->cantidadNinios + $r->precioAdultos * $r->cantidadAdultos;
                                @endphp
                                <td scope="col" style="text-align:right">{{ $r->celular }}</td>
                                <td style="text-align: center;">{{ $r->cantidadAdultos + $r->cantidadNinios }}</td>
                                <td scope="col">{{ $r->nombreCliente }}</td>
                                <td class="" style="text-align:right" scope="col">L
                                    {{ number_format($total, 2, '.', ',') }}</td>
                                <td class="" style="text-align:right" scope="col">L
                                    {{ number_format($r->anticipo, 2, '.', ',') }}</td>
                                <td scope="col" style="text-align: center;">
                                    <a type="buttom" href="{{ route('kiosko.detail', ['id' => $r->id]) }}">
                                        <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
                                    </a>
                                </td>
                                <td scope="col" style="text-align: center;">
                                    <i data-bs-toggle="modal" data-bs-target="#staticBackdropE{{ $r->id }}"
                                        class="fa-solid fa-trash-can text-danger" style="color:crimson"></i>
                                    <form action="{{ route('kiosko_res.destroy', ['id' => $r->id]) }}" method="post"
                                        enctype="multipart/form-data">
                                        @method('delete')
                                        @csrf
                                        <div class="modal fade" id="staticBackdropE{{ $r->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title  font-weight-bolder"
                                                            id="staticBackdropLabel">Eliminar Reservación</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Esta seguro de eliminar la reservación de:
                                                        {{ $r->nombreCliente }}?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="submit" class="btn btn-danger">Si</button>
                                                        <button type="button" class="btn btn-secondary"
                                                            data-bs-dismiss="modal">No</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                            @php
                                //$rHoy = true;
                            @endphp
                        @endif
                    @empty
                    @endforelse
                    @if ($rHoy)
                        <tr>
                            <td colspan="9" style="text-align: center;"><strong>No hay reservaciones para
                                    hoy</strong></td>
                        </tr>
                    @endif
                </tbody>
            </table>
        </div>
        <!-- ========== End Cards ========== -->
    @else
        <div class="table-responsive" style="">
            <table class="table" id="" style="">
                <thead style="">
                    <tr>
                        <th style="text-align:start">
                            <h3 class="font-weight-bolder text-success" style="margin:0">NO HAY RESERVACIONES HOY </h3>
                        </th>
                    </tr>
                </thead>
            </table>
        </div>
    @endif


    <h3 class="font-weight-bolder" style="margin:0">Reservaciones futuras</h3>
    <!-- ========== Reservaciones Futuras ========== -->
    <div class="table-responsive" style="">
        <table class="table" id="" style="">
            <thead style="">
                <tr>
                    <th scope="col" style="text-align:center">N</th>
                    <th scope="col">Fecha</th>
                    <th scope="col" style="text-align: center;">Celular</th>
                    <th scope="col" style="text-align: center;">Cantidad</th>
                    <th scope="col">Cliente</th>
                    <th scope="col" style="text-align:right;">Pago</th>
                    <th scope="col" style="text-align:right;">Anticipo</th>
                    <th scope="col" style="text-align:right;"> Detalle</th>
                    <th scope="col" style="text-align: center;">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservaciones  as $r)
                    @php
                        $rFuturas = false;
                        $i = 0;
                    @endphp
                    @if ($r->fecha > $now)
                        @php $rFuturas = true @endphp
                        <tr style=" height:46px">
                            <td scope="col" style="text-align: center">{{ ++$i }}</td>
                            <td scope="col" style="text-align:left;">
                                {{ \Carbon\Carbon::parse($r->fecha)->isoFormat('DD') }} de
                                {{ \Carbon\Carbon::parse($r->fecha)->isoFormat('MMMM') }},
                                {{ \Carbon\Carbon::parse($r->fecha)->isoFormat('YYYY') }}</td>
                            @php
                                $total = $r->precioNinios * $r->cantidadNinios + $r->precioAdultos * $r->cantidadAdultos;
                            @endphp
                            <td scope="col" style="text-align:right">{{ $r->celular }}</td>
                            <td style="text-align: center;">{{ $r->cantidadAdultos + $r->cantidadNinios }}</td>
                            <td scope="col">{{ $r->nombreCliente }}</td>
                            <td class="" style="text-align:right" scope="col">L
                                {{ number_format($total, 2, '.', ',') }}</td>
                            <td class="" style="text-align:right" scope="col">L
                                {{ number_format($r->anticipo, 2, '.', ',') }}</td>
                            <td scope="col" style="text-align: center;">
                                <a type="buttom" href="{{ route('kiosko.detail', ['id' => $r->id]) }}">
                                    <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
                                </a>
                            </td>
                            <td scope="col" style="text-align: center;">
                                <i data-bs-toggle="modal" data-bs-target="#staticBackdropE{{ $r->id }}"
                                    class="fa-solid fa-trash-can text-danger" style="color:crimson"></i>
                                <form action="{{ route('kiosko_res.destroy', ['id' => $r->id]) }}" method="post"
                                    enctype="multipart/form-data">
                                    @method('delete')
                                    @csrf
                                    <div class="modal fade" id="staticBackdropE{{ $r->id }}"
                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title  font-weight-bolder" id="staticBackdropLabel">
                                                        Eliminar Reservación</h5>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Esta seguro de eliminar la reservación de:
                                                    {{ $r->nombreCliente }}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">Si</button>
                                                    <button type="button" class="btn btn-secondary"
                                                        data-bs-dismiss="modal">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </td>
                        </tr>
                    @endif
                @empty
                @endforelse
                @if (!$rFuturas)
                    <tr>
                        <td colspan="9" style="text-align: start;"><strong>No hay reservaciones futuras</strong>
                        </td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <!-- ========== End Cards ========== -->

@endsection
