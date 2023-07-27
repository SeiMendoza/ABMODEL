@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'PRUEBAS')
@section('miga')
    <li class="breadcrumb-item text-sm">
        <a class="opacity-5 text-dark" href="#">Pruebas</a>
    </li>
    <li class="breadcrumb-item text-sm active text-dark active">Pruebas

    </li>
@endsection


<div>
    @extends('00_plantillas_Blade.plantilla_admonMenu')
    @section('meta')
        <meta name="csrf-token" content="{{ csrf_token() }}">
    @endsection

    @section('b')
        <!-- Botón registrar -->
        <div>
            <a href="{{ route('bebidasyplatillos.create', ['origen' => 0]) }}" style="margin:8px; padding:5px; width:200px;"
                type="button" class="bg-light border-radius-sm text-center">
                <i class="fa fa-plus-circle"></i> Agregar Productos
            </a>
        </div>
        <div>
            <a href="{{ route('cliente_prueba') }}" style="margin:0; padding:5px; width:160px;" type="button"
                class="bg-light border-radius-sm text-center ">
                <i class="fa fa-users"></i> Menú cliente
            </a>
        </div>
    @endsection

    @section('selection')
        <div>
            <div>
                <ul class="nav nav-tabs nav-justified h5 " role="tablist"
                    style="background-color:rgba(111, 143, 175, 0.200);">

                    <li class="nav-item" role="presentation">
                        <a href="{{ route('menuAdmon.bebidas') }}" class="nav-link text-dark" id="pills-bebidas-tab"
                            data-bs-toggle="" data-bs-target="#pills-bebidas" type="button" role="tab"
                            aria-controls="pills-bebidas" aria-selected="false">Bebidas</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a href="{{ route('menuAdmon.platillos') }}" class="nav-link text-dark" id="pills-platillos-tab"
                            data-bs-toggle="" data-bs-target="#pills-platillos" type="button" role="tab"
                            aria-controls="pills-platillos" aria-selected="false">Platillos</a>
                    </li>

                    <li class="nav-item" role="presentation">
                        <a href="{{ route('menuAdmon.complementos') }}" class="nav-link text-dark active"
                            id="pills-complementos-tab" data-bs-toggle="" data-bs-target="#pills-complementos"
                            type="button" role="tab" aria-controls="pills-complementos"
                            aria-selected="true">Complementos</a>
                    </li>
                </ul>
            </div>
        </div>
    @endsection
    @section('show')

        <!--complementos-->
        <div class="tab-pane fade show active" id="pills-complementos" role="tabpanel"
            aria-labelledby="pills-Cdisponible-tab">

            <div class="pt-3">

                <!--Navegacion entre disponibles y no disponibles-->
                <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-dark h6 active" id="CPDisponibles-tab" data-bs-toggle="tab"
                            data-bs-target="#CDisponibles" role="tab" aria-controls="CDisponibles"
                            aria-selected="true">Disponibles</a>
                    </li>
                    <li class="nav-item" role="presentation">
                        <a class="nav-link text-dark h6" id="CNoDisponibles-tab" data-bs-toggle="tab"
                            data-bs-target="#CNoDisponibles" role="tab" aria-controls="CNoDisponibles"
                            aria-selected="false">No
                            Disponibles</a>
                    </li>
                </ul>

                <div class="tab-content" id="myTabContent" style="height: 500px; overflow-x: hidden;">
                    <br>

                    <!--complementos Disponibles-->

                    <div class="tab-pane fade show active" id="CDisponibles" role="tabpanel"
                        aria-labelledby="CDisponibles-tab">

                        <div class="table-responsive">

                            <table class="table menu" class="table" id="complementosDisponibles" style="">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align: center;">N</th>
                                        <th scope="col" style="text-align: start;">Nombre</th>
                                        <th scope="col" style="text-align: end;">Precio</th>
                                        <th scope="col" style="text-align: center;">Acción</th>
                                        <th scope="col" style="text-align: center;">Editar</th>
                                        <th scope="col" style="text-align: center;">Eliminar</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $i = 0; @endphp
                                    @forelse($productos as $p)
                                        @if ($p->tipo == 0)
                                            @if ($p->estado == 1)
                                                @php
                                                    $exits = true;
                                                    $i++;
                                                @endphp
                                                <tr>
                                                    <td scope="col" style="text-align: center;">@php echo $i @endphp</td>
                                                    <td scope="col" style="text-align: start;">{{ $p->nombre }}</td>
                                                    <td scope="col" style="text-align: end;">L
                                                        {{ number_format($p->precio, 2, '.', ',') }}</td>
                                                    <td scope="col" style="text-align: center;">
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#activarComplemento{{ $p->id }}"><i
                                                                class="fa fa-times-circle text-warning"></i>
                                                            Desactivar</button>
                                                        <form action="{{ route('producto.activar', ['id' => $p->id]) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @method('put')
                                                            @csrf
                                                            <div class="modal fade"
                                                                id="activarComplemento{{ $p->id }}"
                                                                data-bs-backdrop="static" data-bs-keyboard="false"
                                                                tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="staticBackdropLabel">
                                                                                Desactivar
                                                                                complemento</h5>
                                                                        </div>
                                                                        <div class="modal-body"> ¿Está seguro de
                                                                            desactivar el complemento:
                                                                            <strong>{{ $p->nombre }}</strong>?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input id="activar" name="activar"
                                                                                style="display:none" value="0">
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
                                                    <td scope="col" style="text-align: center;"><a
                                                            href="{{ route('producto.editar', ['id' => $p->id]) }}"><i
                                                                class="fa fa-edit text-success"></i></a></td>
                                                    <td scope="col" style="text-align: center;">
                                                        <i data-bs-toggle="modal"
                                                            data-bs-target="#eliminarComplemento{{ $p->id }}"
                                                            class="fa-solid fa-trash-can text-danger"
                                                            style="color:crimson"></i>
                                                        <form action="{{ route('producto.borrar', ['id' => $p->id]) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @method('delete')
                                                            @csrf
                                                            <div class="modal fade"
                                                                id="eliminarComplemento{{ $p->id }}"
                                                                data-bs-backdrop="static" data-bs-keyboard="false"
                                                                tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="staticBackdropLabel">
                                                                                Eliminar
                                                                                producto</h5>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            ¿Está seguro de eliminar el complemento:
                                                                            <strong>{{ $p->nombre }}</strong>?
                                                                        </div>
                                                                        <div class="modal-footer">
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
                                            @endif
                                        @endif
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>

                        </div>

                    </div>

                    <!--complementos no Disponibles-->

                    <div class="tab-pane fade " id="CNoDisponibles" role="tabpanel"
                        aria-labelledby="CNoDisponibles-tab">

                        <div class="table-responsive">

                            <table class="table menu" id="complementosNoDisponibles" style="">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align: center;">N</th>
                                        <th scope="col" style="text-align: satar;">Nombre</th>
                                        <th scope="col" style="text-align: end;">Precio</th>
                                        <th scope="col" style="text-align: center;">Acción</th>
                                        <th scope="col" style="text-align: center;">Editar</th>
                                        <th scope="col" style="text-align: center;">Eliminar</th>
                                    </tr>
                                </thead>

                                <tbody>
                                    @php $i = 0; @endphp
                                    @forelse($productos as $p)
                                        @if ($p->tipo == 0)
                                            @if ($p->estado == 0)
                                                @php $i++; @endphp
                                                <tr>
                                                    <th scope="col" style="text-align: center;">@php echo $i @endphp</th>
                                                    <td scope="col" style="text-align: start;">{{ $p->nombre }}
                                                    </td>
                                                    <td scope="col" style="text-align: end;">L
                                                        {{ number_format($p->precio, 2, '.', ',') }}</td>
                                                    <td scope="col" style="text-align: center;">
                                                        <button data-bs-toggle="modal"
                                                            data-bs-target="#activarComplemento{{ $p->id }}"><i
                                                                class="fa fa-check-circle text-success"></i>
                                                            Activar</button>

                                                        <form action="{{ route('producto.activar', ['id' => $p->id]) }}"
                                                            method="post" enctype="multipart/form-data">
                                                            @method('put')
                                                            @csrf
                                                            <div class="modal fade"
                                                                id="activarComplemento{{ $p->id }}"
                                                                data-bs-backdrop="static" data-bs-keyboard="false"
                                                                tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                                aria-hidden="true">
                                                                <div class="modal-dialog">
                                                                    <div class="modal-content">
                                                                        <div class="modal-header">
                                                                            <h5 class="modal-title"
                                                                                id="staticBackdropLabel">Activar
                                                                                Complemento</h5>
                                                                        </div>
                                                                        <div class="modal-body">
                                                                            ¿Está seguro de activar el complemento:
                                                                            <strong>{{ $p->nombre }}</strong>?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <input id="activar" name="activar"
                                                                                style="display:none" value="1">
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
                                                    <td scope="col" style="text-align: center;">
                                                        <a href="{{ route('producto.editar', ['id' => $p->id]) }}"><i
                                                                class="fa fa-edit text-success"></i></a>
                                                    </td>
                                                    <td scope="col" style="text-align: center;">
                                                        <i id="{{ $p->id }}"
                                                            class=" deleteProduct fa-solid fa-trash-can text-danger"
                                                            style="color:crimson"></i>
                                                    </td>
                                                </tr>
                                            @endif
                                        @endif
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>

                        </div>
                        <div class="modal fade" id="modalDelete" data-bs-backdrop="static" data-bs-keyboard="false"
                            tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h4 class="modal-title" id="staticBackdropLabel">Eliminar producto</h4>
                                    </div>
                                    <div class="modal-body text-center">
                                        <strong>¿Está seguro de eliminar el complemento?</strong>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="submit" id="btnConfirmDeleteProduct"
                                            class="btn btn-danger">Si</button>
                                        <button type="button" class="btn btn-secondary"
                                            data-bs-dismiss="modal">No</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                        </form>

                    </div>

                </div>

            </div>

        </div>

        @section('scritps')

            <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
                crossorigin="anonymous"></script>
            <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
            <script src="js/admonMenu.js"></script>
            <script>
                function activar(nombre, id, tipo) {
                    Swal.fire({
                        title: "Desactivar " + nombre,
                        text: '...',
                        icon: 'question',
                        showDenyButton: true,
                        confirmButtonText: "Si",
                        allowOutsideClick: false,
                    }).then(resultado => {
                        if (resultado.value) {
                            route('producto.activar', {
                                id: id
                            });
                            console.log('Si se activó');
                        } else {
                            console.log('No se activó');
                        }
                    });
                }
            </script>


        @endsection

    @endsection

