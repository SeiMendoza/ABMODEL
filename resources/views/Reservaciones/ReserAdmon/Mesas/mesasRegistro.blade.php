@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Mesas')
@section('miga')
<li class="breadcrumb-item text-sm text-dark" aria-current="page">Mesas</li>
<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Registro de mesas</li>
@endsection
@section('content')
    <!-- ========== Registro ========== -->
        <div class=""  id="registro" style="">  
            <div style="margin: 11px 0 0 10px; display:block; float:left" class="nav-link-icon">                            
                <a href="{{ route('mesas_res.index') }}" type="button" class="bg-light border-radius-md h-6 text-center text-success" style="width:300px; padding:6px;">
                    <i class="ni ni-bold-left text-sm text-center opacity-10"></i>
                    Ir a reservaciones de mesas</a>
            </div>
            <div class="nav d-flex justify-content-end " style="">
                <div class="" style="margin: 10px 0 0 10px">
                    <form action="{{ route('mesas_reg.search') }}" method="get" role="search" 
                        class="navbar-search" >
                        <div class="input-group">
                            <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 350px" 
                            placeholder="Buscar por nombre" aria-label="Search" 
                            aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($text)) {echo $text;} ?>"/>
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
                <div class="table-responsive container-fluid">
                    <table class="table" id="table" style="background-color: #fff;">
                        <thead class="card-header border border-radius" style="color:teal; text-align:center">
                            <tr>
                                <th scope="col">N</th>
                                <th scope="col">Codigo</th>
                                <th scope="col">Mesa</th>
                                <th scope="col">Cantidad de personas</th>
                                <th scope="col">Kiosko</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($registros as $i => $r)
                                 
                                    <tr class="border border-light" style="color:teal; text-align:center">
                                        <th scope="col">{{++$i}}</th>
                                        <td scope="col">{{$r->codigo}}</td>
                                        <td scope="col">{{$r->nombre}}</td> 
                                        <td scope="col">{{$r->cantidad}}</td>
                                        <td scope="col">{{$r->kiosko_id}}</td>
                                        <td scope="col" ><a href="{{route('mesas_reg.edit', ['id' => $r->id])}}"><i class="fa fa-edit"></i></a></td>
                                        <td>
                                            <form action="{{route('mesas_reg.destroy', ['id' => $r->id])}}" method="POST" 
                                            enctype="multipart/form-data" style="display: inline-black;" id="eliminar">
                                              @method('delete')
                                              @csrf
                                              <a type="button" onclick="eliminar()"> <i class="fa fa-delete-left"></i></a>
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
    <!-- ========== End ========== -->
@endsection

@section('pie')
    <div class="pagination justify-content-end"> 
        <div style="display:block; float:right;"> 
            {{$registros->links()}}
        </div>
    </div>

    <script>
        function eliminar(){
    
    Swal
    .fire({
        title: "Eliminar",
        text: "¿Desea eliminar el registro?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Si",
        cancelButtonText: "No",
    })
    .then(resultado => {
        if (resultado.value) {
            // Hicieron click en "Sí"
            document.getElementById('eliminar').submit();
        } else {
            // Dijeron que no
        }
    });

}
    </script>
@endsection
