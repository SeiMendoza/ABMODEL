@extends('00_plantillas_Blade.plantilla_General')
@section('title', 'MenuPrueba')
@section('info')
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

@endsection

@section('activatedMenu')

    <div class="container ">
        <ul class="nav d-flex justify-content-center h4 text-center" role="tablist">
            <li class="nav-item text-primary" role="presentation">
                <a class="nav-link " id="pills-platillos-tab" data-bs-toggle="pill" data-bs-target="#pills-platillo"
                    type="button" role="tab" aria-controls="pills-bebidas" aria-selected="true">Bebidas</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link active " id="pills-bebidas-tab" data-bs-toggle="pill"
                    data-bs-target="#pills-bebidas"
                    type="button" role="tab"
                    aria-controls="pills-platillo" aria-selected="false">Platillos</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link" id="pills-combos-tab" data-bs-toggle="pill" data-bs-target="#pills-combos"
                    type="button" role="tab" aria-controls="pills-contact" aria-selected="false">Combos</a>
            </li>
        </ul>
    </div>

    <div class="tab-content" id="pills-tabContent" style="height: 595px; overflow-y: scroll; overflow-x: hidden;
    scroll-behavior: smooth;">
        <!-- ========== Cards Platillos ========== -->  
        @if (!empty($platillos))
            {{-- Cards Platillos --}}
                <div class="container tab-pane fade in active" id="pills-platillo" role="tabpanel"
                    aria-labelledby="pills-platillos-tab">
                        <!-- Platillos -->
                        @forelse ($platillos as $p)
                            <div class="card col-3 align-items-center" style="display:inline-block; margin: 5px; height: 550px; width: 25%;">
                                <div class="card-body p-3">                             
                                    <!-- Imagen -->
                                    <div class="align-items-center">
                                        <div>
                                            <div>
                                                <img src="{{ asset($p->imagen) }}" alt="..."
                                                    class="rounded float-center image-center image-fluid"
                                                    style="width: 100% ">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Informacion -->
                                    <div style="display:block">                                    
                                        <div>
                                            <div class="">
                                                <div class="p-3">
                                                    <div>
                                                        <p class="text-sm mb-0 text-uppercase text-end font-weight-bold">
                                                            Disponibles: {{ $p->disponible }}
                                                        </p>
                                                        <div class="col-12">
                                                            <div>
                                                                <div class="text-center">
                                                                    <h3>{{ $p->nombre }}</h3>
                                                                    
                                                                    <div class="col">
                                                                        <h4 class="col">L {{ $p->precio }}.00</h4>
                                                                    </div>

                                                                    <div class="row">

                                                                        {{-- Check --}}
                                                                        <div class="col">
                                                                            <div class="row-12">
                                                                                <div
                                                                                    class="justify-content-center form-switch form-check">

                                                                                    <input data-bs-toggle="modal"
                                                                                        data-bs-target="#modalactivarproducto{{ $p->id }}"
                                                                                        class="form-check-input" checked='true'
                                                                                        type="checkbox"
                                                                                        name="chckBox_disponible"
                                                                                        id="disponible">

                                                                                    <!-- Modal -->
                                                                                    <div class="modal fade"
                                                                                        id="modalactivarproducto{{ $p->id }}"
                                                                                        tabindex="-1"
                                                                                        aria-labelledby="ModalLabel"
                                                                                        aria-hidden="true">
                                                                                        <div class="modal-dialog">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <h5 class="modal-title text-center"
                                                                                                        id="exampleModalLabel">
                                                                                                        Disponibilidad
                                                                                                    </h5>
                                                                                                    <button type="button"
                                                                                                        class="btn-close"
                                                                                                        data-bs-dismiss="modal"
                                                                                                        aria-label="Close"></button>
                                                                                                </div>
                                                                                                <div class="modal-body">
                                                                                                    ¿Deseea quitar
                                                                                                    <strong>{{ $p->nombre }}</strong>
                                                                                                    del menú?
                                                                                                </div>
                                                                                                <div class="modal-footer">

                                                                                                    <form
                                                                                                        action="{{ route('menuAdmon.activar', ['id' => $p->id]) }}"
                                                                                                        method="POST">
                                                                                                        @method('put')
                                                                                                        @csrf
                                                                                                        <div
                                                                                                            style="display: none">
                                                                                                            <input
                                                                                                                id="activar"
                                                                                                                name="activar"
                                                                                                                value="1">
                                                                                                        </div>
                                                                                                        <button type="button"
                                                                                                            class="btn btn-menu"
                                                                                                            data-bs-dismiss="modal">No</button>
                                                                                                        <input type="submit"
                                                                                                            class="btn btn-danger"
                                                                                                            value="Si">
                                                                                                    </form>

                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <div class="row-12">
                                                                                <div>
                                                                                    <label
                                                                                        class="form-check-label font-weight-bold"
                                                                                        for="flexSwitchCheck">Disponible</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        {{-- Edit --}}
                                                                        <div class="col">
                                                                            <a class="col-12 btn btn-menu form"
                                                                                href="{{ route('plato.editar', ['id' => $p->id]) }}">Editar</a>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <a class="col-12 btn btn-danger form">Eliminar</a>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4 text-center">No hay registros</div>
                        @endforelse
                    </div>
                </div>
            </div>
        @else
            <div class="text-center text-uppercase ">
                <p class="p-4" style="font-size: 1.5rem"> <strong>No hay Platillos agregados mostrar</strong></p>
            </div>
        @endif    

        <!-- ========== Cards Bebidas ========== -->
        @if (!empty($bebidas))
                <div class="container tab-pane fade in active" id="pills-bebidas" role="tabpanel"
                    aria-labelledby="pills-bebidas-tab">
                        <!-- Platillos -->
                        @forelse ($bebidas as $p)
                            <div class="card col-3 align-items-center" style="display:inline-block; margin: 5px; height: 550px; width: 25%;">
                                <div class="card-body p-3">                             
                                    <!-- Imagen -->
                                    <div class="align-items-center">
                                        <div>
                                            <div>
                                                <img src="{{ asset($p->imagen) }}" alt="..."
                                                    class="rounded float-center image-center image-fluid"
                                                    style="width: 100% ">
                                            </div>
                                        </div>
                                    </div>

                                    <!-- Informacion -->
                                    <div style="display:block">                                    
                                        <div>
                                            <div class="">
                                                <div class="p-3">
                                                    <div>
                                                        <p class="text-sm mb-0 text-uppercase text-end font-weight-bold">
                                                            Disponibles: {{ $p->disponible }}
                                                        </p>
                                                        <div class="col-12">
                                                            <div>
                                                                <div class="text-center">
                                                                    <h3>{{ $p->nombre }}</h3>
                                                                    

                                                                    {{-- Precio, Disponibilidad y edicion --}}

                                                                    {{-- Precio --}}
                                                                    <div class="col">
                                                                        <h4 class="col">L {{ $p->precio }}.00</h4>
                                                                    </div>

                                                                    <div class="row">

                                                                        {{-- Check --}}
                                                                        <div class="col">
                                                                            <div class="row-12">
                                                                                <div
                                                                                    class="justify-content-center form-switch form-check">

                                                                                    <input data-bs-toggle="modal"
                                                                                        data-bs-target="#modalactivarproducto{{ $p->id }}"
                                                                                        class="form-check-input" checked='true'
                                                                                        type="checkbox"
                                                                                        name="chckBox_disponible"
                                                                                        id="disponible">

                                                                                    <!-- Modal -->
                                                                                    <div class="modal fade"
                                                                                        id="modalactivarproducto{{ $p->id }}"
                                                                                        tabindex="-1"
                                                                                        aria-labelledby="ModalLabel"
                                                                                        aria-hidden="true">
                                                                                        <div class="modal-dialog">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <h5 class="modal-title text-center"
                                                                                                        id="exampleModalLabel">
                                                                                                        Disponibilidad
                                                                                                    </h5>
                                                                                                    <button type="button"
                                                                                                        class="btn-close"
                                                                                                        data-bs-dismiss="modal"
                                                                                                        aria-label="Close"></button>
                                                                                                </div>
                                                                                                <div class="modal-body">
                                                                                                    ¿Deseea quitar
                                                                                                    <strong>{{ $p->nombre }}</strong>
                                                                                                    del menú?
                                                                                                </div>
                                                                                                <div class="modal-footer">

                                                                                                    <form
                                                                                                        action="{{ route('menuAdmon.activar', ['id' => $p->id]) }}"
                                                                                                        method="POST">
                                                                                                        @method('put')
                                                                                                        @csrf
                                                                                                        <div
                                                                                                            style="display: none">
                                                                                                            <input
                                                                                                                id="activar"
                                                                                                                name="activar"
                                                                                                                value="1">
                                                                                                        </div>
                                                                                                        <button type="button"
                                                                                                            class="btn btn-menu"
                                                                                                            data-bs-dismiss="modal">No</button>
                                                                                                        <input type="submit"
                                                                                                            class="btn btn-danger"
                                                                                                            value="Si">
                                                                                                    </form>

                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <div class="row-12">
                                                                                <div>
                                                                                    <label
                                                                                        class="form-check-label font-weight-bold"
                                                                                        for="flexSwitchCheck">Disponible</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        {{-- Edit --}}
                                                                        <div class="col">
                                                                            <a class="col-12 btn btn-menu form"
                                                                            href="{{ route('bebida.editar', ['id' => $p->id]) }}">Editar</a>
                                                                        </div>
                                                                    </div>

                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <a class="col-12 btn btn-danger form">Eliminar</a>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @empty
                            <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4 text-center">No hay registros</div>
                        @endforelse
                    </div>
                </div>
            </div>
        @else
            <div class="text-center text-uppercase ">
                <p class="p-4" style="font-size: 1.5rem"> <strong>No hay Platillos agregados mostrar</strong></p>
            </div>
        @endif
    </div> 


