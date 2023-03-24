@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Mesas')
@section('miga')
<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Reservaciones de Kioskos</li>
@endsection
@section('content')
    <div style="margin-left:25px; margin-top:15px; display:block; float:left;
        color: #333333" class="nav-link-icon">                            
            <h4>Reservaciones de Kioskos</h4>
    </div>
    <div class="nav d-flex justify-content-end " style="margin:0px 0px 5px 5px; display:block; float:rigth">
        <div style="margin: 11px 0 0 10px; display:block; float:left" class="nav-link-icon">                            
            <a href="{{ route('kiosko.index') }}" type="button" class="bg-light border-radius-md h-6 text-center text-success" style="width:300px; padding:6px;">
                <i class="fa fa-table-columns text-sm text-center opacity-10"></i>
                Ir a registro de Kiosko</a>
        </div>
        <div class="nav d-flex justify-content-end " style="">
            <div class="" style="margin: 10px 0 0 10px">
                <form action="{{ route('kiosko_res.search') }}" method="get" role="search" 
                    class="navbar-search" >
                    <div class="input-group">
                        <input class="form-control" type="search" id="buscar" name="buscar" style="width: 200px" 
                        placeholder="Buscar por nombre"aria-label="Search"
                        aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($text)) {echo $text;} ?>" />
                        <button class="bg-success border-radius-md" type="submit" style="border: 0; color:aliceblue"><strong>Buscar</strong></button>    
                        @if(isset($text)!="")
                        <a href="{{route('kiosko_res.index')}}" type="button" style="color:aliceblue; width:150px; padding:6px;"  
                            class="bg-secondary border-radius-md h-6 text-center"><strong style="">Borrar Busqueda</strong></a>
                    @endif
                    </div>   
                </form>
            </div>
            <div style="margin: 10px 0 0 10px;" class=" nav-link-icon">
                <a href="{{route('kiosko_res.create')}}" type="button" class="bg-light border-radius-md h-6 text-center text-success" style="width:200px; padding:6px;">
                <i class="ni ni-palette"></i> Agregar reservaciones</a>
            </div>
        </div>
    </div>
    <!-- ========== Reservaciones ========== -->
    <div class=""  id="reserva" style="">
        <!-- ========== Cards ========== -->
        <div class="">
            <div class="table-responsive container-fluid">
                <table class="table" id="table" style="background-color: #fff;">
                    <thead class="card-header border border-radius" style="color:teal; text-align:center">
                        <tr>
                            <th scope="col">N</th>
                            <th scope="col">Cliente</th>
                            <th scope="col">Celular</th>
                            <th scope="col">Cantidad</th>
                            <th scope="col">fecha</th>
                            <th scope="col">Pago</th>
                            <th scope="col">Editar</th>
                            <th scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservaciones as $r)
                             
                                <tr class="border border-light" style="color:teal; text-align:center">
                                    <th scope="col">{{$r->id}}</th>
                                    <td scope="col">{{$r->nombre}}</td> 
                                    <td scope="col">{{$r->celular}}</td> 
                                    <td scope="col">{{$r->cantidad}}</td> 
                                    <td scope="col">{{$r->fecha}}</td> 
                                    <td scope="col">{{$r->pago}}</td> 
                                    <td scope="col" ><a href="{{route('kiosko_res.edit', ['id' => $r->id])}}"><i class="fa fa-edit text-success"></i></a></td>
                                    <td scope="col">
                                        <form action="{{route('kiosko_res.destroy', ['id' => $r->id])}}" method="post" enctype="multipart/form-data">
                                            @method('delete')
                                            @csrf
                                            <button onclick="" style="border: 0; padding:0; margin:0;"><i class="fa fa-delete-left text-danger" style="border: 0; padding:0; margin:0;"></i></button>
                                        </form>
                                        <!-- Modal Eliminar-->
                                    </td>
                                </tr>
                           
                        @empty
                           <tr>
                               <td colspan="7" style="text-align: center;color: teal;">No hay pedidos</td>
                           </tr>
                        @endforelse
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <!-- ========== End Cards ========== --> 
@endsection

@section('pie')
    <div class="pagination justify-content-end"> 
        <div style="display:block; float:right;"> 
            {{$reservaciones->links()}}
        </div>
    </div>

    <script>
        function eliminar(){
    
    Swal
    .fire({
        title: "Eliminar",
        text: "¿Desea eliminar el registro?",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonText: "Si",
        cancelButtonText: "No",
    })
    .then(resultado => {
        if (resultado.value) {
            // Hicieron click en "Sí"
            document.getElementById('eliminar').submit();
        } else {
            // Dijeron que no
        }
    });

}
    </script>
@endsection