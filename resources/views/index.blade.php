<!--
=========================================================
* Argon Dashboard 2 - v2.0.4
=========================================================

* Product Page: https://www.creative-tim.com/product/argon-dashboard
* Copyright 2022 Creative Tim (https://www.creative-tim.com)
* Licensed under MIT (https://www.creative-tim.com/license)
* Coded by Creative Tim

=========================================================

* The above copyright notice and this permission notice shall be included in all copies or substantial portions of the Software.
-->
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="apple-touch-icon" sizes="76x76" href="/img/apple-icon.png">
    <link rel="icon" type="image/png" href="/img/faviconVillaCrisol.png">
    <title>
        Villa Crisol
    </title>
    <!-- Nucleo Icons -->
    <link href="/assets/css/fontawesome.css" rel="stylesheet">
    <link href="/assets/css/solid.css" rel="stylesheet">
    <link href="/assets/css/brands.css" rel="stylesheet">
    <link href={{ asset("/css/nucleo-icons.css") }} rel="stylesheet" type="text/css">
    <link href={{ asset("/css/nucleo-svg.css") }} rel="stylesheet"/>
 
  <!-- CSS Files -->
  <link id="pagestyle" href="/css/argon-dashboard.css?v=2.0.4" rel="stylesheet"/>
  <link href="/css/main.css" rel="stylesheet" media="all">

  <script src="{{ asset("/js/sweetalert2.all.min.js") }}"></script> 
  <style media="screen">
    li:active a, li:focus-visible, li:hover{
        background-color: rgba(111, 143, 175, 0.319);
    }
    div, ul, h4{
        font-family: Arial;
        text-transform:initial;
    }
    label, input{
        font-size: 15px;
        color:rgba(111, 143, 175, 0.319);
    }
</style>
</head>

<body class="g-sidenav-show bg-gray-100" style="">
    <script>
        var msg = '{{Session::get('mensaje')}}';
        var exist = '{{Session::has('mensaje')}}';
        if(exist){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: msg,
                showConfirmButton: false,
                toast: true,
                background: '#0be004ab',
                timer: 5500
            })
        }
    </script>
    <header id="main-header" class="" style="background-color: rgb(111, 143, 175);">
        <div class="" style="margin:0 0 0 0%; width:16.4%; padding:0%; display:block; float:left">
            <a class="navbar-brand m-0" href={{ route('index') }} style="padding:0%; margin:0">
                <div style="width: 100%; height:90px; text-align:center; background-color: white;">
                    <img src="/img/Villacrisol.png" class="navbar-brand-img" alt="main_logo" style="width: 150px; height:90px;">
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
                                    href="{{route('index')}}">Inicio</a></li>
                        </ol>
                        <h2 class="font-weight-bolder text-white " style="margin:0">Villa Crisol</h2>
                    </nav> 
                    <div class="collapse navbar-collapse " id="navbar">
                        <div class="ms-md-auto pe-md-3 d-flex align-items-center"style="margin-top: 2.5%">   
                            <div class="input-group">
                                <span class="input-group-text text-body"><i class="fas fa-search"
                                        aria-hidden="true"></i></span>
                                <input type="text" class="form-control" placeholder="Busqueda..." name="buscar" id="buscar">
                            </div>
                        </div>
                        <ul class="navbar-nav  justify-content-end">
                            <li class="nav-item d-flex align-items-center">
                                <a href="javascript:;" class="nav-link text-white font-weight-bold px-0">
                                    <i class="ni ni-badge me-sm-1"></i>
                                    <span class="d-sm-inline d-none">
                                        usuario
                                    </span>
                                </a>
                            </li>
                            <li class="nav-item d-xl-none ps-3 d-flex align-items-center">
                                <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                    <div class="sidenav-toggler-inner">
                                        <i class="sidenav-toggler-line bg-white"></i>
                                        <i class="sidenav-toggler-line bg-white"></i>
                                        <i class="sidenav-toggler-line bg-white"></i>
                                    </div>
                                </a>
                            </li>
                            <li class="nav-item px-3 d-flex align-items-center">
                                <a href="javascript:;" class="nav-link text-white p-0">
                                    <i class="ni ni-diamond fixed-plugin-button-nav cursor-pointer"></i>
                                </a>
                            </li>
                            <li class="nav-item dropdown pe-2 d-flex align-items-center">
                                <a href="javascript:;" class="nav-link text-white p-0" id="dropdownMenuButton"
                                    data-bs-toggle="dropdown" aria-expanded="false">
                                    <i class="ni ni-bell-55 cursor-pointer"></i>
                                </a>
                                <ul class="dropdown-menu  dropdown-menu-end  px-2 py-3 me-sm-n4"
                                    aria-labelledby="dropdownMenuButton">
                                    <li>
                                        <a class="dropdown-item border-radius-md" href="{{Route('piscina.create')}}">
                                            <div class="d-flex py-1">
                                                <div class="avatar avatar-sm bg-black  me-3  my-auto">
                                                    <i class="fa-solid fa-person-swimming text-info fa-3x"></i>
                                                </div>
                                                <div class="d-flex flex-column justify-content-center">
                                                    <h6 class="text-sm font-weight-normal mb-1">
                                                        Existencia de productos de piscina
                                                    </h6>
                                                    <p class="text-xs text-secondary mb-0">
                                                        @foreach($datosalerta as $d) 
                                                            Productos de piscina en {{$d->descripcion}} tiene {{$d->total}}
                                                            unidades con {{$d->peso}}  
                                                            @if ($d->descripcion == "Polvo") 
                                                                Libras 
                                                            @else 
                                                                Onzas 
                                                            @endif
                                                            <br>
                                                        @endforeach
                                                    </p>
                                                </div>
                                            </div>
                                        </a>
                                    </li>

                                </ul>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
        </div>
    </header>
    <aside
        class="sidenav bg-white navbar navbar-vertical navbar-expand-xs border-0 border-radius-top-end-0 fixed-start"
        id="sidenav-main"
        style="margin:90px 0 0 0">
        <hr class="horizontal dark mt-0">
        <div class="collapse navbar-collapse  h-auto " id="sidenav-collapse-main">
            <ul class="navbar-nav">
                <h6 class="ps-4 ms-2 text-uppercase text-xs font-weight-bolder opacity-6" style="margin: 4% 0 0 0">Restaurante</h6>
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
                            <i class="fa-solid fa-burger text-info text-sm opacity-10"></i>
                        </div>
                        <span class="nav-link-text ms-1">Menú</span>
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
            </ul>
        </div>
    </aside>

    <main class="main-content" id="indice" style="padding:0; margin: 90px 1% 0% 17.3%;">
        <div class="content-cell" style="padding:0; margin:0">
            <!-- Cards Restaurante -->
            <div class="row pt-3" style="margin: 0; padding:0;">
                <h4 style="margin-bottom: 15px; padding:0%;" class="bg-white text-warning font-robo font-weight-bolder">RESTAURANTE</h4>
                <div class="row" style="margin: 0px; padding:0;">
                    <a href="{{ route('cliente_prueba') }}" class="card height-200 btn col-xl-3 mb-xl-0 mb-2"
                        data-id="" style="margin:0px; border-radius:0%;">
                        <div class="text-center" style="text-align:center; padding: 0px;">   
                            <div class="" style="margin-top: 5%">
                                <i class="fa-solid fa-utensils fa-8x text-warning"></i>
                            </div>             
                            <!-- Nombre -->
                                <p id="precio" class="text-white font-robo text-decoration-line">
                                    <strong class="h-25" style="font-size: 30px; width:100%; 
                                    background-color:rgba(255, 0, 0, 0.504);
                                    position: absolute; bottom: 0; left:0;">Pedido</strong>
                                </p>         
                        </div>
                    </a>
                    <a href="{{route('pedidos.caja')}}" class="card btn height-200 col-xl-3 mb-xl-0 mb-2"
                    data-id="" style="border-radius:0%; margin:0px 10px 0px 10px;">
                    <div class="text-center" style="text-align:center; padding: 0px;">   
                        <div class="" style="margin-top: 5%">
                            <i class="fa-solid fa-cash-register fa-8x text-warning" ></i>
                        </div>             
                        <!-- Nombre -->
                            <p id="precio" class="text-white font-robo text-decoration-line">
                                <strong class="h-25" style="font-size: 30px; width:100%; 
                                background-color:rgba(255, 0, 0, 0.504);
                                position: absolute; bottom: 0; left:0;">Caja</strong>
                            </p>         
                    </div>
                    </a>
                    <a href="{{route('pedidosp.pedido')}}" class="card btn height-200 col-xl-3 mb-xl-0 mb-2"
                        data-id="" style="margin:0px 10px 0px 0px; border-radius:0%;">
                        <div class="text-center" style="text-align:center; padding: 0px;">   
                            <div class="" style="margin-top: 5%">
                                <i class="fa-solid fa-kitchen-set fa-8x text-warning"></i>
                            </div>             
                            <!-- Nombre -->
                                <p id="precio" class="text-white font-robo text-decoration-line">
                                    <strong class="h-25" style="font-size: 30px; width:100%; 
                                    background-color:rgba(255, 0, 0, 0.504);
                                    position: absolute; bottom: 0; left:0;">Cocina</strong>
                                </p>         
                        </div>
                    </a>
                </div> 
            </div>
            <!-- Cards Reservaciones -->
            <div class="row pt-3" style="margin:0px; padding:0px;">
                <h4 style="margin-bottom: 15px; padding:0%;" class="bg-white text-success font-robo font-weight-bolder">RESERVACIONES</h4>
                <div class="row" style="margin:0px; padding:0px">
                    <a href="{{ route('kiosko_res.index') }}" class="card btn height-200 col-xl-3 mb-xl-0 mb-2"
                    data-id="" style="border-radius:0%; margin:0px;">
                    <div class="text-center" style="text-align:center; padding: 0px;">   
                        <div class="" style="margin-top: 5%">
                            <i class="fa-solid fa-store fa-8x text-success" style=""></i>
                        </div>             
                        <!-- Nombre -->
                            <p id="precio" class="text-white font-robo text-decoration-line">
                                <strong class="h-25" style="font-size: 30px; width:100%; 
                                background-color:rgba(0, 173, 12, 0.504);
                                position: absolute; bottom: 0; left:0;">Kioskos</strong>
                            </p>         
                    </div>
                    </a>
                    <a href="{{route('cliente.reservaLocal')}}" class="card btn height-200 col-xl-3 mb-xl-0 mb-2"
                        data-id="" style="margin:0px 10px 0px 10px;; border-radius:0%;">
                        <div class="text-center" style="text-align:center; padding: 0px;">   
                            <div class="" style="margin-top: 5%">
                                <i class="fa-solid fa-shop fa-8x text-success"></i>
                            </div>             
                            <!-- Nombre -->
                                <p id="precio" class="text-white font-robo text-decoration-line">
                                    <strong class="h-25" style="font-size: 30px; width:100%; 
                                    background-color:rgba(0, 173, 12, 0.504);
                                    position: absolute; bottom: 0; left:0;">Local</strong>
                                </p>         
                        </div>
                    </a>
                </div>
            </div>
            <!-- Cards Configuraciones -->
            <div class="row pt-3" style="margin:0px; padding:0px;" >
                <h4 style="margin-bottom: 15px; padding:0%;" class="bg-white text-info font-robo font-weight-bolder">CONFIGURACIONES</h4>
                <div class="row" style="margin:0px; padding:0px;">
                    <a href="{{ route('menuAdmon.index') }}" class="card height-200 btn col-xl-3 mb-xl-0 mb-2"
                        data-id="" style="margin:0px; border-radius:0%;">
                        <div class="text-center" style="text-align:center; padding: 0px;">   
                            <div class="" style="margin-top: 10%">
                                <i class="fa-solid fa-glass-water fa-6x text-info"></i>
                                <i class="fa-solid fa-burger fa-7x text-info"></i>
                            </div>             
                            <!-- Nombre -->
                                <p id="precio" class="text-white font-robo text-decoration-line">
                                    <strong class="h-25" style="font-size: 30px; width:100%; 
                                    background-color:rgba(0, 195, 255, 0.504);
                                    position: absolute; bottom: 0; left:0;">Menú</strong>
                                </p>         
                        </div>
                    </a>
                    <a href="{{route('kiosko.index')}}" class="card height-200 btn col-xl-3 mb-xl-0 mb-2"
                        data-id="" style="margin:0px 10px 0px 10px; border-radius:0%;">
                        <div class="text-center" style="text-align:center; padding: 0px;">   
                            <div class="" style="margin-top: 5%">
                                <i class="fa-solid fa-store fa-8x text-info"></i>
                            </div>             
                            <!-- Nombre -->
                                <p id="precio" class="text-white font-robo text-decoration-line">
                                    <strong class="h-25" style="font-size: 30px; width:100%; 
                                    background-color:rgba(0, 195, 255, 0.504);
                                    position: absolute; bottom: 0; left:0;">Kioskos</strong>
                                </p>         
                        </div>
                    </a>
                    <a href="{{route('mesas_reg.index')}}" class="card height-200 btn col-xl-3 mb-xl-0 mb-2"
                        data-id="" style="margin:0px 10px 0px 0px; border-radius:0%;">
                        <div class="text-center" style="text-align:center; padding: 0px;">   
                            <div class="" style="margin-top: 4%">
                                <i class="fa-regular fa-chair fa-9x text-info"></i>
                            </div>             
                            <!-- Nombre -->
                                <p id="precio" class="text-white font-robo text-decoration-line">
                                    <strong class="h-25" style="font-size: 30px; width:100%; 
                                    background-color:rgba(0, 195, 255, 0.504);
                                    position: absolute; bottom: 0; left:0;">Mesas</strong>
                                </p>         
                        </div>
                    </a>
                    <a href="{{ route('prodpiscina.index') }}" class="card height-200 btn col-xl-3 mb-xl-0 mb-2"
                    data-id="" style="margin:10px 10px 0px 0px; border-radius:0%;">
                    <div class="text-center" style="text-align:center; padding: 0px;">   
                        <div class="" style="margin-top: 0%">
                            <i class="fa-solid fa-person-swimming fa-10x text-info"></i>
                        </div>             
                        <!-- Nombre -->
                            <p id="precio" class="text-white font-robo text-decoration-line">
                                <strong class="h-25" style="font-size: 30px; width:100%; 
                                background-color:rgba(11, 198, 255, 0.504);
                                position: absolute; bottom: 0; left:0;">Piscina</strong>
                            </p>         
                    </div>
                </a>
                </div>
            </div>
        
            <footer class="footer pt-3">
                <div class="container-fluid">
                    <div class="row align-items-center justify-content-lg-between">
                        <div class="col-lg-6 mb-lg-0 mb-4">
                            
                        </div>
                        <div class="col-lg-6">
                            <ul class="nav nav-footer justify-content-center justify-content-lg-end">
                                <li class="nav-item">
                                    <div class="copyright text-center text-sm text-muted text-lg-start">
                                        ©
                                        <script>
                                            document.write(new Date().getFullYear())
                                        </script>,
                                        <i class="fa fa-sun"></i> by Abmodel
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </footer> 
        </div>   
    </main>

    <div class="fixed-plugin">
        
        <div class="card" style="height: 660px; bottom:10%;">
            <div class="card-header pb-0 pt-3 ">
                <div class="float-start">
                    <h5 class="mt-3 mb-0">Argon Configurator</h5>
                    <p>See our dashboard options.</p>
                </div>
                <div class="float-end mt-4">
                    <button class="btn btn-danger text-dark fixed-plugin-close-button">
                        X
                    </button>
                </div>
                <!-- End Toggle Button -->
            </div>
            <hr class="horizontal dark my-1">
            <div class="card-body pt-sm-3 pt-0 overflow-auto">
                <!-- Sidebar Backgrounds -->
                <div>
                    <h6 class="mb-0">Sidebar Colors</h6>
                </div>
                <a href="javascript:void(0)" class="switch-trigger background-color">
                    <div class="badge-colors my-2 text-start">
                        <span class="badge filter bg-gradient-primary active" data-color="primary"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-dark" data-color="dark"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-info" data-color="info"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-success" data-color="success"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-warning" data-color="warning"
                            onclick="sidebarColor(this)"></span>
                        <span class="badge filter bg-gradient-danger" data-color="danger"
                            onclick="sidebarColor(this)"></span>
                    </div>
                </a>
                <!-- Sidenav Type -->
                <div class="mt-3">
                    <h6 class="mb-0">Sidenav Type</h6>
                    <p class="text-sm">Choose between 2 different sidenav types.</p>
                </div>
                <div class="d-flex">
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2 active me-2" data-class="bg-white"
                        onclick="sidebarType(this)">White</button>
                    <button class="btn bg-gradient-primary w-100 px-3 mb-2" data-class="bg-default"
                        onclick="sidebarType(this)">Dark</button>
                </div>
                <p class="text-sm d-xl-none d-block mt-2">You can change the sidenav type just on desktop view.</p>
                <!-- Navbar Fixed -->
                <div class="d-flex my-3">
                    <h6 class="mb-0">Navbar Fixed</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="navbarFixed"
                            onclick="navbarFixed(this)">
                    </div>
                </div>
                <hr class="horizontal dark my-sm-4">
                <div class="mt-2 mb-5 d-flex">
                    <h6 class="mb-0">Light / Dark</h6>
                    <div class="form-check form-switch ps-0 ms-auto my-auto">
                        <input class="form-check-input mt-1 ms-auto" type="checkbox" id="dark-version"
                            onclick="darkMode(this)">
                    </div>
                </div>
            </div>
        </div>
    </div>
    
    <!--    jquery Files   -->
    <script src="/assets/jquery/jquery.js"></script>
    <script src="/assets/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
          $("#buscar").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#indice a").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
        </script>
    <!-- Core -->
    <script src={{ asset('/js/core/popper.min.js') }}></script>
    <script src={{ asset('/js/core/bootstrap.min.js') }}></script>

    <!-- Theme JS -->

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
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="{{asset('/js/argon-dashboard.min.js')}}"></script>
</body>

</html>
