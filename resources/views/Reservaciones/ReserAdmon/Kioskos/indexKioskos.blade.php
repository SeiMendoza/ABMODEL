@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Kioskos')
@section('miga')
    <li class="breadcrumb-item text-sm active text-dark active">Administración de Kioskos</li>
@endsection

@section('b')
    <h3 class="font-weight-bolder opacity-8  text-gray mb-0" style="position: absolute; left:15px; top:100%;">Administración
        de Kioskos</h3>
    <div class="" style="position:absolute; right:2%; top:50%">
        <a href="{{ route('kiosko_res.index') }}" style="margin:0;width:200px; padding:6px;"
            class="bg-light border-radius-md h-6 text-center text-gray font-weight-bolder">
            <i class="fa fa-users"></i> Reservaciones de Kioskos
        </a>
    </div>
    <div class="" style="position:absolute; right:19%; top:50%">
        <a href="#" style="margin:0;width:200px; padding:6px;"
            class="bg-light border-radius-md h-6 text-center text-gray font-weight-bolder">
            <i class="fa fa-users"></i> Agregar Kiosko
        </a>
    </div>

@endsection

@section('content')

    <script>
        var msg = '{{ Session::get('mensaje') }}';
        var exist = '{{ Session::has('mensaje') }}';
        if (exist) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: msg,
                showConfirmButton: false,
                toast: true,
                background: '#fff',
                timer: 3500
            })
        }
    </script>

    <div class="container">
        <div class="table-responsive ">
            <table class="table kiosko" id="table" style="background-color: #fff;">
                <thead >
                    <tr>
                        <th scope="col">N</th>
                        <th scope="col">Código</th>
                        <th scope="col">Cantidad de Mesas</th>
                        <th scope="col">Ubicación</th>
                        <th scope="col">Disponible</th>
                        <th scope="col">Editar</th>
                        <th scope="col">Eliminar</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $i = 1;
                    @endphp
                    @forelse($kioskos as $k)
                            <tr class="border border-light"
                                style="color:gray; text-align:center">
                                <th scope="col">@php echo $i++  @endphp</th>
                                <td scope="col">{{ $k->codigo }}</td>
                                <td scope="col">{{ $k->cantidad_de_Mesas }}</td>
                                <td scope="col">{{ $k->ubicacion }}</td>                           
                                <td scope="col">
                                    @if ($k->disponible == 1)
                                        <i class="fa fa-check-circle text-success"></i> 
                                    @else
                                        <i class="fa fa-times-circle text-danger"></i> 
                                    @endif
                                </td>                           

                                <td scope="col"><a
                                        href="{{ route('kiosko.edit', ['id' => $k->id]) }}"><i
                                            class="fa fa-edit text-info"></i></a></td>
                                <td>
                                    <i data-bs-toggle="modal"
                                        data-bs-target="#kiosko{{ $k->id }}"
                                        class="fa fa-trash-can text-danger"
                                        style="color:crimson"></i>
                                    <form
                                        action="{{ route('kiosko.destroy', ['id' => $k->id]) }}"
                                        method="post" enctype="multipart/form-data">
                                        @method('delete')
                                        @csrf
                                        <div class="modal fade"
                                            id="kiosko{{ $k->id }}"
                                            data-bs-backdrop="static" data-bs-keyboard="false"
                                            tabindex="-1"
                                            aria-labelledby="staticBackdropLabel"
                                            aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title"
                                                            id="staticBackdropLabel">Eliminar
                                                            Kiosko</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                        ¿Está seguro de eliminar el kiosko:
                                                        <strong>{{ $k->codigo }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input id="activar" name="activar"
                                                            style="display:none"
                                                            value="0">
                                                            <button type="submit"
                                                            class="btn btn-danger">Si</button>
                                                        <button type="button"
                                                            class="btn btn-secondary"
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

