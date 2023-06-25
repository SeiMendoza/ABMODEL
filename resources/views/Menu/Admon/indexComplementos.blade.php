@extends('00_plantillas_Blade.plantilla_admonMenu')
@section('b')
    <!-- Botón registrar -->
    <div>
        <a href="{{ route('bebidasyplatillos.create', ['origen' => 0]) }}" style="margin:8px; padding:5px; width:200px;"
            type="button" class="bg-light border-radius-sm text-center">
            <i class="fa fa-plus-circle"></i> Agregar Productos
        </a>
    </div>
    <div>
        <a href="{{ route('cliente_prueba') }}" style="margin:0; padding:5px; width:160px;" type="button"
            class="bg-light border-radius-sm text-center ">
            <i class="fa fa-users"></i> Menú cliente
        </a>
    </div>
@endsection
@section('selection')
    <div>
        <div>
            <ul class="nav nav-tabs nav-justified h5 " role="tablist" style="background-color:rgba(111, 143, 175, 0.200);">

                <li class="nav-item" role="presentation">
                    <a href="{{ route('menuAdmon.bebidas') }}" class="nav-link text-dark" id="pills-bebidas-tab"
                        data-bs-toggle="" data-bs-target="#pills-bebidas" type="button" role="tab"
                        aria-controls="pills-bebidas" aria-selected="false">Bebidas</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a href="{{ route('menuAdmon.platillos') }}" class="nav-link text-dark" id="pills-platillos-tab"
                        data-bs-toggle="" data-bs-target="#pills-platillos" type="button" role="tab"
                        aria-controls="pills-platillos" aria-selected="false">Platillos</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a href="{{ route('menuAdmon.complementos') }}" class="nav-link text-dark active"
                        id="pills-complementos-tab" data-bs-toggle="" data-bs-target="#pills-complementos" type="button"
                        role="tab" aria-controls="pills-complementos" aria-selected="true">Complementos</a>
                </li>
            </ul>
        </div>
    </div>
