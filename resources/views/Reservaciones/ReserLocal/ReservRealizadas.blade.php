@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Reservaciones Realizadas')
 
     <script>
         var msg = "{{Session::get('mensaje ')}}";
         var exist = "{{Session::has('mensaje ')}}";
         if (exist) {
             Swal.fire({
                 position: 'top-end',
                 icon: 'success',
                 title: msg,
                 showConfirmButton: false,
                 toast: true,
                 background: '#fff',
                 timer: 5500
             })
         }
     </script>

 @section('miga')
    <li class="breadcrumb-item text-sm text-dark" aria-current="page" >
        <a class="text-dark" href="{{route('cliente.reservaLocal')}}">Reservaciones</a></li>
@endsection
@section('content')
<!--Filtro de busqueda-->
<div>
    <div class="nav d-flex justify-content-end" style="">
        <div class="" style="margin: 0px 13px 10px 13px; margin-right:25px ">
            <form action="{{route('realizadas.realizadas')}}" method="get" role="search" 
              class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
               <div class="input-group">
                    <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 250px" 
                        placeholder="Buscar por nombre del cliente" aria-label="Search" 
                         aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($texto)) {echo $texto;} ?>" />
                        <button class="bg-success border-radius-md" type="submit" style="border: 0; color:aliceblue"><strong>Buscar</strong></button>    
                        @if(isset($texto))
                             @if($texto != null)
                                 <a href="{{route('realizadas.realizadas')}}" 
                                 style="color:aliceblue; width:150px; padding:6px;"  
                                 class="bg-secondary border-radius-md h-6 text-center"><strong>Borrar Busqueda</strong></a>
                            @endif
                         @endif
               </div>   
            </form>
        </div>
    </div>   
</div>
     <!--------Lista de Reservaciones---------------->
     <div class="container">
         <div class="table-responsive">
             <table class="table" id="table" style="background-color: #fff; ">
                 <thead class="card-header border border-radius" style="color:teal; text-align:center">
                     <tr style="font-size:17px">
                         <th scope="col">N°</th>
                         <th scope="col">Cliente</th>
                         <th scope="col">Fecha</th>
                         <th scope="col">Hora</th>
                         <th scope="col">Total</th>
                         <th scope="col">Anticipo</th>
                         <th scope="col">Pendiente</th>
                         <th scope="col">Realizado</th>
                         <th scope="col">Detalles</th>
                         <th scope="col">Editar</th>
                         <th scope="col">Eliminar</th>
                     </tr>
                 </thead>
                 <tbody>
                     @forelse($reservacion as $r)
                     @if(($r->estado)=="1") 
                     <tr class="border border-light" style="color: teal; text-align:center">
                         <th scope="col" >{{$r->id}}</th>
                         <td scope="col" style=" text-align:center-justify" >{{$r->Nombre_Cliente}} </td>
                         <td scope="col">{{$r->Fecha}}</td> 
                         <td scope="col">{{$r->Hora}}</td>  
                         <td scope="col">{{$r->Total}}</td> 
                         <td scope="col">{{$r->Anticipo}}</td>
                         <td scope="col">{{$r->Pendiente}}</td>
                         <td><input disabled type="checkbox" id="list" name="list" {{ old('list') ?: 'checked'}} data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$r->id}}" 
                            style="background:teal; width:15px; height:15px;"> </td>
                         
                         <td scope ="col"><a type="buttom" class="ni ni-light" href="{{ route('detalle.realizadas', ['id'=>$r->id]) }}">
                                <i class="ni ni-single-copy-04 text-pink text-sm opacity-8"></i>
                            </a> 
                         </td>
                         <td scope="col"><a disabled href=""><i class="fa fa-edit text-success"></i></a> </td>
                         <td scope="col" ><a disabled href=""><i class="fa fa-delete-left text-danger"></i></a> </td>
                     </tr>
                        @endif      
                        @empty
                        <tr>
                            <td colspan="12" style="text-align: center;color: teal;">No hay Reservaciones</td>
                        </tr>
                     @endforelse
                 </tbody>
                </table>
                <div class="pagination justify-content-end"> 
                    <div style="display:block; float:right;"> 
                        {{$reservacion->links()}}
                    </div>
                </div>
            </div>
            <div style="text-align: center;">
                <a class="btn btn-danger" href="{{route('cliente.reservaLocal')}}">Volver</a>
     </div>
@endsection