</div>



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
                timer: 5500
            })
        }

        function activarProducto(id, e, nombre, ruta) {


            let form = document.getElementById('formcheckDesactivar');

            if (e == 'activar') {
                form = document.getElementById('formcheckActivar');
            }

            Swal
                .fire({
                    title: 'Estado',
                    text: "¿Desea " + e + " " + nombre + "?",
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: "Si",
                    cancelButtonText: "No",
                })
                .then(resultado => {
                    if (resultado.value) {
                        form.submit();
                    } else {
                        // Dijeron que no
                    }
                });


        }

        function eliminarProducto(id, nombre, ruta) {

            Swal
                .fire({
                    title: 'Eliminar',
                    text: "¿Está seguro de eliminar a " + nombre + "?",
                    icon: 'warning',
                    showCancelButton: true,
                    confirmButtonText: "Si",
                    cancelButtonText: "No",
                })
                .then(resultado => {
                    if (resultado.value) {
                        //form.submit();
                    } else {
                        // Dijeron que no
                    }
                });
        }
    </script>

    <button id="boton" class="btn btn-danger">Boton de prueba</button>

    @php
        $colors = ['danger', 'success', 'primary', 'warning', 'info', 'secondary'];
    @endphp

    <header>
        <a href="#" data-bs-toggle="dropdown">
            <p>kol</p>
        </a>

        <li class=" dropdown d-flex">
            <div class="dropdown-menu dropdown-menu-end px-2 py-3 me-sm-n0"
                style=" max-height: 600px; overflow-y: auto; aria-labelledby="dropdownMenuButton">
                <div class="d-flex py-1">
                    <div class="d-flex flex-column justify-content-center">
                        <h6 class="text-sm font-weight-bold mb-1" style="pointer-events: none;">
                            Existencia de productos de piscina
                        </h6>
                    </div>
                </div>
            </div>
        </li>

    </header>


    <script>
        function activar(nombre, id, ruta) {
            Swal.fire({
                title: "Desactivar " + nombre,
                text: '...',
                icon: 'question',
                showDenyButton: true,
                confirmButtonText: "Si",
                allowOutsideClick: false,
            }).then(resultado => {
                if (resultado.value) {
                    let form = 'activar' + id;
                    document.getElementById(form).submit();
                    //window.location.href = '/'+ ruta;
                } else {
                    // Dijeron que no
                }
            });
        }
    </script>
    <script src="https://code.jquery.com/jquery-3.7.0.js" integrity="sha256-JlqSTELeR4TLqP0OG9dxM7yDPqX1ox/HfgiSLBj8+kM="
        crossorigin="anonymous"></script>

@endsection
