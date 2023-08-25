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
    <link rel="icon" type="image/png" href="/img/faviconVillaCrisol.png" />
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

        @media screen and (min-width: 780px) {}

        @media all and (min-width: 576px) {}

        @media all and (min-width: 768px) {}

        @media all and (min-width: 992px) {}

        @media (min-width: 1200px) {}
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
                    timer: 3000
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
                    timer: 3000
                })
            }
        </script>
        <div class="content-cell" style="margin: 0px; padding:0; max-height: 100%;">
            <div class="row h-100vh" style="margin: 0px; padding:0;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-table-cell" style="margin: 0px; padding:0; max-height: 100%;">
                    <div class="row" style="margin: 0px; padding:0;">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7 col-xl-7 d-table-cell" style="margin: 0px; padding:0; position:fixed; height: 100%; left:0%;">
                            <div class="table-responsive-lg" style="margin: 0px; padding:0;">
                                <nav aria-label="breadcrumb" style=" margin: 0px; padding:0;" class="bg-gradient-warning">
                                    <ol class="breadcrumb bg-success" style="margin: 0; border-radius:0px; padding:0; width:100% position:fixed;">
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
                                        <li class="nav-item d-md-none d-lg-none d-xl-none d-xs d-sm-table d-sm-table-cell d-flex align-items-center" style="margin: 8px;">
                                            <div id="" style="padding-left: 15px">
                                                <button style="margin:0px; padding:4px; position:absolute; right:1%; top:8px;" type="button" class="bg-light border-radius-sm text-center subMenu" id="subMenu" name="subMenu">
                                                    <span class="badge badge-pill badge-dark text-success">
                                                        <i class="fa fa-shopping-cart text-success"></i>
                                                    </span>
                                            </div>
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
                                        @php
                                            $cantidadProductos = count($productos);
                                            $rowClass = ($cantidadProductos > 1) ? 'row row-cols-auto row-cols-sm-3 row-cols-md-2 row-cols-lg-3 row-cols-xl-4' : 'row-cols-1';
                                            @endphp
                                            <div class="row justify-content-center {{ $rowClass }}" style="margin: 0px; padding:0;">
                                                @foreach($productos as $pro)
                                                @if($tipo === 'todos' || $pro->tipo == $tipo)
                                                <div class="col" style="padding: 0px; margin:0px;">
                                                    <form action="{{route('Acomple',$pedido->id)}}" method="post">
                                                        @csrf
                                                        <input type="hidden" value="{{ $pro->id }}" id="id" name="id">
                                                        <input type="hidden" value="{{ $pro->nombre }}" id="name" name="name">
                                                        <input type="hidden" value="{{ $pro->precio }}" id="price" name="price">
                                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                                        <input type="hidden" value="-1" id="disponible" name="disponible">

                                                        <div class="d-flex justify-content-center mb-1">
                                                            <button class="card btn btnCard col" id="btn" type="submit" data-id="{{$pro->id}}" style="padding: 0px; width:216px; height:200px; margin:0px 5px 1px 0; border-radius:0%;
                    background: url('/{{ $pro->imagen}}') top center/cover no-repeat;">
                                                                <div class="text-center" style="text-align:center;  width: 11rem;">
                                                                    <!-- Nombre -->
                                                                    <p class="nombre card-title pt-2 text-center text-dark" id="nombre">
                                                                        <strong style="font-size: 21px; width:100%;
                                background-color:rgba(255, 255, 255, 0.677);
                                position: absolute; bottom:25px; left:0;">{{$pro->nombre}}</strong>
                                                                    </p>
                                                                    <!-- Precio -->
                                                                    <p id="precio" class="text-dark text-decoration-line">
                                                                        <strong class="precio" style="font-size: 15.3px; width:35%;
                                background-color:rgba(255, 255, 255, 0.677);
                                position: absolute; bottom: 0; right:0%">L {{number_format($pro->precio, 2, ".", ",")}}</strong>
                                                                        <strong class="precio" style="font-size: 15.3px; width:65%;
                                background-color:rgba(255, 255, 255, 0.677);
                                position: absolute; bottom: 0; left:0%;">Disponible: {{$pro->disponible}}</strong>
                                                                    </p>
                                                                </div>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div>
                                                @endif
                                                @endforeach
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
                                            <a href="{{route('Agregar', ['id' => $pedido->id, 'tipo' => 'todos','vista'=>2])}}" style="margin:1px 3px 1px 3px; padding:10px; font-size:15px" type="button" 
                                                class="bg-light border-radius-sm text-center">
                                                <i class="fa-solid fa-utensils text-success"></i> Menú 
                                            </a>
                                        </li>
                                        <li class="" role="button">
                                            <a href="{{route('Agregar', ['id' => $pedido->id, 'tipo' => 'bebidas','vista'=>2])}}" style="margin:1px 3px 1px 3px; padding:10px; width:85px; font-size:14px" type="button" 
                                            class="bg-light border-radius-sm text-center">
                                            <i class="fa-solid fa-wine-glass text-info"></i> Bebidas
                                            </a> 
                                        </li>
                                        <li class="" role="button">
                                            <a href="{{route('Agregar', ['id' => $pedido->id, 'tipo' => 'platillos','vista'=>2])}}"style="margin:1px 3px 1px 3px; padding:10px; width:85px; font-size:14px" type="button" 
                                            class="bg-light border-radius-sm text-center">
                                            <i class="fa-solid fa-drumstick-bite text-warning"></i> Platillos
                                            </a>
                                        </li>
                                        <li class="d-sm-table d-md-table d-lg-none d-xl-none d-md-table-cell" role="button">
                                            <a href="{{route('Agregar', ['id' => $pedido->id, 'tipo' => 'complementos','vista'=>2])}}" style="margin:1px 3px 1px 3px; padding:10px; width:85px; font-size:14px" type="button" 
                                                class="bg-light border-radius-sm text-center">
                                                <i class="fa-solid fa-plus-circle text-primary"></i> Comp
                                            </a>
                                        </li>
                                        <li class="d-none d-sm-none d-md-none d-lg-table d-xl-table" role="button">
                                            <a href="{{route('Agregar', ['id' => $pedido->id, 'tipo' => 'complementos','vista'=>2])}}" style="margin:1px 3px 1px 3px; padding:10px; width:130px; font-size:14px" type="button" 
                                                class="bg-light border-radius-sm text-center">
                                                <i class="fa-solid fa-plus-circle text-primary"></i> Complementos
                                            </a>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                        </div>
                        <div class="d-none d-sm-none d-md-table bg-white ;
    col-md-6 d-lg-table col-lg-5 d-xl-table col-xl-5 d-table-cell ocultar" style="display:block; margin: 0px; height:100%; 
    padding:0%; position:fixed; right:0%; top:0%" id="pedido" name="pedido">
                            <div class="row" style="margin: 0px; padding:0; position:absolute; width:100%; top:0%; right:0%">
                                <nav aria-label="breadcrumb" style=" margin: 0px; padding:0;">
                                    <ol class="breadcrumb d-flex justify-content-center bg-gradient-faded-success" style="margin-bottom: 0; border-radius:0px; margin:0;">
                                        <H3 class="text-white"><strong>Detalles del Pedido</strong></H3>
                                        <li class=" d-md-none d-lg-none d-xl-none d-xs d-sm-table d-sm-table-cell d-flex align-items-center" style="margin: 0px;">
                                            <div id="" style="padding-left: 15px;">
                                                <button style="margin:0px; padding:4px; font-size:15px; position:absolute; right:1%; top:15%;" type="button" class="bg-light border-radius-sm text-center subMenu" id="cerrar" name="cerrar">
                                                    <i class="fa-solid fa-square-xmark text-danger"></i></button>
                                            </div>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div id="pedidoT" style="margin:50px 0 0 0; padding:0;
            width:100%; position:absolute; top:0; bottom:171px; overflow-y:auto;" class="bg-white">
                                <div class="row" id="carrito" style="margin: 0; padding:0;">
                                    <table class="table table-borderless" id="lista" style="margin: 0; 
                margin-bottom:0px; padding:0;">
                                        <thead style="padding-top: 2px;">
                                            <tr class="text-dark">
                                                <th scope="col" style="padding:3px; text-align:;">Nombre</th>
                                                <th scope="col" colspan="3" style="padding:3px; text-align:center;">Cantidad</th>
                                                <th scope="col" style="padding:3px; text-align:right;">Precio</th>
                                                <th scope="col" style="padding:3px; text-align:right;">Sub-total</th>
                                                <th scope="col" style="padding:3px; text-align:center;">Eliminar</th>
                                            </tr>
                                        </thead>
                                        <tbody class="col" id="">
                                            @php
                                            $total= 0;
                                            $impuesto = 0;
                                            @endphp
                                            @foreach ($detalles as $detalle)
                                            <tr>
                                                <td style="text-align: left; padding-left:3px;">{{ $detalle->producto->nombre }}</td>
                                                <td style="text-align: right">
                                                    <!---restar la cantidad--->
                                                    <form action="{{ route('detallep.restar', ['id' => $detalle->id, 'vista' => 2]) }}" method="POST">
                                                        @method('post')
                                                        @csrf
                                                        <button style="margin-right: 15px;" name="restar" type="submit"><i class="fa fa-minus-circle text-danger" aria-hidden="true"></i></button>
                                                    </form>
                                                </td>
                                                <!----Cambiar la cantidad----->
                                                <td style="text-align: center; width: 20%;">
                                                    <!---<form id="cantidadForm{{ $detalle->id }}" action="" method="POST">
                                                        @method('post')
                                                        @csrf---->
                                                    <input type="text" name="cantidad" id="cantidad{{ $detalle->id }}" style="height:20px; text-align: right;" class="form-control" value="{{ $detalle->cantidad }}">
                                                    <!--</form>--->
                                                </td>
                                                <!---Sumar la cantidad---->
                                                <td style="text-align: center">
                                                    <form action="{{ route('detallep.sumar', ['id' => $detalle->id, 'vista' => 2]) }}" method="POST">
                                                        @method('post')
                                                        @csrf
                                                        <button style="margin-right: 15px;" name="sumar" type="submit"><i class="fa fa-plus-circle text-success " aria-hidden="true"></i></button>
                                                    </form>
                                                </td>
                                                <td style="text-align: right">L {{ $detalle->producto->precio }}</td>
                                                <td style="text-align: right">L {{ $detalle->cantidad * $detalle->producto->precio }}</td>
                                                <!---Eliminar----->
                                                <td style="text-align: center">
                                                    <form method="POST" action="{{ route('detallep.destroy', ['id' => $detalle->id, 'vista' => 2]) }}">
                                                        @method('post')
                                                        @csrf
                                                        <button type="submit"><i class="fa fa-trash text-danger"></i></button>
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
                                <div class="col col-8 d-flex justify-content-start bg-white" style="display:block; float:left; margin:0; padding:0; position:absolute; 
                                        bottom:50px; width:100%; left:3px;">
                                    <form method="POST" action="{{route('guardarPedido',[$pedido->id])}}" id="formulario" name="formulario">
                                        @csrf
                                        <div class="row form-group" style="margin: 0; border: 0; width:100%">
                                            <Label class="font-robo" style="margin:0%; padding:0%; padding-left:3px;
                                                color:rgb(88, 104, 128); font-size: 14px;" for="mesaP">Pedido de la Mesa:
                                            </Label>
                                            <select name="mesa" required onchange="quitarerror()" style="border-radius: 0px; 
                                                border:0px; height:35px; margin:0%; padding:0 3px 0 3px;
                                                border-bottom: 1px solid black;" class="form-control border-radius-sm">
                                                <option value="{{$pedido->mesa_nombre->id}}">Mesa- {{$pedido->mesa_nombre->nombre}} - Kiosko: {{$pedido->mesa_nombre->kiosko->codigo}}</option>
                                                @foreach ($mesas as $mesa)
                                                <option value="{{ $mesa->id }}">Mesa- {{ $mesa->nombre }} - Kiosko: {{ $mesa->kiosko->codigo }}</option>
                                                @endforeach
                                            </select>
                                            @error('mesa')
                                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                        <div class="row font-robo form-group" style="margin-left:0; width:100%;">
                                            <label for="name" class="" style="font-size: 14px; color:rgb(88, 104, 128);
                                                margin:0%; padding:0; padding-left:3px;">Nombre del cliente:
                                            </label>
                                            <input class="form-control" type="text" placeholder="Ingrese el nombre del cliente" style=" border:0px; padding:0 3px 0 3px;
                                              border-bottom: 1px solid black; border-radius: 0px; margin:0%;" name="nombreC" id="nombreC" minlength="3" maxlength="50" value="{{ old('nombreC',$pedido->nombreCliente) }}" required>
                                            @error('nombreC')
                                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                                            @enderror
                                        </div>
                                    </form>
                                </div>
                                <div class="col col-5 d-flex justify-content-start bg-white" style="display:block; bottom:52px;
                                        position:absolute; right:0%; float:right; margin:0; padding:0; ">
                                    @php
                                    $total = 0;
                                    $impuesto = 0;
                                    foreach ($detalles as $detalle) {
                                    $total += $detalle->precio * $detalle->cantidad;
                                    }
                                    $impuesto = $total * 0.15;
                                    $subTotal = $total - $impuesto;
                                    @endphp
                                    <ul class="list-group list-group-flush" style="margin:0; padding:0; width:100%">
                                        <li class="list-group-item"><b style="display: block; float:left;">Sub-Total: &nbsp;&nbsp; </b>
                                            <p style="display: block; float:right; text-align: right;">L {{$subTotal}}</p>
                                        </li>
                                        <li class="list-group-item"><b style="display: block; float:left;">ISV: </b>
                                            <p style="display: block; float:right; text-align: right;">L {{ $impuesto }}</p>
                                        </li>
                                        <li class="list-group-item"><b style="display: block; float:left;">Total: </b>
                                            <p style="display: block; float:right; text-align: right;">L {{ $total }}</p>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="d-flex justify-content-center bg-white bg-gradient-faded-success" style="margin:0; 
                                padding: 9px 3px 9px 3px; position:absolute; bottom:0%; right:0%; width:100%">
                                <div class="d-flex justify-content-center" style="margin: 0; display:block; float:left;
                                    padding:0; padding-right:5px;">
                                    <a onclick="cancelar('{{ $pedido->id }}', 'pedidos/caja/detalle/{{$pedido->id}}')" id="cancelar" type="submit" class="btn btn-danger border-0 border-radius-sm" style="margin:0;">Cancelar</a>
                                </div>
                                <div class="" style="margin: 0; padding:0; padding-left:5px; display:block; float:left">
                                    <button role="button" id="guardar" onclick="enviar()" class="btn btn-success border-0 border-radius-sm" style="margin:0; ">Guardar</button>
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
    <!-- <script>
            document.getElementById('cantidad{{ $detalle->id }}').addEventListener('change', function() {
            document.getElementById('cantidadForm{{ $detalle->id }}').submit();
        });
    </script>--->
    <script>
        // contar cuantos productos hay en el carrito
        window.onload = function() {
            // Obtiene la tabla y la lista de productos
            var tabla = document.getElementById("lista");
            var filas = tabla.getElementsByTagName("tr");
            //resta el encabezado
            var cantidadProductos = filas.length - 1;

            //muestra la cantidad en el icono
            var elementoLi = document.getElementById("subMenu");
            elementoLi.innerHTML = "<span class='badge badge-pill badge-dark text-success'><i class='fa fa-shopping-cart text-success'></i> " + cantidadProductos + "</span>";
        };
        // envia el formulario de pedido     
        function enviar() {
            var formul = document.getElementById("formulario");
            formul.submit();
        }
        // cancelar pedido y elimina los detalles del pedido en estado 0
        function cancelar(pedido_id, ruta) {
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
                        $.ajax({
                            url: "/cancelar-pedido/" + pedido_id,
                            type: "POST",
                            data: {
                                _token: "{{ csrf_token() }}",
                            },
                            success: function() {
                                window.location.href = "/" + ruta;
                            },
                        });
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