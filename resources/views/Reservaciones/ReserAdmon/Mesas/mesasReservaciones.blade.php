@extends('Reservaciones.ReserAdmon.Mesas.tabla')
@section('title', 'Mesas')
@section('miga')
<li class="breadcrumb-item text-sm text-dark" aria-current="page">Mesas</li>
@endsection
@section('content')
  
    <!-- ========== tabla ========== -->
    <div class="">
        <table class="table" id="example" style="">
            <thead>
                <tr>
                    <th scope="col" style="text-align: center;">N</th>
                    <th scope="col" style="text-align: center;">Código</th>
                    <th scope="col" style="text-align: center;">Mesa</th>
                    <th scope="col" style="text-align: center;">Cantidad de personas</th>
                    <th scope="col" style="text-align: center;">Kiosko</th>
                    <th scope="col" style="text-align: center;">Editar</th>
                    <th scope="col" style="text-align: center;">Eliminar</th>
                </tr>
            </thead>
            <tbody>
                @forelse($reservaciones as $i => $r)
                    
                        <tr class="" style="text-align:center">
                            <td scope="col">{{++$i}}</td>
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
@endsection