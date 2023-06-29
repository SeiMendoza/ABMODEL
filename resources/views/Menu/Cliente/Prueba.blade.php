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
        <link id="pagestyle" href="/css/argon-dashboard.css?v=2.0.4" rel="stylesheet">
        <link href="/css/main.css" rel="stylesheet" media="all">

        <script src="{{ asset("js/sweetalert2.all.min.js") }}"></script>
</head>
<body class="g-sidenav-show bg-gray-100" style="overflow-x:hidden;" >
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
    
    <div class="" style="width: 100%; padding:0; margin:0; ">
        <div class="" style="margin: 0px; padding:0; width: 67%; display:block; float:left">
            <div id="" style="width: 100%; height:60px;" class="bg-warning">
                <div class="" style="margin:0 0 0 0%; width:14%; padding:0%; display:block; float:left">
                <a class="navbar-brand m-0" href={{ route('index') }} style="padding:0%; margin:0">
                    <img src="/img/Villacrisol.png" class="navbar-brand-img" alt="main_logo" style="width: 100%; height:60px;">
                </a>
                </div>
                <div class="" style="margin:0% 0% 0 1%; width:83.8%;  height:60px; padding:0%; display:block; float:left">    
                    <nav class="navbar navbar-main navbar-expand-lg shadow-none border-radius-xl " id="navbarBlur"
                        data-scroll="false" style="padding: 0;">
                        <nav aria-label="breadcrumb" style=" display:block; float:left;">
                            <ol class="breadcrumb bg-transparent" style="margin: 1% 0 0% 0; padding:0;">
                                <li class="breadcrumb-item text-sm"><h2 class="font-weight-bolder text-white " style="margin:0">Menú del día</h2></li>
                            </ol> 
                        </nav>
                        <div class="collapse navbar-collapse" id="navbar" style="display:block; float:right; height:75px; margin-top:2%">
                            <div class="ms-md-auto" style="float:inline-end">  
                                <div class="input-group">
                                    <span class="input-group-text text-body"><i class="fas fa-search"
                                            aria-hidden="true"></i></span>
                                    <input type="text" class="form-control" placeholder="Busqueda..." name="myInput" id="myInput">
                                </div> 
                            </div>
                        </div>
                    </nav>
                </div>
            </div>
           
            <!-- Catalogo de Productos -->
            <div class="table-responsive" style="height: 628px; overflow-y: auto; overflow-x: auto; 
                scroll-behavior: smooth; margin-top:5px">
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
                                        @foreach($productos as $pro)
                                        @if ($pro->tipo === 1)
                                            <form action="{{route('cliente_menu.details')}}" method="post">
                                                @csrf
                                                <input type="text" id="pedido" name="pedido" value="{{$pedido->id}}" hidden> 
                                                <input type="text" id="nombre" name="nombre" value="{{$pro->nombre}}" hidden>
                                                <input type="number" id="cantidad" name="cantidad" value="1" hidden>
                                                <input type="text" id="producto" name="producto" value="{{$pro->id}}" hidden>
                                                <input type="text" id="precio" name="precio" value="{{$pro->precio}}" hidden>
                                                <div class="container-fluid agregarCarrito" id="carritoA" 
                                                        style="display:block; height: 200px; width: 200px; padding: 3px ">
                                                    <button class="card h-100 btn btnCard" id="btn" type="submit" 
                                                        data-id="{{$pro->id}}" style="padding: 0px; width:100%; border-radius:0%;
                                                        background: url('../{{ $pro->imagen }}') top center/cover no-repeat;">
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
                                                            position: absolute; bottom: 0; left:0;">L {{number_format($pro->precio, 2, ".", ",")}}</strong>
                                                        </p>                        
                                                        </div>
                                                    </button>
                                                </div>
                                            </form> 
                                        @endif
                                        
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
                                        @foreach($productos as $pro)
                                        @if ($pro->tipo === 2)
                                            <form action="{{route('cliente_menu.details')}}" method="post">
                                                @csrf
                                                <input type="text" id="pedido" name="pedido" value="{{$pedido->id}}" hidden> 
                                                <input type="text" id="nombre" name="nombre" value="{{$pro->nombre}}" hidden>
                                                <input type="number" id="cantidad" name="cantidad" value="1" hidden>
                                                <input type="text" id="producto" name="producto" value="{{$pro->id}}" hidden>
                                                <input type="text" id="precio" name="precio" value="{{$pro->precio}}" hidden>
                                                <div class="container-fluid agregarCarrito" id="carritoA" 
                                                        style="display:block; height: 200px; width: 200px; padding: 3px ">
                                                    <button class="card h-100 btn btnCard" id="btn" type="submit" 
                                                        data-id="{{$pro->id}}" style="padding: 0px; width:100%; border-radius:0%;
                                                        background: url('../{{ $pro->imagen }}') top center/cover no-repeat;">
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
                                                            position: absolute; bottom: 0; left:0;">L {{number_format($pro->precio, 2, ".", ",")}}</strong>
                                                        </p>                        
                                                        </div>
                                                    </button>
                                                </div>
                                            </form> 
                                        @endif
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
                                        @foreach($productos as $pro)
                                        @if ($pro->tipo === 0)
                                            <form action="{{route('cliente_menu.details')}}" method="post">
                                                @csrf
                                                <input type="text" id="pedido" name="pedido" value="{{$pedido->id}}" hidden> 
                                                <input type="text" id="nombre" name="nombre" value="{{$pro->nombre}}" hidden>
                                                <input type="number" id="cantidad" name="cantidad" value="1" hidden>
                                                <input type="text" id="producto" name="producto" value="{{$pro->id}}" hidden>
                                                <input type="text" id="precio" name="precio" value="{{$pro->precio}}" hidden>
                                                <div class="container-fluid agregarCarrito" id="carritoA" 
                                                        style="display:block; height: 200px; width: 200px; padding: 3px ">
                                                    <button class="card h-100 btn btnCard" id="btn" type="submit" 
                                                        data-id="{{$pro->id}}" style="padding: 0px; width:100%; border-radius:0%;
                                                        background: url('../{{ $pro->imagen }}') top center/cover no-repeat;">
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
                                                            position: absolute; bottom: 0; left:0;">L {{number_format($pro->precio, 2, ".", ",")}}</strong>
                                                        </p>                        
                                                        </div>
                                                    </button>
                                                </div>
                                            </form> 
                                        @endif
                                        
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
        <div class="bg-gradient-faded-white" style="padding: 0px; width: 33%; margin: 0; display:block; float:left">
            <div class="container-fluid " style="padding: 0px;">
                <div class="nav d-flex justify-content-center bg-gradient-warning" style="height: 60px; width: 99%">
                    <h3 style="padding:0; margin:15px 0% 0 5px; " class="text-white title font-robo">Pedido</h3> 
                    <br><br>
                </div> 
                <div style="height: 377px; margin:0px; margin-top:101px; overflow-y:auto;">
                    <div class="row" id="carrito" style="margin: 0; padding:0;">
                        <table class="table overflow-auto" id="lista" style="margin: 0; padding:0;">
                        <thead style="padding-top: 2px;">
                            <tr class="text-dark">
                                <th scope="col" style="padding:3px; text-align:;">Nombre</th>
                                <th scope="col" style="padding:3px; text-align:center;">Cantidad</th>
                                <th scope="col" style="padding:3px; text-align:right;">Precio</th>
                                <th scope="col" style="padding:3px; text-align:right;">Sub-total</th>
                                <th scope="col" colspan="2" style="padding:3px; text-align:center;">Elementos</th>
                            </tr>
                        </thead>
                        <tbody class="col"  id="" >
                            @php
                                $sum = 0;
                            @endphp
                            @forelse($detalles as $i => $detalle)
                                <tr style="">  
                                    <td scope="" class="" style="width:5%; text-align:left;">{{$detalle->producto->nombre}}</td>
                                    <form action="{{route('cliente_detalles.edit', ['id' => $detalle->id])}}" method="post">
                                        @method('put')
                                        @csrf
                                        <td scope=""  style="width:4%; text-align:center; "><input type="number" 
                                            id="numb" name="numb" class="border-0 border-radius-sm" 
                                            style="" min="1" max="2000" maxlength="4" minlength="1" value="{{old('numb', $detalle->cantidad) }}">
                                            @error('numb')
                                            <small class="invalid-feedback">
                                                <strong>{{ $message }}</strong>
                                            </small>
                                            @enderror
                                        </td>
                                        <td scope="col" style="text-align:right; width:4%; ">L {{ number_format($detalle->precio, 2, ".", ",") }}</td>
                                        <td scope="col" style="text-align:right; width:4%; ">L {{ number_format($detalle->precio*$detalle->cantidad, 2, ".", ",") }}</td>
                                        <td scope="col" style="text-align: right; width:4%;">
                                            <button style="border: 0; padding:0; margin:0;" >
                                            <i class="fas fa-edit text-success" style="border: 0; padding:0; margin:0;"></i></button> 
                                        </td>     
                                    </form>
                                    <td scope="col" style=" width:4%;">
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
                </div>
                <form action="{{ route('cliente_pedido.store') }}" id="formulario" name="formulario" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div style="width: 99%" class="">
                        <div style="position:absolute; top: 60px; width: 33%">
                            <div class="input-group" style="margin: 0; border: 0; width: 99%">
                                <Label class="h6 col-form-label font-robo" style="margin: 5px 5% 0 0;" for="mesa">Pedido de la Mesa:</Label>
                                <select name="mesa" style="height:42px; border-radius:0; margin: 5px 0px 5px 23px;" id="mesa"
                                    class="form-control input--style-2 border-0 ps-2 font-robo">
                                    @if (old('mesa'))
                                    <option disabled="disabled" value="">Seleccione una mesa</option> 
                                    @foreach ($mesas as $c)
                                        @if (old('mesa') == $c->id)
                                            <option selected="selected" value="{{$c->id}}">{{$c->nombre}} - Kiosko: {{$c->kiosko->codigo}}</option>
                                        @else
                                            <option value="{{$c->id}}">{{$c->nombre}} - Kiosko: {{$c->kiosko->codigo}}</option>
                                        @endif
                                    @endforeach 
                                @else
                                    <option disabled="disabled" selected="selected" value="">Seleccione una mesa</option> 
                                    @foreach ($mesas as $c)
                                        <option value="{{$c->id}}">{{$c->nombre}} - Kiosko: {{$c->kiosko->codigo}}</option>
                                    @endforeach 
                                @endif
                                </select>
                                @error('mesa')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                                <input type="number" value="{{$pedido->id}}" id="pedido" name="pedido" hidden>          
                            </div>
                            <div class="input-group" style="margin: 0; border: 0; width: 99%">
                                <label class="h6 font-robo col-form-label" for="nombre" style="margin: 0 5% 0 0;">Nombre del cliente:</label>
                                <input name="nombre" type="text" class="ps-2 input--style-2 form-control border-0 border-radius-sm" id="nombre" maxlength="50" minlength="3"
                                    placeholder="Ingrese el nombre" value="{{ old('nombre',) }}" style="margin: 0px 0px 5px 20px; height:42px;">
                                <div class="invalid-feedback">  
                                </div>
                                @error('nombre')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        @php
                            $sub = number_format($sum - $sum*0.15, 2, ".", ",");
                            $isv = number_format($sum*0.15, 2, ".", ",");
                            $tot = number_format($sum, 2, ".", ",");
                        @endphp
                        @if ($sum > 0.00)
                            <input type="number" name="t" id="t" value="{{$sum}}" hidden>
                        @else
                            <input type="number" name="t" id="t" value="" hidden>
                            @error('t')
                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        @endif     
                        <div class="" style="margin: 0; margin-top:15px; padding:0">
                            <div class="input-group" style="margin: 0; border: 0;">
                                <label class="h6 font-robo col-form-label" for="sub" style="margin: 0 15% 0 0;">Sub-Total: L</label>
                                <input class="ps-2 input--style-2 form-control border-0 border-radius-sm bg-gradient-faded-white" id="sub"
                                    name="sub" type="text" style="height:42px; margin: 0px 0px 5px 20px; padding:0; 
                                    padding-right: 10px; text-align:right;"  
                                    value="{{number_format($sum - $sum * 0.15, 2, ".", ",")}}" required readonly>
                            </div>                   
                            <div class="input-group" style="margin: 0;  border: 0;">
                                <label class="h6 text-xl-center col-form-label col-auto" for="isv" style="margin: 0 15% 0 0;">ISV 15%: L</label>
                                <input class="ps-2 input--style-2 form-control border-0 border-radius-sm bg-gradient-faded-white" id="isv" name="isv" 
                                type="number" style="margin: 0px 0px 5px 30px; padding:0; text-align:right; height:42px;" 
                                value="{{number_format($sum * 0.15, 2, ".", ",")}}" required readonly>
                            </div>                 
                            <div class="input-group" style="margin: 0;  border: 0;">
                                <label class="h6 text-xl-center col-form-label col-auto" for="total" style="margin: 0 15% 0 0;">Total: L</label>
                                <input class="ps-2 input--style-2 form-control border-0 border-radius-sm bg-gradient-faded-white" 
                                min="1" type="number"  
                                style=" margin: 0px 0px 4px 55px; padding:0; text-align:right; height:42px;"
                                value="{{$sum}}" required readonly>
                            </div> 
                        </div>
                    </div>
                    <div class="bg-gradient-warning" style="text-align: center; width:99%; height:49px; margin:0;">
                        <a href="#" onclick="cancelar('menu/prueba')" id="cancelar"
                        class="btn btn-danger border-0 border-radius-sm" style="margin-top:5px">Cancelar</a>
                        <button href="#" id="cancelar" type="submit"
                        class="btn btn-success border-0 border-radius-sm" style="margin-top:5px">Guardar</button>
                    </div>
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
            $("#productos button").filter(function() {
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
