@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Código-Qr')
@section('miga')
<li class="breadcrumb-item opacity-6 text-sm text-white" aria-current="page">
    <a class="text-white" href="{{route('mesas_reg.index')}}">Mesas</a>
</li>
<li class="breadcrumb-item text-sm text-white" aria-current="page">
    <a class="text-white">Código Qr </a>
</li>
@endsection
@section('tit','Código Qr de mesas')
@section('b')
    <div class="" style="">    
        <a href="{{route('mesas_reg.index')}}" style="margin:0; padding:5px; width:150px; font-size:15px" type="button" 
        class="bg-light border-radius-sm text-center">
        <i class="fa fa-arrow-left"></i> Regresar
       </a> 
    </div>
@endsection
@section('content')

<div class="wrapper wrapper--w960 font-robo ">
    <div class="card border-radius-sm border-0">
        <div class="card-body border-radius-sm border-0"> <BR><BR>
            <h3 class="border-radius-md h-6 text-center text-gray font-weight-bolder" style="text-align:right">
                Código Qr para: {{$reg->nombre}} </h3><br>
            <div style="text-align:center;">
                <svg style="width:250px; height:250px;">
                    <image xlink:href="{{ $qr }}" style="width:80%; height:80%;" />
                </svg>
            </div>
            <br>
        </div>
    </div>
</div>
@endsection