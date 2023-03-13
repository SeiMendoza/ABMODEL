@extends('Reservaciones.ReserAdmon.Mesas.mesasIndex')
@section('content')
    <!-- ========== Registro ========== -->
        <div class=""  id="registro" style="">  
            <div class="nav d-flex justify-content-end " style="">
                <div class="" style="margin: 10px 0 0 10px">
                    <form action="{{ route('mesas_reg.search') }}" method="get" role="search" 
                        class="navbar-search" >
                        <div class="input-group">
                            <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 350px" 
                            placeholder="Buscar por nombre" aria-label="Search" 
                            aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($text)) {echo $text;} ?>" />
                            <button class="bg-success border-radius-md" type="submit" 
                                style="border: 0; color:aliceblue"><strong>Buscar</strong>
                            </button>    
                            @if(isset($text)!="")
                            <a href="{{route('mesas_reg.index')}}" type="button" style="color:aliceblue; width:150px; padding:6px;"  
                            class="bg-secondary border-radius-md h-6 text-center"><strong style="">Borrar Busqueda</strong></a>
                            @endif
                        </div>   
                    </form>
                </div>
                <div style="margin: 10px 0 0 10px;" class=" nav-link-icon">
                    <button type="button" data-bs-toggle="modal" 
                    data-bs-target="#staticBackdrop" class="btn btn-success">
                    <i class="ni ni-palette"></i> Agregar mesas</button>
                    <!-- Modal Nuevo-->
                    <form action="{{route('mesas_reg.store')}}" method="post" id="nuevo" novalidate class="needs-validation" enctype="multipart/form-data">
                        @csrf
                        <div class="modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" 
                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class=" modal-dialog">
                            <div class="modal-content">
                                <div class="modal-header">
                                <h5 class="modal-title" id="staticBackdropLabel">Agregar una nueva mesa</h5>
                                </div>
                                <div class="modal-body">
                                    <div class="form-floating mb-3">
                                        <input class="input--style-2 form-control" type="text" placeholder="Mesa" name="nombre" id="nombre"
                                        value="{{old('nombre')}}" required
                                        maxlength="25">
                                        <label for="nombre" class="form-label">Mesa</label>
                                        <div class="invalid-feedback">
                                            No puede estar vacio el nombre de la mesa
                                        </div>
                                        @error('nombre')
                                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                    <div class="form-floating">
                                        <input class="input--style-2 form-control" type="number" placeholder="Cantidad de personas" name="cantidad" id="cantidad" 
                                        value="{{old('cantidad')}}" required>
                                        <label for="cantidad" class="form-label">Cantidad de personas</label>
                                        <div class="invalid-feedback">
                                            No puede estar vacia la cantidad
                                        </div>
                                        @error('cantidad')
                                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                                        @enderror
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <button type="button" onclick="cancelar('mesas/registro')" class="btn btn-secondary" >Cerrar</button>
                                    <button onclick="" type="submit" class="btn btn-success">Comprendido</button>
                                </div>  
                                
                            </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
            <!-- ========== Cards ========== -->
            <div class="">
                @forelse ($registros as $r)
                    <div class="d-flex justify-content-center mb-0" style="display: block; float:left; padding: 0px 0px 10px 10px;">
                        <div class="card mb-1 bg-light rounded" 
                            style="background: url('/images/ivancik.jpg') top center/cover no-repeat; height:250px; width:200px;">
                            <h5 class="card-title pt-2 text-center text-white" style="background-color: rgba(2, 102, 0, 0.727);">{{$r->nombre}}</h5>
                            <div class="card-body" style="padding:0px;">
                                <h6 class="text-white text-center" style="position: absolute; width:200px; bottom: 19%;
                                    background-color: rgba(2, 102, 0, 0.727);">Cantidad de Personas: <span class="precio">{{$r->cantidad}}</span>
                                </h6>
                                <div class="d-flex justify-content-center" style="position: absolute; width:200px; bottom: 0;
                                    background-color: rgba(2, 102, 0, 0.727);">
                                    <!-- Button trigger modal eliminar-->
                                    <button style="display:block; float:right; width:95px; margin-right:5px" 
                                        class="btn btn-danger button" type="button" data-bs-toggle="modal" 
                                        data-bs-target="#staticBackdropE{{$r->id}}">Eliminar
                                    </button>
                                    <!-- Modal Eliminar-->
                                    <form action="{{route('mesas_reg.destroy', ['id' => $r->id])}}" method="post" enctype="multipart/form-data">
                                        @method('delete')
                                        @csrf
                                        <div class="modal fade" id="staticBackdropE{{$r->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" 
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class="modal-dialog">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                    <h5 class="modal-title" id="staticBackdropLabel">Eliminar a: {{$r->nombre}}</h5>
                                                    </div>
                                                    <div class="modal-body">
                                                    
                                                    </div>
                                                    <div class="modal-footer">
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                                                    <button type="submit" class="btn btn-danger">Comprendido</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </form>
                                    <!-- Button trigger modal editar-->
                                    <button style="display:block; float:left; width: 80px;" 
                                        class="btn btn-warning button" type="button" data-bs-toggle="modal" 
                                        data-bs-target="#staticBackdrop{{$r->id}}">Editar
                                    </button>
                                    <!-- Modal Editar-->
                                    <form action="{{route('mesas_reg.update', ['id' => $r->id])}}" method="post" id="actualizar" novalidate class="needs-validation" enctype="multipart/form-data">
                                        @method('put')
                                        @csrf
                                        <div class="modal" id="staticBackdrop{{$r->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" 
                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                            <div class=" modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                <h5 class="modal-title" id="staticBackdropLabel">Editar a: {{$r->nombre}}</h5>
                                                </div>
                                                <div class="modal-body">
                                                    <div class="form-floating mb-3">
                                                        <input class="input--style-2 form-control" type="text" placeholder="Mesa" name="nombre" id="nombre"
                                                        value="{{old('nombre', $r->nombre)}}" required
                                                        maxlength="25">
                                                        <label for="nombre" class="form-label">Mesa</label>
                                                        <div class="invalid-feedback">
                                                            No puede estar vacio el nombre de la mesa
                                                        </div>
                                                        @error('nombre')
                                                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                    <div class="form-floating">
                                                        <input class="input--style-2 form-control" type="number" placeholder="Cantidad de personas" name="cantidad" id="cantidad" 
                                                        value="{{old('cantidad', $r->cantidad)}}" required>
                                                        <label for="cantidad" class="form-label">Cantidad de personas</label>
                                                        <div class="invalid-feedback">
                                                            No puede estar vacia la cantidad
                                                        </div>
                                                        @error('cantidad')
                                                            <strong class="menerr" style="color:red">{{ $message }}</strong>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="button" onclick="cancelar('mesas/registro')" class="btn btn-secondary" >Cerrar</button>
                                                    <button onclick="" type="submit" class="btn btn-success">Comprendido</button>
                                                </div>  
                                                
                                            </div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="col d-flex justify-content-center mb-4">
                        <h5 class="card-title pt-2 text-center text-dark"
                            style="">No hay registros que mostrar</h5>
                    </div>
                @endforelse
            </div>
            <div class="pagination justify-content-end"> 
               
                </div>
            <!-- ========== End Cards ========== -->
        </div>
    <!-- ========== End ========== -->
@endsection