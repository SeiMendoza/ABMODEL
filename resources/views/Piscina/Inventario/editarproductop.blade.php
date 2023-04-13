@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Piscina-productos')
<style>
    .cont{
        overflow-x: hidden;
    }
</style>
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
    <div class="wrapper wrapper--w960 font-robo">
        <div class="card border-radius-sm border-0">
            <div class="card-body border-radius-sm border-0">
                <h2 class="title">Información de: {{$piscina->nombre}}</h2>
                <form method="post" action="{{ route('producto.update',['id' => $piscina -> id]) }}" enctype="multipart/form-data">
                    @method('put')
                    @csrf
                    <div class="row row-space">
                        <div class="col-6">
                            <div class="font-robo form-group">
                                <label for="">Nombre del producto:</label>
                                <input style="padding-left: 8px;" class="form-control border-radius-sm" placeholder="Nombre del producto" name="nombre" id="nombre" value="@if(Session::has('nombre')){{Session::get('nombre')}}@else{{old('nombre',$piscina->nombre)}}@endif" maxlength="25" onkeypress="quitarerror()">
                                @error('nombre')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="font-robo form-group">
                                <label for="">tipo de producto: </label>
                                <div style="width: 400px">
                                    <select class="form-control border-radius-sm" style="text-indent: 8px !important;" name="tipo" id="tipo">
                                        <option value="1" {{$piscina->tipo =="1" ? 'selected' :''}}>Polvo</option>
                                        <option value="2" {{$piscina->tipo =="2" ? 'selected' :''}}>Liquido</option>
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
                        <div class="col-6">
                            <div class="font-robo form-group">
                                <label for="">Ingrese el peso:</label>
                                <input style="padding-left: 8px;" class="form-control border-radius-sm" type="number" name="kilos" id="kilos" step="0.01" placeholder="Ingrese los kilogramos" value="@if(Session::has('kilos')){{Session::get('kilos')}}@else{{old('kilos',$piscina->peso)}}@endif" onkeypress="quitarerror()">
                                @error('kilos')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>
                        </div>
                        <div class="col">
                            <div class="font-robo form-group">
                                <label for="">Tipo de uso: </label>
                                <div style="width: 400px">
                                    <select class="form-control border-radius-sm" name="uso" id="uso">
                                        <option value="1" {{$piscina->uso =="1" ? 'selected' :''}}>Diario</option>
                                        <option value="2" {{$piscina->uso =="2" ? 'selected' :''}}>Semanal</option>
                                        <option value="3" {{$piscina->uso =="3" ? 'selected' :''}}>Mensual</option>
                                    </select>
                                    @error('uso')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                    <div class="select-dropdown"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div id=""><br></div>
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
    function cancelarp(ruta) {

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
                    window.location.href = '/' + ruta;
                } else {
                    // Dijeron que no
                }
            });

    }
</script>
@endsection