@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Kioskos')
@section('miga')
    <li class="breadcrumb-item text-sm active text-white active">Administración de Kioskos</li>
@endsection
@section('tit', 'Listado de Kioskos')
@section('b')
    <div>
        <a href="{{ route('kiosko.create') }}" style="margin:0; padding:5px; width:160px;" type="button"
            class="bg-light border-radius-sm text-center ">
            <i class="fa fa-plus-circle"></i> Agregar Kiosko
        </a>
    </div>
@endsection

@section('content')
    <div class=>
        <br>
        <div class="table-responsive ">
            <table class="table" id="example">
                <thead>
                    <tr>
                        <th scope="col" style="text-align: center">N</th>
                        <th scope="col" style="text-align: center">Código</th>
                        <th scope="col" style="text-align: start">Ubicación</th>
                        <th scope="col" style="text-align: center">Reservaciones</th>
                        <th scope="col" style="text-align: center">Detalle</th>
                        <th scope="col" style="text-align: center">Editar</th>
                        <th scope="col" style="text-align: center">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @php $i = 1; @endphp
                    @forelse($kioskos as $k)
                        <tr>
                            <td scope="col" style="text-align: center">{{ $i++ }}</td>
                            <td scope="col" style="text-align: center">{{ $k->codigo }}</td>
                            <td scope="col" style="text-align: start">{{ $k->ubicacion }}</td>
                            <td scope="col" style="text-align: center"><a class="text-info"
                                    href="{{ route('kiosko.reservaciones', ['id' => $k->id]) }}"> <i
                                        class="fa-regular fa-building-user"></i><i> Listado de reservaciones</i></a>
                            </td>
                            <td scope="col" style="text-align: center">
                                <a type="buttom" href="{{ route('kiosko.detalle', ['id' => $k->id]) }}">
                                    <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
                                </a>
                            </td>

                            <td scope="col" style="text-align: center">
                                <a href="{{ route('kiosko.edit', ['id' => $k->id]) }}">
                                    <i class="fa fa-edit text-success"></i>
                                </a>
                            </td>
                            <td scope="col" style="text-align: center">
                                <i data-bs-toggle="modal" data-bs-target="#kiosko{{ $k->id }}"
                                    class="fa fa-trash-can text-danger" style="color:crimson"></i>
                                <form action="{{ route('kiosko.destroy', ['id' => $k->id]) }}" method="post"
                                    enctype="multipart/form-data">
                                    @method('delete')
                                    @csrf
                                    <div class="modal fade" id="kiosko{{ $k->id }}" data-bs-backdrop="static"
                                        data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel"
                                        aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Eliminar Kiosko
                                                    </h5>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Está seguro de eliminar el
                                                    kiosko:<strong>{{ $k->codigo }}</strong>? <br>Esto eliminará todas
                                                    las mesas, reservaciones <br> y los pedidos contenidos en este kiosko
                                                </div>
                                                <div class="modal-footer">
                                                    <input id="activar" name="activar" style="display:none"
                                                        value="0">
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


    </div>

@endsection
