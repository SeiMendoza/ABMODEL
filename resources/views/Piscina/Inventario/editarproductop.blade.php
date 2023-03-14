@extends('00_plantillas_Blade.plantilla_General1')
@section('title', 'Edición')

@section('contend')

    <div class="page-wrapper bg-primary p-t-170 p-b-100 font-robo">
        <br><br>
        <div class="wrapper wrapper--w960">
            <div class="card">
                <div class="card-body">
                    <h2 style="text-align:center">Editar {{$piscina->nombre}}</h2>
<br>
                    <form method="post" action="{{ route('producto.update',['id' => $piscina -> id]) }}" enctype="multipart/form-data">
                    @method('put')
                        @csrf
                        <div style="margin-left:2%;float:left;width:47%">
                            <input class="input--style-2" type="text" placeholder="Nombre del producto" name="nombre" id="nombre"
                            value="@if(Session::has('nombre')){{Session::get('nombre')}}@else{{old('nombre',$piscina->nombre)}}@endif"
                            maxlength="25"  onkeypress="quitarerror()">
                            @error('nombre')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div style="margin-left:2%;float:left;width:47%;margin-top: 15px">
                            <select name="tipo" onchange="quitarerror()" id="tipo">
                            <option value="1"{{$piscina->tipo =="1" ? 'selected' :''}}>Polvo</option>
                            <option value="2"{{$piscina->tipo =="2" ? 'selected' :''}}>Liquido</option>  
                            </select>
                            @error('tipo')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div style="margin-left:2%;float:left;width:47%;margin-top: 30px">
                            <input class="input--style-2" type="text" name="expiracion" id="expiracion"
                            value="@if(Session::has('expiracion')){{Session::get('expiracion')}}@else{{old('expiracion',$piscina->fecha_expiracion)}}@endif"
                            onkeypress="quitarerror()" placeholder="Tiempo de expiracion">
                            @error('expiracion')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div style="margin-left:2%;float:left;width:47%;margin-top: 45px">
                            <select name="uso" onchange="quitarerror()" id="uso">
                                    <option value="1"{{$piscina->uso =="1" ? 'selected' :''}}>diario</option>
                                    <option value="2"{{$piscina->uso =="2" ? 'selected' :''}}>semanal</option>
                                    <option value="3"{{$piscina->uso =="3" ? 'selected' :''}}>mensual</option>
                            </select>
                            @error('uso')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
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
