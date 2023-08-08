@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Kioskos')
@section('miga')
    <li class="breadcrumb-item text-sm " aria-current="page">  
        <a class="opacity-5 text-white" href="{{route('kiosko_res.index')}}">Reservacines de Kioskos</a></li>
    <li class="breadcrumb-item text-sm"><a class="text-white ">Reservaciones Terminadas </a></li>
@endsection
@section('tit', 'Reservaciones de kioskos')
@section('b')
    <div class="" style="">
        <a href="#" data-bs-toggle="modal" data-bs-target="#exampleModalCenter2" style="margin:0; padding:5px; width:150px; font-size:15px" 
        type="button" class="bg-light border-radius-sm text-center">
            <i class="fa-solid fa-trash-can text-danger"></i>  Eliminar Todo
        </a> 
        <a href="{{route('kiosko_res.index')}}" style="margin:0; padding:5px; width:150px; font-size:15px" type="button" 
        class="bg-light border-radius-sm text-center">
        <i class="fa fa-arrow-left"></i> Regresar
       </a> 
    </div>
@endsection
@section('content')
    <!-- ========== Reservaciones ========== -->
    <div class="table-responsive" style="">
        <table class="table" id="example" style="">
            <thead style="">
                <tr>
                    <th style="text-align: left; width: 30px">N</th>
                    <th style="width: 200px">Cliente</th>
                    <th style="text-align: center; width: 50px">Celular</th>
                    <th style="text-align: center; width: 50px">Personas</th>
                    <th style="text-align: center; width: 50px">fecha</th>
                    <th style="text-align: center; width: 50px">Kiosko</th>
                    <th style="text-align:right; width: 50px">Pendiente</th>
                    <th style="text-align:right; width: 40px">Realizada</th>
                    <th style="text-align:right; width: 40px"> Detalle</th>
                    <th style="text-align: center; width: 40px">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservaciones  as $i => $r)
                    <tr style=" height:46px">
                        <td style="text-align: left; width: 30px"> {{ ++$i }} </td>
                        <td>
                            <p style="width: 200px; white-space: nowrap; overflow: hidden; text-overflow: ellipsis">{{ $r->nombreCliente }}</p>
                        </td>
                        <td style="text-align:right; width: 50px">{{ $r->celular }}</td>
                        <td style="text-align: center; width: 50px">{{ $r->cantidadAdultos + $r->cantidadNinios }}</td>
                        <td style="text-align:center; width: 50px">{{ \Carbon\Carbon::parse($r->fecha)->isoFormat('DD') }}
                            de
                            {{ \Carbon\Carbon::parse($r->fecha)->isoFormat('MMMM') }},
                            {{ \Carbon\Carbon::parse($r->fecha)->isoFormat('YYYY') }}</td>
                        <td style="text-align:center; width: 50px">{{ $r->codigo }}</td>
                        <td class="" style="text-align:right; width: 50px" scope="col">L 0.00</td>
                        <td style="text-align: center; width: 40px">
                            <i class="fa-solid fa-check-circle text-success" style="color:green"></i>
                        </td>
                        <td style="text-align: center; width: 50px;">
                            <a type="buttom" href="{{ route('kiosko.detalles_t', ['id' => $r->id]) }}">
                                <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
                            </a>
                        </td>
                        <td style="text-align: center; width: 50px">
                            <i data-bs-toggle="modal" data-bs-target="#staticBackdropE{{ $r->id }}"
                                class="fa-solid fa-trash-can text-danger" style="color:crimson"></i>
                            <form action="{{ route('kiosko_res.destroy', ['id' => $r->id]) }}" method="post"
                                enctype="multipart/form-data">
                                @method('delete')
                                @csrf
                                <div class="modal fade" id="staticBackdropE{{ $r->id }}" data-bs-backdrop="static"
                                    data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                    aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title  font-weight-bolder" id="staticBackdropLabel">
                                                    Eliminar Reservación</h5>
                                            </div>
                                            <div class="modal-body">
                                                ¿Esta seguro de eliminar la reservación de: {{ $r->nombreCliente }}?
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

                @empty
                @endforelse
            </tbody>
        </table>
    </div>
    <!-- ========== End Cards ========== -->
@endsection


@section('pie')
    <!-- Modal Eliminar-->
    <form action="{{route('kiosko_res_t.destroy')}}" method="post" enctype="multipart/form-data">
        @method('delete')
        @csrf
        <div class="modal fade" id="exampleModalCenter2"  data-bs-backdrop="static" aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title  font-weight-bolder" id="staticBackdropLabel">Eliminar Reservaciones</h5>
                    </div>
                    <div class="modal-body">
                    ¿Está seguro de eliminar todas las reservaciones?
                    </div>
                    <div class="modal-footer">
                        <button type="submit" class="btn btn-danger">Si</button>
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                    </div>
                </div>
            </div>
        </div>
    </form>
@endsection
