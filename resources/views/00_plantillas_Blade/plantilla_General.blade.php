<!DOCTYPE html>
<html lang="en">

<head>

    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <link rel="apple-touch-icon" sizes="76x76" href="./assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="./assets/img/favicon.png">
        <title>Villa Crisol - @yield('title') </title>

        <!-- Icons -->
        <link href={{ asset('css/nucleo-icons.css') }} rel="stylesheet" type="text/css">
        <link href={{ asset('css/nucleo-svg.css') }} rel="stylesheet" />

        <!-- CSS Files -->
        <link id="pagestyle" href="{{ asset('css/argon-dashboard.css') }}" rel="stylesheet" />
        <link rel="stylesheet" href={{ asset('css/menuStyles.css') }} type="text/css">

        <script src="{{ asset("js/sweetalert2.all.min.js") }}"></script> 
    </head>

</head>

<body class="g-sidenav-show bg-gray-100">

    <div class="min-height-300 position-absolute w-100" style="background-color: #c21010ee"></div>
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-xl my-3 fixed-start ms-2 "
        id="sidenav-main">
        <div class="sidenav-header">
            <i class="fas fa-times p-3 cursor-pointer text-secondary opacity-5 position-absolute end-0 top-0 d-none d-xl-none"
                aria-hidden="true" id="iconSidenav"></i>
            <a class="navbar-brand m-0" href={{ route('index') }}>
                <img src="./assets/img/logo-ct-dark.png" class="navbar-brand-img h-100" alt="main_logo">
                <span class="ms-1 font-weight-bold">INICIO</span>
            </a>
        </div>
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  w-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link active" href={{ route('menuAdmon.index') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-tv-2 text-primary text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Restaurante</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href={{ route('registro') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Registro plantilla</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href={{ route('t') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-calendar-grid-58 text-warning text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Tables</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href={{ route('b') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-credit-card text-success text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Billing</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href="#">
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-app text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Virtual Reality</span>
                    </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href={{ route('r') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-world-2 text-danger text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">RTL</span>
                    </a>
                </li>
                <li class="nav-item mt-1">
                    <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6">Account pages</h6>
                </li>
                <li class="nav-item">
                    <a class="nav-link " href={{ route('p') }}>
                        <div
                            class="icon icon-shape icon-sm border-radius-md text-center me-2 d-flex align-items-center justify-content-center">
                            <i class="ni ni-single-02 text-dark text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Profile</span>
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
                    <a class="nav-link " href="./pages/sign-up.html">
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

    <main class="main-content position-relative border-radius-lg">

        <div class="mb-0 col-12 text-start">
            <div class="row" style="display:flex; justify-content: space-between;">

                <div class="col-4">

                    <div class="row" style="display:flex; justify-content: space-between; align-items:center">

                        <!-- ========== Start Botones de Registro ========== -->

                        <div class="col">
                            <span class=" text-success text-sm font-weight-bolder "></span>
                            <a href={{ route('bebidasyplatillos.create') }} class="btn btn-menu my-3">Registrar Comida
                                o Bebida</a>
                        </div>

                        <div class="col">
                            <span class="col-4 text-success text-sm font-weight-bolder "></span>
                            <a href={{ route('combo.create') }} class="btn btn-menu my-3">Registrar Combo</a>
                        </div>


                        <!-- ========== End Botones de Registro ========== -->
                        <div class="col">
                            <span class="col-4 text-success text-sm font-weight-bolder "></span>
                            <a href={{ route('cliente_menu.qr') }} class="btn btn-menu my-3">Ver QR</a>
                        </div>
                        {{-- Boton QR --}}
                    </div>

                </div>

                <div class=" col-8" style="display:flex; ">

                    <div class="row">
                        <!-- ========== Start Barra de busqueda y filtros ========== -->

                        <div style=" display:block; float:right; padding-top:20px">
                            <form action="{{ route('busqueda.index') }}" method="get" role="search"
                                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                                <div class="input-group">
                                    <input class="form-control" type="search" id="busqueda" name="busqueda"
                                        style="width: 200px" placeholder="Buscar por nombre" aria-label="Search"
                                        aria-describedby="basic-addon2" maxlength="50" required
                                        value="<?php if (isset($busqueda)) {
                                            echo $busqueda;
                                        } ?>" />
                                    <div class="input-group-append">
                                        <button class="btn btn-menu my-2 my-sm-0"
                                            type="submit"><strong>Buscar</strong></button>
                                    </div>
                            </form>

                            <form class="form-inline">
                                <select
                                    style="outline: 0; padding: 0px; border-radius: 9px; height: 40px; margin-left: 12px; border: 2px solid rgb(85, 178, 85">
                                    <option value="FILTRAR POR"><strong>FILTRAR POR</strong></option>
                                    <option value="Orden Alfabético">Orden Alfabético</option>
                                    <option value="Precio más alto">Precio más alto</option>
                                    <option value="Precio más bajo">Precio más bajo</option>
                                    <option value="Mas Reciente">Mas reciente</option>
                                    <option value="Mas antiguo">Mas antiguo</option>
                                </select>
                            </form>

                            <form>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="1" value="option1"
                                        style="margin-left: 0.0px">
                                    <label class="form-check-label" for="1"
                                        style="color:black"><strong>Platillos</strong></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="2" value="option2"
                                        style="margin-left: 0.0px">
                                    <label class="form-check-label" for="2"
                                        style="color:black"><strong>Bebidas</strong></label>
                                </div>
                                <div class="form-check form-check-inline">
                                    <input class="form-check-input" type="checkbox" id="3" value="option3"
                                        style="margin-left: 0.0px">
                                    <label class="form-check-label" for="3"
                                        style="color:black"><strong>Combos</strong></label>
                                </div>
                            </form>
                        </div>

                        <!-- ========== End Barra de busqueda y filtros ========== -->
                    </div>
                </div>
            </div>
        </div>
        <div class="row float-center p-3">

            {{-- Cantidad de Platillos disponibles --}}
            @yield('info')

        </div>
        
        @yield('activatedMenu')
        @yield('disabledMenu')

    </main>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
    <script src={{ asset("js/scripts.js") }}></script>

</body>

</html>
