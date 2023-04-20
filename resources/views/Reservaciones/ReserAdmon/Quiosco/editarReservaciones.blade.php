@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Registro')    
@section('miga')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
    href="{{route('kiosko_res.index')}}">Reservaciones de kioskos</a></li>
<li class="breadcrumb-item text-sm text-dark active text-white" aria-current="page">Edición de reservación</li>
@endsection
@section('content')
    <div class="page-wrapper font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card border-radius-sm border-0" style="padding-bottom:0">
                <div class="card-body border-radius-sm border-0" style="padding-bottom:0">
                    <h2 class="title" style="margin-bottom:0%">Reservación del cliente: {{$registro->nombre}}</h2>
                    <form method="POST" action="{{route('kiosko_res.update', ['id' => $registro->id])}}"  enctype="multipart/form-data">
                        @csrf
                        <h4 class="font-robo t" style="margin: 0; padding:0">Datos del cliente: </h4>
                        <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="name">Nombre:</label>
                                    <input class="form-control border-radius-sm" type="text" placeholder="Nombre" name="name" id="name" minlength="7" 
                                    maxlength="7" value="{{old('name', $registro->nombre)}}" required>
                                    @error('name')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="celular">Celular: </label>
                                    <input name="celular" type="text" class="form-control border-radius-sm" id="celular" maxlength="8" minlength="8"
                                    required placeholder="Ingrese un número de celular" value="{{ old('celular', $registro->celular) }}">  
                                    @error('celular')
                                        <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <h4 class="font-robo t" style="margin: 0; padding:0">Datos de la reservación: </h4>
                        <hr class="m-1" style="border: 0.1px solid rgba(111, 143, 175, 0.600)">
                        <div class="row row-space">
                            <div class="col-4">
                                <div class="font-robo form-group">
                                    <label for="cantidad">Cantidad de personas: </label>
                                    <input name="cantidad" type="number" class="form-control border-radius-sm" id="cantidad"  max="50" min="2" maxlength="3" minlength="1"
                                    required placeholder="Cantidad de personas a asistir" value="{{ old('cantidad',$registro->cantidad) }}">
                                    @error('cantidad')
                                        <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>   
                            </div>
                            <div class="col-4">
                                <div class="font-robo form-group">
                                    <label for="tipoE">Evento: </label>
                                    <input name="tipoE" type="text" class="form-control border-radius-sm" id="tipoE"
                                    required placeholder="Ingrese el tipo del evento " value="{{ old('tipoE',$registro->tipo) }}"  >
                                    @error('tipoE')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="font-robo form-group">
                                    <label for="kiosko">Kiosko a reservar: </label>
                                    <select name="kiosko" onchange="quitarerror()" id="kiosko" class="form-control border-radius-sm" required>
                                        @if (old('kiosko'))
                                            <option disabled="disabled" value="">Seleccione un kiosko</option> 
                                            @foreach ($kiosko as $c)
                                                @if (old('kiosko') == $c->id)
                                                    <option selected="selected" value="{{$c->id}}">{{$c->id}}</option>
                                                @else
                                                    <option value="{{$c->id}}">{{$c->id}}</option>
                                                @endif
                                            @endforeach 
                                        @else
                                            <option disabled="disabled" selected="selected" value="">Seleccione un kiosko</option> 
                                            @foreach ($kiosko as $c)
                                                <option value="{{$c->id}}">{{$c->id}}</option>
                                            @endforeach 
                                        @endif
                                    </select>
                                    @error('kiosko')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-4">
                                <div class="font-robo form-group">
                                    <label for="fecha">Fecha: </label>
                                    <input name="fecha" type="date"  class="form-control border-radius-sm" id="fecha" style="height: 40px"
                                    placeholder="Ingrese la fecha del evento" value="{{ old('fecha', $registro->fecha)}}" required>  
                                    @error('fecha')
                                        <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="font-robo form-group">
                                    <label for="inicio">Hora de inicio</label>
                                    <input name="inicio" type="time"  class="form-control border-radius-sm" id="inicio" min="08:00" max="18:00"
                                        placeholder="Ingrese la hora de llegada" value="{{ old('inicio', $registro->horaI)}}" required>
                                    @error('inicio')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="font-robo form-group">
                                    <label for="fin">Hora de salida</label>
                                    <input name="fin" type="time"  class="form-control border-radius-sm" id="fin" min="08:00" max="00:00"
                                        placeholder="Ingrese la hora de llegada" value="{{ old('fin', $registro->horaF)}}" required>
                                    @error('fin')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <h4 class="font-robo t" style="margin: 0; padding:0">Costo de la reservación: </h4>
                        <hr class="m-1" style="border: 0.1px solid rgba(111, 143, 175, 0.600)">
                        <div class="row row-space">
                            <div class="col-4">
                                <div class="font-robo form-group"> 
                                    @php
                                    $a = "No";
                                        if ($registro->alimentos == 0){
                                         $a = "Si";
                                        }
                                        else{
                                         $a;
                                        }
                                    @endphp
                                    <label for="class">Ingreso de alimentos: </label>
                                    <input class="form-control border-radius-sm" type="text" placeholder="Ingrese una alimentos"
                                    name="alimentos" id="alimentos" minlength="1" maxlength="3" min="80" max="100" 
                                    value="{{old('alimentos', $a)}}" required>
                                    @error('alimentos')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="font-robo form-group">
                                    <label for="class">Precio: </label>
                                    <input class="form-control border-radius-sm" type="number" placeholder="Ingrese una precio"
                                    name="precio" id="precio" minlength="1" maxlength="3" min="80" max="100" value="{{old('precio', $registro->precio)}}" required>
                                    @error('precio')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="font-robo form-group">
                                    <label for="class">Total: </label>
                                    <input name="total" type="number" class="form-control border-radius-sm" id="total" step="0.001" oninput="calcular()"
                                    placeholder="Ingrese el total a pagar" value="{{ old('total',$registro->total)}}" required>
                                    @error('total')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-4">
                                <div class="font-robo form-group">
                                    <label for="anticipo">Pago anticipado: </label>
                                    <input name="anticipo" type="number"  class="form-control border-radius-sm" id="anticipo" step="0.001" oninput="calcular()"
                                    placeholder="Ingrese el saldo a cancelar" value="{{ old('anticipo', $registro->anticipo)}}" required>
                                    @error('anticipo')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="font-robo form-group">
                                    <label for="pendiente">Pago pendiente: </label>
                                    <input name="pendiente" type="number"  class="form-control border-radius-sm" step="0.001" id="pendiente" 
                                        placeholder="Saldo pendiente" value="{{ old('pendiente',$registro->pendiente)}}" required>
                                    @error('pendiente')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="font-robo form-group">
                                    <label for="formaPago">Forma de pago: </label>
                                    <select name="formaPago" required onchange="quitarerror()"  class="form-control border-radius-sm">
                                        @if ($registro->formaPago)
                                            @if ($registro->formaPago == 'Efectivo')
                                                <option style="display: none" selected="selected" value="Efectivo">Efectivo</option>
                                            @else
                                                @if ($registro->formaPago == 'Transferencia')
                                                    <option style="display: none" selected="selected" value="Transferencia">Transferencia</option>
                                                @else
                                                @endif
                                            @endif
                                        @else
                                            <option disabled="disabled" selected="selected" value="{{$registro->formaPago}}">{{old('formaPago', $registro->formaPago)}}</option>
                                        @endif
                                        <option value="Efectivo">Efectivo</option>
                                        <option value="Transferencia">Transferencia</option>
                                    </select>
                                    @error('formaPago')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                     @enderror
                                </div>
                                </div>
                            </div>
                        </div>
                        <div  class="d-flex justify-content-end" style="margin: 0 23px 0 0"> 
                            <button type="button" onclick="cancelar('kiosko/reservaciones')" class="btn btn-danger" style="margin-right: 5px">Cancelar</button>
                            <button onclick="" type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script type="text/javascript">
        function calcular(){
          try{
             var a = parseFloat(document.getElementById("total").value) || 0,
                 b = parseFloat(document.getElementById("anticipo").value) || 0;
    
                 document.getElementById("pendiente").value = a - b;
            }catch (e) {}
        }
    </script>

@endsection
