@extends('00_plantillas_Blade.plantilla_General')
@section('title', 'Administración del Menú')
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

    <div class="row">
        <div class="container-fluid">
            <ul 
            class="nav d-flex justify-content-center h4 text-center border-radius-lg" 
            role="tablist"
            style="background-color: #ef3f3f; rounde">

                <li 
                class="nav-item" 
                role="presentation">
                    <a 
                    class="nav-link text-white" 
                    id="pills-bebidas-tab" 
                    data-bs-toggle="pill" 
                    data-bs-target="#pills-bebidas"
                    type="button" 
                    role="tab" 
                    aria-controls="pills-bebidas" 
                    aria-selected="false"
                    >Bebidas</a>
                </li>

                <li 
                class="nav-item" 
                role="presentation">
                    <a 
                    class="nav-link active text-white" 
                    id="pills-platillos-tab" 
                    data-bs-toggle="pill" 
                    data-bs-target="#pills-platillos"
                    type="button" 
                    role="tab" 
                    aria-controls="pills-platillos" 
                    aria-selected="false"
                    >Platillos</a
                    >
                </li>

                <li 
                class="nav-item" 
                role="presentation">
                    <a
                    class="nav-link text-white" 
                    id="pills-combos-tab" 
                    data-bs-toggle="pill" 
                    data-bs-target="#pills-combos"
                    type="button" 
                    role="tab" 
                    aria-controls="pills-contact" 
                    aria-selected="false"
                    >Combos</a
                    >
                </li>

            </ul>
        </div>
    </div>   

    <div 
    class="table-responsive" 
    id="pills-tabContent"
    style="height: 595px; overflow-y: scroll; overflow-x: hidden; scroll-behavior: smooth;">
        <section class="NovidadesSection" style="">  
            <main class="main-content position-relative border-radius-lg">    
                
                <div 
                class="tab-content" 
                id="pills-tabContent">  

                    <!-- ========== Cards Platillos ========== -->
                    <div 
                    class="tab-pane show active fade" 
                    id="pills-platillos" 
                    role="tabpanel"
                    aria-labelledby="pills-platillos-tab">

                    
                        <div class="row">

                            <!--Boton Registrar-->
                            <div 
                            class="col-2 text-start"
                            style="margin: 4px">
                                <a 
                                href={{ route('bebidasyplatillos.create') }} 
                                class="btn btn-menu"
                                style="margin: 4px"
                                >Registrar Platillo</a
                                >
                            </div>
        
                            <!--Barra de busqueda-->
                            <div
                            class="col-4 p-2"  
                            style="display:; magin:2px">
                                <form 
                                action="{{ route('busqueda.index') }}" 
                                method="get" 
                                role="search"
                                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" style="">
                                    <div class="input-group">
                                        <input 
                                        class="btn btn-rounded btn-menu" 
                                        id="busqueda" 
                                        name="busqueda"
                                        style="width: 200px" 
                                        placeholder="Buscar platillo" 
                                        aria-label="Search"
                                        aria-describedby="basic-addon2" 
                                        maxlength="50" required
                                        value="<?php if (isset($busqueda)) {
                                                echo $busqueda;
                                                } ?>" />
                                            <button 
                                            class="btn btn-rounded btn-menu" 
                                            type="submit"
                                            >Buscar</button
                                            >
                                            @if(isset($busqueda)!="")
                                            <a href="{{route('busqueda.index')}}" 
                                            class="btn btn-rounded btn-success"
                                            >Borrar Busqueda</a
                                            >
                                        @endif 
                                
                                    </div>
                                </form>
                            </div> 

                        </div>
                        
                        <div 
                        class="productosadmon" 
                        id="productosadmon"
                        style="display: grid; grid-template-columns: 300px 300px 300px 300px">
                            
                        @forelse ($platillos as $p)
                            <div 
                            class="container" 
                            style="display:block;  height: 300px; width: 300px; padding: 5px ">   

                                <div 
                                class="card h-100" 
                                data-id="platillo_{{$p->id}}" 
                                style="padding: 0px; width:100%; border-radius:0%; background: url('/images/1676990334.Pollo-chuco-principal.png') top center/cover no-repeat;">
                                    <div 
                                    class="text-center" 
                                    style="text-align:center; ">
                                         
                                        <!-- Check activar-->
                                        <div class="form-check form-switch text-end">
                                            <input                                            
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalactivarproducto{{ $p->id }}"
                                            class="form-check-input" 
                                            checked='true' 
                                            type="checkbox"                                            
                                            name="chckBox_disponible"
                                            id="disponible"
                                            style="position:absolute; bottom: 90.5%; left: 290px"
                                            >
                                        </div>

                                        <!--Boton editar-->
                                        <a 
                                            class="btn btn-menu form btn-xs"
                                            href="{{ route('plato.editar', ['id' => $p->id]) }}"
                                            style="position:absolute; bottom: 27.5%; left:220px"
                                            >Editar</a
                                        >

                                        <!--Boton borrar-->
                                        <a 
                                        class="btn btn-danger form btn-xs"                                        
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalBorrarProducto{{ $p->id }}"
                                        style="position:absolute; bottom: 27.5%; left:150px"
                                        >Borrar</a
                                        >

                                        <!--Modal Eliminar-->
                                        <div 
                                        class="modal fade" 
                                        id="modalBorrarProducto{{ $p->id }}" 
                                        tabindex="-1"
                                        aria-labelledby="ModalLabel" 
                                        aria-hidden="true"
                                        data-bs-backdrop="static" 
                                        data-bs-keyboard="false">
                                        
                                            <div 
                                            class="modal-dialog"
                                            data-backdrop="static">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" 
                                                        id="ModalLabel">
                                                            Eliminar Platillo
                                                        </h5>
                                                        <button 
                                                        type="button" 
                                                        class="btn-close fs-5" 
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        ¿Está seguro de eliminar
                                                        <strong>{{ $p->nombre }}</strong>
                                                        del menú?
                                                    </div>
                                                    <div class="modal-footer">
                    
                                                        <form action="{{ route('platillo.borrar', ['id' => $p->id]) }}" method="GET">
                                                            @method('put')
                                                            @csrf
                                                            <div style="display: none">
                                                                <input type="number" id="activar" name="activar" value="0">
                                                            </div>
                                                            <button type="button" class="btn btn-menu"
                                                                data-bs-dismiss="modal">No</button>
                                                            <input type="submit" class="btn btn-danger" value="Si">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                                                              
                                        <!--Modal activar-->
                                        <div 
                                        class="modal fade" 
                                        id="modalactivarproducto{{ $p->id }}" 
                                        tabindex=""
                                        aria-labelledby="ModalLabel" 
                                        
                                        data-bs-backdrop="static"
                                        data-bs-keyboard="false" 
                                        data-bs-keyboard="false">
                                        
                                            <div 
                                            class="modal-dialog"
                                            data-backdrop="static">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" 
                                                            id="ModalLabel">
                                                            Disponibilidad
                                                        </h5>

                                                        <button 
                                                        type="button" 
                                                        class="btn-close close" 
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        ¿Deseea desactivar
                                                        <strong>{{ $p->nombre }}</strong>
                                                        del menú?
                                                    </div>

                                                    <div class="modal-footer">
                    
                                                        <form action="{{ route('menuAdmon.activar', ['id' => $p->id]) }}" method="POST">
                                                            @method('put')
                                                            @csrf
                                                            <div style="display: none">
                                                                <input type="number" id="activar" name="activar" value="0">
                                                            </div>
                                                            <button type="button" class="btn btn-menu"
                                                                data-bs-dismiss="modal">No</button>
                                                            <input type="submit" class="btn btn-danger" value="Si">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    

                                        <p 
                                        class="nombre card-title pt-2 text-center text-uppercase text-white" 
                                        id="disponiblesPlatillo_{{ $p->disponible }}"> 
                                            <strong 
                                            style="font-size: 15px; width:290px;
                                                background-color:rgba(95, 95, 95, 0.651);
                                                position: absolute; bottom: 22.5%; left:0;"
                                                >Disponibles: {{$p->disponible}}</strong
                                            >
                                        </p>  
                                        
                                        <p 
                                        class="nombre card-title pt-2 text-center text-dark" 
                                        id="nombrePlatillo_{{ $p->nombre }}"> 
                                            <strong 
                                            style="font-size: 20px; width:290px;
                                                background-color:rgba(255, 255, 255, 0.677);
                                                position: absolute; bottom: 11%; left:0;"
                                                >{{$p->nombre}}</strong
                                            >
                                        </p>  
                                        
                                        <p 
                                        class="nombre card-title pt-2 text-center text-dark" 
                                        id="precioplatillo_{{ $p->precio }}"> 
                                            <strong 
                                            style="font-size: 20px; width: 290px;
                                                background-color:rgba(255, 255, 255, 0.677);
                                                position: absolute; bottom: 0%; left:0;"
                                                >L {{$p->precio}}.00</strong
                                            >
                                        </p> 
                                                               
                                    </div>
                                </div>
                            </div>
                                
                        @empty
                            <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4 text-center">No hay registros</div>
                        @endforelse

                    </div>         
                    
                    <!-- ========== Cards Bebidas ========== -->
                    <div 
                    class="tab-pane fade" 
                    id="pills-bebidas" 
                    role="tabpanel"
                    aria-labelledby="pills-bebidas-tab">

                    
                        <div class="row">

                            <!--Boton Registrar-->
                            <div 
                            class="col-2 text-start"
                            style="margin: 4px">
                                <a 
                                href={{ route('bebidasyplatillos.create') }} 
                                class="btn btn-menu"
                                style="margin: 4px"
                                >Registrar Bebida</a
                                >
                            </div>
        
                            <!--Barra de busqueda-->
                            <div
                            class="col-4 p-2"  
                            style="display:; magin:2px">
                                <form 
                                action="{{ route('busqueda.index') }}" 
                                method="get" 
                                role="search"
                                class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" style="">
                                    <div class="input-group">
                                        <input 
                                        class="btn btn-rounded btn-menu" 
                                        id="busqueda" 
                                        name="busqueda"
                                        style="width: 200px" 
                                        placeholder="Buscar bebida" 
                                        aria-label="Search"
                                        aria-describedby="basic-addon2" 
                                        maxlength="50" required
                                        value="<?php if (isset($busqueda)) {
                                                echo $busqueda;
                                                } ?>" />
                                            <button 
                                            class="btn btn-rounded btn-menu" 
                                            type="submit"
                                            >Buscar</button
                                            >
                                            @if(isset($busqueda)!="")
                                            <a href="{{route('busqueda.index')}}" 
                                            class="btn btn-rounded btn-success"
                                            >Borrar Busqueda</a
                                            >
                                        @endif 
                                
                                    </div>
                                </form>
                            </div> 

                        </div>
                        
                        <div 
                        class="productosadmon" 
                        id="productosadmon"
                        style="display: grid; grid-template-columns: 300px 300px 300px 300px">
                            
                        @forelse ($bebidas as $p)
                            <div 
                            class="container" 
                            style="display:block;  height: 300px; width: 300px; padding: 5px ">   

                                <div 
                                class="card h-100" 
                                data-id="platillo_{{$p->id}}" 
                                style="padding: 0px; width:100%; border-radius:0%; background: url('/images/1676990334.Pollo-chuco-principal.png') top center/cover no-repeat;">
                                    <div 
                                    class="text-center" 
                                    style="text-align:center; ">
                                        
                                        <!-- Check activar-->
                                        <div class="form-check form-switch text-end">
                                            <input                                            
                                            data-bs-toggle="modal" 
                                            data-bs-target="#modalactivarproducto{{ $p->id }}"
                                            class="form-check-input" 
                                            checked='true' 
                                            type="checkbox"                                            
                                            name="chckBox_disponible"
                                            id="disponible"
                                            style="position:absolute; bottom: 90.5%; left: 290px"
                                            >
                                        </div>

                                        <!--Boton editar-->
                                        <a 
                                            class="btn btn-menu form btn-xs"
                                            href="{{ route('plato.editar', ['id' => $p->id]) }}"
                                            style="position:absolute; bottom: 27.5%; left:220px"
                                            >Editar</a
                                        >

                                        <!--Boton borrar-->
                                        <a 
                                        class="btn btn-danger form btn-xs"                                        
                                        data-bs-toggle="modal" 
                                        data-bs-target="#modalBorrarProducto{{ $p->id }}"
                                        style="position:absolute; bottom: 27.5%; left:150px"
                                        >Borrar</a
                                        >

                                        <!--Modal Eliminar-->
                                        <div 
                                        class="modal fade" 
                                        id="modalBorrarProducto{{ $p->id }}" 
                                        tabindex="-1"
                                        aria-labelledby="ModalLabel" 
                                        aria-hidden="true"
                                        data-bs-backdrop="static" 
                                        data-bs-keyboard="false">
                                        
                                            <div 
                                            class="modal-dialog"
                                            data-backdrop="static">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" 
                                                        id="ModalLabel">
                                                            Eliminar Platillo
                                                        </h5>
                                                        <button 
                                                        type="button" 
                                                        class="btn-close fs-5" 
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        ¿Está seguro de eliminar
                                                        <strong>{{ $p->nombre }}</strong>
                                                        del menú?
                                                    </div>
                                                    <div class="modal-footer">
                    
                                                        <form action="{{ route('platillo.borrar', ['id' => $p->id]) }}" method="GET">
                                                            @method('put')
                                                            @csrf
                                                            <div style="display: none">
                                                                <input type="number" id="activar" name="activar" value="0">
                                                            </div>
                                                            <button type="button" class="btn btn-menu"
                                                                data-bs-dismiss="modal">No</button>
                                                            <input type="submit" class="btn btn-danger" value="Si">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    
                                                                            
                                        <!--Modal activar-->
                                        <div 
                                        class="modal fade" 
                                        id="modalactivarproducto{{ $p->id }}" 
                                        tabindex=""
                                        aria-labelledby="ModalLabel" 
                                        
                                        data-bs-backdrop="static"
                                        data-bs-keyboard="false" 
                                        data-bs-keyboard="false">
                                        
                                            <div 
                                            class="modal-dialog"
                                            data-backdrop="static">
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <h5 class="modal-title" 
                                                            id="ModalLabel">
                                                            Disponibilidad
                                                        </h5>

                                                        <button 
                                                        type="button" 
                                                        class="btn-close close" 
                                                        data-bs-dismiss="modal"
                                                        aria-label="Close"></button>
                                                    </div>

                                                    <div class="modal-body">
                                                        ¿Deseea desactivar
                                                        <strong>{{ $p->nombre }}</strong>
                                                        del menú?
                                                    </div>

                                                    <div class="modal-footer">
                    
                                                        <form action="{{ route('menuAdmon.activar', ['id' => $p->id]) }}" method="POST">
                                                            @method('put')
                                                            @csrf
                                                            <div style="display: none">
                                                                <input type="number" id="activar" name="activar" value="0">
                                                            </div>
                                                            <button type="button" class="btn btn-menu"
                                                                data-bs-dismiss="modal">No</button>
                                                            <input type="submit" class="btn btn-danger" value="Si">
                                                        </form>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                    

                                        <p 
                                        class="nombre card-title pt-2 text-center text-uppercase text-white" 
                                        id="disponiblesPlatillo_{{ $p->disponible }}"> 
                                            <strong 
                                            style="font-size: 15px; width:290px;
                                                background-color:rgba(95, 95, 95, 0.651);
                                                position: absolute; bottom: 22.5%; left:0;"
                                                >Disponibles: {{$p->disponible}}</strong
                                            >
                                        </p>  
                                        
                                        <p 
                                        class="nombre card-title pt-2 text-center text-dark" 
                                        id="nombrePlatillo_{{ $p->nombre }}"> 
                                            <strong 
                                            style="font-size: 20px; width:290px;
                                                background-color:rgba(255, 255, 255, 0.677);
                                                position: absolute; bottom: 11%; left:0;"
                                                >{{$p->nombre}}</strong
                                            >
                                        </p>  
                                        
                                        <p 
                                        class="nombre card-title pt-2 text-center text-dark" 
                                        id="precioplatillo_{{ $p->precio }}"> 
                                            <strong 
                                            style="font-size: 20px; width: 290px;
                                                background-color:rgba(255, 255, 255, 0.677);
                                                position: absolute; bottom: 0%; left:0;"
                                                >L {{$p->precio}}.00</strong
                                            >
                                        </p> 
                                                                
                                    </div>
                                </div>
                            </div>
                                
                        @empty
                            <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4 text-center">No hay registros</div>
                        @endforelse

                    </div> 
                
                </div>

            </main> 
        </section>
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
                                                        Disponibles:{{ $p->disponible }}
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

<script src="/assets/jquery/jquery.js"></script>
<!-- ========== End Menu Descativado ========== -->
