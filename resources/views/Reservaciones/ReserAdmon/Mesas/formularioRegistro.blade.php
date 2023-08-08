@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Registro')
@section('miga')
    <li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="{{ route('mesas_reg.index') }}">Lista de
            mesas</a></li>
    <li class="breadcrumb-item text-sm text-dark active text-white" aria-current="page">Registro de mesa</li>
@endsection
@section('tit', 'Registro de mesa')
@section('b')
    <div class="" style="">
        <a href="{{ $url }}" style="margin:0; padding:5px; width:150px; font-size:15px" type="button"
            class="bg-light border-radius-sm text-center">
            <i class="fa fa-arrow-left"></i> Regresar
        </a>
    </div>
@endsection
@section('content')
    <div class="">
        <div class="wrapper wrapper--w960">
            <div class="card border-radius-sm border-0" style="">
                <div class="card-body border-radius-sm border-0">
                    <form method="POST" action="{{ route('mesas_reg.store') }}" enctype="multipart/form-data">
                        @csrf
                        <h4 class="font-robo t" style="margin: 0; padding:0">Datos de la mesa: </h4>
                        <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="font-robo form-group">
                                    <label for="kiosko" style="margin-left: 0;">Kiosko al que pertenece: </label>
                                    @php
                                        $cod = "";
                                    @endphp
                                    <select name="kiosko" onchange="quitarerror()" id="kiosko" step="0.001" oninput="c($cod)"
                                        class="form-control border-radius-sm" required>
                                        
                                        @if (old('kiosko'))
                                            <option disabled="disabled" value="">Seleccione un kiosko</option>
                                            @foreach ($kiosko as $c)
                                                @if (old('kiosko') == $c->id)
                                                    <option selected="selected" value="{{ $c->id }}">
                                                        {{ $c->codigo }}
                                                    </option>
                                                    @php
                                                        $cod = $c->codigo;
                                                    @endphp
                                                @else
                                                    <option value="{{ $c->id }}">{{ $c->codigo }}</option>
                                                    @php
                                                        $cod = $c->codigo;
                                                    @endphp
                                                @endif
                                            @endforeach
                                        @else
                                            <option disabled="disabled" selected="selected" value="">Seleccione un
                                                kiosko</option>
                                            @foreach ($kiosko as $c)
                                                <option value="{{ $c->id }}">{{ $c->codigo }}</option>
                                                @php
                                                    $cod = $c->codigo;
                                                @endphp
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
                                    <label for="name" style="margin-left: 0;">Mesa:</label>
                                    <input class="form-control border-radius-sm" type="text" placeholder="Ingrese el numero de mesa 00"
                                        name="name" id="name" minlength="2" maxlength="2" step="0.001" oninput="c()"
                                        value="{{ old('name')}}" required>
                                    @error('name')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <div class="row row-space">
                            <div class="col-6">
                                <div class="font-robo form-group" style="margin-bottom: 5px">
                                    <label for="codigo" style="margin-left: 0;">Código: </label>
                                    <input class="form-control border-radius-sm" type="text" placeholder="K00-M00"
                                        name="codigo" id="codigo" minlength="7" maxlength="7" step="0.001"
                                        value="{{ old('codigo',)}}" required readonly>
                                    @error('codigo')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-6">
                                <div class="font-robo form-group" style="margin-bottom: 5px">
                                    <label for="cantidad" style="margin-left: 0;">Cantidad de personas: </label>
                                    <input class="form-control border-radius-sm" type="number"
                                        placeholder="Ingrese una cantidad" name="cantidad" id="cantidad"
                                        value="{{ old('cantidad') }}" minlength="1" maxlength="1" min="6"
                                        max="8" required>
                                    @error('cantidad')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                            </div>
                        </div>
                        <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
                        <div style="float: right;margin-top: 5px">
                            <button type="button" onclick="cancelar('mesas/lista')"
                                class="btn btn-danger">Cancelar</button>
                            <button onclick="" type="submit" class="btn btn-success">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script type="text/javascript">
        function c($cod) {
            try {
               var  a = "",
                    c = $cod,
                    d = document.getElementById("name").value || "";
                
                    a = "K00" + "-M" + d;
                
                document.getElementById("codigo").value = a;
            } catch (e) {}
        }
    </script>

@endsection
