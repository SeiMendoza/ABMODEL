@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Editar Combo')
@section('miga')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" 
    href="{{route('menuAdmon.index')}}">Administración de menú</a></li>
<li class="breadcrumb-item text-sm text-dark active text-white" aria-current="page">Edición de Combo</li>
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

<div class="wrapper wrapper--w960"> <!--aquí iria el wrapper-->
    <div class="card border-radius-sm border-0" style="">
        
        <div class="card-body border-radius-sm border-0">
            <h2 class="title" style="margin-bottom:0%">Editando combo: {{$Combos->nombre}} </h2>
                            <form method="post" action="{{route('combo.update', ['id'=> $Combos->id])}}" enctype="multipart/form-data">
                             @method('put')
                             @csrf
                                
                             <h4 class="font-robo t" style="margin: 0; padding:0">Datos del combo</h4>
                             <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
                                <div style="width:200px;float:left"> 
                                    <label for=""><strong>Seleccione una imagen</strong></label>
                                    <img src="@if(Session::has('imagens')){{Session::get('imagens')}}@else{{asset($Combos->imagen)}}@endif" alt="" width="240px" height="240px" id="imagenmostrada">
                                    <br>
                                    <input type="file" id="imagen" name="imagen" accept="images/*"  onkeypress="quitarerror()"
                                    value="@if(Session::has('imagens')){{Session::get('imagens')}}@endif"  >
                                    @error('imagen')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>

                                <div class="row" style="margin-left:28%" >
                                    <div class="col">
                                        <label for=""><strong>Ingrese el nombre del combo</strong></label>
                                    <input class="form-control border-radius-sm" type="text" placeholder="Nombre del combo" name="nombre" id="nombre"
                                    value="@if(Session::has('nombre')){{Session::get('nombre')}}@else{{old('nombre', $Combos->nombre)}}@endif"
                                    maxlength="25"  onkeypress="quitarerror()">
                                    @error('nombre')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                    </div>
                                </div>
                                
                                <div class="row" style="margin-left:28%" >
                                    <div class="col"><BR>
                                    <label for=""><strong>Ingrese el precio del combo</strong></label>
                                    <input class="form-control border-radius-sm" type="number" placeholder="Precio" name="precio" id="precio"
                                    value="@if(Session::has('precio')){{Session::get('precio')}}@else{{old('precio', $Combos->precio)}}@endif"
                                    onkeypress="quitarerror()"
                                    onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1" max="1000">
                                    @error('precio')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                   </div>
                                </div>

                                <div class="row" style="margin-left:28%" >
                                    <div class="col"> <BR>
                                        <label for=""><strong>Ingrese la descripción</strong></label>
                                        <textarea class="form-control border-radius-sm" type="text" placeholder="Descripción" name="descripcion" maxlength="100"
                                            onkeypress="quitarerror()" id="descripcion" style="resize:none;  height: 60px;" >
                                        @if(Session::has('descripcion')){{Session::get('descripcion')}}@else{{old('descripcion', $Combos->descripcion)}}@endif</textarea>
                                        @error('descripcion')
                                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>

                                    <div id="espacio"><br><br></div>
                                    <div style="float:right">
                                    <button type="submit" class="btn btn-success">Actualizar</button>
                                    <button type="button" onclick="cancelarAct('admonRestaurante')"
                                        class="btn btn-warning">Cancelar</button>
                                     </div>
                                </div>
                            </form>
            </div>
        </div>
     </div>
 </div>
@stop
