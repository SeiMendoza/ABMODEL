@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Registro de Kiosko')
@section('miga')
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-white" href="{{route('kiosko.index')}}">Administración de Kioskos</a></li>
<li class="breadcrumb-item text-sm active text-white active">Edición</li>
@endsection
@section('tit', 'Edición de kiosko')
@section('b')
<div>
    <a onclick="cancelarAct('¿Desea regresar? Esto cancelará la actualización del kiosko', 'kioskos')" style="margin:0; padding:5px; width:160px;" type="button" class="bg-light border-radius-sm text-center ">
        <i class="fa fa-arrow-left"></i>  Regresar
    </a>
</div>
@endsection
@section('content')

    <div class="">
        <div class="wrapper wrapper--w960">
            <div class="card border-radius-sm border-0" style="">
                <div class="card-body border-radius-sm border-0">
                    <form method="post" action="{{ route('kiosko.update', ['id' => $k->id]) }}" enctype="multipart/form-data">
                        @method('PUT')
                        @csrf
                        <h4 class="font-robo t m-1" style="margin: 0; padding:0">Datos del kiosko</h4>
                        <hr class="m-1" style="border: 0.5px solid rgba(111, 143, 175, 0.600)">
                        <div class="row row-space">

                            <div class="col-3">
                                <div class="font-robo form-group">
                                    <img onclick="elegirImagen()" style="margin-left: 0;" src="{{ asset($k->imagen) }}" alt="" width="220px" height="220px" id="imagenmostrada">
                                    <br><br>
                                    <label id="label" for="imagen" style=" display:block ;margin:0; padding:5px; width:220px; overflow: hidden; white-space: nowrap; text-overflow: ellipsis;" class="btn btn-info text-center "> <i class="fa fa-file-image"></i> Cambiar imagen</label>
                                    <input type="file" class="files" id="imagen" name="imagen" accept="image/*"  value="{{ old('imagenPrevisualizacion') }}" onchange="colocarNombre();" style="display:none; color: rgb(0, 0, 0);">
                                    @error('imagen')
                                            <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-9">
                                <div class="form-group col" style="margin-left: 0;">
                                    <label for="codigo">Código</label>
                                    <input name="codigo" disabled type="text" class="form-control border-radius-sm" id="codigo" maxlength="3"
                                        required placeholder="K00" value="{{ $k->codigo }}">
                                    @error('codigo')
                                        <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="form-group col">
                                    <label for="description">Descripcion</label>
                                    <textarea name="descripcion" style="resize:none" type="tex-area" class="form-control text-area" id="descripcion" required
                                        placeholder="Descripcion del Kiosko">{{ $k->descripcion }}</textarea>
                                    @error('descripcion')
                                        <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="form-group col">
                                    <label for="ubicacion">Ubicación</label>
                                    <input name="ubicacion" type="text" class="form-control border-radius-sm" id="ubicacion" required
                                        placeholder="Ubicacion del Kiosko" value="{{ $k->ubicacion }}">
                                    @error('ubicacion')
                                        <span class="menerr" class="menerr" style="color:red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="row" style="float:center">
                            <div class="col text-end">
                                <button type="submit" class="btn btn-success">Actualizar</button>
                                <button type="button" onclick="cancelarAct('¿Desea cancelar la actualización del kiosko?', 'kioskos')" class="btn btn-danger">Cancelar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
