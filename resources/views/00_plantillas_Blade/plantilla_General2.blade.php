<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <!-- Icons -->
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/favicon.png">
    <link href="/assets/css/fontawesome.css" rel="stylesheet">
    <link href="/assets/css/solid.css" rel="stylesheet">
    <link href="/assets/css/brands.css" rel="stylesheet">
    <link href={{ asset('/css/nucleo-icons.css') }} rel="stylesheet" type="text/css">
    <link href={{ asset('/css/nucleo-svg.css') }} rel="stylesheet">
    
    <!-- CSS Files -->
    <link id="pagestyle" href="/css/argon-dashboard.css?v=2.0.4" rel="stylesheet">
    <link href="/assets/select2/select2.min.css" rel="stylesheet" media="all">
    <link href="/assets/datepicker/daterangepicker.css" rel="stylesheet" media="all">
    <link rel="stylesheet" href="/DataTables/DataTables-1.13.4/css/jquery.dataTables.css">
    <link rel="" href="/DataTables/DataTables-1.13.4/css/jquery.dataTables.min.css">
    <link href="/assets/mdi-font/css/material-design-iconic-font.min.css" rel="" media="all">
    <link href="/assets/fontawesome/css/font-awesome.min.css" rel="" media="all">
    
    <!-- Main CSS-->
    <link href="/css/main.css" rel="stylesheet" media="all">

    <script src="{{ asset('/js/sweetalert2.all.min.js') }}"></script>

    <title>Villa Crisol - @yield('title') </title>

    <style media="screen">
        #r{
            background-color: rgba(2, 102, 0, 0.727);
        }
        li:active a, li:focus-visible, li:hover{
            background-color: rgba(2, 102, 0, 0.168);
        }
        div, ul, h4{
            font-family: Arial;
            text-transform:initial;
        }
        table{
            font-size: 17px;
            color: gray; 
        }
        thead{
            background-color: rgba(0, 99, 48, 0.085);
        }
        label, input{
            font-size: 15px;
            color: gray;
        }
    </style>
</head>
<body class="">
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
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Restaurante</h6>
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
                    <a class="nav-link " href="{{route('cliente.reservaLocal')}}">
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
                            <i class="ni ni-bell-55 text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Administración de menú</span>
                    </a>
                </li>
                <li cFlass="nav-item">
                    <a class="nav-link " href="{{route('mesas_reg.index')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-table text-sm text-info opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Mesas</span>
                    </a>
                </li>
                <li cFlass="nav-item">
                    <a class="nav-link " href="{{route('kiosko.index')}}">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="fa-solid fa-store text-sm text-info opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">kioskos</span>
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
        <main class="main-content" style="padding: 0px; margin: 5px 0px 40px 250px;">
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
            <nav class="navbar navbar-main navbar-expand-lg px-0  shadow-none border-radius-xl " id="navbarBlur" style="padding-bottom:15px"
                data-scroll="false">
                <div class="" style="margin: 0; padding:0;">
                    <nav aria-label="breadcrumb">
                        <ol class="breadcrumb bg-transparent mb-0 pb-0 pt-1 px-0 me-sm-6 me-5 font-robo" style="margin-left:15px;">
                            <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
                                href="{{route('index')}}">Inicio</a></li>
                            @yield('miga')
                        </ol>
                        @yield('m')
                    </nav>
                    <div class="collapse navbar-collapse mt-sm-0 mt-2 me-md-0 me-sm-4" id="navbar">
                        @yield('b')
                    </div>
                </div>
            </nav>
            
            <div class="font-robo ali" style="padding: 0; margin:15px;">
                @yield('content')
            </div>
            <div class="row container-fluid footer font-robo" style="padding: 0; margin:0;">
                @yield('pie')
            </div>
        </main>
    </div>
    <script src="/assets/jquery/jquery.js"></script>
    <script src="/assets/jquery/jquery.min.js"></script>
    <script src="/DataTables/DataTables-1.13.4/js/jquery.dataTables.js"></script>
    <script src="/DataTables/DataTables-1.13.4/js/jquery.dataTables.min.js"></script> 
    <script src="/assets/select2/select2.min.js"></script>
    <script src="/assets/datepicker/moment.min.js"></script>
    <script src="/assets/datepicker/daterangepicker.js"></script>
    <script>
        $(document).ready(function () {
        $('#example').DataTable();
        });

        //DATATABLES para Menú
        $(document).ready(function () {
        $('.menu').DataTable();
        });


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
    <script src="/js/global.js"></script>
    <script src={{ asset('/js/core/popper.min.js') }}></script>
    <script src={{ asset('/js/core/bootstrap.min.js') }}></script>
    <script src={{ asset('/js/plugins/perfect-scrollbar.min.js') }}></script>
    <script src={{ asset('/js/plugins/smooth-scrollbar.min.js') }}></script>
    <script src={{ asset('/js/plugins/chartjs.min.js') }}></script>
</body>
</html>