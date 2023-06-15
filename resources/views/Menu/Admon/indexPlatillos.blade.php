@extends('00_plantillas_Blade.plantilla_admonMenu')
@section('selection')
    <div>
        <div>
            <ul class="nav nav-tabs nav-justified h5 " role="tablist" style="background-color:rgba(111, 143, 175, 0.200);">

                <li class="nav-item" role="presentation">
                    <a href="{{ route('menuAdmon.bebidas') }}" class="nav-link text-dark" id="pills-bebidas-tab" data-bs-toggle=""
                        data-bs-target="#pills-bebidas" type="button" role="tab" aria-controls="pills-bebidas"
                        aria-selected="false">Bebidas</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a href="{{ route('menuAdmon.platillos') }}" class="nav-link text-dark active" id="pills-platillos-tab" data-bs-toggle=""
                        data-bs-target="#pills-platillos" type="button" role="tab" aria-controls="pills-platillos"
                        aria-selected="true">Platillos</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a href="{{ route('menuAdmon.complementos') }}" class="nav-link text-dark" id="pills-complementos-tab" data-bs-toggle=""
                        data-bs-target="#pills-complementos" type="button" role="tab"
                        aria-controls="pills-complementos" aria-selected="false">Complementos</a>
                </li>
            </ul>
        </div>
    </div>
