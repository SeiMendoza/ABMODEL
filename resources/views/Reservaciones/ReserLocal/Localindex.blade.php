@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Reservacion-Local')
@section('content')
 
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
    
<div class="mb-0 col-11 text-start">

    <div class="row text-center container pt-2">
            <h3 style="background:rgb(52, 196, 143);" class=" card text-white text-uppercase p-2">LOCAL
            </h3>
    </div>

    <!--Filtro de busqueda-->
             
    <div class="nav-item" style="margin: 10px 25px 10px 25px;">
        <form action="{{ route('cliente.reservaLocal')}}" method="get" role="search" 
            class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
            <div class="input-group">
                <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 350px" 
                placeholder="Buscar por nombre del cliente" aria-label="Search" 
                aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($texto)) {echo $texto;} ?>" />
                <button class="btn btn-menu my-2 my-sm-0" type="submit"><strong>Buscar</strong></button>    
                @if(isset($texto))
                    @if($texto != null)
                        <a href="{{route('cliente.reservaLocal')}}" style="display:block; float:right"  
                        class="btn btn-secondary my-2 my-sm-0">Borrar Busqueda</a>
                    @endif
                @endif
            </div>   
        </form>
        <a style="position: absolute; right:180px;" href="{{route('ReserLocal.create')}}" 
    class="btn btn-menu"> <i class="ni ni-single-copy-04 text-success text-sm opacity-10">
    </i> Formulario Cliente</a> 
    </div>

     <!--------Lista de Reservaciones---------------->

     <div class="card-body">
         <div class="table-responsive container-fluid">
             <table class="table" id="table" style="background-color: #fff;">
                 <thead class="card-header border border-radius" style="color:teal; text-align:center">
                     <tr>
                         <th scope="col">N°</th>
                         <th scope="col">Cliente</th>
                         <th scope="col">Fecha</th>
                         <th scope="col">Detalles</th>
                         <th scope="col">Editar</th>
                         <th scope="col">Eliminar</th>
                     </tr>
                 </thead>
                 <tbody>
                     @forelse($reservacion as $r)
                     <tr class="border border-light" style="color:teal; text-align:center">
                         <th scope="col">{{$r->id}}</th>
                         <td scope="col">{{$r->Nombre_Cliente}}  {{$r->Apellido_Cliente}}</td> 
                         <td scope="col">{{$r->Fecha}}</td>      
                        <td><a type="buttom" class="btn btn-light" href="">
                                <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
                            </a> 
                        </td>
                        <td><a type="buttom" class="btn btn-warning button" href="{{ route('ResCliente.editar', ['id'=>$r->id]) }}">Editar</i> </a> 
                         </td>
                         <td><a type="buttom" class="btn btn-danger button" href="{{ route('cliente.borrar', ['id'=>$r->id]) }}">Eliminar</i> </a> 
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

@endsection