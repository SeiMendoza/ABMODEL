@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Agregar platillo o bebida')
@section('miga')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="{{route('menuAdmon.index')}}">Administración de menú</a></li>
<li class="breadcrumb-item text-sm text-dark active text-white" aria-current="page">Registro de platillo y bebida</li>
@endsection
@section('tit','')
<!-- 
<div>
    <a href="{{route('menuAdmon.index')}}" style="margin:0; padding:5px; width:160px; margin-top:25px" type="button" class="bg-light border-radius-sm text-center ">
        <i class="fa fa-arrow-left"></i>  Regresar
    </a>
</div>  -->

@section('b')
<div>
    <a href="{{route('menuAdmon.index')}}" style="margin:0; padding:5px; width:160px;" type="button" class="bg-light border-radius-sm text-center ">
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

    <div class=""> <!--aquí iria el wrapper-->
        <div class="card border-radius-sm border-0" style="">            
            <div class="card-body border-radius-sm border-0">
                <h2 class="title" style="margin-bottom:0%">Registro de platillo o bebida</h2>
                <form method="post" action="" enctype="multipart/form-data">
                    @csrf
                    <h4 class="font-robo t" style="margin: 0; padding:0">Datos del producto</h4>
                    <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">

                    <div class="row">
                        <div class="col">
                            <div>  
                                <label class="row" for=""><strong>Seleccione una imagen</strong></label>
                                <img class="row" src="/img/Villacrisol.png" alt="" width="240px" height="240px" id="imagenmostrada">
                                <br>
                                <input type="file" id="imagen" name="imagen" accept="image/*" required value="{{ old('imagenPrevisualizacion') }}" style="color: white;width: 200px;">
                                @error('imagen')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="row">
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
                                        <option disabled="disabled" selected="selected" value="">Seleccione el tipo de producto</option>
                                    @endif
                                    <option value="1">Bebida</option>
                                    <option value="2">Comida</option>
                                </select>
                                @error('tipo')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div><br>
                            <div class="row">
                                <label for=""><strong>Nombre del producto:</strong></label>
                                <input class="form-control border-radius-sm" type="text" placeholder="Ingrese el nombre del producto" name="nombre"
                                value="{{ old('nombre') }}" maxlength="25" required onkeypress="quitarerror()">
                                @error('nombre')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div><br>
                            <div class="row">
                                <label for=""><strong>Descripción:</strong></label>
                                <textarea class="form-control border-radius-sm" type="text" placeholder="Ingrese la descripción" name="descripcion" maxlength="100" required
                                onkeypress="quitarerror()">{{ old('descripcion') }}</textarea>
                                @error('descripcion')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="col">
                            <div class="row">
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
                                        <option disabled="disabled" selected="selected" value="">Seleccione el tamaño</option>
                                        @endif
                                        <option value="Grande">Grande</option>
                                        <option value="Mediano">Mediano</option>
                                        <option value="Pequeño">Pequeño</option>
                                    </select>
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                
                                <div class="col">
                                    <label for=""><strong>Precio:</strong></label>
                                    <input class="form-control border-radius-sm" type="number" placeholder="Ingrese el precio" name="precio" id="precio"
                                    onkeypress="quitarerror()" step="0.01"
                                    onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1" max="1000"
                                    value="{{ old('precio') }}"  required>
                                    @error('precio')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <br>
                            <div class="row">
                                
                                <div class="col">
                                    <div id="bebida" style="display:">
                                        <label for=""><strong>Cantidad disponible</strong></label>
                                        <input class="form-control border-radius-sm" type="number" placeholder="Ingrese la cantidad disponible"
                                            name="cantidad" id="cantidad" value="{{ old('cantidad') }}"
                                            onkeypress="quitarerror()" style="height: 50px;"
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
                                            name="disponible" id="disponible" value="{{ old('disponible') }}"
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

                    <hr class="m-2" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
                    <div style="float: right;margin-top: 5px">
                        <button type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" onclick="cancelar('admonRestaurante')"
                            class="btn btn-warning">Cancelar</button>
                    </div>

                </form>
            </div>
        </div>
    </div>



@stop
