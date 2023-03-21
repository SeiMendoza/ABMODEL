@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Edición')
@section('miga')
<li class="breadcrumb-item text-sm text-dark active" aria-current="page">
<a class="text-dark" href="{{route('prodpiscina.index')}}" onclick="cambia">lista de productos</a></li>
@endsection
@section('content')

<div style="margin-left:25px; margin-top:15px; display:block; float:left;
        color: #333333;font-family: Georgia, Serif;" class="nav-link-icon">
    <h3>Productos de piscina</h3>
</div>

<div class="container" style="position: relative;">
    <div class="row d-flex justify-content-center" >
        <div class="card col-lg-10" style="background: rgb(179, 221, 226);position: absolute;
  left: 8%;margin-top:10%">
    <BR>
<form method="post" action="{{ route('producto.update',['id' => $piscina -> id]) }}" enctype="multipart/form-data">
                    @method('put')
                        @csrf   
                        <div class="container ">
                        <div class="row">
                        <div class="form-group col-md-6 ">
                        <label for="" style="color:teal;font-size: 20px;"><strong>Ingrese el nombre del producto:</strong></label>
                            <input class="form-control" type="text" placeholder="Nombre del producto" name="nombre" id="nombre"
                            value="@if(Session::has('nombre')){{Session::get('nombre')}}@else{{old('nombre',$piscina->nombre)}}@endif"
                            maxlength="25"  onkeypress="quitarerror()">
                            @error('nombre')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group col-md-6">
                        <label for="" style="color:teal;font-size: 20px;"><strong>Seleccione el tipo de producto:</strong></label>
                            <select class="form-control" name="tipo" onchange="quitarerror()" id="tipo">
                            <option value="1"{{$piscina->tipo =="1" ? 'selected' :''}}>Polvo</option>
                            <option value="2"{{$piscina->tipo =="2" ? 'selected' :''}}>Liquido</option>  
                            </select>
                            @error('tipo')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                        </div>
                        
                    <div class="row ">
                        <div class="form-group col-md-6">
                        <label for="" style="color:teal;font-size: 20px;"><strong>Ingrese la fecha de expiracion:</strong></label>
                            <input class="form-control" type="text" name="expiracion" id="expiracion"
                            value="@if(Session::has('expiracion')){{Session::get('expiracion')}}@else{{old('expiracion',$piscina->fecha_expiracion)}}@endif"
                            onkeypress="quitarerror()" placeholder="Tiempo de expiracion">
                            @error('expiracion')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                        <label for="" style="color:teal;font-size: 20px;"><strong>Seleccione el tiempo de uso:</strong></label>
                            <select class="form-control" name="uso" onchange="quitarerror()" id="uso">
                                    <option value="1"{{$piscina->uso =="1" ? 'selected' :''}}>diario</option>
                                    <option value="2"{{$piscina->uso =="2" ? 'selected' :''}}>semanal</option>
                                    <option value="3"{{$piscina->uso =="3" ? 'selected' :''}}>mensual</option>
                            </select>
                            @error('uso')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>
                        <div style="float: right;margin-top: 50px">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <button type="button" onclick="cancelarp('productos')"
                                class="btn btn-warning">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    
    <script>
        window.addEventListener('load',function(){
            document.getElementById('expiracion').type= 'text';
            document.getElementById('expiracion').addEventListener('blur',function(){
                if (document.getElementById('expiracion').value == '') {
                    document.getElementById('expiracion').type= 'text';
                }
            });
            document.getElementById('expiracion').addEventListener('focus',function(){
                document.getElementById('expiracion').type= 'date';
            });
        });


        //funcion para el alerta para regresar
function cancelarp(ruta){

Swal
.fire({
    title: "¿Cancelar actualización?",
    text: "¿Desea cancelar los cambios?",
    icon: 'warning',
    showCancelButton: true,
    confirmButtonText: "Si",
    cancelButtonText: "No",
})
.then(resultado => {
    if (resultado.value) {
        // Hicieron click en "Sí"
        window.location.href = '/'+ruta;
    } else {
        // Dijeron que no
    }
});

}
    </script>
 
@endsection
