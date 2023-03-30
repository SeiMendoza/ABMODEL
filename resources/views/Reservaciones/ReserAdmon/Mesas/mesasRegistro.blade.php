@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Mesas')
@section('miga')
<li class="breadcrumb-item text-sm text-dark" aria-current="page">Mesas</li>
@endsection

@section('content')
    <div style="margin-left:25px; margin-top:15px; display:block; float:left;
    color: #333333" class="nav-link-icon">                            
        <h4 class="h4"><strong>Registro de Mesas</strong></h4>
    </div>
    <div class="nav d-flex justify-content-end " style="margin:0px; display:block; float:rigth">
    <div class="nav d-flex justify-content-end " style="height: 60px">
        <div style="margin: 10px 25px 0px 25px;" class=" nav-link-icon">
            <a href="{{route('mesas_reg.create')}}" type="button" class="bg-light border-radius-md text-center text-success" style="width:200px; padding:6px;">
            <i class="ni ni-palette"></i> Agregar Mesa</a>
        </div>
    </div>
    </div>
    <!-- ========== Tabla========== -->
    <div class="table-responsive container-fluid">
        <table class="table" id="example" style="">
            <thead class="">
                <tr>
                    <th scope="col" style="text-align:center">N</th>
                    <th scope="col" style="text-align:center">Codigo</th>
                    <th scope="col" style="text-align:center">Mesa</th>
                    <th scope="col" style="text-align:center">Cantidad de personas</th>
                    <th scope="col" style="text-align:center">Kiosko</th>
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
                                href="{{route('mesas_reg.edit', ['id' => $r->id])}}"><i class="fa-solid fa-edit text-success"></i></a>
                            </td>
                            <td scope="col">
                                <i class="fa-solid fa-trash-can text-danger"></i>
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
