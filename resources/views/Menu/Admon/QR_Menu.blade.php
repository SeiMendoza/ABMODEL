@extends('00_plantillas_Blade.plantilla_General')
@section('contend')

<br>
 
 
  <div class="row ${1| ,row-cols-4,row-cols-3,justify-content-md-center,|}">
   
     {!!   QrCode::Color(255, 0, 0)->size(200)->errorCorrection('H')
        ->encoding('UTF-8')->style('square')->format('svg')
        ->margin(10)->generate('http://127.0.0.1:8000/menu/cliente'); !!}
        <h4 style="text-align: center; color:azure">Mesa 1</h4>
        
        </div>
    
 

@endsection