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
            <div style="margin: 10px 25px 0px 25px;" class=" nav-link-icon">
                <a href="{{route('kiosko_res.create')}}" type="button" class="bg-light border-radius-md text-center text-success" style="width:200px; padding:6px;">
                <i class="ni ni-palette"></i> Agregar reservaciones</a>
            </div>
        </div>
    </div>
    <!-- ========== Reservaciones ========== -->
    <div class="table-responsive container-fluid">
        <table class="table" id="example" style="">
            <thead style="">
                <tr>
                    <th scope="col">N</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Celular</th>
                    <th scope="col" style="text-align: center;">Cantidad</th>
                    <th scope="col">fecha</th>
                    <th scope="col" style="text-align:right;">Pago</th>
                    <th scope="col" style="text-align:right;">Anticipo</th>
                    <th scope="col" style="text-align: center;">Editar</th>
                    <th scope="col" style="text-align: center;">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservaciones  as $i => $r)
                        
                        <tr style="">
                            <th scope="col">{{++$i}}</th>
                            <td scope="col" >{{$r->nombre}}</td> 
                            <td scope="col">{{$r->celular}}</td> 
                            <td style="text-align: center;">{{$r->cantidad}}</td> 
                            <td scope="col" style="text-align:left; width:100px" >{{ \Carbon\Carbon::parse($r->fecha)->isoFormat('DD') }} de
                                {{ \Carbon\Carbon::parse($r->fecha)->isoFormat('MMMM') }},
                                {{ \Carbon\Carbon::parse($r->fecha)->isoFormat('YYYY') }}</td> 
                            <td class="" style="text-align:right" scope="col">L {{ number_format($r->total, 2, '.', ',') }}</td>
                            <td class="" style="text-align:right" scope="col">L {{ number_format($r->anticipo, 2, '.', ',') }}</td> 
                            <td scope="col" style="text-align: center;" ><a href="{{route('kiosko_res.edit', ['id' => $r->id])}}"><i class="fa-solid fa-edit text-success"></i></a></td>
                            <td scope="col" style="text-align: center;">
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
    <!-- ========== End Cards ========== --> 
@endsection

@section('pie')
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