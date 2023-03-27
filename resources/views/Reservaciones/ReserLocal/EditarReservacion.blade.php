@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Reservacion del local')
@section('miga')
<li class="breadcrumb-item text-sm " aria-current="page">  
    <a class="opacity-5 text-dark" href="{{route('cliente.reservaLocal')}}">Reservación del Local</a></li>
<li class="breadcrumb-item text-sm text-dark "><a class="text-dark">Editando Reservación</a></li>
@endsection
@section('content')
   <div class="container ">
    <div class="row d-flex justify-content-center" >
        <div class="card" style="background: #008d504f" >
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
                         <div class="form-group col-md-6">
                            <label for="Tipo_Reservacion">Tipo de Reservación</label>
                            <select name="Tipo_Reservacion" id="Tipo_Reservacion" class="form-control">
                                    @if (old('Tipo_Reservacion'))
                                        @if (old('Tipo_Reservacion') === 'De Día (Menor Costo)')
                                            <option disabled="disabled" selected="selected" value="De Día (Menor Costo) ">De Día (Menor Costo)</option>
                                        @else
                                            @if (old('Tipo_Reservacion') === 'De Noche (Mayor Costo)')
                                                <option disabled="disabled" selected="selected" value="De Noche (Mayor Costo)<">De Noche (Mayor Costo)</option>
                                            @else
                                            @endif
                                        @endif
                                    @else
                                        <option disabled="disabled" selected="selected" value="{{$r->Tipo_Reservacion}}">-- Seleccione Uno --</option>
                                    @endif
                                    <option value="De Día (Menor Costo) "{{$r->Tipo_Reservacion === 'De Día (Menor Costo)' ? 'selected' : ''}}>De Día (Menor Costo)</option>
                                    <option value="De Noche (Mayor Costo)"{{$r->Tipo_Reservacion === 'De Noche (Mayor Costo)' ? 'selected' : ''}}>De Noche (Mayor Costo)</option>
                                </select>
                            @error('Tipo_Reservacion')
                               <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                             @enderror
                        </div>
                    </div>

                    <div class="row ">
                        <div class="form-group col-md-6">
                            <label for="Tipo_Evento">Tipo de Evento</label>
                            <input name="Tipo_Evento" type="text" class="form-control" id="Tipo_Evento"
                               required placeholder="Ingrese el nombre del evento " value="{{ old('Tipo_Evento', $r->Tipo_Evento)}}"  >
                             @error('Tipo_Evento')
                                <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                             @enderror
                        </div>
                        <div class="form-group col-md-6 ">
                            <label for="Fecha">Fecha del Evento</label>
                            <input name="Fecha" type="date"  class="form-control" id="Fecha"
                                placeholder="Ingrese la fecha del evento" value="{{ old('Fecha', $r->Fecha)}}" required>
                            @error('Fecha')
                                <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row ">
                        <div class="form-group col-md-6 ">
                            <label for="Hora">Hora de Llegada</label>
                            <input name="Hora" type="time"  class="form-control" id="Hora"
                                placeholder="Ingrese la hora de llegada" value="{{ old('Hora', $r->Hora)}}" required>
                            @error('Hora')
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
                                        @if (old('FormaPago') === 'Transferencia')
                                        <option disabled="disabled" selected="selected" value="Transferencia">Transferencia</option>
                                        @else
                                        @endif
                                    @endif
                                @else
                                    <option disabled="disabled" selected="selected" value="{{$r->FormaPago}}">-- Seleccione Uno --</option>
                                @endif
                                <option value="Efectivo"{{$r->FormaPago === 'Efectivo' ? 'selected' : ''}}>Efectivo</option>
                                <option value="Transferencia"{{$r->FormaPago === 'Transferencia' ? 'selected' : ''}}>Transferencia</option>
                            </select>
                            @error('FormaPago')
                               <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                             @enderror
                        </div>
                    </div>
                    
                    <div class="row">
                        <div class="form-group col-md-6 ">
                            <label for="PrecioEntrada">Precios de Entrada</label>
                            <select name="PrecioEntrada" id="PrecioEntrada" class="form-control">
                                @if (old('PrecioEntrada'))
                                    @if (old('PrecioEntrada') === 'L.100 con Alimentos')
                                        <option disabled="disabled" selected="selected" value="L.100 con Alimentos">L.100 con Alimentos</option>
                                    @else
                                        @if (old('PrecioEntrada') === 'L.80 sin Alimentos')
                                            <option disabled="disabled" selected="selected" value="L.80 sin Alimentos">L.  80 sin Alimentos</option>
                                        @else
                                        @endif
                                    @endif
                                @else
                                    <option disabled="disabled" selected="selected" value="{{$r->PrecioEntrada}}">-- Seleccione Uno --</option>
                                @endif
                                <option value="L.100 con Alimentos"{{$r->PrecioEntrada === 'L.100 con Alimentos' ? 'selected' : ''}}>L.100 con Alimentos</option>
                                <option value="L.80 sin Alimentos"{{$r->PrecioEntrada === 'L.  80 sin Alimentos' ? 'selected' : ''}}>L.  80 sin Alimentos</option>
                            </select>
                            @error('PrecioEntrada')
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


                    <div class="row">
                        <div class="form-group col-md-6 ">
                            <label for="total">Costo de la Reservación</label>
                           <input name="Total" type="number" class="form-control" id="Total"
                               placeholder="Ingrese el total a pagar" value="{{ old('Total', $r->Total) }}" required >
                             @error('Total')
                                <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                             @enderror
                        </div>
                        <div class="form-group col-md-6 ">
                            <label for="Anticipo">Anticipo</label>
                            <input name="Anticipo" type="number"  class="form-control" id="Anticipo"
                                placeholder="Ingrese el adelanto a cancelar" value="{{ old('Anticipo', $r->Anticipo) }}" required>
                            @error('Anticipo')
                                <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                    </div>

                    <div class="row">
                        <div class="form-group col-md-6 ">
                            <label for="Pendiente">Saldo Pendiente</label>
                            <input name="Pendiente" type="text"  class="form-control" id="Pendiente"
                                placeholder="Ingrese la cantidad pendiente a cancelar" value="{{ old('Pendiente', $r->Pendiente) }}" required>
                            @error('Pendiente')
                                <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group col-md-6 ">
                            <div id="" ><br></div>
                          <div style="text-align:right; margin-right:150px">
                              <button onclick="" type="submit" class="btn btn-success">Actualizar</button>
                              <button type="button" onclick="cancelar('Reser/Local')" class="btn btn-danger">Cancelar</button>
                          </div>
                       </div>
                    </div>
                </div>
            </div>
        </form>
   </div>
</div>
@endsection