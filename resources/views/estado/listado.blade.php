@extends('00_plantillas_blade.plantilla_General1')
@section('contend')

<script>
    var msg = '{{Session::get('mensaje')}}';
    var exist = '{{Session::has('mensaje')}}';
    if(exist){
        Swal.fire({
            position: 'top-end',
            icon: 'success',
            title: msg,
            showConfirmButton: false,
            toast: true,
            background: '#0be004ab',
            timer: 3500
        })
    }

</script>


    <div class="page-wrapper bg-red p-t-170 p-b-100 font-robo">
        <br><br>
        <div class="wrapper wrapper--w960" >
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Estado de productos</h2>
                    <form method="post"  action="">
                        @csrf
                            <div style="float:right">
                                <button type="submit" class="btn btn-success">Guardar</button>
                                <button type="button" onclick="cancelar('/')" class="btn btn-warning">Cancelar</button>
                            </div>
                        <table class="table table-striped">
                            <thead>
                                <tr>
                                    <th>N°</th>
                                    <th>Seleccion</th>
                                    <th>Imagen</th>
                                    <th>Nombre</th>
                                    <th>Tipo de producto</th>
                                    <th>Precio</th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse($productos as $i=>$p)
                                    <tr>
                                        <td>{{++$i}}</td>
                                        <td>
                                            
                                            <div class="form-check form-switch">
                                            <center>
                                            @if($p->estado == 0)
                                                <input class="form-check-input"
                                                type="checkbox" name="{{$p->id}}" checked>
                                            @else
                                                <input class="form-check-input"
                                                type="checkbox" name="{{$p->id}}">
                                            @endif
                                            </center>
                                            </div>
                                            
                                        </td>
                                        <td><center><img src="../{{$p->imagen}}" alt="" width="50" height="60"></center></td>
                                        <td>{{$p->nombre}}</td>
                                        <td>
                                            @if($p->tipo)
                                                {{$p->tipo}}
                                            @else
                                                combos
                                            @endif
                                        </td>
                                        <td>{{$p->precio}}</td>
                                    </tr>
                                @empty
                                <tr>
                                    <td colspan="5">No hay datos</td>
                                </tr>
                                @endforelse
                            </tbody>
                        </table>
                    </form>
                </div>
            </div>
        </div>
    </div>
@stop
