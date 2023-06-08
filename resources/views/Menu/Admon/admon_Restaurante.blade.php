@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Administración de menú')
@section('miga')
<li class="breadcrumb-item text-sm text-white active" aria-current="page">Administración de menú</li>
@endsection
@section('tit','Administración de menú')
@section('b')
    <!-- Botón registrar-->
    <div>
        <a href="{{route('bebidasyplatillos.create')}}" style="margin:0; padding:5px; width:200px;" type="button" class="bg-light border-radius-sm text-center">
            <i class="fa fa-plus-circle"></i> Agregar platillo o bebida
        </a>
    </div>

    <div>
        <a href="#" style="margin:0; padding:5px; width:200px;" type="button" class="bg-light border-radius-sm text-center m-2">
            <i class="fa fa-plus-circle"></i> Agregar complemento
        </a>
    </div>

    <div>
        <a href="{{route('cliente_prueba')}}" style="margin:0; padding:5px; width:160px;" type="button" class="bg-light border-radius-sm text-center ">
            <i class="fa fa-users"></i> Menú cliente
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
                timer: 3000
            })
        }
    </script>

    <br>
    <div>
        <div>
            <ul class="nav nav-pills nav-justified h5 " role="tablist" style="background-color:rgba(111, 143, 175, 0.200);">

                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark active" id="pills-bebidas-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-bebidas" type="button" role="tab" aria-controls="pills-bebidas"
                        aria-selected="true">Bebidas</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-platillos-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-platillos" type="button" role="tab" aria-controls="pills-platillos"
                        aria-selected="false">Platillos</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark" id="pills-complementos-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-complementos" type="button" role="tab" aria-controls="pills-complementos"
                        aria-selected="false">Complementos</a>
                </li>
            </ul>
        </div>
    </div>

    <br>
    
    <!--Menu de Productos-->
    <div class="table-responsive" id="pills-tabContent">
        <div class="tab-content" id="pills-tabContent">

            <!--Bebidas-->
            <div class="tab-pane fade show active" id="pills-bebidas" role="tabpanel" aria-labelledby="pills-Pdisponible-tab">
                <div class="container-fluid" style="padding: 0px">

                    <!--Navegacion entre disponibles y no disponibles-->
                    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-dark h6 active" id="BDisponibles-tab" data-bs-toggle="tab"
                                data-bs-target="#BDisponibles" role="tab" type="button" aria-controls="BDisponibles"
                                aria-selected="true">Disponibles</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-dark h6" id="BNoDisponibles-tab" data-bs-toggle="tab"
                                data-bs-target="#BNoDisponibles" role="tab" type="button" aria-controls="BNoDisponibles"
                                aria-selected="false">No Disponibles</a>
                        </li>
                    </ul>


                    <div class="tab-content" id="myTabContent" style="height: 500px; overflow-x: hidden;">

                        <!-- Bedidas Disponibles -->
                        <div class="tab-pane fade show active" id="BDisponibles" role="tabpanel" aria-labelledby="BDisponibles-tab">
                            <br>
                            <table class="table menu" id="BDisponibles" style="">
                                <thead>
                                    <tr>
                                        <th scope="col" style="text-align: center;">N</th>
                                        <th scope="col" style="text-align: center;">Nombre</th>
                                        <th scope="col" style="text-align: center;">Disponibles</th>
                                        <th scope="col" style="text-align: end;">Precio</th>
                                        <th scope="col" style="text-align: center;">Acción</th>
                                        <th scope="col" style="text-align: center;">Editar</th>
                                        <th scope="col" style="text-align: center;">Eliminar</th>
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
                                                <td scope="col" style="text-align: center;">@php echo $i  @endphp</td>
                                                <td scope="col" style="text-align: start;">{{ $p->nombre }}</td>
                                                <td scope="col" style="text-align: center;">{{ $p->disponible }}</td>
                                                <td scope="col" style="text-align: end;">L {{ $p->precio }}.00</td>
                                                <td scope="col" style="text-align: center;">
                                                    <i data-bs-toggle="modal" data-bs-target="#desactivarBebida{{ $p->id }}">
                                                        <a class="fa fa-times-circle text-warning"></a> Desactivar
                                                    </i>
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
                                                                        <input id="activar" name="activar"
                                                                            style="display:none"
                                                                            value="0">
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Si</button>
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">No</button>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td scope="col" style="text-align: center;"><a
                                                        href="{{ route('bebida.editar', ['id' => $p->id]) }}"><i
                                                            class="fa fa-edit text-success"></i></a></td>
                                                <td scope="col" style="text-align: center;">
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
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Si</button>
                                                                        <button type="button"
                                                                            class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">No</button>
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
                                            <td colspan="7" style="text-align: center;color: gray;">No hay bebidas disponibles <br> </td>
                                        </tr>
                                    @endif

                                </tbody>
                            </table>

                        </div>

                        <!-- Bedidas no Disponibles -->
                        <div class="tab-pane fade" id="BNoDisponibles" role="tabpanel"
                            aria-labelledby="BNoDisponibles-tab">
                            <div class="table-responsive container-fluid">
                                <br>
                                <table class="table menu" class="table" id="BNoDisponibles" style="">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align: center;">N</th>
                                            <th scope="col" style="text-align: center;">Nombre</th>
                                            <th scope="col" style="text-align: center;">Disponibles</th>
                                            <th scope="col" style="text-align: end;">Precio</th>
                                            <th scope="col" style="text-align: center;">Acción</th>
                                            <th scope="col" style="text-align: center;">Editar</th>
                                            <th scope="col" style="text-align: center;">Eliminar</th>
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
                                                    <td scope="col" style="text-align: center">@php echo $i  @endphp</td>
                                                    <td scope="col" style="text-align: start">{{ $p->nombre }}</td>
                                                    <td scope="col" style="text-align: center">{{ $p->disponible }}</td>
                                                    <td scope="col" style="text-align: end">L {{ $p->precio }}.00</td>
                                                    <td scope="col" style="text-align: center">
                                                        <i data-bs-toggle="modal" data-bs-target="#activarBebida{{ $p->id }}">
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
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Si</button>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">No</button>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td scope="col" style="text-align: center"><a
                                                            href="{{ route('bebida.editar', ['id' => $p->id]) }}"><i
                                                                class="fa fa-edit text-success"></i></a></td>
                                                    <td scope="col" style="text-align: center">
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
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Si</button>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">No</button>
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
                                                <td colspan="7" style="text-align: center;color: gray;">Todas
                                                    las
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
            <div class="tab-pane fade" id="pills-platillos" role="tabpanel" aria-labelledby="pills-Pdisponible-tab">
                <div class="container-fluid" style="padding: 0px">

                    <!--Navegacion entre disponibles y no disponibles-->
                    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link active text-dark h6" id="PDisponibles-tab" data-bs-toggle="tab" data-bs-target="#PDisponibles" role="tab" type="button" aria-controls="PDisponibles" aria-selected="true">Disponibles</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-dark h6" id="PNoDisponibles-tab" data-bs-toggle="tab" data-bs-target="#PNoDisponibles" role="tab" type="button" aria-controls="PNoDisponibles" aria-selected="false">No Disponibles</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent" style="height: 500px; overflow-x: hidden;">
                        <!--Platillos Disponibles-->
                        <div class="tab-pane fade show active" id="PDisponibles" role="tabpanel"
                            aria-labelledby="PDisponibles-tab">

                            <div class="table-responsive container-fluid">
                                <br>

                                <table class="table menu" class="table" id="PlatillosDisponibles"
                                    style="">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align: center;">N</th>
                                            <th scope="col" style="text-align: center;">Nombre</th>
                                            <th scope="col" style="text-align: center;">Disponibles</th>
                                            <th scope="col" style="text-align: end;">Precio</th>
                                            <th scope="col" style="text-align: center;">Acción</th>
                                            <th scope="col" style="text-align: center;">Editar</th>
                                            <th scope="col" style="text-align: center;">Eliminar</th>
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

                                                    <td scope="col" style="text-align: center;">@php echo $i  @endphp</td>
                                                    <td scope="col" style="text-align: start;">{{ $p->nombre }}</td>
                                                    <td scope="col" style="text-align: center;">{{ $p->disponible }}</td>
                                                    <td scope="col" style="text-align: end;">L {{ $p->precio }}.00</td>
                                                    <td scope="col" style="text-align: center;">
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
                                                                            <input id="activar" name="activar"
                                                                                style="display:none"
                                                                                value="0">
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Si</button>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">No</button>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td scope="col" style="text-align: center;">
                                                        <a href="{{ route('plato.editar', ['id' => $p->id]) }}">
                                                            <i class="fa fa-edit text-success"></i>
                                                        </a>
                                                    </td>
                                                    <td scope="col" style="text-align: center;">
                                                        <i data-bs-toggle="modal"
                                                            data-bs-target="#staticBackdropEe{{ $p->id }}"
                                                            class="fa-solid fa-trash-can text-danger"
                                                            style="color:crimson"></i>
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
                                                                            <h5
                                                                                class="modal-title"id="staticBackdropLabel">
                                                                                Eliminar Platillo</h5>
                                                                        </div>
                                                                        <div class="modal-body"> ¿Está seguro de
                                                                            eliminar el platillo:
                                                                            <strong>{{ $p->nombre }}</strong>?
                                                                        </div>
                                                                        <div class="modal-footer">
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Si</button>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">No</button>
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
                                                    Platillos disponibles <br> </td>
                                            </tr>
                                        @endif

                                    </tbody>
                                </table>
                            </div>
                        </div>

                        <!--Platillos No Disponibles-->
                        <div class="tab-pane fade" id="PNoDisponibles" role="tabpanel"
                            aria-labelledby="PNoDisponibles-tab">

                            <div class="table-responsive container-fluid">
                                <br>

                                <table class="table menu" class="table" id="PlatillosNoDisponibles"
                                    style="">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align: center;">N</th>
                                            <th scope="col" style="text-align: center;">Nombre</th>
                                            <th scope="col" style="text-align: center;">Disponibles</th>
                                            <th scope="col" style="text-align: end;">Precio</th>
                                            <th scope="col" style="text-align: center;">Acción</th>
                                            <th scope="col" style="text-align: center;">Editar</th>
                                            <th scope="col" style="text-align: center;">Eliminar</th>
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
                                                    <td scope="col" style="text-align: center;">@php echo $i  @endphp</td>
                                                    <td scope="col" style="text-align: start;">{{ $p->nombre }}</td>
                                                    <td scope="col" style="text-align: center;">{{ $p->disponible }}</td>
                                                    <td scope="col" style="text-align: end;">L {{ $p->precio }}.00</td>
                                                    <td scope="col" style="text-align: center;">
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
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Si</button>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">No</button>

                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </form>
                                                    </td>
                                                    <td scope="col" style="text-align: center;"><a
                                                            href="{{ route('plato.editar', ['id' => $p->id]) }}"><i
                                                                class="fa fa-edit text-success"></i></a></td>
                                                    <td scope="col" style="text-align: center;">
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
                                                                            <button type="submit"
                                                                                class="btn btn-danger">Si</button>
                                                                            <button type="button"
                                                                                class="btn btn-secondary"
                                                                                data-bs-dismiss="modal">No</button>
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

            <!--complementos-->
            <div class="tab-pane fade" id="pills-complementos" role="tabpanel"
                aria-labelledby="pills-Cdisponible-tab">

                <div class="container-fluid" style="padding: 0px">  

                    <!--Navegacion entre disponibles y no disponibles-->
                    <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-dark h6 active" id="CPDisponibles-tab" data-bs-toggle="tab"
                                data-bs-target="#CDisponibles" role="tab" aria-controls="CDisponibles"
                                aria-selected="true">Disponibles</a>
                        </li>
                        <li class="nav-item" role="presentation">
                            <a class="nav-link text-dark h6" id="CNoDisponibles-tab" data-bs-toggle="tab"
                                data-bs-target="#CNoDisponibles" role="tab" aria-controls="CNoDisponibles"
                                aria-selected="false">No Disponibles</a>
                        </li>
                    </ul>

                    <div class="tab-content" id="myTabContent" style="height: 500px; overflow-x: hidden;">
                        <br>
                        <!--complementos Disponibles-->

                        <div class="tab-pane fade show active" id="CDisponibles" role="tabpanel"
                            aria-labelledby="CDisponibles-tab">
                            
                            <div class="table-responsive container-fluid">

                                <table class="table menu" class="table" id="CombosDisponibles"
                                    style="">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align: center;">N</th>
                                            <th scope="col" style="text-align: start;">Nombre</th>
                                            <th scope="col" style="text-align: end;">Precio</th>
                                            <th scope="col" style="text-align: center;">Acción</th>
                                            <th scope="col" style="text-align: center;">Editar</th>
                                            <th scope="col" style="text-align: center;">Eliminar</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php $i = 0;  @endphp
                                        @forelse($productos as $p)
                                            @if ($p->tipo == 0)
                                                @if ($p->estado == 1)
                                                    @php
                                                        $exits = true;
                                                        $i++;
                                                    @endphp
                                                    <tr>
                                                        <td scope="col" style="text-align: center;">@php echo $i  @endphp</td>
                                                        <td scope="col" style="text-align: start;">{{ $p->nombre }}</td>
                                                        <td scope="col" style="text-align: end;">L {{ $p->precio }}.00</td>
                                                        <td scope="col" style="text-align: center;">
                                                            <i data-bs-toggle="modal"
                                                                data-bs-target="#activarComplemento{{ $p->id }}">
                                                                <a class="fa fa-times-circle text-warning"></a>
                                                                Desactivar</i>
                                                            <form
                                                                action="{{ route('combo.activar', ['id' => $p->id]) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @method('put')
                                                                @csrf
                                                                <div class="modal fade"
                                                                    id="activarComplemento{{ $p->id }}"
                                                                    data-bs-backdrop="static" data-bs-keyboard="false"
                                                                    tabindex="-1"
                                                                    aria-labelledby="staticBackdropLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="staticBackdropLabel">Desactivar
                                                                                    complemento</h5>
                                                                            </div>
                                                                            <div class="modal-body"> ¿Está seguro de
                                                                                desactivar el complemento:
                                                                                <strong>{{ $p->nombre }}</strong>?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <input id="activar" name="activar"
                                                                                    style="display:none"
                                                                                    value="0">
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Si</button>
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">No</button>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                        <td scope="col" style="text-align: center;"><a
                                                                href="#"><i
                                                                    class="fa fa-edit text-success"></i></a></td>
                                                        <td scope="col" style="text-align: center;">
                                                            <i data-bs-toggle="modal"
                                                                data-bs-target="#eliminarComplemento{{ $p->id }}"
                                                                class="fa-solid fa-trash-can text-danger"
                                                                style="color:crimson"></i>
                                                            <form
                                                                action="{{ route('combo.borrar', ['id' => $p->id]) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @method('delete')
                                                                @csrf
                                                                <div class="modal fade"
                                                                    id="eliminarComplemento{{ $p->id }}"
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
                                                                                ¿Está seguro de eliminar el complemento:
                                                                                <strong>{{ $p->nombre }}</strong>?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Si</button>
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">No</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endif                                                
                                            @endif
                                        @empty
                                        @endforelse
                                    </tbody>
                                </table>

                            </div>

                        </div>

                        <!--complementos no Disponibles-->

                        <div class="tab-pane fade " id="CNoDisponibles" role="tabpanel"
                            aria-labelledby="CNoDisponibles-tab">

                            <div class="table-responsive container-fluid">

                                <table class="table menu" class="table" id="CombosNoDisponibles"
                                    style="">
                                    <thead>
                                        <tr>
                                            <th scope="col" style="text-align: center;">N</th>
                                            <th scope="col" style="text-align: satar;">Nombre</th>
                                            <th scope="col" style="text-align: end;">Precio</th>
                                            <th scope="col" style="text-align: center;">Acción</th>
                                            <th scope="col" style="text-align: center;">Editar</th>
                                            <th scope="col" style="text-align: center;">Eliminar</th>
                                        </tr>
                                    </thead>

                                    <tbody>
                                        @php
                                            $exits = false;
                                            $i = 0;
                                        @endphp
                                        @forelse($productos as $p)
                                            @if ($p->tipo == 0)
                                                @if ($p->estado == 0)
                                                    @php
                                                        $exits = true;
                                                        $i++;
                                                    @endphp
                                                    <tr>
                                                        <th scope="col" style="text-align: center;">@php echo $i  @endphp</th>
                                                        <td scope="col" style="text-align: start;">{{ $p->nombre }}</td>
                                                        <td scope="col" style="text-align: end;">L {{ $p->precio }}.00</td>
                                                        <td scope="col" style="text-align: center;">
                                                            <i data-bs-toggle="modal"
                                                                data-bs-target="#activarComplemento{{ $p->id }}">
                                                                <a class="fa fa-check-circle text-success"></a>
                                                                Activar</i>
                                                            <form
                                                                action="{{ route('combo.activar', ['id' => $p->id]) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @method('put')
                                                                @csrf
                                                                <div class="modal fade"
                                                                    id="activarComplemento{{ $p->id }}"
                                                                    data-bs-backdrop="static" data-bs-keyboard="false"
                                                                    tabindex="-1"
                                                                    aria-labelledby="staticBackdropLabel"
                                                                    aria-hidden="true">
                                                                    <div class="modal-dialog">
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <h5 class="modal-title"
                                                                                    id="staticBackdropLabel">Activar
                                                                                    Complemento</h5>
                                                                            </div>
                                                                            <div class="modal-body"> ¿Está seguro de
                                                                                activar el complemento:
                                                                                <strong>{{ $p->nombre }}</strong>?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <input id="activar" name="activar"
                                                                                    style="display:none"
                                                                                    value="1">
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Si</button>
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">No</button>

                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                        <td scope="col" style="text-align: center;"><a
                                                                href="{{ route('combo.editar', ['id' => $p->id]) }}"><i
                                                                    class="fa fa-edit text-success"></i></a></td>
                                                        <td scope="col" style="text-align: center;">
                                                            <i data-bs-toggle="modal"
                                                                data-bs-target="#eliminarCombo{{ $p->id }}"
                                                                class="fa-solid fa-trash-can text-danger"
                                                                style="color:crimson"></i>
                                                            <form
                                                                action="{{ route('combo.borrar', ['id' => $p->id]) }}"
                                                                method="post" enctype="multipart/form-data">
                                                                @method('delete')
                                                                @csrf
                                                                <div class="modal fade"
                                                                    id="eliminarCombo{{ $p->id }}"
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
                                                                                ¿Está seguro de eliminar el complemento:
                                                                                <strong>{{ $p->nombre }}</strong>?
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="submit"
                                                                                    class="btn btn-danger">Si</button>
                                                                                <button type="button"
                                                                                    class="btn btn-secondary"
                                                                                    data-bs-dismiss="modal">No</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            </form>
                                                        </td>
                                                    </tr>
                                                @endif                                                
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

        </div>
    </div>

@endsection
