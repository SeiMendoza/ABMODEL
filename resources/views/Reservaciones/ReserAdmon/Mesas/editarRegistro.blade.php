@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Registro')    
@section('miga')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white"
    href="{{route('mesas_reg.index')}}">Lista de mesas</a></li>
<li class="breadcrumb-item text-sm text-dark active text-white" aria-current="page">Edición de Mesa</li>
@endsection
@section('content')
    <div class="page-wrapper font-robo">
        <div class="wrapper wrapper--w960 ">
            <div class="card border-radius-sm border-0">
                <div class="card-body border-radius-sm border-0">
                    <h2 class="title">Registro de mesas</h2>
                    <form method="POST" action="{{route('mesas_reg.update',['id' => $registro ->id])}}"  enctype="multipart/form-data">
                        @method('put')
                        @csrf
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="kiosko">Kiosko al que pertenece: </label>
                                    <select name="kiosko" onchange="quitarerror()" id="kiosko" class="form-control border-radius-sm">
                                        @if ($registro->kiosko_id)
                                            <option disabled="disabled" value="{{$registro->kiosko_id}}">Seleccione un kiosko</option> 
                                            @foreach ($kiosko as $c)
                                                @if ($registro->kiosko_id == $c->id)
                                                    <option selected="selected" value="{{$c->id}}">{{$c->id}}</option>
                                                @else
                                                    <option value="{{$c->id}}">{{$c->id}}</option>
                                                @endif
                                            @endforeach 
                                        @else
                                            <option disabled="disabled" selected="selected" value="{{$registro->kiosko_id}}">{{old('cantidad', $registro->kiosko_id)}}</option> 
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
                                    <label for="birthday">Nombre:</label>
                                    <input class="form-control border-radius-sm" type="text" placeholder="Nombre" name="name" id="name" minlength="7" 
                                    maxlength="7" value="{{old('name', $registro->nombre)}}" required>
                                    @error('name')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="name">Código: </label>
                                    <input class="form-control border-radius-sm" type="text" placeholder="K00-M00" name="codigo" id="codigo" 
                                    minlength="7" maxlength="7" value="{{old('codigo', $registro->codigo)}}" required>
                                    @error('codigo')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>   
                            </div>
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="class">Cantidad: </label>
                                    <input class="form-control border-radius-sm" type="number" placeholder="Ingrese una cantidad"
                                    name="cantidad" id="cantidad" minlength="1" maxlength="1" min="6" max="8" value="{{old('cantidad', $registro->cantidad)}}" required>
                                    @error('cantidad')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <br>
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