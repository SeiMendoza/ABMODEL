@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Kioskos')
@section('miga')
    <li class="breadcrumb-item text-sm"> <a class="opacity-5 text-dark" href="{{ route('kiosko_res.index') }}" >Kioskos</a></li>
    <li class="breadcrumb-item text-sm active text-dark active">Administración</li>
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


    <div style="margin-left:25px; display:block; float:left;
        color: #333333" class="nav-link-icon">                            
            <h4>Listado de Kioskos</h4>
    </div>

    <div class="row justify-content-end text-center" style="margin-top:15px">
        <a href="{{ route('kiosko_res.index') }}" type="button" class="h-6 text-center text-primary"
            style="width:300px; padding:0px;">
            <i class="fa fa-table text-sm text-center opacity-10"></i>
            Ir a reservaciones de Kiosko
        </a>

        <a href={{ route('kiosko.create') }} class="me-4 text-center col-2 btn btn-xs btn-primary">Registrar Kiosko</a>

    </div>

    <div class="container">
        <div class="table-responsive ">
            <table class="table" id="table" style="background-color: #fff;">
                <thead class="card-header border border-radius text-primary"
                    style=" text-align:center">
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
                                        class="fa fa-delete-left text-danger"
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
                                                        <strong>{{ $k->nombre }}</strong>?
                                                    </div>
                                                    <div class="modal-footer">
                                                        <input id="activar" name="activar"
                                                            style="display:none"
                                                            value="0">
                                                        <input type="submit"
                                                            class="btn btn-danger w-15"
                                                            value="Si">
                                                        <button type="button"
                                                            class="btn btn-menu"
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

            <div class="pagination pagination-sm justify-content-end"> 
                <div style="display:block; float:right;"> 
                {{$kioskos->links()}}
                </div>
            </div>
        </div>


    </div>

@endsection

