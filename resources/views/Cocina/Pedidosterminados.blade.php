 <!DOCTYPE html>
 <html lang="en">
 <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
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
 <body style="background: rgb(220, 82, 68);">
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
                timer: 5500
            })
        }
    </script>
    
<h5 class="card class-4 text-lg text-center" 
 style="text-backgroun: #ffffff; position: relative;
top: 7px; ">Lista de pedidos pendientes en caja</h5>
<br>
<div style="display:block;   float:right">
    <a href="{{route("index")}}" class="btn btn-menu"><i class="ni ni-palette"></i> Inicio</a>
</div>
<!--------Lista de pedidos---------------->

<div class="card-body">
    <div class="table-responsive container-fluid">
        <table class="table" id="table">
            <thead class="card-header border border-light" style="color:aliceblue; text-align:center;">
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
                <tr class="border border-light" style="color:aliceblue; text-align:center;">
                    <th scope="col">{{$p->id}}</th>
                    <td scope="col">{{$p->nombreCliente}}</td>
                    <td scope="col"></td>
                    <td scope="col">{{$p->cantidad}}</td>
                    <td ><input type="checkbox" name="term" {{ !old('term') ?: 'checked' }} data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$p->id}}"
                    style="background:#ffffff; width:20px; height:20px;">
                </td>
                <td></td>
            </tr>
                    <div class="modal fade" id="staticBackdrop{{$p->id}}" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
                                aria-labelledby="staticBackdropLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <h1 class="modal-title fs-5" id="staticBackdropLabel">Terminar pedido</h1>
                                                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                                            </div>
                                            <div class="modal-body">
                                                ¿Está seguro de terminar el pedido de: <strong>{{$p->nombreCliente}}</strong>?
                                            </div>
                                            <div class="modal-footer">
                                                <form action="{{route('terminar.terminarp', ['id'=>$p->id])}}" method="POST">
                                                    @method('put')
                                                    @csrf
                                                    <div style="display: none">
                                                        <input type="text" id="t" name="t" value="1">
                                                    </div>
                                                    <input type="submit" class="btn btn-primary w-15" value="Si">
                                                <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">No</button>
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
<div style="background-color: rgba(139,0,0,0.34);"> 
    <h5 class="card class-4 text-lg text-center" style="text-backgroun: #ffffff; position: relative;
top: 7px; ">Lista de pedidos terminados</h5>
<br>


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
                @if(($p->t)=="1")
                <tr class="border border-light" style="color:aliceblue;">
                    <th scope="col">{{$p->id}}</th>
                    <td scope="col">{{$p->nombreCliente}}</td>
                    <td scope="col"></td>
                    <td scope="col">{{$p->Cantidad}}</td>
                    <td><input type="checkbox" name="term" {{ old('term') ?: 'checked' }} data-bs-toggle="modal" data-bs-target="#staticBackdrop{{$p->id}}"
                    style="background:#ffffff; width:20px; height:20px;"></input></td>
                    <td></td>
                </tr>
                @endif
                @empty
                <tr>
                    <td colspan="7" style="text-align: center;color:white;">No hay pedidos terminados</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
        </div>
        </body>
 </html>
