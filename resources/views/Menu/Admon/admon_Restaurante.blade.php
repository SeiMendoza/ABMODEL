@extends('00_plantillas_Blade.plantilla_General')
@section('contend')

    {{-- Cards --}}
    @foreach ($platillos as $p)
        <div>
            <div class="row"">

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
                                                <p class="text-sm mb-0 text-uppercase font-weight-bold" aling>
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
                                                                            <input class="form-check-input" type="checkbox"
                                                                                name="chckBox_disponible" id="disponible">
                                                                        </div>
                                                                    </div>
                                                                    <div class="row-12">
                                                                        <div>
                                                                            <label class="form-check-label font-weight-bold"
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

        {{-- End Cards --}}
    @endforeach
@endsection
