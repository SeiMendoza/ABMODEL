@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Usuarios')
@section('miga')
<li class="breadcrumb-item text-sm text-white active m-0" aria-current="page">Usuarios</li>
@endsection
@section('tit','Lista de Usuarios')
@section('b')
<div class="" style="">    
    <a href="{{ route('usuarios.create') }}" style="margin:0; padding:5px; width:150px; font-size:15px" type="button" 
    class="bg-light border-radius-sm text-center">
    <i class="fa fa-plus-circle"></i> Nuevo Registro
   </a> 
</div>
@endsection



@section('content')

<style>
    .custom-error {
      font-size: 15px;
      font-weight: bold;
      background-color: #f93e47c7;
      color: #ffffff;
      padding: 10px;
      border-radius: 4px;
    }  

    .custom-exit {
      font-size: 15px;
      font-weight: bold;
      color: #ffffff;
      padding: 10px;
      border-radius: 4px;
    }  
  
</style>

@if(session('error'))
    <div id="error-message" class="alert alert-danger custom-error">
        <strong>{{ session('error') }}</strong>
    </div>

    <script>
        // Temporizador para ocultar el mensaje de error después de 3 segundos (3000 ms)
        setTimeout(function() {
            document.getElementById('error-message').style.display = 'none';
        }, 3000);
    </script>
@endif

@if(session('success'))
    <div id="error-success" class="alert alert-success custom-exit">
        <strong>{{ session('success') }}</strong>
    </div>

    <script>
        // Temporizador para ocultar el mensaje de error después de 3 segundos (3000 ms)
        setTimeout(function() {
            document.getElementById('error-success').style.display = 'none';  // none, hace que se oculte el mensaje de forma automática.
        }, 3000);
    </script>
@endif

<div class="table-responsive" style="">
    <table class="table" id="example" style="">
        <thead style="">
            <tr>
                <th scope="col" style="text-align: left;  ">Nombre</th>
                
                <th scope="col" style="text-align: left;">Correo Electrónico</th>
                <th scope="col" style="text-align: right; width:10% ">Teléfono</th>
                <th scope="col" style="text-align: center;">Dirección</th>
                <th scope="col" style="text-align: center;">Editar</th>
                <th scope="col" style="text-align: center; ">Eliminar</th>
            </tr>
        </thead>

        <tbody>
            @forelse($listaUs as $u => $l)
            <tr style=" height:46px">
                <td scope="col" style="text-align: left;">{{$l->name}} </td>
                
                <td scope="col" style="text-align: left;">{{$l->email}} </td>
                <td scope="col" style="text-align: right;">{{$l->telephone}}</td>
                <td scope="col" style="text-align: right;">{{$l->address}}</td>

                <td style="text-align: center;">
                    @if ($l->id == Auth::user()->id || Auth::user()->is_default)
                    <a href="{{ route('usuarios.editar', ['id' => $l->id]) }}" ><i class="fa fa-edit text-success"></i></a>
                    @else
                    <a ><i data-bs-toggle="modal" data-bs-target="#static{{$l->id}}" class="fas fa-times-circle text-success"></i></a> <!-- Icono para los demás usuarios -->
                    <div class="modal fade" id="static{{$l->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class="modal-dialog ">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title font-weight-bolder" id="staticBackdropLabel">Permiso denegado</h5>
                                </div>
                                <div class="modal-body">
                                    ¡No tienes permiso para editar este usuario.!
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif
                </td>

                <td scope="col" style="text-align: center;">
                    <!-- eliminar para cada usuario -->
                    <form id="eliminarUsuarioForm{{ $l->id }}" action="{{ route('usuarios.destroy', ['id' => $l->id]) }}" method="POST" style="display: inline">
                        @csrf
                        @method('DELETE')
                        <!-- icono de eliminar -->
                        <button type="button" onclick="eliminarUsuario({{ $l->id }})" class="fa-solid fa-trash-can text-danger"></button>
                    </form>

                    <!-- Modal de confirmación para cada usuario (solo si el usuario tiene atributo is_default) -->
                    @if(Auth::user()->is_default)
                        <div class="modal fade" id="modalEliminar{{ $l->id }}" tabindex="-1" role="dialog" aria-labelledby="modalEliminarLabel{{ $l->id }}" aria-hidden="true">
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-bolder" id="modalEliminarLabel{{ $l->id }}">Confirmar eliminación de usuario</h5>
                                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                <div class="modal-body">
                                ¿Está seguro de que desea eliminar al usuario 
                                <BR><strong>{{$l->name}}</strong>?
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                                <button type="submit" form="eliminarUsuarioForm{{ $l->id }}" class="btn btn-danger">Eliminar</button>
                            </div>
                        </div>
                        </div>
                        </div>
                    @endif   
                </td>
            </tr>

            @empty
            
            @endforelse
        </tbody>
    </table>
</div>

@endsection

<!-- Agrega el script para abrir el modal solo si el usuario tiene el valor de is_default en true -->
<script>
    function eliminarUsuario(id) {
        // Verificar si el usuario tiene permisos
        if ({{ Auth::user()->is_default }}) {
            // Mostrar el modal de confirmación
            $('#modalEliminar' + id).modal('show');
        } else {
            // Mostrar mensaje de error y enviar formulario de eliminación
            mostrarMensajeError();
            document.getElementById('eliminarUsuarioForm' + id).submit();
        }
    }
    
    function mostrarMensajeError() {
        //Mostrar 
        @if(session('error'))
            var errorDiv = document.createElement('div');
            errorDiv.className = 'alert alert-danger';   //estilos de la alerta
            //errorDiv.innerHTML = '<strong>Error:</strong> {{ session('error') }}';  concatenar mensaje de error
            //document.body.appendChild(errorDiv);    Alerta aparezca en la vista principal
        @endif
    }
</script>