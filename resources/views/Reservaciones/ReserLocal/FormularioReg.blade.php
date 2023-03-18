@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Reservacion del local')
@section('miga')
<li class="breadcrumb-item text-sm text-dark" aria-current="page">  
    <a class="text-dark" href="{{route('cliente.reservaLocal')}}">Reservaciones</a></li>
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
    href="{{route('ReserLocal.create')}}">Registro de Reservaciones</a></li>
@endsection
@section('content')
<BR>
    
<div class="card shadow-lgs border-0 rounded-lg mt-0" style="width: 1000px;  background: #56d39d6f">
         <div></div>
         <br>
   <div class="container ">
    <BR>
    <form method="post" action="{{ route('ReserLocal.store') }}" enctype="multipart/form-data">
            @csrf
                <div class="container ">
                    <div class="row">

                        <div class="form-group col-md-6 ">
                            <label for="NombreCliente">Nombre</label>
                                <input name="Nombre_Cliente" type="text" class=" form-control" id="NombreCliente" maxlength="20"
                                        required placeholder="Ingrese el nombre" value="{{ old('Nombre_Cliente') }}">
                                 @error('Nombre_Cliente')
                                     <span class="menerr" style="color:red">{{ $message }}</span>
                                 @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="ApellidoCliente">Apellido</label>
                            <input name="Apellido_Cliente" type="text" class="form-control" id="ApellidoCliente" 
                              required placeholder="Ingrese el apellido" value="{{ old('Apellido_Cliente') }}">
                            @error('Apellido_Cliente')
                                <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row ">
                        <div class="form-group col-md-6">
                            <label for="contacto">Contacto / Celular</label>
                           <input name="Contacto" type="number" class="form-control" id="Contacto"
                               required placeholder="Ingrese número de celular" value="{{ old('Contacto') }}"  maxlength="8" minlength="8">
                             @error('Contacto')
                                <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                             @enderror
                         </div>
                         <div class="form-group col-md-6 ">
                            <label for="cantidad">Cantidad de Personas</label>
                           <input name="Cantidad" type="number" class="form-control" id="Cantidad"
                               required placeholder="Cantidad de personas a asistir" value="{{ old('Cantidad') }}" maxlength="8" minlength="8" >
                             @error('Cantidad')
                                <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                             @enderror
                        </div>
                    </div>

                    <div class="row ">
                        <div class="form-group col-md-6">
                            <label for="Tipo_Reservacion">Tipo de Reservación</label>
                            <select name="Tipo_Reservacion" id="Tipo_Reservacion" class="form-control">
                                    @if (old('Tipo_Reservacion'))
                                        @if (old('Tipo_Reservacion') === 'De Día (Menor Costo)')
                                            <option disabled="disabled" selected="selected" value="De Día (Menor Costo)">De Día (Menor Costo)</option>
                                        @else
                                            @if (old('Tipo_Reservacion') === 'De Noche (Mayor Costo)')
                                                <option disabled="disabled" selected="selected" value="De Noche (Mayor Costo)">De Noche (Mayor Costo)</option>
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
                               <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                             @enderror
                        </div>
                        <div class="form-group col-md-6">
                            <label for="Tipo_Evento">Tipo de Evento</label>
                            <select name="Tipo_Evento" id="Tipo_Evento" class="form-control">
                                @if (old('Tipo_Evento'))
                                    @if (old('Tipo_Evento') === 'Cumpleaños')
                                        <option disabled="disabled" selected="selected" value="Cumpleaños">Cumpleaños</option>
                                    @else
                                        @if (old('Tipo_Evento') === 'Boda')
                                            <option disabled="disabled" selected="selected" value="De Noche">Boda</option>
                                        @else
                                        @endif
                                    @endif
                                @else
                                    <option disabled="disabled" selected="selected" value="">-- Seleccione Uno --</option>
                                @endif
                                <option value="Cumpleaños">Cumpleaños</option>
                                <option value="Boda">Boda</option>
                            </select>
                            @error('Tipo_Evento')
                               <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                             @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 ">
                            <label for="Fecha">Fecha del Evento</label>
                            <input name="Fecha" type="date"  class="form-control" id="Fecha"
                                placeholder="Ingrese la fecha del evento" value="{{ old('Fecha')}}" required>
                            @error('Fecha')
                                <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 ">
                            <label for="Hora">Hora de Llegada</label>
                            <input name="Hora" type="time"  class="form-control" id="Hora"
                                placeholder="Ingrese la hora de llegada" value="{{ old('Hora')}}" required>
                            @error('Hora')
                                <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-6 ">
                            <label for="Precio">Precio</label>
                            <input name="Precio" type="number"  class="form-control" id="Precio"
                                placeholder="Ingrese el precio" value="{{ old('Precio')}}" required>
                            @error('Precio')
                                <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 ">
                            <label for="FormaPago">Forma de Pago</label>
                            <select name="FormaPago" id="FormaPago" class="form-control">
                                @if (old('FormaPago'))
                                    @if (old('FormaPago') === 'Efectivo')
                                        <option disabled="disabled" selected="selected" value="Efectivo">Efectivo</option>
                                    @else
                                        @if (old('FormaPago') === 'Tigo Money')
                                            <option disabled="disabled" selected="selected" value="Tigo Money">Tigo Money</option>
                                        @else
                                        @endif
                                    @endif
                                @else
                                    <option disabled="disabled" selected="selected" value="">-- Seleccione Uno --</option>
                                @endif
                                <option value="Efectivo">Efectivo</option>
                                <option value="Tigo Money">Tigo Money</option>
                            </select>
                            @error('FormaPago')
                               <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                             @enderror
                        </div>
                    </div>

                    <div id="" ><br></div>
                          <div style="text-align:center">
                              <button onclick="" type="submit" class="btn btn-success">Guardar</button>
                              <button type="button" onclick="cancelar('Reser/Local')" class="btn btn-danger">Cancelar</button>
                          </div>
                    </div>
                </div>
            </div>
        </form>
   </div>
</div>
@endsection