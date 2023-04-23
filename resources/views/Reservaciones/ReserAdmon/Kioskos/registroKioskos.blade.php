@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Registro de Kiosko')
@section('miga')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="{{route('kiosko.index')}}">Administración de Kioskos</a></li>
<li class="breadcrumb-item text-sm active text-white active">Registro de Kioskos</li>
@endsection
@section('tit','Registro de Kiosko')
@section('b')
<div>
    <a href="{{ route('kiosko.index') }}" style="margin:0; padding:5px; width:160px;" type="button" class="bg-light border-radius-sm text-center ">
        <i class="fa fa-arrow-left"></i>  Regresar
    </a>
</div>
@endsection

@section('content')

    <div class="card border-radius-sm border-0" style="">            
        <div class="card-body border-radius-sm border-0">
            <div class="">
                <form method="post" action="{{ route('kiosko.store') }}" enctype="multipart/form-data" style="margin:1px">
                    @csrf
                    <div class="row">
                        <h4 class="font-robo t m-1" style="margin: 0; padding:0">Datos del kiosko</h4>
                        <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">

                        <div class="col">                           
                            <label for="">Seleccione una imagen</label>
                            <img src="" alt="" width="220px" height="220px" id="imagenmostrada">
                            <br>
                            <input type="file" id="imagen" name="imagen" accept="image/*"  value="{{ old('imagenPrevisualizacion') }}" style="color: white;width: 200px;">
                            @error('imagen')
                                    <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                            @enderror                             
                        </div>
    
                        <div class="col">
                            <div class="row">
                                <div class="form-group col">
                                    <label for="codigo">Código</label>
                                    <input name="codigo" type="num" class="form-control border-radius-sm" id="codigo" maxlength="5"
                                        required placeholder="Código de Kiosko" value="{{ old('codigo') }}">
                                    @error('codigo')
                                        <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="description">Descripcion</label>
                                    <textarea name="descripcion" type="tex-area" class="form-control text-area" id="descripcion" required
                                        placeholder="Descripcion del Kiosko">{{ old('descripcion') }}</textarea>
                                    @error('descripcion')
                                        <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="form-group col">
                                    <label for="cantidadDeMesas">Cantidad de Mesas</label>
                                    <input name="cantidad_de_Mesas" type="number" class="form-control border-radius-sm" id="cantidadDeMesas"
                                        placeholder="Cantidad de Mesas en el kiosko" value="2" required>
                                    @error('cantidad_de_Mesas')
                                        <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="ubicacion">Ubicación</label>
                                    <input name="ubicacion" type="text" class="form-control border-radius-sm" id="ubicacion" required
                                        placeholder="Ubicacion del Kiosko" value="{{ old('ubicacion') }}">
                                    @error('ubicacion')
                                        <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="form-row">
                                    <div class="form-group col-4">
                                        <label for="mesasContenidas">Mesas</label>
                                        <select name="mesasContenidas" id="mesasContenidas" class="form-control border-radius-sm">
                                            <option selected>Mesas que contiene</option>
                                            <option>...</option>
                                        </select>
    
                                    </div>
                                </div>
                            </div>
    
                        </div>
    
                    </div>
    
                    
                    <div class="row" style="float:center">
                        <div class="col text-end">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <button type="button" onclick="cancelar('kioskos')" class="btn btn-danger">Cancelar</button>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>

    <br><br>


@endsection
