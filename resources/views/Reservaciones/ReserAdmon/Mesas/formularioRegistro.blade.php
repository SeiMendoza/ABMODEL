@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Registro')    
@section('miga')
<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Registro de Mesas</li>
@endsection
@section('content')
    <div class="page-wrapper font-robo">
        <div class="wrapper wrapper--w960 ">
            <div class="card border-radius-sm border-0">
                <div class="card-body border-radius-sm border-0">
                    <h2 class="title">Registro de mesas</h2>
                    <form method="POST" action="{{route('mesas_reg.store')}}"  enctype="multipart/form-data">
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="font-robo">
                                    <label for="name">Código: </label>
                                    <input class="form-control border-radius-sm" type="text" placeholder="K0-M0" name="codigo" id="codigo" 
                                    minlength="5" maxlength="5" required>
                                    @error('codigo')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>   
                            </div>
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="birthday">Nombre:</label>
                                    <input class="form-control border-radius-sm" type="text" placeholder="Nombre" name="name" id="name" minlength="4" 
                                    maxlength="15" required>
                                    @error('name')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="class">Cantidad: </label>
                                    <input class="form-control border-radius-sm" type="number" placeholder="Ingrese una cantidad"
                                    name="cantidad" id="cantidad" minlength="1" maxlength="1" min="6" max="8" required>
                                    @error('cantidad')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="res_code">Kiosko: </label>
                                    <select name="kiosko" onchange="quitarerror()" id="kiosko" class="form-control">
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
                        
                    <div id="" ><br></div>
                    <div style="text-align:center">
                        <button onclick="" type="submit" class="btn btn-success">Guardar</button>
                        <button type="button" onclick="cancelar('mesas/registro')" class="btn btn-danger">Cancelar</button>
                    </div>
              </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection