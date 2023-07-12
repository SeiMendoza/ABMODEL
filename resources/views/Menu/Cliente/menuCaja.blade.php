<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Document</title>
</head>
<body>
    @if(session()->has('success_msg'))
    <div class="alert alert-success alert-dismissible fade show" role="alert">
        {{ session()->get('success_msg') }}
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    @endif

    <div>
        <form method="POST" action="{{route('cart.store')}}">
            @csrf
            <div class="form-group">
                <label for="id">ID</label>
                <input type="text" name="id" class="form-control" id="id">
            </div>
            <div class="form-group">
                <label for="name">NOMBRE</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>
            <div class="form-group">
                <label for="price">PRECIO</label>
                <input type="text" name="price" class="form-control" id="price">
            </div>
            <div class="form-group">
                <label for="quantity">CANTIDAD</label>
                <input type="text" name="quantity" class="form-control" id="quantity">
            </div>
            <div class="form-group">
                <label for="color">COLOR</label>
                <select class="form-control" name="color" id="color">
                    <option value="blanco">blanco</option>
                    <option value="azul"> azul</option>
                </select>
                <small class="form-text text-muted">Atributo</small>
            </div>
    
            <div class="form-group">
                <label for="tamano">TAMAÑO</label>
                <select name="tamano" class="form-control" id="tamano">
                    <option value="chico">Chico</option>
                    <option value="grande">Grande</option>
                </select>
                <small class="form-text text-muted">Atributo</small>
            </div>
            <button type="submit" class="btn btn-primary">Agregar al carrito</button>
        </form>
    
        <br>
        @if (!Cart::isEmpty())
            <table style="border: 2px solid black">
                <thead>
                    <tr>
                        <th scope="col" colspan="2">Acciones</th>
                        <th scope="col">#ID</th>
                        <th scope="col">Nombre</th>
                        <th scope="col">Precio</th>
                        <th scope="col">Cantidad</th>
                        <th scope="col">Atributos</th>
                        <th>
                            @if(count(Cart::getContent())>0)
                            <form action="{{ route('cart.clear') }}" method="POST">
                                @method('DELETE')
                                @csrf
                                <button class="btn btn-secondary btn-md">Borrar Carrito</button> 
                            </form>
                            @endif
                        </th>
                    </tr>
                </thead>
                <tbody>
                    @foreach (Cart::getContent() as $item)
                    <tr>
                        <th scope="row">
                            <form method="POST" action="{{route('cart.destroy',$item->id)}}">
                                @method('DELETE')
                                @csrf
                                <button type="submit">Eliminar</button>
                            </form>
                        </th>
                        <th scope="row">
                            <form action="{{ route('cart.update',$item->id) }}" method="POST">
                                @method('put')
                                @csrf
                                <div class="form-group row">
                                    <input type="hidden" value="{{ $item->id}}" id="id" name="id">
                                    <button class="btn btn-secondary btn-sm" style="margin-right: 25px;">+</button>
                                </div>
                            </form>
                        </th>
                        <th scope="row">{{$item->id}}</th>
                        <td>{{$item->name}}</td>
                        <td>{{$item->price}}</td>
                        <td>{{$item->quantity}}</td>
                        <td>
                            @foreach ($item->attributes as $key => $attribute)
                            {{$key}}: {{$attribute}}.
                            @endforeach
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        @endif

        <br>
        <div>
            <table class="table">
                <thead>
                    <tr>
                        <th sc ope="col">Items</th>
                        <th sc ope="col">Sub total</th>
                        <th scope="col">Total</th>
                    </tr>
                </thead>
                <tbody>
                    <tr>
                        <th scope="row">{{Cart::getTotalQuantity()}}</th>
                        <th scope="row">{{Cart::getSubTotal()}}</th>
                        <th scope="row">{{Cart::getTotal()}}</th>
                        </tr>
                </tbody>
          </table>

          <br>
          
            
           
        </div>
    </div>
</body>
</html>