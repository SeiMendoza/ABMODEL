@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Piscina-productos')

@section('miga')
    <li class="breadcrumb-item text-sm">
        <a class="opacity-5 text-dark" href="{{route('prodpiscina.index')}}">Productos Piscina</a>
    </li>
    <li class="breadcrumb-item text-sm active text-dark active">
    <a class="opacity-5 text-dark" href="{{route('piscina.store')}}">Nuevo producto</a>
    </li>
@endsection

@section('content')
<br><br>
        <div class="wrapper wrapper--w960">
            <div class="card">
                <div class="card-body">
                    <h2 class="">{{$piscina->nombre}}</h2>
<br>
<form method="post" action="{{ route('producto.update',['id' => $piscina -> id]) }}" enctype="multipart/form-data">
                    @method('put')
                        @csrf   
                        <div class="container ">
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label for=""><strong>Ingrese el nombre del producto</strong></label>
                            <input class="form-control" type="text" placeholder="Nombre del producto" name="nombre" id="nombre"
                            value="@if(Session::has('nombre')){{Session::get('nombre')}}@else{{old('nombre',$piscina->nombre)}}@endif"
                            maxlength="25"  onkeypress="quitarerror()">
                            @error('nombre')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for=""><strong>Seleccione el tipo de producto</strong></label>
                            <select name="tipo" onchange="quitarerror()" id="tipo" class="form-control">
                            <option value="1"{{$piscina->tipo =="1" ? 'selected' :''}}>Polvo</option>
                            <option value="2"{{$piscina->tipo =="2" ? 'selected' :''}}>Liquido</option> 
                            </select>
                            @error('tipo')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        @php
                            $fecha_actual = date("Y-m-d");
                            $minima = date('Y-m-d',strtotime($fecha_actual."+ 1 month"));
                            $minima = date('Y-m-d',strtotime($minima."+ 1 day"));
                            $maxima = date('Y-m-d',strtotime($fecha_actual."+ 10 year"));
                        @endphp     
                        </div>  
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label for=""><strong>Ingrese la fecha de expiracion</strong></label>
                            <input class="form-control" type="date" name="expiracion" id="expiracion"
                            value="@if(Session::has('expiracion')){{Session::get('expiracion')}}@else{{old('expiracion',$piscina->fecha_expiracion)}}@endif"
                            onkeypress="quitarerror()" placeholder="Tiempo de expiracion">
                            @error('expiracion')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for=""><strong>Seleccione el periodo de uso</strong></label>
                            <select name="uso" onchange="quitarerror()" id="uso" class="form-control">
                            <option value="1"{{$piscina->uso =="1" ? 'selected' :''}}>diario</option>
                                    <option value="2"{{$piscina->uso =="2" ? 'selected' :''}}>semanal</option>
                                    <option value="3"{{$piscina->uso =="3" ? 'selected' :''}}>mensual</option>
                            
                            </select>
                            @error('uso')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                        </div>  
                        <div class="row">
                        <div class="form-group col-md-6">
                            <label for=""><strong>Ingrese el peso en kilogramos</strong></label>
                            <div class="input-group mb-3">
                                <input class="form-control" type="number" name="kilos" id="kilos"
                                step="0.01" min="1" max="100" placeholder="Ingrese los kilogramos"
                                value="@if(Session::has('kilos')){{Session::get('kilos')}}@else{{old('kilos',$piscina->peso)}}@endif"
                                onkeypress="quitarerror()">
                                <div class="input-group-prepend">
                                    <span class="input-group-text">kilogramos</span>
                                </div>
                            </div>
                            @error('kilos')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>  
                        <div class="form-group col-md-6">
                            <div style="float: right;margin-top: 35px"> 
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <button type="button" onclick="cancelarp('productos')"
                                class="btn btn-warning">Cancelar</button>
                                </div>
                            </div>
                    </form>
                </div>
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
                document.getElementById('expiracion').max= '{{$maxima}}';
                document.getElementById('expiracion').min= '{{$minima}}';
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
