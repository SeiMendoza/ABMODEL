@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Registro')    
@section('miga')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
    href="{{route('kiosko_res.index')}}">Reservaciones de kioskos</a></li>
<li class="breadcrumb-item text-sm text-dark active text-white" aria-current="page">Registro de reservación</li>
@endsection
@section('tit','Reservación de kiosko')
@section('b')
    <div class="" style="">    
        <a href="{{route('kiosko_res.index')}}" style="margin:0; padding:5px; width:150px; font-size:15px" type="button" 
        class="bg-light border-radius-sm text-center">
        <i class="fa fa-arrow-left"></i> Regresar
       </a> 
    </div>
@endsection
@section('content')
    <div class="" style="margin-bottom: 10px">
        <div class="wrapper wrapper--w960" >
            <div class="card border-radius-sm border-0" style="padding-bottom:0">
                <div class="card-body border-radius-sm border-0" style="padding-bottom:0">
                    
                    <form method="POST" action="{{route('kiosko_res.store')}}"  enctype="multipart/form-data">
                        @csrf
                        <h4 class="font-robo t" style="margin: 0; padding:0">Datos del cliente: </h4>
                        <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="name" style="margin-left: 0;">Nombre:</label>
                                    <input class="form-control border-radius-sm" type="text" placeholder="Nombre del cliente" name="name" id="name" minlength="7" 
                                    maxlength="7" value="{{old('name')}}" required>
                                    @error('name')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="celular" style="margin-left: 0;">Celular: </label>
                                    <input name="celular" type="text" class="form-control border-radius-sm" id="celular" maxlength="8" minlength="8"
                                    required placeholder="Ingrese un número de celular" value="{{ old('celular') }}">  
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
                                    <label for="fecha" style="margin-left: 0;">Fecha: </label>
                                    <input name="fecha" type="date"  class="form-control border-radius-sm" id="fecha"
                                    min="{{ now()->toDateString('Y-m-d') }}" max="{{ date("Y-m-d",strtotime(now()."+ 2 month"));}}" style="height: 40px"
                                    placeholder="Ingrese la fecha del evento" value="{{ old('fecha')}}" required>  
                                    @error('fecha')
                                        <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="font-robo form-group">
                                    <label for="inicio" style="margin-left: 0;">Hora de inicio</label>
                                    <input name="inicio" type="time"  class="form-control border-radius-sm" id="inicio" min="06:00" max="00:00"
                                        placeholder="Ingrese la hora de llegada" value="{{ old('inicio')}}" required>
                                    @error('inicio')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="font-robo form-group">
                                    <label for="fin" style="margin-left: 0;">Hora de salida</label>
                                    <input name="fin" type="time"  class="form-control border-radius-sm" id="fin" min="06:00" max="00:00"
                                        placeholder="Ingrese la hora de llegada" value="{{ old('fin')}}" required>
                                    @error('fin')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="tipoE" style="margin-left: 0;">Evento: </label>
                                    <input name="tipoE" type="text" class="form-control border-radius-sm" id="tipoE"
                                    required placeholder="Ingrese el tipo del evento " value="{{ old('tipoE') }}"  >
                                    @error('tipoE')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="kiosko" style="margin-left: 0;">Kiosko a reservar: </label>
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
                        <h4 class="font-robo t" style="margin: 0; padding:0">Costo de la reservación: </h4>
                        <hr class="m-1" style="border: 0.1px solid rgba(111, 143, 175, 0.600)">
                        <div class="row row-space">
                            <div class="col-4">
                                <div class="font-robo form-group">
                                    <label for="cantidadN" style="margin-left: 0;">Cantidad de niños (L 50.00): </label>
                                    <input name="cantidadN" type="number" class="form-control border-radius-sm" id="cantidadN"  
                                    max="20" min="0" maxlength="3" minlength="1" step="0.001" oninput="calcular()"
                                        required placeholder="Cantidad de niños a asistir" value="{{ old('cantidadN') }}">
                                        @error('cantidadN')
                                            <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                        @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="font-robo form-group">
                                    <label for="cantidad" style="margin-left: 0;">Cantidad de Adultos (L 100.00): </label>
                                    <input name="cantidad" type="number" class="form-control border-radius-sm" id="cantidad" 
                                     max="20" min="2" maxlength="3" minlength="1" step="0.001" oninput="calcular()"
                                    required placeholder="Cantidad de personas a asistir" value="{{ old('cantidad') }}">
                                    @error('cantidad')
                                        <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>   
                            </div>
                            <div class="col-4">
                                <div class="font-robo form-group">
                                    <label for="class" style="margin-left: 0;">Total: </label>
                                    <input name="total" type="number" class="form-control border-radius-sm" id="total" 
                                    step="0.001"
                                    placeholder="Ingrese el total a pagar" value="{{ old('total')}}" readonly>
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-4">
                                <div class="font-robo form-group" style="margin-bottom: 5px">
                                    <label for="anticipo" style="margin-left: 0;">Pago anticipado: </label>
                                    <input name="anticipo" type="number"  class="form-control border-radius-sm" id="anticipo" 
                                    step="0.001" oninput="calcular()"
                                    placeholder="Ingrese el pago adelantado" value="{{ old('anticipo')}}" required>
                                    @error('anticipo')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="font-robo form-group" style="margin-bottom: 5px">
                                    <label for="pendiente" style="margin-left: 0;">Pago pendiente: </label>
                                    <input name="pendiente" type="number"  class="form-control border-radius-sm" 
                                    step="0.001" 
                                    id="pendiente" 
                                        placeholder="Saldo pendiente" value="{{ old('pendiente')}}" readonly>
                                </div>
                            </div>
                            <div class="col-4">
                                <div class="font-robo form-group" style="margin-bottom: 5px">
                                    <label for="formaPago" style="margin-left: 0;">Forma de pago: </label>
                                    <select name="formaPago" required onchange="quitarerror()"  class="form-control border-radius-sm">
                                        @if (old('formaPago'))
                                            @if (old('formaPago') === 'Efectivo')
                                                <option style="display: none" selected="selected" value="Efectivo">Efectivo</option>
                                            @else
                                                @if (old('formaPago') === 'Transferencia')
                                                    <option style="display: none" selected="selected" value="Transferencia">Transferencia</option>
                                                @else
                                                @endif
                                            @endif
                                        @else
                                            <option disabled="disabled" selected="selected" value="">Seleccione una forma de pago</option>
                                        @endif
                                        <option value="1">Efectivo</option>
                                        <option value="0">Transferencia</option>
                                    </select>
                                    @error('formaPago')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                     @enderror
                                </div>
                                </div>
                            </div>
                            <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
                        </div>
                        <div  class="d-flex justify-content-end" style="margin: 5px 23px 0 0"> 
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
             var a = 0.00;
                 c = parseFloat(document.getElementById("cantidadN").value) || 0,
                 d = parseFloat(document.getElementById("cantidad").value) || 0,
                 b = parseFloat(document.getElementById("anticipo").value) || 0;
    
                a = c * 50 + d * 100;  
                document.getElementById("total").value = a;
                document.getElementById("pendiente").value = a - b;
            }catch (e) {}
        }
    </script>

@endsection
