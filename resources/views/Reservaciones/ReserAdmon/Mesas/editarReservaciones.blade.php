@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Mesas-Editar')
@section('miga')
<li class="breadcrumb-item text-sm text-dark" aria-current="page">Mesas</li>
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
    href="{{route('mesas_res.index')}}">Reservaciones de Mesas</a></li>
<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Editar {{$reservacion->nombre}}</li>
@endsection
@section('content')
<form action="{{route('mesas_reg.update', ['id' => $reservacion->id])}}" method="post" id="actualizar" novalidate class="needs-validation" enctype="multipart/form-data">
    @method('put')
    @csrf
        <div class="container">
            <div class="">
            <h5 class="" id="staticBackdropLabel">Editar a: {{$reservacion->nombre}}</h5>
            </div>
            <div class="">
                <div class="form-floating mb-3">
                    <input class="input--style-2 form-control" type="text" placeholder="Mesa" name="codigo" id="codigo"
                    value="{{old('codigo', $reservacion->codigo)}}" required
                    maxlength="25">
                    <label for="codigo" class="form-label">Codigo</label>
                    <div class="invalid-feedback"
                        No puede estar vacio 
                    </div>
                    @error('codigo')
                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-floating">
                    <input class="input--style-2 form-control" type="text" placeholder="Mesa" name="nombre" id="nombre"
                    value="{{old('nombre', $reservacion->nombre)}}" required
                    maxlength="25">
                    <label for="nombre" class="form-label">Mesa</label>
                    <div class="invalid-feedback">
                        No puede estar vacio 
                    </div>
                    @error('nombre')
                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                    @enderror
                </div>
                <div class="form-floating">
                    <input class="input--style-2 form-control" type="text" placeholder="Mesa" name="cantidad" id="cantidad"
                    value="{{old('cantidad', $reservacion->cantidad)}}" required
                    maxlength="25">
                    <label for="cantidad" class="form-label">Cantidad de personas</label>
                    <div class="invalid-feedback">
                        No puede estar vacio 
                    </div>
                    @error('cantidad')
                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                    @enderror
                </div>
            </div>
            <div class="">
                <button type="button" onclick="cancelar('mesas/registro')" class="btn btn-secondary" >Cerrar</button>
                <input onclick="" type="submit" class="btn btn-success"></input>
            </div>  
            
        </div>
        </div>
    </div>
</form>
@endsection