@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Piscina-productos')
<style>
    .cont {
        overflow-x: hidden;
    }
</style>
@section('miga')
<li class="breadcrumb-item text-sm active m-0 text-white opacity-6">
    <a class="text-white" href="{{route('prodpiscina.index')}}">Productos Piscina</a>
</li>
<li class="breadcrumb-item text-sm active m-0 text-white">
    <a class="text-white">Editar producto</a>
</li>
@endsection

@section('tit','Edición de producto de piscina')
@section('b')
    <div class="" style="">    
        <a href="{{route('prodpiscina.index')}}" style="margin:0; padding:5px; width:150px; font-size:15px" type="button" 
        class="bg-light border-radius-sm text-center">
        <i class="fa fa-arrow-left"></i> Regresar
       </a> 
    </div>
@endsection

@section('content')
<div class="wrapper wrapper--w960 font-robo">
    <div class="card border-radius-sm border-0">
        <div class="card-body border-radius-sm border-0">
            <h4 class="font-robo t" style="margin: 0; padding:0">Datos del producto: </h4>
            <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
            <form method="post" action="{{ route('producto.update',['id' => $piscina -> id]) }}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <div class="row row-space">
                    <div class="col-6">
                        <div class="font-robo form-group">
                            <label for="">Nombre del producto:</label>
                            <input style="padding-left: 8px;" class="form-control border-radius-sm" placeholder="Nombre del producto" name="nombre" id="nombre" value="@if(Session::has('nombre')){{Session::get('nombre')}}@else{{old('nombre',$piscina->nombre)}}@endif" maxlength="25" onkeypress="quitarerror()">
                            @error('nombre')
                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="font-robo form-group">
                            <label for="">Tipo de producto: </label>
                            <div style="">
                                <select onchange="cambioPeso()" class="form-control border-radius-sm" style="text-indent: 8px !important;" name="tipo" id="tipo">
                                <option value="1" {{ old('tipo', $piscina->tipo) == "1" ? 'selected' : '' }}>Polvo</option>
                                <option value="2" {{ old('tipo', $piscina->tipo) == "2" ? 'selected' : '' }}>Liquido</option>   
                                </select> 
                                @error('tipo')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row row-space">
                    <div class="col-6">
                        <div class="font-robo form-group">
                            <label for="">Tipo de uso: </label>
                            <div style="">
                                <select  class="form-control border-radius-sm" name="uso" id="uso">
                                    <option value="1" {{ old('uso', $piscina->uso) =="1" ? 'selected' :''}}>Diario</option>
                                    <option value="2" {{ old('uso', $piscina->uso) =="2" ? 'selected' :''}}>Semanal</option>
                                    <option value="3" {{ old('uso', $piscina->uso) =="3" ? 'selected' :''}}>Mensual</option>
                                </select>
                                @error('uso')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                                <div class="select-dropdown"></div>
                            </div>
                        </div>
                    </div>
                    <div class="col">
                        <div class="font-robo form-group">
                            <label for="">Ingrese el peso:</label>
                            <input style="padding-left: 8px;width:340px;" class="form-control border-radius-sm" type="number" name="kilos" id="kilos" step="0.01" placeholder="Ingresa la cantidad" value="@if(Session::has('kilos')){{Session::get('kilos')}}@else{{old('kilos',$piscina->peso)}}@endif" onkeypress="quitarerror()">
                            @error('kilos')
                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4" id="contenedor">
                        <div class="font-robo form-group">
                            <span style="width:90px;position:absolute;top:52%;right:25px;text-align:center;" class="form-control border-radius-sm" id="identificador"></span>
                        </div>
                    </div>
                </div>

                <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
                <div style="float: right;margin-top: 5px">
                    <button type="button" onclick="cancelar('productos')" class="btn btn-danger">Cancelar</button>
                    <button onclick="" type="submit" class="btn btn-success">Guardar</button>
                </div>
            </form>
        </div>
    </div>
</div>
<script>

</script>
<script>
    window.onload = cambioPeso;

    function cambioPeso() {
        var select = document.getElementById("tipo");
        var identificador = document.getElementById("identificador");
        var valorSeleccionado = select.value;

        if (valorSeleccionado == 1) {
            identificador.innerHTML = "Libras";
        } else if (valorSeleccionado == 2) {
            identificador.innerHTML = "Onzas";
        } else {
            identificador.innerHTML = " "; // Si no se selecciona ninguna opción, se limpia el contenido del span
        }
    }
</script>
@endsection