@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Edicion de Bebidas')
@section('miga')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
    href="{{route('menuAdmon.index')}}">Restaurante</a></li>
    <li class="breadcrumb-item text-sm active text-dark active">
        Editando Bebida
     </li>
@endsection
@section('content')
<div class="page-wrapper p-t-170 p-b-100 font-robo">
    <div class="wrapper wrapper--w960">
        <div class="card card-2">
         <div class="card-body">
            <h2 class="text-center">Editando Bebida: {{$Bebidas->nombre}}</h2>  
            <form method="post" action="{{route('bebida.update', ['id'=> $Bebidas->id])}}" enctype="multipart/form-data">
            @method('put')
            @csrf
            <br>
            <div style="width:200px;float:left">
                <label for=""><strong>Seleccione una imagen</strong></label>
                <img src="{{asset($Bebidas->imagen)}}" alt="" width="200px" height="200px" id="imagenmostrada">
                <br>
                <input type="file" id="imagen" name="imagen" accept="image/*"
                    value="{{ old('imagenPrevisualizacion', $Bebidas->imagen) }}" style="color: white;width: 200px;">
                @error('imagen')
                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                @enderror
            </div>

            <div style="margin-left:2%;float:left;width:35%">
                <div class="">
                    <label for=""><strong>Seleccione el tipo de producto</strong></label>
                    <select name="tipo" id="tipo" onchange="producto();quitarerror()" class="form-control">
                        @if (old('tipo'))
                            @if (old('tipo') === 2)
                                <option disabled="disabled" selected="selected" value="2">Comida</option>
                            @else
                                @if (old('tipo') === 1)
                                    <option disabled="disabled" selected="selected" value="1">Bebida</option>
                                @endif
                            @endif
                        @else
                        @endif
                        <option value="1"{{$Bebidas->tipo === "1" ? 'selected' : ''}}>Bebida</option>
                        <option value="2"{{$Bebidas->tipo === "2" ? 'selected' : ''}}>Comida</option>
                    </select>
                </div>
                @error('tipo')
                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                @enderror
                <br>
                <label for=""><strong>Ingrese el nombre del producto</strong></label>
                <input class="form-control" type="text" placeholder="Nombre" name="nombre"
                    value="{{ old('nombre',  $Bebidas->nombre) }}" maxlength="25" required onkeypress="quitarerror()">
                @error('nombre')
                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                @enderror
                <br>
                <label for=""><strong>Ingrese la descripción</strong></label>
                <textarea class="form-control" type="text" placeholder="Descripción" name="descripcion" maxlength="100" required
                    onkeypress="quitarerror()">{{ old('descripcion', $Bebidas->descripcion ) }}</textarea>
                @error('descripcion')
                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                @enderror
                <br><br>

            </div>

            <div style="margin-left:2%;float:left;width:35%">
                <div class="">
                    <label for=""><strong>Seleccione el tamaño</strong></label>
                    <select name="tamanio" required onchange="quitarerror()" class="form-control">
                        @if (old('tamanio'))
                            @if (old('tamanio') === 'Grande')
                                <option style="display: none" selected="selected" value="Grande">Grande</option>
                            @else
                                @if (old('tamanio') === 'Mediano')
                                    <option style="display: none" selected="selected" value="Mediano">Mediano
                                    </option>
                                @else
                                    @if (old('tamanio') === 'Pequeño')
                                        <option style="display: none" selected="selected" value="Pequeño">Pequeño
                                        </option>
                                    @endif
                                @endif
                            @endif
                        @else
                        <option disabled="disabled" selected="selected" value="{{$Bebidas->tamanio}}">Seleccione el tamaño</option>
                        @endif
                        <option value="Grande"{{$Bebidas->tamanio === 'Grande' ? 'selected' : ''}}>Grande</option>
                        <option value="Mediano"{{$Bebidas->tamanio === 'Mediano' ? 'selected' : ''}}>Mediano</option>
                        <option value="Pequeño"{{$Bebidas->tamanio === 'Pequeño' ? 'selected' : ''}}>Pequeño</option>
                    </select>
                </div>
                @error('tamanio')
                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                @enderror
                <br>
                <label for=""><strong>Ingrese el precio</strong></label>
                <input class="form-control" type="number" placeholder="Precio" name="precio" id="precio"
                onkeypress="quitarerror()" step="0.01"
                onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1" max="1000"
                value="{{ old('precio', $Bebidas->precio) }}"  required>
                @error('precio')
                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                @enderror

                <div id="bebida" style="display:none">
                    <br>
                    <label for=""><strong>Ingrese las bebidas disponibles</strong></label>
                    <input class="form-control" type="number" placeholder="Bebidas disponibles"
                        name="cantidad" id="cantidad" value="{{ old('cantidad', $Bebidas->disponible) }}"
                        onkeypress="quitarerror()"
                        onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1"
                        max="1000" disabled>
                    @error('cantidad')
                        <strong class="menerr" class="menerr" style="color:red">{{ $message }}</strong>
                    @enderror
                    <br><br>
                </div>

                <div id="comida" style="display:none">
                    <br>
                    <label for=""><strong>Ingrese la cantidad de platillos disponibles</strong></label>
                    <input class="form-control" type="number" placeholder="Platillos disponibles"
                        name="disponible" id="disponible" value="{{ old('disponible', $Bebidas->disponible) }}"
                        onkeypress="quitarerror()"
                        onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1"
                        max="1000" disabled>
                    @error('disponible')
                        <strong class="menerr" class="menerr" style="color:red">{{ $message }}</strong>
                    @enderror
                    <br><br>
                </div>

                <div id="espacio"><br><br><br><br><br><br></div>
                <div style="float:right">
                    <button type="submit" class="btn btn-success">Actualizar</button>
                    <button type="button" onclick="cancelar('admonRestaurante')"
                        class="btn btn-warning">Cancelar</button>
                </div>
            </div>

        </form>
    </div>
</div>
</div>
</div>
@stop
