@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Kioskos')
@section('miga')
<li class="breadcrumb-item text-sm text-white active m-0" aria-current="page">Reservaciones de kioskos</li>
@endsection
@section('tit','Reservaciones de kioskos')
@section('b')
    <div class="" style="">    
        <a href="{{route('kiosko_res.create')}}" style="margin:0; padding:5px; width:150px; font-size:15px" type="button" 
        class="bg-light border-radius-sm text-center">
        <i class="fa fa-plus-circle"></i> Agregar
       </a> 
    </div>
@endsection
@section('content')
    <!-- ========== Reservaciones ========== -->
    <div class="table-responsive" style="">
        <table class="table" id="example" style="">
            <thead style="">
                <tr>
                    <th scope="col" style="text-align:center">N</th>
                    <th scope="col">Cliente</th>
                    <th scope="col" style="text-align: center;" >Celular</th>
                    <th scope="col" style="text-align: center;">Cantidad</th>
                    <th scope="col">fecha</th>
                    <th scope="col" style="text-align:right;">Pago</th>
                    <th scope="col" style="text-align:right;">Anticipo</th>
                    <th scope="col" style="text-align:right;"> Detalle</th>
                    <th scope="col" style="text-align: center;">Editar</th>
                    <th scope="col" style="text-align: center;">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservaciones  as $i => $r)
                        
                        <tr style=" height:46px">
                            <td scope="col" style="text-align: center">{{++$i}}</td>
                            <td scope="col" >{{$r->nombreCliente}}</td> 
                            <td scope="col"  style="text-align:right">{{$r->celular}}</td> 
                            <td style="text-align: center;">{{$r->cantidadAdultos + $r->cantidadNinios}}</td> 
                            <td scope="col" style="text-align:left;" >{{ \Carbon\Carbon::parse($r->fecha)->isoFormat('DD') }} de
                                {{ \Carbon\Carbon::parse($r->fecha)->isoFormat('MMMM') }},
                                {{ \Carbon\Carbon::parse($r->fecha)->isoFormat('YYYY') }}</td> 
                                @php
                                $total = $r->precioNinios * $r->cantidadNinios +
                                $r->precioAdultos * $r->cantidadAdultos;
                                @endphp
                            <td class="" style="text-align:right" scope="col">L {{ number_format($total, 2, '.', ',') }}</td>
                            <td class="" style="text-align:right" scope="col">L {{ number_format($r->anticipo, 2, '.', ',') }}</td> 
                            <td scope="col"  style="text-align: center;">
                                <a type="buttom" href="{{route('kiosko.detail',['id'=>$r->id])}}">
                                    <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
                                </a>
                            </td>
                            <td scope="col" style="text-align: center;" ><a href="{{route('kiosko_res.edit', ['id' => $r->id])}}"><i class="fa-solid fa-edit text-success"></i></a></td>
                            <td scope="col" style="text-align: center;">
                                <i data-bs-toggle="modal" data-bs-target="#staticBackdropE{{$r->id}}" class="fa-solid fa-trash-can text-danger" style="color:crimson"></i>
                                <form action="{{route('kiosko_res.destroy', ['id' => $r->id])}}" method="post" enctype="multipart/form-data">
                                    @method('delete')
                                    @csrf
                                    <div class="modal fade" id="staticBackdropE{{$r->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                        <div class="modal-dialog">
                                            <div class="modal-content">
                                                <div class="modal-header">
                                                    <h5 class="modal-title  font-weight-bolder" id="staticBackdropLabel">Eliminar Reservación</h5>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Esta seguro de eliminar la reservación de: {{$r->nombreCliente}}?
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-danger">Si</button>
                                                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
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