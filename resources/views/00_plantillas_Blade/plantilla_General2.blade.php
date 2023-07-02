<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Icons -->
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/faviconVillaCrisol.png">
    <link href="/assets/css/fontawesome.css" rel="stylesheet">
    <link href="/assets/css/solid.css" rel="stylesheet">
    <link href="/assets/css/brands.css" rel="stylesheet">
    <link href={{ asset('/css/nucleo-icons.css') }} rel="stylesheet" type="text/css">
    <link href={{ asset('/css/nucleo-svg.css') }} rel="stylesheet">

    <!-- CSS Files -->

    <link href="/assets/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="/assets/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="/DataTables/DataTables-1.13.4/css/jquery.dataTables.css">
    <link rel="" href="/DataTables/DataTables-1.13.4/css/jquery.dataTables.min.css">
    <link href="/assets/mdi-font/css/material-design-iconic-font.min.css" rel="" media="all">
    <link href="/assets/fontawesome/css/font-awesome.min.css" rel="" media="all">

    <!-- Main CSS-->
    <link id="pagestyle" href="/css/argon-dashboard.css?v=2.0.4" rel="stylesheet">
    <link href="/css/main.css" rel="stylesheet" media="all">
    
    <script src="{{ asset('/js/sweetalert2.all.min.js') }}"></script>

    <title>Villa Crisol - @yield('title') </title>

    <style media="screen">
        li:active a,
        li:focus-visible,
        li:hover {
            background-color: rgba(111, 143, 175, 0.200);
        }

        div,
        ul,
        h2,
        h4,
        label,
        input,
        select,
        textarea {
            font-family: Arial;
            text-transform: initial;
        }

        .title,
        .t {
            color: rgb(111, 143, 175);
        }

        table {
            font-size: 17px;
            color: gray;
        }

        thead,
        .t {
            background-color: rgba(111, 143, 175, 0.147);
            color: rgb(111, 143, 175);
        }

        label,
        select,
        input,
        .form-control {
            font-size: 15px;
            color: rgb(111, 143, 175);
        }

        div .card {
            margin-top: 100px;
        }
    </style>
</head>

