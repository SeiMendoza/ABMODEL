@extends('00_plantillas_Blade.plantilla_General')
@section('title', 'Administración de Menu')
@section('info')


@endsection

@section('activatedMenu')

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
                timer: 2000
            })
        }

        @if ($errors->any())
            Swal.fire({
                position: 'top-end',
                icon: 'error',
                title: 'Existe un error, revise los datos',
                showConfirmButton: false,
                toast: true,
                background: '#fff',
                timer: 2000
            })
        @endif
    </script>

    <div class="row">
        <div class="container-fluid">
            <ul class="nav d-flex justify-content-center h4 text-center border-radius-lg" role="tablist"
                style="background-color: #ef3f3f; rounde">

                <li class="nav-item" role="presentation">
                    <a class="nav-link text-white" id="pills-bebidas-tab" data-bs-toggle="pill" data-bs-target="#pills-bebidas"
                        type="button" role="tab" aria-controls="pills-bebidas" aria-selected="true">Bebidas</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link active text-white" id="pills-platillos-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-platillos" type="button" role="tab" aria-controls="pills-platillos"
                        aria-selected="false">Platillos</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link text-white" id="pills-combos-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-combos" type="button" role="tab" aria-controls="pills-combos"
                        aria-selected="false">Combos</a>
                </li>

            </ul>
        </div>
    </div>

    <div class="table-responsive" id="pills-tabContent"
        style="height: 595px; overflow-y: scroll; overflow-x: hidden; scroll-behavior: smooth;">
        <section class="NovidadesSection" style="">
            <main class="main-content position-relative border-radius-lg">
                <div class="tab-content" id="pills-tabContent">

                    <!-- ========== Bebidas ========== -->
                    <div class="tab-pane fade " id="pills-bebidas" role="tabpanel" aria-labelledby="pills-home-tab">
                        <div class="container-fluid" style="padding: 0px">

                            <div class="row">
                                <!--Boton Registrar-->
                                <div class="col-2 text-start" style="margin: 4px">
                                    <a class="btn btn-menu" style="margin: 4px" data-bs-toggle="modal" 
                                    data-bs-target="#bebidaregistro">Registrar Bebida</a>
                                </div>
                                
                                <div class="modal" id="bebidaregistro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" 
                                    aria-labelledby="bebidaregistroLabel" aria-hidden="true">
                                    <div class=" modal-dialog">
                                    <div class="modal-content" style="width: 800px">
                                        <div class="modal-header">
                                        <h5 class="modal-title" id="bebidaregistroLabel">Agregar una nueva bebida</h5>
                                        </div>
                                        <form method="post" action="{{route('bebidas.store')}}" enctype="multipart/form-data">
                                            @csrf
                                            <div class="modal-body">
                                                <div style="float: left;">
                                                    <label for=""><strong>Seleccione una imagen:</strong></label>
                                                    <br>
                                                    <img src="" alt="" width="200px" height="200px" id="imagenmostrada1">
                                                    <br>
                                                    <input type="file" id="imagen1" name="imagen1" accept="image/*" required onchange="precargar(1)"
                                                        value="{{ old('imagenPrevisualizacion') }}" style="color: white;width: 200px;">
                                                    @error('imagen1')
                                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                                    @enderror
                                                </div>

                                                <div style="float: left; margin-left: 10px; width: 270px">
                                                    <label for=""><strong>Nombre bebida:</strong></label>
                                                    <input class="form-control" type="text" placeholder="Nombre de la bebida" name="nombre1"
                                                        value="{{ old('nombre1') }}" maxlength="25" required onkeypress="quitarerror()">
                                                    @error('nombre1')
                                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                                    @enderror
                                                    <br>
                                                    <label for=""><strong>Ingrese la descripcion del producto:</strong></label>
                                                    <textarea class="form-control" type="text" placeholder="Descripción" name="descripcion1" 
                                                    maxlength="100" required rows="5"
                                                    onkeypress="quitarerror()">{{ old('descripcion1') }}</textarea>
                                                    @error('descripcion1')
                                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                                    @enderror
                                                    <br><br>
                                                </div>

                                                <div style="float: left; margin-left: 10px; width: 270px">
                                                    <label for=""><strong>Seleccione el tamaño:</strong></label>
                                                    <select name="tamanio1" required onchange="quitarerror()" class="form-control">
                                                        @if (old('tamanio1'))
                                                            @if (old('tamanio1') === 'Grande')
                                                                <option style="display: none" selected="selected" value="Grande">Grande</option>
                                                            @else
                                                                @if (old('tamanio1') === 'Mediano')
                                                                    <option style="display: none" selected="selected" value="Mediano">Mediano
                                                                    </option>
                                                                @else
                                                                    @if (old('tamanio1') === 'Pequeño')
                                                                        <option style="display: none" selected="selected" value="Pequeño">Pequeño
                                                                        </option>
                                                                    @endif
                                                                @endif
                                                            @endif
                                                        @else
                                                            <option disabled="disabled" selected="selected" value="">Seleccione una opcion</option>
                                                        @endif
                                                        <option value="Grande">Grande</option>
                                                        <option value="Mediano">Mediano</option>
                                                        <option value="Pequeño">Pequeño</option>
                                                    </select>
                                                    @error('tamanio1')
                                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                                    @enderror

                                                    <br>
                                                    <label for=""><strong>Ingrese el precio:</strong></label>
                                                    <input class="form-control" type="number" placeholder="Precio" name="precio1" id="precio"
                                                    onkeypress="quitarerror()" step="any"
                                                    onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1" max="1000"
                                                    value="{{ old('precio1') }}"  required>
                                                    @error('precio1')
                                                        <strong class="menerr" style="color:red">{{ $message }}</strong>
                                                    @enderror

                                                    <br>
                                                    <label for=""><strong>Ingrese la cantidad de bebidas:</strong></label>
                                                    <input class="form-control" type="number" placeholder="Bebidas disponibles"
                                                        name="cantidad1" id="cantidad" value="{{ old('cantidad1') }}"
                                                        onkeypress="quitarerror()"
                                                        onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1"
                                                        max="1000">
                                                    @error('cantidad1')
                                                        <strong class="menerr" class="menerr" style="color:red">{{ $message }}</strong>
                                                    @enderror
                                                </div>
                                                <div style="float: right;margin-top: 20px">
                                                    <button type="button" onclick="cancelar('admonRestaurante')" class="btn btn-secondary" >Cerrar</button>
                                                    <button onclick="" type="submit" class="btn btn-info">Guardar</button>
                                                </div> 
                                            </div> 
                                        </form>
                                    </div>
                                    </div>
                                </div>

                                <!--Barra de busqueda-->
                                
                                <div class="col-8 p-2" style="display:; magin:2px">
                                    <form action="{{ route('busqueda.index') }}" method="get" role="search" 
                                      class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" style="">
                                       <div class="input-group">
                                            <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 200px" 
                                                placeholder="Buscar bebida" aria-label="Search" 
                                                 aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($busqueda)) {echo $busqueda;} ?>" />
                                                <button class="bg-success border-radius-md" type="submit" style="border: 0; color:aliceblue"><strong>Buscar</strong></button>    
                                                @if(isset($busqueda))
                                                     @if($busqueda != null)
                                                         <a href="{{ route('busqueda.index') }}" 
                                                         style="color:aliceblue; width:150px; padding:6px;"  
                                                         class="bg-secondary border-radius-md h-6 text-center"><strong>Borrar Busqueda</strong></a>
                                                    @endif
                                                 @endif
                                       </div>   
                                    </form>
                                 </div>
                            </div>
                            

                            <div class="productos" id="productos"
                                style="display: grid; grid-template-columns: 200px 200px 210px 200px 200px">

                                <div class="productosadmon" id="productosadmon"
                                    style="display: grid; grid-template-columns: 300px 300px 300px 300px">

                                    @php $exits = false; @endphp

                                    @forelse ($bebidas as $p)
                                        @if ($p->estado == 1)
                                            @php $exits = true; @endphp

                                            <div class="container"
                                                style="display:block;  height: 300px; width: 300px; padding: 5px ">

                                                <div class="card h-100" data-id="platillo_{{ $p->id }}"
                                                    style="padding: 0px; width:100%; border-radius:0%; background: url({{ $p->imagen }}) top center/cover no-repeat;">
                                                    <div class="text-center" style="text-align:center; ">

                                                        <!-- Check activar-->
                                                        <div id="activarBebida" class="form-check form-switch text-end">
                                                            <input data-bs-toggle="modal"
                                                                data-bs-target="#modalactivarBebida{{ $p->id }}"
                                                                class="form-check-input" checked='true' type="checkbox"
                                                                name="chckBox_disponible"
                                                                id="checkBebida{{ $p->id }}"
                                                                style="position:absolute; bottom: 90.5%; left: 290px">
                                                        </div>

                                                        <!--Boton editar-->
                                                        <a class="btn btn-menu form btn-xs"
                                                            href="{{ route('bebida.editar', ['id' => $p->id]) }}"
                                                            style="position:absolute; bottom: 27.5%; left:220px">Editar</a>

                                                        <!--Boton borrar-->
                                                        <a class="btn btn-danger form btn-xs" data-bs-toggle="modal"
                                                            data-bs-target="#modalBorrarBebida{{ $p->id }}"
                                                            style="position:absolute; bottom: 27.5%; left:150px">Borrar</a>

                                                        <!--Modal Eliminar-->
                                                        <div class="modal fade" id="modalBorrarBebida{{ $p->id }}"
                                                            tabindex="-1" aria-labelledby="ModalLabel"
                                                            aria-hidden="true" data-bs-backdrop="static"
                                                            data-bs-keyboard="false">

                                                            <div class="modal-dialog" data-backdrop="static">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ModalLabel">
                                                                            Eliminar Platillo
                                                                        </h5>
                                                                        <button type="button" class="btn-close fs-5"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        ¿Está seguro de eliminar
                                                                        <strong>{{ $p->nombre }}</strong>
                                                                        del menú?
                                                                    </div>
                                                                    <div class="modal-footer">

                                                                        <form
                                                                            action="{{ route('bebida.borrar', ['id' => $p->id]) }}"
                                                                            method="GET">
                                                                            @method('put')
                                                                            @csrf
                                                                            <div style="display: none">
                                                                                <input type="number" id="activar"
                                                                                    name="activar" value="0">
                                                                            </div>
                                                                            <button type="button" class="btn btn-menu"
                                                                                data-bs-dismiss="modal">No</button>
                                                                            <input type="submit" class="btn btn-danger"
                                                                                value="Si">
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!--Modal activar-->
                                                        <div class="modal fade"
                                                            id="modalactivarBebida{{ $p->id }}" tabindex=""
                                                            aria-labelledby="ModalLabel" data-bs-backdrop="static"
                                                            data-bs-keyboard="false" data-bs-keyboard="false">

                                                            <div class="modal-dialog" data-backdrop="static">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ModalLabel">
                                                                            Disponibilidad
                                                                        </h5>

                                                                        <button type="button" class="btn-close close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        ¿Deseea desactivar
                                                                        <strong>{{ $p->nombre }}</strong>
                                                                        del menú?
                                                                    </div>

                                                                    <div class="modal-footer">

                                                                        <form
                                                                            action="{{ route('bebida.activar', ['id' => $p->id]) }}"
                                                                            method="POST">
                                                                            @method('put')
                                                                            @csrf
                                                                            <div style="display: none">
                                                                                <input type="number" id="activar"
                                                                                    name="activar" value="0">
                                                                            </div>
                                                                            <button type="button" class="btn btn-menu"
                                                                                data-bs-dismiss="modal"
                                                                                onclick="cambiarCheck()">No</button>
                                                                            <input type="submit" class="btn btn-danger"
                                                                                value="Si">
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <p class="nombre card-title pt-2 text-center text-uppercase text-white"
                                                            id="disponiblesPlatillo_{{ $p->disponible }}">
                                                            <strong
                                                                style="font-size: 15px; width:290px; background-color:rgba(95, 95, 95, 0.651); position: absolute; bottom: 22.5%; left:0;">
                                                                Disponibles: {{ $p->disponible }}
                                                            </strong>
                                                        </p>

                                                        <p class="nombre card-title pt-2 text-center text-dark"
                                                            id="nombrePlatillo_{{ $p->nombre }}">
                                                            <strong
                                                                style="font-size: 20px; width:290px; background-color:rgba(255, 255, 255, 0.677);position: absolute; bottom: 11%; left:0;">
                                                                {{ $p->nombre }}
                                                            </strong>
                                                        </p>

                                                        <p class="nombre card-title pt-2 text-center text-dark"
                                                            id="precioplatillo_{{ $p->precio }}">
                                                            <strong
                                                                style="font-size: 20px; width: 290px; background-color:rgba(255, 255, 255, 0.677); position: absolute; bottom: 0%; left:0;">
                                                                L {{ $p->precio }}.00
                                                            </strong>
                                                        </p>

                                                    </div>
                                                </div>

                                            </div>
                                        @endif

                                    @empty
                                        <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4 text-center">No hay Bebidas</div>
                                    @endforelse

                                </div>
                            </div>

                            <!--Comprobacion que no hay ninguna bebida disponible-->
                            @if (!$exits)
                                <div class="col-12 text-center p-4">
                                    <h2>No hay Bebidas Disponibles</h2>
                                </div>
                            @endif

                        </div>
                    </div>

                    <!-- ========== Platillos ========== -->
                    <div class="tab-pane fade show active container" id="pills-platillos" role="tabpanel"
                        aria-labelledby="pills-profile-tab" style="padding: 0px; margin:0px; border:0px">
                        <div class="container-fluid" style="padding: 0px">

                            <div class="row">

                                <!--Boton Registrar-->
                                <div class="col-2 text-start" style="margin: 4px">
                                    <a class="btn btn-menu" data-bs-toggle="modal" data-bs-target="#platilloregistro"
                                        style="margin: 4px">Registrar Platillo</a>
                                </div>

                                <div class="modal" id="platilloregistro" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" 
                                aria-labelledby="platilloregistroLabel" aria-hidden="true">
                                <div class=" modal-dialog">
                                <div class="modal-content" style="width: 800px">
                                    <div class="modal-header">
                                    <h5 class="modal-title" id="platilloregistroLabel">Agregar un nuevo platillo</h5>
                                    </div>
                                    <form method="post" action="{{route('platillos.store')}}" enctype="multipart/form-data">
                                        @csrf
                                        <div class="modal-body">
                                            <div style="float: left;">
                                                <label for=""><strong>Seleccione una imagen:</strong></label>
                                                <br>
                                                <img src="" alt="" width="200px" height="200px" id="imagenmostrada2">
                                                <br>
                                                <input type="file" id="imagen2" name="imagen2" accept="image/*" required onchange="precargar(2)"
                                                    value="{{ old('imagenPrevisualizacion') }}" style="color: white;width: 200px;">
                                                @error('imagen')
                                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                                @enderror
                                            </div>

                                            <div style="float: left; margin-left: 10px; width: 270px">
                                                <label for=""><strong>Nombre platillo:</strong></label>
                                                <input class="form-control" type="text" placeholder="Nombre del platillo" name="nombre2"
                                                    value="{{ old('nombre2') }}" maxlength="25" required onkeypress="quitarerror()">
                                                @error('nombre2')
                                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                                @enderror
                                                <br>
                                                <label for=""><strong>Ingrese la descripcion del producto:</strong></label>
                                                <textarea class="form-control" type="text" placeholder="Descripción" name="descripcion2" 
                                                maxlength="100" required rows="5"
                                                onkeypress="quitarerror()">{{ old('descripcion2') }}</textarea>
                                                @error('descripcion2')
                                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                                @enderror
                                                <br><br>
                                            </div>

                                            <div style="float: left; margin-left: 10px; width: 270px">
                                                <label for=""><strong>Seleccione el tamaño:</strong></label>
                                                <select name="tamanio2" required onchange="quitarerror()" class="form-control">
                                                    @if (old('tamanio2'))
                                                        @if (old('tamanio2') === 'Grande')
                                                            <option style="display: none" selected="selected" value="Grande">Grande</option>
                                                        @else
                                                            @if (old('tamanio2') === 'Mediano')
                                                                <option style="display: none" selected="selected" value="Mediano">Mediano
                                                                </option>
                                                            @else
                                                                @if (old('tamanio2') === 'Pequeño')
                                                                    <option style="display: none" selected="selected" value="Pequeño">Pequeño
                                                                    </option>
                                                                @endif
                                                            @endif
                                                        @endif
                                                    @else
                                                        <option disabled="disabled" selected="selected" value="">Seleccione una opcion</option>
                                                    @endif
                                                    <option value="Grande">Grande</option>
                                                    <option value="Mediano">Mediano</option>
                                                    <option value="Pequeño">Pequeño</option>
                                                </select>
                                                @error('tamanio2')
                                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                                @enderror

                                                <br>
                                                <label for=""><strong>Ingrese el precio:</strong></label>
                                                <input class="form-control" type="number" placeholder="Precio" name="precio2" id="precio"
                                                onkeypress="quitarerror()" step="any"
                                                onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1" max="1000"
                                                value="{{ old('precio2') }}"  required>
                                                @error('precio2')
                                                    <strong class="menerr" style="color:red">{{ $message }}</strong>
                                                @enderror

                                                <br>
                                                <label for=""><strong>Ingrese la cantidad de platillo:</strong></label>
                                                <input class="form-control" type="number" placeholder="Platillos disponibles"
                                                name="disponible2" id="disponible" value="{{ old('disponible2') }}"
                                                    onkeypress="quitarerror()"
                                                    onkeydown="javascript: return event.keyCode == 69 ? false : true" min="1"
                                                    max="1000">
                                                @error('disponible2')
                                                    <strong class="menerr" class="menerr" style="color:red">{{ $message }}</strong>
                                                @enderror
                                            </div>
                                            <div style="float: right;margin-top: 20px">
                                                <button type="button" onclick="cancelar('admonRestaurante')" class="btn btn-secondary" >Cerrar</button>
                                                <button onclick="" type="submit" class="btn btn-info">Guardar</button>
                                            </div> 
                                        </div> 
                                    </form>
                                </div>
                                </div>
                                </div>

                                <!--Barra de busqueda-->
                                <div class="col-8 p-2" style="display:; magin:2px">
                                    <form action="{{ route('busqueda.index') }}" method="get" role="search" 
                                      class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" style="">
                                       <div class="input-group">
                                            <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 200px" 
                                                placeholder="Buscar platillo" aria-label="Search" 
                                                 aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($busqueda)) {echo $busqueda;} ?>" />
                                                <button class="bg-success border-radius-md" type="submit" style="border: 0; color:aliceblue"><strong>Buscar</strong></button>    
                                                @if(isset($busqueda))
                                                     @if($busqueda != null)
                                                         <a href="{{ route('busqueda.index') }}" 
                                                         style="color:aliceblue; width:150px; padding:6px;"  
                                                         class="bg-secondary border-radius-md h-6 text-center"><strong>Borrar Busqueda</strong></a>
                                                    @endif
                                                 @endif
                                       </div>   
                                    </form>
                                </div>
                            </div>

                            <div class="productos" id="productos"
                                style="display: grid; grid-template-columns: 200px 200px 210px 200px 200px">

                                <div class="productosadmon" id="productosadmon"
                                    style="display: grid; grid-template-columns: 300px 300px 300px 300px">

                                    @php $exits = false; @endphp

                                    @forelse ($platillos as $p)
                                        @if ($p->estado == 1)
                                            @php $exits = true; @endphp

                                            <div class="container"
                                                style="display:block;  height: 300px; width: 300px; padding: 5px ">

                                                <div class="card h-100" data-id="platillo_{{ $p->id }}"
                                                    style="padding: 0px; width:100%; border-radius:0%; background: url('/images/1676990334.Pollo-chuco-principal.png') top center/cover no-repeat;">
                                                    <div class="text-center" style="text-align:center; ">

                                                        <!-- Check activar-->
                                                        <div id="activarPlatillo" class="form-check form-switch text-end">
                                                            <input data-bs-toggle="modal"
                                                                data-bs-target="#modalactivarPlatillo{{ $p->id }}"
                                                                class="form-check-input" checked='true' type="checkbox"
                                                                name="chckBox_disponible" id="disponible"
                                                                style="position:absolute; bottom: 90.5%; left: 290px">
                                                        </div>

                                                        <!--Boton editar-->
                                                        <a class="btn btn-menu form btn-xs"
                                                            href="{{ route('plato.editar', ['id' => $p->id]) }}"
                                                            style="position:absolute; bottom: 27.5%; left:220px">Editar</a>

                                                        <!--Boton borrar-->
                                                        <a class="btn btn-danger form btn-xs" data-bs-toggle="modal"
                                                            data-bs-target="#modalBorrarProducto{{ $p->id }}"
                                                            style="position:absolute; bottom: 27.5%; left:150px">Borrar</a>

                                                        <!--Modal Eliminar-->
                                                        <div class="modal fade"
                                                            id="modalBorrarProducto{{ $p->id }}" tabindex="-1"
                                                            aria-labelledby="ModalLabel" aria-hidden="true"
                                                            data-bs-backdrop="static" data-bs-keyboard="false">

                                                            <div class="modal-dialog" data-backdrop="static">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ModalLabel">
                                                                            Eliminar Platillo
                                                                        </h5>
                                                                        <button type="button" class="btn-close fs-5"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        ¿Está seguro de eliminar
                                                                        <strong>{{ $p->nombre }}</strong>
                                                                        del menú?
                                                                    </div>
                                                                    <div class="modal-footer">

                                                                        <form
                                                                            action="{{ route('platillo.borrar', ['id' => $p->id]) }}"
                                                                            method="GET">
                                                                            @method('put')
                                                                            @csrf
                                                                            <div style="display: none">
                                                                                <input type="number" id="activar"
                                                                                    name="activar" value="0">
                                                                            </div>
                                                                            <button type="button" class="btn btn-menu"
                                                                                data-bs-dismiss="modal">No</button>
                                                                            <input type="submit" class="btn btn-danger"
                                                                                value="Si">
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!--Modal activar-->
                                                        <div class="modal fade"
                                                            id="modalactivarPlatillo{{ $p->id }}" tabindex=""
                                                            aria-labelledby="ModalLabel" data-bs-backdrop="static"
                                                            data-bs-keyboard="false" data-bs-keyboard="false">

                                                            <div class="modal-dialog" data-backdrop="static">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ModalLabel">
                                                                            Disponibilidad
                                                                        </h5>

                                                                        <button type="button" class="btn-close close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        ¿Deseea desactivar
                                                                        <strong>{{ $p->nombre }}</strong>
                                                                        del menú?
                                                                    </div>

                                                                    <div class="modal-footer">

                                                                        <form
                                                                            action="{{ route('platillo.activar', ['id' => $p->id]) }}"
                                                                            method="POST">
                                                                            @method('put')
                                                                            @csrf
                                                                            <div style="display: none">
                                                                                <input type="number" id="activar"
                                                                                    name="activar" value="0">
                                                                            </div>
                                                                            <button type="button" class="btn btn-menu"
                                                                                data-bs-dismiss="modal"
                                                                                onclick="cambiarCheck()">No</button>
                                                                            <input type="submit" class="btn btn-danger"
                                                                                value="Si">
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <p class="nombre card-title pt-2 text-center text-uppercase text-white"
                                                            id="disponiblesPlatillo_{{ $p->disponible }}">
                                                            <strong
                                                                style="font-size: 15px; width:290px;
                                                                background-color:rgba(95, 95, 95, 0.651);
                                                                position: absolute; bottom: 22.5%; left:0;">Disponibles:
                                                                {{ $p->disponible }}
                                                            </strong>
                                                        </p>

                                                        <p class="nombre card-title pt-2 text-center text-dark"
                                                            id="nombrePlatillo_{{ $p->nombre }}">
                                                            <strong
                                                                style="font-size: 20px; width:290px; background-color:rgba(255, 255, 255, 0.677); position: absolute; bottom: 11%; left:0;">
                                                                {{ $p->nombre }}
                                                            </strong>
                                                        </p>

                                                        <p class="nombre card-title pt-2 text-center text-dark"
                                                            id="precioplatillo_{{ $p->precio }}">
                                                            <strong
                                                                style="font-size: 20px; width: 290px;  background-color:rgba(255, 255, 255, 0.677);position: absolute; bottom: 0%; left:0;">
                                                                L {{ $p->precio }}.00
                                                            </strong>
                                                        </p>

                                                    </div>
                                                </div>

                                            </div>
                                        @endif

                                    @empty
                                        <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4 text-center">No hay registros</div>
                                    @endforelse

                                </div>
                            </div>

                            <!--Comprobacion que no hay ninguna platillo disponible-->
                            @if (!$exits)
                                <div class="col-12 text-center p-4">
                                    <h2>No hay Platillos Disponibles</h2>
                                </div>
                            @endif

                        </div>
                    </div>

                    <!-- ========== Combos ========== -->
                    <div class="tab-pane fade" id="pills-combos" role="tabpanel" aria-labelledby="pills-contact-tab">
                        <div class="container-fluid" style="padding: 0px">

                            <div class="row">

                                <!--Boton Registrar-->
                                <div class="col-2 text-start" style="margin: 4px">
                                    <a href={{ route('combo.create') }} class="btn btn-menu"
                                        style="margin: 4px">Registrar combo</a>
                                </div>

                                <!--Barra de busqueda-->
                                <div class="col-8 p-2" style="display:; magin:2px">
                                    <form action="{{ route('busqueda.index') }}" method="get" role="search" 
                                      class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" style="">
                                       <div class="input-group">
                                            <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 200px" 
                                                placeholder="Buscar combo" aria-label="Search" 
                                                 aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($busqueda)) {echo $busqueda;} ?>" />
                                                <button class="bg-success border-radius-md" type="submit" style="border: 0; color:aliceblue"><strong>Buscar</strong></button>    
                                                @if(isset($busqueda))
                                                     @if($busqueda != null)
                                                         <a href="{{ route('busqueda.index') }}" 
                                                         style="color:aliceblue; width:150px; padding:6px;"  
                                                         class="bg-secondary border-radius-md h-6 text-center"><strong>Borrar Busqueda</strong></a>
                                                    @endif
                                                 @endif
                                       </div>   
                                    </form>
                                </div>
                            </div>


                            <div class="productos" id="productos"
                                style="display: grid; grid-template-columns: 200px 200px 210px 200px 200px">

                                <div class="productosadmon" id="productosadmon"
                                    style="display: grid; grid-template-columns: 300px 300px 300px 300px">

                                    @php $exits = false; @endphp

                                    @forelse ($combos as $p)
                                        @if ($p->estado == 1)
                                            @php $exits = true; @endphp
                                            <div class="container"
                                                style="display:block;  height: 300px; width: 300px; padding: 5px ">

                                                <div class="card h-100" data-id="combo_{{ $p->id }}"
                                                    style="padding: 0px; width:100%; border-radius:0%; background: url('/images/1677456792.tacos.jpg') top center/cover no-repeat;">
                                                    <div class="text-center" style="text-align:center; ">

                                                        <div id="activarCombo" class="form-check form-switch text-end">
                                                            <input data-bs-toggle="modal"
                                                                data-bs-target="#modalactivarCombo{{ $p->id }}"
                                                                class="form-check-input" checked='true' type="checkbox"
                                                                name="chckBox_disponible"
                                                                id="checkBebida{{ $p->id }}"
                                                                style="position:absolute; bottom: 90.5%; left: 290px">
                                                        </div>

                                                        <!--Boton editar-->
                                                        <a class="btn btn-menu form btn-xs"
                                                            href="{{ route('bebida.editar', ['id' => $p->id]) }}"
                                                            style="position:absolute; bottom: 27.5%; left:220px">Editar</a>

                                                        <!--Boton borrar-->
                                                        <a class="btn btn-danger form btn-xs" data-bs-toggle="modal"
                                                            data-bs-target="#modalBorrarProducto{{ $p->id }}"
                                                            style="position:absolute; bottom: 27.5%; left:150px">Borrar</a>

                                                        <!--Modal Eliminar-->
                                                        <div class="modal fade"
                                                            id="modalBorrarProducto{{ $p->id }}" tabindex="-1"
                                                            aria-labelledby="ModalLabel" aria-hidden="true"
                                                            data-bs-backdrop="static" data-bs-keyboard="false">

                                                            <div class="modal-dialog" data-backdrop="static">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ModalLabel">
                                                                            Eliminar Platillo
                                                                        </h5>
                                                                        <button type="button" class="btn-close fs-5"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        ¿Está seguro de eliminar
                                                                        <strong>{{ $p->nombre }}</strong>
                                                                        del menú?
                                                                    </div>
                                                                    <div class="modal-footer">

                                                                        <form
                                                                            action="{{ route('combo.borrar', ['id' => $p->id]) }}"
                                                                            method="GET">
                                                                            @method('put')
                                                                            @csrf
                                                                            <div style="display: none">
                                                                                <input type="number" id="activar"
                                                                                    name="activar" value="0">
                                                                            </div>
                                                                            <button type="button" class="btn btn-menu"
                                                                                data-bs-dismiss="modal">No</button>
                                                                            <input type="submit" class="btn btn-danger"
                                                                                value="Si">
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!--Modal activar-->
                                                        <div class="modal fade" id="modalactivarCombo{{ $p->id }}"
                                                            tabindex="" aria-labelledby="ModalLabel"
                                                            data-bs-backdrop="static" data-bs-keyboard="false"
                                                            data-bs-keyboard="false">

                                                            <div class="modal-dialog" data-backdrop="static">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ModalLabel">
                                                                            Disponibilidad
                                                                        </h5>

                                                                        <button type="button" class="btn-close close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        ¿Deseea desactivar
                                                                        <strong>{{ $p->nombre }}</strong>
                                                                        del menú?
                                                                    </div>

                                                                    <div class="modal-footer">

                                                                        <form
                                                                            action="{{ route('combo.activar', ['id' => $p->id]) }}"
                                                                            method="POST">
                                                                            @method('put')
                                                                            @csrf
                                                                            <div style="display: none">
                                                                                <input type="number" id="activar"
                                                                                    name="activar" value="0">
                                                                            </div>
                                                                            <button type="button" class="btn btn-menu"
                                                                                data-bs-dismiss="modal">No</button>
                                                                            <input type="submit" class="btn btn-danger"
                                                                                value="Si">
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>


                                                        <p class="nombre card-title pt-2 text-center text-uppercase text-white"
                                                            id="disponiblesPlatillo_{{ $p->disponible }}">
                                                            <strong
                                                                style="font-size: 15px; width:290px;
                                                        background-color:rgba(95, 95, 95, 0.651);
                                                        position: absolute; bottom: 22.5%; left:0;">Disponibles:
                                                                {{ $p->disponible }}</strong>
                                                        </p>

                                                        <p class="nombre card-title pt-2 text-center text-dark"
                                                            id="nombrePlatillo_{{ $p->nombre }}">
                                                            <strong
                                                                style="font-size: 20px; width:290px;
                                                        background-color:rgba(255, 255, 255, 0.677);
                                                        position: absolute; bottom: 11%; left:0;">{{ $p->nombre }}</strong>
                                                        </p>

                                                        <p class="nombre card-title pt-2 text-center text-dark"
                                                            id="precioplatillo_{{ $p->precio }}">
                                                            <strong
                                                                style="font-size: 20px; width: 290px;
                                                        background-color:rgba(255, 255, 255, 0.677);
                                                        position: absolute; bottom: 0%; left:0;">L
                                                                {{ $p->precio }}.00</strong>
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    @empty
                                        <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4 text-center">No hay Bebidas</div>
                                    @endforelse
                                </div>
                            </div>

                            <!--Comprobacion que no hay ningun combo disponible-->
                            @if (!$exits)
                                <div class="col-12 text-center p-4">
                                    <h2>No hay combos disponibles</h2>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>

            </main>
        </section>
    </div>