@endsection
<!-- ========== End Menú Activado ========== -->


<!--==========Start Menu Descativado==========-->
@section('disaledMenu')

    <br>
    <br>
    <div class="container card p'8" style="background-color: rgb(187, 187, 187, .5);">
        <div class="card-group row p-2" style="display: flex">

            @if (!(empty($platillos) || empty($bebidas) || empty($combos)))
                {{-- Cards Platillos --}}
                <div class="row text-center text-uppercase text-lg">
                    <table>
                        <thead>
                            <th class="col-xl-4 col-sm-6 mb-xl-4 mb-4"><strong>Platillos</strong></th>
                            <th class="col-xl-3 col-sm-6 mb-xl-4 mb-4"><strong>Bebidas</strong></th>
                            <th class="col-xl-5 col-sm-6 mb-xl-4 mb-4"><strong>Combos</strong></th>
                        </thead>
                    </table>
                </div>


                <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4 align-items-start">
                    @forelse ($platillos as $p)
                        @if (!$p->estado)
                            <div class="card my-3 " style="background-color: rgb(187, 187, 187, .5); color:gray">
                                <div class="row card-body p-3">

                                    {{-- foodIcon --}}
                                    <div class="text-end">
                                        <div class="icon icon-shape-menu bg-gradient-menu shadow-primary text-center">
                                            <i class="ni ni-bell-55 text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>

                                    {{-- Imagen --}}
                                    <div class="align-items-center">
                                        <div class="card">
                                            <div>
                                                <div>
                                                    <img src="{{ asset($p->imagen) }}" alt="..."
                                                        class="rounded float-center image-center image-fluid"
                                                        style="width: 100% ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div style="display:block">
                                        {{-- Informacion --}}
                                        <div>
                                            <div class="col-12 text-end"
                                                style="background-color: rgb(187, 187, 187, .5); color:gray">
                                                <div class="col-12 p-4">
                                                    <div>
                                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                                            No Disponible
                                                        </p>
                                                        <div class="col-12">
                                                            <div>
                                                                <div class="text-center">
                                                                    <h3>{{ $p->nombre }}</h3>
                                                                    <p> {{ $p->descripcion }}</p>

                                                                    {{-- Precio, Disponibilidad y edicion --}}

                                                                    {{-- Precio --}}
                                                                    <div class="col">
                                                                        <h4 class="col">L {{ $p->precio }}.00
                                                                        </h4>
                                                                    </div>

                                                                    <div class="row">

                                                                        {{-- Check --}}
                                                                        <div class="col">
                                                                            <div class="row-12">
                                                                                <div
                                                                                    class="justify-content-center form-switch form-check">

                                                                                    <input data-bs-toggle="modal"
                                                                                        data-bs-target="#modalactivarproducto{{ $p->id }}"
                                                                                        class="form-check-input"
                                                                                        type="checkbox"
                                                                                        name="chckBox_disponible"
                                                                                        id="disponible">

                                                                                    <!-- Modal -->
                                                                                    <div class="modal fade"
                                                                                        id="modalactivarproducto{{ $p->id }}"
                                                                                        tabindex="-1"
                                                                                        aria-labelledby="ModalLabel"
                                                                                        aria-hidden="true">
                                                                                        <div class="modal-dialog">
                                                                                            <div class="modal-content">
                                                                                                <div class="modal-header">
                                                                                                    <h5 class="modal-title text-center"
                                                                                                        id="exampleModalLabel">
                                                                                                        Disponibilidad
                                                                                                    </h5>
                                                                                                    <button type="button"
                                                                                                        class="btn-close"
                                                                                                        data-bs-dismiss="modal"
                                                                                                        aria-label="Close"></button>
                                                                                                </div>
                                                                                                <div class="modal-body">
                                                                                                    ¿Deseea agregar
                                                                                                    <strong>{{ $p->nombre }}</strong>
                                                                                                    al menú?
                                                                                                </div>
                                                                                                <div class="modal-footer">

                                                                                                    <form
                                                                                                        action="{{ route('menuAdmon.activar', $p) }}"
                                                                                                        method="POST">
                                                                                                        @method('put')
                                                                                                        @csrf
                                                                                                        <div
                                                                                                            style="display: none">
                                                                                                            <input
                                                                                                                type="text"
                                                                                                                id="activo"
                                                                                                                name="activo"
                                                                                                                value="si">
                                                                                                        </div>
                                                                                                        <button
                                                                                                            type="button"
                                                                                                            class="btn btn-menu"
                                                                                                            data-bs-dismiss="modal">No</button>
                                                                                                        <button
                                                                                                            type="submit"
                                                                                                            class="btn btn-danger">Si
                                                                                                        </button>
                                                                                                    </form>

                                                                                                </div>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>

                                                                                </div>
                                                                            </div>
                                                                            <div class="row-12">
                                                                                <div>
                                                                                    <label
                                                                                        class="form-check-label font-weight-bold"
                                                                                        for="flexSwitchCheck">Disponible</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        {{-- Edit --}}
                                                                        <div class="col">
                                                                            <a class="col-12 btn btn-secondary form"
                                                                                href="{{ route('plato.editar', ['id' => $p->id]) }}">Editar</a>
                                                                        </div>
                                                                    </div>
                                                                    {{-- Fin Precio... --}}

                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <a
                                                                                class="col-12 btn btn-danger form">Eliminar</a>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="text-center text-uppercase">
                            <p class="p-4" style="font-size: 1.2rem">No hay Platillos agregados</p>
                        </div>
                    @endforelse
                </div>

                {{-- Cards Bebidas --}}
                <div class="col-xl-3 col-sm-6 mb-xl-4 mb-4 align-items-start">
                    @forelse ($bebidas as $p)
                        @if ($p->estado)
                            <div class="card my-3 ">
                                <div class="row card-body p-3">

                                    {{-- foodIcon --}}
                                    <div class="text-end">
                                        <div class="icon icon-shape-menu bg-gradient-menu shadow-primary text-center">
                                            <i class="ni ni-umbrella-13 text-lg opacity-10" aria-hidden="true"></i>
                                        </div>
                                    </div>

                                    {{-- Imagen --}}
                                    <div class="align-items-center">
                                        <div class="card">
                                            <div>
                                                <div>
                                                    <img src="{{ asset($p->imagen) }}" alt="..."
                                                        class="rounded float-center image-center image-fluid"
                                                        style="width: 100% ">
                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div style="display:block">
                                        {{-- Informacion --}}
                                        <div>
                                            <div class="card col-12 text-end">
                                                <div class="col-12 p-4">
                                                    <div>
                                                        <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                                            Disponibles: {{ $p->disponible }}
                                                        </p>
                                                        <div class="col-12">
                                                            <div>
                                                                <div class="text-center">
                                                                    <h3>{{ $p->nombre }}</h3>
                                                                    <p align="center"> {{ $p->descripcion }}</p>

                                                                    {{-- Precio, Disponibilidad y edicion --}}

                                                                    {{-- Precio --}}
                                                                    <div class="col">
                                                                        <h4 class="col">L {{ $p->precio }}.00
                                                                        </h4>
                                                                    </div>

                                                                    <div class="row">

                                                                        {{-- Check --}}
                                                                        <div class="card col">
                                                                            <div class="row-12">
                                                                                <div
                                                                                    class="justify-content-center form-switch checked">
                                                                                    <input class="form-check-input"
                                                                                        checked='true' type="checkbox"
                                                                                        name="chckBox_disponible"
                                                                                        id="disponible" style="">
                                                                                </div>
                                                                            </div>
                                                                            <div class="row-12">
                                                                                <div>
                                                                                    <label
                                                                                        class="form-check-label font-weight-bold"
                                                                                        for="flexSwitchCheck">Disponible</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        {{-- Edit --}}
                                                                        <div class="col">
                                                                            <a class="col-12 btn btn-menu form"
                                                                            href="{{ route('bebida.editar', ['id' => $p->id]) }}">Editar</a>
                                                                        </div>
                                                                    </div>
                                                                    {{-- Fin Precio... --}}

                                                                    <div class="row">
                                                                        <div class="col">
                                                                            <a
                                                                                class="col-12 btn btn-danger form">Eliminar</a>
                                                                        </div>
                                                                    </div>

                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        @endif
                    @empty
                        <div class="text-center text-uppercase">
                            <p class="p-4" style="font-size: 1.2rem">No hay Bebidas</p>
                        </div>
                    @endforelse
                </div>

                {{-- Cards Combos --}}
                <div class="col-xl-5 col-sm-6 mb-xl-4 mb-4">
                    @forelse ($combos as $p)
                        <div class="card my-3 ">
                            <div class="card-body p-3">

                                {{-- foodIcon --}}
                                <div class="col-12 text-end">
                                    <div class="icon icon-shape-menu bg-gradient-menu shadow-primary text-center">
                                        <i class="ni ni-box-2 text-lg opacity-10" aria-hidden="true"></i>
                                    </div>
                                </div>

                                <div class="row" style="display:flex">
                                    {{-- Imagen --}}
                                    <div class="col align-items-center">
                                        <div class="card col-12 row-12">
                                            <div>
                                                <div class="square">
                                                    <img src="{{ asset($p->imagen) }}" alt="..."
                                                        class="rounded float-start image-center image-fluid"
                                                        style="width: 100%">

                                                </div>
                                            </div>
                                        </div>
                                    </div>

                                    {{-- Informacion --}}
                                    <div class="col">
                                        <div class="card col-12 text-end">
                                            <div class="col-12 p-4">
                                                <div>
                                                    <p class="text-sm mb-0 text-uppercase font-weight-bold">
                                                        Disponibles:{{$p->disponible}}
                                                    </p>
                                                    <div class="col-12">
                                                        <div>
                                                            <div class="text-center">
                                                                <h3>{{ $p->nombre }}</h3>
                                                                <p align="center"> {{ $p->descripcion }}</p>

                                                                {{-- Precio, Disponibilidad y edicion --}}

                                                                {{-- Precio --}}
                                                                <div class="col">
                                                                    <h4 class="col">L {{ $p->precio }}.00
                                                                    </h4>
                                                                </div>

                                                                <div class="col">

                                                                    <div class="row ">
                                                                        {{-- Check --}}
                                                                        <div class="col card">
                                                                            <div>
                                                                                <div
                                                                                    class="justify-content-center form-switch form-check">
                                                                                    <input class="form-check-input"
                                                                                        checked='true' type="checkbox"
                                                                                        name="chckBox_disponible"
                                                                                        id="disponible">
                                                                                </div>
                                                                            </div>
                                                                            <div>
                                                                                <div>
                                                                                    <label
                                                                                        class="form-check-label font-weight-bold"
                                                                                        for="flexSwitchCheck">Disponible</label>
                                                                                </div>
                                                                            </div>
                                                                        </div>

                                                                        {{-- Edit --}}
                                                                        <div class="col">
                                                                            <a class=" btn btn-menu form">Editar</a>
                                                                        </div>

                                                                    </div>


                                                                </div>
                                                                {{-- Fin Precio... --}}

                                                                <div class="row">
                                                                    <div class="col">
                                                                        <a class="col-12 btn btn-danger form">Eliminar</a>
                                                                    </div>
                                                                </div>

                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                            </div>
                        </div>
                    @empty
                        <div class="text-center text-uppercase">
                            <p class="p-4" style="font-size: 1.2rem">No hay Platillos agregados</p>
                        </div>
                    @endforelse
                </div>
            @else
                <div class="text-center text-uppercase ">
                    <p class="p-4" style="font-size: 1.5rem"> <strong>No hay datos para mostrar</strong></p>
                </div>
            @endif

        </div>

    </div>
