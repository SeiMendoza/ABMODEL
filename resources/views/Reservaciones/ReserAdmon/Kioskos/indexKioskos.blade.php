@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Kioskos')
@section('miga')
<li class="breadcrumb-item text-sm">
    <a class="opacity-5 text-dark"
    href="#">Reservaciones</a>
</li>
<li class="breadcrumb-item text-sm active text-dark active">Kioskos</li>
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

    <!--Boton Registrar Kiosko-->
    <div class="row" style="margin: 4px">
        <a href={{ route('kiosko.create') }} class=" col-2 btn btn-primary" style="margin: 4px">Registrar Kiosko</a>
        <p class="col-8 text-end">Cantidad de Kioskos totales: <strong> {{ $kioskos->count() }}</strong></p>

    </div>

    <div class="container">

                @forelse ($kioskos as $k)
                <div class="" id="kioskos" style="display: grid; grid-template-columns: 300px 300px 300px 300px">
                    <div class=" col-12 p-4">
                        <div class="container" style="display:block;  height: 300px; width: 1100px; padding: 5px ">
                            <div class="card h-100" data-id="kiosko{{ $k->id }}"
                                style="padding: 0px; width:100%; border-radius:0%; background: url({{ $k->imagen }}) top center/cover no-repeat;">
                                <div class="text-center" style="text-align:center; ">
                                    <h2
                                        style="width:1090px; background-color:rgba(255, 255, 255, 0.677); position: absolute; bottom: 14%; left:0;">
                                        Kiosko {{ $k->codigo }}</h2>
                                    <!--Boton editar-->
                                    <a class="btn btn-primary form btn-s" href="{{ route('kiosko.edit', ['id' => $k->id]) }}"
                                        style="position:absolute; bottom: 29.5%; left:1005px">Editar</a>

                                    <!--Boton borrar-->
                                    <a class="btn btn-menu form btn-s" data-bs-toggle="modal"
                                        data-bs-target="#modalBorrarKiosko{{ $k->id }}"
                                        style="position:absolute; bottom: 29.5%; left:920px">Borrar</a>

                                    <p class="nombre card-title pt-2 text-center text-white"
                                        id="ubicacion_{{ $k->descripcion }}">
                                        <strong
                                            style="font-size: 15px; width:1090px; background-color:rgba(95, 95, 95, 0.651); position: absolute; bottom: 8.3%; left:0;">
                                            {{ $k->descripcion }}
                                        </strong>
                                    </p>
                                    <p class="nombre card-title pt-2 text-center text-white"
                                        id="ubicacion_{{ $k->ubicacion }}">
                                        <strong
                                            style="font-size: 15px; width:1090px; background-color:rgba(95, 95, 95, 0.651); position: absolute; bottom: 0%; left:0;">
                                            Ubicación: {{ $k->ubicacion }}
                                        </strong>
                                    </p>
                                </div>

                                <!--Modal Eliminar-->
                                <div class="modal fade" id="modalBorrarKiosko{{ $k->id }}"
                                    tabindex="-1" aria-labelledby="ModalLabel"
                                    aria-hidden="true" data-bs-backdrop="static"
                                    data-bs-keyboard="false">

                                    <div class="modal-dialog" data-backdrop="static">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h5 class="modal-title" id="ModalLabel">
                                                    Eliminar Kiosko
                                                </h5>
                                                <button type="button" class="btn-close fs-5"
                                                    data-bs-dismiss="modal" aria-label="Close">
                                                </button>
                                            </div>

                                            <div class="modal-body">
                                                ¿Está seguro de eliminar el kiosko
                                                <strong>{{ $k->codigo }}</strong>
                                                del menú?
                                            </div>
                                            <div class="modal-footer">

                                                <form
                                                    action="{{ route('kiosko.destroy', ['id' => $k->id]) }}"
                                                    method="POST">
                                                    @csrf
                                                    <div style="display: none">
                                                        <input type="number" id="activar"
                                                            name="activar" value="0">
                                                    </div>
                                                    <button type="button" class="btn "
                                                        data-bs-dismiss="modal">No</button>
                                                    <input type="submit" class="btn btn-primary"
                                                        value="Si">
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
                @empty

                <h2 class="col-12 text-center">No hay Kioskos registrados</h2>

                @endforelse
            
    </div>

@endsection
