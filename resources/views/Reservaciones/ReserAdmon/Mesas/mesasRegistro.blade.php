@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Mesas')
@section('miga')
<li class="breadcrumb-item text-sm text-dark" aria-current="page">Mesas</li>
@endsection

@section('content')
    <div style="margin-left:25px; margin-top:15px; display:block; float:left;
        color: #333333;" class="nav-link-icon">                            
            <h4 class="h4"> <strong>Registro de Mesas</strong> </h4>
    </div>
    <div class="nav d-flex justify-content-end " style="margin:0px; display:block; float:rigth" >
        <div class="nav d-flex justify-content-end " style="height: 60px">
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
            <div style="margin: 10px 25px 10px 25px;" class=" nav-link-icon">
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
                    <table class="table" id="table" style="">
                        <thead class="" style="text-align:center">
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
            </div>
        </div>
    <!-- ========== End ========== -->
@endsection

@section('pie')
    <div class="pagination justify-content-end" style="padding-right: 21px"> 
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
