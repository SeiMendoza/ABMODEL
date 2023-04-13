<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="theme-color" content="#bla"  />
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
            <div class="nav d-flex justify-content-start bg-warning" style="margin: 0px; padding:0;">
                <h3 style="padding:0; margin:1% 41% 0 1%; " class="text-white title font-robo">Menú del Día</h3>
                <div class="nav-link-icon navbar-search" style="margin: 10px 0 0 0px;">
                    <input id="myInput" type="text" placeholder="Buscar en el menú" style="width: 300px; height:42px" class="border-0 border-radius-sm">
                </div>
                <div style="margin: 10px 0 0 8px;" class=" nav-link-icon d-flex justify-content-end">
                    <a href="{{route("index")}}" class="btn btn-menu text-warning border-0 border-radius-sm"><i class="ni ni-palette text-warning"></i> Inicio</a>
                </div>
            </div>
            <!-- Catalogo de Productos -->
            <div class="table-responsive" style="height: 636px; overflow-y: auto; overflow-x: hidden;
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
                                    <div class="productos" id="productos" name="productos"
                                        style="display: grid; grid-template-columns: 200px 200px 210px 200px 200px">
                                        @foreach($bebidas as $pro)
                                        <form action="{{route('cliente_menu.details')}}" method="post">
                                            @csrf
                                        <input type="text" id="pedido" name="pedido" value="{{$pedido->id}}" hidden> 
                                        <input type="text" id="nombre" name="nombre" value="{{$pro->nombre}}" hidden>
                                        <input type="number" id="cantidad" name="cantidad" value="1" hidden>
                                        <input type="text" id="producto" name="producto" value="{{$pro->id}}" hidden>
                                        <input type="text" id="precio" name="precio" value="{{$pro->precio}}" hidden>
                                        <div class="container-fluid agregarCarrito" id="carritoA" 
                                                style="display:block;  height: 200px; width: 200px; padding: 3px ">
                                            <button class="card h-100 btn btnCard" id="btn" type="submit" 
                                                data-id="{{$pro->id}}" style="padding: 0px; width:100%; border-radius:0%;
                                                background: url('/images/{{ $pro->imagen }}') top center/cover no-repeat;">
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
                                            </button>
                                        </div>
                                        </form>
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
                                    <div class="productos" id="productos" name="productos"
                                        style="display: grid; grid-template-columns: 200px 200px 210px 200px 200px">
                                        @foreach($platillos as $pro)
                                        <form action="{{route('cliente_menu.details')}}" method="post">
                                            @csrf
                                        <input type="text" id="pedido" name="pedido" value="{{$pedido->id}}" hidden> 
                                        <input type="text" id="nombre" name="nombre" value="{{$pro->nombre}}" hidden>
                                        <input type="number" id="cantidad" name="cantidad" value="1" hidden>
                                        <input type="text" id="producto" name="producto" value="{{$pro->id}}" hidden>
                                        <input type="text" id="precio" name="precio" value="{{$pro->precio}}" hidden>
                                        <div class="container-fluid agregarCarrito" id="carritoA" 
                                                style="display:block;  height: 200px; width: 200px; padding: 3px ">
                                            <button class="card h-100 btn btnCard" id="btn" type="submit" 
                                                data-id="{{$pro->id}}" style="padding: 0px; width:100%; border-radius:0%;
                                                background: url('/images/{{ $pro->imagen }}') top center/cover no-repeat;">
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
                                            </button>
                                        </div>
                                        </form>
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
                                <div class="container-fluid" style="padding: 0px" id="xd">
                                    <div class="productos" id="productos" name="productos"
                                        style="display: grid; grid-template-columns: 200px 200px 210px 200px 200px">
                                        @foreach($combos as $pro)
                                        <form action="{{route('cliente_menu.details')}}" method="post">
                                            @csrf
                                        <input type="text" id="pedido" name="pedido" value="{{$pedido->id}}" hidden> 
                                        <input type="text" id="nombre" name="nombre" value="{{$pro->nombre}}" hidden>
                                        <input type="number" id="cantidad" name="cantidad" value="1" hidden>
                                        <input type="text" id="producto" name="producto" value="{{$pro->id}}" hidden>
                                        <input type="text" id="precio" name="precio" value="{{$pro->precio}}" hidden>
                                        <div class="container-fluid agregarCarrito" id="carritoA" 
                                                style="display:block;  height: 200px; width: 200px; padding: 3px ">
                                            <button class="card h-100 btn btnCard" id="btn" type="submit" 
                                                data-id="{{$pro->id}}" style="padding: 0px; width:100%; border-radius:0%;
                                                background: url('/images/{{ $pro->imagen }}') top center/cover no-repeat;">
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
                                            </button>
                                        </div>
                                        </form>
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
                <div class="nav d-flex justify-content-center bg-gradient-warning" style="height: 67px; width: 100%">
                    <h3 style="padding:0; margin:2% 0% 0 1%; " class="text-white title font-robo">Pedido</h3>  
                    <br><br>
                </div> 
                <div class="row table-responsive" id="carrito" style="height: 22.4rem; width:100%; margin:0">
                    <table class="tab" id="lista">
                    <thead style="padding-top: 2px;">
                        <tr class="text-dark">
                            <th scope="col" style="width:20%">Nombre</th>
                            <th scope="col" style="width:20%; text-align:center;">Cantidad</th>
                            <th scope="col" style="width:20%; text-align:right;">Precio</th>
                            <th scope="col" style="width:20%; text-align:right;">Sub-total</th>
                            <th scope="col" style="width:20%; text-align:center;">Quitar</th>
                        </tr>
                    </thead>
                    <tbody class="col" style="overflow:auto;" id="">
                        @php
                            $sum = 0;
                        @endphp
                        @forelse($detalles as $i => $detalle)
                            
                            <tr>
                                <td scope="" class="" style="width:20%; text-align:left; height:42px;">{{$detalle->nombre}}</td>
                                <td scope=""  style=" width:20%; text-align:center; height:42px;"><input type="number" class="border-0 border-radius-sm" 
                                    style="width: 80px" min="1" max="2000" maxlength="4" minlength="1" value="{{ $detalle->cantidad }}"></td>
                                <td scope="col" style="text-align:right; width:20%; height:42px;">L {{ number_format($detalle->precio, 2, ".", ",") }}</td>
                                <td scope="col" style="text-align:right; height:42px;">L {{ number_format($detalle->precio*$detalle->cantidad, 2, ".", ",") }}</td>
                                <td scope="col" style="text-align: center; height:42px;">
                                    <form action="{{route('cliente_detalles.destroy', ['id' => $detalle->id])}}" id="borrar" method="post" enctype="multipart/form-data">
                                        @method('delete')
                                        @csrf
                                        <button onclick="borrar()"  style="border: 0; padding:0; margin:0;" >
                                            <i class="fa-solid fa-trash-can text-danger" style="border: 0; padding:0; margin:0;"></i></button>
                                    </form>
                                </td>
                            </tr>
                            @php
                                $sum += $detalle->precio*$detalle->cantidad;
                            @endphp
                            
                        @empty
                            <tr>
                                <td colspan="8">Vacio</td>
                            </tr>
                        @endforelse
                    </tbody>
                    </table>
                </div>
                <div class="nav d-flex justify-content-center bg-gradient-warning" style="height: 40px; width: 100% ">
                    <h5 style="padding:0; margin:1% 0% 0 0%; " class="text-white title font-robo">Datos:</h5>  
                    <br><br>
                </div>
                <form action="{{ route('cliente_pedido.store') }}" id="formulario" name="formulario" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="width: 99%">
                        <div class="input-group" style="">
                            <Label class="h6 title col-form-label font-robo" style="margin: 1% 5% 0 0;" for="mesa">Pedido de la Mesa:</Label>
                            <select name="mesa" required style="height:42px; border-radius:0; margin: 4px 0px 5px 23px;" id="mesa"
                                class="form-control input--style-2 border-0 ps-2 font-robo">
                                <option disabled="disabled" selected="selected" >Mesa</option>
                                @foreach($mesas as $m)
                                    <option value="{{$m->id}}">{{$m->nombre}}</option>
                                @endforeach
                            </select>
                            @error('mesa')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                            @foreach($mesas as $m)
                                <input type="text" value="{{$m->kiosko_id}}" id="kiosko" name="kiosko" hidden>
                            @endforeach
                        </div>
                        <div class="input-group" >
                            <label class="h6 text-xl-center title col-form-label col-auto" for="nombre" style="margin: 0 5% 0 0;">Nombre del cliente:</label>
                            <input name="nombre" type="text" class="ps-2 input--style-2 form-control border-0 border-radius-sm" id="nombre" maxlength="50" minlength="3"
                                required placeholder="Ingrese el nombre" value="{{ old('nombre') }}" style="margin: 0px 0px 5px 20px; height:42px;">
                            <div class="invalid-feedback">  
                            </div>
                            @error('nombre')
                                <span class="menerr" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>                        
                        <div class="input-group" >
                            <label class="h6 text-xl-center title col-form-label col-auto" for="sub" style="margin: 0 17% 0 0;">Sub-Total: L</label>
                            <input class="ps-2 input--style-2 form-control border-0 border-radius-sm opacity-5" id="sub"
                                name="sub" type="text" style="height:42px; margin: 0px 0px 5px 16px; padding:0; text-align:right;"  
                                value="{{number_format($sum - $sum*0.15, 2, ".", ",")}}"></input>
                        </div>                   
                        <div class="input-group" >
                            <label class="h6 text-xl-center title col-form-label col-auto" for="isv" style="margin: 0 19% 0 0;">ISV 15%: L</label>
                            <input class="ps-2 input--style-2 form-control border-0 border-radius-sm opacity-5" id="isv" name="isv" 
                            type="text" style="margin: 0px 0px 5px 16px; padding:0; text-align:right; height:42px;" 
                            value="{{number_format($sum*0.15, 2, ".", ",")}}">
                        </div>                 
                        <div class="input-group" >
                            <label class="h6 text-xl-center title col-form-label col-auto" for="total" style="margin: 0 24% 0 0;">Total: L</label>
                            <input class="ps-2 input--style-2 form-control border-0 border-radius-sm" type="text" id="total" name="total"  
                            style=" margin: 0px 0px 4px 16px; padding:0; text-align:right; height:42px;"
                            value="{{number_format($sum, 2, ".", ",")}}"></input>
                        </div> 
                    </div>
                    <div class="bg-gradient-warning d-flex align-content-start" style="text-align: center; width:100%;">
                        <a href="#" onclick="cancelar('menu/prueba')" id="cancelar"
                        class="btn btn-danger px-6 border-0 border-radius-sm" style="margin: 4px 5px 3.5px 30px;">Cancelar</a>
                        <button href="{{route('cliente_prueba')}}" onclick="guardar()" id="procesar-compra"
                            class="btn btn-success px-6 border-0 border-radius-sm" style="margin: 4px 5px 3.5px 30px;">Guardar</button>  
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

    <script>
    function guardar() {
    var formul = document.getElementById("formulario");
    formul.submit();
    }
    function borrar() {
    var formul = document.getElementById("borrar");
    formul.submit();
    }
    function cancelar(ruta) {
    // var c = document.getElementById('cancelar');
    Swal
        .fire({
            title: "¿Cancelar pedido?",
            text: "¿Desea cancelar lo que esta haciendo?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "Si",
            cancelButtonText: "No",
        })
        .then(resultado => {
            if (resultado.value) {
                // Hicieron click en "Sí"
                window.location.href = '/' + ruta;
            } else {
                // Dijeron que no
            }
        });
    localStorage.clear();
}
    </script>
</body>
</html>
