@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'PRUEBAS')
@section('miga')
    <li class="breadcrumb-item text-sm">
        <a class="opacity-5 text-dark" href="#">Pruebas</a>
    </li>
    <li class="breadcrumb-item text-sm active text-dark active">Pruebas

    </li>
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

     <!--Platillos-->
     <div>
        <div class="container-fluid" style="padding: 0px">

            <!--Navegacion entre disponibles y no disponibles-->
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active text-dark h6" id="PDisponibles-tab" data-bs-toggle="tab" data-bs-target="#PDisponibles" role="tab" type="button" aria-controls="PDisponibles" aria-selected="true">Disponibles</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark h6" id="PNoDisponibles-tab" data-bs-toggle="tab" data-bs-target="#PNoDisponibles" role="tab" type="button" aria-controls="PNoDisponibles" aria-selected="false">No Disponibles</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent" style="height: 500px; overflow-x: hidden;">
                <!--Platillos Disponibles-->
                <div class="tab-pane fade show active" id="PDisponibles" role="tabpanel"
                    aria-labelledby="PDisponibles-tab">

                    <div class="table-responsive container-fluid">
                        <br>

                        <table class="table menu" class="table" id="PlatillosDisponibles"
                            style="">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;">N</th>
                                    <th scope="col" style="text-align: center;">Nombre</th>
                                    <th scope="col" style="text-align: center;">Disponibles</th>
                                    <th scope="col" style="text-align: end;">Precio</th>
                                    <th scope="col" style="text-align: center;">Acción</th>
                                    <th scope="col" style="text-align: center;">Editar</th>
                                    <th scope="col" style="text-align: center;">Eliminar</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $exits = false;
                                    $i = 0;
                                @endphp

                                @forelse($platillos as $p)
                                    @if ($p->estado == 1)
                                        @php
                                            $exits = true;
                                            $i++;
                                        @endphp

                                        <tr>

                                            <td scope="col" style="text-align: center;">@php echo $i  @endphp</td>
                                            <td scope="col" style="text-align: start;">{{ $p->nombre }}</td>
                                            <td scope="col" style="text-align: center;">{{ $p->disponible }}</td>
                                            <td scope="col" style="text-align: end;">L {{ $p->precio }}.00</td>
                                            <td scope="col" style="text-align: center;">
                                                <i onclick="activar('{{ $p->nombre }}', {{ $p->id }}, 'menu.admon');">
                                                    <a class="fa fa-times-circle text-warning"></a>
                                                    Desactivar</i>
                                                
                                            </td>
                                            <td scope="col" style="text-align: center;">
                                                <a href="{{ route('plato.editar', ['id' => $p->id]) }}">
                                                    <i class="fa fa-edit text-success"></i>
                                                </a>
                                            </td>
                                            <td scope="col" style="text-align: center;">
                                                <i data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdropEe{{ $p->id }}"
                                                    class="fa-solid fa-trash-can text-danger"
                                                    style="color:crimson"></i>
                                                <form
                                                    action="{{ route('platillo.borrar', ['id' => $p->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="modal fade"
                                                        id="staticBackdropEe{{ $p->id }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                                        tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5
                                                                        class="modal-title"id="staticBackdropLabel">
                                                                        Eliminar Platillo</h5>
                                                                </div>
                                                                <div class="modal-body"> ¿Está seguro de
                                                                    eliminar el platillo:
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
                                @empty
                                @endforelse

                                @if (!$exits)
                                    <tr>
                                        <td colspan="7" style="text-align: center;color: gray;">No hay
                                            Platillos disponibles <br> </td>
                                    </tr>
                                @endif

                            </tbody>
                        </table>
                    </div>
                </div>

                <!--Platillos No Disponibles-->
                <div class="tab-pane fade" id="PNoDisponibles" role="tabpanel"
                    aria-labelledby="PNoDisponibles-tab">

                    <div class="table-responsive container-fluid">
                        <br>

                        <table class="table menu" class="table" id="PlatillosNoDisponibles"
                            style="">
                            <thead>
                                <tr>
                                    <th scope="col" style="text-align: center;">N</th>
                                    <th scope="col" style="text-align: center;">Nombre</th>
                                    <th scope="col" style="text-align: center;">Disponibles</th>
                                    <th scope="col" style="text-align: end;">Precio</th>
                                    <th scope="col" style="text-align: center;">Acción</th>
                                    <th scope="col" style="text-align: center;">Editar</th>
                                    <th scope="col" style="text-align: center;">Eliminar</th>
                                </tr>
                            </thead>

                            <tbody>
                                @php
                                    $exits = false;
                                    $i = 0;
                                @endphp
                                @forelse($platillos as $p)
                                    @if ($p->estado == 0)
                                        @php
                                            $exits = true;
                                            $i++;
                                        @endphp
                                        <tr>
                                            <td scope="col" style="text-align: center;">@php echo $i  @endphp</td>
                                            <td scope="col" style="text-align: start;">{{ $p->nombre }}</td>
                                            <td scope="col" style="text-align: center;">{{ $p->disponible }}</td>
                                            <td scope="col" style="text-align: end;">L {{ $p->precio }}.00</td>
                                            <td scope="col" style="text-align: center;">
                                                <i data-bs-toggle="modal"
                                                    data-bs-target="#activarPlatillo{{ $p->id }}">
                                                    <a class="fa fa-check-circle text-success"></a>
                                                    Activar</i>
                                                <form
                                                    action="{{ route('platillo.activar', ['id' => $p->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @method('put')
                                                    @csrf
                                                    <div class="modal fade"
                                                        id="activarPlatillo{{ $p->id }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                                        tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="staticBackdropLabel">Activar
                                                                        Platillo</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    ¿Está seguro de activar el platillo:
                                                                    <strong>{{ $p->nombre }}</strong>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input id="activar" name="activar"
                                                                        style="display:none"
                                                                        value="1">
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
                                                    href="{{ route('plato.editar', ['id' => $p->id]) }}"><i
                                                        class="fa fa-edit text-success"></i></a></td>
                                            <td scope="col" style="text-align: center;">
                                                <i data-bs-toggle="modal"
                                                    data-bs-target="#staticBackdropE{{ $p->id }}"
                                                    class="fa-solid fa-trash-can text-danger"
                                                    style="color:crimson"></i>
                                                <form
                                                    action="{{ route('platillo.borrar', ['id' => $p->id]) }}"
                                                    method="post" enctype="multipart/form-data">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="modal fade"
                                                        id="staticBackdropE{{ $p->id }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                                        tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel"
                                                        aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title"
                                                                        id="staticBackdropLabel">Eliminar
                                                                        producto</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    ¿Está seguro de eliminar el platillo:
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
                                @empty
                                @endforelse

                                @if (!$exits)
                                    <tr>
                                        <td colspan="7" style="text-align: center;color: gray;">Todos
                                            los Platillos están disponibles <br> </td>
                                    </tr>
                                @endif
                            </tbody>
                        </table>

                    </div>
                </div>
            </div>

        </div>
    </div>
    <button onclick= "boton();" id="boton" class="btn btn-danger">Boton de prueba</button>

    <script>
        function activar(nombre, id, ruta) {
            Swal.fire({
                title: "Desactivar "+ nombre,
                text:  'Hola',
                icon: 'question',
                showDenyButton: true,
                confirmButtonText: "Si",
                allowOutsideClick: false,
            }).then(resultado => {
                if (resultado.value) {
                    
                    window.location.href = '/'+ ruta;
                } else {
                    // Dijeron que no
                }
            });
        }
    </script>
    

@endsection
