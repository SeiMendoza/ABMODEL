@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Mesas')
<style media="screen">
    #r{
        background-color: rgba(2, 102, 0, 0.727);
    }
    li:active a, li:focus-visible, li:hover{
        background-color: rgba(2, 102, 0, 0.168);
    }
  </style>

@section('activatedMenu')
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
        var ms = '¡Existe un error, revise los datos!';
        var exis = '{{ Session::has('errors') }}';
        if (exis) {
            Swal.fire({
                position: 'top-end',
                icon: 'warning',
                title: ms,
                showConfirmButton: false,
                toast: true,
                background: '#fff',
                timer: 5500
            })
        }
    </script>

    <div class="container-fluid" style="padding: 0">
        <div class="row container d-flex justify-content-center" id="r" style="padding: 0; margin:0;">
            <h2 style="background-color: rgba(2, 102, 0, 0.727);" class="h4 text-light text-xl-center col-12">Mesas</h2>
            <footer class="container-fluid">
                <ul 
                class="nav d-flex justify-content-center h4 text-center"
                role="tablist">
                <li class="nav-item" role="presentation">
                    <a href="{{route('mesas_res.index')}}"
                    class="nav-link text-white"
                    >Reservaciones de Mesas</a
                    >
                </li>
                <li class="nav-item" role="presentation">
                    <a href="{{route('mesas_reg.index')}}"
                    class="nav-link text-white"
                    >Registro de Mesas</a
                    >
                </li>
                </ul>
            </footer>
        </div>
        
        <!-- Catalogo de Productos -->
        <div class="" style="padding: 0; margin:0;">
            @yield('content')
        </div>
    </div>
     <!-- paginacion -->
     <div class="row container-fluid footer" style="padding: 0; margin:0;">
        @yield('pie')
    </div>

    <script src="/assets/jquery/jquery.js"></script>
    <script src={{ asset("js/core/bootstrap.bundle.min.js") }}></script>
    <script>
        (function () { 'use strict'
    
        var forms = document.querySelectorAll('.needs-validation')
    
        Array.prototype.slice.call(forms)
            .forEach(function (form) {
            form.addEventListener('submit', function (event) {
                if (!form.checkValidity()) {
                event.preventDefault()
                event.stopPropagation()
                }
    
                form.classList.add('was-validated')
            }, false)
            })
        })()
    
        function cancelar(ruta){
    
            Swal
            .fire({
                title: "Cancelar",
                text: "¿Desea cancelar lo que esta haciendo?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "Si",
                cancelButtonText: "No",
            })
            .then(resultado => {
                if (resultado.value) {
                    // Hicieron click en "Sí"
                    window.location.href = '/'+ruta;
                } else {
                    // Dijeron que no
                }
            });
    
        }
        </script>
    
@endsection