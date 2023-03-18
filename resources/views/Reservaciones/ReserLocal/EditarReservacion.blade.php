@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Reservacion del local')
@section('miga')
<li class="breadcrumb-item text-sm text-dark" aria-current="page">  
    <a class="text-dark" href="{{route('cliente.reservaLocal')}}">Reservaciones</a></li>
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark">Editar Reservación</a></li>
@endsection
@section('content')
<BR>
<div class="card shadow-lgs border-0 rounded-lg mt-0" style="width: 1000px;  background: #56d39d6f">

    <div class="card card-header " style="width: 1000px; height:70px; background:  #96bbab6f">
            <div style="text-align:center">
                <h4 class="m-0 font-weight-bold" style="color: white"> Editando Reservación de:  {{$r->Nombre_Cliente}}</h4>
            </div>
        </div>
        
   <div class="container ">
    <form method="post" action="{{ route('resCliente.update', ['id' => $r->id]) }}" enctype="multipart/form-data">
            @method('put')
            @csrf
                <div class="container ">
                    <br>
                    <div class="row">
                        <div class="form-group col-md-6 ">
                            <label for="NombreCliente">Nombre</label>
                                <input name="Nombre_Cliente" type="text" class=" form-control" id="NombreCliente" maxlength="40"
                                        required placeholder="Ingrese el nombre" value="{{ old('Nombre_Cliente', $r->Nombre_Cliente) }}">
                                 @error('Nombre_Cliente')
                                     <span class="menerr" style="color:red">{{ $message }}</span>
                                 @enderror
                        </div>

                        <div class="form-group col-md-6">
                            <label for="ApellidoCliente">Apellido</label>
                            <input name="Apellido_Cliente" type="text" class="form-control text-area" id="ApellidoCliente" 
                              required placeholder="Ingrese el apellido" value="{{ old('Apellido_Cliente', $r->Apellido_Cliente) }}">
                            @error('Apellido_Cliente')
                                <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row ">
                        <div class="form-group col-md-6">
                            <label for="contacto">Contacto / Celular</label>
                           <input name="Contacto" type="number" class="form-control" id="Contacto"
                               required placeholder="Ingrese número de celular" value="{{ old('Contacto', $r->Contacto) }}"  maxlength="8" minlength="8">
                             @error('Contacto')
                                <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                             @enderror
                         </div>
                         <div class="form-group col-md-6 ">
                            <label for="cantidad">Cantidad de Personas</label>
                           <input name="Cantidad" type="number" class="form-control" id="Cantidad"
                               required placeholder="Cantidad de personas a asistir" value="{{ old('Cantidad', $r->Cantidad) }}" maxlength="8" minlength="8" >
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
                                        @if (old('Tipo_Reservacion') === 'De Día')
                                            <option disabled="disabled" selected="selected" value="De Día">De Día (Menor Costo)</option>
                                        @else
                                            @if (old('Tipo_Reservacion') === 'De Noche')
                                                <option disabled="disabled" selected="selected" value="De Noche">De Noche (Mayor Costo)</option>
                                            @else
                                            @endif
                                        @endif
                                    @else
                                        <option disabled="disabled" selected="selected" value="{{$r->Tipo_Reservacion}}">-- Seleccione Uno --</option>
                                    @endif
                                    <option value="De Día"{{$r->Tipo_Reservacion === 'De Día' ? 'selected' : ''}}>De Día (Menor Costo)</option>
                                    <option value="De Noche"{{$r->Tipo_Reservacion === 'De Noche' ? 'selected' : ''}}>De Noche (Mayor Costo)</option>
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
                                    <option disabled="disabled" selected="selected" value="{{$r->Tipo_Evento}}">-- Seleccione Uno --</option>
                                @endif
                                <option value="Cumpleaños"{{$r->Tipo_Evento === 'Cumpleaños' ? 'selected' : ''}}>Cumpleaños</option>
                                <option value="Boda"{{$r->Tipo_Evento === 'Boda' ? 'selected' : ''}}>Boda</option>
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
                                placeholder="Ingrese la fecha del evento" value="{{ old('Fecha', $r->Fecha)}}" required>
                            @error('Fecha')
                                <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 ">
                            <label for="Hora">Hora de Llegada</label>
                            <input name="Hora" type="time"  class="form-control" id="Hora"
                                placeholder="Ingrese la hora de llegada" value="{{ old('Hora', $r->Hora)}}" required>
                            @error('Hora')
                                <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-6 ">
                            <label for="Precio">Precio</label>
                            <input name="Precio" type="number"  class="form-control" id="Precio"
                                placeholder="Ingrese el precio" value="{{ old('Precio', $r->Precio)}}" required>
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
                                    <option disabled="disabled" selected="selected" value="{{$r->FormaPago}}">-- Seleccione Uno --</option>
                                @endif
                                <option value="Efectivo"{{$r->FormaPago === 'Efectivo' ? 'selected' : ''}}>Efectivo</option>
                                <option value="Tigo Money"{{$r->FormaPago === 'Tigo Money' ? 'selected' : ''}}>Tigo Money</option>
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