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
   
</head>
<body style="">
    <script>
        var msg = '{{Session::get('
        mensaje ')}}';
        var exist = '{{Session::has('
        mensaje ')}}';
        if (exist) {
            Swal.fire({
                position: 'top-end'
                , icon: 'success'
                , title: msg
                , showConfirmButton: false
                , toast: true
                , background: '#fff'
                , timer: 3500
            })
        }

    </script>
    <div class="content-cell" style="margin: 0px; padding:0;">
        <div class="row" style="margin: 0px; padding:0;">
            <div class="col-lg-12" style="margin: 0px; padding:0;">
                <div class="row" style="margin: 0px; padding:0;">
                    <div class="col-lg-7" style="margin: 0px; padding:0;">
                        <div class="table-responsive-lg " style="margin: 0px; padding:0;">
                            <nav aria-label="breadcrumb" style=" margin: 0px; padding:0;" class="bg-gradient-warning">
                                <ol class="breadcrumb bg-gradient-faded-success" style="margin: 0; border-radius:0px; padding:0;">
                                    <li>
                                        <div class="col" style="padding: 0px;">
                                            <a class="navbar-brand m-0" href={{ route('index') }} style="padding:0%; margin:0">
                                                <img src="/img/Villacrisol.png" class="navbar-brand-img" alt="main_logo" style="width: 100px; height: 49px; padding:0%; margin:0">
                                            </a>
                                        </div>
                                    </li>
                                    <li class="d-flex justify-content-center" style="margin: 8px; width:770px">
                                        <H3 class="text-white"><strong>Menú del Día</strong></H3>
                                    </li>
                                </ol>
                            </nav>
                        </div>
                        <div class="table-responsive" 
                            style="display:block; float:left; margin: 0px; margin-top:2px; padding:0; height:650px;">
                            <section style="">
                                <main class=" main-content">
                                    <div class="tab-content"  style="margin: 0px; padding:0; ">
                                        <div class="row row-cols-xs-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4" style="margin: 0px; padding:0;">
                                            @yield('productos')
                                        </div>
                                    </div>
                                </main>
                            </section>
                        </div>
                        <div class="table-responsive-lg" style="text-align:center; margin: 0; padding:0;">
                            <footer class="" style="padding: 0;">
                                <ul class="nav d-flex justify-content-center bg-gradient-faded-success h4 m--1 text-center" role="tablist" style="width:100%; padding: 5px 3px 5px 3px;">
                                    <li class="nav-item" role="button">
                                        <a href="{{route('cart.index')}}" style="margin:1px 3px 1px 3px; padding:10px; width:160px; font-size:15px" type="button" 
                                            class="bg-light border-radius-sm text-center">
                                            <i class="fa-solid fa-utensils text-success"></i> Menú completo 
                                        </a>
                                     </li>
                                    <li class="nav-item" role="button">
                                        <a href="{{route('cart.bebidas')}}" style="margin:1px 3px 1px 3px; padding:10px; width:150px; font-size:15px" type="button" 
                                        class="bg-light border-radius-sm text-center">
                                        <i class="fa-solid fa-wine-glass text-info"></i> Bebidas
                                        </a> 
                                    </li>
                                    <li class="nav-item" role="button">
                                        <a href="{{route('cart.platillos')}}" style="margin:1px 3px 1px 3px; padding:10px; width:150px; font-size:15px" type="button" 
                                        class="bg-light border-radius-sm text-center">
                                        <i class="fa-solid fa-drumstick-bite text-warning"></i> Platillos
                                        </a>
                                    </li>
                                    <li class="nav-item" role="button">
                                        <a href="{{route('cart.complementos')}}" style="margin:1px 3px 1px 3px; padding:10px; width:150px; font-size:15px" type="button" 
                                            class="bg-light border-radius-sm text-center">
                                            <i class="fa-solid fa-plus-circle text-primary"></i> Complementos
                                        </a>
                                    </li>
                                </ul>
                            </footer>
                        </div>
                    </div>
                    
                    <div class="col-lg-5" style="display:block; float:right; margin: 0px; padding:0;">   
                        <div class="row" style="margin: 0px; padding:0;">
                            <nav aria-label="breadcrumb" style=" margin: 0px; padding:0;">
                                <ol class="breadcrumb d-flex justify-content-center bg-gradient-faded-success" style="margin-bottom: 0; border-radius:0px;">
                                    <H3 class="text-white"><strong>Detalles del Pedido</strong></H3>
                                </ol>
                            </nav>
                        </div>                   
                        <div style="">
                            <div class="input-group" style="margin: 0; border: 0; width: 99%">
                                <Label class="h6 col-form-label font-robo" style="margin: 5px 5% 0 3px;" for="mesaP">Pedido de la Mesa:</Label>
                               
                                <select name="mesa" style="height:42px; border-radius:0; margin: 5px 0px 5px 23px;" id="mesa"
                                    class="form-control input--style-2 border-0 ps-2 font-robo" step="0.001" oninput="nombre()">
                                    @if (old('mesa'))
                                    <option disabled="disabled" value="">Seleccione una mesa</option>
                                        @foreach ($mesas as $c)
                                            @if (old('mesa') == $c->id)
                                                <option selected="selected" value="{{$c->id}}">{{$c->nombre}} - Kiosko:
                                                    {{$c->kiosko->codigo}}
                                                </option>
                                               
                                            @else
                                                <option value="{{$c->id}}">{{$c->nombre}} - Kiosko: {{$c->kiosko->codigo}}
                                                </option>
                                                
                                            @endif
                                        @endforeach
                                    @else
                                        <option disabled="disabled" selected="selected" value="">Seleccione una mesa
                                        </option>
                                        @foreach ($mesas as $c)
                                            <option value="{{$c->id}}">{{$c->nombre}} - Kiosko: {{$c->kiosko->codigo}}
                                            </option>
                                            
                                        @endforeach
                                    @endif
                                </select>
                                @error('mesaP')
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
                                @error('nombreC')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>
                        <div style="height: 400px; margin:0px; overflow-y:auto;">
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
                                                    <button type="submit"><i class="fa fa-edit"></i></button>
                                                </div>
                                            </form>
                                        </td>    
                                        <td>
                                            <form method="POST" action="{{route('cart.destroy',$item->id)}}">
                                                @method('DELETE')
                                                @csrf
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
                            <div class="row bg-gradient-faded-success " style="margin: 0; padding: 5px 3px 8px 3px;">
                                <div class="col-6 d-flex justify-content-end" style="margin: 0; padding:0; padding-right:5px">
                                    <form action="{{ route('cart.clear') }}" method="POST">
                                        @csrf
                                        <button id="cancelar" type="submit"class="btn btn-danger border-0 border-radius-sm"
                                            style="margin:0;">Cancelar
                                        </button> 
                                    </form>
                                </div>    
                                <div class="col-6" style="margin: 0; padding:0; padding-left:5px;">
                                    <form method="POST" action="{{route('cart.store')}}">
                                        @csrf
                                        <input type="string" step="0.001" oninput="nombre()" value="{{ old('nombreC') }}" id="nombreC" name="nombreC" hidden>
                                        <input type="string" step="0.001" oninput="nombre()" value="{{  old('mesaP')}}" id="mesaP" name="mesaP" hidden>
                                    <button href="#" type="submit" role="button" id="guardar"
                                    class="btn btn-success border-0 border-radius-sm" style="margin:0; ;">Guardar</button>
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
    <script>   
        function nombre(){
        a = document.getElementById("nombre").value;
        b = document.getElementById("mesa").value;

        document.getElementById("nombreC").value = a;
        document.getElementById("mesaP").value = b;
        };
    </script>
</body>
</html>