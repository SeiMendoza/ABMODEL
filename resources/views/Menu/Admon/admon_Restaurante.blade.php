@extends('00_plantillas_Blade.plantilla_General')
@section('contend')
    <!-- ========== Start Cantidad de Platillos Disponibles ========== -->

    <div>
        <div class="col p-1">

            <div class="card col">

                <div class="row justify-contend-center text-center ">
                    <h5 style="text-white" style="text-background: #ffffff;">Cantidad de Platillos</h5>
                </div>

                <div class="row justify-contend-center">

                    <div class="row align-items-center" style="display: flex">
                        <p class="col text-center"
                            style="  
                padding-right: 40px;
                padding-left: 40px;">
                            Platillos:</p>
                        <p class="col text-center"
                            style="  
                    padding-right: 40px;
                    padding-left: 40px;">
                            Bebidas: </p>
                        <p class="col text-center"
                            style="  
                    padding-right: 40px;
                    padding-left: 40px;">
                            Combos: </p>
                    </div>

                    <div class="row align-items-center" style="display: flex">
                        <p class="col text-center"
                            style="  
                padding-right: 40px;
                padding-left: 40px;">
                            {{ $platillos->where('tipo', '0')->count() }}</p>
                        <p class="col text-center"
                            style="  
                    padding-right: 40px;
                    padding-left: 40px;">
                            {{ $platillos->where('tipo', '1')->count() }}</p>
                        <p class="col text-center"
                            style="  
                    padding-right: 40px;
                    padding-left: 40px;">
                            {{ $combos->count() }}</p>
                    </div>

                </div>
            </div>

        </div>
    </div>

    <!-- ========== End Cantidad de Platillos Disponibles ========== -->

    <div class="container ">

        <div class="row" style="display: flex">

            {{-- Cards Platillos --}}
            @foreach ($platillos as $p)
                <div class="row">
                    <div class="col">

                        {{-- Contenedor Tarjetas Comidas --}}
                        <div class="col-xl-6 col-sm-6 mb-xl-4 mb-4">
                            <div class="card my-3 ">
                                <div class="card-body p-3">

                                    {{-- foodIcon --}}
                                    <div class="col-12 text-end">
                                        <div class="icon icon-shape-menu bg-gradient-menu shadow-primary text-center">
                                            <i class="ni ni-bell-55 text-lg opacity-10" aria-hidden="true"></i>
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
                                                            Disponibles: {{ $p->cantidad }}
                                                        </p>
                                                        <div class="col-12">
                                                            <div>
                                                                <div class="text-center">
                                                                    <h3>{{ $p->nombre }}</h3>
                                                                    <p align="center"> {{ $p->descripcion }}</p>

                                                                    {{-- Precio, Disponibilidad y edicion --}}

                                                                    {{-- Precio --}}
                                                                    <div class="col">
                                                                        <h4 class="col">L {{ $p->precio }}.00</h4>
                                                                    </div>

                                                                    <div class="row">

                                                                        {{-- Check --}}
                                                                        <div class="card col">
                                                                            <div class="row-12">
                                                                                <div
                                                                                    class="justify-content-center form-switch form-check">
                                                                                    <input class="form-check-input"
                                                                                        type="checkbox"
                                                                                        name="chckBox_disponible"
                                                                                        id="disponible">
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
                                                                            <a class="col-12 btn btn-danger form">Editar</a>
                                                                        </div>
                                                                    </div>
                                                                    {{-- Fin Precio... --}}

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
                </div>
                {{-- End Cards Platillos --}}
            @endforeach

            {{-- Cards Combos --}}
            @foreach ($combos as $p)
                <div class="col">
                    <div class="row">

                        {{-- Contenedor Tarjetas Comidas --}}
                        <div class="col-xl-6 col-sm-6 mb-xl-4 mb-4">
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
                                                            Disponibles:
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
                                                                                    class="justify-content-center form-switch form-check">
                                                                                    <input class="form-check-input"
                                                                                        type="checkbox"
                                                                                        name="chckBox_disponible"
                                                                                        id="disponible">
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
                                                                            <a
                                                                                class="col-12 btn btn-danger form">Editar</a>
                                                                        </div>
                                                                    </div>
                                                                    {{-- Fin Precio... --}}

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
                </div>
            @endforeach
            {{-- End Card Combos --}}


        </div>

    </div>
@endsection
