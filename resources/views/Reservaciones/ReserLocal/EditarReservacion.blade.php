@extends('00_plantillas_Blade.plantilla_General1')
@section('title', 'Reservar todo el local')

@section('contend')

    <div class="page-wrapper bg-primary p-t-170 p-b-100 font-robo">
        <br><br>
        <div class="wrapper wrapper--w960">
            <div class="card">
                <div class="card-body">
                    <div class="card-body ">
                        <div >
                            <h3>Reservación del cliente: {{$r->Nombre_Cliente}}
                            </h3>
                        </div>
                        <BR>
                        <h6 class="">Sí desea reservar todo el local, complete el siguiente <BR>
                            formulario y nos pondremos en contacto contigo lo <BR>
                            antes posible.</h6>

                    <form method="post" action="{{ route('resCliente.update', ['id' => $r->id]) }}" enctype="multipart/form-data">
                        @method('put')
                        @csrf                      
                        <div >
                            <div class="col-9">
                                <div>
                                    <div class="form-group col-md-7">
                                        <label for="NombreCliente">Nombre</label>
                                        <input name="Nombre_Cliente" type="text" class="form-control" id="NombreCliente" maxlength="40"
                                        required placeholder="Ingrese su Nombre" value="{{ old('Nombre_Cliente', $r->Nombre_Cliente) }}">
                                        @error('Nombre_Cliente')
                                            <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group col-md-7">
                                        <label for="ApellidoCliente">Apellido</label>
                                        <input name="Apellido_Cliente" type="text" class="form-control text-area" id="ApellidoCliente" 
                                          required placeholder="Ingrese su Apellido" value="{{ old('Apellido_Cliente', $r->Apellido_Cliente) }}">
                                        @error('Apellido_Cliente')
                                            <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div>
                                    <div class="form-group col-md-7">
                                        <label for="Fecha">Fecha</label>
                                        <input name="Fecha" type="date"  class="form-control" id="Fecha"
                                            placeholder="Ingrese la fecha del evento Dia/Mes/Año" value="{{ old('Fecha', $r->Fecha)}}" required>
                                        @error('Fecha')
                                            <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div>
                                    <div class="form-group col-md-7">
                                        <label for="Hora">Hora</label>
                                        <input name="Hora"  type="time" class="form-control" id="Hora" required 
                                           placeholder="Ingrese la hora de llegada" value="{{ old('Hora', $r->Hora) }}">
                                        @error('Hora')
                                            <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="form-group col-md-7">
                                    <label for="contacto">Contacto / Celular</label>
                                    <input name="Contacto" type="number" class="form-control" id="Contacto"
                                    required placeholder="Ingrese su número de celular" value="{{ old('Contacto', $r->Contacto) }}"  maxlength="8" minlength="8">
                                    @error('Contacto')
                                        <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                    <div>
                                        <div class="form-group col-md-7">
                                            <label for="Tipo_Evento" value="{{$r->Tipo_Evento}}">Tipo de Evento</label>
                                            <select name="Tipo_Evento" id="Tipo_Evento" class="form-control">
                                                <option selected>--Seleccione uno--</option>
                                                <option value="Cumpleaños"{{$r->Tipo_Evento === 'Cumpleaños' ? 'selected' : ''}}>Cumpleaños</option>
                                                <option value="Boda"{{$r->Tipo_Evento === 'Boda' ? 'selected' : ''}}>Boda</option>
                                            </select>
                                            @error('Tipo_Evento')
                                                  <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                             @enderror
                                        </div>
                                    </div>

                                <div id="espacio" ><br></div>
                                    <div style="">
                                          <button type="submit" class="btn btn-success">Actualizar</button>
                                          <button type="button" onclick="cancelar('Reser/Local')" class="btn btn-danger">Cancelar</button>
                                     </div>
                                </div>
                            </div>
                        </div>
                        
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection