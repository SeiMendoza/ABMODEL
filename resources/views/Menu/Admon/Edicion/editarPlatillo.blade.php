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

<BR><BR><BR>

<div class="container ">
    <div class="row d-flex justify-content-center" >
        <div class="card col-lg-9" >
    <div class="" >
        <br>
        <h2 class="text-center">Editando a: {{$Platillos->nombre}}</h2>
                    <form method="post" action="{{route('plato.update', ['id'=> $Platillos->id])}}" enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <br>

                        <div class="">
                            <div style="float: left;">
                                <label for=""><strong>Seleccione una imagen:</strong></label>
                                <br>
                                <img src="{{asset($Platillos->imagen)}}" alt="" width="200px" height="200px" id="imagenmostrada2">
                                <br>
                                <input type="file" id="imagen2" name="imagen2" accept="image/*"  onchange="precargar(2)"
                                    value="{{ old('imagenPrevisualizacion', $Platillos->imagen) }}" style="color: white;width: 200px;">
                                @error('imagen')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div style="float: left; margin-left: 10px; width: 270px">
                                <label for=""><strong>Nombre platillo:</strong></label>
                                <input class="form-control" type="text" placeholder="Nombre del platillo" name="nombre2"
                                    value="{{ old('nombre2', $Platillos->nombre) }}" maxlength="25" required onkeypress="quitarerror()">
                                @error('nombre2')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                                <br>
                                <label for=""><strong>Ingrese la descripcion del producto:</strong></label>
                                <textarea class="form-control" type="text" placeholder="Descripción" name="descripcion2" 
                                maxlength="100" required rows="5"
                                onkeypress="quitarerror()">{{ old('descripcion2', $Platillos->descripcion) }}</textarea>
                                @error('descripcion2')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                                <br><br>
                            </div>

                            <div style="float: left; margin-left: 10px; width: 270px">
                                <label for=""><strong>Seleccione el tamaño:</strong></label>
                                <select name="tamanio2" required onchange="quitarerror()" class="form-control">
                                    @if (old('tamanio2'))
                                        @if (old('tamanio2') === 'Grande')
                                            <option style="display: none" selected="selected" value="Grande">Grande</option>
                                        @else
                                            @if (old('tamanio2') === 'Mediano')
                                                <option style="display: none" selected="selected" value="Mediano">Mediano
                                                </option>
                                            @else
                                                @if (old('tamanio2') === 'Pequeño')
                                                    <option style="display: none" selected="selected" value="Pequeño">Pequeño
                                                    </option>
                                                @endif
                                            @endif
                                        @endif
                                    @else
                                        <option disabled="disabled" selected="selected" value="{{$Platillos->tamanio}}">Seleccione una opcion</option>
                                    @endif
                                    <option value="Grande"{{$Platillos->tamanio === 'Grande' ? 'selected' : ''}}>Grande</option>
                                    <option value="Mediano"{{$Platillos->tamanio === 'Mediano' ? 'selected' : ''}}>Mediano</option>
                                    <option value="Pequeño"{{$Platillos->tamanio === 'Pequeño' ? 'selected' : ''}}>Pequeño</option>
                                </select>
                                @error('tamanio2')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror

                                <br>
                                <label for=""><strong>Ingrese el precio:</strong></label>
                                <input class="form-control" type="number" placeholder="Precio" name="precio2" id="precio"
                                onkeypress="quitarerror()" step="any"
                                onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1" max="1000"
                                value="{{ old('precio2', $Platillos->precio) }}"  required>
                                @error('precio2')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror

                                <br>
                                <label for=""><strong>Ingrese la cantidad de platillo:</strong></label>
                                <input class="form-control" type="number" placeholder="Platillos disponibles"
                                name="disponible2" id="disponible" value="{{ old('disponible2', $Platillos->disponible) }}"
                                    onkeypress="quitarerror()"
                                    onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1"
                                    max="1000">
                                @error('disponible2')
                                    <strong class="menerr" class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div style="float: right;margin-top: 20px; margin-right: 100px">
                                <button type="button" onclick="cancelar('admonRestaurante')" class="btn btn-warning" >Cerrar</button>
                                <button onclick="" type="submit" class="btn btn-success">Actualizar</button>
                            </div> 
                        </div> 
                    </form>
                </div>
                </div>
            </div>
</div>

@endsection