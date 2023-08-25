<div  class="d-none d-sm-none d-md-table bg-white ;
    col-md-6 d-lg-table col-lg-5 d-xl-table col-xl-5 d-table-cell ocultar" 
    style="display:block; margin: 0px; height:100%; 
    padding:0%; position:fixed; right:0%; top:0%"
    id="pedido" name="pedido">
    <div class="row" style="margin: 0px; padding:0; position:absolute; width:100%; top:0%; right:0%">
        <nav aria-label="breadcrumb" style=" margin: 0px; padding:0;">
            <ol class="breadcrumb d-flex justify-content-center bg-gradient-faded-success" 
                style="margin-bottom: 0; border-radius:0px; margin:0;">
                <H3 class="text-white"><strong>Detalles del Pedido</strong></H3>
                <li class=" d-md-none d-lg-none d-xl-none d-xs d-sm-table d-sm-table-cell d-flex align-items-center" 
                    style="margin: 0px;">
                    <div id="" style="padding-left: 15px;">
                        <button style="margin:0px; padding:4px; font-size:15px; position:absolute; right:1%; top:15%;" type="button" 
                        class="bg-light border-radius-sm text-center subMenu" id="cerrar" name="cerrar">
                        <i class="fa-solid fa-square-xmark text-danger"></i></button>
                    </div>
                </li>
            </ol>
        </nav>
    </div>                   
    <div id="pedidoT" style="margin:50px 0 0 0; padding:0;
            width:100%; position:absolute; top:0; bottom:171px; overflow-y:auto;" class="bg-white">
        <div class="row" id="carrito" style="margin: 0; padding:0;">
            <table class="table table-borderless" id="lista" style="margin: 0; 
                margin-bottom:0px; padding:0;">
            <thead style="padding-top: 2px;">
                <tr class="text-dark">
                    <th scope="col" style="padding:3px; text-align:;">Nombre</th>
                    <th scope="col" colspan="3" style="padding:3px; text-align:center;">Cantidad</th>
                    <th scope="col" style="padding:3px; text-align:right;">Precio</th>
                    <th scope="col" style="padding:3px; text-align:right;">Sub-total</th>
                    <th scope="col" style="padding:3px; text-align:center;">Eliminar</th>
                </tr>
            </thead>
            <tbody class="col"  id=""  style="">
                @foreach($productos->sortByDesc('attributes') as $i => $item)
                <tr>
                    <td style="text-align: left; padding-left:3px;">{{ $item->name }}</td>
                    <td style="text-align: right">
                        <button type="button" wire:click="cambiar_Cant({{$item->id}}, {{$item->quantity}})">
                            <i class="fa-solid fa-circle-minus text-danger"></i>
                        </button>
                    </td>
                    <td style="text-align: center; width:20%;" >
                        <input type="number" id="cant-{{$item->id}}" style="height:20px; text-align: right;"
                        wire:change="editar({{$item->id}}, $('#cant-'+{{$item->id}}).val())"
                         class="form-control" value="{{$item->quantity}}"  
                        >
                    </td>
                    <td style="text-align: center">
                        <button type="button" wire:click="cambiar_Cant2({{$item->id}}, {{$item->quantity}})" onclick="proenviar({{$item->id}})">
                            <i class="fa-solid fa-circle-plus text-success"></i>
                        </button>
                    </td>
                    <td style="text-align: right">L {{ $item->price }}</td>
                    <td style="text-align: right">L {{ \Cart::get($item->id)->getPriceSum() }}</td>
                     
                    <td style="text-align: center">
                        <button type="button" wire:click="eliminar_item({{$item->id}}, {{$item->quantity}})"><i class="fa-solid fa-trash text-danger"></i></button>
                    </td>  
                    
                </tr>
                <hr>
            @endforeach
            </tbody>
            </table>
        </div>
    </div>
    <div class="bg-white col-12" style="margin:0; padding:0;">
        <div class="col col-8 d-flex justify-content-start bg-gray-100" 
                style="display:block; float:left; margin:0; padding:0; position:absolute; 
                bottom:50px; width:100%; left:3px;">
            <form method="POST" action="{{route('menu.store')}}" id="formul" name="formul" enctype="multipart/form-data">
                    @csrf
                <div class="row form-group" style="margin: 0; border: 0; width:100%">
                    <Label class="font-robo" style="margin:0%; padding:3px 0 0 3px;
                        color:rgb(88, 104, 128); font-size: 14px;" 
                        for="mesaP">Pedido de la Mesa:
                    </Label>
                    <select name="mesa" required onchange="quitarerror()"
                        style="border-radius: 0px; 
                        border:0px; height:35px; margin:0%; padding:0 3px 0 3px;
                        border-bottom: 1px solid black;"
                        class="form-control border-radius-sm bg-gray-100">
                        @if (old('mesa'))
                        <option disabled="disabled" value="">Seleccione una mesa</option>
                            @foreach ($mesas as $c)
                                @if (old('mesa') == $c->id)
                                    <option selected="selected" value="{{$c->id}}">Mesa-{{$c->nombre}} - Kiosko:
                                        {{$c->kiosko->codigo}}
                                    </option>
                                
                                @else
                                    <option value="{{$c->id}}">Mesa-{{$c->nombre}} - Kiosko: {{$c->kiosko->codigo}}
                                    </option>
                                    
                                @endif
                            @endforeach
                        @else
                            <option disabled="disabled" selected="selected" value="">Seleccione una mesa
                            </option>
                            @foreach ($mesas as $c)
                                <option value="{{$c->id}}">Mesa-{{$c->nombre}} - Kiosko: {{$c->kiosko->codigo}}
                                </option>
                                
                            @endforeach
                        @endif
                    </select>
                    @error('mesa')
                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                    @enderror     
                </div>
                <div class="row font-robo form-group" style="margin-left:0; width:100%;">
                    <label for="name" class="" style="font-size: 14px; color:rgb(88, 104, 128);
                        margin:0%; padding:0; padding-left:3px;">Nombre del cliente:
                    </label>
                    <input class="form-control bg-gray-100" type="text" 
                    placeholder="Ingrese el nombre del cliente" style=" border:0px; padding:0 3px 0 3px;
                        border-bottom: 1px solid black; border-radius: 0px; margin:0%;"
                        name="name" id="name" minlength="3" maxlength="50"
                        value="{{ old('name')}}" required>
                    @error('name')
                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                    @enderror
                </div>
                @if (count(\Cart::getContent()) == 0)
                    <input type="number" name="t" id="t" value="" hidden>
                @endif
            </form>
        </div>
        <div class="col col-5 d-flex justify-content-start bg-gray-100" style="display:block; bottom:52px;
                position:absolute; right:0%; float:right; margin:0; padding:0;">
            <ul class="list-group list-group-flush " style="margin:0; padding:0; width:100%">
                <li class="list-group-item bg-gray-100" style="padding-top:0%;"><b style="display: block; float:left;">Sub-Total: &nbsp;&nbsp; </b>
                    <p style="display: block; float:right; text-align: right;">L {{ \Cart::getTotal() - \Cart::getTotal() * 0.15}}</p>
                </li>
                <li class="list-group-item bg-gray-100"><b style="display: block; float:left;">ISV: </b>
                    <p style="display: block; float:right; text-align: right;">L {{ \Cart::getTotal() * 0.15}}</p>
                </li>
                <li class="list-group-item bg-gray-100"><b style="display: block; float:left;">Total: </b> 
                    <p style="display: block; float:right; text-align: right;">L {{ \Cart::getTotal()}}</p>
                </li>
            </ul>
        </div>
    </div>   
    <div  class="d-flex justify-content-center bg-white bg-gradient-faded-success" style="margin:0; 
        padding: 9px 3px 9px 3px; position:absolute; bottom:0%; right:0%; width:100%">
        <div class="d-flex justify-content-center" style="margin: 0; display:block; float:left;
            padding:0; padding-right:5px;">
                <form action="{{ route('menu.clear') }}" method="POST" id="Fcancelar" name="Fcancelar" enctype="multipart/form-data">
                    @csrf
                </form>
                    <button id="eliminar" role="button" class="btn btn-danger border-0 border-radius-sm"
                        style="margin:0;" onclick="eliminar()" >Cancelar
                    </button> 
                
        </div>    
        <div class="" style="margin: 0; padding:0; padding-left:5px; display:block; float:left">
            <button  role="button" id="guardar" onclick="enviar()"
            class="btn btn-success border-0 border-radius-sm" style="margin:0; ">Guardar</button>  
        </div>
        
    </div> 
</div>
