@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Agregar-complemento')
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
    <a class="text-white">Complemento</a>
</li>
@endsection
@section('tit','Complemento')

@section('content')
<div class="wrapper wrapper--w960 font-robo">
    <div class="card border-radius-sm border-0">
        <div class="card-body border-radius-sm border-0">
            <h2 class="title" style="margin-bottom:0">Agregar complemento</h2>
            <h4 class="font-robo t" style="margin: 0; padding:0">Datos del producto: </h4>
            <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
            @if($pedido)
            <form action="{{ route('Acomple', $pedido->id) }}" method="POST">
                @csrf
                <div class="row row-space">
                    <div class="col-6">
                        <div class="font-robo form-group">
                            <label for="">Nombre del producto:</label>
                            <select name="producto_id" id="producto_id" class="form-control">
                                <option value="">Seleccione un producto</option>
                                @foreach($productos as $producto)
                                <option value="{{ $producto->id }}" {{ old('producto_id') == $producto->id ? 'selected' : '' }}>{{ $producto->nombre }}</option>
                                @endforeach
                            </select>
                            @error('producto_id')
                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="font-robo form-group">
                            <label for="">Cantidad de producto:</label>
                            <input style="padding-left: 8px;" class="form-control border-radius-sm" type="number" name="cantidad" id="cantidad" maxlength="3" step="1" placeholder="Ingrese la cantidad" value="{{old('cantidad')}}" onkeypress="quitarerror()">
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
                            <input style="padding-left: 8px;" class="form-control border-radius-sm precio" placeholder="0.00" name="precio" id="precio" readonly value="{{old('precio')}}">
                            @error('precio')
                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="font-robo form-group">
                            <label for="">Impuesto:</label>
                            <input style="padding-left: 8px;" class="form-control border-radius-sm" type="number" name="impuesto" id="impuesto" step="0.01" placeholder="0.00" value="{{old('impuesto')}}" readonly onkeypress="quitarerror()">
                            @error('impuesto')
                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                </div>
                @php
                $imp=$producto->precio * $producto->cantidad * 0.15;
                $sub=$producto->precio * $producto->cantidad -$imp;
                @endphp

                <div class="row row-space">
                    <div class="col-6">
                        <div class="font-robo form-group">
                            <label for="">Sub total:</label>
                            <input class="form-control border-radius-sm" type="number" name="sub_total" id="sub_total" step="" placeholder="0.00" value="{{old('sub_total')}}" readonly onkeypress="quitarerror()">
                            @error('sub_total')
                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col">
                        <div class="font-robo form-group">
                            <label for="">Total Compra:</label>
                            <input style="padding-left: 8px;" class="form-control border-radius-sm" type="number" name="total" id="total" step="" placeholder="0.00" value="{{old('total')}}" readonly onkeypress="quitarerror()">
                            @error('total')
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
            @endif
        </div>
    </div>
</div>
@endsection