@extends('00_plantillas_Blade.plantilla_General2')
@section('title', 'Pedidos-cocina')
@section('contend')

     <!-- Icons -->
     <link href="fontawesome-free/css/all.min.css" rel="stylesheet">
      <link href= "assets/fontawesome/css/fontawesome.css" rel="stylesheet">
      <link href={{ asset("css/nucleo-icons.css") }} rel="stylesheet" type="text/css">
      <link href={{ asset("css/nucleo-svg.css") }} rel="stylesheet" />
      <link href={{ asset("css/main.css") }} rel="stylesheet" />
      <!-- CSS Files -->
      <link id="pagestyle" href="{{ asset("css/argon-dashboard.css") }}" rel="stylesheet" />
      <link href={{ asset("css/font-awesome.css") }} rel="stylesheet" type="text/css">
      <link href={{ asset("css/app.css") }} rel="stylesheet" type="text/css">

      <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"crossorigin="anonymous"></script>

      <script src="{{ asset("js/sweetalert2.all.min.js") }}"></script> 

    </head>
 <body>
     <script>
         var msg = '{{Session::get('mensaje ')}}';
         var exist = '{{Session::has('mensaje ')}}';
         if (exist) {
             Swal.fire({
                 position: 'top-end',
                 icon: 'success',
                 title: msg,
                 showConfirmButton: false,
                 toast: true,
                 background: '#0be004ab',
                 timer: 5500
             })
         }
     </script>
     <h5 class="card class-4 text-lg text-center" style="background-color: #fff; color:teal; position: relative;
top: 10px; ">Lista de pedidos pendientes en cocina</h5>
     <br>
      
     <!--------Lista de pedidos---------------->

     <div class="card-body">
         <div class="table-responsive container-fluid">
             <table class="table" id="table" style="background-color: #fff;">
                 <thead class="card-header border border-radius" style="color:teal; text-align:center">
                     <tr>
                         <th scope="col">Número de mesa</th>
                         <th scope="col">Nombre del cliente</th>
                         <th scope="col">Orden</th>
                         <th scope="col">Cantidad</th>
                         <th scope="col">Terminado</th>
                         <th scope="col">Detalles</th>
                     </tr>
                 </thead>
                 <tbody>
                     @forelse($pedido as $p)
                     @if(($p->estado)=="0") 
                     <tr class="border border-light" style="color:teal; text-align:center">
                         <th scope="col">{{$p->mesa}}</th>
                         <td scope="col">{{$p->nombreCliente}}</td>
                         <td></td>
                         <td></td>
                         @foreach($p->detalle as $d)
                         <td scope="col">{{$d->producto_id}}</td>
                         <td scope="col">{{$d->cantidad}}</td>
                         @endforeach
                         <td><input type="checkbox" name="term" value="!old('term') ?: 'checked' }}" data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$p->id}}" style="background:teal; width:20px; height:20px;"></td>
                        </tr>
                        <div class="modal fade" id="staticBackdrop{{$p->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                            <div class="modal-dialog">
                                <div class="modal-content">
                                     <div class="modal-header">
                                         <h1 class="modal-title fs-5" id="staticBackdropLabel">Completar pedido</h1>
                                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                    </div>
                                    <div class="modal-body" style="color:teal">
                                        ! pedido completado ¡ para: <strong>{{$p->nombreCliente}}</strong>?
                                    </div>
                                    <div class="modal-footer">
                                        <form action="{{route('pedidosPendientes_Cocina.pedidosPendientes_Cocina', ['id'=>$p->id])}}" method="POST">
                                            @method('put')
                                            @csrf
                                            <div style="display: none">
                                                <input type="text" id="estado" name="estado" value="1">
                                            </div>
                                            <input type="submit" class="btn btn-danger w-15" value="Si">
                                            <button  type="button" class="btn btn-menu" data-bs-dismiss="modal">No</button>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                        @empty
                        <tr>
                            <td colspan="7" style="text-align: center;color:white;">No hay pedidos</td>
                        </tr>
                     @endforelse
                 </tbody>
                </table>
                <div style="display:block; float:right;"> 
                    {{$pedido->links()}}
                </div>
            </div>

@endsection