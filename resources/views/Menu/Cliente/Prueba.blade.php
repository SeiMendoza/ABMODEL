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

        <!-- CSS Files -->
        <link id="pagestyle" href="/css/argon-dashboard.css" rel="stylesheet" />
        <link rel="stylesheet" href="/css/menuStyles/menuStyles.css" type="text/css">

        <script src="{{ asset("js/sweetalert2.all.min.js") }}"></script>
</head>
<body style="background-color:rgba(207, 207, 207, 0.34); padding:0px; overflow:hidden" class="container-fluid">
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
    
    <div class="col-12 d-flex justify-content-center" style="padding:0px">
        <div class="row">
            <h2 style="background-color: rgba(160, 0, 0, 0.866); padding:0; margin:0;" class="h4 text-light text-xl-center col-12">Menu del Día</h2>
            <div class="col-8" style="padding-right: 0px; ">
                <div class="row container-fluid" style="margin: 0px; padding:0; ">
                    <div class="nav d-flex justify-content-center" style="width: 1100px; background-color: rgba(218, 0, 0, 0.79);">
                        <div class="nav-item" style="margin: 10px 0 0 10px">
                            <form action="{{ route("cliente_menu.search") }}" method="get" role="search" 
                                class="navbar-search">
                                <div class="input-group">
                                    <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 350px" 
                                    placeholder="Buscar por nombre, tamaño, comida/bebida" aria-label="Search" 
                                    aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($text)) {echo $text;} ?>" />
                                    <button class="btn btn-menu my-2 my-sm-0" type="submit"><strong>Buscar</strong></button>    
                                    @if(isset($text)!="")
                                    <a href="{{route('cliente_prueba')}}" style="display:block; float:right"  
                                    class="btn btn-secondary my-2 my-sm-0">Borrar Busqueda</a>
                                @endif
                                </div>   
                            </form>
                        </div>
                        <div style="margin: 10px 0 0 10px;" class=" nav-link-icon">
                            <a href="{{route("index")}}" class="btn btn-menu"><i class="ni ni-palette"></i> Inicio</a>
                        </div>
                    </div>
                </div>
                <div class="row" style="position:absolute; bottom:0%; width: 1040px; background-color: rgba(218, 0, 0, 0.79);">
                    <footer class="container-fluid">
                        <ul
                        class="nav d-flex justify-content-center h4 text-center"
                        role="tablist"
                        style="width: 1005px;">
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
                            >Combos</a
                            >
                        </li>
                        </ul>
                    </footer>
                </div>
                
                <!-- Catalogo de Productos -->
                <div class="table-responsive" style="height: 595px; overflow-y: scroll; overflow-x: hidden;
                    scroll-behavior: smooth;">
                    <section class="NovidadesSection" style="">     
                        <main class="main-content position-relative border-radius-lg">   
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
                                                background: url('/images/1676990534.horchata-1-FP.jpg') top center/cover no-repeat;">
                                                    <div class="text-center" 
                                                            style="text-align:center; ">
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
                                                background: url('/images/1676990334.Pollo-chuco-principal.png') top center/cover no-repeat;">
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
                                <!-- ========== Combos ========== -->
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
                                                background: url('/images/1677456792.tacos.jpg') top center/cover no-repeat;">
                                                    <div class="text-center" 
                                                            style="text-align:center; ">
                                                            <!-- Nombre -->
                                                            <p class="nombre card-title pt-2 text-center text-dark" id="nombre"> 
                                                                <strong style="font-size: 20px; width:194px;
                                                                background-color:rgba(255, 255, 255, 0.736);
                                                                position: absolute; bottom: 12.5%; left:0;">{{$pro->nombre}}</strong>
                                                            </p>                        
                                                            <!-- Precio -->
                                                            <p id="precio" class="precio text-dark text-decoration-line">
                                                                <strong class="precio" style="font-size: 15px; width:194px;
                                                                background-color:rgba(255, 255, 255, 0.727);
                                                                position: absolute; bottom: 0; left:0;">L{{$pro->precio}}.00</strong>
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
            </div>

            <div class="col-4 container-fluid" style="padding: 0px; height: 720px; background-color:rgba(207, 207, 207, 0.34); width: 509px; margin:0">
                <div class="container-fluid" style="padding: 0px;">
                    <form action="{{ route("usuario_pedido.store") }}" id="formulario" name="formulario" method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="nav d-flex justify-content-center" style="background-color:rgba(155, 155, 155, 0.566); height: 67px">
                            <Label class="h4 text-xl-center title col-form-label col-auto" style="width: 270px;" for="mesa">Pedido de la Mesa:</Label>
                            <input type="text" style="width: 40px;" id="mesa" name="mesa" readonly
                            value="1" class="form-control @error('mesa') is-invalid @enderror h4 text-xl-center title col-auto">
                                @error('mesa')
                                        <small class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                        </small>
                                @enderror
                        
                            <br>
                            </div>
                        <div class="row"style="display: none">
                            <div>
                                <input type="number" id="quiosco" name="quiosco" value="1">
                                
                            </div>
                        </div>
                           
                        <div class="row table-responsive" style="height: 560px; width:510px; margin:0; padding:0;">
                            <table class="table table-striped">
                            <thead style="padding-top: 2px;" >
                                <tr class="text-dark">
                                    <th scope="col">Nombre</th>
                                    <th scope="col">Cantidad</th>
                                    <th scope="col">Precio</th>
                                    <th scope="col">Quitar</th>
                                </tr>
                            </thead>
                            <tbody class="tbody" style=" overflow-y: scroll;">
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
                        <div class="col" style="text-align: center; width:510px; background-color:rgba(155, 155, 155, 0.566); position:absolute; bottom:0%;">
                            <a href="#" onclick="cancelar('menu/prueba')" id="cancelar"
                            class="btn btn-danger px-6" style="margin: 4px 1px 4px 1px">Cancelar</a>
                            <a href="#" onclick="guardar()" id="procesar-compra"
                                class="btn btn-success px-6" style="margin: 4px 1px 4px 1px">Guardar</a>
                        </div>
                    </form>
                </div>  
            </div>
        </div>
    </div>

</div>

   
      <script src="/assets/jquery/jquery.js"></script>
      <script src={{ asset("js/core/bootstrap.bundle.min.js") }}></script>
      <script src="/js/compras.js"></script>
</body>
</html>
