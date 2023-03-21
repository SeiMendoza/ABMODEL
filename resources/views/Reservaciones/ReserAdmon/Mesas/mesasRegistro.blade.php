@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Mesas')
@section('miga')
<li class="breadcrumb-item text-sm text-dark" aria-current="page">Mesas</li>
<li class="breadcrumb-item text-sm text-dark active" aria-current="page">Registro de mesas</li>
@endsection

@section('content')
    <div style="margin-left:25px; margin-top:15px; display:block; float:left;
        color: #333333;font-family: Georgia, Serif;" class="nav-link-icon">                            
            <h4>Registro de Mesas</h4>
    </div>
    <div class="nav d-flex justify-content-end " style="margin:0px 0px 5px 5px; display:block; float:rigth" >
        <div style="margin: 11px 0 0 10px; display:block; float:left" class="nav-link-icon">                            
            <a href="{{ route('mesas_res.index') }}" type="button" class="bg-light border-radius-md h-6 text-center text-success" style="width:300px; padding:6px;">
            <i class="fa fa-table text-sm text-center opacity-10"></i>
            Ir a reservaciones de mesas</a>
        </div>
        <div class="nav d-flex justify-content-end " style="">
            <div class="" style="margin: 10px 0 0 10px">
                <form action="{{ route('mesas_reg.search') }}" method="get" role="search" 
                    class="navbar-search" >
                    <div class="input-group">
                        <input class="form-control" type="search" id="busqueda" name="busqueda" style="width: 200px" 
                        placeholder="Buscar por nombre" aria-label="Search" 
                        aria-describedby="basic-addon2" maxlength="50" required value="<?php if (isset($text)) {echo $text;} ?>"/>
                        <button class="bg-success border-radius-md" type="submit" 
                            style="border: 0; color:aliceblue"><strong>Buscar</strong>
                        </button>    
                        @if(isset($text)!="")
                        <a href="{{route('mesas_reg.index')}}" type="button" style="color:aliceblue; width:150px; padding:6px;"  
                        class="bg-secondary border-radius-md h-6 text-center"><strong style="">Borrar Busqueda</strong></a>
                        @endif
                    </div>   
                </form>
            </div>
            <div style="margin: 10px 0 0 10px;" class=" nav-link-icon">
                <a href="{{route('mesas_reg.create')}}" type="button" class="bg-light border-radius-md h-6 text-center text-success" style="width:200px; padding:6px;">
                <i class="fa fa-newspaper"></i> Agregar mesas</a>
            </div>
        </div>
    </div>

    <!-- ========== Registro ========== -->
        <div class=""  id="registro" style="">  
            <!-- ========== Cards ========== -->
            <div class="">
                <div class="table-responsive container-fluid">
                    <table class="table" id="table" style="background-color: #fff;">
                        <thead class="card-header border border-radius" style="color:teal; text-align:center">
                            <tr>
                                <th scope="col">N</th>
                                <th scope="col">Codigo</th>
                                <th scope="col">Mesa</th>
                                <th scope="col">Cantidad de personas</th>
                                <th scope="col">Kiosko</th>
                                <th scope="col">Editar</th>
                                <th scope="col">Eliminar</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($registros as $i => $r)
                                 
                                    <tr class="border border-light" style="color:teal; text-align:center">
                                        <th scope="col">{{++$i}}</th>
                                        <td scope="col">{{$r->codigo}}</td>
                                        <td scope="col">{{$r->nombre}}</td> 
                                        <td scope="col">{{$r->cantidad}}</td>
                                        <td scope="col">{{$r->kiosko_id}}</td>
                                        <td  scope="col" ><a class="bg-light border-radius-md h-6 text-center text-success" 
                                            href="{{route('mesas_reg.edit', ['id' => $r->id])}}"><i class="fa fa-edit"></i></a>
                                        </td>
                                        <td scope="col">
                                            
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
    <!-- ========== End ========== -->
@endsection

@section('pie')
    <div class="pagination justify-content-end"> 
        <div style="display:block; float:right;"> 
            {{$registros->links()}}
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
