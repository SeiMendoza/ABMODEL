<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#bla"  />
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="/assets/img/favicon.png">
        <title>
            Villa Crisol
        </title>

        <!-- Icons -->
        <link href={{ asset('/css/nucleo-icons.css') }} rel="stylesheet" type="text/css">
        <link href={{ asset('/css/nucleo-svg.css') }} rel="stylesheet" />
        <link href="/assets/css/fontawesome.css" rel="stylesheet">
        <link href="/assets/css/solid.css" rel="stylesheet">
        <link href="/assets/fontawesome/css/font-awesome.min.css" rel="" media="all">

        <!-- CSS Files -->
        <link id="pagestyle" href="/css/argon-dashboard.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/menuStyles/menuStyles.css" type="text/css">

        <script src="{{ asset("js/sweetalert2.all.min.js") }}"></script>
</head>
<body style="background-color:rgba(207, 207, 207, 0.34); padding:0px; overflow:hidden">
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
                background: '#fff',
                timer: 3500
            })
        }

    </script>
    
    <div class="" style="width: 100%; padding:0; margin:0;">
        <div class="" style="margin: 0px; padding:0; width: 67%; display:block; float:left">
            <div class="nav d-flex justify-content-center bg-warning" style="margin: 0px; padding:0;">
                <h3 style="padding:0; margin:10px 433px 0 0px; " class="text-white title font-robo">Menú del Día</h3>
                <div class="nav-link-icon navbar-search" style="margin: 10px 0 0 10px;">
                    <input id="myInput" type="text" placeholder="Buscar en el menú" style="width: 300px; height:42px" class="border-0 border-radius-sm">
                </div>
                <div style="margin: 10px 0 0 8px;" class=" nav-link-icon ">
                    <a href="{{route("index")}}" class="btn btn-menu text-warning border-0 border-radius-sm"><i class="ni ni-palette text-warning"></i> Inicio</a>
                </div>
            </div>
            <!-- Catalogo de Productos -->
            <div class="table-responsive" style="height: 635px; overflow-y: scroll; overflow-x: hidden;
                scroll-behavior: smooth;">
                <section class="NovidadesSection" style="">     
                    <main class="main-content position border-radius-lg">   
                        <div class="tab-content" id="pills-tabContent">
                            <!-- ========== Bebidas ========== -->
                            <div
                                class="tab-pane fade "
                                id="pills-home"
                                role="tabpanel"
                                aria-labelledby="pills-home-tab">
                                <div class="container-fluid" style="padding: 0px">
                                    <div class="productos" id="productos"
                                        style="display: grid; grid-template-columns: 200px 200px 210px 200px 200px">
                                        @foreach($bebidas as $pro)
                                        <div class="container-fluid agregarCarrito" id=""
                                                style="display:block;  height: 200px; width: 200px; padding: 3px ">
                                            <div class="card h-100 btn btnCard" 
                                            data-id="{{$pro->id}}" style="padding: 0px; width:100%; border-radius:0%;
                                            background: url('/img/carousel-1.jpg') top center/cover no-repeat;">
                                                <div class="text-center" style="text-align:center; ">

                                                    <!-- Nombre -->
                                                        <p class="nombre card-title pt-2 text-center text-white" id="nombre"> 
                                                            <strong style="font-size: 20px; width:194px;
                                                            background-color:rgba(95, 95, 95, 0.651);
                                                            position: absolute; bottom: 12.5%; left:0;">{{$pro->nombre}}</strong>
                                                        </p>                        
                                                    <!-- Precio -->
                                                        <p id="precio" class="text-white text-decoration-line">
                                                            <strong class="precio" style="font-size: 15px; width:194px;
                                                            background-color:rgba(95, 95, 95, 0.651);
                                                            position: absolute; bottom: 0; left:0;">L {{$pro->precio}}.00</strong>
                                                        </p>         
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- ========== End Cards ========== -->
                            </div>
                            <!-- ========== Platillos ========== -->
                            <div
                                class="tab-pane fade show active container"
                                id="pills-profile"
                                role="tabpanel"
                                aria-labelledby="pills-profile-tab"
                                style="padding: 0px; margin:0px; border:0px">
                                <div class="container-fluid" style="padding: 0px">
                                    <div class="productos" id="productos"
                                        style="display: grid; grid-template-columns: 200px 200px 210px 200px 200px">
                                        @foreach($platillos as $pro)
                                        <div class="container-fluid agregarCarrito" id=""
                                                style="display:block;  height: 200px; width: 200px; padding: 3px ">
                                            <div class="card h-100 btn btnCard" 
                                            data-id="{{$pro->id}}" style="padding: 0px; width:100%; border-radius:0%;
                                            background: url('/img/carousel-2.jpg') top center/cover no-repeat;">
                                                <div class="text-center" 
                                                        style="text-align:center; ">
                                                        <!-- Nombre -->
                                                        <p class="nombre card-title pt-2 text-center text-dark" id="nombre"> 
                                                            <strong style="font-size: 20px; width:194px;
                                                            background-color:rgba(255, 255, 255, 0.677);
                                                            position: absolute; bottom: 12.5%; left:0;">{{$pro->nombre}}</strong>
                                                        </p>                        
                                                        <!-- Precio -->
                                                        <p id="precio" class="text-dark text-decoration-line">
                                                            <strong class="precio" style="font-size: 15px; width:194px;
                                                            background-color:rgba(255, 255, 255, 0.677);
                                                            position: absolute; bottom: 0; left:0;">L {{$pro->precio}}.00</strong>
                                                        </p>                        
                                                </div>
                                            </div>
                                        </div>

                                        @endforeach
                                    </div>
                                </div>
                                <!-- ========== End Cards ========== -->
                            </div>
                            <!-- ========== Complementos ========== -->
                            <div
                                class="tab-pane fade"
                                id="pills-contact"
                                role="tabpanel"
                                aria-labelledby="pills-contact-tab">
                                <div class="container-fluid" style="padding: 0px">
                                    <div class="productos" id="productos"
                                        style="display: grid; grid-template-columns: 200px 200px 210px 200px 200px">
                                        @foreach($combos as $pro)
                                        <div class="container-fluid agregarCarrito" id=""
                                                style="display:block;  height: 200px; width: 200px; padding: 3px ">
                                            <div class="card h-100 btn btnCard" 
                                            data-id="{{$pro->id}}" style="padding: 0px; width:100%; border-radius:0%;
                                            background: url('/img/carousel-3.jpg') top center/cover no-repeat;">
                                                <div class="text-center" 
                                                style="text-align:center; ">
                                                <!-- Nombre -->
                                                <p class="nombre card-title pt-2 text-center text-dark" id="nombre"> 
                                                    <strong style="font-size: 20px; width:194px;
                                                    background-color:rgba(255, 255, 255, 0.677);
                                                    position: absolute; bottom: 12.5%; left:0;">{{$pro->nombre}}</strong>
                                                </p>                        
                                                <!-- Precio -->
                                                <p id="precio" class="text-dark text-decoration-line">
                                                    <strong class="precio" style="font-size: 15px; width:194px;
                                                    background-color:rgba(255, 255, 255, 0.677);
                                                    position: absolute; bottom: 0; left:0;">L {{$pro->precio}}.00</strong>
                                                </p>                        
                                        </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <!-- ========== End Cards ========== -->
                            </div>
                        </div>
                    </main> 
                </section>
                
            </div>
            <div class="row bg-warning" style="text-align:center; margin: 0; padding:0;">
                <footer class="" style="padding: 0">
                    <ul
                    class="nav d-flex justify-content-center h4 text-center"
                    role="tablist"
                    style="width:100%">
                    <li class="nav-item" role="presentation">
                        <a
                        class="nav-link text-white"
                        id="pills-home-tab"
                        data-bs-toggle="pill"
                        data-bs-target="#pills-home"
                        type="button"
                        role="tab"
                        aria-controls="pills-home"
                        aria-selected="true"
                        >Bebidas</a
                        >
                    </li>
                    <li class="nav-item" role="presentation">
                        <a
                        class="nav-link active text-white"
                        id="pills-profile-tab"
                        data-bs-toggle="pill"
                        data-bs-target="#pills-profile"
                        type="button"
                        role="tab"
                        aria-controls="pills-profile"
                        aria-selected="false"
                        >Platillos</a
                        >
                    </li>
                    <li class="nav-item" role="presentation">
                        <a
                        class="nav-link text-white"
                        id="pills-contact-tab"
                        data-bs-toggle="pill"
                        data-bs-target="#pills-contact"
                        type="button"
                        role="tab"
                        aria-controls="pills-contact"
                        aria-selected="false"
                        >Complementos</a
                        >
                    </li>
                    </ul>
                </footer>
            </div>
        </div>
        <div class="" style="padding: 0px; width: 33%; margin: 0; display:block; float:left">
            <div class="container-fluid" style="padding: 0px;">
                <form action="{{ route("usuario_pedido.store") }}" id="formulario" name="formulario" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="nav d-flex justify-content-start bg-warning" style="height: 67px">
                        <Label class="ps-3 h3 title col-form-label col-auto text-white font-robo" style="width: 280px;" for="mesa">Pedido de la Mesa:</Label>
                        <div style="float: right; margin: 10px 0px 10px 5px; width:200px; padding:0" class="input-group">
                            <select name="mesa" style="height:42px" onchange="quitarerror()" id="mesa" class="ps-2 form-control border-0 border-radius-sm text-center font-robo h4">
                                <option disabled="disabled" selected="selected" value="">Mesa</option>
                                @foreach($mesas as $m)
                                    <option value="{{$m->id}}">{{$m->nombre}}</option>
                                @endforeach
                            </select>
                            @error('mesa')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                        <br><br>
                    </div> 
                    <div class="row">
                        <div class="input-group">
                            <label class="ps-3 h6 text-xl-center title col-form-label col-auto" for="nombre">Nombre del cliente:</label>
                            <input name="nombre" type="text" class="ps-2 form-control border-0 border-radius-sm" id="nombre" maxlength="50" minlength="3"
                                    required placeholder="Ingrese el nombre" value="{{ old('nombre') }}" style="width: 300px; margin: 0 0 5px 20px; padding:0">
                            <div class="invalid-feedback">  
                            </div>
                            @error('nombre')
                                <span class="menerr" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>   
                    <div class="row table-responsive bg-light ri" style="height: 542px; width:100%; margin:0; padding:0;">
                        <table class="table">
                        <thead style="padding-top: 2px;" >
                            <tr class="text-dark">
                                <th scope="col" style="text-align: center">Nombre</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio</th>
                                <th scope="col">Quitar</th>
                            </tr>
                        </thead>
                        <tbody class="tbody" style="">
                        </tbody>
                        </table>
                        <input type="text" name="tuplas" class="form-control @error('tuplas') is-invalid @enderror"
                                id="tuplas" hidden>
                            @error('tuplas')
                                <small class="invalid-feedback">
                                    <strong>{{ $message }}</strong>
                                </small>
                            @enderror
                        <br><br>
                    </div>
                    <div class="row mx-3">
                        <div class="col d-flex justify-content-end">
                            <h3 class="total text-black">Total: 0</h3>
                        </div>
                    </div>
                    <div class="bg-warning" style="text-align: center; width:100%;">
                        <a href="#" onclick="cancelar('menu/prueba')" id="cancelar"
                        class="btn btn-danger px-6 border-0 border-radius-sm" style="margin: 5px 1px 3px 1px">Cancelar</a>
                        <a href="#" onclick="guardar()" id="procesar-compra"
                            class="btn btn-success px-6 border-0 border-radius-sm" style="margin: 5px 1px 3px 1px">Guardar</a>
                    </div>
                </form>
            </div>  
        </div>
    </div>

    <script src="/assets/jquery/jquery.js"></script>
    <script src="/assets/jquery/jquery.min.js"></script>
    <script>
        $(document).ready(function(){
          $("#myInput").on("keyup", function() {
            var value = $(this).val().toLowerCase();
            $("#productos div").filter(function() {
              $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
            });
          });
        });
        </script>
    <script src={{ asset("js/core/bootstrap.bundle.min.js") }}></script>
    <script src="/js/carrito.js"></script>
</body>
</html>