@endsection
<!-- ========== End Menu Descativado ========== -->


"@section('activatedMenu')

    <div class="container card">


        <section class="NovidadesSection">
            <main class="main-content position-relative border-radius-lg">
                <div class="tab-content" id="pills-tabContent">
                    <!-- ========== Bebidas ========== -->
                    <div class="tab-pane fade " id="pills-home" role="tabpanel" aria-labelledby="pills-platillo-tab">
                        <div class="container-fluid" style="padding: 0px">
                            <div class="productos" id="productos"
                                style="display: grid; grid-template-columns: 150px 150px 155px 155px 150px 150px">
                                @foreach ($bebidas as $pro)
                                    <div class="agregarLista" id=""
                                        style="display:block;  height: 180px; width: 150px; padding: 3px ">
                                        <div class="card h-100 btn btn-light col d-flex justify-content-center mb-4"
                                            data-id="{{ $pro->id }}" style="padding: 0px">
                                            <div class="" style="text-align:center;">
                                                <div class="text-center">
                                                    <!-- Nombre -->
                                                    <p class="nombre card-title pt-2 text-center text-primary"
                                                        id="nombre">
                                                        <strong style="font-size: 20px">{{ $pro->nombre }}</strong>
                                                    </p>
                                                    <!-- Imagen -->
                                                    <div class="img">
                                                        <img src="/images/1676990334.Pollo-chuco-principal.png"
                                                            alt="" class="img img-responsive"
                                                            style="width: 100%">
                                                    </div>
                                                    <!-- Precio -->
                                                    <div class="proposito">
                                                        <span id="prop"
                                                            class="precio text-primary text-decoration-line">
                                                            <strong style="font-size: 15px">Precio:
                                                                L{{ $pro->precio }}.00</strong>
                                                        </span>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                    </div>

                @endsection
