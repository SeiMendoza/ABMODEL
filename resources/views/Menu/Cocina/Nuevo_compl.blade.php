<!DOCTYPE html>
<html lang="es">

<head>
<meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Menú | Villa Crisol</title>

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

</head>

<body style="overflow-y:hidden" class=" h-100">
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
                timer: 3500
            });
        }
    </script>
    <div class="content-cell" style="margin: 0px; padding:0;">
    <div class="row h-100vh" style="margin: 0px; padding:0;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-table-cell" style="margin: 0px; padding:0; max-height: 100%;">
                    <div class="row" style="margin: 0px; padding:0;">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7 col-xl-7 d-table-cell" style="margin: 0px; padding:0;">
                            <div class="table-responsive-lg" style="margin: 0px; padding:0;">
                            <nav aria-label="breadcrumb" style=" margin: 0px; padding:0;" class="bg-gradient-warning">
                                <ol class="breadcrumb bg-gradient-faded-success" style="margin: 0; border-radius:0px; padding:0;">
                                    <li>
                                        <div class="col" style="padding: 0px;">
                                            <a class="navbar-brand m-0" href={{ route('index') }} style="padding:0%; margin:0">
                                                <img src="/img/Villacrisol.png" class="navbar-brand-img" alt="main_logo" style="width: 100px; height: 49px; padding:0%; margin:0">
                                            </a>
                                        </div>
                                    </li>
                                    <li class="d-flex justify-content-center" style="margin: 8px; width:55%;">
                                        <H3 class=" text-white"><strong>Menú del Día</strong></H3>
                                    </li>
                                    <li class="nav-item d-md-none d-lg-none d-xl-none d-sm-table d-sm-table-cell d-flex align-items-center" style="margin: 8px; width:2%">
                                        <a href="javascript:;" class="nav-link text-white p-0">
                                            <i class="ni ni-diamond fixed-plugin-button-nav cursor-pointer"></i>
                                        </a>
                                    </li>
                                    <li class="nav-item d-md-none d-lg-none d-xl-none d-sm-table d-sm-table-cell d-flex align-items-center" style="width:10%">
                                        <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                            <div class="sidenav-toggler-inner">
                                                <a href="javascript:;" class="nav-link 
                           border-radius-sm text-center font-weight-bold px-0 bg-light" type="button" style="position:relative;margin-left:98%;top:5px; padding:8px; width:100px; font-size:15px" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    Pedido
                                                </a>
                                                <!-- Usar Informacion -->
                                                <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown" style="margin: 0%; padding:0%;">
                                                    <div class="dropdown-item col-4 d-table-cell border-radius-top-end-0 " style="display:block; float:right; margin: 0px; padding:0;">
                                                        <div style="">

                                                            <div class="input-group" style="margin: 0; border: 0; width: 99%">
                                                                <Label class="h6 col-form-label font-robo" style="margin: 0px 5% 0 3px;" for="mesaP">Pedido de la Mesa:</Label>

                                                                <select name="mesa" style="height:42px; border-radius:0; margin: 5px 0px 5px 23px;" id="mesa" class="form-control input--style-2 border-0 ps-2 font-robo" step="0.001" oninput="nombre()">
                                                                    <option value="{{$pedido->mesa_nombre->id}}">{{$pedido->mesa_nombre->nombre}} - Kiosko: {{$pedido->mesa_nombre->kiosko->codigo}}</option>
                                                                    @foreach ($mesas as $mesa)
                                                                    <option value="{{ $mesa->id }}">{{ $mesa->nombre }} - Kiosko: {{ $mesa->kiosko->codigo }}</option>
                                                                    @endforeach
                                                                </select>
                                                                @error('mesaP')
                                                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                                                                @enderror
                                                            </div>
                                                            <div class="input-group" style="margin: 0; border: 0; width: 99%">
                                                                <label class="h6 font-robo col-form-label" for="nombre" style="margin: 0 5% 0 3px;">Nombre del cliente:</label>
                                                                <input name="nombreC" type="text" class="ps-2 input--style-2 form-control border-0 border-radius-sm" id="nombre" maxlength="50" minlength="3" placeholder="Ingrese el nombre" step="0.001" oninput="nombre()" value="{{ old('nombre',$pedido->nombreCliente) }}" style="margin: 0px 0px 5px 20px; height:42px;">
                                                                <div class="invalid-feedback">
                                                                </div>
                                                                @error('nombreC')
                                                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                                                                @enderror
                                                            </div>
                                                            <div style="height: 380px; margin:0px; overflow-y:auto;">
                                                                <div class="row" id="carrito" style="margin: 0; padding:0;">
                                                                    <table class="table " id="lista" style="margin: 0; padding:0;">
                                                                        <thead style="padding-top: 2px;">
                                                                            <tr class="text-dark">
                                                                                <th scope="col" style="padding:3px; text-align:;">Nombre</th>
                                                                                <th scope="col" style="padding:3px; text-align:center;">Cantidad</th>
                                                                                <th scope="col" style="padding:3px; text-align:right;">Precio</th>
                                                                                <th scope="col" style="padding:3px; text-align:right;">Sub-total</th>
                                                                                <th scope="col" colspan="2" style="padding:3px; text-align:center;">Elementos</th>
                                                                            </tr>
                                                                        </thead>
                                                                        <tbody class="col" id="" style="">
                                                                            @php
                                                                            $total= 0;
                                                                            $impuesto = 0;
                                                                            @endphp
                                                                            @foreach ($detalles as $detalle)
                                                                            <tr>
                                                                                <td style="text-align: left; padding-left:3px;">{{ $detalle->producto->nombre }}</td>
                                                                                <td style="text-align: center">{{ $detalle->cantidad }}</td>
                                                                                <td style="text-align: right">L {{ $detalle->producto->precio }}</td>
                                                                                <td style="text-align: right">L {{ $detalle->cantidad * $detalle->producto->precio }}</td>
                                                                                <td style="text-align:center; width:20%; height:20%;">
                                                                                <div style="display: flex; justify-content: center; flex-direction: row;position: relative;">
                                                        <form action="{{route('detallep.restar',['id' => $detalle->id,'vista'=>2])}}" method="POST">
                                                            @method('post')
                                                            @csrf
                                                                <button style="margin-right: 10px;" type="submit"><i class="fa fa-edit"></i></button>
                                                        </form>
                                                     
                                                        <form method="POST" action="{{ route('detallep.destroy', ['id' => $detalle->id,'vista'=>2]) }}">
                                                            @method('post')
                                                            @csrf
                                                            <button type="submit"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                    </td>
                                                                            </tr>
                                                                            <hr>
                                                                            @endforeach

                                                                        </tbody>
                                                                    </table>
                                                                </div>
                                                            </div>
                                                            <br>

                                                            <div class="d-flex justify-content-end">
                                                                <div class="card">
                                                                    @php
                                                                    $total = 0;
                                                                    $impuesto = 0;
                                                                    foreach ($detalles as $detalle) {
                                                                    $total += $detalle->precio * $detalle->cantidad;
                                                                    }
                                                                    $impuesto = $total * 0.15;
                                                                    $subTotal = $total - $impuesto;
                                                                    @endphp
                                                                    <ul class="list-group list-group-flush">
                                                                        <li class="list-group-item"><b style="display: block; float:left;">SubTotal: &nbsp;&nbsp; </b>
                                                                            <p style="display: block; float:right; text-align: right;">L{{$subTotal}} </p>
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

                                                            <div style="margin: 0; padding:0; margin-top:3px" class="col-12">
                                                                <div class="row bg-gradient-faded-success" style="margin: 0; padding: 5px 3px 8px 3px;">
                                                                    <div class="col-6 d-flex justify-content-end" style="margin: 0; padding:0; padding-right:5px">
                                                                        <button onclick="cancelar('{{ $pedido->id }}','pedidos/caja/detalle/{{$pedido->id}}')" id="cancelar" type="submit" class="btn btn-danger border-0 border-radius-sm" style="margin:0;">Cancelar</button>
                                                                    </div>
                                                                    <div class="col-6" style="margin: 0; padding:0; padding-left:5px;">
                                                                        <form method="POST" action="{{route('guardarPedido',[$pedido->id,'detalle_id' => $detalle->id])}}">
                                                                            @csrf
                                                                            <button href="#" type="submit" role="button" id="guardar" class="btn btn-success border-0 border-radius-sm" style="margin:0; ;">Guardar</button>
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                        </a>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="table-responsive " style="display:block; float:left; margin: 0px; margin-top:2px; padding:0; height:630px;">
                            <section style="">
                                <main class=" main-content">
                                    <div class="tab-content" style="margin: 0px; padding:0; ">
                                        <div class="row row-cols-xs-6 row-cols-sm-3 row-cols-md-2 row-cols-lg-3 row-cols-xl-auto" style="margin: 0px; padding:0;">
                                            @foreach($productos as $pro)
                                            @if($tipo === 'todos' || $pro->tipo == $tipo)
                                            <div class="" style="padding: 0px; margin:0px;">
                                                <form action="{{route('Acomple',$pedido->id)}}" method="post">
                                                    @csrf
                                                    <input type="hidden" value="{{ $pro->id }}" id="id" name="id">
                                                    <input type="hidden" value="{{ $pro->nombre }}" id="name" name="name">
                                                    <input type="hidden" value="{{ $pro->precio }}" id="price" name="price">
                                                    <input type="hidden" value="1" id="quantity" name="quantity">

                                                    <div class="col d-flex justify-content-center mb-1">
                                                        <button class="card btn btnCard" id="btn" type="submit" data-id="{{$pro->id}}" style="padding: 0px; width:215px; height:200px; margin:0px; border-radius:0%;
            background: url('/{{ $pro->imagen}}') top center/cover no-repeat;">
                                                            <div class="text-center" style="text-align:center;  width: 11rem;">
                                                                <!-- Nombre -->
                                                                <p class="nombre card-title pt-2 text-center text-dark" id="nombre">
                                                                    <strong style="font-size: 20px; width:215px;background-color:rgba(255, 255, 255, 0.677);
