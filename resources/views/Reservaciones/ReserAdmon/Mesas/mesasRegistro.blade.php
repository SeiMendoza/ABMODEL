@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Mesas')
@section('miga')
<li class="breadcrumb-item text-sm text-dark active m-0 text-white" aria-current="page">Lista de mesas</li>
@endsection
@section('tit','Lista de Mesas')
@section('b')
    <div class="" style="">    
        <a href="{{route('mesas_reg.create')}}" style="margin:0; padding:5px; width:150px;" 
        type="button" class="bg-light border-radius-sm text-center">
        <i class="fa fa-plus-circle"></i> Agregar
       </a> 
    </div>
@endsection
@section('content')
    <!-- ========== Tabla========== -->
    <div class="table-responsive">
        <table class="table" id="example" style="">
            <thead class="">
                <tr style="">
                    <th scope="col" style="text-align:center;">Código</th>
                    <th scope="col" style="text-align:center;">Mesa</th>
                    <th scope="col" style="text-align:center;  text-transform:initial;">Cantidad de personas</th>
                    <th scope="col" style="text-align:center">Kiosko</th>
                    <th scope="col" style="text-align:;">Estado</th>
                    <th scope="col" style="text-align: center;">QR</th>
                    <th scope="col" style="text-align:center">Editar</th>
                    <th scope="col" style="text-align:center">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($registros as $i => $r)
                        
                        <tr class="" style="text-align:center; height:46px">
                            <td scope="col" style="text-align: center; width:150px"><strong>{{$r->codigo}}</strong></td>
                            <td scope="col" style="text-align: center; width:200px">{{$r->nombre}}</td> 
                            <td scope="col">{{$r->cantidad}}</td>
                            <td scope="col">{{$r->kiosko_id}}</td>
                            <td scope="col" style="text-align: left">
                                @if ($r->estadoM == 0)
                                    Disponible
                                @else
                                    Ocupado
                                @endif
                            </td>
                            <td  scope="col"><a class="" 
                                href="{{route('mesa.Codigo_Qr', ['id' => $r->id])}}"><i class="fas fa-qrcode text-success"></i></a>
                            </td>
                            <td  scope="col"><a class="" 
                                href="{{route('mesas_reg.edit', ['id' => $r->id])}}"><i class="fa-solid fa-edit text-success"></i></a>
                            </td>
                            <td scope="col" >
                               
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
                @endforelse
            </tbody>
        </table>   
    </div>
    <!-- ========== End ========== -->
    
@endsection

@section('pie')
@endsection
