 <!DOCTYPE html>
 <html lang="en">

 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="apple-touch-icon" sizes="76x76" href="/assets/img/apple-icon.png">
        <link rel="icon" type="image/png" href="/assets/img/favicon.png">
    <title>Pedidos</title>
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
     <h5 class="card class-4 text-lg text-center" style="background-color: #ff6666; color:aliceblue; position: relative;
top: 7px; ">Lista de pedidos pendientes en cocina</h5>
     <br>
     <div style="display:block;   float:right">
         <a href="{{route("menuAdmon.index")}}" class="btn btn-menu"><i class="ni ni-palette"></i> Inicio</a>
     </div>
     <!--------Lista de pedidos---------------->

     <div class="card-body">
         <div class="table-responsive container-fluid">
             <table class="table" id="table" style="background-color: #ff6666;">
                 <thead class="card-header border border-light" style="color:aliceblue; text-align:center">
                     <tr>
                         <th scope="col">Número de orden</th>
                         <th scope="col">Nombre del cliente</th>
                         <th scope="col">Orden</th>
                         <th scope="col">Cantidad</th>
                         <th scope="col">Terminado</th>
                         <th scope="col">Detalles</th>
                     </tr>
                 </thead>
                 <tbody>
                     @forelse($pedido as $p)
                     @if(($p->t)=="0")
                     <tr class="border border-light" style="color:aliceblue; text-align:center">
                         <th scope="col">{{$p->id}}</th>
                         <td scope="col">{{$p->nombreCliente}}</td>
                         <td scope="col">{{$p->detalle->producto_id}</td>
                         <td scope="col">{{$p->Cantidad}}</td>
                         <td><input type="checkbox" name="term" {{ !old('term') ?: 'checked' }} data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$p->id}}" style="background:#ffffff; width:20px; height:20px;"></td>
                         <td></td>
                     </tr>
                     <div class="modal fade" id="staticBackdrop{{$p->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="staticBackdropLabel" aria-hidden="true">
                         <div class="modal-dialog">
                             <div class="modal-content">
                                 <div class="modal-header">
                                     <h1 class="modal-title fs-5" id="staticBackdropLabel">Completar pedido</h1>
                                     <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                 </div>
                                 <div class="modal-body">
                                     ! pedido completado ¡ para: <strong>{{$p->nombreCliente}}</strong>?
                                 </div>
                                 <div class="modal-footer">
                                     <form action="{{route('pedidosPendientes_Cocina.pedidosPendientes_Cocina', ['id'=>$p->id])}}" method="POST">
                                         @method('put')
                                         @csrf
                                         <div style="display: none">
                                             <input type="text" id="t" name="t" value="1">
                                         </div>
                                         <input type="submit" class="btn btn-danger w-15" value="Si">
                                         <button type="button" class="btn btn-menu" data-bs-dismiss="modal">No</button>
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
         </div>

 </body>

 </html>