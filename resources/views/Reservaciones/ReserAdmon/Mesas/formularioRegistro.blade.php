@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Registro')    
@section('miga')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
    href="{{route('mesas_reg.index')}}">Lista de mesas</a></li>
<li class="breadcrumb-item text-sm text-dark active text-white" aria-current="page">Registro de mesa</li>
@endsection
@section('content')
    <div class="page-wrapper font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card border-radius-sm border-0" style="">
                <div class="card-body border-radius-sm border-0">
                    <h2 class="title">Registro de mesas</h2>
                    <form method="POST" action="{{route('mesas_reg.store')}}"  enctype="multipart/form-data">
                        @csrf
                        <h4 class="font-robo t" style="margin: 0; padding:0">Datos de la mesa: </h4>
                        <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="kiosko">Kiosko al que pertenece: </label>
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
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="name">Nombre:</label>
                                    <input class="form-control border-radius-sm" type="text" placeholder="Nombre" name="name" id="name" minlength="7" 
                                    maxlength="7" value="{{old('name')}}" required>
                                    @error('name')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="codigo">Código: </label>
                                    <input class="form-control border-radius-sm" type="text" placeholder="K00-M00" name="codigo" id="codigo" 
                                     minlength="7" maxlength="7" value="{{old('codigo')}}" required>
                                    @error('codigo')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>   
                            </div>
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="cantidad">Cantidad: </label>
                                    <input class="form-control border-radius-sm" type="number" placeholder="Ingrese una cantidad"
                                    name="cantidad" id="cantidad" value="{{old('cantidad')}}" minlength="1" maxlength="1" min="6" max="8" required>
                                    @error('cantidad')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div style="float: right;margin-top: 50px"> 
                            <button type="button" onclick="cancelar('mesas/registro')" class="btn btn-danger">Cancelar</button>
                            <button onclick="" type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection