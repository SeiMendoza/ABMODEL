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
<body style="background-color:rgba(207, 207, 207, 0.34)">
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
    
    <div class="col-sm-11">
        <h2 style="background-color: rgba(65, 0, 218, 0.293)" class="h4 text-primary text-xl-center">Menu del Día</h2>
        <div class="row">
            <div class="col-sm-8" style="padding-right: 0px">
                <div class="form-group row">
                    <div style="margin:0px">
                        <footer class="container">
                            <ul
                            class="nav d-flex justify-content-center h4 text-center"
                            role="tablist">
                            <li class="nav-item text-primary" role="presentation">
                                <a
                                class="nav-link "
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
                                class="nav-link active"
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
                                class="nav-link"
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
                    <div class="input-group col d-flex justify-content-center" style="width: 400px">
                        <div style="display:block;">
                            <form action="{{ route("cliente_menu.search") }}" method="get" role="search" 
                                class="navbar-search">
                                <div class="input-group">
                                    <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 350px" 
                                    placeholder="Buscar por nombre, tamaño, comida/bebida" aria-label="Search" 
                                    aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($text)) {echo $text;} ?>" />
                                    <button class="btn btn-menu my-2 my-sm-0" type="submit"><strong>Buscar</strong></button>    
                                    <a href="{{route('cliente_prueba')}}" style="display:block; float:right"  
                                    class="btn btn-secondary my-2 my-sm-0">Borrar Busqueda</a>
                                </div>   
                            </form>
                        </div>
                        <div style="">
                            <a href="{{route("index")}}" class="btn btn-menu"><i class="ni ni-palette"></i> Inicio</a>
                        </div>
                    </div>
                </div>
                
                <!-- Catalogo de Productos -->
                <div class="table-responsive" style=" height: 550px; overflow:scroll;">
                    <section class="NovidadesSection">     
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
                                            style="display: grid; grid-template-columns: 150px 150px 155px 155px 150px 150px">
                                            @foreach($bebidas as $pro)
                                            <div class="agregarLista" id=""
                                                    style="display:block;  height: 180px; width: 150px; padding: 3px ">
                                                <div class="card h-100 btn btn-light col d-flex justify-content-center mb-4" data-id="{{$pro->id}}" style="padding: 0px">
                                                    <div class="" style="text-align:center;">
                                                        <div class="text-center">
                                                            <!-- Nombre -->
                                                            <p class="nombre card-title pt-2 text-center text-primary" id="nombre">
                                                                <strong style="font-size: 20px">{{$pro->nombre}}</strong>
                                                            </p>
                                                            <!-- Imagen -->
                                                            <div class="img">
                                                                <img src="/images/1676990334.Pollo-chuco-principal.png"  alt=""
                                                                class="img img-responsive"
                                                                style="width: 100%">
                                                            </div>
                                                            <!-- Precio -->
                                                            <div class="proposito">
                                                                <span id="prop" class="precio text-primary text-decoration-line">
                                                                    <strong style="font-size: 15px">Precio: L{{$pro->precio}}.00</strong>
                                                                </span>
                                                            </div>
                                                        </div>
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
                                            style="display: grid; grid-template-columns: 150px 150px 155px 155px 150px 150px">
                                            @foreach($platillos as $pro)
                                            <div class="agregarLista" id=""
                                                    style="display:block;  height: 180px; width: 150px; padding: 3px ">
                                                <div class="card h-100 btn btn-light col d-flex justify-content-center mb-4" data-id="{{$pro->id}}" style="padding: 0px">
                                                    <div class="" style="text-align:center;">
                                                        <div class="text-center">
                                                            <!-- Nombre -->
                                                            <p class="nombre card-title pt-2 text-center text-primary" id="nombre">
                                                                <strong style="font-size: 20px">{{$pro->nombre}}</strong>
                                                            </p>
                                                            <!-- Imagen -->
                                                            <div class="img">
                                                                <img src="/images/1676990334.Pollo-chuco-principal.png"  alt=""
                                                                class="img img-responsive"
                                                                style="width: 100%">
                                                            </div>
                                                            <!-- Precio -->
                                                            <div class="proposito">
                                                                <span id="prop" class="precio text-primary text-decoration-line">
                                                                    <strong style="font-size: 15px">Precio: L{{$pro->precio}}.00</strong>
                                                                </span>
                                                            </div>
                                                        </div>
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
                                    class="tab-pane fade carrito"
                                    id="pills-contact"
                                    role="tabpanel"
                                    aria-labelledby="pills-contact-tab">
                                    <div class="container-fluid" style="padding: 0px">
                                        <div class="productos" id="productos"
                                            style="display: grid; grid-template-columns: 150px 150px 155px 155px 150px 150px">
                                            @foreach($combos as $pro)
                                            <div class="agregarLista" id=""
                                                    style="display:block;  height: 180px; width: 150px; padding: 3px ">
                                                <div class="card h-100 btn btn-light col d-flex justify-content-center mb-4" data-id="{{$pro->id}}" style="padding: 0px">
                                                    <div class="" style="text-align:center;">
                                                        <div class="text-center">
                                                            <!-- Nombre -->
                                                            <p class="nombre card-title pt-2 text-center text-primary" id="nombre">
                                                                <strong style="font-size: 20px">{{$pro->nombre}}</strong>
                                                            </p>
                                                            <!-- Imagen -->
                                                            <div class="img">
                                                                <img src="/images/1676990334.Pollo-chuco-principal.png"  alt=""
                                                                class="img img-responsive"
                                                                style="width: 100%">
                                                            </div>
                                                            <!-- Precio -->
                                                            <div class="proposito">
                                                                <span id="prop" class="precio text-primary text-decoration-line">
                                                                    <strong style="font-size: 15px">Precio: L{{$pro->precio}}.00</strong>
                                                                </span>
                                                            </div>
                                                        </div>
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

            <div class="col-sm-4" style="padding: 2px; height: 680px; background-color:rgba(207, 207, 207, 0.34); width: 500;">
                <div class="container-fluid" style="padding: 0px;">
                    <div class="wrapper wrapper--w960">
                                <h2 class="h4 text-primary text-xl-center title">Datos del Pedido:</h2>
                                <form action="{{ route("usuario_pedido.store") }}" id="formulario" name="formulario" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <br>
                                    <div class="row">
                                        <div style="display: none">
                                            <input type="number" id="quiosco" name="quiosco" value="1">
                                            <input type="number" id="mesa" name="mesa" value="1">
                                        </div>
                                        <div class="form-floating">
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Ingrese su nombre aquí" value="{{old('name')}}" style="width:300px;">
                                            <label for="name">Ingrese su nombre completo para recibir el pedido</label>
                                            @error('name')
                                            <small class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row" style="height: 450px; width:300px;">
                                        <table class="table">
                                        <thead>
                                            <tr class="text-primary">
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Quitar</th>
                                            </tr>
                                        </thead>
                                        <tbody class="tbody">
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
                                            <h3 class="itemCartTotal text-black">Total: 0</h3>
                                        </div>
                                    </div>
                                    <div class="col" style="text-align: center">
                                        <a href="#" onclick="cancelar('menu/prueba')" id="cancelar"
                                        class="btn btn-danger btn-bold px-4 float-right mt-2 mt-lg-0 mr-2">Cancelar</a>
                                    <a href="#" onclick="guardar()" id="procesar-compra"
                                            class="btn btn-success btn-bold px-4 float-right mt-3 mt-lg-0 mr-2">Guardar</a>
                                    </div>
                                </form>
                    </div>
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
