@extends('00_plantillas_Blade.plantilla_General2')
@section('content')
    <button id="boton" class="btn btn-success">Hola</button>
    <table class="table" id="table">
        <thead>
            <tr>
                <th scope="col">N</th>
                <th scope="col">Id</th>
                <th scope="col">Nombre</th>
                <th scope="col">Descripcion</th>
                <th scope="col">Editar</th>
                <th scope="col">Boton</th>
            </tr>
        </thead>
        <tbody>
            <!-- codigo incrustado por ajax -->
        </tbody>
    </table>

    <!-- ========== Modal para eliminar ========== -->
    <div class="modal fade" id="modalDelete" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title" id="staticBackdropLabel">Eliminar producto</h4>
                </div>
                <div class="modal-body text-center">
                    <strong>¿Está seguro de eliminar el complemento?</strong>
                </div>
                <div class="modal-footer">
                    <button type="button" id="btnConfirmDeleteProduct" class="btn btn-danger">Si</button>
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                </div>
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
    <script src="js/pruebaAdmon.js"></script>
    <script src="js/admonMenu.js"></script>

    <!-- ========== Start Section codigo Javascript para URL========== -->
    <script src="/JQuery/jquery-3.7.0.js"></script>
    <script src="/JQuery/jquery-3.7.0.min.js"></script>
    <script>
        $(function() {
            console.log("{{ URL::previous() }}");

            $(document).on('click', '#back', function(e) {
                console.log('Funcionando!');
                var url = "{{ URL::previous() }}";

                if (url == '/usuarios/{id}/editando/perfil') {

                    url = '/';
                }

                window.location.href = url;
            })

        })
    </script>
    <!-- ========== End Section codigo Javascript para URL========== -->
@endsection

<!-- ========== Start Bebidas ========== -->
