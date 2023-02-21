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
         <a href="{{route("usuario_pedido.create")}}" class="btn btn-primary"><i class="ni ni-air-baloon"></i>Ver Pedido</a>
     </div>

     <br><br>
     
     <div class="container-fluid px-4">
         <div class="card-group row" style="display: flex; align:left">

             @foreach ($menu as $m)

             <div class="row items">
                 <div class="col-xl-6 col-sm-6 mb-xl-4 mb-4">
                     <div class="card my-3">
                         <div class="card-body p-3 " >
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
                                                 <img src="{{ asset($m->imagen) }}" alt="..." class="rounded float-start image-center image-fluid" style="width: 100%">
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

                                                 </p>
                                                 <div class="col-12">
                                                     <div>
                                                         <div class="text-center">
                                                             <h3 class="title">{{ $m->nombre }}</h3>
                                                             <p align="center"> {{ $m->descripcion }}</p>

                                                             {{-- Precio, Disponibilidad y edicion --}}

                                                             {{-- Precio --}}
                                                             <div class="col">
                                                                 <h4 class="col precio">L {{ $m->precio }}.00</h4>
                                                             </div>

                                                             <div class="row">


                                                                 <div>
                                                                     <div>

                                                                     </div>

                                                                 </div>

                                                                 {{-- Edit --}}
                                                                 <div class="col">
                                                                     <button class="col-6 btn btn-danger button" data-id="{{$m->id}}" id="btn-agregar">Agregar</button>

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
             </div>
             @endforeach
         </div>
         {{-- Cards Combos --}}
         {{-- Contenedor Tarjetas Comidas --}}
         <div class="col-xl-5 col-sm-6 mb-xl-4 mb-4">
             @foreach ($combos as $c)
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
                                         <img src="{{ asset($c->imagen) }}" alt="..." class="rounded float-start image-center image-fluid" style="width: 100%">

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

                                         </p>
                                         <div class="col-12">
                                             <div>
                                                 <div class="text-center">
                                                     <h3 class="card-title">{{ $c->nombre }}</h3>
                                                     <p align="center"> {{ $c->descripcion }}</p>

                                                     {{-- Precio, Disponibilidad y edicion --}}

                                                     {{-- Precio --}}
                                                     <div class="col">
                                                         <h4 class="col precio">L {{ $c->precio }}.00
                                                         </h4>
                                                     </div>

                                                     <div class="row">


                                                         <div class="row-12">
                                                             <div>

                                                             </div>
                                                         </div>
                                                     </div>

                                                     {{-- Edit --}}
                                                     <div class="col">
                                                         <button class="col-6 btn btn-danger button" id="btn-agregar">Agregar</button>
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

 <script src="{{ asset("js/compras.js") }}"></script>
 @endsection