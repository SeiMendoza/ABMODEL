@extends('00_plantillas_blade.plantilla_General1')
@section('contend')

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


    <div class="page-wrapper bg-red p-t-170 p-b-100 font-robo">
        <br><br>
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Registro de Platillos y Bebidas</h2>
                    <form method="post" action="" enctype="multipart/form-data">
                        @csrf

                        <div style="width:200px;float:left">
                            <img src="" alt="" width="200px" height="200px" id="imagenmostrada">
                            <br>
                            <input type="file" id="imagen" name="imagen" accept="image/*" required
                                value="{{ old('imagenPrevisualizacion') }}" style="color: white;width: 200px;">
                            @error('imagen')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div style="margin-left:2%;float:left;width:35%">
                            <div class="">
                                <select name="tipo" id="tipo" required onchange="producto();quitarerror()">
                                    @if (old('tipo'))
                                        @if (old('tipo') === 2)
                                            <option disabled="disabled" selected="selected" value="2">Comida</option>
                                        @else
                                            @if (old('tipo') === 1)
                                                <option disabled="disabled" selected="selected" value="1">Bebida</option>
                                            @endif
                                        @endif
                                    @else
                                        <option disabled="disabled" selected="selected" value="">Tipo de producto</option>
                                    @endif
                                    <option value="1">Bebida</option>
                                    <option value="2">Comida</option>
                                </select>
                            </div>
                            @error('tipo')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                            <br>
                            <input class="input--style-2" type="text" placeholder="Nombre" name="nombre"
                                value="{{ old('nombre') }}" maxlength="25" required onkeypress="quitarerror()">
                            @error('nombre')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                            <br><br>
                            <textarea class="textarea--style-2" type="text" placeholder="Descripci??n" name="descripcion" maxlength="100" required
                                onkeypress="quitarerror()">{{ old('descripcion') }}</textarea>
                            @error('descripcion')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                            <br><br>

                        </div>

                        <div style="margin-left:2%;float:left;width:35%">
                            <div class="">
                                <select name="tamanio" required onchange="quitarerror()">
                                    @if (old('tamanio'))
                                        @if (old('tamanio') === 'Grande')
                                            <option disabled="disabled" selected="selected" value="Grande">Grande</option>
                                        @else
                                            @if (old('tamanio') === 'Mediano')
                                                <option disabled="disabled" selected="selected" value="Mediano">Mediano
                                                </option>
                                            @else
                                                @if (old('tamanio') === 'Peque??o')
                                                    <option disabled="disabled" selected="selected" value="Peque??o">Peque??o
                                                    </option>
                                                @endif
                                            @endif
                                        @endif
                                    @else
                                        <option disabled="disabled" selected="selected" value="">Tama??o</option>
                                    @endif
                                    <option value="Grande">Grande</option>
                                    <option value="Mediano">Mediano</option>
                                    <option value="Peque??o">Peque??o</option>
                                </select>
                            </div>
                            @error('tamanio')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                            <br>
                            <input class="input--style-2" type="text" placeholder="Precio" name="precio" id="precio"
                            onkeypress="quitarerror()"
                            onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1" max="1000"
                            value="{{ old('precio') }}"  required>
                            @error('precio')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror

                            <div id="bebida" style="display:none">
                                <br>
                                <input class="input--style-2" type="number" placeholder="Bebidas disponibles"
                                    name="cantidad" id="cantidad" value="{{ old('cantidad') }}"
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
                                <input class="input--style-2" type="number" placeholder="Platillos disponibles"
                                    name="disponible" id="disponible" value="{{ old('disponible') }}"
                                    onkeypress="quitarerror()"
                                    onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1"
                                    max="1000" disabled>
                                @error('disponible')
                                    <strong class="menerr" class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                                <br><br>
                            </div>

                            <div id="espacio"><br><br><br><br></div>
                            <div style="float:right">
                                <button type="submit" class="btn btn-success">Guardar</button>
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