@endsection
@section('show')

    <!--complementos-->
    <div class="tab-pane fade show active" id="pills-complementos" role="tabpanel" aria-labelledby="pills-Cdisponible-tab">

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
                        aria-selected="false">No
                        Disponibles</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent" style="height: 500px; overflow-x: hidden;">
                <br>
                <!--complementos Disponibles-->

                <div class="tab-pane fade show active" id="CDisponibles" role="tabpanel" aria-labelledby="CDisponibles-tab">

                    <div class="table-responsive container-fluid">

                        <table class="table menu" class="table" id="complementosDisponibles" style="">
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
                                @php $i = 0; @endphp
                                @forelse($productos as $p)
                                    @if ($p->tipo == 0)
                                        @if ($p->estado == 1)
                                            @php
                                                $exits = true;
                                                $i++;
                                            @endphp
                                            <tr>
                                                <td scope="col" style="text-align: center;">@php echo $i @endphp</td>
                                                <td scope="col" style="text-align: start;">{{ $p->nombre }}</td>
                                                <td scope="col" style="text-align: end;">L {{ $p->precio }}.00</td>
                                                <td scope="col" style="text-align: center;">
                                                    <button data-bs-toggle="modal" data-bs-target="#activarComplemento{{ $p->id }}"><i class="fa fa-times-circle text-warning"></i> Desactivar</button>
                                                    <form action="{{ route('producto.activar', ['id' => $p->id]) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @method('put')
                                                        @csrf
                                                        <div class="modal fade" id="activarComplemento{{ $p->id }}"
                                                            data-bs-backdrop="static" data-bs-keyboard="false"
                                                            tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">
                                                                            Desactivar
                                                                            complemento</h5>
                                                                    </div>
                                                                    <div class="modal-body"> ¿Está seguro de
                                                                        desactivar el complemento:
                                                                        <strong>{{ $p->nombre }}</strong>?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input id="activar" name="activar"
                                                                            style="display:none" value="0">
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Si</button>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">No</button>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td scope="col" style="text-align: center;"><a
                                                        href="{{ route('producto.editar', ['id' => $p->id]) }}"><i
                                                            class="fa fa-edit text-success"></i></a></td>
                                                <td scope="col" style="text-align: center;">
                                                    <i data-bs-toggle="modal"
                                                        data-bs-target="#eliminarComplemento{{ $p->id }}"
                                                        class="fa-solid fa-trash-can text-danger"
                                                        style="color:crimson"></i>
                                                    <form action="{{ route('producto.borrar', ['id' => $p->id]) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal fade"
                                                            id="eliminarComplemento{{ $p->id }}"
                                                            data-bs-backdrop="static" data-bs-keyboard="false"
                                                            tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">
                                                                            Eliminar
                                                                            producto</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        ¿Está seguro de eliminar el complemento:
                                                                        <strong>{{ $p->nombre }}</strong>?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Si</button>
                                                                        <button type="button" class="btn btn-secondary"
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

                <div class="tab-pane fade " id="CNoDisponibles" role="tabpanel" aria-labelledby="CNoDisponibles-tab">

                    <div class="table-responsive container-fluid">

                        <table class="table menu" class="table" id="complementosNoDisponibles" style="">
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
                                @php $i = 0; @endphp
                                @forelse($productos as $p)
                                    @if ($p->tipo == 0)
                                        @if ($p->estado == 0)
                                            @php $i++; @endphp
                                            <tr>
                                                <th scope="col" style="text-align: center;">@php echo $i @endphp</th>
                                                <td scope="col" style="text-align: start;">{{ $p->nombre }}</td>
                                                <td scope="col" style="text-align: end;">L {{ $p->precio }}.00</td>
                                                <td scope="col" style="text-align: center;">
                                                    <button data-bs-toggle="modal" data-bs-target="#activarComplemento{{ $p->id }}"><i class="fa fa-check-circle text-success"></i> Activar</button>                                                    <form action="{{ route('producto.activar', ['id' => $p->id]) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @method('put')
                                                        @csrf
                                                        <div class="modal fade"
                                                            id="activarComplemento{{ $p->id }}"
                                                            data-bs-backdrop="static" data-bs-keyboard="false"
                                                            tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">
                                                                            Activar
                                                                            Complemento</h5>
                                                                    </div>
                                                                    <div class="modal-body"> ¿Está seguro de
                                                                        activar el complemento:
                                                                        <strong>{{ $p->nombre }}</strong>?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input id="activar" name="activar"
                                                                            style="display:none" value="1">
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Si</button>
                                                                        <button type="button" class="btn btn-secondary"
                                                                            data-bs-dismiss="modal">No</button>

                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </form>
                                                </td>
                                                <td scope="col" style="text-align: center;"><a
                                                        href="{{ route('producto.editar', ['id' => $p->id]) }}"><i
                                                            class="fa fa-edit text-success"></i></a></td>
                                                <td scope="col" style="text-align: center;">
                                                    <i data-bs-toggle="modal"
                                                        data-bs-target="#eliminarcomplemento{{ $p->id }}"
                                                        class="fa-solid fa-trash-can text-danger"
                                                        style="color:crimson"></i>
                                                    <form action="{{ route('producto.borrar', ['id' => $p->id]) }}"
                                                        method="post" enctype="multipart/form-data">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal fade"
                                                            id="eliminarcomplemento{{ $p->id }}"
                                                            data-bs-backdrop="static" data-bs-keyboard="false"
                                                            tabindex="-1" aria-labelledby="staticBackdropLabel"
                                                            aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">
                                                                            Eliminar
                                                                            producto</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        ¿Está seguro de eliminar el complemento:
                                                                        <strong>{{ $p->nombre }}</strong>?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit"
                                                                            class="btn btn-danger">Si</button>
                                                                        <button type="button" class="btn btn-secondary"
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

            </div>

        </div>

    </div>

@endsection
