@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Código-Qr')
@section('miga')
<li class="breadcrumb-item text-sm text-dark" aria-current="page">
    <a class="opacity-5 text-dark" href="{{route('mesas_reg.index')}}">Mesas</a>
</li>
<li class="breadcrumb-item text-sm text-dark" aria-current="page">
    <a class="text-dark">Código Qr </a>
</li>
@endsection

@section('content')

<div class="wrapper wrapper--w960 font-robo ">
    <div class="card border-radius-sm border-0">
        <div class="card-body border-radius-sm border-0"> <BR><BR>
            <h3 class="border-radius-md h-6 text-center text-gray font-weight-bolder" style="text-align:right">
                Código Qr para: {{$reg->nombre}} </h3><br>
            <div style="position:relative;left:40%">
                <svg style="width:250px; height:250px;">
                    <image xlink:href="{{ $qr }}" style="width:80%; height:80%;" />
                </svg>
            </div>
            <div style="text-align:center; font-size:16px">
                <a href="{{route('mesas_reg.index')}}" class="btn btn-success"><strong>Regresar</strong></a>
            </div>
            <br>
        </div>
    </div>
</div>
@endsection