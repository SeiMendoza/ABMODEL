@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Administración de menú')
@section('miga')
    <li class="breadcrumb-item text-sm active text-dark active">
        <a class="opacity-5 text-dark" href="">Administración Restaurante</a>
    </li>
@endsection

@section('b')
    <h3 class="font-weight-bolder opacity-8  text-gray mb-0" style="position: absolute; left:15px; top:100%;">Administración de Menú</h3>
    <div class="" style="position:absolute; right:2%; top:100%">
        <a href="{{route('cliente_prueba')}}" style="margin:0;width:200px; padding:6px;" class="bg-light border-radius-md h-6 text-center text-gray font-weight-bolder">
            <i class="fa fa-users"></i>   Ver menu cliente
        </a>
    </div>
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

        
    </script>

    <div class="">
        <div class="row bg bg-warning" style="position: absolute; top:12%; margin:0;width:1225px;">
            <ul class="nav d-flex justify-content-center h5 text-center" role="tablist" >

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

    <br><br><br><br>

    <!--Menu de Productos-->
    <div class="table-responsive" id="pills-tabContent">
        <section class="NovidadesSection" style="">
            <main class="main-content position-relative border-radius-lg">
                <div class="tab-content" id="pills-tabContent">

                    <!--Bebidas-->
                    <div class="tab-pane fade " id="pills-bebidas" role="tabpanel" aria-labelledby="pills-Pdisponible-tab">
                        <div class="container-fluid" style="padding: 0px">

                            <!-- Botón registrar-->
                            <div >
                                <a href="{{route('bebidasyplatillos.create')}}" style="position: absolute; left:0%; top:100% margin:0; width:150px; padding:4px;" class="bg-light border-radius-md h-6 text-center text-gray font-weight-bolder">
                                    <i class=""></i class="fa fa-plus-circle">Registrar Bebida</a>
                            </div>

                            <!--Navegacion entre disponibles y no disponibles--> 
                            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="BDisponibles-tab" data-bs-toggle="tab"
                                        data-bs-target="#BDisponibles" role="tab" aria-controls="BDisponibles"
                                        aria-selected="true">Disponibles</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="BNoDisponibles-tab" data-bs-toggle="tab"
                                        data-bs-target="#BNoDisponibles" role="tab" aria-controls="BNoDisponibles"
                                        aria-selected="false">No Disponibles</a>
                                </li>
                            </ul>


                            <div class="tab-content" id="myTabContent" style="height: 500px; overflow-x: hidden;">
                                
                                <!-- Bedidas Disponibles -->
                                <div class="tab-pane fade show active" id="BDisponibles" role="tabpanel" aria-labelledby="BDisponibles-tab">
                                    <div class="table-responsive container-fluid">
                                        <br>
                                        <table class="table menu" class="table" id="BDisponibles" style="">
                                            <thead>                                            
                                                <tr>
                                                    <th scope="col">N</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Disponibles</th>
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
                                                @forelse($bebidas as $p)
                                                    @if ($p->estado == 1)
                                                        @php
                                                            $exits = true;
                                                            $i++;
                                                        @endphp

                                                        <tr>
                                                            <th scope="col">@php echo $i  @endphp</th>
                                                            <td scope="col">{{ $p->nombre }}</td>
                                                            <td scope="col">{{ $p->disponible }}</td>
                                                            <td scope="col">{{ $p->precio }}</td>
                                                            <td scope="col">
                                                                <i data-bs-toggle="modal"
                                                                    data-bs-target="#desactivarBebida{{ $p->id }}">
                                                                    <a class="fa fa-times-circle text-warning"></a>
                                                                    Desactivar</i>
                                                                <form
                                                                    action="{{ route('bebida.activar', ['id' => $p->id]) }}"
                                                                    method="post" enctype="m    ultipart/form-data">
                                                                    @method('put')
                                                                    @csrf
                                                                    <div class="modal fade"
                                                                        id="desactivarBebida{{ $p->id }}"
                                                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                                                        tabindex="-1"
                                                                        aria-labelledby="staticBackdropLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="staticBackdropLabel">Desactivar
                                                                                        Bebida</h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    ¿Está seguro de desactivar la bebida:
                                                                                    <strong>{{ $p->nombre }}</strong>?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <input id="activar" name="activar" style="display:none"  value="0">
                                                                                    <button type="submit" class="btn btn-danger">Si</button>
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                            <td scope="col"><a
                                                                    href="{{ route('bebida.editar', ['id' => $p->id]) }}"><i
                                                                        class="fa fa-edit text-success"></i></a></td>
                                                            <td scope="col">
                                                                <i data-bs-toggle="modal"
                                                                    data-bs-target="#staticBackdropEb{{ $p->id }}"
                                                                    class="fa-solid fa-trash-can text-danger"
                                                                    style="color:crimson"></i>
                                                                <form
                                                                    action="{{ route('bebida.borrar', ['id' => $p->id]) }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <div class="modal fade"
                                                                        id="staticBackdropEb{{ $p->id }}"
                                                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                                                        tabindex="-1"
                                                                        aria-labelledby="staticBackdropLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="staticBackdropLabel">Eliminar
                                                                                        producto</h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    ¿Está seguro de eliminar la bebida:
                                                                                    <strong>{{ $p->nombre }}</strong>?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" class="btn btn-danger">Si</button>
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                @endforelse

                                                @if (!$exits)
                                                    <tr>
                                                        <td colspan="7" style="text-align: center;color: gray;">No hay
                                                            bebidas disponibles <br> </td>
                                                    </tr>
                                                @endif                                                    

                                            </tbody>
                                        </table>
                                    </div> 
                                </div>

                                <!-- Bedidas no Disponibles -->
                                <div class="tab-pane fade" id="BNoDisponibles" role="tabpanel" aria-labelledby="BNoDisponibles-tab">
                                    <div class="table-responsive container-fluid">
                                        <br>
                                        <table class="table menu" class="table" id="BNoDisponibles" style="">
                                            <thead>                                            
                                                <tr>
                                                    <th scope="col">N</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Disponibles</th>
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
                                                @forelse($bebidas as $p)
                                                    @if ($p->estado == 0)
                                                        @php
                                                            $exits = true;
                                                            $i++;
                                                        @endphp
                                                        <tr>
                                                            <th scope="col">@php echo $i  @endphp</th>
                                                            <td scope="col">{{ $p->nombre }}</td>
                                                            <td scope="col">{{ $p->disponible }}</td>
                                                            <td scope="col">{{ $p->precio }}</td>
                                                            <td scope="col">
                                                                <i data-bs-toggle="modal"
                                                                    data-bs-target="#activarBebida{{ $p->id }}">
                                                                    <a class="fa fa-check-circle text-success"></a>
                                                                    Activar</i>
                                                                <form
                                                                    action="{{ route('bebida.activar', ['id' => $p->id]) }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @method('put')
                                                                    @csrf
                                                                    <div class="modal fade"
                                                                        id="activarBebida{{ $p->id }}"
                                                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                                                        tabindex="-1"
                                                                        aria-labelledby="staticBackdropLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="staticBackdropLabel">Activar
                                                                                        Bebida</h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    ¿Está seguro de activar la bebida:
                                                                                    <strong>{{ $p->nombre }}</strong>?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <input id="activar" name="activar"
                                                                                        style="display:none"
                                                                                        value="1">                                                                                        
                                                                                    <button type="submit" class="btn btn-danger">Si</button>
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                                
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                            <td scope="col"><a
                                                                    href="{{ route('bebida.editar', ['id' => $p->id]) }}"><i
                                                                        class="fa fa-edit text-success"></i></a></td>
                                                            <td scope="col">
                                                                <i data-bs-toggle="modal"
                                                                    data-bs-target="#staticBackdropE{{ $p->id }}"
                                                                    class="fa-solid fa-trash-can text-danger"
                                                                    style="color:crimson"></i>
                                                                <form
                                                                    action="{{ route('bebida.borrar', ['id' => $p->id]) }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <div class="modal fade"
                                                                        id="staticBackdropE{{ $p->id }}"
                                                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                                                        tabindex="-1"
                                                                        aria-labelledby="staticBackdropLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="staticBackdropLabel">Eliminar
                                                                                        producto</h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    ¿Está seguro de eliminar la bebida:
                                                                                    <strong>{{ $p->nombre }}</strong>?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" class="btn btn-danger">Si</button>
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty
                                                    <tr>
                                                        <td colspan="7" style="text-align: center;color: gray;">No hay
                                                            bebidas<br> </td>
                                                    </tr>
                                                @endforelse

                                                @if (!$exits)
                                                    <tr>
                                                        <td colspan="7" style="text-align: center;color: gray;">Todas las
                                                            bebidas disponibles <br> </td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                    </div> 
                                </div>
                                                               
                            </div>
                            
                        </div>
                    </div>

                    <!--Platillos-->
                    <div class="tab-pane fade show active" id="pills-platillos" role="tabpanel"
                        aria-labelledby="pills-Pdisponible-tab">
                        <div class="container-fluid" style="padding: 0px">

                            <!-- Botón registrar-->
                             <div >
                                <a href="{{route('bebidasyplatillos.create')}}" style="position: absolute; left:0%; top:100% margin:0; width:150px; padding:4px;" class="bg-light border-radius-md h-6 text-center text-gray font-weight-bolder">
                                    <i class=""></i class="fa fa-plus-circle">Registrar Platillo</a>
                            </div>

                            <!--Navegacion entre disponibles y no disponibles--> 
                            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link active" id="PDisponibles-tab" data-bs-toggle="tab"
                                        data-bs-target="#PDisponibles" role="tab" aria-controls="PDisponibles"
                                        aria-selected="true">Disponibles</a>
                                </li>
                                <li class="nav-item" role="presentation">
                                    <a class="nav-link" id="PNoDisponibles-tab" data-bs-toggle="tab"
                                        data-bs-target="#PNoDisponibles" role="tab" aria-controls="PNoDisponibles"
                                        aria-selected="false">No Disponibles</a>
                                </li>
                            </ul>

                            <div class="tab-content" id="myTabContent" style="height: 500px; overflow-x: hidden;">

                                <!--Platillos Disponibles-->
                                <div class="tab-pane fade show active" id="PDisponibles" role="tabpanel" aria-labelledby="PDisponibles-tab">
                                    
                                    <div class="table-responsive container-fluid">
                                        <br>

                                        <table class="table menu" class="table" id="PlatillosDisponibles" style="">
                                            <thead>
                                                <tr>
                                                    <th scope="col">N</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Disponibles</th>
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

                                                @forelse($platillos as $p)

                                                    @if ($p->estado == 1)
                                                        @php
                                                            $exits = true;
                                                            $i++;
                                                        @endphp

                                                        <tr>

                                                            <th scope="col">@php echo $i  @endphp</th>
                                                            <td scope="col">{{ $p->nombre }}</td>
                                                            <td scope="col">{{ $p->disponible }}</td>
                                                            <td scope="col">{{ $p->precio }}</td>
                                                            <td scope="col">
                                                                <i data-bs-toggle="modal"
                                                                    data-bs-target="#activarPlatillo{{ $p->id }}">
                                                                    <a class="fa fa-times-circle text-warning"></a>
                                                                    Desactivar</i>
                                                                <form
                                                                    action="{{ route('platillo.activar', ['id' => $p->id]) }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @method('put')
                                                                    @csrf
                                                                    <div class="modal fade"
                                                                        id="activarPlatillo{{ $p->id }}"
                                                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                                                        tabindex="-1"
                                                                        aria-labelledby="staticBackdropLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="staticBackdropLabel">Desactivar
                                                                                        Platillo</h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    ¿Está seguro de activar el platillo:
                                                                                    <strong>{{ $p->nombre }}</strong>?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <input id="activar" name="activar" style="display:none"  value="0">
                                                                                    <button type="submit" class="btn btn-danger">Si</button>
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                            <td scope="col"><a href="{{ route('plato.editar', ['id' => $p->id]) }}"><i class="fa fa-edit text-success"></i></a></td>
                                                            <td><i data-bs-toggle="modal" data-bs-target="#staticBackdropEe{{ $p->id }}" class="fa-solid fa-trash-can text-danger" style="color:crimson"></i>
                                                                <form
                                                                    action="{{ route('platillo.borrar', ['id' => $p->id]) }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <div class="modal fade"
                                                                        id="staticBackdropEe{{ $p->id }}"
                                                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                                                        tabindex="-1"
                                                                        aria-labelledby="staticBackdropLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"id="staticBackdropLabel">Eliminar Platillo</h5>
                                                                                </div>
                                                                                <div class="modal-body"> ¿Está seguro de eliminar el platillo: <strong>{{ $p->nombre }}</strong>?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" class="btn btn-danger">Si</button>
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>

                                                        </tr>
                                                    @endif
                                                @empty
                                                @endforelse

                                                @if (!$exits)
                                                    <tr>
                                                        <td colspan="7" style="text-align: center;color: gray;">No hay Platillos disponibles <br> </td>
                                                    </tr>
                                                @endif

                                            </tbody>
                                        </table>
                                    </div>
                                </div>

                                <!--Platillos No Disponibles-->
                                <div class="tab-pane fade" id="PNoDisponibles" role="tabpanel" aria-labelledby="PNoDisponibles-tab">

                                    <div class="table-responsive container-fluid">
                                        <br>

                                        <table class="table menu" class="table" id="PlatillosNoDisponibles" style="">
                                            <thead >
                                                <tr>
                                                    <th scope="col">N</th>
                                                    <th scope="col">Nombre</th>
                                                    <th scope="col">Disponibles</th>
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
                                                @forelse($platillos as $p)
                                                    @if ($p->estado == 0)
                                                        @php
                                                            $exits = true;
                                                            $i++;
                                                        @endphp
                                                        <tr>
                                                            <th scope="col">@php echo $i  @endphp</th>
                                                            <td scope="col">{{ $p->nombre }}</td>
                                                            <td scope="col">{{ $p->disponible }}</td>
                                                            <td scope="col">{{ $p->precio }}</td>
                                                            <td scope="col">
                                                                <i data-bs-toggle="modal"
                                                                    data-bs-target="#activarPlatillo{{ $p->id }}">
                                                                    <a class="fa fa-check-circle text-success"></a>
                                                                    Activar</i>
                                                                <form
                                                                    action="{{ route('platillo.activar', ['id' => $p->id]) }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @method('put')
                                                                    @csrf
                                                                    <div class="modal fade"
                                                                        id="activarPlatillo{{ $p->id }}"
                                                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                                                        tabindex="-1"
                                                                        aria-labelledby="staticBackdropLabel"
                                                                        aria-hidden="true">
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="staticBackdropLabel">Activar
                                                                                        Platillo</h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    ¿Está seguro de activar el platillo:
                                                                                    <strong>{{ $p->nombre }}</strong>?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <input id="activar" name="activar"
                                                                                        style="display:none"
                                                                                        value="1">                                                                                        
                                                                                    <button type="submit" class="btn btn-danger">Si</button>
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                                
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                            <td scope="col"><a
                                                                    href="{{ route('plato.editar', ['id' => $p->id]) }}"><i
                                                                        class="fa fa-edit text-success"></i></a></td>
                                                            <td scope="col">
                                                                <i data-bs-toggle="modal"
                                                                    data-bs-target="#staticBackdropE{{ $p->id }}"
                                                                    class="fa-solid fa-trash-can text-danger"
                                                                    style="color:crimson"></i>
                                                                <form
                                                                    action="{{ route('platillo.borrar', ['id' => $p->id]) }}"
                                                                    method="post" enctype="multipart/form-data">
                                                                    @method('delete')
                                                                    @csrf
                                                                    <div class="modal fade"
                                                                        id="staticBackdropE{{ $p->id }}"
                                                                        data-bs-backdrop="static" data-bs-keyboard="false"
                                                                        tabindex="-1"
                                                                        aria-labelledby="staticBackdropLabel"
                                                                        aria-hidden="true">     
                                                                        <div class="modal-dialog">
                                                                            <div class="modal-content">
                                                                                <div class="modal-header">
                                                                                    <h5 class="modal-title"
                                                                                        id="staticBackdropLabel">Eliminar
                                                                                        producto</h5>
                                                                                </div>
                                                                                <div class="modal-body">
                                                                                    ¿Está seguro de eliminar el platillo:
                                                                                    <strong>{{ $p->nombre }}</strong>?
                                                                                </div>
                                                                                <div class="modal-footer">
                                                                                    <button type="submit" class="btn btn-danger">Si</button>
                                                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                                                </div>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </form>
                                                            </td>
                                                        </tr>
                                                    @endif
                                                @empty  
                                                @endforelse

                                                @if (!$exits)
                                                    <tr>
                                                        <td colspan="7" style="text-align: center;color: gray;">Todos
                                                            los Platillos están disponibles <br> </td>
                                                    </tr>
                                                @endif
                                            </tbody>
                                        </table>

                                    </div>
                                </div>

                            </div>

                        </div>
                    </div>

                    <!--Combos-->
                    <div class="tab-pane fade" id="pills-combos" role="tabpanel"
                        aria-labelledby="pills-Pdisponible-tab">
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
                                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search"
                                        style="">
                                        <div class="input-group">
                                            <input class="form-control" type="search" id="busqueda" name="busqueda"
                                                style="width: 200px" placeholder="Buscar combo" aria-label="Search"
                                                aria-describedby="basic-addon2" maxlength="50" required
                                                value="<?php if (isset($busqueda)) {
                                                    echo $busqueda;
                                                } ?>" />
                                            <button class="bg-success border-radius-md" type="submit"
                                                style="border: 0; color:aliceblue"><strong>Buscar</strong></button>
                                            @if (isset($busqueda))
                                                @if ($busqueda != null)
                                                    <a href="{{ route('busqueda.index') }}"
                                                        style="color:aliceblue; width:150px; padding:6px;"
                                                        class="bg-secondary border-radius-md h-6 text-center"><strong>Borrar
                                                            Busqueda</strong></a>
                                                @endif
                                            @endif
                                        </div>
                                    </form>
                                </div>
                            </div>

                        </div>

                    </div>

                </div>
            </main>
        </section>
    </div>

@endsection
