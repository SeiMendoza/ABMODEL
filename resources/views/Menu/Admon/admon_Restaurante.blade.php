@extends('00_plantillas_Blade.plantilla_General')
@section('info')
    <div class="col float-center">
    <script>
        var msg = '{{Session::get('mensaje')}}';
        var exist = '{{Session::has('mensaje')}}';
        if(exist){
            Swal.fire({
                position: 'top-end',
                icon: 'success',
                title: msg,
                showConfirmButton: false,
                toast: true,
                background: '#0be004ab',
                timer: 5500
            })
        }
    </script>

        <div class="row justify-contend-rigth text-center ">
            <h5 class="card class-12 text-lg text-center text-uppercase" style="text-white" style="text-background: #ffffff;">
                Cantidades Disponibles</h5>
        </div>

        <div class="row justify-contend-rigth p-1">

            <div class="row align-items-center" style="display: flex">
                <p class="col-xl-4 col-sm-6 mb-xl-4 mb-4 text-center text-sm text-white"
                    style="  
                    padding-right: 10px;
                    padding-left: 10px;">
                    Platillos:</p>
                <p class="col-xl-3 col-sm-6 mb-xl-4 mb-4 text-center text-sm text-white"
                    style="  
                    padding-right: 10px;
                    padding-left: 10px;">
                    Bebidas: </p>
                <p class="col-xl-5 col-sm-6 mb-xl-4 mb-4 text-center text-sm text-white"
                    style="  
                    padding-right: 10px;
                    padding-left: 10px;">
                    Combos: </p>
            </div>

            <div class="row align-items-center" style="display: flex">
                <p class="col-xl-4 col-sm-6 mb-xl-4 mb-4 text-center text-sm text-white font-weight-bolder"
                    style="  
                padding-right: 10px;
                padding-left: 10px;">
                    {{ $platillos->count() }}</p>
                <p class="col-xl-3 col-sm-6 mb-xl-4 mb-4 text-center text-sm text-white font-weight-bolder"
                    style="  
                    padding-right: 10px;
                    padding-left: 10px;">
                    {{ $bebidas->count() }}</p>
                <p class="col-xl-5 col-sm-6 mb-xl-4 mb-4 text-center text-sm text-white font-weight-bolder"
                    style="  
                    padding-right: 10px;
                    padding-left: 10px;">
                    {{ $combos->count() }}</p>
            </div>

        </div>

        <div class="row justify-contend-rigth text-center ">
            <hr class="card class-12 text-lg text-center text-uppercase" style="text-white" style="text-background: #ffffff;"/>
        </div>
    </div>
@endsection
@section('contend')
    <!-- ========== Start Cards ========== -->

    <div class="container ">

        <div class="card-group row" style="display: flex">

            <div class="row">

                {{-- Cards Platillos --}}
                <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4 align-items-start">
                    @forelse ($platillos as $p)
                        <div class="card my-3 ">
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
                                                                        <a class="col-12 btn btn-menu form" href="{{ route('platobebida.editar', ['id'=> $p -> id]) }}">Editar</a>
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
                        <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4 text-center">No hay registros</div>
                    @endforelse
                </div>

                {{-- Cards Bebidas --}}
                <div class="col-xl-3 col-sm-6 mb-xl-4 mb-4 align-items-start">
                    @foreach ($bebidas as $p)
                        <div class="card my-3 ">
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
                                                                        <a class="col-12 btn btn-menu form" href="{{ route('platobebida.editar', ['id'=> $p-> id]) }}">Editar</a>
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
                    @endforeach
                </div>


                {{-- Cards Combos --}}
                <div class="col-xl-5 col-sm-6 mb-xl-4 mb-4">
                    @foreach ($combos as $p)
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

                                                                <div class="col">

                                                                    <div class="row ">
                                                                        {{-- Check --}}
                                                                        <div class="col card">
                                                                            <div>
                                                                                <div
                                                                                    class="justify-content-center form-switch form-check">
                                                                                    <input class="form-check-input"
                                                                                        type="checkbox"
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
                                                                            <a class=" btn btn-menu form"
                                                                            href="{{ route('platobebida.editar', ['id'=> $p-> id]) }}" >Editar</a>
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
                    @endforeach
                </div>

            </div>
        </div>
    </div>

    <!-- ========== End Cards ========== -->
@endsection
