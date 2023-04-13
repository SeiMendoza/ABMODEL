@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Editar Combo')
@section('miga')
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
    href="{{route('menuAdmon.index')}}">Administración Restaurante</a></li>
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

<div class="page-wrapper p-t-170 p-b-100 font-robo">
    <div class="wrapper wrapper--w960">
        <div class="card card-2">
            <div class="card-body">
                        <div>
                            <h2 class="title">Editando Combo: {{$Combos->nombre}}</h2>
                            <form method="post" action="{{route('combo.update', ['id'=> $Combos->id])}}" enctype="multipart/form-data">
                                @method('put')
                                @csrf
                                <div style="width:200px;float:left"> 
                                    <label for=""><strong>Seleccione una imagen</strong></label>
                                    <img src="@if(Session::has('imagens')){{Session::get('imagens')}}@else{{asset($Combos->imagen)}}@endif" alt="" width="200px" height="250px" id="imagenmostrada">
                                    <br>
                                    <input type="file" id="imagen" name="imagen" accept="image/*"  onkeypress="quitarerror()"
                                    value="@if(Session::has('imagens')){{Session::get('imagens')}}@endif"  >
                                    @error('imagen')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <center><strong>Información del combo</strong></center> <BR>
                                <div style="margin-left:2%;float:left;width:68%">
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

                                <div style="margin-left:2%;float:left;width:68%">
                                    <label for=""><strong>Ingrese la descripción</strong></label>
                                    <textarea class="form-control" type="text" placeholder="Descripción" name="descripcion" maxlength="100"
                                    onkeypress="quitarerror()" id="descripcion" rows="3"
                                    >@if(Session::has('descripcion')){{Session::get('descripcion')}}@else{{old('descripcion', $Combos->descripcion)}}@endif</textarea>
                                    @error('descripcion')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror

                                    <BR>

                                    <div id="espacio"><br><br></div>
                                    <div style="float:right">
                                    <button type="submit" class="btn btn-success">Actualizar</button>
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
