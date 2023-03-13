@extends('Reservaciones.ReserAdmon.Mesas.mesasIndex')
@section('content')
    <!-- ========== Reservaciones ========== -->
    <div class=""  id="reserva" style="">  
        <div class="nav d-flex justify-content-end " style="">
            <div class="" style="margin: 10px 0 0 10px">
                <form action="{{ route('mesas_res.search') }}" method="get" role="search" 
                    class="navbar-search" >
                    <div class="input-group">
                        <input class="form-control" type="search" id="buscar" name="buscar" style="width: 350px" 
                        placeholder="Buscar por nombre"aria-label="Search"
                        aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($text)) {echo $text;} ?>" />
                        <button class="bg-success border-radius-md" type="submit" style="border: 0; color:aliceblue"><strong>Buscar</strong></button>    
                        @if(isset($text)!="")
                        <a href="{{route('mesas_res.index')}}" type="button" style="color:aliceblue; width:150px; padding:6px;"  
                            class="bg-secondary border-radius-md h-6 text-center"><strong style="">Borrar Busqueda</strong></a>
                    @endif
                    </div>   
                </form>
            </div>
            <div style="margin: 10px 0 0 10px;" class=" nav-link-icon">
                <button type="button" data-bs-toggle="modal" 
                data-bs-target="#staticBackdrop" class="btn btn-success">
                <i class="ni ni-palette"></i> Agregar reservaciones</button>
                <!-- Modal Nuevo-->
                <form action="{{route('mesas_res.store')}}" method="post" id="nuevo" novalidate class="needs-validation" enctype="multipart/form-data">
                    @csrf
                    <div class="modal" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" 
                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                        <div class=" modal-dialog">
                        <div class="modal-content">
                            <div class="modal-header">
                            <h5 class="modal-title" id="staticBackdropLabel">Agregar una nueva reservación</h5>
                            </div>
                            <div class="modal-body">
                                <div class="form-floating mb-3">
                                    <input class="input--style-2 form-control" type="text" placeholder="Reservaciones" name="nombre" id="nombre"
                                    value="{{old('nombre')}}" required
                                    maxlength="25">
                                    <label for="nombre" class="form-label">Cliente</label>
                                    <div class="invalid-feedback">
                                        No puede estar vacio el nombre de la cliente
                                    </div>
                                    @error('nombre')
                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                    @enderror
                                </div>
                                <div class="form-floating">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" onclick="cancelar('mesas/reservaciones')" class="btn btn-secondary" >Cerrar</button>
                                <button onclick="" type="submit" class="btn btn-success">Comprendido</button>
                            </div>  
                            
                        </div>
                        </div>
                    </div>
                </form>
            </div>
            <div style="margin: 11px 0 0 10px;" class="nav-link-icon">                            
                <a href="{{ route('index') }}" type="button" class="bg-light border-radius-md h-6 text-center text-success" style="width:80px; padding:6px;">
                    <i class="ni ni-bold-left text-sm text-center opacity-10"></i>
                    Inicio</a>
            </div>
        </div>
         <!-- ========== Cards ========== -->
         <div class="">
            <div class="table-responsive container-fluid">
                <table class="table" id="table" style="background-color: #fff;">
                    <thead class="card-header border border-radius" style="color:teal; text-align:center">
                        <tr>
                            <th scope="col">N</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Estado</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservaciones as $r)
                             
                                <tr class="border border-light" style="color:teal; text-align:center">
                                    <th scope="col">{{$r->id}}</th>
                                    <td scope="col">{{$r->nombre}}</td> 
                                    <td scope="col">Activo</td>
                                    <td scope="col">
                                        <!-- Button trigger modal editar-->
                                        <button style="" 
                                        class="btn btn-warning button" type="button" data-bs-toggle="modal" 
                                        data-bs-target="#staticBackdrop{{$r->id}}">Editar
                                        </button>
                                        <!-- Modal Editar-->
                                        <form action="{{route('mesas_res.update', ['id' => $r->id])}}" method="post" id="actualizar" novalidate class="needs-validation" enctype="multipart/form-data">
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
                                                            <label for="nombre" class="form-label">Cliente</label>
                                                            <div class="invalid-feedback">
                                                                No puede estar vacio el nombre del cliente
                                                            </div>
                                                            @error('nombre')
                                                                <strong class="menerr" style="color:red">{{ $message }}</strong>
                                                            @enderror
                                                        </div>
                                                        <div class="form-floating">
                                                        </div>
                                                    </div>
                                                    <div class="modal-footer">
                                                        <button type="button" onclick="cancelar('mesas/reservaciones')" class="btn btn-secondary" >Cerrar</button>
                                                        <button onclick="" type="submit" class="btn btn-success">Comprendido</button>
                                                    </div>  
                                                    
                                                </div>
                                                </div>
                                            </div>
                                        </form>
                                    </td>
                                    <td scope="col">
                                        <!-- Button trigger modal eliminar-->
                                        <button style="" 
                                        class="btn btn-danger button" type="button" data-bs-toggle="modal" 
                                        data-bs-target="#staticBackdropE{{$r->id}}">Eliminar
                                        </button>
                                        <!-- Modal Eliminar-->
                                        <form action="{{route('mesas_res.destroy', ['id' => $r->id])}}" method="post" enctype="multipart/form-data">
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
                                    </td>
                                </tr>
                           
                        @empty
                           <tr>
                               <td colspan="7" style="text-align: center;color: teal;">No hay pedidos</td>
                           </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- ========== End Cards ========== --> 
@endsection

@section('pie')
    <div class="pagination justify-content-end"> 
        <div style="display:block; float:right;"> 
            {{$reservaciones->links()}}
        </div>
    </div>
@endsection