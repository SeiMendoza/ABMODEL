@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Administración de menú')
@section('miga')
    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Administración de menú</li>
@endsection
@section('tit', 'Administración de menú')

@section('content')
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
                timer: 3000
            })
        }
    </script>

    <br>
    @yield('selection')
    <br>

    <!--Menu de Productos-->
    <div class="table-responsive" id="pills-tabContent">
        <div class="tab-content" id="pills-tabContent">

            @yield('show')

        </div>
    </div>


    <script src="/JQuery/jquery-3.7.0.js"></script>
    <script src="/JQuery/jquery-3.7.0.min.js"></script>
    <script src="/DataTables/DataTables-1.13.4/js/jquery.dataTables.js"></script>
    <script src="/DataTables/DataTables-1.13.4/js/jquery.dataTables.min.js"></script>
    <script>
        //DATATABLES para Menú
        $(document).ready(function {}(
            $('.menu').DataTable();));

        //DATATABLES para Kiosko
        $(document).ready(function() {
            $('.kiosko').DataTable();
        });

        
    </script>

@endsection
