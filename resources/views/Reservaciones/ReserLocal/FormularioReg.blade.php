@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Reservacion del local')
@section('miga')
<li class="breadcrumb-item text-sm text-dark" aria-current="page">  
    <a class="opacity-5 text-dark" href="{{route('cliente.reservaLocal')}}">Reservación del Local</a></li>
<li class="breadcrumb-item text-sm"><a class="text-dark">Nueva Reservación</li>
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

<div class="wrapper wrapper--w960">
    <div class="card">
        <div class="card-body">
            <h2 style="text-align: center; text-transform: uppercase"><strong>Registro de Reservación</strong></h2>
            
    <form method="post" action="{{ route('ReserLocal.store') }}" enctype="multipart/form-data">
            @csrf
                <BR>
                    <div class="row d-flex justify-content-center" >
                        <div class="form-group col-md-4 "  >
                            <label for="NombreCliente">Nombre</label> 
                                <input name="Nombre_Cliente" type="text" class=" form-control" id="Nombre_Cliente" maxlength="20"
                                        required placeholder="Ingrese el nombre" value="{{ old('Nombre_Cliente') }}">
                                 @error('Nombre_Cliente')
                                       <strong class="menerr" style="color:red">{{ $message }}</strong>
                                 @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="Apellido_Cliente">Apellido</label>
                            <input name="Apellido_Cliente" type="text" class="form-control" id="ApellidoCliente" 
                              required placeholder="Ingrese el apellido" value="{{ old('Apellido_Cliente') }}">
                            @error('Apellido_Cliente')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="contacto">Contacto / Celular</label>
                           <input name="Contacto" type="number" class="form-control" id="Contacto"
                               required placeholder="Ingrese número de celular" value="{{ old('Contacto') }}"  maxlength="8" minlength="8">
                             @error('Contacto')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                             @enderror
                         </div>
                    </div>

                    <BR>

                    <div class="row d-flex justify-content-center">
                         <div class="form-group col-md-4 ">
                            <label for="Tipo_Reservacion">Tipo de Reservación</label>
                            <select name="Tipo_Reservacion" required onchange="quitarerror()" class="form-control">
                                    @if (old('Tipo_Reservacion'))
                                        @if (old('Tipo_Reservacion') === 'De Día (Menor Costo)')
                                            <option style="display: none" selected="selected" value="De Día (Menor Costo)">De Día (Menor Costo)</option>
                                        @else
                                            @if (old('Tipo_Reservacion') === 'De Noche (Mayor Costo)')
                                                <option style="display: none" selected="selected" value="De Noche (Mayor Costo)">De Noche (Mayor Costo)</option>
                                            @else
                                            @endif
                                        @endif
                                    @else
                                        <option disabled="disabled" selected="selected" value="">-- Seleccione Uno --</option>
                                    @endif
                                    <option value="De Día (Menor Costo)">De Día (Menor Costo)</option>
                                    <option value="De Noche (Mayor Costo)">De Noche (Mayor Costo)</option>
                                </select>
                            @error('Tipo_Reservacion')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                             @enderror
                        </div>

                        <div class="form-group col-md-4">
                            <label for="Tipo_Evento">Evento</label>
                            <input name="Tipo_Evento" type="text" class="form-control" id="Tipo_Evento"
                               required placeholder="Ingrese el nombre del evento " value="{{ old('Tipo_Evento') }}"  >
                             @error('Tipo_Evento')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                             @enderror
                        </div>

                        <div class="form-group col-md-4 ">
                            <label for="cantidad">Cantidad de Personas</label>
                            <input name="Cantidad" type="number" class="form-control" id="Cantidad"  
                                required placeholder="Cantidad de personas a asistir" value="{{ old('Cantidad') }}" maxlength="8" minlength="8" >
                              @error('Cantidad')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                              @enderror
                        </div>
                    </div>
                    <BR>

                    <div class="row d-flex justify-content-center">
                        <div class="form-group col-md-12">
                            <label for="Fecha" >Fecha del Evento</label>
                            <input name="Fecha" type="date"  class="form-control" id="Fecha"
                                required placeholder="" value="{{ old('Fecha') }}">
                            @error('Fecha')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                    <BR>

                    <div class="row d-flex justify-content-center">
                        <div class="form-group col-md-4 ">
                            <label for="HoraEntrada">Hora de Llegada</label>
                            <input name="HoraEntrada" type="time"  class="form-control" id="HoraEntrada" min="08:00" max="18:00"
                                placeholder="Ingrese la hora de llegada" value="{{ old('HoraEntrada')}}" required>
                            @error('HoraEntrada')
                                   <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group col-md-4 ">
                            <label for="HoraSalida">Hora de Salida</label>
                            <input name="HoraSalida" type="time"  class="form-control" id="HoraSalida"  max="22:00"
                                placeholder="Ingrese la hora de salida" value="{{ old('HoraSalida')}}" required>
                            @error('HoraSalida')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group col-md-4 ">
                            <label for="FormaPago">Forma de Pago</label>
                            <select name="FormaPago" required onchange="quitarerror()"  class="form-control">
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
                    </div>

                    <BR>
                        
                    <div class="row d-flex justify-content-center">
                        <div class="form-group col-md-4 ">
                            <label for="total">Costo de la Reservación</label>
                           <input name="Total" type="number" class="form-control" id="Total" step="0.001" oninput="calcular()"
                                placeholder="Ingrese el total a pagar" value="{{ old('Total')}}" required>
                             @error('Total')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                             @enderror
                        </div>

                        <div class="form-group col-md-4 ">
                            <label for="Anticipo">Anticipo</label>
                            <input name="Anticipo" type="number"  class="form-control" id="Anticipo" step="0.001" oninput="calcular()"
                                placeholder="Ingrese el saldo a cancelar" value="{{ old('Anticipo')}}" required>
                            @error('Anticipo')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div class="form-group col-md-4 ">
                            <label for="Pendiente">Saldo Pendiente</label>
                            <input name="Pendiente" type="number"  class="form-control" step="0.001" id="Pendiente" 
                                placeholder="Saldo pendiente" value="{{ old('Pendiente')}}" required>
                            @error('Pendiente')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>
                    </div>

                        <div class="">
                            <BR>
                          <div style="text-align:center;">
                              <button style="width:142px;" onclick="" type="submit" class="btn btn-success">Guardar</button>
                              <button  style="width:142px;" type="button" onclick="cancelar('Reser/Local')" class="btn btn-danger">Cancelar</button>
                          </div>
                       </div>
                       
                       <BR>

                    </div>
            </div>
        </form>
   </div>
</div>
@endsection