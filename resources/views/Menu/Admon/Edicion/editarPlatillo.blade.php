@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Edicion de Platillos')
@section('miga')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="{{route('menuAdmon.index')}}">Administración de menú</a></li>
<li class="breadcrumb-item text-sm text-dark active text-white" aria-current="page">Edición de Platillo</li>
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
            <h2 class="title" style="margin-bottom:0%">Editando platillo: {{$Platillos->nombre}} </h2>
            <form method="post" action="{{route('plato.update', ['id'=> $Platillos->id])}}" enctype="multipart/form-data">
                @method('put')
                @csrf
                <h4 class="font-robo t" style="margin: 0; padding:0">Datos del platillo</h4>
                <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">

                <div class="row">
                    <div class="col-3">
                        <div>  
                            <label for=""><strong>Seleccione una imagen</strong></label>
                            <img src="{{asset($Platillos->imagen)}}" alt="" width="240px" height="240px" id="imagenmostrada">
                            <br>
                            <input type="file" id="imagen" name="imagen" accept="images/*" value="{{ old('imagenPrevisualizacion', $Platillos->imagen) }}" style="color: white;width: 200px;">
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
                                        <option disabled="disabled" selected="selected" value="{{$Platillos->tamanio}}">Seleccione el tamaño</option>
                                        @endif
                                        <option value="Grande"{{$Platillos->tamanio === 'Grande' ? 'selected' : ''}}>Grande</option>
                                        <option value="Mediano"{{$Platillos->tamanio === 'Mediano' ? 'selected' : ''}}>Mediano</option>
                                        <option value="Pequeño"{{$Platillos->tamanio === 'Pequeño' ? 'selected' : ''}}>Pequeño</option>
                                </select>
                            </div>
                        </div>

                        <br>
                            <div class="row" style="margin-left:20px">
                                <div class="col">
                                    <label for=""><strong>Nombre del producto:</strong></label>
                                    <input class="form-control border-radius-sm" type="text" placeholder="Ingrese el nombre del producto" name="nombre"
                                    value="{{ old('nombre',  $Platillos->nombre) }}" maxlength="25" required onkeypress="quitarerror()">
                                    @error('nombre')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="col">
                                    <label for=""><strong>Precio:</strong></label>
                                    <input class="form-control border-radius-sm" type="number" placeholder="Ingrese el precio" name="precio" id="precio"
                                    onkeypress="quitarerror()" step="0.01"
                                    onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1" max="1000"
                                    value="{{ old('precio',$Platillos->precio) }}"  required>
                                    @error('precio')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <br>
                            <div class="row" style="margin-left:20px" >
                                <div class="col">
                                    <label for=""><strong>Descripción:</strong></label>
                                    <textarea class="form-control border-radius-sm" type="text" placeholder="Ingrese la descripción" name="descripcion" 
                                    maxlength="100" required style="resize:none;  height: 50px;"
                                    onkeypress="quitarerror()">{{ old('descripcion', $Platillos->descripcion) }}</textarea>
                                    @error('descripcion')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="col">
                                    <div id="bebida" style="display:">
                                        <label for=""><strong>Cantidad disponible</strong></label>
                                        <input class="form-control border-radius-sm" type="number" placeholder="Ingrese la cantidad disponible"
                                            name="cantidad" id="cantidad" value="{{ old('cantidad', $Platillos->disponible) }}"
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
                                        <label for=""><strong>Ingrese la cantidad de platillos disponibles</strong></label>
                                        <input class="form-control border-radius-sm" type="number" placeholder="Platillos disponibles"
                                            name="disponible" id="disponible" value="{{ old('disponible', $Platillos->disponible) }}"
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
                        <button type="button" onclick="cancelar('admonRestaurante')"
                            class="btn btn-warning">Cancelar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
@stop

