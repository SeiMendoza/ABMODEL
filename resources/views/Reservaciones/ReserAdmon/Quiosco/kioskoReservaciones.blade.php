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
                    <th style="text-align: center; width: 50px">N</th>
                    <th>Cliente</th>
                    <th style="text-align: center; width: 50px" >Celular</th>
                    <th style="text-align: center; width: 50px">Personas</th>
                    <th style="text-align: center; width: 50px">fecha</th>
                    <th style="text-align:right; width: 50px">Total</th>
                    <th style="text-align:right; width: 50px">Pendiente</th>
                    <th style="text-align:right; width: 50px"> Detalle</th>
                    <th style="text-align: center; width: 50px">Editar</th>
                    <th style="text-align: center; width: 50px">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservaciones  as $i => $r)
                        <tr style=" height:46px">
                            <td style="text-align: center; width: 50px"> {{++$i}} </td>
                            <td style="width: 100px">{{$r->nombreCliente}}</td> 
                            <td style="text-align:right; width: 50px">{{$r->celular}}</td> 
                            <td style="text-align: center; width: 50px">{{$r->cantidadAdultos + $r->cantidadNinios}}</td> 
                            <td style="text-align:center; width: 50px" >{{ \Carbon\Carbon::parse($r->fecha)->isoFormat('DD') }} de
                                {{ \Carbon\Carbon::parse($r->fecha)->isoFormat('MMMM') }},
                                {{ \Carbon\Carbon::parse($r->fecha)->isoFormat('YYYY') }}</td> 
                                @php
                                $total = $r->precioNinios * $r->cantidadNinios +
                                $r->precioAdultos * $r->cantidadAdultos;
                                @endphp
                            <td style="text-align:right; width: 50px">L {{ number_format($total, 2, '.', ',') }}</td> 
                            <td class="" style="text-align:right; width: 50px" scope="col">L {{ number_format($total - $r->anticipo, 2, '.', ',') }}</td>
                            <td style="text-align: center; width: 50px;">
                                <a type="buttom" href="{{route('kiosko.detail',['id'=>$r->id])}}">
                                    <i class="ni ni-single-copy-04 text-success text-sm opacity-10"></i>
                                </a>
                            </td>
                            <td style="text-align: center; width: 50px"><a href="{{route('kiosko_res.edit', ['id' => $r->id])}}"><i class="fa-solid fa-edit text-success"></i></a></td>
                            <td style="text-align: center; width: 50px">
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