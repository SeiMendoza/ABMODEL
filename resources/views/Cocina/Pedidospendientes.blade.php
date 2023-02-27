 <!DOCTYPE html>
 <html lang="en">

 <head>
     <meta charset="UTF-8">
     <meta http-equiv="X-UA-Compatible" content="IE=edge">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <title>Pedidos</title>
     <!-- Icons -->
     <link href="fontawesome-free/css/all.min.css" rel="stylesheet">
     <link href="assets/fontawesome/css/fontawesome.css" rel="stylesheet">
     <link href={{ asset("css/nucleo-icons.css") }} rel="stylesheet" type="text/css">
     <link href={{ asset("css/nucleo-svg.css") }} rel="stylesheet" />
     <link href={{ asset("css/main.css") }} rel="stylesheet" />
     <!-- CSS Files -->
     <link id="pagestyle" href="{{ asset("css/argon-dashboard.css") }}" rel="stylesheet" />
     <link href={{ asset("css/font-awesome.css") }} rel="stylesheet" type="text/css">
     <link href={{ asset("css/app.css") }} rel="stylesheet" type="text/css">

     <script src="{{ asset("js/sweetalert2.all.min.js") }}"></script>
 </head>

 <body style="background: rgb(220, 82, 68);">
     <h5 class="card class-4 text-lg text-center" style="text-backgroun: #ffffff; position: relative;
top: 7px; ">Lista de pedidos pendientes en cosina</h5>
     <br>
     <div style="display:block;   float:right">
         <a href="{{route("index")}}" class="btn btn-menu"><i class="ni ni-palette"></i> Inicio</a>
     </div>
     <!--------Lista de pedidos---------------->

     <div class="card-body">
         <div class="table-responsive container-fluid">
             <table class="table" id="table">
                 <thead class="card-header border border-light" style="color:aliceblue;">
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
                     <tr class="border border-light" style="color:aliceblue;">
                         <th scope="col">{{$p->id}}</th>
                         <td scope="col">{{$p->Nombre}}</td>
                         <td scope="col">{{$p->platillo->nombre}} || {{$p->combo->nombre}}</td>
                         <td scope="col">{{$p->Cantidad}}</td>
                         <td><button type="button" class="btn badge bg-success position-absolute
                                    " data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$p->id}}" style="top: 0.5rem; right: 0.5rem">
                                 <i class="fas fa-check"></i>
                             </button></td>
                         <td></td>
                     </tr>
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