@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Edicion de Complemento')
@section('miga')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="{{route('menuAdmon.complementos')}}">Administración de menú</a></li>
<li class="breadcrumb-item text-sm text-dark active text-white" aria-current="page">Editar</li>
@endsection
@section('tit','Edición de Producto')
@section('b')
<div>
    <a href="{{route('menuAdmon.complementos')}}" style="margin:0; padding:5px; width:160px;" type="button" class="bg-light border-radius-sm text-center ">
        <i class="fa fa-arrow-left"></i>  Regresar
    </a>
</div>
@endsection

@section('content')
<script>
    var msg = '{{ Session::get('mensaje') }}';
    var exist = '{{ Session::has('mensaje') }}';
    if (exist) {
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: msg,
            showConfirmButton: false,
            toast: true,
            background: '#0be004ab',
            timer: 3500
        })
    }
</script>

<div class="wrapper wrapper--w960"> <!--aquí iria el wrapper-->
    <div class="card border-radius-sm border-0" style="">

        <div class="card-body border-radius-sm border-0">
            <form method="post" action="{{route('complemento.update', ['id'=> $Comple->id])}}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <h4 class="font-robo t" style="margin: 0; padding:0">Datos del producto</h4>
                <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">

                <div class="row">
                    <div class="col-3">
                        <div>
                            <img onclick="elegirImagen()" src="{{asset($Comple->imagen)}}" alt="" width="240px" height="240px" id="imagenmostrada">
                            <br><br>
                            <label id="label" for="imagen" style=" display:block ;margin:0; padding:5px; width:240px;" class="btn btn-info text-center "> <i class="fa fa-file-image"></i> Cambiar imagen</label>
                            <input type="file" id="imagen" name="imagen" accept="images/*" value="{{ old('imagenPrevisualizacion', $Comple->imagen) }}" onchange="colocarNombre();" style="display:none; margin-left: 0; color: white;width: 200px; ">
                            @error('imagen')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <div class="col">

                        <div class="row" style="margin-left:20px">
                            <div class="col">
                                <label for=""><strong>Tipo de producto:</strong></label>
                                <select name="tipo" id="tipo" required onchange="producto();quitarerror()" class="form-control border-radius-sm">
                                    <option @if (old('tipo') == 3) selected @endif value="3"{{$Comple->tipo === "3" ? 'selected' : ''}}>Complemento</option>
                                    <option @if (old('tipo') == 1) selected @endif value="1"{{$Comple->tipo === "1" ? 'selected' : ''}}>Bebida</option>
                                    <option @if (old('tipo') == 2) selected @endif value="2"{{$Comple->tipo === "2" ? 'selected' : ''}}>Comida</option>
                                </select>
                                @error('tipo')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="col">
                                <label for=""><strong>Tamaño:</strong></label>
                                <select name="tamanio" required onchange="quitarerror()" class="form-control border-radius-sm">
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
                                        <option disabled="disabled" selected="selected" value="{{$Comple->tamanio}}">Seleccione el tamaño</option>
                                        @endif
                                        <option value="Grande"{{$Comple->tamanio === 'Grande' ? 'selected' : ''}}>Grande</option>
                                        <option value="Mediano"{{$Comple->tamanio === 'Mediano' ? 'selected' : ''}}>Mediano</option>
                                        <option value="Pequeño"{{$Comple->tamanio === 'Pequeño' ? 'selected' : ''}}>Pequeño</option>
                                </select>
                            </div>
                        </div>

                        <br>
                            <div class="row" style="margin-left:20px">
                                <div class="col">
                                    <label for=""><strong>Nombre del producto:</strong></label>
                                    <input class="form-control border-radius-sm" type="text" placeholder="Ingrese el nombre del producto" name="nombre"
                                    value="{{ old('nombre',  $Comple->nombre) }}" maxlength="25" required onkeypress="quitarerror()">
                                    @error('nombre')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for=""><strong>Precio:</strong></label>
                                    <input class="form-control border-radius-sm" type="number" placeholder="Ingrese el precio" name="precio" id="precio"
                                    onkeypress="quitarerror()" step="0.01"
                                    onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1" max="1000"
                                    value="{{ old('precio', $Comple->precio) }}"  required>
                                    @error('precio')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <br>
                            <div class="row"style="margin-left:20px" >
                                <div class="col">
                                    <label for=""><strong>Descripción:</strong></label>
                                    <textarea class="form-control border-radius-sm" type="text" placeholder="Ingrese la descripción" name="descripcion"
                                    maxlength="100" required style="resize:none; height: 50px;"
                                    onkeypress="quitarerror()">{{ old('descripcion', $Comple->descripcion) }}</textarea>
                                    @error('descripcion')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="col">
                                    <div id="bebida" style="display:">
                                        <label for=""><strong>Cantidad disponible</strong></label>
                                        <input class="form-control border-radius-sm" type="number" placeholder="Ingrese la cantidad disponible"
                                            name="cantidad" id="cantidad" value="{{ old('cantidad', $Comple->disponible) }}"
                                            onkeypress="quitarerror()"   style="height: 50px"
                                            onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1"
                                            max="1000">
                                        @error('cantidad')
                                            <strong class="menerr" class="menerr" style="color:red">{{ $message }}</strong>
                                        @enderror
                                        <br><br>
                                    </div>

                                    <div id="comida" style="display:none">
                                        <br>
                                        <label for=""><strong>Cantidad disponible</strong></label>
                                        <input class="form-control border-radius-sm" type="number" placeholder="Platillos disponibles"
                                            name="disponible" id="disponible" value="{{ old('disponible', $Comple->disponible) }}"
                                            onkeypress="quitarerror()"
                                            onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1"
                                            max="1000" disabled>
                                        @error('disponible')
                                            <strong class="menerr" class="menerr" style="color:red">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>

                   <div>
                    <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
                   </div>
                    <div style="float: right;margin-top: 5px">
                        <button type="submit" class="btn btn-success">Actualizar</button>
                        <button type="button" onclick="cancelarAct('¿Desea cancelar la actualización del complemento?','admonRestauranteC')"
                            class="btn btn-warning">Cancelar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@stop