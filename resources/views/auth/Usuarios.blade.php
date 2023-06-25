@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Usuarios')
@section('miga')
<li class="breadcrumb-item text-sm text-white active m-0" aria-current="page">Usuarios</li>
@endsection
@section('tit','Lista de Usuarios')
@section('b')
<div class="" style="">    
    <a href="{{ route('usuarios.create') }}" style="margin:0; padding:5px; width:150px; font-size:15px" type="button" 
    class="bg-light border-radius-sm text-center">
    <i class="fa fa-plus-circle"></i> Nuevo Registro
   </a> 
</div>
@endsection

@section('content')
<div class="table-responsive" style="">
    <table class="table" id="example" style="">
        <thead style="">
            <tr>
                <th scope="col" style="text-align: left;  ">Name</th>
                <th scope="col" style="text-align: left;  ">Correo</th>
                <th scope="col" style="text-align: right; width:10% ">Teléfono</th>
                <th scope="col" style="text-align: center;">Dirección</th>
                <th scope="col" style="text-align: center;">Editar</th>
                <th scope="col" style="text-align: center; ">Eliminar</th>
            </tr>
        </thead>

        <tbody>
            @forelse($listaUs as $u => $l)
            <tr style=" height:46px">
                <td scope="col" style="text-align: left;">{{$l->name}} </td>
                <td scope="col" style="text-align: left;">{{$l->email}} </td>
                <td scope="col" style="text-align: right;">{{$l->telephone}}</td>
                <td scope="col" style="text-align: right;">{{$l->address}}</td>

                <td style="text-align: center;"><a href="{{ route('usuarios.editar', ['id' => $l->id]) }}"><i class="fa fa-edit text-success"></i></a></td>
                <td scope="col" style="text-align: center;">
                    <i data-bs-toggle="modal" data-bs-target="#staticBackdropE{{$l->id}}" class="fa-solid fa-trash-can text-danger" style="color:crimson"></i>
                    <form action="{{route('usuarios.destroy', ['id' => $l->id])}}" method="post" enctype="multipart/form-data">
                        @method('delete')
                        @csrf
                        <div class="modal fade" id="staticBackdropE{{$l->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog ">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title font-weight-bolder" id="staticBackdropLabel">Eliminar Usuario</h5>
                                    </div>
                                    <div class="modal-body">
                                        ¿Esta seguro de eliminar a <strong>{{$l->name}}</strong> 
                                        <br>de la lista de usuarios?
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
@endsection