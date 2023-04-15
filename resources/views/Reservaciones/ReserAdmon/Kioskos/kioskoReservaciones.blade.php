@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Mesas')
@section('miga')
<li class="breadcrumb-item text-sm text-dark active m-0" aria-current="page">Administración Kioskos</li>
<li class="breadcrumb-item text-sm text-dark active m-0" aria-current="page">Reservaciones</li>
@endsection
@section('b')
    <h3 class="font-weight-bolder opacity-8  text-gray mb-0" style="position: absolute; top:100%;">Reservaciones de Kioskos</h3> 
    <div class="" style="position:absolute; right:0%; top:16%">    
        <a href="{{route('kiosko_res.create')}}" style="margin:0; padding:5px; width:150px;" type="button" 
        class="bg-light border-radius-md font-robo h-6 text-center text-success">
        <i class="fa fa-plus-circle"></i> Agregar
       </a> 
    </div>
@endsection
@section('content')
    <!-- ========== Reservaciones ========== -->
    <div class="table-responsive">
        <table class="table font-robo" id="example" style="">
            <thead style="">
                <tr>
                    <th scope="col">N</th>
                    <th scope="col">Cliente</th>
                    <th scope="col">Celular</th>
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
                                                    <h5 class="modal-title  font-weight-bolder" id="staticBackdropLabel">Eliminar producto</h5>
                                                </div>
                                                <div class="modal-body">
                                                    ¿Esta seguro de borrar el producto: {{$r->nombre}}?
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