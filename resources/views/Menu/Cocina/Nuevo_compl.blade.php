@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Agregar complemento')
@section('miga')
<li class="breadcrumb-item text-sm text-white opacity-6">
    <a class="text-white" href="{{route('pedidost.detalle',['id'=>$pedido->id])}}">detalles de caja</a>
</li>
<li class="breadcrumb-item text-sm active text-white active">Complementos</li>
@endsection
@section('tit','Registro de complementos')
@section('content')
<div class="wrapper wrapper--w960 font-robo">
    <div class="card border-radius-sm border-0">
        <div class="card-body border-radius-sm border-0">
            <h4 class="font-robo t" style="margin: 0; padding:0">Datos del complemento: </h4>
            <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
            <form action="{{ route('Acomple', $pedido->id) }}" method="POST">
                @csrf
                <div class="row row-space">
                    <div class="col-6">
                        <div class="font-robo form-group">
                            <label for="">Producto: </label>
                            <div>
                                <select name="producto_id" id="producto_id" class="form-control">
                                    <option value="">Seleccione un producto</option>
                                    @foreach($productos as $producto)
                                    <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                                    @endforeach
                                </select>
                                @error('producto_id')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                                <div class="select-dropdown"></div>
                            </div>
                            <!-- Agrega un campo oculto para enviar el nombre del producto -->
                            <input type="hidden" name="producto" value="{{ $producto->nombre }}">
                        </div>
                    </div>
                    <div class="col">
                        <div class="font-robo form-group">
                            <label for="">Ingrese la cantidad:</label>
                            <input style="padding-left: 8px;" class="form-control border-radius-sm" type="number" name="cantidad" id="cantidad" step="0.01" placeholder="Ingresa la cantidad" value="@if(Session::has('cantidad')){{Session::get('cantidad')}}@else{{old('cantidad')}}@endif" onkeypress="quitarerror()">
                            @error('cantidad')
                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
                <div style="float: right;margin-top: 5px">
                    <button type="button" onclick="cancelar('pedidos/caja/detalle/{{$pedido->id}}')" class="btn btn-danger">Cancelar</button>
                    <button onclick="" type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>

@endsection