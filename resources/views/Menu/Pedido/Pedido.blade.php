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
            padding: 0px; width:213px; 
            height:213px; margin:0px 5px 2px 0;
            border-radius:0%;
            text-align:center;
            overflow-x: hidden;
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
<body class="" style="overflow-x: hidden;">
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
                                                    <i class="fa fa-shopping-cart text-success"></i> {{ \Cart::getTotalQuantity()}}
                                                </span>
                                            </div>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="table-responsive " id="productosP" style="display:block; float:left;;
                            margin: 0px; margin-top:2px; padding:0; position:absolute; left:5px;">
                                <section style="">
                                    <main class=" main-content">
                                        <div class="tab-content" style="margin: 0px; padding:0; ">
                                            <div class="row row-cols-xs-6 row-cols-sm-3 row-cols-md-2 row-cols-lg-3 row-cols-xl-4" 
                                                style="margin: 0px; padding:0; overflow-x:hidden;">
                                                @yield('productos')
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
                                            <a href="{{route('cart.index')}}" style="margin:1px 3px 1px 3px; padding:10px; font-size:15px" type="button" 
                                                class="bg-light border-radius-sm text-center">
                                                <i class="fa-solid fa-utensils text-success"></i> Menú completo 
                                            </a>
                                        </li>
                                        <li class=" d-none d-xl-table" role="button">
                                            <a href="{{route('cart.bebidas')}}" style="margin:1px 3px 1px 3px; padding:10px; width:150px; font-size:15px" type="button" 
                                            class="bg-light border-radius-sm text-center">
                                            <i class="fa-solid fa-wine-glass text-info"></i> Bebidas
                                            </a> 
                                        </li>
                                        <li class="d-none d-xl-table" role="button">
                                            <a href="{{route('cart.platillos')}}" style="margin:1px 3px 1px 3px; padding:10px; width:150px; font-size:15px" type="button" 
                                            class="bg-light border-radius-sm text-center">
                                            <i class="fa-solid fa-drumstick-bite text-warning"></i> Platillos
                                            </a>
                                        </li>
                                        <li class="d-none d-xl-table" role="button">
                                            <a href="{{route('cart.complementos')}}" style="margin:1px 3px 1px 3px; padding:10px; width:150px; font-size:15px" type="button" 
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
                                                            <a class="dropdown-item" href="{{route('cart.bebidas')}}">
                                                            <i class="fa-solid fa-wine-glass text-info"></i>
                                                                Bebidas
                                                            </a>
                                                            <div class="dropdown-divider"></div>
                                                            <a class="dropdown-item" href="{{route('cart.platillos')}}">
                                                                <i class="fa-solid fa-drumstick-bite text-warning"></i>
                                                                Platillos
                                                            </a>
                                                        
                                                            <div class="dropdown-divider"></div>
                                                    
                                                            <a class="dropdown-item" href="{{route('cart.complementos')}}" data-toggle="modal" data-target="logoutModal">
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
                        <div class="d-none d-sm-none d-md-table bg-white ;
                            col-md-6 d-lg-table col-lg-5 d-xl-table col-xl-5 d-table-cell ocultar" 
                            style="display:block; margin: 0px; height:100%; 
                            padding:0%; position:fixed; right:0%; top:0%"
                            id="pedido" name="pedido">   
                            <div class="row" style="margin: 0px; padding:0; position:absolute; width:100%; top:0%; right:0%">
                                <nav aria-label="breadcrumb" style=" margin: 0px; padding:0;">
                                    <ol class="breadcrumb d-flex justify-content-center bg-gradient-faded-success" 
                                        style="margin-bottom: 0; border-radius:0px; margin:0;">
                                        <H3 class="text-white"><strong>Detalles del Pedido</strong></H3>
                                        <li class=" d-md-none d-lg-none d-xl-none d-xs d-sm-table d-sm-table-cell d-flex align-items-center" 
                                            style="margin: 0px;">
                                            <div id="" style="padding-left: 15px;">
                                                <button style="margin:0px; padding:4px; font-size:15px; position:absolute; right:1%; top:15%;" type="button" 
                                                class="bg-light border-radius-sm text-center subMenu" id="cerrar" name="cerrar">
                                                <i class="fa-solid fa-square-xmark text-danger"></i></button>
                                            </div>
                                        </li>
                                    </ol>
                                </nav>
                            </div>                   
                            <div id="pedidoT" style="margin:50px 0 0 0; padding:0;
                                    width:100%; position:absolute; overflow-y:auto;" class="bg-white">
                                <div class="row" id="carrito" style="margin: 0; padding:0;
                                 ">
                                    <table class="table table-borderless" id="lista" style="margin: 0; 
                                     margin-bottom:0px; padding:0;">
                                    <thead style="padding-top: 2px;">
                                        <tr class="text-dark">
                                            <th scope="col" style="padding:3px; text-align:;">Nombre</th>
                                            <th scope="col" style="padding:3px; text-align:center;">Cantidad</th>
                                            <th scope="col" style="padding:3px; text-align:right;">Precio</th>
                                            <th scope="col" style="padding:3px; text-align:right;">Sub-total</th>
                                            <th scope="col" colspan="3" style="padding:3px; text-align:center;">Elementos</th>
                                        </tr>
                                    </thead>
                                    <tbody class="col"  id=""  style="">
                                        @foreach(\Cart::getContent()->sortBy('id') as $key => $item)

                                        <tr>
                                            <td style="text-align: left; padding-left:3px;">{{ $item->name }}</td>
                                            <td style="text-align: center">{{ $item->quantity }}</td>
                                            <td style="text-align: right">L {{ $item->price }}</td>
                                            <td style="text-align: right">L {{ \Cart::get($item->id)->getPriceSum() }}</td>
                                            <td style="text-align: right">
                                                <form action="{{route('cart.update',$item->id)}}" method="POST">
                                                    @method('put')
                                                    @csrf
                                                    
                                                        <input type="hidden" value="{{ $item->id}}" id="id" name="id">
                                                        <input type="hidden" value="1" id="d" name="d">
                                                        <button onclick="update()"><i class="fa-solid fa-circle-minus"></i></button>
                                                    
                                                </form>
                                            </td>    
                                            <td style="text-align: center">
                                                <form action="{{route('cart.update',$item->id)}}" method="POST">
                                                    @method('put')
                                                    @csrf
                                                    
                                                        <input type="hidden" value="{{ $item->id}}" id="id" name="id">
                                                        <input type="hidden" value="-1" id="d" name="d">
                                                        <button onclick="update()"><i class="fa-solid fa-circle-plus"></i></button>
                                                    
                                                </form>
                                            </td>
                                            <td style="text-align: left">
                                                <form method="POST" action="{{route('cart.destroy',$item->id)}}">
                                                    @method('DELETE')
                                                    @csrf
                                                    <input type="hidden" value="{{ $item->id}}" id="id" name="id">
                                                    <input type="hidden" value="{{$item->quantity}}" id="disponible" name="disponible">
                                                    <button type="submit"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </td>  
                                            
                                        </tr>
                                        <hr>
                                    @endforeach
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            <div class=" bg-white col-12" style="margin:0; padding:0;">
                                <div class="col col-8 d-flex justify-content-start bg-white" 
                                        style="display:block; float:left; margin:0; padding:0; position:absolute; 
                                        bottom:50px; width:100%; left:3px;">
                                    <form method="POST" action="{{route('cart.store')}}" id="formulario" name="formulario" enctype="multipart/form-data">
                                            @csrf
                                        <div class="row form-group" style="margin: 0; border: 0; width:100%">
                                            <Label class="font-robo" style="margin:0%; padding:0%; padding-left:3px;
                                                color:rgb(88, 104, 128); font-size: 14px;" 
                                                for="mesaP">Pedido de la Mesa:
                                            </Label>
                                            <select name="mesa" required onchange="quitarerror()"  style="border-radius: 0px; 
                                                border:0px; height:35px; margin:0%; padding:0 3px 0 3px;
                                                border-bottom: 1px solid black;"
                                                class="form-control border-radius-sm">
                                                @if (old('mesa'))
                                                <option disabled="disabled" value="">Seleccione una mesa</option>
                                                    @foreach ($mesas as $c)
                                                        @if (old('mesa') == $c->id)
                                                            <option selected="selected" value="{{$c->id}}">Mesa-{{$c->nombre}} - Kiosko:
                                                                {{$c->kiosko->codigo}}
                                                            </option>
                                                        
                                                        @else
                                                            <option value="{{$c->id}}">Mesa-{{$c->nombre}} - Kiosko: {{$c->kiosko->codigo}}
                                                            </option>
                                                            
                                                        @endif
                                                    @endforeach
                                                @else
                                                    <option disabled="disabled" selected="selected" value="">Seleccione una mesa
                                                    </option>
                                                    @foreach ($mesas as $c)
                                                        <option value="{{$c->id}}">Mesa-{{$c->nombre}} - Kiosko: {{$c->kiosko->codigo}}
                                                        </option>
                                                        
                                                    @endforeach
                                                @endif
                                            </select>
                                            @error('mesa')
                                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                                            @enderror     
                                        </div>
                                        <div class="row font-robo form-group" style="margin-left:0; width:100%;">
                                            <label for="name" class="" style="font-size: 14px; color:rgb(88, 104, 128);
                                                margin:0%; padding:0; padding-left:3px;">Nombre del cliente:
                                            </label>
                                            <input class="form-control" type="text" 
                                            placeholder="Ingrese el nombre del cliente" style=" border:0px; padding:0 3px 0 3px;
                                              border-bottom: 1px solid black; border-radius: 0px; margin:0%;"
                                                name="name" id="name" minlength="3" maxlength="50"
                                                value="{{ old('name')}}" required>
                                            @error('name')
                                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        @if (count(\Cart::getContent()) == 0)
                                            <input type="number" name="t" id="t" value="" hidden>
                                        @endif
                                    </form>
                                </div>
                                <div class="col col-5 d-flex justify-content-start bg-white" style="display:block; bottom:52px;
                                        position:absolute; right:0%; float:right; margin:0; padding:0; ">
                                    <ul class="list-group list-group-flush" style="margin:0; padding:0; width:100%">
                                        <li class="list-group-item"><b style="display: block; float:left;">Sub-Total: &nbsp;&nbsp; </b>
                                            <p style="display: block; float:right; text-align: right;">L {{ \Cart::getTotal() - \Cart::getTotal() * 0.15}}</p>
                                        </li>
                                        <li class="list-group-item"><b style="display: block; float:left;">ISV: </b>
                                            <p style="display: block; float:right; text-align: right;">L {{ \Cart::getTotal() * 0.15}}</p>
                                        </li>
                                        <li class="list-group-item"><b style="display: block; float:left;">Total: </b> 
                                            <p style="display: block; float:right; text-align: right;">L {{ \Cart::getTotal()}}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>   
                            <div  class="d-flex justify-content-center bg-white bg-gradient-faded-success" style="margin:0; 
                                padding: 9px 3px 9px 3px; position:absolute; bottom:0%; right:0%; width:100%">
                                <div class="d-flex justify-content-center" style="margin: 0; display:block; float:left;
                                    padding:0; padding-right:5px;">
                                    <form action="{{ route('cart.clear') }}" method="POST" id="Fcancelar" name="Fcancelar" enctype="multipart/form-data">
                                        @csrf
                                        <a id="eliminar" role="button" class="btn btn-danger border-0 border-radius-sm"
                                            style="margin:0;" onclick="eliminar()" >Cancelar
                                        </a> 
                                    </form>
                                </div>    
                                <div class="" style="margin: 0; padding:0; padding-left:5px; display:block; float:left">
                                    <button  role="button" id="guardar" onclick="enviar()"
                                    class="btn btn-success border-0 border-radius-sm" style="margin:0; ">Guardar</button>  
                                </div>
                               
                            </div> 
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <!--Scripts -->
    
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