@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Detalles de la reservación')
@section('miga')
<li class="breadcrumb-item text-sm text-dark" aria-current="page">
    <a class="opacity-5 text-dark" href="{{route('mesas_reg.index')}}">Mesas</a>
</li>
<li class="breadcrumb-item text-sm"><a class=" text-dark">codigo Qr </a></li>
@endsection

@section('content')

<div class="wrapper wrapper--w960">
    <div class="row d-flex justify-content-center">
        <div class="card shadow items-center"> <BR><BR>
            <h3 class="border-radius-md h-6 text-center text-gray font-weight-bolder" style="text-align:right">
                Codigo Qr para: {{$reg->nombre}} </h3><br>
            <div style="position:relative;left:40%">
                <svg style="width:250px; height:250px;">
                    <image xlink:href="{{ $qr }}" style="width:80%; height:80%;" />
                </svg>
            </div>
            <div style="background-color: rgba(81, 255, 0, 0.182);text-align:center; font-size:16px">
                <a href="{{route('mesas_reg.index')}}" class="" style=" width:915px;"><strong>Regresar</strong></a>
            </div>
            <br>
        </div>
    </div>
</div>
@endsection