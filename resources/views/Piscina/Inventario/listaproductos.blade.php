@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Piscina-productos')

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>


@section('miga')
<li class="breadcrumb-item text-sm active m-0 text-white">
    <a class="text-white" href="{{route('piscina.store')}}">Nuevo producto</a>
</li>
@endsection
@section('tit','Productos de piscina')
@section('b')
<!---<h3 class="font-weight-bolder opacity-8  text-gray mb-0" 
style="position: absolute; top:100%;left:1%">Productos de piscina</h3>--->
<div class="" style=""> 
    <a href="{{route('piscina.store')}}" style="margin:0; padding:5px; width:150px;" 
    type="button" class="bg-light border-radius-sm text-center">
        <i class="fa fa-plus-circle"></i> Nuevo producto
    </a>
</div>
@endsection
@section('content')
@if($errors->any())
@foreach($errors->all() as $error)
<script>
    Swal.fire({
        position: 'top-end',
        icon: 'warning',
        title: '{{$error}}',
        showConfirmButton: false,
        toast: true,
        background: '#fff',
        timer: 5500
    })
</script>
@endforeach
@endif

<style>
    .productpiscina {
        height: 50px;
        line-height: 30px;
        margin-bottom: 0px;
    }
</style>

<!--------Lista de productos---------------->

<div class="table-responsive">
    <table class="table" id="example">
        <thead>
            <tr>
                <th scope="col" style="text-align:center">N</th>
                <th scope="col" style="text-align:center">Producto</th>
                <th scope="col" style="text-align:center;text-transform:initial;">Tipo de producto</th>
                <th scope="col" style="text-align:center">Cantidad</th>
                <th scope="col" style="text-align:center">Editar</th>
                <th scope="col" style="text-align:center">Eliminar</th>
            </tr>
        </thead>
        <tbody>
            @forelse($prod as $i => $p)
            <tr style="text-align:center;">
                <td scope="col">{{++$i}}</td>
                <td scope="col">{{$p->nombre}}</td>
                <td scope="col">{{$p->tipo_producto->descripcion}}</td>
                <td scope="col">
                    <!--Boton para restar cantidad-->
                    <a style="color: red;" class="productpiscina" data-toggle="modal" data-target="#restar{{$p->id}}">
                        <i class="fa fa-minus-circle" aria-hidden="true"></i>
                    </a>
                    <!--Texto de cantidad-->
                    {{$p->peso}} @if ($p->tipo_producto->id == 1) Libras @else Onzas @endif
                    <!--Boton para agregar cantidad-->
                    <a style="color: blue;" class="productpiscina" data-toggle="modal" data-target="#agregar{{$p->id}}">
                        <i style="text-size-adjust: 2px;" class="fa fa-plus-circle" aria-hidden="true"></i>
                    </a>

                    <!--Modal de agregar cantidad-->
                    <div class="modal fade" id="agregar{{$p->id}}" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-success d-flex align-items-center">
                                    <strong>
                                        <h3 class="mx-auto">
                                            Agregar onzas a {{$p->nombre}}
                                        </h3>
                                    </strong>
                                </div>
                                <form method="post" action="{{ route('piscina.agregar',['id'=>$p->id]) }}">
                                    @csrf
                                    <div class="modal-body">
                                        <label for="">Ingrese la cantidad que se sumara:</label>
                                        <input type="number" placeholder="Ingrese la cantidad" name="cantidad" id="cantidad" class="form-control" step="0.01" style="width:250px;height:30px;">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>

                    <!--Modal de quitar cantidad-->
                    <div class="modal fade" id="restar{{$p->id}}" tabindex="-1" role="dialog" aria-hidden="true" data-backdrop="static">
                        <div class="modal-dialog modal-dialog-centered" role="document">
                            <div class="modal-content">
                                <div class="modal-header bg-danger d-flex align-items-center">
                                    <strong>
                                        <h3 class="mx-auto">
                                            Restar onzas a {{$p->nombre}}
                                        </h3>
                                    </strong>
                                </div>
                                <form method="post" action="{{ route('piscina.restar',['id'=>$p->id]) }}">
                                    @csrf
                                    <div class="modal-body">
                                        <label for="">Ingrese la cantidad que se restara:</label>
                                        <input type="number" placeholder="Ingrese la cantidad" name="cantidad" id="cantidad" class="form-control" step="0.01" style="width:250px;height:30px;">
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-danger" data-dismiss="modal">Cancelar</button>
                                        <button type="submit" class="btn btn-primary">Guardar</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!----icono para editar el producto------>
                </td>
                <td>
                    <a href="{{ route('producto.edit', ['id' => $p->id]) }}">
                        <i class="fa-solid fa-edit text-success" style="color:rgb(33, 195, 247)"></i>
                </td>
                <!----icono para borrar el producto------>
                <td>
                    <i data-bs-toggle="modal" data-bs-target="#staticBackdropE{{$p->id}}" class="fa-solid fa-trash-can text-danger" style="color:crimson"></i>
                    <form action="{{route('prodpiscina.destroy', ['id' => $p->id])}}" method="post" enctype="multipart/form-data">
                        @method('delete')
                        @csrf
                        <div class="modal fade" id="staticBackdropE{{$p->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title  font-weight-bolder" id="staticBackdropLabel">Eliminar producto</h5>
                                    </div>
                                    <div class="modal-body">
                                        ¿Esta seguro de borrar el producto: {{$p->nombre}}?
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