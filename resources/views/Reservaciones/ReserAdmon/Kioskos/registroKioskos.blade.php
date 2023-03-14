@extends('00_plantillas_Blade.plantilla_General1')
@section('title', 'Registro de Kiosko')

@section('contend')

    <div class="page-wrapper bg-primary p-t-170 p-b-100 font-robo">
        <br><br>
        <div class="wrapper wrapper--w960">
            <div class="card">
                <div class="card-body">
                    <h2 class="">Registro de Kioskos</h2>

                    <form method="post" action="{{ route('kiosko.store') }}" enctype="multipart/form-data">
                        @csrf
                        <div class="row">
                            <div class="col-4">
                                <div style="width:200px;float:left">
                                    <img src="" alt="" width="250px" height="250px" id="imagenmostrada">
                                    <br>
                                    <input type="file" id="imagen" name="imagen" accept="image/*" required value="{{ old('imagenPrevisualizacion') }}" style="color: white;width: 200px;">
                                    @error('imagen')
                                            <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-8">
                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="codigo">Código</label>
                                        <input name="codigo" type="num" class="form-control" id="codigo" maxlength="5"
                                        required placeholder="Código de Kiosko" value="{{ old('codigo') }}">
                                        @error('codigo')
                                            <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="description">Descripcion</label>
                                        <textarea name="descripcion" type="tex-area" class="form-control text-area" id="descripcion" required placeholder="Descripcion del Kiosko">{{ old('descripcion') }}</textarea>
                                        @error('descripcion')
                                            <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-group col-md-6">
                                        <label for="cantidadDeMesas">Cantidad de Mesas</label>
                                        <input name="cantidad_de_Mesas" type="number"  class="form-control" id="cantidadDeMesas"
                                            placeholder="Cantidad de Mesas en el kiosko" value="2" required>
                                        @error('cantidad_de_Mesas')
                                            <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="ubicacion">Ubicación</label>
                                        <input name="ubicacion" type="text" class="form-control" id="ubicacion" required placeholder="Ubicacion del Kiosko" value="{{ old('ubicacion') }}">
                                        @error('ubicacion')
                                            <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="form-row">
                                        <div class="form-group col-md-6">
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

                        <div id="espacio"><br></div>
                        <div style="float:right">
                            <button type="submit" class="btn btn-success">Guardar</button>
                            <button type="button" onclick="cancelar('kioskos')" class="btn btn-danger">Cancelar</button>
                        </div>


                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
