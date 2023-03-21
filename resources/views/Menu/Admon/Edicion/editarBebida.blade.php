@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Edicion de Bebidas')
@section('miga')
<li class="breadcrumb-item text-sm text-dark" aria-current="page">  
    <a class="text-dark" href="{{route('menuAdmon.index')}}">Menú</a></li>
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark" >Editando Bebida</a></li>
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
        <div>
            <br>
            <h2 class="text-center">Editando a: {{$Bebidas->nombre}}</h2>  
        <form method="post" action="{{route('bebida.update', ['id'=> $Bebidas->id])}}" enctype="multipart/form-data">
            @method('put')
            @csrf
             <br>
            <div class="">
                <div style="float: left;">
                    <label for=""><strong>Seleccione una imagen:</strong></label>
                    <br>
                    <img src="{{asset($Bebidas->imagen)}}"  alt="" width="200px" height="200px" id="imagenmostrada1">
                    <br>
                    <input type="file" id="imagen1" name="imagen1" accept="image/*"  onchange="precargar(1)"
                        value="{{ old('imagenPrevisualizacion', $Bebidas->imagen) }}" style="color: white;width: 200px;">
                    @error('imagen1')
                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                    @enderror
                </div>

                <div style="float: left; margin-left: 10px; width: 270px">
                    <label for=""><strong>Nombre bebida:</strong></label>
                    <input class="form-control" type="text" placeholder="Nombre de la bebida" name="nombre1"
                        value="{{ old('nombre1', $Bebidas->nombre) }}" maxlength="25"  onkeypress="quitarerror()">
                    @error('nombre1')
                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                    @enderror
                    <br>
                    <label for=""><strong>Ingrese la descripcion del producto:</strong></label>
                    <textarea class="form-control" type="text" placeholder="Descripción" name="descripcion1" 
                    maxlength="100"  rows="5"
                    onkeypress="quitarerror()">{{ old('descripcion1', $Bebidas->descripcion) }}</textarea>
                    @error('descripcion1')
                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                    @enderror
                    <br><br>
                </div>

                <div style="float: left; margin-left: 10px; width: 270px">
                    <label for=""><strong>Seleccione el tamaño:</strong></label>
                    <select name="tamanio1" required onchange="quitarerror()" class="form-control">
                        @if (old('tamanio1'))
                            @if (old('tamanio1') === 'Grande')
                                <option style="display: none" selected="selected" value="Grande">Grande</option>
                            @else
                                @if (old('tamanio1') === 'Mediano')
                                    <option style="display: none" selected="selected" value="Mediano">Mediano
                                    </option>
                                @else
                                    @if (old('tamanio1') === 'Pequeño')
                                        <option style="display: none" selected="selected" value="Pequeño">Pequeño
                                        </option>
                                    @endif
                                @endif
                            @endif
                        @else
                            <option disabled="disabled" selected="selected" value="{{$Bebidas->tamanio}}">Seleccione una opcion</option>
                        @endif
                        <option value="Grande"{{$Bebidas->tamanio === 'Grande' ? 'selected' : ''}}>Grande</option>
                        <option value="Mediano"{{$Bebidas->tamanio === 'Mediano' ? 'selected' : ''}}>Mediano</option>
                        <option value="Pequeño"{{$Bebidas->tamanio === 'Pequeño' ? 'selected' : ''}}>Pequeño</option>
                    </select>
                    @error('tamanio1')
                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                    @enderror

                    <br>
                    <label for=""><strong>Ingrese el precio:</strong></label>
                    <input class="form-control" type="number" placeholder="Precio" name="precio1" id="precio"
                    onkeypress="quitarerror()" step="any"
                    onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1" max="1000"
                    value="{{ old('precio1', $Bebidas->precio) }}"  required>
                    @error('precio1')
                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                    @enderror

                    <br>
                    <label for=""><strong>Ingrese la cantidad de bebidas:</strong></label>
                    <input class="form-control" type="number" placeholder="Bebidas disponibles"
                        name="cantidad1" id="cantidad" value="{{ old('cantidad1', $Bebidas->disponible) }}"
                        onkeypress="quitarerror()"
                        onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1"
                        max="1000">
                    @error('cantidad1')
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
@endsection 


               