@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Edicion de Platillos')
@section('miga')
<li class="breadcrumb-item text-sm text-dark" aria-current="page">  
    <a class="text-dark" href="{{route('menuAdmon.index')}}">Menú</a></li>
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" >Editando Platillo</a></li>
@endsection

@section('content')
<div class="row">
    <h4 class="col">Administración de Menú</h4>
    <a class="col-2 text-center text-danger" href="{{ route('cliente_prueba') }}"><i class="fa fa-users"></i> Ver menu cliente</a>
</div>

<div class="row">
    <div class="container-fluid">
        <ul class="nav d-flex justify-content-center h5 text-center" role="tablist"
            style="background-color: #ef3f3f; rounde">

            <li class="nav-item" role="presentation">
                <a class="nav-link text-white" id="pills-bebidas-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-bebidas" type="button" role="tab" aria-controls="pills-bebidas"
                    aria-selected="true">Bebidas</a>
            </li>

            <li class="nav-item" role="presentation">
                <a class="nav-link active text-white" id="pills-platillos-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-platillos" type="button" role="tab" aria-controls="pills-platillos"
                    aria-selected="false">Platillos</a>
            </li>

            <li class="nav-item" role="presentation">
                <a class="nav-link text-white" id="pills-combos-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-combos" type="button" role="tab" aria-controls="pills-combos"
                    aria-selected="false">Combos</a>
            </li>
        </ul>
    </div>
</div>

    <div class="page-wrapper bg-red p-t-170 p-b-100 font-robo">
        <br><br>
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="text-center">Editando a: {{$Platillos->nombre}}</h2>
                    <form method="post" action="{{route('plato.update', ['id'=> $Platillos->id])}}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <br>
                        <div style="width:200px;float:left">
                            <label for=""><strong>Seleccione una imagen</strong></label>
                            <img src="{{asset($Platillos->imagen)}}" alt="" width="200px" height="200px" id="imagenmostrada">
                            <br>
                            <input type="file" id="imagen" name="imagen" accept="image/*"
                                value="{{ old('imagenPrevisualizacion', $Platillos->imagen) }}" style="color: white;width: 200px;">
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
                                    <option value="2"{{$Platillos->tipo === "2" ? 'selected' : ''}}>Comida</option>
                                    <option value="1"{{$Platillos->tipo === "1" ? 'selected' : ''}}>Bebida</option>
                                </select>
                            </div>
                            @error('tipo')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                            <br>
                            <label for=""><strong>Ingrese el nombre del producto</strong></label>
                            <input class="form-control" type="text" placeholder="Nombre" name="nombre"
                                value="{{ old('nombre',  $Platillos->nombre) }}" maxlength="25" required onkeypress="quitarerror()">
                            @error('nombre')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                            <br>
                            <label for=""><strong>Ingrese la descripción</strong></label>
                            <textarea class="form-control" type="text" placeholder="Descripción" name="descripcion" maxlength="100" required
                                onkeypress="quitarerror()">{{ old('descripcion', $Platillos->descripcion ) }}</textarea>
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
                                    <option disabled="disabled" selected="selected" value="{{$Platillos->tamanio}}">Seleccione el tamaño</option>
                                    @endif
                                    <option value="Grande"{{$Platillos->tamanio === 'Grande' ? 'selected' : ''}}>Grande</option>
                                    <option value="Mediano"{{$Platillos->tamanio === 'Mediano' ? 'selected' : ''}}>Mediano</option>
                                    <option value="Pequeño"{{$Platillos->tamanio === 'Pequeño' ? 'selected' : ''}}>Pequeño</option>
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
                            value="{{ old('precio', $Platillos->precio) }}"  required>
                            @error('precio')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror

                            <div id="bebida" style="display:none">
                                <br>
                                <label for=""><strong>Ingrese las bebidas disponibles</strong></label>
                                <input class="form-control" type="number" placeholder="Bebidas disponibles"
                                    name="cantidad" id="cantidad" value="{{ old('cantidad', $Platillos->cantidad) }}"
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
                                    name="disponible" id="disponible" value="{{ old('disponible', $Platillos->disponible) }}"
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
