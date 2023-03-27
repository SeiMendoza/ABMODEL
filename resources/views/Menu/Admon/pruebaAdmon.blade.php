@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Menu Administracion')
@section('miga')
    <li class="breadcrumb-item text-sm">
        <a class="opacity-5 text-dark" href="#">Restaurante</a>
    </li>
    <li class="breadcrumb-item text-sm active text-dark active">Menu Admon</li>
@endsection

@section('content')
    <script>
        var msg = '{{ Session::get('mensaje') }}';
        var exist = '{{ Session::has('mensaje') }}';
        if (exist) {
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: msg,
                showConfirmButton: false,
                toast: true,
                background: '#fff',
                timer: 5500
            })
        }

        function activarProducto(id, e, nombre, ruta){


            let form = document.getElementById('formcheckDesactivar');

            if (e == 'activar') {
                form = document.getElementById('formcheckActivar');
            }

            Swal
            .fire({
                title: 'Estado',
                text: "¿Desea " + e + " " + nombre +"?",
                icon: 'question',
                showCancelButton: true,
                confirmButtonText: "Si",
                cancelButtonText: "No",
            })
            .then(resultado => {
                if (resultado.value) {
                    form.submit();
                } else {
                    // Dijeron que no
                }
            });


        }

        function eliminarProducto(id, nombre, ruta){

            Swal
            .fire({
                title: 'Eliminar',
                text: "¿Está seguro de eliminar a " + nombre + "?",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonText: "Si",
                cancelButtonText: "No",
            })
            .then(resultado => {
                if (resultado.value) {
                    //form.submit();
                } else {
                    // Dijeron que no
                }
            });
        }

    </script>

    <div class="row">
        <h4 class="col">Administración de Menú</h4>
        <a class="col-2 text-center text-danger" href="{{ route('cliente_prueba') }}"><i class="fa fa-users"></i> Ver menu cliente</a>
    </div>

    <div class="row">
        <div class="container-fluid">
            <ul class="nav d-flex justify-content-center h5 text-center" role="tablist"
                style="background-color: #ef3f3f; rounde">

                <li class="nav-item" role="presentation">
                    <a class="nav-link text-white" id="pills-bebidas-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-bebidas" type="button" role="tab" aria-controls="pills-bebidas"
                        aria-selected="true">Bebidas</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link active text-white" id="pills-platillos-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-platillos" type="button" role="tab" aria-controls="pills-platillos"
                        aria-selected="false">Platillos</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link text-white" id="pills-combos-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-combos" type="button" role="tab" aria-controls="pills-combos"
                        aria-selected="false">Combos</a>
                </li>
            </ul>
        </div>
    </div>

    <!--Menu de Productos-->
    <div class="table-responsive" id="pills-tabContent"
        style="height: 595px; overflow-y: scroll; overflow-x: hidden; scroll-behavior: smooth;">
        <section class="NovidadesSection" style="">
            <main class="main-content position-relative border-radius-lg">
                <div class="tab-content" id="pills-tabContent">

                    <!--Bebidas-->
                    <div class="tab-pane fade " id="pills-bebidas" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="container-fluid" style="padding: 0px">
                           
                            <div class="">
                                <div class="row">
                                    <!--Boton Registrar-->
                                    <div class="col-2 text-center" style="margin: 4px">
                                        <a class="btn btn-menu" style="margin: 4px" href="{{route('bebidasyplatillos.create')}}">
                                            Registrar Bebida</a>
                                    </div>

                                    <!--Barra de busqueda-->
                                    
                                    <div class="col-8 p-2" style="display:; magin:2px">
                                        <form action="{{ route('busqueda.index') }}" method="get" role="search" 
                                          class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" style="">
                                           <div class="input-group">
                                                <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 200px" 
                                                placeholder="Buscar bebida" aria-label="Search" 
                                                    aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($busqueda)) {echo $busqueda;} ?>" />
                                                    <button class="bg-success border-radius-md" type="submit" style="border: 0; color:aliceblue"><strong>Buscar</strong></button>    
                                                    @if(isset($busqueda))
                                                            @if($busqueda != null)
                                                                <a href="{{ route('busqueda.index') }}" 
                                                                style="color:aliceblue; width:150px; padding:6px;"  
                                                                class="bg-secondary border-radius-md h-6 text-center"><strong>Borrar Busqueda</strong></a>
                                                    @endif
                                                    @endif
                                           </div>   
                                        </form>
                                     </div>  
                                    
                                </div>

                                <div class="table-responsive container-fluid">
                                    <table class="table" id="table" style="background-color: #fff;">
                                        <thead class="card-header border border-radius" style="color:rgba(244, 48, 48, 0.765); text-align:center">
                                             <tr>
                                                <td colspan="7"> <h5 style="text-align: center;color: rgba(244, 48, 48, 0.928);">DISPONIBLES</h5></td>
                                            </tr>
                                            <tr> 
                                                <th scope="col">N</th>
                                                <th scope="col">Nombre</th>
                                                <th scope="col">Cantidad Disp.</th>
                                                <th scope="col">Precio</th>
                                                <th scope="col">Acción</th>
                                                <th scope="col">Editar</th>
                                                <th scope="col">Eliminar</th>
                                            </tr>
                                        </thead>
                                            <tbody>
                                                @php $exits = false; $i=0 @endphp                                                
                                                @forelse($bebidas as $p)
                                                    @if ($p->estado == 1) 
                                                        @php $exits = true;  $i++ @endphp
                                                   
                                                        <tr class="border border-light" style="color:gray; text-align:center">
                                                            <th scope="col">@php echo $i  @endphp</th>
                                                            <td scope="col">{{$p->nombre}}</td> 
                                                            <td scope="col">{{$p->disponible}}</td> 
                                                            <td scope="col">{{$p->precio}}</td>
                                                            <td scope="col"><a class="btn" onclick="activarProducto( {{ $p->id }} , 'desactivar', '{{ $p->nombre }}', 'bebida/{id}/activar')"><i class="fa fa-times-circle text-warning"></i> Desactivar</a></td>
                                                            
                                                            <form  id="formcheckActivar{{ $p->id }}" action="{{ route('bebida.activar', ['id' => $p->id]) }}" method="POST">
                                                                @method('put')
                                                                @csrf
                                                                <div style="display:none">
                                                                    <input type="number hidden" id="activar" name="activar" value="0">
                                                                </div>
                                                                <input style="display:none" type="submit" class="btn btn-danger" value="Si">
                                                            </form>

                                                            <td scope="col" ><a href="{{route('bebida.editar', ['id' => $p->id])}}"><i class="fa fa-edit text-success"></i></a></td>
                                                            <td scope="col">
                                                                <form name="formBorrar{{ $p->id }}" action="{{route('bebida.borrar', ['id' => $p->id])}}" method="post" enctype="multipart/form-data">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <a role="button" onclick="eliminarProducto({{ $p->id }}, '{{ $p->nombre }}', 'bebida/{id}/borrar')" type="submit" style="border: 0; padding:0; margin:0;"><i class="fa fa-delete-left text-danger" style="border: 0; padding:0; margin:0;"></i></a>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                @endforelse

                                                @if (!$exits)
                                                    <tr>
                                                        <td colspan="7" style="text-align: center;color: gray;">No hay bebidas disponibles <br> </td>
                                                    </tr>
                                                    
                                                @endif

                                                <tr>
                                                    <td colspan="7"> <h5 style="text-align: center;color: rgb(120, 117, 117);">NO DISPONIBLES</h5></td>
                                                </tr>

                                                @php $exits = false; $i=0 @endphp                                                
                                                @forelse($bebidas as $p)
                                                    @if ($p->estado == 0) 

                                                        @php $exits = true;  $i++ @endphp                                                                                                  
                                                        <tr class="border border-light" style="color:gray; text-align:center">
                                                            <th scope="col">@php echo $i  @endphp</th>
                                                            <td scope="col">{{$p->nombre}}</td> 
                                                            <td scope="col">{{$p->disponible}}</td> 
                                                            <td scope="col">{{$p->precio}}</td>
                                                            <td scope="col" ><a class="btn" onclick="activarProducto( {{ $p->id }} , 'activar', '{{ $p->nombre }}', 'bebida/{id}/activar')"><i class="fa fa-check-circle text-success"></i> Activar</a></td>

                                                            <form  id="formcheckDesactivar" action="{{ route('bebida.activar', ['id' => $p->id]) }}" method="POST">
                                                                @method('put')
                                                                @csrf
                                                                <div style="display:none">
                                                                    <input type="number" id="activar" name="activar" value="1">
                                                                </div>
                                                                <input style="display:none" type="submit" class="btn btn-danger" value="Si">
                                                            </form>
                                                            <td scope="col" ><a href="{{route('bebida.editar', ['id' => $p->id])}}"><i class="fa fa-edit text-success"></i></a></td>
                                                            <td scope="col">
                                                                <form  name="formEliminarDes{{ $p->id }}" action="{{route('bebida.borrar', ['id' => $p->id])}}" method="post" enctype="multipart/form-data">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <a role="button" onclick="eliminarProducto({{ $p->id }}, '{{ $p->nombre }}', 'bebida/{id}/borrar')"  type="submit" style="border: 0; padding:0; margin:0;"><i class="fa fa-delete-left text-danger" style="border: 0; padding:0; margin:0;"></i></a>
                                                                </form>
                                                                <!-- Modal Eliminar-->
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                    <tr>
                                                        <td colspan="7" style="text-align: center;color: gray;">No hay bebidas<br> </td>
                                                    </tr>                                                
                                                @endforelse

                                                @if (!$exits)
                                                    <tr>
                                                        <td colspan="7" style="text-align: center;color: gray;">Todas las bebidas disponibles <br> </td>
                                                    </tr>                                                    
                                                @endif
                                        
                                            </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>

                    <!--Platillos-->
                    <div class="tab-pane fade show active" id="pills-platillos" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="container-fluid" style="padding: 0px">
                            <div class="row">

                                <!--Boton Registrar-->
                                <div class="col-2 text-center" style="margin: 4px">
                                    <a class="btn btn-menu" href="{{route('bebidasyplatillos.create')}}"
                                        style="margin: 4px">Registrar Platillo</a>
                                </div>

                                <!--Barra de busqueda-->
                                <div class="col-8 p-2" style="display:; magin:2px">
                                    <form action="{{ route('busqueda.index') }}" method="get" role="search" 
                                      class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" style="">
                                       <div class="input-group">
                                            <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 200px" 
                                                placeholder="Buscar platillo" aria-label="Search" 
                                                 aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($busqueda)) {echo $busqueda;} ?>" />
                                                <button class="bg-success border-radius-md" type="submit" style="border: 0; color:aliceblue"><strong>Buscar</strong></button>    
                                                @if(isset($busqueda))
                                                     @if($busqueda != null)
                                                         <a href="{{ route('busqueda.index') }}" 
                                                         style="color:aliceblue; width:150px; padding:6px;"  
                                                         class="bg-secondary border-radius-md h-6 text-center"><strong>Borrar Busqueda</strong></a>
                                                    @endif
                                                 @endif
                                       </div>   
                                    </form>
                                </div>
                            </div>

                            <div class="table-responsive container-fluid">
                                <table class="table" id="table" style="background-color: #fff;">
                                    <thead class="card-header border border-radius" style="color:rgba(244, 48, 48, 0.765); text-align:center">
                                         <tr>
                                            <td colspan="7"> <h5 style="text-align: center;color: rgba(244, 48, 48, 0.928);">DISPONIBLES</h5></td>
                                        </tr>
                                        <tr> 
                                            <th scope="col">N</th>
                                            <th scope="col">Nombre</th>
                                            <th scope="col">Cantidad Disp.</th>
                                            <th scope="col">Precio</th>
                                            <th scope="col">Acción</th>
                                            <th scope="col">Editar</th>
                                            <th scope="col">Eliminar</th>
                                        </tr>
                                    </thead>
                                        <tbody>
                                            @php $exits = false; $i=0 @endphp                                                
                                            @forelse($platillos as $p)
                                                @if ($p->estado == 1) 
                                                    @php $exits = true;  $i++ @endphp
                                               
                                                    <tr class="border border-light" style="color:gray; text-align:center">
                                                        <th scope="col">@php echo $i  @endphp</th>
                                                        <td scope="col">{{$p->nombre}}</td> 
                                                        <td scope="col">{{$p->disponible}}</td> 
                                                        <td scope="col">{{$p->precio}}</td>
                                                        <td scope="col"><a class="btn" onclick="activarProducto( {{ $p->id }} , 'desactivar', '{{ $p->nombre }}', 'platillo/{id}/activar')"><i class="fa fa-times-circle text-warning"></i> Desactivar</a></td>
                                                        
                                                        <form  id="formcheckActivar{{ $p->id }}" action="{{ route('platillo.activar', ['id' => $p->id]) }}" method="POST">
                                                            @method('put')
                                                            @csrf
                                                            <div style="display:none">
                                                                <input type="number hidden" id="activar" name="activar" value="0">
                                                            </div>
                                                            <input style="display:none" type="submit" class="btn btn-danger" value="Si">
                                                        </form>

                                                        <td scope="col" ><a href="{{route('plato.editar', ['id' => $p->id])}}"><i class="fa fa-edit text-success"></i></a></td>
                                                        <td scope="col">
                                                            <form name="formEliminarPlatilloActivo{{ $p->id }}" action="{{route('platillo.borrar', ['id' => $p->id])}}" method="post" enctype="multipart/form-data">
                                                                @method('delete')
                                                                @csrf
                                                                <a onclick="eliminarProducto({{ $p->id }}, '{{ $p->nombre }}', 'platillo/{id}/borrar')"  role="button" type="submit" style="border: 0; padding:0; margin:0;"><i class="fa fa-delete-left text-danger" style="border: 0; padding:0; margin:0;"></i></a>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endif
                                            @empty
                                            @endforelse

                                            @if (!$exits)
                                                <tr>
                                                    <td colspan="7" style="text-align: center;color: gray;">No hay bebidas disponibles <br> </td>
                                                </tr>
                                                
                                            @endif

                                            <tr>
                                                <td colspan="7"> <h5 style="text-align: center;color: rgb(120, 117, 117);">NO DISPONIBLES</h5></td>
                                            </tr>

                                            @php $exits = false; $i=0 @endphp                                                
                                            @forelse($platillos as $p)
                                                @if ($p->estado == 0) 

                                                    @php $exits = true;  $i++ @endphp                                                                                                  
                                                    <tr class="border border-light" style="color:gray; text-align:center">
                                                        <th scope="col">@php echo $i  @endphp</th>
                                                        <td scope="col">{{$p->nombre}}</td> 
                                                        <td scope="col">{{$p->disponible}}</td> 
                                                        <td scope="col">{{$p->precio}}</td>
                                                        <td scope="col" ><a class="btn" onclick="activarProducto( {{ $p->id }}, 'activar', '{{ $p->nombre }}', 'platillo/{id}/activar')"><i class="fa fa-check-circle text-success"></i> Activar</a></td>

                                                        <form  id="formcheckDesactivar" action="{{ route('platillo.activar', ['id' => $p->id]) }}" method="POST">
                                                            @method('put')
                                                            @csrf
                                                            <div style="display:none">
                                                                <input type="number" id="activar" name="activar" value="1">
                                                            </div>
                                                            <input style="display:none" type="submit" class="btn btn-danger" value="Si">
                                                        </form>
                                                        <td scope="col" ><a href="{{route('plato.editar', ['id' => $p->id])}}"><i class="fa fa-edit text-success"></i></a></td>
                                                        <td scope="col">
                                                            <form action="{{route('platillo.borrar', ['id' => $p->id])}}" method="post" enctype="multipart/form-data">
                                                                @method('delete')
                                                                @csrf
                                                                <a onclick="eliminarProducto({{ $p->id }}, '{{ $p->nombre }}', 'platillo/{id}/borrar')"  role="button" type="submit" style="border: 0; padding:0; margin:0;"><i class="fa fa-delete-left text-danger" style="border: 0; padding:0; margin:0;"></i></a>
                                                            </form>
                                                            <!-- Modal Eliminar-->
                                                        </td>
                                                    </tr>
                                                @endif
                                            @empty
                                                <tr>
                                                    <td colspan="7" style="text-align: center;color: gray;">No hay bebidas<br> </td>
                                                </tr>                                                
                                            @endforelse

                                            @if (!$exits)
                                                <tr>
                                                    <td colspan="7" style="text-align: center;color: gray;">Todas las bebidas disponibles <br> </td>
                                                </tr>                                                    
                                            @endif
                                    
                                        </tbody>
                                </table>
                            </div>

                        </div>
                    </div>

                    <!--Combos-->
                    <div class="tab-pane fade" id="pills-combos" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="table-responsive container-fluid">

                            <div class="row">
                                <!--Boton Registrar-->
                                <div class="col-2 text-start" style="margin: 4px">
                                    <a href={{ route('combo.create') }} class="btn btn-menu"
                                        style="margin: 4px">Registrar combo</a>
                                </div>

                                <!--Barra de busqueda-->
                                <div class="col-8 p-2" style="display:; magin:2px">
                                    <form action="{{ route('busqueda.index') }}" method="get" role="search" 
                                      class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" style="">
                                       <div class="input-group">
                                            <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 200px" 
                                                placeholder="Buscar combo" aria-label="Search" 
                                                 aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($busqueda)) {echo $busqueda;} ?>" />
                                                <button class="bg-success border-radius-md" type="submit" style="border: 0; color:aliceblue"><strong>Buscar</strong></button>    
                                                @if(isset($busqueda))
                                                     @if($busqueda != null)
                                                         <a href="{{ route('busqueda.index') }}" 
                                                         style="color:aliceblue; width:150px; padding:6px;"  
                                                         class="bg-secondary border-radius-md h-6 text-center"><strong>Borrar Busqueda</strong></a>
                                                    @endif
                                                 @endif
                                       </div>   
                                    </form>
                                </div>
                            </div>
                           
                            <table class="table" id="table" style="background-color: #fff;">
                                <thead class="card-header border border-radius" style="color:rgba(244, 48, 48, 0.765); text-align:center">
                                    <tr>
                                        <td colspan="7">
                                            <h5 style="text-align: center;color: rgba(244, 48, 48, 0.928);">DISPONIBLES</h5>
                                        </td>
                                    </tr>
                                    <tr>
                                        <th scope="col">N</th>
                                        <th scope="col">Nombre</th>
                                        <th scope="col">Precio</th>
                                        <th scope="col">Acción</th>
                                        <th scope="col">Editar</th>
                                        <th scope="col">Eliminar</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $exits = false;
                                        $i = 0;
                                    @endphp
                                    @forelse($combos as $p)
                                        @if ($p->estado == 1)
                                            @php
                                                $exits = true;
                                                $i++;
                                            @endphp
                        
                                            <tr class="border border-light" style="color:gray; text-align:center">
                                                <th scope="col">@php echo $i  @endphp</th>
                                                <td scope="col">{{ $p->nombre }}</td>
                                                <td scope="col">{{ $p->precio }}</td>
                                                <td scope="col"><a class="btn"
                                                        onclick="activarProducto( {{ $p->id }} , 'desactivar', '{{ $p->nombre }}', 'combo/{id}/activar')"><i
                                                            class="fa fa-times-circle text-warning"></i> Desactivar</a></td>
                        
                                                <form id="formcheckActivar{{ $p->id }}"
                                                    action="{{ route('combo.activar', ['id' => $p->id]) }}" method="POST">
                                                    @method('put')
                                                    @csrf
                                                    <div style="display:none">
                                                        <input type="number hidden" id="activar" name="activar" value="0">
                                                    </div>
                                                    <input style="display:none" type="submit" class="btn btn-danger" value="Si">
                                                </form>
                        
                                                <td scope="col"><a href="{{ route('bebida.editar', ['id' => $p->id]) }}"><i
                                                            class="fa fa-edit text-success"></i></a></td>
                                                <td scope="col">
                                                    <form name="formEliminarPlatilloActivo{{ $p->id }}"
                                                        action="{{ route('combo.borrar', ['id' => $p->id]) }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @method('delete')
                                                        @csrf
                                                        <a onclick="eliminarProducto({{ $p->id }}, '{{ $p->nombre }}', 'combo/{id}/borrar')"
                                                            role="button" type="submit" style="border: 0; padding:0; margin:0;"><i
                                                                class="fa fa-delete-left text-danger"
                                                                style="border: 0; padding:0; margin:0;"></i></a>
                                                    </form>
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                    @endforelse
                        
                                    @if (!$exits)
                                        <tr>
                                            <td colspan="7" style="text-align: center;color: gray;">No hay bebidas disponibles <br> </td>
                                        </tr>
                                    @endif
                        
                                    <tr>
                                        <td colspan="7">
                                            <h5 style="text-align: center;color: rgb(120, 117, 117);">NO DISPONIBLES</h5>
                                        </td>
                                    </tr>
                        
                                    @php
                                        $exits = false;
                                        $i = 0;
                                    @endphp
                                    @forelse($combos as $p)
                                        @if ($p->estado == 0)
                                            @php
                                                $exits = true;
                                                $i++;
                                            @endphp
                                            <tr class="border border-light" style="color:gray; text-align:center">
                                                <th scope="col">@php echo $i  @endphp</th>
                                                <td scope="col">{{ $p->nombre }}</td>
                                                <td scope="col">{{ $p->precio }}</td>
                                                <td scope="col"><a class="btn"
                                                        onclick="activarProducto( {{ $p->id }}, 'activar', '{{ $p->nombre }}', 'combo/{id}/activar')"><i
                                                            class="fa fa-check-circle text-success"></i> Activar</a></td>
                        
                                                <form id="formcheckDesactivar" action="{{ route('combo.activar', ['id' => $p->id]) }}"
                                                    method="POST">
                                                    @method('put')
                                                    @csrf
                                                    <div style="display:none">
                                                        <input type="number" id="activar" name="activar" value="1">
                                                    </div>
                                                    <input style="display:none" type="submit" class="btn btn-danger" value="Si">
                                                </form>
                                                <td scope="col"><a href="{{ route('bebida.editar', ['id' => $p->id]) }}"><i
                                                            class="fa fa-edit text-success"></i></a></td>
                                                <td scope="col">
                                                    <form action="{{ route('combo.borrar', ['id' => $p->id]) }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @method('delete')
                                                        @csrf
                                                        <a onclick="eliminarProducto({{ $p->id }}, '{{ $p->nombre }}', 'combo/{id}/borrar')"
                                                            role="button" type="submit" style="border: 0; padding:0; margin:0;"><i
                                                                class="fa fa-delete-left text-danger"
                                                                style="border: 0; padding:0; margin:0;"></i></a>
                                                    </form>
                                                    <!-- Modal Eliminar-->
                                                </td>
                                            </tr>
                                        @endif
                                    @empty
                                        <tr>
                                            <td colspan="7" style="text-align: center;color: gray;">No hay bebidas<br> </td>
                                        </tr>
                                    @endforelse
                        
                                    @if (!$exits)
                                        <tr>
                                            <td colspan="7" style="text-align: center;color: gray;">Todas las bebidas disponibles <br> </td>
                                        </tr>
                                    @endif
                        
                                </tbody>
                            </table>
                        </div>
                        
                    </div>

                </div>
            </div>
        </div>
    </div>

@endsection
