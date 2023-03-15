<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="./assets/img/favicon.png">
        <title>Villa Crisol - @yield('title') </title>

        <!-- Icons -->
        <script src="https://use.fontawesome.com/releases/v6.1.0/js/all.js" crossorigin="anonymous"></script>
        <link href={{ asset('css/nucleo-icons.css') }} rel="stylesheet" type="text/css">
        <link href={{ asset('css/nucleo-svg.css') }} rel="stylesheet" />

        <!-- CSS Files -->
        <link id="pagestyle" href="{{ asset('css/argon-dashboard.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href={{ asset('css/menuStyles/menuStyles.css') }} type="text/css">

        <script src="{{ asset('js/sweetalert2.all.min.js') }}"></script>
    </head>
    <style media="screen">
        #r{
            background-color: rgba(2, 102, 0, 0.727);
        }
        li:active a, li:focus-visible, li:hover{
            background-color: rgba(2, 102, 0, 0.168);
        }
      </style>
<body class=" g-sidenav-show bg-gray-100" style="">
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-2 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href={{ route('index') }}>
                <img src="/img/Villacrisol.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">INICIO</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  h-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Restaurante</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href={{ route('menuAdmon.index') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-bell-55 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Menú Admón</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href={{ route('cliente_prueba') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Cliente</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href={{ route('pedidost.pedido') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-archive-2 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Caja</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href={{ route('pedidosp.pedido') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tablet-button text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Cocina</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Reservaciones</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href={{ route('kiosko.index') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-shop text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kioskos</span>
                    </a>
                </li>
                <li cFlass="nav-item">
                    <a class="nav-link " href="{{route('mesas_res.index')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-app text-sm text-primary opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Mesas</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('cliente.reservaLocal')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Local</span>
                    </a>
                </li>
                <li class="nav-item mt-3">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Piscina</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href={{ route('prodpiscina.index') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Productos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href={{ route('s') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-copy-04 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Sign In</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{route('u')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-collection text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Sign Up</span>
                    </a>
                </li>
            </ul>
        </div>
        
    </aside>
    <div style="margin-left: 15px;margin-right:15px;"> 
    <main class="main-content" style="padding: 0px 0px 0px 0px; margin: 5px 0px 40px 250px;">
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
        <nav aria-label="breadcrumb">
            <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5">
                <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                    href="{{route('index')}}">Inicio</a></li>
                @yield('miga')
            </ol>
            
        </nav>
        <div class="" style="padding: 0; margin:0;">
            @yield('content')
        </div>
        <div class="row container-fluid footer" style="padding: 0; margin:0;">
            @yield('pie')
        </div>
    </main>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous">
    </script>
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
</body>

</html>
