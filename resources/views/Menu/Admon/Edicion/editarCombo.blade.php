@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Editar Combo')
@section('miga')
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
    href="{{route('menuAdmon.index')}}">Menú Admón</a></li>
    <li class="breadcrumb-item text-sm active text-dark active">
        Editando Combo
     </li>
@endsection

@section('content')

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
            background: '#0be004ab',
            timer: 3500
        })
    }
</script>
    <div class="page-wrapper bg-red p-t-170 p-b-100 font-robo">
        <div class="wrapper wrapper--w960" >
            <div class="card card-2">
                <div class="card-heading">
                    <div class="card-body">
                        <div>
                            <h2 class="title">Editando Combo: {{$Combos->nombre}}</h2>
                            <form method="post"  action="{{route('combo.update', ['id'=> $Combos->id])}}" enctype="multipart/form-data" id="principal">
                                @method('put')
                                @csrf
                                <div style="width:200px;float:left">
                                    <label for=""><strong>Seleccione una imagen</strong></label>
                                    <img src="@if(Session::has('imagens')){{Session::get('imagens')}}@else{{asset($Combos->imagen)}}@endif" alt="" width="200px" height="200px" id="imagenmostrada">
                                    <br>
                                    <input type="file" id="imagen" name="imagen" accept="image/*"  onkeypress="quitarerror()"
                                    value="@if(Session::has('imagens')){{Session::get('imagens')}}@endif"  >
                                    @error('imagen')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <center><strong>Información del combo</strong></center>
                                <div style="margin-left:2%;float:left;width:38%">
                                    <label for=""><strong>Ingrese el nombre del combo</strong></label>
                                    <input class="form-control" type="text" placeholder="Nombre del combo" name="nombre" id="nombre"
                                    value="@if(Session::has('nombre')){{Session::get('nombre')}}@else{{old('nombre', $Combos->nombre)}}@endif"
                                    maxlength="25"  onkeypress="quitarerror()">
                                    @error('nombre')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror

                                    <label for=""><strong>Ingrese el precio del combo</strong></label>
                                    <input class="form-control" type="number" placeholder="Precio" name="precio" id="precio"
                                    value="@if(Session::has('precio')){{Session::get('precio')}}@else{{old('precio', $Combos->precio)}}@endif"
                                    onkeypress="quitarerror()"
                                    onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1" max="1000">
                                    @error('precio')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div style="margin-left:2%;float:right;width:38%">
                                    <label for=""><strong>Ingrese la descripción</strong></label>
                                    <textarea class="form-control" type="text" placeholder="Descripción" name="descripcion" maxlength="100"
                                    onkeypress="quitarerror()" id="descripcion" rows="5"
                                    >@if(Session::has('descripcion')){{Session::get('descripcion')}}@else{{old('descripcion', $Combos->descripcion)}}@endif</textarea>
                                    @error('descripcion')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </form>

                            <div style="margin-top: 10px; float: left;margin-left: 2%; width: calc(100% - 230px);">
                                <center><strong>Agregar producto a combo</strong></center>
                                <form method="post" id="formtemporal" action="{{route('combo.ediciontemporal', ['id'=> $Combos->id])}}">
                                    
                                    @csrf
                                    <div class="modal-body">
                            
                                    <div style="display:none">
                                    <input type="text" name="imagen2" id="imagen2" readonly>
                                        <input type="text" name="nombre2" id="nombre2" readonly>
                                        <input type="text" name="descripcion2" id="descripcion2" readonly>
                                        <input type="text" name="precio2" id="precio2" readonly>
                                    </div>
                            
                                    <div style="float: left;width: 55%">
                                        <select name="complemento" onchange="quitarerror()" id="complemento" class="form-control">
                                            <option disabled="disabled" selected="selected" value="">Selecciona la comida o bebida</option>
                                            @foreach($complementos as $c)
                                                <option value="{{$c->id}}">{{$c->nombre}} {{$c->tamanio}}</option>
                                            @endforeach
                                        </select>
                                        @error('complemento')
                                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                                        @enderror
                                    </div>
                            
                                    <div style="float: left;width: 30%">
                                        <input class="form-control" type="number" placeholder="Cantidad" name="cantidad" id="cantidad" 
                                        value="{{old('cantidad')}}" style="width:92%;margin-left:4%" onkeypress="quitarerror()"
                                        onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1" max="1000">
                                        @error('cantidad')
                                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                                        @enderror
                                    </div>
                            
                                    <div style="float: left;width: 10%;margin-left: 5%">
                                        <button type="submit" class="btn btn-primary" onclick="rellenar()" style="float: right;">
                                            Agregar
                                        </button>
                                    </div>
                                </form>
                            </div>
                        </div>
                        <div>
                            <table class="table align-items-center mb-0">
                                <thead>
                                    <th>N°</th>
                                    <th>Producto</th>
                                    <th>Tamaño</th>
                                    <th>Cantidad</th>
                                    <th>Eliminar</th>
                                </thead>
                                <tbody>
                                    @forelse($componentes as $m=> $compo)
                                    <tr>
                                    <td>{{++$m}}</td>
                                    <td>{{$compo->componente->nombre}}</td>
                                    <td>{{$compo->componente->tamanio}}</td>
                                    <td>{{$compo->cantidad}}</td>
                                    <td>
                                        <form action="{{route('combo.destruir',['id'=>$compo->id])}}" method="post" id="elim{{$compo->id}}">
                                            
                                            @csrf
                                            <div style="display:none">
                                                <input type="text" name="nombre3" id="nombre3" readonly>
                                                <input type="text" name="descripcion3" id="descripcion3" readonly>
                                                <input type="text" name="precio3" id="precio3" readonly>
                                            </div>

                                            <button type="button" class="btn btn-danger" onclick="">
                                                X
                                            </button>

                                            <script>
                                                function eliminarproducto(name){                                                    
                                                    Swal.fire({
                                                        title: "¿Eliminar {{$compo->componente->nombre}}?",
                                                        text: "¿Desea eliminar el producto seleccionado?",
                                                        icon: 'question',
                                                        showCancelButton: true,
                                                        confirmButtonText: "Si",
                                                        cancelButtonText: "No",
                                                    }).then(resultado => {
                                                        if (resultado.value) {
                                                            // Hicieron click en "Sí"
                                                            document.getElementById(name).submit();
                                                        } else {
                                                            // Dijeron que no
                                                        }
                                                    });
                                                }
                                            </script>

                                        </form>
                                    </td>
                                    </tr>
                                    @empty
                                        <tr>
                                        <td colspan="4">No hay datos</td>
                                        </tr>
                                    @endforelse
                                </tbody>
                            </table>

                            <script>
                                function enviar(){
                                    document.getElementById('principal').submit();
                                }
                            </script>
            
                            <div style="float:right">
                                <button type="button" onclick="enviar()" class="btn btn-success">Guardar</button>
                                <button type="button" onclick="cancelar('admonRestaurante')" class="btn btn-warning">Cancelar</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@stop