@endsection

@section('disabledMenu')

    <br>
    <br>
    <br>

    <div class="container-fluid">

        <div class="row text-center container pt-2">
            <h1 class="card text-white text-uppercase p-2" style="font-size: 2rem; background-color: #807c7c;">Menu de
                Productos No Disponibles
            </h1>
        </div>
    </div>

    <div class="row">
        <div class="container-fluid">
            <ul class="nav d-flex justify-content-center h4 text-center border-radius-lg" role="tablist"
                style="background-color: #807c7c; rounde">

                <li class="nav-item" role="presentation">
                    <a class="nav-link text-white" id="pills-bebidas-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-bebidas-desactivados" type="button" role="tab"
                        aria-controls="pills-bebidas" aria-selected="true">Bebidas</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link active text-white" id="pills-platillos-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-platillos-desactivados" type="button" role="tab"
                        aria-controls="pills-platillos" aria-selected="false">Platillos</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a class="nav-link text-white" id="pills-combos-tab" data-bs-toggle="pill"
                        data-bs-target="#pills-combos-desactivados" type="button" role="tab"
                        aria-controls="pills-combos" aria-selected="false">Combos</a>
                </li>

            </ul>
        </div>
    </div>

    <div class="table-responsive" id="pills-tabContent"
        style="height: 595px; overflow-y: scroll; overflow-x: hidden; scroll-behavior: smooth;">
        <section class="NovidadesSection" style="">
            <main class="main-content position-relative border-radius-lg">
                <div class="tab-content" id="pills-tabContent">

                    <!-- ========== Bebidas ========== -->
                    <div class="tab-pane fade " id="pills-bebidas-desactivados" role="tabpanel"
                        aria-labelledby="pills-home-tab">
                        <div class="container-fluid" style="padding: 0px">

                            <div class="row">

                                <!--Barra de busqueda-->
                                <div class="col-8 p-2" style="display:; magin:2px">
                                    <form action="{{ route('busqueda.index') }}" method="get" role="search" 
                                      class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" style="">
                                       <div class="input-group">
                                            <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 200px" 
                                                placeholder="Buscar bebida" aria-label="Search" 
                                                 aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($busqueda)) {echo $busqueda;} ?>" />
                                                <button class="bg-success border-radius-md" type="submit" style="border: 0; color:aliceblue"><strong>Buscar</strong></button>    
                                                @if(isset($busqueda))
                                                     @if($busqueda != null)
                                                         <a href="{{ route('busqueda.index') }}" 
                                                         style="color:aliceblue; width:150px; padding:6px;"  
                                                         class="bg-secondary border-radius-md h-6 text-center"><strong>Borrar Busqueda</strong></a>
                                                    @endif
                                                 @endif
                                       </div>   
                                    </form>
                                 </div>
                            </div>

                            <div class="productos" id="productos"
                                style="display: grid; grid-template-columns: 200px 200px 210px 200px 200px">

                                <div class="productosadmon" id="productosadmon"
                                    style="display: grid; grid-template-columns: 300px 300px 300px 300px">

                                    @php $exits = false; @endphp

                                    @forelse ($bebidas as $p)
                                        @if ($p->estado == 0)
                                            @php $exits = true; @endphp
                                            <div
                                                class="container"style="display:block;  height: 300px; width: 300px; padding: 5px ">

                                                <div class="card h-100" data-id="platillo_{{ $p->id }}"
                                                    style="padding: 0px; width:100%; border-radius:0%; background: url({{ $p->imagen }}) top center/cover no-repeat;">
                                                    <div class="text-center" style="text-align:center; ">

                                                        <!-- Check activar-->
                                                        <div id="activarBebida" class="form-check form-switch text-end">
                                                            <input data-bs-toggle="modal"
                                                                data-bs-target="#modalactivarBebida{{ $p->id }}"
                                                                class="form-check-input" checked='true' type="checkbox"
                                                                name="chckBox_disponible"
                                                                id="checkBebida{{ $p->id }}"
                                                                style="position:absolute; bottom: 90.5%; left: 290px">
                                                        </div>

                                                        <!--Boton editar-->
                                                        <a class="btn btn-menu form btn-xs"
                                                            href="{{ route('bebida.editar', ['id' => $p->id]) }}"
                                                            style="position:absolute; bottom: 27.5%; left:220px">Editar</a>

                                                        <!--Boton borrar-->
                                                        <a class="btn btn-danger form btn-xs" data-bs-toggle="modal"
                                                            data-bs-target="#modalBorrarBebida{{ $p->id }}"
                                                            style="position:absolute; bottom: 27.5%; left:150px">Borrar</a>

                                                        <!--Modal Eliminar-->
                                                        <div class="modal fade" id="modalBorrarBebida{{ $p->id }}"
                                                            tabindex="-1" aria-labelledby="ModalLabel"
                                                            aria-hidden="true" data-bs-backdrop="static"
                                                            data-bs-keyboard="false">

                                                            <div class="modal-dialog" data-backdrop="static">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ModalLabel">
                                                                            Eliminar Platillo
                                                                        </h5>
                                                                        <button type="button" class="btn-close fs-5"
                                                                            data-bs-dismiss="modal" aria-label="Close">
                                                                        </button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        ¿Está seguro de eliminar
                                                                        <strong>{{ $p->nombre }}</strong>
                                                                        del menú?
                                                                    </div>
                                                                    <div class="modal-footer">

                                                                        <form
                                                                            action="{{ route('bebida.borrar', ['id' => $p->id]) }}"
                                                                            method="GET">
                                                                            @method('put')
                                                                            @csrf
                                                                            <div style="display: none">
                                                                                <input type="number" id="activar"
                                                                                    name="activar" value="0">
                                                                            </div>
                                                                            <button type="button" class="btn btn-menu"
                                                                                data-bs-dismiss="modal">No</button>
                                                                            <input type="submit" class="btn btn-danger"
                                                                                value="Si">
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!--Modal activar-->
                                                        <div class="modal fade"
                                                            id="modalactivarBebida{{ $p->id }}" tabindex=""
                                                            aria-labelledby="ModalLabel" data-bs-backdrop="static"
                                                            data-bs-keyboard="false" data-bs-keyboard="false">

                                                            <div class="modal-dialog" data-backdrop="static">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ModalLabel">
                                                                            Disponibilidad
                                                                        </h5>

                                                                        <button type="button" class="btn-close close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        ¿Deseea activar
                                                                        <strong>{{ $p->nombre }}</strong>
                                                                        del menú?
                                                                    </div>

                                                                    <div class="modal-footer">

                                                                        <form
                                                                            action="{{ route('bebida.activar', ['id' => $p->id]) }}"
                                                                            method="POST">
                                                                            @method('put')
                                                                            @csrf
                                                                            <div style="display: none">
                                                                                <input type="number" id="activar"
                                                                                    name="activar" value="1">
                                                                            </div>
                                                                            <button type="button" class="btn btn-menu"
                                                                                data-bs-dismiss="modal"
                                                                                onclick="cambiarCheck()">No</button>
                                                                            <input type="submit" class="btn btn-danger"
                                                                                value="Si">
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <p class="nombre card-title pt-2 text-center text-uppercase text-white"
                                                            id="disponiblesPlatillo_{{ $p->disponible }}">
                                                            <strong
                                                                style="font-size: 15px; width:290px; background-color:rgba(95, 95, 95, 0.651); position: absolute; bottom: 22.5%; left:0;">Disponibles:{{ $p->disponible }}
                                                            </strong>
                                                        </p>

                                                        <p class="nombre card-title pt-2 text-center text-dark"
                                                            id="nombrePlatillo_{{ $p->nombre }}">
                                                            <strong
                                                                style="font-size: 20px; width:290px; background-color:rgba(255, 255, 255, 0.677); position: absolute; bottom: 11%; left:0;">
                                                                {{ $p->nombre }}
                                                            </strong>
                                                        </p>

                                                        <p class="nombre card-title pt-2 text-center text-dark"
                                                            id="precioplatillo_{{ $p->precio }}">
                                                            <strong
                                                                style="font-size: 20px; width: 290px; background-color:rgba(255, 255, 255, 0.677); position: absolute; bottom: 0%; left:0;">
                                                                L {{ $p->precio }}.00
                                                            </strong>
                                                        </p>

                                                    </div>
                                                </div>

                                            </div>
                                        @endif

                                    @empty
                                        <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4 text-center">No hay Bebidas</div>
                                    @endforelse
                                </div>
                            </div>

                            <!--Comprobacion que no hay todas las bebidas est[an] disponibles-->
                            @if (!$exits)
                                <div class="col-12 text-center p-4">
                                    <h2>Todas las Bebidas están Disponibles</h2>
                                </div>
                            @endif

                        </div>
                    </div>

                    <!-- ========== Platillos ========== -->
                    <div class="tab-pane fade show active container" id="pills-platillos-desactivados" role="tabpanel"
                        aria-labelledby="pills-profile-tab" style="padding: 0px; margin:0px; border:0px">
                        <div class="container-fluid" style="padding: 0px">

                            <div class="row">

                                <!--Barra de busqueda-->
                                <div class="col-8 p-2" style="display:; magin:2px">
                                    <form action="{{ route('busqueda.index') }}" method="get" role="search" 
                                      class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" style="">
                                       <div class="input-group">
                                            <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 200px" 
                                                placeholder="Buscar platillo" aria-label="Search" 
                                                 aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($busqueda)) {echo $busqueda;} ?>" />
                                                <button class="bg-success border-radius-md" type="submit" style="border: 0; color:aliceblue"><strong>Buscar</strong></button>    
                                                @if(isset($busqueda))
                                                     @if($busqueda != null)
                                                         <a href="{{ route('busqueda.index') }}" 
                                                         style="color:aliceblue; width:150px; padding:6px;"  
                                                         class="bg-secondary border-radius-md h-6 text-center"><strong>Borrar Busqueda</strong></a>
                                                    @endif
                                                 @endif
                                       </div>   
                                    </form>
                                 </div>
                            </div>

                            <div class="productos" id="productos"
                                style="display: grid; grid-template-columns: 200px 200px 210px 200px 200px">

                                <div class="productosadmon" id="productosadmon"
                                    style="display: grid; grid-template-columns: 300px 300px 300px 300px">

                                    @php $exits = false; @endphp

                                    @forelse ($platillos as $p)
                                        @if ($p->estado == 0)
                                            @php $exits = true; @endphp
                                            <div class="container"
                                                style="display:block;  height: 300px; width: 300px; padding: 5px ">

                                                <div class="card h-100" data-id="platillo_{{ $p->id }}"
                                                    style="padding: 0px; width:100%; border-radius:0%; background: url('/images/1676990334.Pollo-chuco-principal.png') top center/cover no-repeat;">
                                                    <div class="text-center" style="text-align:center; ">

                                                        <!-- Check activar-->
                                                        <div id="activarPlatillo" class="form-check form-switch text-end">
                                                            <input data-bs-toggle="modal"
                                                                data-bs-target="#modalactivarPlatillo{{ $p->id }}"
                                                                class="form-check-input" checked='true' type="checkbox"
                                                                name="chckBox_disponible" id="disponible"
                                                                style="position:absolute; bottom: 90.5%; left: 290px">
                                                        </div>

                                                        <!--Boton editar-->
                                                        <a class="btn btn-menu form btn-xs"
                                                            href="{{ route('plato.editar', ['id' => $p->id]) }}"
                                                            style="position:absolute; bottom: 27.5%; left:220px">Editar</a>

                                                        <!--Boton borrar-->
                                                        <a class="btn btn-danger form btn-xs" data-bs-toggle="modal"
                                                            data-bs-target="#modalBorrarProducto{{ $p->id }}"
                                                            style="position:absolute; bottom: 27.5%; left:150px">Borrar</a>

                                                        <!--Modal Eliminar-->
                                                        <div class="modal fade"
                                                            id="modalBorrarProducto{{ $p->id }}" tabindex="-1"
                                                            aria-labelledby="ModalLabel" aria-hidden="true"
                                                            data-bs-backdrop="static" data-bs-keyboard="false">

                                                            <div class="modal-dialog" data-backdrop="static">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ModalLabel">
                                                                            Eliminar Platillo
                                                                        </h5>
                                                                        <button type="button" class="btn-close fs-5"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        ¿Está seguro de eliminar
                                                                        <strong>{{ $p->nombre }}</strong>
                                                                        del menú?
                                                                    </div>
                                                                    <div class="modal-footer">

                                                                        <form
                                                                            action="{{ route('platillo.borrar', ['id' => $p->id]) }}"
                                                                            method="GET">
                                                                            @method('put')
                                                                            @csrf
                                                                            <div style="display: none">
                                                                                <input type="number" id="activar"
                                                                                    name="activar" value="0">
                                                                            </div>
                                                                            <button type="button" class="btn btn-menu"
                                                                                data-bs-dismiss="modal">No</button>
                                                                            <input type="submit" class="btn btn-danger"
                                                                                value="Si">
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!--Modal activar-->
                                                        <div class="modal fade"
                                                            id="modalactivarPlatillo{{ $p->id }}" tabindex=""
                                                            aria-labelledby="ModalLabel" data-bs-backdrop="static"
                                                            data-bs-keyboard="false" data-bs-keyboard="false">

                                                            <div class="modal-dialog" data-backdrop="static">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ModalLabel">
                                                                            Disponibilidad
                                                                        </h5>

                                                                        <button type="button" class="btn-close close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        ¿Deseea activar
                                                                        <strong>{{ $p->nombre }}</strong>
                                                                        del menú?
                                                                    </div>

                                                                    <div class="modal-footer">

                                                                        <form
                                                                            action="{{ route('platillo.activar', ['id' => $p->id]) }}"
                                                                            method="POST">
                                                                            @method('put')
                                                                            @csrf
                                                                            <div style="display: none">
                                                                                <input type="number" id="activar"
                                                                                    name="activar" value="1">
                                                                            </div>
                                                                            <button type="button" class="btn btn-menu"
                                                                                data-bs-dismiss="modal"
                                                                                onclick="cambiarCheck()">No</button>
                                                                            <input type="submit" class="btn btn-danger"
                                                                                value="Si">
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <p class="nombre card-title pt-2 text-center text-uppercase text-white"
                                                            id="disponiblesPlatillo_{{ $p->disponible }}">
                                                            <strong
                                                                style="font-size: 15px; width:290px;
                                                            background-color:rgba(95, 95, 95, 0.651);
                                                            position: absolute; bottom: 22.5%; left:0;">Disponibles:
                                                                {{ $p->disponible }}
                                                            </strong>
                                                        </p>

                                                        <p class="nombre card-title pt-2 text-center text-dark"
                                                            id="nombrePlatillo_{{ $p->nombre }}">
                                                            <strong
                                                                style="font-size: 20px; width:290px; background-color:rgba(255, 255, 255, 0.677); position: absolute; bottom: 11%; left:0;">
                                                                {{ $p->nombre }}
                                                            </strong>
                                                        </p>

                                                        <p class="nombre card-title pt-2 text-center text-dark"
                                                            id="precioplatillo_{{ $p->precio }}">
                                                            <strong
                                                                style="font-size: 20px; width: 290px;  background-color:rgba(255, 255, 255, 0.677);position: absolute; bottom: 0%; left:0;">
                                                                L {{ $p->precio }}.00
                                                            </strong>
                                                        </p>

                                                    </div>
                                                </div>

                                            </div>
                                        @endif

                                    @empty
                                        <div class="col-12 text-center p-4">No hay registros</div>
                                    @endforelse

                                </div>
                            </div>

                            <!--Comprobacion que no hay ninguna bebida disponible-->
                            @if (!$exits)
                                <div class="col-12 text-center p-4">
                                    <h2>Todos los Platillos están Disponibles</h2>
                                </div>
                            @endif

                        </div>
                    </div>

                    <!-- ========== Combos ========== -->
                    <div class="tab-pane fade" id="pills-combos-desactivados" role="tabpanel"
                        aria-labelledby="pills-contact-tab">
                        <div class="container-fluid" style="padding: 0px">

                            <div class="row">

                                <!--Barra de busqueda-->
                                <div class="col-8 p-2" style="display:; magin:2px">
                                    <form action="{{ route('busqueda.index') }}" method="get" role="search" 
                                      class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search" style="">
                                       <div class="input-group">
                                            <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 200px" 
                                                placeholder="Buscar combo" aria-label="Search" 
                                                 aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($busqueda)) {echo $busqueda;} ?>" />
                                                <button class="bg-success border-radius-md" type="submit" style="border: 0; color:aliceblue"><strong>Buscar</strong></button>    
                                                @if(isset($busqueda))
                                                     @if($busqueda != null)
                                                         <a href="{{ route('busqueda.index') }}" 
                                                         style="color:aliceblue; width:150px; padding:6px;"  
                                                         class="bg-secondary border-radius-md h-6 text-center"><strong>Borrar Busqueda</strong></a>
                                                    @endif
                                                 @endif
                                       </div>   
                                    </form>
                                 </div>
                            </div>


                            <div class="productos" id="productos"
                                style="display: grid; grid-template-columns: 200px 200px 210px 200px 200px">

                                <div class="productosadmon" id="productosadmon"
                                    style="display: grid; grid-template-columns: 300px 300px 300px 300px">

                                    @php $exits = false; @endphp

                                    @forelse ($combos as $p)
                                        @if ($p->estado == 0)
                                            @php $exits = true; @endphp
                                            <div class="container"
                                                style="display:block;  height: 300px; width: 300px; padding: 5px ">

                                                <div class="card h-100" data-id="combo_{{ $p->id }}"
                                                    style="padding: 0px; width:100%; border-radius:0%; background: url('/images/1677456792.tacos.jpg') top center/cover no-repeat;">
                                                    <div class="text-center" style="text-align:center; ">

                                                        <div id="activarCombo" class="form-check form-switch text-end">
                                                            <input data-bs-toggle="modal"
                                                                data-bs-target="#modalactivarCombo{{ $p->id }}"
                                                                class="form-check-input" checked='false' type="checkbox"
                                                                name="chckBox_disponible"
                                                                id="checkBebida{{ $p->id }}"
                                                                style="position:absolute; bottom: 90.5%; left: 290px">
                                                        </div>

                                                        <!--Boton editar-->
                                                        <a class="btn btn-menu form btn-xs"
                                                            href="{{ route('bebida.editar', ['id' => $p->id]) }}"
                                                            style="position:absolute; bottom: 27.5%; left:220px">Editar</a>

                                                        <!--Boton borrar-->
                                                        <a class="btn btn-danger form btn-xs" data-bs-toggle="modal"
                                                            data-bs-target="#modalBorrarProducto{{ $p->id }}"
                                                            style="position:absolute; bottom: 27.5%; left:150px">Borrar</a>

                                                        <!--Modal Eliminar-->
                                                        <div class="modal fade"
                                                            id="modalBorrarProducto{{ $p->id }}" tabindex="-1"
                                                            aria-labelledby="ModalLabel" aria-hidden="true"
                                                            data-bs-backdrop="static" data-bs-keyboard="false">

                                                            <div class="modal-dialog" data-backdrop="static">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ModalLabel">
                                                                            Eliminar Combo
                                                                        </h5>
                                                                        <button type="button" class="btn-close fs-5"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        ¿Está seguro de eliminar
                                                                        <strong>{{ $p->nombre }}</strong>
                                                                        del menú?
                                                                    </div>
                                                                    <div class="modal-footer">

                                                                        <form
                                                                            action="{{ route('combo.borrar', ['id' => $p->id]) }}"
                                                                            method="GET">
                                                                            @method('put')
                                                                            @csrf
                                                                            <div style="display: none">
                                                                                <input type="number" id="activar"
                                                                                    name="activar" value="0">
                                                                            </div>
                                                                            <button type="button" class="btn btn-menu"
                                                                                data-bs-dismiss="modal">No</button>
                                                                            <input type="submit" class="btn btn-danger"
                                                                                value="Si">
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>


                                                        <!--Modal activar-->
                                                        <div class="modal fade"
                                                            id="modalactivarCombo{{ $p->id }}" tabindex=""
                                                            aria-labelledby="ModalLabel" data-bs-backdrop="static"
                                                            data-bs-keyboard="false" data-bs-keyboard="false">

                                                            <div class="modal-dialog" data-backdrop="static">
                                                                <div class="modal-content">
                                                                    <div class="modal-header">
                                                                        <h5 class="modal-title" id="ModalLabel">
                                                                            Disponibilidad
                                                                        </h5>

                                                                        <button type="button" class="btn-close close"
                                                                            data-bs-dismiss="modal"
                                                                            aria-label="Close"></button>
                                                                    </div>

                                                                    <div class="modal-body">
                                                                        ¿Deseea activar
                                                                        <strong>{{ $p->nombre }}</strong>
                                                                        del menú?
                                                                    </div>

                                                                    <div class="modal-footer">

                                                                        <form
                                                                            action="{{ route('combo.activar', ['id' => $p->id]) }}"
                                                                            method="POST">
                                                                            @method('put')
                                                                            @csrf
                                                                            <div style="display: none">
                                                                                <input type="number" id="activar"
                                                                                    name="activar" value="1">
                                                                            </div>
                                                                            <button type="button" class="btn btn-menu"
                                                                                data-bs-dismiss="modal">No</button>
                                                                            <input type="submit" class="btn btn-danger"
                                                                                value="Si">
                                                                        </form>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                        </div>


                                                        
                                                       

                                                        <p class="nombre card-title pt-2 text-center text-dark"
                                                            id="nombrePlatillo_{{ $p->nombre }}">
                                                            <strong
                                                                style="font-size: 20px; width:290px;
                                                        background-color:rgba(255, 255, 255, 0.677);
                                                        position: absolute; bottom: 11%; left:0;">{{ $p->nombre }}</strong>
                                                        </p>

                                                        <p class="nombre card-title pt-2 text-center text-dark"
                                                            id="precioplatillo_{{ $p->precio }}">
                                                            <strong
                                                                style="font-size: 20px; width: 290px;
                                                        background-color:rgba(255, 255, 255, 0.677);
                                                        position: absolute; bottom: 0%; left:0;">L
                                                                {{ $p->precio }}.00</strong>
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        @endif

                                    @empty
                                        <div class="col-xl-4 col-sm-6 mb-xl-4 mb-4 text-center">No hay Bebidas</div>
                                    @endforelse
                                </div>
                            </div>

                            <!--Comprobacion que no hay ninguna combo disponible-->
                            @if (!$exits)
                                <div class="col-12 text-center p-4">
                                    <h2>Todos los Combos están Disponibles</h2>
                                </div>
                            @endif

                        </div>
                    </div>

                </div>
            </main>
        </section>
    </div>


@endsection
