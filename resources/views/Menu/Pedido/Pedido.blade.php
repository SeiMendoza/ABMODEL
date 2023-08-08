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
        <div class="content-cell" style="margin: 0px; padding:0;">
            <div class="row h-100vh" style="margin: 0px; padding:0;">
                <div class="col-xs-12 col-sm-12 col-md-12 col-lg-12 col-xl-12 d-table-cell" style="margin: 0px; padding:0; max-height: 100%;">
                    <div class="row" style="margin: 0px; padding:0;">
                        <div class="col-xs-12 col-sm-12 col-md-6 col-lg-7 col-xl-7 d-table-cell" style="margin: 0px; padding:0;">
                            <div class="table-responsive-lg" style="margin: 0px; padding:0;">
                                <nav aria-label="breadcrumb" style=" margin: 0px; padding:0;" class="bg-gradient-warning">
                                    <ol class="breadcrumb bg-success" style="margin: 0; border-radius:0px; padding:0; width:100%">
                                        <li style="width:20%">
                                            <div class="col" style="padding: 0px;">
                                                <a class="navbar-brand m-0" href={{ route('index') }} style="padding:0%; margin:0">
                                                    <img src="/img/Villacrisol.png" class="navbar-brand-img" alt="main_logo" style="width: 100%; height: 49px; padding:0%; margin:0">
                                                </a>
                                            </div>
                                        </li>
                                        <li class="d-flex justify-content-center" style="margin: 8px; width:52%">
                                            <H3 class="text-white"><strong>Menú del Día</strong></H3>
                                        </li>
                                        <li class="nav-item d-md-none d-lg-none d-xl-none d-xs d-sm-table d-sm-table-cell d-flex align-items-center" style="margin: 8px; width:1%">
                                            <div id="" style="padding-left: 15px">
                                                <button style="margin:0px; padding:4px; width:90px; font-size:15px" type="button" 
                                                class="bg-light border-radius-sm text-center" id="subMenu"><i class="fa-solid fa-plus-circle text-primary"></i> Pedido</button>
                                            </div>
                                        </li>
                                    </ol>
                                </nav>
                            </div>
                            <div class="table-responsive " 
                                style="display:block; float:left; margin: 0px; margin-top:2px; padding:0; height:630px;">
                                <section style="">
                                    <main class=" main-content">
                                        <div class="tab-content"  style="margin: 0px; padding:0; ">
                                            <div class="row row-cols-xs-6 row-cols-sm-3 row-cols-md-2 row-cols-lg-3 row-cols-xl-auto" 
                                                    style="margin: 0px; padding:0;">
                                                @yield('productos')
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
                                            <a href="{{route('cart.index')}}" style="margin:1px 3px 1px 3px; padding:10px; width:10%px; font-size:15px" type="button" 
                                                class="bg-light border-radius-sm text-center">
                                                <i class="fa-solid fa-utensils text-success"></i> Menú completo 
                                            </a>
                                        </li>
                                        <li class="nav-item d-none d-xl-table" role="button">
                                            <a href="{{route('cart.bebidas')}}" style="margin:1px 3px 1px 3px; padding:10px; width:150px; font-size:15px" type="button" 
                                            class="bg-light border-radius-sm text-center">
                                            <i class="fa-solid fa-wine-glass text-info"></i> Bebidas
                                            </a> 
                                        </li>
                                        <li class="nav-item d-none d-xl-table" role="button">
                                            <a href="{{route('cart.platillos')}}" style="margin:1px 3px 1px 3px; padding:10px; width:150px; font-size:15px" type="button" 
                                            class="bg-light border-radius-sm text-center">
                                            <i class="fa-solid fa-drumstick-bite text-warning"></i> Platillos
                                            </a>
                                        </li>
                                        <li class="nav-item d-none d-xl-table" role="button">
                                            <a href="{{route('cart.complementos')}}" style="margin:1px 3px 1px 3px; padding:10px; width:150px; font-size:15px" type="button" 
                                                class="bg-light border-radius-sm text-center">
                                                <i class="fa-solid fa-plus-circle text-primary"></i> Complementos
                                            </a>
                                        </li>
                                        <li class="nav-item d-xl-none d-flex align-items-center" style="">
                                            <a href="javascript:;" class="nav-link text-white p-0" id="iconNavbarSidenav">
                                                <div class="sidenav-toggler-inner">
                                                    
                                                        <a href="javascript:;" class="nav-link 
                                                            border-radius-sm text-center font-weight-bold px-0 bg-light" type="button" 
                                                            style="margin:1px 3px 1px 3px; padding:10px; width:150px; font-size:15px"
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
                                <form method="POST" action="{{route('cart.store')}}" id="formulario" name="formulario" enctype="multipart/form-data">
                                        @csrf
                                    <div class="input-group" style="margin: 0; border: 0; width: 99%">
                                        <Label class="h6 col-form-label font-robo" style="margin: 5px 5% 0 3px;" for="mesaP">Pedido de la Mesa:</Label>
                                        <select name="mesa" style="height:42px; border-radius:0; margin: 5px 0px 5px 23px;" id="mesa"
                                            class="form-control input--style-2 border-0 ps-2 font-robo" step="0.001" oninput="nombre()">
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
                                    <div class="input-group" style="margin: 0; border: 0; width: 99%">
                                        <label class="h6 font-robo col-form-label" for="nombre" style="margin: 0 5% 0 3px;">Nombre del cliente:</label>
                                        <input name="nombre" type="text" class="ps-2 input--style-2 form-control border-0 border-radius-sm" id="nombre" maxlength="50" minlength="3"
                                            placeholder="Ingrese el nombre" step="0.001" oninput="nombre()"
                                            value="{{ old('nombre') }}" style="margin: 0px 0px 5px 20px; height:42px;">
                                        <div class="invalid-feedback">  
                                        </div>
                                        @error('nombre')
                                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    @if (count(\Cart::getContent()) == 0)
                                        <input type="number" name="t" id="t" value="" hidden>
                                    @endif
                                </form>
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
                                    <tbody class="col"  id=""  style="">
                                        @foreach(\Cart::getContent() as $item)
                                        <tr>
                                            <td style="text-align: left; padding-left:3px;">{{ $item->name }}</td>
                                            <td style="text-align: center">{{ $item->quantity }}</td>
                                            <td style="text-align: right">L {{ $item->price }}</td>
                                            <td style="text-align: right">L {{ \Cart::get($item->id)->getPriceSum() }}</td>
                                            <td>
                                                <form action="{{route('cart.update',$item->id)}}" method="POST">
                                                    @method('put')
                                                    @csrf
                                                    <div class="form-group row">
                                                        <input type="hidden" value="{{ $item->id}}" id="id" name="id">
                                                        <input type="hidden" value="1" id="d" name="d">
                                                        <button type="submit"><i class="fa fa-edit"></i></button>
                                                    </div>
                                                </form>
                                            </td>    
                                            <td>
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
                                    @error('t')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                    </tbody>
                                    </table>
                                </div>
                            </div>
                            <br>
                            
                            <div class="d-flex justify-content-end">
                                <div class="card">
                                    <ul class="list-group list-group-flush">
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
                            
                            <div style="margin: 0; padding:0; margin-top:3px" class="col-12">
                                <div class="row bg-gradient-faded-success" style="margin: 0; padding: 5px 3px 8px 3px;">
                                    <div class="col-6 d-flex justify-content-end" style="margin: 0; padding:0; padding-right:5px">
                                        <form action="{{ route('cart.clear') }}" method="POST" id="Fcancelar" name="Fcancelar" enctype="multipart/form-data">
                                            @csrf
                                            <a id="eliminar" role="button" class="btn btn-danger border-0 border-radius-sm"
                                                style="margin:0;" onclick="eliminar()" >Cancelar
                                            </a> 
                                        </form>
                                    </div>    
                                    <div class="col-6" style="margin: 0; padding:0; padding-left:5px;">
                                        <button  role="button" id="guardar" onclick="enviar()"
                                        class="btn btn-success border-0 border-radius-sm" style="margin:0; ;">Guardar</button>  
                                    </div>
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
        var subMenu = document.getElementById('subMenu')
        var fullPageMenu = document.getElementById('fullPageMenu')
        subMenu.addEventListener('click', function() {
            var div = document.getElementById("pedido");
            if (div.classList.contains("mostrar")) {
                div.classList.remove("mostrar");
                div.classList.add("ocultar");
            } else {
                div.classList.remove("ocultar");
                div.classList.add("mostrar");
            }
        })
    </script>
    <!-- Control Center for Soft Dashboard: parallax effects, scripts for the example pages etc -->
    <script src="/js/argon-dashboard.min.js"></script>
    
</body>
</html>