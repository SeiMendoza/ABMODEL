@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Combo Nuevo')
@section('miga')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="{{route('menuAdmon.index')}}">Administración de menú</a></li>
<li class="breadcrumb-item text-sm text-dark active text-white" aria-current="page">Registro de complemento</li>
@endsection
@section('tit','Registro de complemento')
@section('b')
<div>
    <a href="{{route('menuAdmon.index')}}" style="margin:0; padding:5px; width:160px;" type="button" class="bg-light border-radius-sm text-center ">
        <i class="fa fa-arrow-left"></i>  Regresar
    </a>
</div>
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

    <div class=""> <!--aquí iría el wrapper-->
        <div class="card border-radius-sm border-0" style="">
            <div class="card-body border-radius-sm border-0">
                <h4 class="font-robo t" style="margin: 0; padding:0">Datos del producto</h4>
                <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">

                <div class="row">

                    <div class="col">
                        <form method="post"  action="" enctype="multipart/form-data" id="principal">
                            @csrf
                            <div class="row">
                                <div class="col">
                                    <label class="row" for=""><strong>Seleccione una imagen</strong></label>
                                    <img class="row m-1" src="@if(Session::has('imagens')){{Session::get('imagens')}}@endif" alt="" width="240px" height="240px" id="imagenmostrada">
                                    <input class="row m-1" type="file" id="imagen" name="imagen" accept="image/*"  onkeypress="quitarerror()"
                                    value="@if(Session::has('imagens')){{Session::get('imagens')}}@endif"  >
                                    @error('imagen')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>            
        
                                <div class="col">
                                    <label><strong>Ingrese el nombre del combo</strong></label>
                                    <input class="form-control border-radius-sm" type="text" placeholder="Nombre del combo" name="nombre" id="nombre" value="@if(Session::has('nombre')){{Session::get('nombre')}}@else{{old('nombre')}}@endif" maxlength="25"  onkeypress="quitarerror()">
                                    @error('nombre')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror <br>
                                    
                                    <label for=""><strong>Ingrese el precio del combo</strong></label>
                                    <input class="form-control border-radius-sm" type="number" placeholder="Precio" name="precio" id="precio" value="@if(Session::has('precio')){{Session::get('precio')}}@else{{old('precio')}}@endif" onkeypress="quitarerror()" onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1" max="1000">
                                    @error('precio')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror <br>

                                    <label for=""><strong>Ingrese la descripción</strong></label>
                                    <textarea class="form-control border-radius-sm" type="text" placeholder="Descripción" name="descripcion" maxlength="100"
                                    onkeypress="quitarerror()" id="descripcion" rows="3">
                                    @if(Session::has('descripcion')){{Session::get('descripcion')}}@else{{old('descripcion')}}@endif</textarea>
                                    @error('descripcion')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            
                        </form>
                    </div>

                    <div class="col">
                        <div class="row m-1">
                            <h4 class="font-robo t m-1" style="text-align: center">Agregar producto a combo</h4>
                            
                        </div>  

                        <form class="row" method="post" id="formtemporal" action="{{route('combo.temporal')}}">
                            @csrf
                            <div style="display:none">
                                <input type="text" name="imagen2" id="imagen2" readonly>
                                <input type="text" name="nombre2" id="nombre2" readonly>
                                <input type="text" name="descripcion2" id="descripcion2" readonly>
                                <input type="text" name="precio2" id="precio2" readonly>
                            </div>
                            
                            <div class="col-6">
                                <select name="complemento" onchange="quitarerror()" id="complemento" class="form-control border-radius-sm">
                                <option disabled="disabled" selected="selected" value="">Selecciona la comida o bebida</option>
                                @foreach($complementos as $c)
                                <option value="{{$c->id}}">{{$c->nombre}} {{$c->tamanio}}</option>
                                @endforeach
                                </select>
                                @error('complemento')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="col-3">
                                <input class="col form-control border-radius-sm" type="number" placeholder="Cantidad" name="cantidad" id="cantidad" value="{{old('cantidad')}}" style="width:92%;margin-left:4%" onkeypress="quitarerror()" onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1" max="1000">
                                @error('cantidad')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>

                            <div class="col-3" style="text-align: end">
                                <button class="btn btn-warning" type="submit" onclick="rellenar()">
                                    Agregar
                                </button>
                            </div>
                        </form>

                        <div class="row m-1">
                            
                            <table class="table">
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
                                        <td style="text-align: center">
                                            <form action="{{route('combo.destroy',['id'=>$compo->id])}}" method="post" id="elim{{$compo->id}}">
                                                @csrf
                                                <div style="display:none">
                                                    <input type="text" name="nombre3" id="nombre3" readonly>
                                                    <input type="text" name="descripcion3" id="descripcion3" readonly>
                                                    <input type="text" name="precio3" id="precio3" readonly>
                                                </div>

                                                <button type="button" class="btn btn-danger" onclick="rellenar2();eliminarproducto('elim{{$compo->id}}');">
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
                            
                        </div>

                    </div>

                </div>


            </div>
        </div>
    </div>




    <div class="page-wrapper  p-t-170 p-b-100 font-robo">
        <br><br>
        <div class="wrapper wrapper--w960" >
            <div class="card card-2">
                <div class="">
                    <div class="card-body">
                        <div>
                            <h2 class="title">Registro de Combos</h2>
                            <form method="post"  action="" enctype="multipart/form-data" id="principal">
                                @csrf
                                <div style="width:200px;float:left">
                                    <label for=""><strong>Seleccione una imagen</strong></label>
                                    <img src="@if(Session::has('imagens')){{Session::get('imagens')}}@endif" alt="" width="200px" height="200px" id="imagenmostrada">
                                    <br>
                                    <input type="file" id="imagen" name="imagen" accept="image/*"  onkeypress="quitarerror()"
                                    value="@if(Session::has('imagens')){{Session::get('imagens')}}@endif"  >
                                    @error('imagen')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <center><strong>Informacion del combo</strong></center>
                                <div style="margin-left:2%;float:left;width:38%">
                                    <label for=""><strong>Ingrese el nombre del combo</strong></label>
                                    <input class="form-control border-radius-sm" type="text" placeholder="Nombre del combo" name="nombre" id="nombre"
                                    value="@if(Session::has('nombre')){{Session::get('nombre')}}@else{{old('nombre')}}@endif"
                                    maxlength="25"  onkeypress="quitarerror()">
                                    @error('nombre')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror

                                    <label for=""><strong>Ingrese el precio del combo</strong></label>
                                    <input class="form-control border-radius-sm" type="number" placeholder="Precio" name="precio" id="precio"
                                    value="@if(Session::has('precio')){{Session::get('precio')}}@else{{old('precio')}}@endif"
                                    onkeypress="quitarerror()"
                                    onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1" max="1000">
                                    @error('precio')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div style="margin-left:2%;float:right;width:38%">
                                    <label for=""><strong>Ingrese la descripción</strong></label>
                                    <textarea class="form-control border-radius-sm" type="text" placeholder="Descripción" name="descripcion" maxlength="100"
                                    onkeypress="quitarerror()" id="descripcion" rows="5"
                                    >@if(Session::has('descripcion')){{Session::get('descripcion')}}@else{{old('descripcion')}}@endif</textarea>
                                    @error('descripcion')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </form>

                            <div style="margin-top: 10px; float: left;margin-left: 2%; width: calc(100% - 230px);">
                                <center><strong>Agregar producto a combo</strong></center>
                                <form method="post" id="formtemporal" action="{{route('combo.temporal')}}">
                                    @csrf
                                    <div class="modal-body">
                            
                                    <div style="display:none">
                                    <input type="text" name="imagen2" id="imagen2" readonly>
                                        <input type="text" name="nombre2" id="nombre2" readonly>
                                        <input type="text" name="descripcion2" id="descripcion2" readonly>
                                        <input type="text" name="precio2" id="precio2" readonly>
                                    </div>
                            
                                    <div style="float: left;width: 55%">
                                        <select name="complemento" onchange="quitarerror()" id="complemento" class="form-control border-radius-sm">
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
                                        <input class="form-control border-radius-sm" type="number" placeholder="Cantidad" name="cantidad" id="cantidad" 
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
                                        <form action="{{route('combo.destroy',['id'=>$compo->id])}}" method="post" id="elim{{$compo->id}}">
                                            @csrf
                                            <div style="display:none">
                                                <input type="text" name="nombre3" id="nombre3" readonly>
                                                <input type="text" name="descripcion3" id="descripcion3" readonly>
                                                <input type="text" name="precio3" id="precio3" readonly>
                                            </div>

                                            <button type="button" class="btn btn-danger" onclick="rellenar2();eliminarproducto('elim{{$compo->id}}');">
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