position: absolute; bottom: 12.3%; left:0;">{{$pro->nombre}}</strong>
                                                                </p>
                                                                <!-- Precio -->
                                                                <p id="precio" class="text-dark text-decoration-line">
                                                                    <strong class="precio" style="font-size: 15px; width:80px;
                                    background-color:rgba(255, 255, 255, 0.677);
                                    position: absolute; bottom: 0; right:0%">L {{number_format($pro->precio, 2, ".", ",")}}</strong>
                                                                    <strong class="precio" style="font-size: 15px; width:130px;
                                    background-color:rgba(255, 255, 255, 0.677);
                                    position: absolute; bottom: 0; left:0;">Disponible: {{$pro->disponible}}</strong>
                                                                </p>
                                                            </div>
                                                        </button>
                                                    </div>
                                                </form>
                                            </div>
                                            @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </main>
                            </section>
                        </div>
                        <div class="table-responsive-sm table-responsive-md table-responsive-lg col-12" style="text-align:center; margin: 0; padding:0;">
                            <footer class="" style="padding: 0;">
                                <ul class="nav navbar-expand-xs navbar-expand-sm navbar-expand-md navbar-expand-lg d-flex justify-content-center
             h4 m--1 bg-success text-center" role="tablist" style="width:100%; padding: 5px 3px 5px 3px;">
                                    <li class="nav-item item" role="button">
                                        <a href="{{route('Agregar',['id' => $pedido->id,'tipo' => 'todos','vista'=>2])}}" style="margin:1px 3px 1px 3px; padding:10px; width:10%px; font-size:15px" type="button" class="bg-light border-radius-sm text-center">
                                            <i class="fa-solid fa-utensils text-success"></i> Menú completo
                                        </a>
                                    </li>
                                    <li class="nav-item d-none d-xl-table" role="button">
                                        <a href="{{route('Agregar', ['id' => $pedido->id, 'tipo' => 'bebidas','vista'=>2])}}" style="margin:1px 3px 1px 3px; padding:10px; width:150px; font-size:15px" type="button" class="bg-light border-radius-sm text-center">
                                            <i class="fa-solid fa-wine-glass text-info"></i> Bebidas
                                        </a>
                                    </li>
                                    <li class="nav-item d-none d-xl-table" role="button">
                                        <a href="{{route('Agregar',['id' => $pedido->id, 'tipo' => 'platillos','vista'=>2])}}" style="margin:1px 3px 1px 3px; padding:10px; width:150px; font-size:15px" type="button" class="bg-light border-radius-sm text-center">
                                            <i class="fa-solid fa-drumstick-bite text-warning"></i> Platillos
                                        </a>
                                    </li>
                                    <li class="nav-item d-none d-xl-table" role="button">
                                        <a href="{{route('Agregar',['id' => $pedido->id, 'tipo' => 'complementos','vista'=>2])}}" style="margin:1px 3px 1px 3px; padding:10px; width:150px; font-size:15px" type="button" class="bg-light border-radius-sm text-center">
                                            <i class="fa-solid fa-plus-circle text-primary"></i> Complementos
                                        </a>
                                    </li>
                                    <li class="nav-item d-xl-none d-flex align-items-center" style="">
                                        <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                            <div class="sidenav-toggler-inner">

                                                <a href="javascript:;" class="nav-link 
                     border-radius-sm text-center font-weight-bold px-0 bg-light" type="button" style="margin:1px 3px 1px 3px; padding:10px; width:150px; font-size:15px" id="dropdownMenuButton" data-bs-toggle="dropdown" aria-expanded="false">
                                                    <i class="fa-solid fa-plus"></i> Más
                                                </a>

                                                <!-- Usar Informacion -->
                                                <div class="dropdown-menu dropdown-menu-end shadow animated--grow-in" aria-labelledby="userDropdown">
                                                    <a class="dropdown-item" href="{{route('Agregar', ['id' => $pedido->id, 'tipo' => 'bebidas','vista'=>2])}}">
                                                        <i class="fa-solid fa-wine-glass text-info"></i>
                                                        Bebidas
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{route('Agregar',['id' => $pedido->id, 'tipo' => 'platillos','vista'=>2])}}">
                                                        <i class="fa-solid fa-drumstick-bite text-warning"></i>
                                                        Platillos
                                                    </a>
                                                    <div class="dropdown-divider"></div>
                                                    <a class="dropdown-item" href="{{route('Agregar',['id' => $pedido->id, 'tipo' => 'complementos','vista'=>2])}}" data-toggle="modal" data-target="logoutModal">
                                                        <i class="fa-solid fa-plus-circle text-primary"></i>
                                                        Complementos
                                                    </a>
                                                </div>
                                            </div>
                                        </a>
                                    </li>
                                </ul>
                            </footer>
                        </div>
                    </div>
                    <div class="d-none d-sm-none d-md-table col-md-6 d-lg-table col-lg-5 d-xl-table col-xl-5 d-table-cell ocultar" 
                                style="display:block; float: right; margin: 0px; padding:0;" id="pedido" name="pedido">   
                            <div class="row" style="margin: 0px; padding:0;">
                                <nav aria-label="breadcrumb" style=" margin: 0px; padding:0;">
                                    <ol class="breadcrumb d-flex justify-content-center bg-gradient-faded-success" style="margin-bottom: 0; border-radius:0px;">
                                        <H3 class="text-white"><strong>Detalles del Pedido</strong></H3>
                                    </ol>
                                </nav>
                            </div> 
                        <div style="">
                            <form method="POST" action="{{route('guardarPedido',[$pedido->id,'detalle_id' => $detalle->id])}}">
                                @csrf
                                <div class="input-group" style="margin: 0; border: 0; width: 99%">
                                    <Label class="h6 col-form-label font-robo" style="margin: 5px 5% 0 3px;" for="mesaP">Pedido de la Mesa:</Label>

                                    <select name="mesa" style="height:42px; border-radius:0; margin: 5px 0px 5px 23px;" id="mesa" class="form-control input--style-2 border-0 ps-2 font-robo" step="0.001" oninput="nombre()">
                                        <option value="{{$pedido->mesa_nombre->id}}">{{$pedido->mesa_nombre->nombre}} - Kiosko: {{$pedido->mesa_nombre->kiosko->codigo}}</option>
                                        @foreach ($mesas as $mesa)
                                        <option value="{{ $mesa->id }}">{{ $mesa->nombre }} - Kiosko: {{ $mesa->kiosko->codigo }}</option>
                                        @endforeach
                                    </select>
                                    @error('mesaP')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="input-group" style="margin: 0; border: 0; width: 99%">
                                    <label class="h6 font-robo col-form-label" for="nombre" style="margin: 0 5% 0 3px;">Nombre del cliente:</label>
                                    <input name="nombreC" type="text" class="ps-2 input--style-2 form-control border-0 border-radius-sm" id="nombre" maxlength="50" minlength="3" placeholder="Ingrese el nombre" step="0.001" oninput="nombre()" value="{{ old('nombreC',$pedido->nombreCliente) }}" style="margin: 0px 0px 5px 20px; height:42px;">
                                    <div class="invalid-feedback">
                                    </div>
                                    @error('nombreC')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div style="height: 380px; margin:0px; overflow-y:auto;">
                                    <div class="row" id="carrito" style="margin: 0; padding:0;">
                                        <table class="table " id="lista" style="margin: 0; padding:0;">
                                            <thead style="padding-top: 2px;">
                                                <tr class="text-dark">
                                                    <th scope="col" style="padding:3px;">Nombre</th>
                                                    <th scope="col" style="padding:3px; text-align:center;">Cantidad</th>
                                                    <th scope="col" style="padding:3px; text-align:right;">Precio</th>
                                                    <th scope="col" style="padding:3px; text-align:right;">Sub-total</th>
                                                    <th scope="col" colspan="2" style="padding:3px; text-align:center;">Elementos</th>
                                                </tr>
                                            </thead>
                                            <tbody class="col" id="" style="">
                                                @php
                                                $total= 0;
                                                $impuesto = 0;
                                                @endphp
                                                @foreach ($detalles as $detalle)
                                                <tr>
                                                    <td style="text-align: left; padding-left:3px;">{{ $detalle->producto->nombre }}</td>
                                                    <td style="text-align: center">{{ $detalle->cantidad }}</td>
                                                    <td style="text-align: right">L {{ $detalle->producto->precio }}</td>
                                                    <td style="text-align: right">L {{ $detalle->cantidad * $detalle->producto->precio }}</td>
                                                    <td style="text-align:center; width:20%; height:20%;">
                                                    <div style="display: flex; justify-content: center; flex-direction: row;position: relative;">
                                                        <form action="{{route('detallep.restar',['id' => $detalle->id,'vista'=>2])}}" method="POST">
                                                            @method('post')
                                                            @csrf
                                                                <button style="margin-right: 15px;" type="submit"><i class="fa fa-edit"></i></button>
                                                        </form>
                                                     
                                                        <form method="POST" action="{{ route('detallep.destroy', ['id' => $detalle->id,'vista'=>2]) }}">
                                                            @method('post')
                                                            @csrf
                                                            <button type="submit"><i class="fa fa-trash"></i></button>
                                                        </form>
                                                    </div>
                                                    </td>

                                                </tr>
                                                <hr>
                                                @endforeach

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                                <br>

                                <div class="d-flex justify-content-end">
                                    <div class="card">
                                        @php
                                        $total = 0;
                                        $impuesto = 0;
                                        foreach ($detalles as $detalle) {
                                        $total += $detalle->precio * $detalle->cantidad;
                                        }
                                        $impuesto = $total * 0.15;
                                        $subTotal = $total - $impuesto;
                                        @endphp
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item"><b style="display: block; float:left;">SubTotal: &nbsp;&nbsp; </b>
                                                <p style="display: block; float:right; text-align: right;">L{{$subTotal}} </p>
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
                                <div style="margin: 0; padding:0; margin-top:3px" class="col-12">
                                    <div class="row bg-gradient-faded-success " style="margin: 0; padding: 5px 3px 8px 3px;">
                                        <div class="col-6 d-flex justify-content-end" style="margin: 0; padding:0; padding-right:5px">
                                            <a onclick="cancelar('{{ $pedido->id }}', 'pedidos/caja/detalle/{{$pedido->id}}')" id="cancelar" type="submit" class="btn btn-danger border-0 border-radius-sm" style="margin:0;">Cancelar</a>
                                        </div>
                                        <div class="col-6" style="margin: 0; padding:0; padding-left:5px;">
                                            <button href="#" type="submit" role="button" id="guardar" class="btn btn-success border-0 border-radius-sm" style="margin:0; ;">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    </div>
    </div>

    <script src="/assets/jquery/jquery.js"></script>
    <script src="/assets/jquery/jquery.min.js"></script>
    <script src={{ asset("js/core/bootstrap.bundle.min.js") }}></script>
    <script src={{ asset('/js/plugins/perfect-scrollbar.min.js') }}></script>
    <script src={{ asset('/js/plugins/smooth-scrollbar.min.js') }}></script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/js/argon-dashboard.min.js"></script>
    <script>
        var win = navigator.platform.indexOf('Win') > -1;
        if (win && document.querySelector('#sidenav-scrollbar')) {
            var options = {
                damping: '0.5'
            }
            Scrollbar.init(document.querySelector('#sidenav-scrollbar'), options);
        }

        function deleteItem(id) {
            // Envía el formulario
            document.getElementById('delete-form-' + id).submit();

            // Actualiza la página actual
            location.reload();
        }

        function nombre() {
            a = document.getElementById("nombre").value;
            b = document.getElementById("mesa").value;

            document.getElementById("nombreC").value = a;
            document.getElementById("mesaP").value = b;
        };

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
</body>

</html>