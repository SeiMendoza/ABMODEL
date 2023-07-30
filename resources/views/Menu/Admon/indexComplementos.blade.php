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
        <a href="{{ route('cliente_prueba') }}" style="margin:0; padding:5px; width:160px;" type="button"
            class="bg-light border-radius-sm text-center ">
            <i class="fa fa-users"></i> Menú cliente
        </a>
    </div>
@endsection

@section('content')
    <div class="pt-2">
        <div>
            <div>
                <ul class="nav nav-tabs nav-justified h5 " role="tablist" style="background-color:rgba(111, 143, 175, 0.200);">
        
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('menuAdmon.bebidas') }}" class="nav-link text-dark" id="pills-bebidas-tab"
                            data-bs-toggle="" data-bs-target="#pills-bebidas" type="button" role="tab"
                            aria-controls="pills-bebidas" aria-selected="false">Bebidas</a>
                    </li>
        
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('menuAdmon.platillos') }}" class="nav-link text-dark" id="pills-platillos-tab"
                            data-bs-toggle="" data-bs-target="#pills-platillos" type="button" role="tab"
                            aria-controls="pills-platillos" aria-selected="false">Platillos</a>
                    </li>
        
                    <li class="nav-item" role="presentation">
                        <a href="{{ route('menuAdmon.complementos') }}" class="nav-link text-dark active"
                            id="pills-complementos-tab" data-bs-toggle="" data-bs-target="#pills-complementos" type="button"
                            role="tab" aria-controls="pills-complementos" aria-selected="true">Complementos</a>
                    </li>
                </ul>
            </div>
        </div>
    </div>

    <!--Menu de Productos-->

    <div class="tab-content" id="pills-tabContent">

        <!--Complementos-->
       
        <!--Navegacion entre disponibles y no disponibles-->
        <ul class=" pt-2 nav nav-tabs justify-content-center" id="myTab" role="tablist">
            <li class="nav-item" role="presentation">
                <a class="nav-link text-dark h6 active" id="CPDisponibles-tab" data-bs-toggle="tab" data-bs-target="#CDisponibles" role="tab" aria-controls="CDisponibles" aria-selected="true">Disponibles</a>
            </li>
            <li class="nav-item" role="presentation">
                <a class="nav-link text-dark h6" id="CNoDisponibles-tab" data-bs-toggle="tab" data-bs-target="#CNoDisponibles" role="tab" aria-controls="CNoDisponibles" aria-selected="false">No Disponibles</a>
            </li>
        </ul>
        
        <div class="tab-content" id="myTabContent">
            <br>
            <!--Complementos Disponibles-->
            <div class="tab-pane fade show active" id="CDisponibles" role="tabpanel" aria-labelledby="CDisponibles-tab">
                <table class="table" id="complementosDisponibles">
                    <thead>
                        <tr> 
                            <th scope="col" style="text-align: center;">N</th>
                            <th scope="col" style="text-align: start;">Nombre</th>
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

            <!--Complementos no Disponibles-->
            <div class="tab-pane fade" id="CNoDisponibles" role="tabpanel" aria-labelledby="CNoDisponibles-tab">
                <table class="table" id="complementoNoDisponibles">
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


    <!-- ========== Modal para eliminar ========== -->
    <div class="modal fade" id="modalDeleteComplementos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-danger">
                    <h4 class="modal-title font-weight-bolder text-white" id="staticBackdropLabel"><i class="fa fa-trash pe-2"></i>Eliminar producto</h4>
                </div>
                <div class="modal-body">
                    <p class="modalStyle">¿Desea eliminar este producto?</p>
                </div>
                <div class="modal-footer small">
                    <button id="btnConfirmDeleteProduct" class="btn btn-danger">Si</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== Modal para activar ========== -->
    <div class="modal fade" id="modalActivarComplementos" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-dialog-centered">
            <div class="modal-content">
                <div class="modal-header bg-info">
                    <h4 class="modal-title font-weight-bolder text-white" id="staticBackdropLabel"><i class="fa-solid fa-toggle-on pe-2"></i>Disponibilidad</h4>
                </div>
                <div class="modal-body">
                    <p class="modalStyle">¿Desea cambiar el estado del producto?</p>
                </div>
                <div class="modal-footer">
                    <button class="btn btn-info" type="button" id="btnConfirmarActivacion">Si</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </div>
            </div>
        </div>
    </div>

    <!-- ========== Scrips ========== -->
    <script src="/JQuery/jquery-3.7.0.js"></script>
    <script src="/JQuery/jquery-3.7.0.min.js"></script>
    <br><script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
    <script src="/DataTables/DataTables-1.13.4/js/jquery.dataTables.js"></script>
    <script src="/DataTables/DataTables-1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script src="js/admonMenu.js"></script>

@endsection

