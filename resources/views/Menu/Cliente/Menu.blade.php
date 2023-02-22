 @extends('00_plantillas_Blade.plantilla_General1')
 @section('contend')

 <!-- Menú de comidas y bebidas -->

 <h5 style="text-align: center;">Menú del Dia</h5>

 <div style="padding-top:19px; margin: 10px;">
     <form action="{{ route('cliente_menu.index') }}" method="get" role="search" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
         <div class="input-group">
             <input class="form-control" type="search" id="busqueda" name="/" style="width: 350px" placeholder="Buscar por nombre, tamaño, comida/bebida" aria-label="Search" aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($text)) {
                                                                                                                                                                                                                                                    echo $text;
                                                                                                                                                                                                                                                } ?>" />
             <div class="input-group-append">
                 <button class="btn btn-menu my-2 my-sm-0" type="submit"><strong>Buscar</strong></button>
             </div>
             @if($text!="")
             <a href="{{route('cliente_menu.index')}}" class="btn btn-secondary">Borrar Busqueda</a>
             @endif
         </div>
     </form>

     <div style="display:block;   float:right">
     <a href="{{route("index")}}" class="btn btn-menu"><i class="ni ni-palette"></i> Inicio</a>
     
         <a href="{{route("usuario_pedido.create")}}" class="btn btn-primary"><i class="ni ni-air-baloon"></i>Ver Pedido</a>
     </div>

     <br><br>

     <div class="container ">

<div class="card-group row" style="display: flex">

    <div class="row">

        {{-- Cards Platillos --}}
        <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4 align-items-start">
            @foreach ($platillos as $p)
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
                                                                    <div> 
                                                                    <h5 style="text-align: center;" class="card-title">{{ $p->tamanio }}</h5>
                                                                    </div>
                                                                </div>
                                                                <div>
                                                                    <div>
                                                                         
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- Edit --}}
                                                            <div class="col">
                                                                <a class="col-12 btn btn-danger form">Agregar</a>
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
            @endforeach
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
                                                                    <div>
                                                                    <h5 class="card-title">{{ $p->tamanio }}</h5>
                                                                    </div>
                                                                </div>
                                                                <div class="row-12">
                                                                    <div>
                                                                        
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            {{-- Edit --}}
                                                            <div class="col">
                                                                <a class="col-12 btn btn-danger Button">Agregar</a>
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
            @endforeach
        </div>


        {{-- Cards Combos --}}
        <div class="col-xl-5  col-sm-6 mb-xl-4 mb-4">
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
                                                                <a class="col-12 btn btn-danger form"
                                                                    href="{{ route('platobebida.editar', $p->id) }}">Editar</a>
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
            @endforeach
        </div>

    </div>
</div>
</div>
 <script src="{{ asset("js/compras.js") }}"></script>
 @endsection