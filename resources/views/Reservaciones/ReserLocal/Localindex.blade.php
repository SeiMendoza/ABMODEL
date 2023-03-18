@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Reservacion-Local')
 
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
    <li class="breadcrumb-item text-sm text-dark"  aria-current="page" >
        <a class="text-dark" href="{{route('ReserLocal.create')}}">Registro de Reservaciones</a></li>
  
@endsection
 
@section('content')
<!--Filtro de busqueda-->
<div> 
<div class="nav d-flex justify-content-end" style="">
    <div class="" style="margin: 0px 23px 0px 23px;">
        <form action="{{route('cliente.reservaLocal')}}" method="get" role="search" 
          class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
           <div class="input-group">
                <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 350px" 
                    placeholder="Buscar por nombre del cliente" aria-label="Search" 
                     aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($texto)) {echo $texto;} ?>" />
                    <button class="bg-success border-radius-md" type="submit" style="border: 0; color:aliceblue"><strong>Buscar</strong></button>    
                    @if(isset($texto))
                         @if($texto != null)
                             <a href="{{route('cliente.reservaLocal')}}" 
                             style="color:aliceblue; width:150px; padding:6px;"  
                             class="bg-secondary border-radius-md h-6 text-center"><strong>Borrar Busqueda</strong></a>
                        @endif
                     @endif
           </div>   
        </form>
    </div>
    <div style="margin-right:25px;  margin-top:0px; display:block; float:right;" class="nav-link-icon"> 
        <a href="{{route('ReserLocal.create')}}" type="button" class="btn btn-success " style="width:170px; padding:9px;">
            <i class="ni ni-palette"></i><strong> Añadir Reservación</strong></a>
    </div>

</div>
     <!--------Lista de Reservaciones---------------->

     <div class="">
         <div class="table-responsive container-fluid">
             <table class="table" id="table" style="background-color: #fff; ">
                 <thead class="card-header border border-radius" style="color:rgb(18, 75, 75); text-align:center">
                     <tr style="font-size:17px">
                         <th scope="col">N°</th>
                         <th scope="col">Cliente</th>
                         <th scope="col">Fecha</th>
                         <th scope="col">Hora</th>
                         <th scope="col">Detalles</th>
                         <th scope="col">Editar</th>
                         <th scope="col">Eliminar</th>
                     </tr>
                 </thead>
                 <tbody>
                     @forelse($reservacion as $r)

                     <tr class="border border-light" style="color:rgb(86, 142, 142); text-align:center">
                         <th scope="col" >{{$r->id}}</th>
                         <td scope="col" style=" text-align:center-justify" >{{$r->Nombre_Cliente}}  {{$r->Apellido_Cliente}}</td> 
                         <td scope="col">{{$r->Fecha}}</td>   
                         <td scope="col">{{$r->Hora}}</td>   
                         <td scope ="col"><a type="buttom" class="ni ni-light" href="{{ route('detalle.reservacion', ['id'=>$r->id]) }}">
                                <i class="ni ni-single-copy-04 text-pink text-sm opacity-8"></i>
                            </a> 
                         </td>
                         <td scope="col"><a href="{{ route('ResCliente.editar', ['id'=>$r->id]) }}"><i class="fa fa-edit text-success"></i></a> </td>
                         <td scope="col" >
                            <!-- Button trigger modal eliminar-->
                            <a
                            class="" type="button" data-bs-toggle="modal" 
                            data-bs-target="#exampleModalCenter{{$r->id}}"><i class="fa fa-delete-left text-danger"></i>
                            </a>
                            <!-- Modal Eliminar-->
                            <form action="{{route('cliente.destroy', ['id' => $r->id])}}" method="post" enctype="multipart/form-data">
                                @method('delete')
                               @csrf
                                <div class="modal fade" id="exampleModalCenter{{$r->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" 
                                    aria-labelledby="exampleModalCenterTitle" aria-hidden="true">
                                    <div class="modal-dialog modal-dialog-centered">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                            <h4 class="modal-title" id="exampleModalLongTitle">Eliminar Reservación</h4>
                                        </div>
                                        <div class="modal-body">
                                            ¿Esta seguro de eliminar la reservación de {{$r->Nombre_Cliente}}?             
                                        </div>
                                        <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">NO</button>
                                        <button type="submit" class="btn btn-danger">SÍ</button>
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </td>
                     </tr>
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center;color: teal;">No hay Reservaciones</td>
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
     </div>
</div>

@endsection