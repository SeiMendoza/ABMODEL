@extends('00_plantillas_Blade.plantilla_General2')

@section('miga')
    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Administración de menú</li>
@endsection

@section('title', 'Administración de menú')

@section('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endsection

@section('tit', 'Administración de menú')

@section('b')
    <!-- Botón registrar -->
    <div>
        <a href="{{ route('bebidasyplatillos.create', ['origen' => 0]) }}" style="margin:8px; padding:5px; width:200px;"
            type="button" class="bg-light border-radius-sm text-center">
            <i class="fa fa-plus-circle"></i> Agregar Productos
        </a>
    </div>
    <div>
        <a href="{{ route('menu.menu') }}" style="margin:0; padding:5px; width:160px;" type="button"
            class="bg-light border-radius-sm text-center ">
            <i class="fa fa-users"></i> Menú cliente
        </a>
    </div>
@endsection

@section('content')

    <div>
        <div>
            <ul class="nav nav-tabs nav-justified h5 " role="tablist" style="background-color:rgba(111, 143, 175, 0.200);">

                <li class="nav-item text-dark active" role="presentation">
                    <a href="{{ route('menuAdmon.bebidas') }}" class="nav-link text-dark active" id="pills-bebidas-tab"
                        data-bs-toggle="" data-bs-target="#pills-bebidas" type="button" role="tab"
                        aria-controls="pills-bebidas" aria-selected="true">Bebidas</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a href="{{ route('menuAdmon.platillos') }}" class="nav-link text-dark" id="pills-platillos-tab"
                        data-bs-toggle="" data-bs-target="#pills-platillos" type="button" role="tab"
                        aria-controls="pills-platillos" aria-selected="false">Platillos</a>
                </li>

                <li class="nav-item" role="presentation">
                    <a href="{{ route('menuAdmon.complementos') }}" class="nav-link text-dark" id="pills-complementos-tab"
                        data-bs-toggle="" data-bs-target="#pills-complementos" type="button" role="tab"
                        aria-controls="pills-complementos" aria-selected="false">Complementos</a>
                </li>
            </ul>
        </div>
    </div>

    <!--Menu de Productos-->

    <div class="tab-content" id="pills-tabContent">

        <!--Navegacion entre disponibles y no disponibles-->
        <ul class=" pt-2 nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link text-dark h6 active" id="BDisponibles-tab" data-bs-toggle="tab"
                    data-bs-target="#BDisponibles" role="tab" aria-controls="BDisponibles"
                    aria-selected="true">Disponibles</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link text-dark h6" id="BNoDisponibles-tab" data-bs-toggle="tab"
                    data-bs-target="#BNoDisponibles" role="tab" aria-controls="BNoDisponibles" aria-selected="false">No
                    Disponibles</a>
            </li>
        </ul>

        <div class="tab-content" id="myTabContent">
            <br>
            <!--Bebidas Disponibles-->
            <div class="tab-pane fade show active" id="BDisponibles" role="tabpanel" aria-labelledby="BDisponibles-tab"
                style="height: 450px; overflow-x: hidden;">
                <table class="table" id="bebidasDisponibles">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center;">N</th>
                            <th scope="col" style="text-align: start;">Nombre</th>
                            <th scope="col" style="text-align: end;">Precio</th>
                            <th scope="col" style="text-align: center;">Disponibles</th>
                            <th scope="col" style="text-align: center;">Acción</th>
                            <th scope="col" style="text-align: center;">Editar</th>
                            <th scope="col" style="text-align: center;">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--contenido-->
                    </tbody>
                </table>
            </div>

            <!--Bebidas no Disponibles-->
            <div class="tab-pane fade" id="BNoDisponibles" role="tabpanel" aria-labelledby="BNoDisponibles-tab"
                style="height: 450px; overflow-x: hidden;">
                <table class="table" id="bebidasNoDisponibles">
                    <thead>
                        <tr>
                            <th scope="col" style="text-align: center;">N</th>
                            <th scope="col" style="text-align: satar;">Nombre</th>
                            <th scope="col" style="text-align: end;">Precio</th>
                            <th scope="col" style="text-align: center;">Acción</th>
                            <th scope="col" style="text-align: center;">Editar</th>
                            <th scope="col" style="text-align: center;">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        <!--contenido-->
                    </tbody>
                </table>
            </div>

        </div>
    </div>

    <!-- ========== Scrips ========== -->
    <script src="/JQuery/jquery-3.7.0.js"></script>
    <script src="/JQuery/jquery-3.7.0.min.js"></script>
    <br>
    <script src="http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer></script>
    <script src="/DataTables/DataTables-1.13.4/js/jquery.dataTables.js"></script>
    <script src="/DataTables/DataTables-1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="/js/admonMenu.js"></script>

@endsection
