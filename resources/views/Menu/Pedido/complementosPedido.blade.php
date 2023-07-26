@extends('Menu.Pedido.Pedido')
@section('productos')
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
                        data-id="{{$pro->id}}" style="padding: 0px; width:215px; height:200px; margin:0px 5px 1px 5px; border-radius:0%;
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
@endsection