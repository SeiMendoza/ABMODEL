@extends('00_plantillas_Blade.plantilla_General1')
@section('title', 'Registro de producto de piscina')

@section('contend')

    <div class="page-wrapper bg-primary p-t-170 p-b-100 font-robo">
        <br><br>
        <div class="wrapper wrapper--w960">
            <div class="card">
                <div class="card-body">
                    <h2 class="">Registro de producto de piscina</h2>
<br>
                    <form method="post" action="{{ route('piscina.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div style="margin-left:2%;float:left;width:47%">
                            <input class="input--style-2" type="text" placeholder="Nombre del producto" name="nombre" id="nombre"
                            value="@if(Session::has('nombre')){{Session::get('nombre')}}@else{{old('nombre')}}@endif"
                            maxlength="25"  onkeypress="quitarerror()">
                            @error('nombre')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div style="margin-left:2%;float:left;width:47%;margin-top: 15px">
                            <select name="tipo" onchange="quitarerror()" id="tipo">
                                @if (old('tipo'))
                                    <option disabled="disabled" value="">Selecciona el tipo de producto</option> 
                                    @foreach ($tipo as $c)
                                        @if (old('tipo') == $c->id)
                                            <option selected="selected" value="{{$c->id}}">{{$c->descripcion}}</option>
                                        @else
                                            <option value="{{$c->id}}">{{$c->descripcion}}</option>
                                        @endif
                                    @endforeach 
                                @else
                                    <option disabled="disabled" selected="selected" value="">Selecciona el tipo de producto</option> 
                                    @foreach ($tipo as $c)
                                        <option value="{{$c->id}}">{{$c->descripcion}}</option>
                                    @endforeach 
                                @endif
                            </select>
                            @error('tipo')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div style="margin-left:2%;float:left;width:47%;margin-top: 30px">
                            <input class="input--style-2" type="text" name="expiracion" id="expiracion"
                            value="@if(Session::has('expiracion')){{Session::get('expiracion')}}@else{{old('expiracion')}}@endif"
                            onkeypress="quitarerror()" placeholder="Tiempo de expiracion">
                            @error('expiracion')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div style="margin-left:2%;float:left;width:47%;margin-top: 45px">
                            <select name="uso" onchange="quitarerror()" id="uso">
                                @if (old('uso'))
                                    <option disabled="disabled" value="">Selecciona el periodo de tiempo de uso</option> 
                                    @foreach ($uso as $c)
                                        @if (old('uso') == $c->id)
                                            <option selected="selected" value="{{$c->id}}">{{$c->descripcion}}</option>
                                        @else
                                            <option value="{{$c->id}}">{{$c->descripcion}}</option>
                                        @endif
                                    @endforeach 
                                @else
                                    <option disabled="disabled" selected="selected" value="">Selecciona el periodo de tiempo de uso</option> 
                                    @foreach ($uso as $c)
                                        <option value="{{$c->id}}">{{$c->descripcion}}</option>
                                    @endforeach 
                                @endif
                            </select>
                            @error('uso')
                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                            @enderror
                        </div>

                        <div style="float: right;margin-top: 50px">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <button type="button" onclick="cancelar('productos')"
                                class="btn btn-warning">Cancelar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <script>
        window.addEventListener('load',function(){
            document.getElementById('expiracion').type= 'text';
            document.getElementById('expiracion').addEventListener('blur',function(){
                if (document.getElementById('expiracion').value == '') {
                    document.getElementById('expiracion').type= 'text';
                }
            });
            document.getElementById('expiracion').addEventListener('focus',function(){
                document.getElementById('expiracion').type= 'date';
            });
        });
    </script>

@endsection
