@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Piscina-productos')

@section('miga')
<li class="breadcrumb-item text-sm text-white opacity-6">
    <a class="text-white" href="{{route('prodpiscina.index')}}">Productos Piscina</a>
</li>
<li class="breadcrumb-item text-sm active text-white active">Crear</li>
@endsection

@section('content')
<style>
    .row-space {
        margin-bottom: 20px;
        display: flex;
        flex-wrap: wrap;
        justify-content: space-between;
        align-items: stretch;
        min-height: 60px;
    }

    .row-space .form-group {
        margin-bottom: 0;
    }

    .row-space .form-group label {
        margin-bottom: 0;
    }

    .align-items-center>* {
        align-self: center;
    }

    .align-items-center .form-group {
        margin-bottom: 0;
    }

    .align-items-center input[type=number],
    .align-items-center select {
        height: 45px;
    }
</style>
<div class="wrapper wrapper--w960 font-robo">
    <div class="card border-radius-sm border-0">
        <div class="card-body border-radius-sm border-0">
            <h2 class="title" style="margin-bottom:0">Registro de producto de piscina</h2>
            <h4 class="font-robo t" style="margin: 0; padding:0">Datos del producto: </h4>
            <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
            <form method="post" action="{{ route('piscina.store') }}" enctype="multipart/form-data">
                @csrf
                <div class="row row-space">
                    <div class="col-6">
                        <div class="font-robo form-group">
                            <label for="">Nombre del producto:</label>
                            <input style="padding-left: 8px;" class="form-control border-radius-sm" placeholder="Nombre del producto" name="nombre" id="nombre" value="@if(Session::has('nombre'))
                            {{Session::get('nombre')}}@else{{old('nombre')}}@endif" maxlength="25" onkeypress="quitarerror()">
                            @error('nombre')
                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="font-robo form-group">
                            <label for="">Tipo de producto: </label>
                            <div style="">
                                <select onchange="cambioPeso();mostrarOcultarDiv();cambiarPlaceholder()" class="form-control border-radius-sm" style="text-indent: 8px !important;" name="tipo" id="tipo">
                                    @if (old('tipo'))
                                    <option disabled="disabled" value="">Selecciona el tipo de producto</option>
                                    @foreach ($tipo as $c)
                                    @if (old('tipo') == $c->id)
                                    <option selected="selected" value="{{$c->id}}">{{$c->descripcion}}</option>
                                    @else
                                    <option value="{{$c->id}}">{{$c->descripcion}}</option>
                                    @endif
                                    @endforeach
                                    @else
                                    <option disabled="disabled" selected="selected" value="">Selecciona el tipo de producto</option>
                                    @foreach ($tipo as $c)
                                    <option value="{{$c->id}}">{{$c->descripcion}}</option>
                                    @endforeach
                                    @endif
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
                                <select class="form-control border-radius-sm" name="uso" id="uso">
                                    @if (old('uso'))
                                    <option disabled="disabled" value="">Selecciona el periodo de tiempo de uso</option>
                                    @foreach ($uso as $c)
                                    @if (old('uso') == $c->id)
                                    <option selected="selected" value="{{$c->id}}">{{$c->descripcion}}</option>
                                    @else
                                    <option value="{{$c->id}}">{{$c->descripcion}}</option>
                                    @endif
                                    @endforeach
                                    @else
                                    <option disabled="disabled" selected="selected" value="">Selecciona el periodo de tiempo de uso</option>
                                    @foreach ($uso as $c)
                                    <option value="{{$c->id}}">{{$c->descripcion}}</option>
                                    @endforeach
                                    @endif
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
                            <input style="padding-left: 8px;width:340px;" class="form-control border-radius-sm" type="number" name="kilos" id="kilos" step="0.01" placeholder="Ingresa la cantidad" value="@if(Session::has('kilos')){{Session::get('kilos')}}@else{{old('kilos')}}@endif" onkeypress="quitarerror()">
                            @error('kilos')
                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                    <div class="col-4" id="contenedor">
                        <div class="font-robo form-group">
                            <span style="width:90px;position:absolute;top:57%;right:25px;text-align:center;" class="form-control border-radius-sm" id="identificador"></span>
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
</div>

<script>
    window.onload = cambioPeso;

    function cambiarPlaceholder() {
        var tipo = document.getElementById('tipo').value;
        var input = document.getElementById('kilos');
        if (tipo == 1) {
            input.placeholder = "Ingrese la cantidad de libras";
        } else if (tipo == 2) {
            input.placeholder = "Ingrese la cantidad de onzas";
        }
    }

    function cambioPeso() {
        var select = document.getElementById("tipo");
        var identificador = document.getElementById("identificador");
        var valorSeleccionado = select.value;

        if (valorSeleccionado == 1) {
            identificador.innerHTML = "libras";
        } else if (valorSeleccionado == 2) {
            identificador.innerHTML = "onzas";
        } else {
            identificador.innerHTML = "unidades"; // Si no se selecciona ninguna opción, se limpia el contenido del span
        }
    }
    /* oculta el campo de identificador es decir
     si es onzas o libras si no se selecciona un tipo de producto liquido o enpolvo*/
    function mostrarOcultarDiv() {
        var select = document.getElementById("tipo");
        var div = document.getElementById("contenedor");
        if (select.value) {
            div.style.display = "block";
        } else {
            div.style.display = "none";
        }
    }
</script>
@endsection