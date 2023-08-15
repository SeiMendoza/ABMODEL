<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>
       Menú | Villa Crisol
    </title>

    <!-- Icons -->
    <link href={{ asset('/css/nucleo-icons.css') }} rel="stylesheet" type="text/css" />
    <link href={{ asset('/css/nucleo-svg.css') }} rel="stylesheet" />
    <link href="/assets/css/fontawesome.css" rel="stylesheet">
    <link href="/assets/css/solid.css" rel="stylesheet">
    <link href="/assets/css/brands.css" rel="stylesheet">
    <link href="/assets/fontawesome/css/font-awesome.min.css" rel="" media="all">
    <link rel="stylesheet" href={{ url('css/app.css') }}>

    <!-- CSS Files -->
    <!-- <link id="pagestyle" href="/css/argon-dashboard.css?v=2.0.4" rel="stylesheet"> -->
    <link href="/css/argon-dashboard.min.css" rel="stylesheet" media="all">
    <link href="/css/main.css" rel="stylesheet" media="all">

    @livewireStyles
    <script src="{{ asset("js/sweetalert2.all.min.js") }}"></script>

    <style>
        .mostrar {
            display: block !important;
            transform: translateX(100);
        }

        .ocultar {
            transform: translateX(-0%);
        }

        .d{
            padding: 0px; width:99%; 
            height:213px; margin:0px 5px 2px 0;
            border-radius:0%;
            text-align:center; 
        }

        .clasemmlona{
            width: 100%; 
            background-color:rgba(255, 255, 255, 0.677); 
            height:213px;
            text-align:center; 
        }

        @media all and (min-height: 300px) {
            #pedidoT{
                height:30%; 
            }
            #productosP{
                height:65%;
            }
        }
        @media all and (min-height: 350px) {
            #pedidoT{
                height:35%; 
            }
            #productosP{
                height:68%;
            }
        }
        @media all and (min-height: 375px) {
            #pedidoT{
                height:35%; 
            }
            #productosP{
                height:71%;
            }
        }
        @media all and (min-height: 400px) {
            #pedidoT{
                height:40%; 
            }
            #productosP{
                height:73%;
            }
        } 
        @media all and (min-height: 450px) {
            #pedidoT{
                height:50%; 
            }
            #productosP{
                height:75%;
            }
        } 
        @media all and (min-height: 500px) {
            #pedidoT{
                height:55%; 
            }
            #productosP{
                height:77%;
            }
        }
        @media all and (min-height: 525px) {
            #pedidoT{
                height:60%; 
            }
            #productosP{
                height:79%;
            }
        }
        @media all and (min-height: 538px) {
            #productosP{
                height:81.5%;
            }
        }
        @media all and (min-height: 550px) {
            #pedidoT{
                height:67%; 
            }

            #productosP{
                height:84%; 
            }
        }
        @media screen and (min-heigth: 600px) {
            #pedidoT{ 
                height:70%; 
            }
            #productosP{
                height:85%;
            }
        }

    </style>
