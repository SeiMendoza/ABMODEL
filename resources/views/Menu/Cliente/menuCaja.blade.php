<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ $title ?? 'E-COMMERCE TIENDA' }}</title>
    <link rel="stylesheet" href={{ url('css/app.css') }}>
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">
</head>
<body>
    <nav class="navbar navbar-expand-md navbar-dark fixed-top bg-dark shadow-sm">
        <div class="container">
            <a class="navbar-brand" href="{{ url('/') }}">
                E-COMMERCE TIENDA
            </a>
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav ml-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart.index') }}">TIENDA</a>
                    </li>
                    <li class="nav-item dropdown">
                        <a id="navbarDropdown" class="nav-link dropdown-toggle"
                           href="#" role="button" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false"
                        >
                            <span class="badge badge-pill badge-dark">
                                <i class="fa fa-shopping-cart"></i> {{ \Cart::getTotalQuantity()}}
                            </span>
                        </a>
    
                        <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown" style="width: 450px; padding: 0px; border-color: #9DA0A2">
                            <ul class="list-group" style="margin: 20px;">
                                @if(count(\Cart::getContent()) > 0)
                                    @foreach(\Cart::getContent() as $item)
                                        <li class="list-group-item">
                                            <div class="row">
                                                <div class="col-lg-3">
                                                    <img src="/images/{{ $item->attributes->image }}"
                                                        style="width: 50px; height: 50px;"
                                                    >
                                                </div>
                                                <div class="col-lg-6">
                                                    <b>{{$item->name}}</b>
                                                    <br><small>Qty: {{$item->quantity}}</small>
                                                </div>
                                                <div class="col-lg-3">
                                                    <p>${{ \Cart::get($item->id)->getPriceSum() }}</p>
                                                </div>
                                                <hr>
                                            </div>
                                        </li>
                                    @endforeach
                                    <br>
                                    <li class="list-group-item">
                                        <div class="row">
                                            <div class="col-lg-10">
                                                <b>Total: </b>${{ \Cart::getTotal() }}
                                            </div>
                                            <div class="col-lg-2">
                                                <form action="{{ route('cart.clear') }}" method="POST">
                                                    @csrf
                                                    <button class="btn btn-secondary btn-sm"><i class="fa fa-trash"></i></button>
                                                </form>
                                            </div>
                                        </div>
                                    </li>
                                    <br>
                                    <div class="row" style="margin: 0px;">
                                        <a class="btn btn-dark btn-sm btn-block" href="{{ route('cart.index') }}">
                                            CARRITO <i class="fa fa-arrow-right"></i>
                                        </a>
                                        <a class="btn btn-dark btn-sm btn-block" href="">
                                            CHECKOUT <i class="fa fa-arrow-right"></i>
                                        </a>
                                    </div>
                                @else
                                    <li class="list-group-item">Tu carrito esta vacío</li>
                                @endif

                            </ul>
    
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </nav>    
    @if(session()->has('success_msg'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('success_msg') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif

    <div>
        <div class="container" style="margin-top: 80px">
            <nav aria-label="breadcrumb">
                <ol class="breadcrumb">
                    <li class="breadcrumb-item"><a href="/">Inicio</a></li>
                    <li class="breadcrumb-item active" aria-current="page"><form method="POST" action="{{route('cart.store')}}">
                        @csrf
                        <button type="submit">Guardar</button>
                    </form></li>
                </ol>
            </nav>
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="row">
                        <div class="col-lg-7">
                            <h4>Productos</h4>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        @foreach($productos as $pro)
                            <div class="col-lg-3">
                                <div class="card" style="margin-bottom: 20px; height: auto;">
                                    <img src="/images/{{ $pro->imagen }}"
                                         class="card-img-top mx-auto"
                                         style="height: 150px; width: 150px;display: block;"
                                         alt="imagen"
                                    >
                                    <div class="card-body">
                                        <a href=""><h6 class="card-title">{{ $pro->nombre }}</h6></a>
                                        <p>${{ $pro->precio }}</p>
                                        <form action="{{ route('cart.create') }}" method="POST">
                                            @csrf
                                            <input type="hidden" value="{{ $pro->id }}" id="id" name="id">
                                            <input type="hidden" value="{{ $pro->nombre }}" id="name" name="name">
                                            <input type="hidden" value="{{ $pro->precio }}" id="price" name="price">
                                            <input type="hidden" value="1" id="quantity" name="quantity">
                                            <div class="card-footer" style="background-color: white;">
                                                  <div class="row">
                                                    <button class="btn btn-secondary btn-sm" class="tooltip-test" title="add to cart">
                                                        <i class="fa fa-shopping-cart"></i> agregar al carrito
                                                    </button>
                                                </div>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>

        <br>
        @if (!Cart::isEmpty())
            <div class="row justify-content-center">
                <div class="col-lg-7">
                    <br>
                    @if(\Cart::getTotalQuantity()>0)
                        <h4>{{ \Cart::getTotalQuantity()}} Producto(s) en el carrito</h4><br>
                    @else
                        <h4>No Product(s) In Your Cart</h4><br>
                        <a href="/" class="btn btn-dark">Continue en la tienda</a>
                    @endif

                    @foreach(\Cart::getContent() as $item)
                        <div class="row">
                            <div class="col-lg-3">
                                <img src="/images/{{ $item->attributes->image }}" class="img-thumbnail" width="200" height="200">
                            </div>
                            <div class="col-lg-3">
                                <p>
                                    <b><a href="/shop/{{ $item->attributes->slug }}">{{ $item->name }}</a></b><br>
                                    <b>Price: </b>${{ $item->price }}<br>
                                    <b>Quantity: </b>{{ $item->quantity }}<br>
                                    <b>Sub Total: </b>${{ \Cart::get($item->id)->getPriceSum() }}<br>
                                    {{--                                <b>With Discount: </b>${{ \Cart::get($item->id)->getPriceSumWithConditions() }}--}}
                                </p>
                            </div>
                            <div class="col-lg-4">
                                <div class="row">
                                    <form action="{{route('cart.update',$item->id)}}" method="POST">
                                        @method('put')
                                        @csrf
                                        <div class="form-group row">
                                            <input type="hidden" value="{{ $item->id}}" id="id" name="id">
                                            <button class="btn btn-secondary btn-sm" style="margin-right: 25px;"><i class="fa fa-edit"></i></button>
                                        </div>
                                    </form>
                                    <form method="POST" action="{{route('cart.destroy',$item->id)}}">
                                        @method('DELETE')
                                        @csrf
                                        <button type="submit">Eliminar</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        <hr>
                    @endforeach
                    
                    @if(count(Cart::getContent())>0)
                        <div class="col-lg-5">
                            <div class="card">
                                <ul class="list-group list-group-flush">
                                    <li class="list-group-item"><b>Total: </b>${{ \Cart::getTotal() }}</li>
                                </ul>
                            </div>
                            <div>
                                <br><a href="/cart" class="btn btn-dark">Continue en la tienda</a>
                                <form method="POST" action="{{route('cart.store')}}">
                                    @csrf
                                    <button type="submit">Guardar</button>
                                </form>
                                @if(count(\Cart::getContent())>0)
                                    <form action="{{ route('cart.clear') }}" method="POST">
                                        @csrf
                                        <button class="btn btn-secondary btn-md">Borrar Carrito</button> 
                                    </form>
                                @endif
                            </div>
                        </div>
                    @endif
                    
                </div>
            </div>
        @endif
    </div>
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js" integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js" integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</body>
</html>
