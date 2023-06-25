@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Kioskos')
@section('miga')
<li class="breadcrumb-item text-sm active text-white active">Administración de Kioskos</li>
@endsection
@section('tit','Listado de Kioskos')
@section('b')
<div>
    <a href="{{ route('kiosko.create') }}" style="margin:0; padding:5px; width:160px;" type="button"
        class="bg-light border-radius-sm text-center ">
        <i class="fa fa-plus-circle"></i> Agregar Kiosko
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
    <br>
    <div class="table-responsive ">
        <table class="table" id="example">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center">N</th>
                    <th scope="col" style="text-align: center">Código</th>
                    <th scope="col" style="text-align: center">Cantidad de Mesas</th>
                    <th scope="col" style="text-align: start">Ubicación</th>
                    <th scope="col" style="text-align: center">Disponible</th>
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
                            <td scope="col" style="text-align: center">{{ $k->cantidad_de_Mesas }}</td>
                            <td scope="col" style="text-align: start">{{ $k->ubicacion }}</td>
                            <td scope="col" style="text-align: center">
                                @if($k->disponible == 1)
                                    <i class="fa fa-check-circle text-success"></i>
                                @else
                                    <i class="fa fa-times-circle text-danger"></i>
                                @endif
                            </td>

                            <td scope="col" style="text-align: center">
                                <a
                                    href="{{ route('kiosko.edit', ['id' => $k->id]) }}">
                                    <i class="fa fa-edit text-info"></i>
                                </a>
                            </td>
                            <td scope="col" style="text-align: center">
                                <i data-bs-toggle="modal" data-bs-target="#kiosko{{ $k->id }}"
                                    class="fa fa-trash-can text-danger" style="color:crimson"></i>
                                <form
                                    action="{{ route('kiosko.destroy', ['id' => $k->id]) }}"
                                    method="post" enctype="multipart/form-data">
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
                                                    ¿Está seguro de eliminar el kiosko:<strong>{{ $k->codigo }}</strong>? <br>Esto eliminará todas las mesas contenidas y los pedidos de estas mesas
                                                </div>
                                                <div class="modal-footer">
                                                    <input id="activar" name="activar" style="display:none" value="0">
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
