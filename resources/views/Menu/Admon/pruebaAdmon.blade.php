@extends('00_plantillas_Blade.plantilla_General2')
@section('content')
    <button id="boton" class="btn btn-success">Hola</button>
    <div id="contenido"></div>
    <table class="table" id="table">
        <thead>
          <tr>
            <th scope="col">N</th>
            <th scope="col">Id</th>
            <th scope="col">Nombre</th>
            <th scope="col">Descripcion</th>
          </tr>
        </thead>
        <tbody>
            <!-- codigo incrustado por ajax -->
        </tbody>
      </table>


    <!-- ========== Scrips ========== -->
    <script src="/JQuery/jquery-3.7.0.js"></script>
    <script src="/JQuery/jquery-3.7.0.min.js"></script>
    <br><script src = "http://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>
    <script src="/DataTables/DataTables-1.13.4/js/jquery.dataTables.js"></script>
    <script src="/DataTables/DataTables-1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.min.js"></script>
    <script>

        $(function(){

            $('#table').DataTable({
                "ajax": "{{ route('menuAdmon.prueba') }}",
                "bProcessing": true,
               // "bServerSide": true,
                "columns": [
                    {data: 'id'},
                    {data: 'nombre'},
                    {data: 'descripcion'},
                    {data: 'precio'},
                ],
                language: {
                    search: "Buscar:"
                }
            });
            //$('#tabla').DataTable();

            $('#boton').click(function (e) { 
                e.preventDefault();
                
                $.ajaxSetup({
                    headers:{
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    }
                });

                $.ajax({
                    url: '{{ route('menuAdmon.prueba') }}',
                    method: 'GET',
                    beforeSend: function(e){
                        $('#boton').text('Actualizando datos...');
                    },
                    success: function(res){
                        console.log(res);
                        alert('Desea actualizar los datos  ');
                        // $('#contenido').html('Desea actualizar los datos');
                        $('#boton').text('Datos actualizados');
                        $('#table').DataTable().ajax.reload();
                    },
                    error: function(e){
                        alert(e);
                    }, 
                })
            });
        });

    </script>
@endsection