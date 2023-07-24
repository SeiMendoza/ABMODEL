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
    <link href="/assets/fontawesome/css/font-awesome.min.css" rel="" media="all">
    <link rel="stylesheet" href={{ url('css/app.css') }}>

    <!-- CSS Files -->
    <!-- <link id="pagestyle" href="/css/argon-dashboard.css?v=2.0.4" rel="stylesheet"> -->
    <link href="/css/argon-dashboard.min.css" rel="stylesheet" media="all">
    <link href="/css/main.css" rel="stylesheet" media="all">

    <script src="{{ asset("js/sweetalert2.all.min.js") }}"></script>
   
</head>
<body style="">
    <div class="content-cell" style="margin: 0px; padding:0;">
        <div class="row" style="margin: 0px; padding:0;">
            <div class="col-lg-12" style="margin: 0px; padding:0;">
                <div class="row" style="margin: 0px; padding:0;">
                    <div class="col-lg-7" style="margin: 0px; padding:0;">
                        <div class="table-responsive-lg " style="margin: 0px; padding:0;">
                            <nav aria-label="breadcrumb" style=" margin: 0px; padding:0;" class="bg-gradient-warning">
                                <ol class="breadcrumb bg-gradient-faded-success" style="margin-bottom: 0; border-radius:0px; ">
                                    <H3 class="text-white"><strong>Menu</strong></H3>
                                </ol>
                            </nav>
                        </div>
                        <div class="table-responsive" 
                            style="display:block; float:left; margin: 0px; margin-top:2px; padding:0; height:700px;">
                            <section style="">
                                <main class=" main-content">
                                    <div class="tab-content"  style="margin: 0px; padding:0; ">
                                        <div class="row row-cols-xs-1 row-cols-sm-2 row-cols-lg-3 row-cols-xl-4" style="margin: 0px; padding:0;">
                                            @foreach($products as $pro)
                                                <div class="" style="padding: 0px; margin:0px;">
                                                    <form action="{{route('cart.create')}}" method="post">
                                                        @csrf
                                                        <input type="hidden" value="{{ $pro->id }}" id="id" name="id">
                                                        <input type="hidden" value="{{ $pro->nombre }}" id="name" name="name">
                                                        <input type="hidden" value="{{ $pro->precio }}" id="price" name="price">
                                                        <input type="hidden" value="1" id="quantity" name="quantity">
                                                        
                                                        <div class="col d-flex justify-content-center mb-1">
                                                            <button class="card btn btnCard" id="btn" type="submit" 
                                                                data-id="{{$pro->id}}" style="padding: 0px; width:215px; height:200px; margin:0px; border-radius:0%;
                                                                background: url('/{{ $pro->imagen}}') top center/cover no-repeat;">
                                                                <div class="text-center" 
                                                                    style="text-align:center;  width: 11rem;">
                                                                    <!-- Nombre --> 
                                                                    <p class="nombre card-title pt-2 text-center text-dark" id="nombre"> 
                                                                        <strong style="font-size: 20px; width:215px;
                                                                        background-color:rgba(255, 255, 255, 0.677);
                                                                        position: absolute; bottom: 12.3%; left:0;">{{$pro->nombre}}</strong>
                                                                    </p>                        
                                                                    <!-- Precio -->
                                                                    <p id="precio" class="text-dark text-decoration-line">
                                                                        <strong class="precio" style="font-size: 15px; width:215px;
                                                                        background-color:rgba(255, 255, 255, 0.677);
                                                                        position: absolute; bottom: 0; left:0;">L {{number_format($pro->precio, 2, ".", ",")}}</strong>
                                                                    </p>                        
                                                                </div>
                                                            </button>
                                                        </div>
                                                    </form>
                                                </div> 
                                            @endforeach
                                        </div>
                                        
                                    </div>
                                </main>
                            </section>
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
                                <Label class="h6 col-form-label font-robo" style="margin: 5px 5% 0 3px;" for="mesa">Pedido de la Mesa:</Label>
                                <select name="mesa" style="height:42px; border-radius:0; margin: 5px 0px 5px 23px;" id="mesa"
                                    class="form-control input--style-2 border-0 ps-2 font-robo">
                                    <option value="">Seleccione una mesa</option> 
                                </select>
                                @error('mesa')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror     
                            </div>
                            <div class="input-group" style="margin: 0; border: 0; width: 99%">
                                <label class="h6 font-robo col-form-label" for="nombre" style="margin: 0 5% 0 3px;">Nombre del cliente:</label>
                                <input name="nombre" type="text" class="ps-2 input--style-2 form-control border-0 border-radius-sm" id="nombre" maxlength="50" minlength="3"
                                    placeholder="Ingrese el nombre" value="{{ old('nombre') }}" style="margin: 0px 0px 5px 20px; height:42px;">
                                <div class="invalid-feedback">  
                                </div>
                                @error('nombre')
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
                        
                        <div style="margin: 0; padding:0; margin-top:12px" class="col-12">
                            <div class="row" style="margin: 0; padding:0;">
                                <div class="col-6 d-flex justify-content-end" style="margin: 0; padding:0; padding-right:5px">
                                <form method="POST" action="{{route('cart.store')}}">
                                    @csrf
                                <button href="#" type="submit" role="button" id="guardar"
                                class="btn btn-success border-0 border-radius-sm" style="margin:0; ;">Guardar</button>
                                </form>
                                </div>    
                                <div class="col-6" style="margin: 0; padding:0; padding-left:5px;">
                                    <form action="{{ route('cart.clear') }}" method="POST">
                                        @csrf
                                        <button id="cancelar" type="submit"class="btn btn-danger border-0 border-radius-sm"
                                            style="margin:0;">Cancelar
                                        </button> 
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
</body>
</html>