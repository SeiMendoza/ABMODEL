@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Mesas-Editar')
@section('miga')
<li class="breadcrumb-item text-sm text-dark" aria-current="page">Mesas</li>
<li class="breadcrumb-item text-sm"><a class="opacity-5 text-dark"
    href="{{route('mesas_reg.index')}}">Registro de Mesas</a></li>
<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Nueva Mesa</li>
@endsection
@section('content')
<div class="container">
    <div class="row d-flex justify-content-center" >
        <div class="card" style="background: #008d504f" >
            <div style="text-center">
                <h2 class="m-0 font-weight-bold" style="color: white">Nueva Mesa</h2>
            </div>
             <BR>
            <form action="{{route("mesas_reg.store")}}" method="post" id="nuevo" novalidate class="needs-validation" enctype="multipart/form-data">
                @csrf
                    <div class="d-grid justify-content-center" style="">
                        <div class="row text-center">
                        <h5 class="" id="staticBackdropLabel">Nuevo</h5>
                        </div>
                        <div class="d-grid justify-content-center">
                            <div class="form-floating mb-3">
                                <input class="input--style-2 form-control" type="text" placeholder="######" name="codigo" id="codigo"
                                value="{{old('codigo')}}" required
                                maxlength="15">
                                <label for="codigo" class="form-label">Código</label>
                                <div class="invalid-feedback">
                                    No puede estar vacio 
                                </div>
                                @error('codigo')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input class="input--style-2 form-control" type="text" placeholder="Mesa" name="nombre" id="nombre"
                                value="{{old('nombre')}}" required
                                maxlength="50">
                                <label for="nombre" class="form-label">Mesa</label>
                                <div class="invalid-feedback">
                                    No puede estar vacio 
                                </div>
                                @error('nombre')
                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                @enderror
                            </div>
                            <div class="form-floating mb-3">
                                <input class="input--style-2 form-control" type="text" placeholder="Mesa" name="cantidad" id="cantidad"
                                value="{{old('cantidad')}}" required maxlength="3" minlength="1"
                                max="20" min="1">
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
            </form>
        </div>
    </div>
</div>
@endsection