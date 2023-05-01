@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalles-pedido')
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<style>
    .cont {
        overflow-x: hidden;
    }
</style>
@section('miga')
<li class="breadcrumb-item text-sm active m-0 text-white opacity-6">
    <a class="text-white" href="">Detalles</a>
</li>
<li class="breadcrumb-item text-sm active m-0 text-white">
    <a class="text-white">Editar detalles</a>
</li>
@endsection

@section('content')
<div class="wrapper wrapper--w960 font-robo">
    <div class="card border-radius-sm border-0">
        <div class="card-body border-radius-sm border-0">
            <h2 class="title" style="margin-bottom:0">Información de: {{$pedido->nombreCliente}}</h2>
            <h4 class="font-robo t" style="margin: 0; padding:0">Datos del producto: </h4>
            <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
            @if($pedido)
            <form method="post" action="{{ route('detallep.update',['pedido_id' => $pedido->id, 'detalle_id' => $edit->id]) }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row row-space">
                    <div class="col-6">
                        <div class="font-robo form-group">
                            <label for="">Nombre del producto:</label>
                            <select class="form-control border-radius-sm producto" name="nombre" id="nombre">
                                @foreach ($productos as $producto)
                                <option value="{{ $producto }}" {{ old('nombre', $edit->nombre) == $producto ? 'selected' : '' }}>{{ $producto }}</option>
                                @endforeach
                            </select>
                            @error('nombre')
                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="font-robo form-group">
                            <label for="">Cantidad de producto:</label>
                            <input style="padding-left: 8px;" class="form-control border-radius-sm" type="number" name="cantidad" id="cantidad" step="1" placeholder="Ingrese de producto" 
                            value="@if(Session::has('cantidad')){{Session::get('cantidad')}}
                            @else{{old('cantidad',$edit->cantidad)}}@endif" onkeypress="quitarerror()">
                            @error('cantidad')
                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <div class="row row-space">
                    <div class="col-6">
                        <div class="font-robo form-group">
                            <label for="">Precio del producto:</label>
                            <input style="padding-left: 8px;" class="form-control border-radius-sm precio" 
                            placeholder="Precio del producto" name="precio" id="precio" readonly 
                            value="@if(Session::has('producto_precio')){{Session::get('producto_precio')}}
                            @else{{old('precio',$edit->precio)}}@endif">
                            @error('precio')
                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="font-robo form-group">
                            <label for="">Impuesto:</label>
                            <input style="padding-left: 8px;" class="form-control border-radius-sm" type="number" name="impuesto" id="impuesto" step="0.01" placeholder="" value="@if(Session::has('impuesto')){{Session::get('impuesto')}}@else{{old('',$edit->precio*$edit->cantidad * 0.15)}}@endif" readonly onkeypress="quitarerror()">
                            @error('impuesto')
                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                @php
                $imp=$edit->precio * $edit->cantidad * 0.15;
                $sub=$edit->precio * $edit->cantidad -$imp;
                @endphp
            
                <div class="row row-space">
                    <div class="col-6">
                        <div class="font-robo form-group">
                            <label for="">Sub_total:</label>
                            <input class="form-control border-radius-sm" type="number" name="sub_total" id="sub_total" step="" placeholder="" value="@if(Session::has('sub_total'))
                            {{Session::get('sub_total')}}@else{{old('',$sub )}}@endif" readonly onkeypress="quitarerror()">
                            @error('sub_total')
                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="font-robo form-group">
                            <label for="">Total Compra:</label>
                            <input style="padding-left: 8px;" class="form-control border-radius-sm" type="number" name="total" id="total" step="" placeholder="" value="@if(Session::has('total')){{Session::get('total')}}@else{{old('',$edit->precio*$edit->cantidad)}}@endif" readonly onkeypress="quitarerror()">
                            @error('total')
                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
 
                <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
                <div style="float: right;margin-top: 5px">
                    <button type="button" onclick="cancelarp('pedidos/caja/detalle/{{$pedido->id}}')" class="btn btn-danger">Cancelar</button>
                    <button onclick="" type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
            @endif
        </div>
    </div>
</div>
<script>
    function cancelarp(ruta) {

        Swal
            .fire({
                title: "¿Cancelar actualización?",
                text: "¿Desea cancelar los cambios?",
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

    }

    $(document).ready(function() {
        $('.producto, #cantidad').change(function() {
            var producto = $('.producto').val();
            var cantidad = parseFloat($('#cantidad').val());
            $.ajax({
                url: '/obtener-precio',
                type: 'POST',
                data: {
                    producto: producto,
                    _token: '{{ csrf_token() }}'
                },
                success: function(response) {
                    var precio = parseFloat(response);
                    if (!isNaN(precio)) { // Verifica si el valor de precio es válido
                        var impuesto = cantidad * precio * 0.15; // Calcula el impuesto como el 15% del precio total
                        var sub_total = precio * cantidad - impuesto;
                        var total = precio * cantidad;
                        $('#precio').val(response);
                        $('#impuesto').val(impuesto.toFixed(2)); // Muestra el impuesto con 2 decimales
                        $('#sub_total').val(sub_total.toFixed(2)); // Muestra el sub_total con 2 decimales
                        $('#total').val(total.toFixed(2)); // Muestra el total con 2 decimales
                    }
                },
                error: function(xhr) {
                    console.log(xhr.responseText);
                }
            });
        });
    });
</script>

@endsection