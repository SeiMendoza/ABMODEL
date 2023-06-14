@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Administración de menú')
@section('miga')
    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Administración de menú</li>
@endsection
@section('tit', 'Administración de menú')
@section('b')
    <!-- Botón registrar -->
    <div>
        <a href="{{ route('bebidasyplatillos.create') }}" style="margin:0; padding:5px; width:200px;" type="button"
            class="bg-light border-radius-sm text-center">
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
    

@endsection