@endsection
@section('show')
    <!--Platillos-->
    <div class="tab-pane fade show active" id="pills-platillos" role="tabpanel" aria-labelledby="pills-Pdisponible-tab">
        <div class="container-fluid" style="padding: 0px">

            <!--Navegacion entre disponibles y no disponibles-->
            <ul class="nav nav-tabs justify-content-center" id="myTab" role="tablist">
                <li class="nav-item" role="presentation">
                    <a class="nav-link active text-dark h6" id="PDisponibles-tab" data-bs-toggle="tab"
                        data-bs-target="#PDisponibles" role="tab" type="button" aria-controls="PDisponibles"
                        aria-selected="true">Disponibles</a>
                </li>
                <li class="nav-item" role="presentation">
                    <a class="nav-link text-dark h6" id="PNoDisponibles-tab" data-bs-toggle="tab"
                        data-bs-target="#PNoDisponibles" role="tab" type="button" aria-controls="PNoDisponibles"
                        aria-selected="false">No Disponibles</a>
                </li>
            </ul>

            <div class="tab-content" id="myTabContent" style="height: 500px; overflow-x: hidden;">
                <!--Platillos Disponibles-->
                <div class="tab-pane fade show active" id="PDisponibles" role="tabpanel" aria-labelledby="PDisponibles-tab">
                    <div class="table-responsive container-fluid"> <br>
                        <table class="table menu" id="example" style="">
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
                                @php $i = 0;  @endphp
                                @forelse($productos as $p)
                                    @if ($p->tipo == 2)
                                        @if ($p->estado == 1)
                                        @php $i++; @endphp
                                        <tr>

                                            <td scope="col" style="text-align: center;">@php echo $i @endphp</td>
                                            <td scope="col" style="text-align: start;">{{ $p->nombre }}</td>
                                            <td scope="col" style="text-align: center;">{{ $p->disponible }}</td>
                                            <td scope="col" style="text-align: end;">L {{ $p->precio }}.00</td>
                                            <td scope="col" style="text-align: center;">
                                                <i data-bs-toggle="modal" data-bs-target="#activarPlatillo{{ $p->id }}">
                                                    <a class="fa fa-times-circle text-warning"></a>
                                                    Desactivar</i>
                                                <form action="{{ route('platillo.activar', ['id' => $p->id]) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @method('put')
                                                    @csrf
                                                    <div class="modal fade" id="activarPlatillo{{ $p->id }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">Desactivar
                                                                        Platillo</h5>
                                                                </div>
                                                                <div class="modal-body">
                                                                    ¿Está seguro de activar el platillo:
                                                                    <strong>{{ $p->nombre }}</strong>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <input id="activar" name="activar" style="display:none"
                                                                        value="0">
                                                                    <button type="submit" class="btn btn-danger">Si</button>
                                                                    <button type="button" class="btn btn-secondary"
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
                                                <i data-bs-toggle="modal" data-bs-target="#staticBackdropEe{{ $p->id }}"
                                                    class="fa-solid fa-trash-can text-danger" style="color:crimson"></i>
                                                <form action="{{ route('platillo.borrar', ['id' => $p->id]) }}" method="post"
                                                    enctype="multipart/form-data">
                                                    @method('delete')
                                                    @csrf
                                                    <div class="modal fade" id="staticBackdropEe{{ $p->id }}"
                                                        data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                        aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                        <div class="modal-dialog">
                                                            <div class="modal-content">
                                                                <div class="modal-header">
                                                                    <h5 class="modal-title" id="staticBackdropLabel">
                                                                        Eliminar Platillo</h5>
                                                                </div>
                                                                <div class="modal-body"> ¿Está seguro de
                                                                    eliminar el platillo:
                                                                    <strong>{{ $p->nombre }}</strong>?
                                                                </div>
                                                                <div class="modal-footer">
                                                                    <button type="submit" class="btn btn-danger">Si</button>
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

                <!--Platillos No Disponibles-->
                <div class="tab-pane fade" id="PNoDisponibles" role="tabpanel" aria-labelledby="PNoDisponibles-tab">

                    <div class="table-responsive container-fluid">
                        <br>

                        <table class="table menu" class="example" id="example">
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
                                @php $i = 0; @endphp
                                @forelse($productos as $p)
                                    @if ($p->tipo == 2)
                                        @if ($p->estado == 0)
                                            @php $i++; @endphp
                                            <tr>
                                                <td scope="col" style="text-align: center;">@php echo $i @endphp</td>
                                                <td scope="col" style="text-align: start;">{{ $p->nombre }}</td>
                                                <td scope="col" style="text-align: center;">{{ $p->disponible }}</td>
                                                <td scope="col" style="text-align: end;">L {{ $p->precio }}.00</td>
                                                <td scope="col" style="text-align: center;">
                                                    <i data-bs-toggle="modal" data-bs-target="#activarPlatillo{{ $p->id }}">
                                                        <a class="fa fa-check-circle text-success"></a>
                                                        Activar</i>
                                                    <form action="{{ route('platillo.activar', ['id' => $p->id]) }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @method('put')
                                                        @csrf
                                                        <div class="modal fade" id="activarPlatillo{{ $p->id }}"
                                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">Activar
                                                                            Platillo</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        ¿Está seguro de activar el platillo:
                                                                        <strong>{{ $p->nombre }}</strong>?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <input id="activar" name="activar" style="display:none"
                                                                            value="1">
                                                                        <button type="submit" class="btn btn-danger">Si</button>
                                                                        <button type="button" class="btn btn-secondary"
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
                                                    <i data-bs-toggle="modal" data-bs-target="#staticBackdropE{{ $p->id }}"
                                                        class="fa-solid fa-trash-can text-danger" style="color:crimson"></i>
                                                    <form action="{{ route('platillo.borrar', ['id' => $p->id]) }}" method="post"
                                                        enctype="multipart/form-data">
                                                        @method('delete')
                                                        @csrf
                                                        <div class="modal fade" id="staticBackdropE{{ $p->id }}"
                                                            data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                                            aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                                            <div class="modal-dialog">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="staticBackdropLabel">Eliminar
                                                                            producto</h5>
                                                                    </div>
                                                                    <div class="modal-body">
                                                                        ¿Está seguro de eliminar el platillo:
                                                                        <strong>{{ $p->nombre }}</strong>?
                                                                    </div>
                                                                    <div class="modal-footer">
                                                                        <button type="submit" class="btn btn-danger">Si</button>
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
