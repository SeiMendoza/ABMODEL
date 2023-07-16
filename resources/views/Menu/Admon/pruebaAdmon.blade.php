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

    <button onclick="boton();" id="boton" class="btn btn-danger">Boton de prueba</button>

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


@endsection
