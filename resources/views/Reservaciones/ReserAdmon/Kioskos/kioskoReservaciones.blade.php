@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Mesas')
@section('miga')
<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Reservaciones de Kioskos</li>
@endsection
@section('content')
    <div style="margin-left:25px; margin-top:15px; display:block; float:left;
        color: #333333" class="nav-link-icon">                            
            <h4 class="h4"><strong>Reservaciones de Kioskos</strong></h4>
    </div>
    <div class="nav d-flex justify-content-end " style="margin:0px; display:block; float:rigth">
        <div class="nav d-flex justify-content-end " style="height: 60px">
            <div class="" style="margin: 10px 0 0 0">
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
            <div style="margin: 10px 25px 0px 25px;" class=" nav-link-icon">
                <a href="{{route('kiosko_res.create')}}" type="button" class="bg-light border-radius-md text-center text-success" style="width:200px; padding:6px;">
                <i class="ni ni-palette"></i> Agregar reservaciones</a>
            </div>
        </div>
    </div>
    <!-- ========== Reservaciones ========== -->
    <div class=""  id="reserva" style="">
        <!-- ========== Cards ========== -->
        <div class="">
            <div class="table-responsive container-fluid">
                <table class="table" id="table" style="">
                    <thead style="">
                        <tr>
                            <th class="col" style="padding: 8px;" scope="col">N</th>
                            <th class="col" style="padding: 8px; text-align:left;" scope="col">Cliente</th>
                            <th class="col" style="padding: 8px; text-align:left;" scope="col">Celular</th>
                            <th class="col" style="padding: 8px;" scope="col">Cantidad</th>
                            <th class="col" style="padding: 8px; width:100px" scope="col">fecha</th>
                            <th class="col" style="padding: 8px;" scope="col">Pago</th>
                            <th class="col" style="padding: 8px;" scope="col">Anticipo</th>
                            <th class="col" style="padding: 8px;" scope="col">Editar</th>
                            <th class="col" style="padding: 8px;" scope="col">Eliminar</th>
                        </tr>
                    </thead>
                    <tbody>
                        @forelse($reservaciones  as $i => $r)
                             
                                <tr style="">
                                    <th scope="col">{{++$i}}</th>
                                    <td scope="col" style="text-align:left">{{$r->nombre}}</td> 
                                    <td scope="col" style="text-align:left">{{$r->celular}}</td> 
                                    <td scope="col" >{{$r->cantidad}}</td> 
                                    <td scope="col" style="text-align:left; width:100px" >{{ \Carbon\Carbon::parse($r->fecha)->isoFormat('DD') }} de
                                        {{ \Carbon\Carbon::parse($r->fecha)->isoFormat('MMMM') }},
                                        {{ \Carbon\Carbon::parse($r->fecha)->isoFormat('YYYY') }}</td> 
                                    <td class="" style="text-align:right" scope="col">L {{ number_format($r->total, 2, '.', ',') }}</td>
                                    <td class="" style="text-align:right" scope="col">L {{ number_format($r->anticipo, 2, '.', ',') }}</td> 
                                    <td scope="col"><a href="{{route('kiosko_res.edit', ['id' => $r->id])}}"><i class="fa-solid fa-edit text-success"></i></a></td>
                                    <td scope="col">
                                        <form action="{{route('kiosko_res.destroy', ['id' => $r->id])}}" method="post" enctype="multipart/form-data">
                                            @method('delete')
                                            @csrf
                                            <button onclick="" style="border: 0; padding:0; margin:0;"><i class="fa-solid fa-trash-can text-danger" style="border: 0; padding:0; margin:0;"></i></button>
                                        </form>
                                        <!-- Modal Eliminar-->
                                    </td>
                                </tr>
                           
                        @empty
                           <tr>
                               <td colspan="7" style=";">No hay resultados</td>
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
    <div class="pagination justify-content-end" style="padding-right: 21px"> 
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