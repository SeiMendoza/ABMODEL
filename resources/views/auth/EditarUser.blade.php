@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Editar Usuario')
@section('miga')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="{{route('usuarios.users')}}">Usuarios</a></li>
<li class="breadcrumb-item text-sm text-dark active text-white" aria-current="page">Editar</li>
@endsection
@section('tit','Edición de Usuario')

@section('b')
<div>
    <a href="{{route('usuarios.users')}}" style="margin:0; padding:5px; width:160px;" type="button" class="bg-light border-radius-sm text-center ">
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
                <h2 class="title" style="margin-bottom:0%"></h2>
                <form method="POST" action="{{ route('usuarios.update', ['id' => $user->id]) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <h4 class="font-robo t" style="margin: 0; padding:0">Datos del registro</h4>
                    <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
                    
                    <div class="row row-space">
                        <div class="col-3">
							<BR>
                            <div>
                                <img onclick="elegirImagen()" src="{{asset($user->imagen)}}" alt="" width="240px" height="240px" id="imagenmostrada">
                                <br><br>
                                 <label id="label" for="imagen" style=" display:block ;margin:0; padding:5px; width:240px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;" class="btn btn-info text-center "> 
                                    <i class="fa fa-file-image"></i> Cambiar imagen</label>
                                 <input type="file" id="imagen" name="imagen" accept="images/*" value="{{ old('imagenPrevisualizacion', $user->imagen) }}" 
                                    onchange="colocarNombre();" style="display:none; margin-left: 0; color: white;width: 200px; ">
                                @error('imagen')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>

                        <div class="col">

                            <div class="row" style="margin-left:20px">
                                <div class="col">
                                     <label for="name"><strong>Nombre:</strong></label>
                                     <input class="form-control border-radius-sm" type="text" placeholder="Ingrese el nombre de usuario" name="name"
                                       value="{{ old('name', $user->name) }}" required autocomplete="name"
									   autofocus maxlength="40"
									   onkeypress="return funcionConversionLetras(event);">
                                    @error('name')
                                       <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="col">
                                    <label for="telephone"><strong>Teléfono:</strong></label>
                                    <input class="form-control border-radius-sm" type="number" placeholder="Ingrese el número telefonico" name="telephone" 
                                       value="{{ old('telephone', $user->telephone ) }}" required minlength="8" maxlength="8">
                                    @error('telephone')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>

                            <BR>
                            <div class="row" style="margin-left:20px">
                                <div class="col">
									<label for="email"><strong>Correo Electrónico:</strong></label>
                                    <input class="form-control border-radius-sm" type="email" placeholder="Ingrese un correo" name="email" 
                                       value="{{ old('email', $user->email ) }}" required onkeypress="quitarerror()"
									   pattern="^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$">
                                    @error('email')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>  

                                <div class="col">
                                    <div class="font-robo form-group" style="margin-bottom: 5px">
                                        <label for="is_default" style="margin-left: 0;">Permisos: </label>
                                        <select name="is_default"  id="is_default" onchange="quitarerror()"  class="form-control border-radius-sm"
                                        @if (Auth::user()->isAdmin() && Auth::user()->id === $user->id) disabled @endif>
                                        @if (old('is_default', $user->is_default))
                                        <option disabled="disabled" selected="selected" value="">Seleccione</option>
                                            @if (old('is_default', $user->is_default) == 'Administrador')
                                                <option style="display: none" selected="selected" value="Administrador">Administrador</option>
                                            @else
                                                @if (old('is_default', $user->is_default) == 'Usuario')
                                                    <option style="display: none" selected="selected" value="Usuario">Usuario</option>
                                                @endif
                                            @endif
                                        @else
                                            <option disabled="disabled" selected="selected" value="{{old('is_default', $user->is_default) == 'Usuario'}}">Seleccione</option>
                                        @endif
                                        <option value="Administrador">Administrador</option>
                                        <option value="Usuario">Usuario</option>
                                        </select>
                                        @if (Auth::user()->id === $user->id)
                                            @error('is_default')
                                               <strong class="menerr" style="color:red">{{ $message }}</strong>
                                            @enderror
                                        @endif
                                    </div>
                                </div>
                            </div>

						<BR>
						<div class="row" style="margin-left:20px">
                        <div class="col">
                            <label for="new_password"><strong>Nueva contraseña:</strong></label>
                            <input class="form-control border-radius-sm" type="password" placeholder="Ingrese una nueva contraseña" name="new_password"
                               value="{{ old('new_password') }}" onkeypress="quitarerror()" >
                            @error('new_password')
                               <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                        
                        <div class="col">
                            <label for="new_password_confirmation"><strong>Confirmar nueva contraseña:</strong></label>
                            <input class="form-control border-radius-sm" type="password" placeholder="Confirmar la nueva contraseña" name="new_password_confirmation" 
                               value="{{ old('new_password_confirmation') }}" onkeypress="quitarerror()" >
                            @error('new_password_confirmation')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                        </div>

						<BR>
                            <div class="row" style="margin-left:20px">
                                <div class="col">
									<label for="address"><strong>Dirección:</strong></label>
									<textarea class="form-control border-radius-sm" type="text" placeholder="Ingrese la dirección (domicilio)" name="address"
                                    maxlength="300" required style="resize:none;  height: 50px;"
                                    onkeypress="quitarerror()">{{ old('address', $user->address) }}</textarea>
                                    @error('address')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>  
                        </div>
                    </div>
                </div> 

                    <div>
                        <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
                    </div>
                    <div style="float: right;margin-top: 5px">
                        <button type="button" onclick="cancelar('listaUsuarios')"
                            class="btn btn-warning">Cancelar</button>
						<button type="submit" class="btn btn-success">Actualizar</button>
					</div>

                </form>
            </div>
        </div>
    </div>
@stop

<script type="">
	function funcionConversionLetras(evt) {
		var code = (evt.which) ? evt.which : evt.keyCode;
		var input = evt.target.value;

		// No permitir símbolos, ni numeros
		if (code >= 33 && code <= 64 || code >= 186 && code <= 222 || code >= 91 && code <= 96) {
			return false;
		}

		// No permitir espacios al inicio
		if (code == 32 && input.length === 0) {
			return false;
		}

		// Cambiar la primera letra de cada palabra a mayúscula
		var words = input.split(" ");
		for (var i = 0; i < words.length; i++) {
			words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
		}
		var modifiedInput = words.join(" ");
		evt.target.value = modifiedInput;

		// Permitir separar palabras (min una vez, max tres)
		if (code == 32) {
			var spaceCount = (input.match(/ /g) || []).length;
			if (spaceCount >= 3) {
				return false;
			}
		}
		return true;
	}

	
</script>

