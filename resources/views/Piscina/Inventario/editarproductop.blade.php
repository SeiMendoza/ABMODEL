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
<br>
<div class="page-wrapper font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card-2 border-radius-sm">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Datos de: {{$piscina->nombre}}</h2>
            <form method="post" action="{{ route('producto.update',['id' => $piscina -> id]) }}" enctype="multipart/form-data">
                    @method('put')
                        @csrf  
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="font-robo input-group">
                                    <label for="birthday">Nombre del producto:</label>
                                    <input style="padding-left: 8px;" class="input--style-2"  placeholder="Nombre del producto" name="nombre" id="nombre"
                            value="@if(Session::has('nombre')){{Session::get('nombre')}}@else{{old('nombre',$piscina->nombre)}}@endif"
                            maxlength="25"  onkeypress="quitarerror()">
                            @error('nombre')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="font-robo input-group">
                                    <label for="gender">tipo de producto: </label>
                                    <div class="rs-select2 js-select-simple select--no-search" style="width: 250px">
                                        <select style="text-indent: 8px !important;" name="tipo" id="tipo">
                            <option value="1"{{$piscina->tipo =="1" ? 'selected' :''}}>Polvo</option>
                            <option value="2"{{$piscina->tipo =="2" ? 'selected' :''}}>Liquido</option> 
                                        </select>
                                        @error('tipo')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-2">
                                <div class="font-robo input-group">
                                    <label for="birthday">Ingrese el peso:</label>
                                    <input style="padding-left: 8px;"  class="input--style-2"  type="number" name="kilos" id="kilos"
                                step="0.01" min="1" max="100" placeholder="Ingrese los kilogramos"
                                value="@if(Session::has('kilos')){{Session::get('kilos')}}@else{{old('kilos',$piscina->peso)}}@endif"
                                onkeypress="quitarerror()"> 
                                @error('kilos')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                                </div>
                            </div>
                            <div class="col-2">
                                <div class="font-robo input-group">
                                    <label for="gender">Tipo de uso: </label>
                                    <div class="rs-select2 js-select-simple select--no-search" style="width: 250px">
                                        <select name="uso" id="uso" > 
                                            <option value="1"{{$piscina->uso =="1" ? 'selected' :''}}>diario</option>
                                    <option value="2"{{$piscina->uso =="2" ? 'selected' :''}}>semanal</option>
                                    <option value="3"{{$piscina->uso =="3" ? 'selected' :''}}>mensual</option>
                                        </select>
                                        @error('uso')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                                        <div class="select-dropdown"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div id="" ><br></div>
                    <div style="text-align:center">
                        <button onclick="" type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" onclick="cancelarp('productos')" class="btn btn-danger">Cancelar</button>
                    </div>
                    </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script>
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
