<div class="row" style="margin: 0px; padding:0;">
    @foreach($products as $pro)
        @php
        $c = 0;
        @endphp
        @foreach ($items as $item)
            @if ($pro->id == $item->id)
                @php $c = $item->quantity @endphp
            @endif
        @endforeach
        <div class="col col-auto col-xs-6 col-sm-4 col-md-6 col-lg-4 col-xl-3" style=" margin:0px; padding:0;" style="">
            <input type="hidden" value="{{$pro->disponible - $c}}" id={{"dis-$pro->id"}} name="dis">
            <button class="card btnCard btn d col" role="button" 
                data-id="{{$pro->id}}" wire:click="addTodo({{$pro->id}})" onclick="proenviar({{$pro->id}})"
                style="background: url('/{{ $pro->imagen}}') top center/cover no-repeat; display:block; column-span:all;" >
                <div class="" id={{"p-$pro->id"}} 
                    style="text-align: center" >
                    <!-- Nombre --> 
                    <p class="nombre card-title pt-2 text-center text-dark" id="nombre"> 
                        <strong style="font-size: 21px; width:100%;
                        background-color:rgba(255, 255, 255, 0.677);
                        position: absolute; bottom:25px; left:0;">{{$pro->nombre}}</strong>
                    </p>                        
                    <!-- Precio -->
                    <p id="precio" class="text-dark text-decoration-line">
                        <strong class="precio" style="font-size: 15.3px; width:35%;
                            background-color:rgba(255, 255, 255, 0.677);
                            position: absolute; bottom: 0; right:0%">L {{number_format($pro->precio, 2, ".", ",")}}</strong>
                            <strong class="precio" style="font-size: 15.3px; width:65%; 
                            background-color:rgba(255, 255, 255, 0.677); 
                            position: absolute; bottom: 0; left:0;" id="disponible">Disponible: 
                            @if ($pro->disponible >= 1)
                                {{$pro->disponible - $c}}
                            @else
                                0
                            @endif     
                        </strong>
                    </p>                        
                </div>
            </button>
        </div>  
    @endforeach 
</div>

