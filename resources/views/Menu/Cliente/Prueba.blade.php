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
<body>
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
    <header class="container-fluid d-flex justify-content-center bg-primary position-absolute top-0 ">
        <ul
          class="nav nav-pills mb-3 py-3 container"
          id="pills-tab"
          role="tablist"
        >
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
              >Home</a
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
              >Productos</a
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
              >Carrito</a
            >
          </li>
        </ul>
    </header>
      <br><br><br>
      
    <main class="main-content position-relative border-radius-lg">
        
       <div class="tab-content" id="pills-tabContent">
            <!-- ========== Home ========== -->
            <div
                class="tab-pane fade "
                id="pills-home"
                role="tabpanel"
                aria-labelledby="pills-home-tab">
                <h2 class="h4 m-4 text-primary text-center">Bienvenido</h2>
                <div class="text-center"><img src="/images/1676864657.scorpions.jpg" alt="imagen" style="height: 300px;">
                </div><br>
                <div class="text-center">
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cumque, rerum eligendi, 
                        nam molestiae minima perferendis autem ipsam saepe sapiente fugit aut facere facilis 
                        sint iusto iure asperiores aspernatur! Vitae, adipisci. Lorem, ipsum dolor sit amet consectetur 
                        adipisicing elit. Recusandae, numquam mollitia dicta non aperiam aliquam blanditiis quae aspernatur hic suscipit 
                        incidunt provident et explicabo quisquam illo voluptas, deserunt quasi dolore.
                        Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cumque, rerum eligendi, 
                        nam molestiae minima perferendis autem ipsam saepe sapiente fugit aut facere facilis 
                        sint iusto iure asperiores aspernatur! Vitae, adipisci. Lorem, ipsum dolor sit amet consectetur 
                        adipisicing elit. Recusandae, numquam mollitia dicta non aperiam aliquam blanditiis quae aspernatur hic suscipit 
                        incidunt provident et explicabo quisquam illo voluptas, deserunt quasi dolore.
                    </p>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cumque, rerum eligendi, 
                        nam molestiae minima perferendis autem ipsam saepe sapiente fugit aut facere facilis 
                        sint iusto iure asperiores aspernatur! Vitae, adipisci.
                    </p>
                    <br>
                    <p>Lorem ipsum dolor sit, amet consectetur adipisicing elit. Cumque, rerum eligendi, 
                        nam molestiae minima perferendis autem ipsam saepe sapiente fugit aut facere facilis 
                        sint iusto iure asperiores aspernatur! Vitae, adipisci.
                    </p>
                </div>
            </div>
            <!-- ========== Menu Cards ========== -->
            <div
                class="tab-pane fade show active container"
                id="pills-profile"
                role="tabpanel"
                aria-labelledby="pills-profile-tab">
                <h2 class="h4 m-4 text-primary text-xl-center">Menu del Día</h2>
                <div class="container-fluid">
                    <div>
                        <header class="container bg-light position-absolute d-flex justify-content-center">
                            <ul
                              class="nav"
                              id="pills-menu"
                              role="tablist"

                            > 
                            <li class="nav-item" role="presentation">
                                <a
                                  class="nav-link active"
                                  id="pills-platillos-tab"
                                  data-bs-toggle="pill"
                                  data-bs-target="#pills-platillos"
                                  type="button"
                                  role="tab"
                                  aria-controls="pills-platillos"
                                  aria-selected="true"
                                  >Platillos</a
                                >
                              </li>
                              <li class="nav-item text-primary" role="presentation">
                                <a
                                  class="nav-link "
                                  id="pills-bebidas-tab"
                                  data-bs-toggle="pill"
                                  data-bs-target="#pills-bebidas"
                                  type="button"
                                  role="tab"
                                  aria-controls="pills-bebidas"
                                  aria-selected="false"
                                  >Bebidas</a
                                >
                              </li>
                              <li class="nav-item" role="presentation">
                                <a
                                  class="nav-link"
                                  id="pills-combos-tab"
                                  data-bs-toggle="pill"
                                  data-bs-target="#pills-combos"
                                  type="button"
                                  role="tab"
                                  aria-controls="pills-combos"
                                  aria-selected="false"
                                  >Combos</a
                                >
                              </li>
                                <li class="justify-content-end">
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
                                </li>
                                <li class="justify-content-end">
                                    <div style="">
                                        <a href="{{route("index")}}" class="btn btn-menu"><i class="ni ni-palette"></i> Inicio</a>
                                    </div>
                                </li>
                                
                            </ul>
                        </header> <br><br><br><br>
                    </div>
                    <div
                        class="tab-pane fade show active container"
                        id="pills-platillos"
                        role="tabpanel"
                        aria-labelledby="pills-platillos-tab">
                        <div class="card-group row" style="display: flex">
                            <div class="row">   
                                <!-- ========== Platillos ========== -->
                                @forelse ($platillos as $p)
                                    <div class="col d-flex justify-content-center mb-4">
                                        <div class="card shadow mb-1 bg-light rounded" style="width: 20rem;">
                                            <h5 class="card-title pt-2 text-center text-primary">{{$p->nombre}}</h5>
                                            <img src="/images/1676991488.Pollo-chuco-principal.png" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <p class="card-text description">{{$p->descripcion}}</p>
                                                <h5 class="text-primary">Precio: <span class="precio">L. {{$p->precio}}</span></h5>
                                                <div class="d-grid gap-2">
                                                    <button  class="btn btn-primary button">Añadir a Carrito</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                @empty
                                    <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4 text-center">No hay registros</div>
                                @endforelse               
                            </div>
                        </div>
                    </div>
                    <div
                        class="tab-pane fade"
                        id="pills-bebidas"
                        role="tabpanel"
                        aria-labelledby="pills-bebidas-tab">
                        <div class="card-group row" style="display: flex">
                            <div class="row">   
                                <!-- ========== Platillos ========== -->
                                @forelse ($bebidas as $p)
                                    <div class="col d-flex justify-content-center mb-4">
                                        <div class="card shadow mb-1 bg-light rounded" style="width: 20rem;">
                                            <h5 class="card-title pt-2 text-center text-primary">{{$p->nombre}}</h5>
                                            <img src="/images/1676991488.Pollo-chuco-principal.png" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <p class="card-text description">{{$p->descripcion}}</p>
                                                <h5 class="text-primary">Precio: <span class="precio">{{$p->precio}}</span></h5>
                                                <div class="d-grid gap-2">
                                                    <button  class="btn btn-primary button">Añadir a Carrito</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                @empty
                                    <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4 text-center">No hay registros</div>
                                @endforelse               
                            </div>
                        </div>
                    </div>
                    <div
                    class="tab-pane fade"
                    id="pills-combos"
                    role="tabpanel"
                    aria-labelledby="pills-combos-tab">
                        <div class="card-group row" style="display: flex">
                            <div class="row">   
                                <!-- ========== Platillos ========== -->
                                @forelse ($combos as $p)
                                    <div class="col d-flex justify-content-center mb-4">
                                        <div class="card shadow mb-1 bg-light rounded" style="width: 20rem;">
                                            <h5 class="card-title pt-2 text-center text-primary">{{$p->nombre}}</h5>
                                            <img src="/images/1676991488.Pollo-chuco-principal.png" class="card-img-top" alt="...">
                                            <div class="card-body">
                                                <p class="card-text description">{{$p->descripcion}}</p>
                                                <h5 class="text-primary">Precio: <span class="precio">{{$p->precio}}</span></h5>
                                                <div class="d-grid gap-2">
                                                    <button  class="btn btn-primary button">Añadir a Carrito</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div> 
                                @empty
                                    <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4 text-center">No hay registros</div>
                                @endforelse               
                            </div>
                        </div>
                    </div>
                    
                </div>
            
                <!-- ========== End Cards ========== -->
    
            </div>
            <!-- ========== Carrito ========== -->
            <div
            class="tab-pane fade carrito"
            id="pills-contact"
            role="tabpanel"
            aria-labelledby="pills-contact-tab">
                <div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
                    <div class="wrapper wrapper--w960">
                        <div class="card card-2">
                            <div class="card-body">
                                <h2 class="title">Datos del Pedido:</h2>
                                <form action="{{ route("usuario_pedido.store") }}" id="formulario" name="formulario" method="POST" enctype="multipart/form-data">
                                    @csrf
                                    <br>
                                    <div class="row mt-3">
                                        <div style="display: none">
                                            <input type="number" id="quiosco" name="quiosco" value="1">
                                            <input type="number" id="mesa" name="mesa" value="1">
                                        </div>
                                        <div class=" form-floating">
                                            <input type="text" name="name" id="name" class="form-control @error('name') is-invalid @enderror"
                                            placeholder="Ingrese su nombre aquí" value="{{old('name')}}">
                                            <label for="name">Ingrese su nombre completo para recibir el pedido</label>
                                            @error('name')
                                            <small class="invalid-feedback">
                                            <strong>{{ $message }}</strong>
                                            </small>
                                            @enderror
                                        </div>
                                    </div>
                                    <table class="table table-ligth table-hover ">
                                        <thead>
                                            <tr class="text-primary">
                                                <th scope="col">#</th>
                                                <th scope="col">Productos</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col">Cantidad</th>
                                                <th scope="col">Sub-Total</th>
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
                                    <div class="row mx-4">
                                        <div class="col d-flex justify-content-end">
                                            <h3 class="itemCartTotal text-black">Total: 0</h3>
                                        </div>
                                    </div>
                                    <div class="col" style="text-align: center">
                                        <a href="#" onclick="cancelar('menu/prueba')" id="cancelar"
                                        class="btn btn-danger btn-bold px-4 float-right mt-2 mt-lg-0 mr-2">Cancelar</a>
                                        <a href="{{route("cliente_prueba")}}" id="cancelar"
                                        class="btn btn-primary btn-bold px-4 float-right mt-2 justify-content-center
                                        mt-lg-0 mr-2" style="width: 400px">Regresar al menú</a>
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
    </main>
      <script src="/assets/jquery/jquery.js"></script>
      <script src={{ asset("js/core/bootstrap.bundle.min.js") }}></script>
      <script src="/js/compras.js"></script>
</body>
</html>