<body class="g-sidenav-show   bg-gray-100">
    <header id="main-header" class="he-ma" style="background-color: rgb(111, 143, 175);">
        <div class="" style="margin:0 0 0 0%; width:16.4%; padding:0%; display:block; float:left">
            <a class="navbar-brand m-0" href={{ route('index') }} style="padding:0%; margin:0">
                <div style="width: 100%; height:90px; text-align:center; background-color: white;">
                    <img src="/img/Villacrisol.png" class="navbar-brand-img" alt="main_logo"
                        style="width: 150px; height:90px;">
                </div>
            </a>
        </div>
        <div class="" style="margin:1% 0% 0 1%; width:81.6%; padding:0%; display:block; float:left">
            <nav class="navbar navbar-main navbar-expand-lg shadow-none border-radius-xl " id="navbarBlur"
                data-scroll="false" style="padding: 0;">
                <div class="container-fluid" style="padding: 0; height:70px;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent" style="margin: 0% 0 4% 0; padding:0">
                            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
                                    href="{{ route('index') }}">Inicio</a></li>
                            @yield('miga')
                        </ol>
                        <h2 class="font-weight-bolder text-white " style="margin:0">@yield('tit')</h2>
                    </nav>
                    <div class="collapse navbar-collapse " id="navbar">
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center"style="margin-top: 2.5%">
                        </div>
                        <ul class="navbar-nav  justify-content-end">
                            <li class="nav-item d-flex align-items-center" style="margin-top: 23px">
                                @yield('b')
                            </li>
                            <li class="nav-item d-xl-none ps-3 d-flex align-items-center" style="margin-top: 23px">
                                <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                    <div class="sidenav-toggler-inner">
                                        <i class="sidenav-toggler-line bg-white"></i>
                                        <i class="sidenav-toggler-line bg-white"></i>
                                        <i class="sidenav-toggler-line bg-white"></i>
                                    </div>
                                </a>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <aside class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-top-end-0 fixed-start"
        id="sidenav-main" style="margin:90px 0 0 0">
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  h-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6" style="margin: 4% 0 0 0">
                    Restaurante</h6>
                <li class="nav-item">
                    <a class="nav-link " href={{ route('cliente_prueba') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Pedido</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href={{ route('pedidos.caja') }}>
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
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Reservaciones</h6>
                <li class="nav-item">
                    <a class="nav-link " href={{ route('kiosko_res.index') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-shop text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kioskos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('cliente.reservaLocal') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-shop text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Local</span>
                    </a>
                </li>
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Configuraciones</h6>
                <li class="nav-item">
                    <a class="nav-link" href={{ route('menuAdmon.index') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-burger text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Menú</span>
                    </a>
                </li>
                <li cFlass="nav-item">
                    <a class="nav-link " href="{{ route('mesas_reg.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-table text-sm text-info opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Mesas</span>
                    </a>
                </li>
                <li cFlass="nav-item">
                    <a class="nav-link " href="{{ route('kiosko.index') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-store text-sm text-info opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Kioskos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href={{ route('prodpiscina.index') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-water-ladder text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Productos</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="{{ route('usuarios.users') }}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa fa-users text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Usuarios</span>
                    </a>
                </li> 
            </ul>
        </div>
    </aside>

    <main class="main-content" style="padding: 0px; margin: 93px 1% 0% 17.3%;">
    
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
        <div class="font-robo content-cell" style="">
            @yield('content')
        </div>
        <div class="row container-fluid footer font-robo" style="padding: 0; margin:0;">
            @yield('pie')
        </div>
    </main>

    <script src="/JQuery/jquery-3.7.0.js"></script>
    <script src="/JQuery/jquery-3.7.0.min.js"></script>
    <script src="/DataTables/DataTables-1.13.4/js/jquery.dataTables.js"></script>
    <script src="/DataTables/DataTables-1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="/assets/select2/select2.min.js"></script>
    <script src="/assets/datepicker/moment.min.js"></script>
    <script src="/assets/datepicker/daterangepicker.js"></script>
    <script>
        let table = new DataTable('#example', {});
    </script>

    <script>
        (function() {
            'use strict'

            var forms = document.querySelectorAll('.needs-validation')

            Array.prototype.slice.call(forms)
                .forEach(function(form) {
                    form.addEventListener('submit', function(event) {
                        if (!form.checkValidity()) {
                            event.preventDefault()
                            event.stopPropagation()
                        }

                        form.classList.add('was-validated')
                    }, false)
                })
        })()

        function cancelar(ruta) {

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
                        window.location.href = '/' + ruta;
                    } else {
                        // Dijeron que no
                    }
                });

        }

        function cancelarAct(mensaje, ruta) {
            Swal
                .fire({
                    title: "Cancelar Actualización",
                    text: mensaje,
                    icon: 'question',
                    showCancelButton: true,
                    confirmButtonText: "Si",
                    cancelButtonText: "No",
                })
                .then(resultado => {
                    if (resultado.value) {
                        // Hicieron click en "Sí"
                        window.location.href = '/' + ruta;
                    } else {
                        // Dijeron que no
                    }
                });
        }

        function cancelarMenu(origen) {

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
                        switch (origen) {
                            case 0: //complementos
                                window.location.href = '/admonRestauranteC';
                                break;
                            case 1: //bebidas
                                window.location.href = '/admonRestauranteB';
                                break;

                            case 2: //platillos
                                window.location.href = '/admonRestauranteP';
                                break;

                            default:
                                break;
                        }
                    } else {
                        // Dijeron que no
                    }
                });

        }

        $(document).ready(function() {
            // Agrega un evento "change" al elemento select con ID "producto_id"
            $('#producto_id,#cantidad').change(function() {
                var producto = $('#producto_id').val(); // Obtiene el ID del producto seleccionado
                var cantidad = parseFloat($('#cantidad').val());
                // Realiza una solicitud AJAX para obtener el precio del producto
                $.ajax({
                    url: '/precio-acompl',
                    type: 'POST',
                    data: {
                        producto: producto,
                        _token: '{{ csrf_token() }}'
                    },
                    success: function(response) {
                        var precio = parseFloat(response);
                        if (!isNaN(precio)) { // Verifica si el valor de precio es válido
                            var impuesto = cantidad * precio *
                                0.15; // Calcula el impuesto como el 15% del precio total
                            var sub_total = precio * cantidad - impuesto;
                            var total = precio * cantidad;
                            $('#precio').val(precio.toFixed(
                                2)); // Muestra el precio con 2 decimales
                            $('#impuesto').val(impuesto.toFixed(
                                2)); // Muestra el impuesto con 2 decimales
                            $('#sub_total').val(sub_total.toFixed(
                                2)); // Muestra el sub_total con 2 decimales
                            $('#total').val(total.toFixed(
                                2)); // Muestra el total con 2 decimales
                        }
                    },
                    error: function(xhr) {
                        console.log(xhr.responseText);
                    }
                });
            });
            // actualiza el precio del producto que esta seleccionado
            $('#producto_id').trigger('change');
        });
    </script>
    <script src="/js/global.js"></script>
    <script src="/js/kiosko.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/3.3.1/js/bootstrap.min.js"></script>
    <script src={{ asset('/js/core/popper.min.js') }}></script>
    <script src={{ asset('/js/core/bootstrap.min.js') }}></script>
    <script src={{ asset('/js/plugins/perfect-scrollbar.min.js') }}></script>
    <script src={{ asset('/js/plugins/smooth-scrollbar.min.js') }}></script>

    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }
    </script>

    <script src="/js/argon-dashboard.min.js"></script>
    <script src="{{ asset('js/app.js') }}"></script>
</body>

</html>
