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
            padding: 0px; width:98%; 
            height:210px; margin:0px 2px 2px 0;
            border-radius:0%;
            text-align:center; 
        }

        .clasemmlona{
            width: 100%; 
            background-color:rgba(255, 255, 255, 0.677); 
            height:213px;
            text-align:center; 
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
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-table-cell" style="margin: 0px; padding:0; max-height:100%;">
                    <div class="row" style="margin: 0px; padding:0;">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7 col-xl-7 d-table-cell" 
                            style="margin: 0px; padding:0; position:absolute; height:100%; left:0%;" >
                            <div class="table-responsive col-12" style="margin: 0px; padding:0;">
                                <nav aria-label="breadcrumb" style=" margin: 0px; padding:0;" class="bg-gradient-warning">
                                    <ol class="breadcrumb nav navbar-expand bg-success d-flex justify-content-center
                                     d-sm-flex col col-12 col-sm-12 col-md-6 col-lg-7 col-xl-7 d-table-cell" 
                                     style="margin: 0; border-radius:0px; height:49px; position:fixed; 
                                      left:0%; top:0;">
                                        <li style="width:100px; padding: 0px; margin:0;">
                                            <div class="col" style="padding: 0px; margin:0;">
                                                <a class="navbar-brand m-0" href={{ route('index') }} style="padding:0%; margin:0">
                                                    <img src="/img/Villacrisol.png" class="navbar-brand-img" alt="main_logo" 
                                                        style="width:100px; height: 48.5px; padding:0%; margin:0;
                                                        position:absolute; left:0; top:0px;">
                                                </a>
                                            </div>
                                        </li>
                                        <li class="d-flex justify-content-center" style="margin: 8px; width:99%">
                                            <H3 class="text-white"><strong>Menú del Día</strong></H3>
                                        </li>
                                        <li class="nav-item d-md-none d-lg-none d-xl-none d-xs d-sm-table d-sm-table-cell d-flex align-items-center" 
                                            style="margin: 8px;">
                                            @livewire('pedidos.mostrar')
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="table-responsive"
                            id="productosP" style="display:block; float:left; text-align:center; 
                            margin: 0; top:49px; padding:0; position:absolute; bottom:59px; left:2px;">
                                <section id="pedidos" style="">
                                    <main class=" main-content" style="margin: 0px; padding:0;">
                                        <div class="tab-content" style="margin: 0px; padding:0; overflow-x: hidden;">
                                            @yield('productos')
                                            {{--<livewire:pedidos.menu/>--}}
                                        </div>
                                    </main>
                                </section>
                            </div>
                            <div class="table-responsive col-12" 
                                style="text-align:center;margin: 0; padding:0; ">
                                <nav aria-label="breadcrumb" style=" margin: 0px; padding:0;" class="bg-gradient-warning">
                                    <ol class="breadcrumb nav navbar-expand bg-success d-flex justify-content-center
                                        d-sm-flex col col-12 col-sm-12 col-md-6 col-lg-7 col-xl-7 d-table-cell" 
                                         style="margin: 0; border-radius:0px; padding: 5px 3px 7px 3px; position:fixed; 
                                         left:0%; bottom:0%; height:58px;">
                                        <li class= role="button" style="display:block;">
                                            <a href="{{route('menu.menu')}}" style="margin:1px 3px 1px 3px; padding:10px; font-size:15px" type="button" 
                                                class="bg-light border-radius-sm text-center">
                                                <i class="fa-solid fa-utensils text-success"></i> Menú completo 
                                            </a>
                                        </li>
                                        <li class="" role="button">
                                            <a href="{{route('menu.bebidas')}}" style="margin:1px 3px 1px 3px; padding:10px 0px 10px 0px; width:85px; font-size:15px" type="button" 
                                            class="bg-light border-radius-sm text-center">
                                            <i class="fa-solid fa-wine-glass text-info"></i> Bebidas
                                            </a> 
                                        </li>
                                        <li class="" role="button">
                                            <a href="{{route('menu.platillos')}}"style="margin:1px 3px 1px 3px; padding:10px; width:90px; font-size:15px" type="button" 
                                            class="bg-light border-radius-sm text-center">
                                            <i class="fa-solid fa-drumstick-bite text-warning"></i> Platillos
                                            </a>
                                        </li>
                                        <li class="" role="button">
                                            <a href="{{route('menu.complementos')}}" style="margin:1px 3px 1px 3px; padding:10px; width:140px; font-size:15px" type="button" 
                                                class="bg-light border-radius-sm text-center">
                                                <i class="fa-solid fa-plus-circle text-primary"></i> Complementos
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
            var formul = document.getElementById("formul");
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
        const subMenu = document.getElementById('subMen');
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
