@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Mesas')
@section('miga')
<li class="breadcrumb-item text-sm text-dark active m-0" aria-current="page">Mesas</li>
@endsection
@section('b')
    <h3 class="font-weight-bolder opacity-8 text-gray mb-0" style="position: absolute; top:100%;">Registro de Mesas</h3> 
    <div class="" style="position:absolute; right:0%; top:16%">    
        <a href="{{route('mesas_reg.create')}}" style="margin:0; padding:5px; width:150px;" 
        type="button" class="bg-light border-radius-md h-6 text-center text-success">
        <i class="fa fa-plus-circle"></i> Agregar
       </a> 
    </div>
@endsection
@section('content')
    <!-- ========== Tabla========== -->
    <div class="table-responsive">
        <table class="table" id="example" style="">
            <thead class="">
                <tr>
                    <th scope="col" style="text-align:center">N</th>
                    <th scope="col" style="text-align:center">Código</th>
                    <th scope="col" style="text-align:center">Mesa</th>
                    <th scope="col" style="text-align:center;  text-transform:initial;">Cantidad de personas</th>
                    <th scope="col" style="text-align:center">Kiosko</th>
                    <th scope="col" style="text-align: center;">QR</th>
                    <th scope="col" style="text-align:center">Editar</th>
                    <th scope="col" style="text-align:center">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registros as $i => $r)
                        
                        <tr class="" style="text-align:center">
                            <th scope="col">{{++$i}}</th>
                            <td scope="col">{{$r->codigo}}</td>
                            <td scope="col">{{$r->nombre}}</td> 
                            <td scope="col">{{$r->cantidad}}</td>
                            <td scope="col">{{$r->kiosko_id}}</td>
                            <td  scope="col" ><a class="" 
                                href="{{route('mesa.Codigo_Qr', ['id' => $r->id])}}"><i class="fas fa-qrcode text-success"></i></a>
                            </td>
                            <td  scope="col" ><a class="" 
                                href="{{route('mesas_reg.edit', ['id' => $r->id])}}"><i class="fa-solid fa-edit text-success"></i></a>
                            </td>
                            <td scope="col">
                               
                                    <i data-bs-toggle="modal" data-bs-target="#staticBackdropE{{$r->id}}" class="fa-solid fa-trash-can text-danger" style="color:crimson"></i>
                                    <form action="{{route('mesas_reg.destroy', ['id' => $r->id])}}" method="post" enctype="multipart/form-data">
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
                        <td colspan="7" style="">No hay resultados</td>
                    </tr>
                @endforelse
            </tbody>
        </table>   
    </div>
    <!-- ========== End ========== -->
    
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
