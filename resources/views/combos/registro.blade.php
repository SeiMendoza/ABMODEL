@extends('00_plantillas_blade.plantilla_General1')
@section('contend')

<script>
    var msg = '{{Session::get('mensaje')}}';
    var exist = '{{Session::has('mensaje')}}';
    if(exist){
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: msg,
            showConfirmButton: false,
            toast: true,
            background: '#1c8b57',
            timer: 3500
        })
    }
</script>
    <div class="page-wrapper bg-red p-t-170 p-b-100 font-robo">
        <br><br>
        <div class="wrapper wrapper--w960" >
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Registro de Combos</h2>
                    <form method="post"  action="" enctype="multipart/form-data">
                        @csrf

                        <div style="width:200px;float:left">
                            <img src="" alt="" width="200px" height="200px" id="imagenmostrada">
                            <br>
                            <input type="file" id="imagen" name="imagen" accept="image/*" required onkeypress="quitarerror()"
                            value="{{old('imagenPrevisualizacion')}}" style="color: white;width: 200px;" >
                            @error('imagen')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div style="margin-left:2%;float:left;width:72%">
                            <input class="input--style-2" type="text" placeholder="Nombre del combo" name="nombre" value="{{old('nombre')}}"
                            maxlength="25" required onkeypress="quitarerror()">
                            @error('nombre')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
<br><br>
                        <div style="margin-left:2%;float:left;width:35%">
                            <textarea class="textarea--style-2" type="text" placeholder="Descripción" name="descripcion" maxlength="100"
                            value="{{old('descripcion')}}" required onkeypress="quitarerror()"></textarea>
                            @error('descripcion')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div style="margin-left:2%;float:left;width:35%">

                            <input class="input--style-2" type="number" placeholder="Precio" name="precio"
                            value="{{old('precio')}}" onkeypress="quitarerror()"
                            required onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1" max="1000">
                            @error('precio')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror

                            <br>
                        </div>

                        <div style="margin-left:2%;float:left;width:72%">
                        <!-- Button trigger modal -->
                        <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#agregarproducto">
                        Agregar
                        </button>
                        <table class="table align-items-center mb-0">
                                <thead>
                                    <th>N°</th>
                                    <th>Producto</th>
                                    <th>Tamaño</th>
                                    <th>Cantidad</th>
                                </thead>
                                <tbody>
                                    @forelse($componentes as $m=> $compo)
                                    <tr>
                                    <td>{{++$m}}</td>
                                    <td>{{$compo->componente->nombre}}</td>
                                    <td>{{$compo->componente->tamanio}}</td>
                                    <td>{{$compo->cantidad}}</td>
                                    </tr>
                                    @empty
                                        <tr>
                                        <td colspan="4">No hay datos</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <div style="float:right">
                                <button type="submit" class="btn btn-success">Guardar</button>
                                <a type="button" href="/" class="btn btn-warning">Regresar</a>
                            </div>
                        </div>

                    </form>

<!-- Modal -->
<div class="modal fade" id="agregarproducto" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="staticBackdropLabel">Agregar Bebida o Comida</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form method="post" action="{{route('combo.temporal')}}">
        @csrf
        <div class="modal-body">

            <select name="complemento" onchange="quitarerror()" required>
                <option disabled="disabled" selected="selected" value="">Selecciona la comida o bebida</option>
                @foreach($complementos as $c)
                    <option value="{{$c->id}}">{{$c->nombre}} {{$c->tamanio}}</option>
                @endforeach
            </select>
            <div class="select-dropdown"></div>
        </div>
        @error('complemento')
            <strong class="menerr" style="color:red">{{ $message }}</strong>
        @enderror

        <input class="input--style-2" type="number" placeholder="Cantidad" name="cantidad" required
        value="{{old('cantidad')}}" style="width:92%;margin-left:4%" onkeypress="quitarerror()"
        onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1" max="1000">
        @error('cantidad')
            <strong class="menerr" style="color:red">{{ $message }}</strong>
        @enderror

        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
            <button type="submit" class="btn btn-primary">Guardar</button>
        </div>
      </from>
    </div>
  </div>
</div>
                </div>
            </div>
        </div>
    </div>
@stop
