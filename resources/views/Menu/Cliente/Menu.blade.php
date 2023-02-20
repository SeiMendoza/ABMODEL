 
@extends('00_plantillas_Blade.plantilla_General1')
@section('contend')
<!-- Menú de comidas y bebidas -->
<h5 style="text-align: center;">Menú del Dia</h5>
<div class="container-fluid px-4">
    <div style="display:block; float:right" >
        <a href="{{route("usuario_pedido.create")}}" class="btn btn-primary"><i class="ni ni-air-baloon"></i>Ver Pedido</a>
    </div>
    <div style="display:block;">
        
        <form action="{{route('cliente_menu.index')}}" method="get" role="search" class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-80 navbar-search">
            <div class="input-group">
                <input size="5" class="form-control" type="text" id="busqueda" name="/" style="width: 405px; size: 6px;" placeholder="Buscar por nombre, tamaño o tipo de comida/bebida" aria-label="Buscar por nombre" aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($text)) echo $text; ?>" />
                <button class="btn btn-primary" type="submit" id="b" type="button"><i class="fas fa-search"></i></button>
                @if($text!="")
                <a href="{{route('cliente_menu.index')}}" class="btn btn-secondary">Borrar Busqueda</a>
                @endif
            </div>
        </form>

    </div>
</div>

<br><br>
<div class="container-fluid px-4">
    @foreach ($menu as $m)
    <div class="row">
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
                                                    <h3>{{ $m->nombre }}</h3>
                                                    <p align="center"> {{ $m->descripcion }}</p>

                                                    {{-- Precio, Disponibilidad y edicion --}}

                                                    {{-- Precio --}}
                                                    <div class="col">
                                                        <h4 class="col">L {{ $m->precio }}.00</h4>
                                                    </div>

                                                    <div class="row">


                                                        <div>
                                                            <div>

                                                            </div>

                                                        </div>

                                                    {{-- Edit --}}
                                                    <div class="col">
                                                      <button class="col-8 btn btn-danger form" id="btn-agregar" >Agregar</button> 
  
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

<script>
     //Añadir producto al carrito
     agregar(e);
        e.preventDefault();
        //Delegado para agregar al carrito
        if(e.target.classList.contains('btn-agregar')){
            const producto = e.target.parentElement;
            //Enviamos el producto seleccionado para tomar sus datos
            this.leerDatosProducto(producto);
        }
    
</script>
@endsection