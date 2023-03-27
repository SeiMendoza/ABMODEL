@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Registro de Kiosko')
@section('miga')
    <li class="breadcrumb-item text-sm"> <a class="opacity-5 text-dark" href="{{ route('kiosko_res.index') }}">Kioskos</a></li>
    <li class="breadcrumb-item text-sm"> <a class="opacity-5 text-dark" href="{{ route('kiosko.index') }}">Administración</a>
    </li>
    <li class="breadcrumb-item text-sm active text-dark active">Registro</li>
@endsection

@section('content')

    <div class="row">
        <h4 class="col" style="margin-left:25px; margin-top:15px ">Registro Kiosko</h4>
        <a class="col-2 text-center text-primary " style="margin-top:15px" href="{{ route('kiosko.index') }}"><i
                class="fa fa-users"></i> Ver listado de kioskos</a>
    </div>

    <div class="container" style="margin-left:20px; margin-rigth: 20px">
 
            <br>
            <div class="">
                <form method="post" action="{{ route('kiosko.store') }}" enctype="multipart/form-data" style="margin:1px">
                    @csrf
                    <div class="row">
                        <div class="col-3">
                            <div>
                                <img src="" alt="" width="250px" height="250px" id="imagenmostrada">
                                <br>
                                <input type="file" id="imagen" name="imagen" accept="image/*" required
                                    value="{{ old('imagenPrevisualizacion') }}" style="color: white;width: 200px;">
                                @error('imagen')
                                    <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                @enderror
                            </div>
                        </div>
    
                        <div class="col-9">
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="codigo">Código</label>
                                    <input name="codigo" type="num" class="form-control" id="codigo" maxlength="5"
                                        required placeholder="Código de Kiosko" value="{{ old('codigo') }}">
                                    @error('codigo')
                                        <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="description">Descripcion</label>
                                    <textarea name="descripcion" type="tex-area" class="form-control text-area" id="descripcion" required
                                        placeholder="Descripcion del Kiosko">{{ old('descripcion') }}</textarea>
                                    @error('descripcion')
                                        <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="form-group col-md-4">
                                    <label for="cantidadDeMesas">Cantidad de Mesas</label>
                                    <input name="cantidad_de_Mesas" type="number" class="form-control" id="cantidadDeMesas"
                                        placeholder="Cantidad de Mesas en el kiosko" value="2" required>
                                    @error('cantidad_de_Mesas')
                                        <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col-md-8">
                                    <label for="ubicacion">Ubicación</label>
                                    <input name="ubicacion" type="text" class="form-control" id="ubicacion" required
                                        placeholder="Ubicacion del Kiosko" value="{{ old('ubicacion') }}">
                                    @error('ubicacion')
                                        <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
    
                            <div class="row">
                                <div class="form-row">
                                    <div class="form-group col-md-4">
                                        <label for="mesasContenidas">Mesas</label>
                                        <select name="mesasContenidas" id="mesasContenidas" class="form-control">
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
