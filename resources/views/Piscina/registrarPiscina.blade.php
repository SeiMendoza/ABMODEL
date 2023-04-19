@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Piscina-productos')

@section('miga')
    <li class="breadcrumb-item text-sm text-white opacity-6">
        <a class="text-white" href="{{route('prodpiscina.index')}}">Productos Piscina</a>
    </li>
    <li class="breadcrumb-item text-sm active text-white active">Crear</li>
@endsection

@section('content')
        <div class="wrapper wrapper--w960">
            <div class="card">
                <div class="card-body">
                    <h2 class="title">Registro de producto de piscina</h2>
                    <form method="post" action="{{ route('piscina.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div style="margin-left:2%;float:left;width:47%">
                            <label for=""><strong>Ingrese el nombre del producto</strong></label>
                            <input class="form-control" type="text" placeholder="Nombre del producto" name="nombre" id="nombre"
                            value="@if(Session::has('nombre')){{Session::get('nombre')}}@else{{old('nombre')}}@endif"
                            maxlength="25"  onkeypress="quitarerror()">
                            @error('nombre')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div style="margin-left:2%;float:left;width:47%;">
                            <label for=""><strong>Seleccione el tipo de producto</strong></label>
                            <select name="tipo" onchange="cambioPeso()" id="tipo" class="form-control">
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
                        </div>

                        <div style="margin-left:2%;float:left;width:47%;margin-top: 30px">
                            <label for=""><strong>Seleccione el periodo de uso</strong></label>
                            <select name="uso" onchange="quitarerror();cambioPeso();" id="uso" class="form-control">
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
                        </div>

                        <script>
                            window.onload = cambioPeso;
                            function cambioPeso() {
                                var select = document.getElementById("tipo");
                                var identificador = document.getElementById("identificador");
                                var valorSeleccionado = select.value;

                                if (valorSeleccionado == 1) {
                                    identificador.innerHTML = "libras";
                                } else if (valorSeleccionado == 2) {
                                    identificador.innerHTML = "onzas";
                                } else {
                                    identificador.innerHTML = ""; // Si no se selecciona ninguna opción, se limpia el contenido del span
                                }
                            }
                        </script>
                        

                        <div style="margin-left:2%;float:left;width:47%;margin-top: 30px">
                            <label for=""><strong>Ingrese el peso</strong></label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="number" name="kilos" id="kilos"
                                step="0.01" min="1" max="100" placeholder="Ingrese el peso"
                                value="@if(Session::has('kilos')){{Session::get('kilos')}}@else{{old('kilos')}}@endif"
                                onkeypress="quitarerror()">
                                <div class="input-group-prepend">
                                    <span class="input-group-text" id="identificador"></span>
                                </div>
                            </div>
                            @error('kilos')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div style="float: right;margin-top: 50px">
                            <button type="button" onclick="cancelar('productos')"
                                class="btn btn-warning">Cancelar</button>
                                <button type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