</head>
<body class="" style="">
    <div style="overflow: auto;" class=" h-100">
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
        <div class="content-cell" style="margin: 0px; padding:0; max-height: 100%;">
            <div class="row h-100vh" style="margin: 0px; padding:0;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-table-cell" style="margin: 0px; padding:0; max-height: 100%;">
                    <div class="row" style="margin: 0px; padding:0;">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7 col-xl-7 d-table-cell" 
                            style="margin: 0px; padding:0; position:fixed; height: 100%; left:0%;" >
                            <div class="table-responsive-lg" style="margin: 0px; padding:0;">
                                <nav aria-label="breadcrumb" style=" margin: 0px; padding:0;" class="bg-gradient-warning">
                                    <ol class="breadcrumb bg-success" 
                                         style="margin: 0; border-radius:0px; padding:0; width:100% position:fixed;">
                                        <li style="width:15%">
                                            <div class="col" style="padding: 0px;">
                                                <a class="navbar-brand m-0" href={{ route('index') }} style="padding:0%; margin:0">
                                                    <img src="/img/Villacrisol.png" class="navbar-brand-img" alt="main_logo" style="width: 100%; height: 49px; padding:0%; margin:0">
                                                </a>
                                            </div>
                                        </li>
                                        <li class="d-flex justify-content-center" style="margin: 8px; width:70%">
                                            <H3 class="text-white"><strong>Menú del Día</strong></H3>
                                        </li>
                                        <li class="nav-item d-md-none d-lg-none d-xl-none d-xs d-sm-table d-sm-table-cell d-flex align-items-center" 
                                            style="margin: 8px;">
                                            <div id="" style="padding-left: 15px">
                                                <button style="margin:0px; padding:4px; position:absolute; right:1%; top:8px;" type="button" 
                                                class="bg-light border-radius-sm text-center subMenu" id="subMenu" name="subMenu">
                                                <span class="badge badge-pill badge-dark text-success">
                                                    {{--\Cart::getTotalQuantity()--}}
                                                    <i class="fa fa-shopping-cart text-success"></i> {{ count(\Cart::getContent())}}
                                                </span>
                                            </div>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="table-responsive" id="productosP" style="display:block; float:left;
                            margin: 0px; margin-top:2px; padding:0; position:absolute; left:5px;">
                                <section style="">
                                    <main class=" main-content">
                                        <div class="tab-content" style="margin: 0px; padding:0; ">
                                            <div >
                                                
                                                <livewire:pedidos.menu/>
                                            </div>
                                        </div>
                                    </main>
                                </section>
                            </div>
                            <div class="table-responsive-sm table-responsive-md table-responsive-lg col-12" 
                                style="text-align:center;margin: 0; padding:0; position:fixed;">
                                <nav aria-label="breadcrumb" style=" margin: 0px; padding:0;" class="bg-gradient-warning">
                                    <ol class="breadcrumb nav navbar-expand bg-success d-flex justify-content-center
                                    d-sm-flex col col-12 col-sm-12 col-md-6 col-lg-7 col-xl-7 d-table-cell" 
                                         style="margin: 0; border-radius:0px; padding: 5px 3px 7px 3px; position:fixed; bottom:0%">
                                        <li class="" role="button" style="display:block;">
                                            <a href="{{route('menu.index')}}" style="margin:1px 3px 1px 3px; padding:10px; font-size:15px" type="button" 
                                                class="bg-light border-radius-sm text-center">
                                                <i class="fa-solid fa-utensils text-success"></i> Menú completo 
                                            </a>
                                        </li>
                                        <li class=" d-none d-xl-table" role="button">
                                            <a href="{{route('menu.bebidas')}}" style="margin:1px 3px 1px 3px; padding:10px; width:150px; font-size:15px" type="button" 
                                            class="bg-light border-radius-sm text-center">
                                            <i class="fa-solid fa-wine-glass text-info"></i> Bebidas
                                            </a> 
                                        </li>
                                        <li class="d-none d-xl-table" role="button">
                                            <a href="{{route('menu.platillos')}}" style="margin:1px 3px 1px 3px; padding:10px; width:150px; font-size:15px" type="button" 
                                            class="bg-light border-radius-sm text-center">
                                            <i class="fa-solid fa-drumstick-bite text-warning"></i> Platillos
                                            </a>
                                        </li>
                                        <li class="d-none d-xl-table" role="button">
                                            <a href="{{route('menu.complementos')}}" style="margin:1px 3px 1px 3px; padding:10px; width:150px; font-size:15px" type="button" 
                                                class="bg-light border-radius-sm text-center">
                                                <i class="fa-solid fa-plus-circle text-primary"></i> Complementos
                                            </a>
                                        </li>
                                        <li class=" d-xl-none d-flex align-items-center" style="display:block; float: right;">
                                            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                                <div class="sidenav-toggler-inner">
                                                    
                                                        <a href="javascript:;" class="nav-link 
                                                            border-radius-sm text-center font-weight-bold px-0 bg-light" type="button" 
                                                            style="margin:1px 3px 1px 3px; padding:10px; width:100px; font-size:15px"
                                                            id="dropdownMenuButton"  data-bs-toggle="dropdown" aria-expanded="false">
                                                            <i class="fa-solid fa-plus"></i> Más
                                                        </a>
                                                        
                                                        <!-- Usar Informacion -->
                                                        <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in"
                                                        aria-labelledby="userDropdown">
                                                            <a class="dropdown-item" href="{{route('menu.bebidas')}}">
                                                            <i class="fa-solid fa-wine-glass text-info"></i>
                                                                Bebidas
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="{{route('menu.platillos')}}">
                                                                <i class="fa-solid fa-drumstick-bite text-warning"></i>
                                                                Platillos
                                                            </a>
                                                        
                                                            <div class="dropdown-divider"></div>
                                                    
                                                            <a class="dropdown-item" href="{{route('menu.complementos')}}" data-toggle="modal" data-target="logoutModal">
                                                                <i class="fa-solid fa-plus-circle text-primary"></i>
                                                                Complementos
                                                            </a>
                                                        </div>
                                                
                                                </div>
                                            </a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        
                        <livewire:pedidos.detalles-pedido />
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Scripts -->
    
    @livewireScripts
    <script src="/assets/jquery/jquery.js"></script>
    <script src="/assets/jquery/jquery.min.js"></script>
    <script src={{ asset("js/core/bootstrap.bundle.min.js") }}></script>
    <script src={{ asset('/js/plugins/perfect-scrollbar.min.js') }}></script>
    <script src={{ asset('/js/plugins/smooth-scrollbar.min.js') }}></script>
    <script>   
        function enviar() {
            var formul = document.getElementById("formulario");
            formul.submit();
        }

        function proenviar(id) {
            try {
                var c = parseFloat(document.getElementById("dis-" + id).value) || 0;
                if (c <= 0) {
                    var ms = 'No hay productos disponibles';
                    Swal.fire({
                        position: 'top-end',
                        icon: 'warning',
                        title: ms,
                        showConfirmButton: false,
                        toast: true,
                        background: '#fff',
                        timer: 5500
                    })
                    var but = document.getElementById("p-" + id);
                    but.classList.add("clasemmlona");
                } else {
                    if (c >= 1) {
                    var formul = document.getElementById("producto-" + id);
                    formul.submit(); 
                    }
                    
                }

            } catch (e) {
                var ms = 'Ups!! hubo un problema';
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
            
        }
        function eliminar(){
            Swal
            .fire({
                title: "Cancelar",
                text: "¿Desea cancelar el pedido?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "Si",
                cancelButtonText: "No",
            })
            .then(resultado => {
                if (resultado.value) {
                    // Hicieron click en "Sí"
                    var formul = document.getElementById("Fcancelar");
                    formul.submit();
                } else {
                    // Dijeron que no
                }
            });
        }
    </script>
    <script>
        const subMenu = document.getElementById('subMenu');
        var x = document.getElementById('cerrar');
        //var fullPageMenu = document.getElementById('fullPageMenu')
        subMenu.addEventListener('click', pedido);
        x.addEventListener('click', pedido);

        function pedido() {
            var div = document.getElementById("pedido");
            if (div.classList.contains("mostrar")) {
                div.classList.remove("mostrar");
                div.classList.add("ocultar");
            } else {
                div.classList.remove("ocultar");
                div.classList.add("mostrar");
            }
        }
    </script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/js/argon-dashboard.min.js"></script>
    
</body>
</html>
