@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Administración de menú')
@section('miga')
    <li class="breadcrumb-item text-sm text-white active" aria-current="page">Administración de menú</li>
@endsection
@section('tit', 'Administración de menú')

@section('content')
    <div class="pt-2">
        @yield('selection')
    </div>

    <!--Menu de Productos-->
    <div class="table-responsive" id="pills-tabContent">
        <div class="tab-content" id="pills-tabContent">

            @yield('show')

        </div>  
    </div>

    @yield('scritps')

    
@endsection
