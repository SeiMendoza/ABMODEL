@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Reservacion')
@section('miga')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
    href="{{route('kiosko_res.index')}}">Reservacion de Kiosko</a></li>
<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Reservación de {{$reservacion->nombre}}</li>
@endsection
@section('content')
    <div class="container ">
        <div class="row d-flex justify-content-center" >
            <div class="card" style="background: #008d504f" >
                 <BR>
                <form method="post" action="{{ route('kiosko_res.update',  ['id' => $reservacion->id]) }}" novalidate class="needs-validation"
                enctype="multipart/form-data">
                    @csrf
                    <div class="container ">
                        <div class="row">

                            <div class="form-group col-md-6 ">
                                <label for="nombre">Nombre</label>
                                    <input name="nombre" type="text" class=" form-control" id="nombre" maxlength="50" minlength="3"
                                            required placeholder="Ingrese el nombre" value="{{ old('nombre', $reservacion->nombre) }}">
                                    <div class="invalid-feedback">
                                        
                                    </div>
                                    @error('nombre')
                                        <span class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                            </div>
                        </div>

                        <div class="row ">
                            <div class="form-group col-md-6">
                                <label for="celular">Contacto / Celular</label>
                            <input name="celular" type="text" class="form-control" id="celular" maxlength="8" minlength="8"
                                required placeholder="Ingrese número de celular" value="{{ old('celular',$reservacion->celular) }}"  >
                                <div class="invalid-feedback">
                                    
                                </div>
                                @error('celular')
                                    <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="cantidad">Cantidad de Personas</label>
                            <input name="cantidad" type="text" class="form-control" id="cantidad"  max="20" min="1" maxlength="3" minlength="1"
                                required placeholder="Cantidad de personas a asistir" value="{{ old('cantidad', $reservacion->cantidad) }}">
                                <div class="invalid-feedback">
                                
                                </div>
                                @error('cantidad')
                                    <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group col-md-6 ">
                                <label for="fecha">Fecha</label>
                                <input name="fecha" type="date"  class="form-control" id="fecha"
                                    placeholder="Ingrese la fecha del evento" value="{{ old('fecha', $reservacion->fecha)}}" required>
                                    <div class="invalid-feedback">
                                        
                                    </div>
                                @error('fecha')
                                    <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="hora">Hora</label>
                                <input name="hora" type="time"  class="form-control" id="hora"
                                    placeholder="Ingrese la hora" value="{{ old('hora', $reservacion->hora)}}" required>
                                    <div class="invalid-feedback">
                                        
                                    </div>
                                    @error('hora')
                                    <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="form-group col-md-6 ">
                                <label for="pago">Costo de la reservación</label>
                                <input name="pago" type="number"  class="form-control" id="pago"  max="5000" min="100" maxlength="10" minlength="1"
                                    placeholder="Ingrese el costo de la reservación" value="{{ old('pago', $reservacion->pago)}}" required>
                                    <div class="invalid-feedback">
                                    
                                    </div>
                                    @error('pago')
                                    <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group col-md-6 ">
                                <label for="formaPago">Forma de Pago</label>
                                <select name="formaPago" id="formaPago" class="form-control">
                                    @if (old('formaPago'))
                                        @if (old('formaPago') === 'Efectivo')
                                            <option disabled="disabled" selected="selected" value="Efectivo">Efectivo</option>
                                        @else
                                            @if (old('formaPago') === 'Transferencia')
                                                <option disabled="disabled" selected="selected" value="Transferencia">Transferencia</option>
                                            @else
                                            @endif
                                        @endif
                                    @else
                                        <option disabled="disabled" selected="selected" value="{{$reservacion->formaPago}}">-- Seleccione Uno --</option>
                                    @endif
                                    <option value="Efectivo"{{$reservacion->formaPago === 'Efectivo' ? 'selected' : ''}}>Efectivo</option>
                                    <option value="Transferencia"{{$reservacion->formaPago === 'Transferencia' ? 'selected' : ''}}>Transferencia</option>
                                </select>
                                <div class="invalid-feedback">
                                
                                </div>
                                @error('formaPago')
                                <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>

                        <div id="" ><br></div>
                        <div style="text-align:center">
                            <button onclick="" type="submit" class="btn btn-success">Guardar</button>
                            <button type="button" onclick="cancelar('kiosko/reservaciones')" class="btn btn-danger">Cancelar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection