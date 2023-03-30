@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Mesas')
@section('miga')
<li class="breadcrumb-item text-sm text-dark active m-0" aria-current="page">Kioskos</li>
@endsection
@section('b')
    <h3 class="font-weight-bolder opacity-8  text-gray mb-0" style="position: absolute; top:100%;">Reservaciones de Kioskos</h3> 
    <div class="" style="position:absolute; right:0%; top:16%">    
        <a href="{{route('kiosko_res.create')}}" style="margin:0; padding:0" type="button" class="font-weight-bolder text-gray opacity-6">
        <i class="fa fa-plus-circle"></i> Agregar
       </a> 
    </div>
@endsection
@section('content')
    <!-- ========== Reservaciones ========== -->
    <div class="table-responsive">
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
                            <td scope="col" style="text-align:left;" >{{ \Carbon\Carbon::parse($r->fecha)->isoFormat('DD') }} de
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