@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Registro del local')
@section('miga')
<li class="breadcrumb-item text-sm" aria-current="page">  
    <a class="opacity-5 text-white" href="{{route('cliente.reservaLocal')}}">Reservaciones del Local</a></li>
<li class="breadcrumb-item text-sm text-white active m-0" aria-current="page">Registro</li>
@endsection
@section('tit', 'Nueva Reservación del Local')
@section('b')
<div>
    <a  href="{{route('cliente.reservaLocal')}}"style="margin:0; padding:5px; width:160px;" type="button" class="bg-light border-radius-sm text-center ">
        <i class="fa fa-arrow-left"></i>  Regresar
    </a>
</div>
@endsection

@section('content')
<script type="text/javascript">
    function calcular(){
      try{
         var a = parseFloat(document.getElementById("Total").value) || 0,
             b = parseFloat(document.getElementById("Anticipo").value) || 0;

             document.getElementById("Pendiente").value = a - b;
        }catch (e) {}
    }
</script>

<div class="wrapper wrapper--w960" >
    <div class="card">
        <div class="card-body">
            
    <form method="post" action="{{ route('ReserLocal.store') }}" enctype="multipart/form-data">
            @csrf
            <h4 class="font-robo t" style="margin: 0; padding:0">Datos del cliente: </h4>
                <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
               
                    <div class="row row-spacer" >
                        <div class="form-group col-md-4 "  >
                            <label for="NombreCliente" style="margin-left: 0;" >Nombre:</label> 
                                <input name="Nombre_Cliente" type="text" class=" form-control border-radius-sm " id="Nombre_Cliente" maxlength="25"
                                        required placeholder="Ingrese el nombre" value="{{ old('Nombre_Cliente') }}" onkeypress="return funcionConvLetrasMay(event);">
                                 @error('Nombre_Cliente')
                                       <strong class="menerr" style="color:red">{{ $message }}</strong>
                                 @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="Apellido_Cliente" style="margin-left: 0;">Apellido:</label>
                            <input name="Apellido_Cliente" type="text" class="form-control border-radius-sm" id="ApellidoCliente" maxlength="25"
                              required placeholder="Ingrese el apellido" value="{{ old('Apellido_Cliente') }}" onkeypress="return funcionConvLetrasMay(event);">
                            @error('Apellido_Cliente')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="contacto" style="margin-left: 0;">Celular:</label>
                           <input name="Contacto" type="number" class="form-control border-radius-sm" id="Contacto"
                               required placeholder="Ingrese número de celular" value="{{ old('Contacto') }}"  maxlength="8" minlength="8">
                             @error('Contacto')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                             @enderror
                         </div>
                    </div>

                    <h4 class="font-robo t" style="margin: 0; padding:0">Datos de la reservación: </h4>
                    <hr class="m-1" style="border: 0.1px solid rgba(111, 143, 175, 0.600)">

                    <div class="row row-spacer">
                         <div class="form-group col-md-4 ">
                            <label for="Tipo_Reservacion" style="margin-left: 0;" >Tipo de Reservación:</label>
                            <select name="Tipo_Reservacion" required onchange="quitarerror()" class="form-control border-radius-sm ">
                                    @if (old('Tipo_Reservacion'))
                                        @if (old('Tipo_Reservacion') === 'De Día')
                                            <option style="display: none" selected="selected" value="De Día">De Día</option>
                                        @else
                                            @if (old('Tipo_Reservacion') === 'De Noche')
                                                <option style="display: none" selected="selected" value="De Noche">De Noche</option>
                                            @else
                                            @endif
                                        @endif
                                    @else
                                        <option disabled="disabled" selected="selected" value="">-- Seleccione Uno --</option>
                                    @endif
                                    <option value="De Día">De Día</option>
                                    <option value="De Noche">De Noche</option>
                                </select>
                            @error('Tipo_Reservacion')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                             @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="Tipo_Evento" style="margin-left: 0;">Evento:</label>
                            <input name="Tipo_Evento" type="text" class="form-control border-radius-sm" id="Tipo_Evento"
                               required placeholder="Ingrese el tipo de evento " value="{{ old('Tipo_Evento') }}"  >
                             @error('Tipo_Evento')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                             @enderror
                        </div>

                        <div class="form-group col-md-4 ">
                            <label for="cantidad"style="margin-left: 0;" >Cantidad de Personas:</label>
                            <input name="Cantidad" type="number" class="form-control border-radius-sm" id="Cantidad"  
                                required placeholder="Cantidad de personas a asistir" value="{{ old('Cantidad') }}" maxlength="8" minlength="8" >
                              @error('Cantidad')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                              @enderror
                        </div>
                    </div>

                    <div class="row row-spacer">
                        <div class="form-group col-md-4">
                            <label for="Fecha" style="margin-left: 0;">Fecha del Evento:</label>
                            <input name="Fecha" type="date"  class="form-control border-radius-sm " id="Fecha" style="height: 40px"
                                required placeholder="" value="{{ old('Fecha') }}">
                            @error('Fecha')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group col-md-4 ">
                            <label for="HoraEntrada" style="margin-left: 0;" >Hora de Llegada:</label>
                            <input name="HoraEntrada" type="time"  class="form-control border-radius-sm" id="HoraEntrada" 
                                placeholder="Ingrese la hora de llegada" value="{{ old('HoraEntrada')}}" required>
                            @error('HoraEntrada')
                                   <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group col-md-4 ">
                            <label for="HoraSalida" style="margin-left: 0;">Hora de Salida:</label>
                            <input name="HoraSalida" type="time"  class="form-control border-radius-sm" id="HoraSalida" min="08:00" max="00:00"
                                placeholder="Ingrese la hora de salida" value="{{ old('HoraSalida')}}" required>
                            @error('HoraSalida')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <h4 class="font-robo t" style="margin: 0; padding:0">Costo de la reservación: </h4>
                    <hr class="m-1" style="border: 0.1px solid rgba(111, 143, 175, 0.600)">

                    <div class="row row-spacer">
                        <div class="form-group col-md-6 ">
                            <label for="FormaPago" style="margin-left: 0;">Forma de Pago:</label>
                            <select name="FormaPago" required onchange="quitarerror()"  class="form-control border-radius-sm">
                                @if (old('FormaPago'))
                                    @if (old('FormaPago') === 'Efectivo')
                                        <option style="display: none" selected="selected" value="Efectivo">Efectivo</option>
                                    @else
                                        @if (old('FormaPago') === 'Transferencia')
                                            <option style="display: none" selected="selected" value="Transferencia">Transferencia</option>
                                        @else
                                        @endif
                                    @endif
                                @else
                                    <option disabled="disabled" selected="selected" value="">-- Seleccione Uno --</option>
                                @endif
                                <option value="Efectivo">Efectivo</option>
                                <option value="Transferencia">Transferencia</option>
                            </select>
                            @error('FormaPago')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                             @enderror
                        </div>

                          <div class="form-group col-md-6 ">
                            <label for="total" style="margin-left: 0;">Costo de la Reservación:</label>
                           <input name="Total" type="number" class="form-control border-radius-sm" id="Total" step="0.001" oninput="calcular()"
                                placeholder="Ingrese el total a pagar" value="{{ old('Total')}}" required>
                             @error('Total')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                             @enderror
                        </div>
                    </div>

                    <div class="row row-spacer">
                        <div class="form-group col-md-6 " style="margin-bottom: 5px">
                            <label for="Anticipo" style="margin-left: 0;">Pago Anticipado:</label>
                            <input name="Anticipo" type="number"  class="form-control border-radius-sm" id="Anticipo" step="0.001" oninput="calcular()"
                                placeholder="Ingrese el saldo a cancelar" value="{{ old('Anticipo')}}" required>
                            @error('Anticipo')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group col-md-6 " style="margin-bottom: 5px">
                            <label for="Pendiente" style="margin-left: 0;" >Saldo Pendiente:</label>
                            <input name="Pendiente" type="number"  class="form-control border-radius-sm" step="0.001" id="Pendiente" 
                                placeholder="Saldo pendiente" value="{{ old('Pendiente')}}" required>
                            @error('Pendiente')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    <div>
                    <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600); margin-top: px"> </div>

                    <div class="d-flex justify-content-end" style="margin: 5px 23px 0 0">
                          <button style=" margin-right:5px" type="button" onclick="cancelar('Reser/Local')" class="btn btn-danger">Cancelar</button>
                          <button onclick="" type="submit" class="btn btn-success">Guardar</button>    
                    </div>
                </div>
            </div>
        </form>
   </div>
</div>
@endsection

<script type="">
	function funcionConvLetrasMay(evt) {
		var code = (evt.which) ? evt.which : evt.keyCode;
		var input = evt.target.value;

		// No permitir símbolos, ni numeros
		if (code >= 33 && code <= 64 || code >= 186 && code <= 222 || code >= 91 && code <= 96) {
			return false;
		}

		// No permitir espacios al inicio
		if (code == 32 && input.length === 0) {
			return false;
		}

		// Cambiar la primera letra de cada palabra a mayúscula
		var words = input.split(" ");
		for (var i = 0; i < words.length; i++) {
			words[i] = words[i].charAt(0).toUpperCase() + words[i].slice(1).toLowerCase();
		}
		var modifiedInput = words.join(" ");
		evt.target.value = modifiedInput;

		// Permitir separar palabras (min una vez, max tres)
		if (code == 32) {
			var spaceCount = (input.match(/ /g) || []).length;
			if (spaceCount >= 3) {
				return false;
			}
		}
		return true;
	}

	
</script>