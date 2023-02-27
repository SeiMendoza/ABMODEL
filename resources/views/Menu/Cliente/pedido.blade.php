<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="Colorlib Templates">
    <meta name="author" content="Colorlib">
    <meta name="keywords" content="Colorlib Templates">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">

    <title>Pedido</title>
    <!-- CSS Files -->
  
    <link id="pagestyle" href="/css/argon-dashboard.css?v=2.0.4" rel="stylesheet"/>
    <link href={{ asset("css/nucleo-icons.css") }} rel="stylesheet" type="text/css">
    <link href={{ asset("css/nucleo-svg.css") }} rel="stylesheet" />
    <link href={{ asset("css/main.css") }} rel="stylesheet" />
    <link href="/css/main.css" rel="stylesheet" media="all">

</head>
<body>
    <div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading" style="padding-top: 100px;"></div>
                <div class="card-body">
                    <h2 class="title">Datos del Pedido:</h2>
                    <form method="POST" enctype="multipart/form-data">
                        @csrf
                        <div class="row mt-3">
                            <div style="display: none">
                                <input type="number" id="quiosco" value="1">
                                <input type="number" id="mesa" value="1">
                            </div>
                            <div class=" form-floating">
                                <input type="text" id="name" class="form-control @error('name') is-invalid @enderror"
                                 placeholder="Ingrese su nombre aquí" value="{{old('name')}}">
                                <label for="name">Ingrese su nombre completo</label>
                                @error('name')
                                <small class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="row mt-3">
                            <section>
                                <div>
                                    <div class="table-responsive" style="height: 400px; overflow:scroll;" id="carrito">
                                        <table class="table" id="lista-compra">
                                            <thead style="background-color: rgba(255, 39, 39, 0.51)">
                                            <tr> 
                                            <th>Nombre</th>
                                            <th>Cantidad</th>
                                            <th>Precio</th>
                                            <th>Total</th>
                                            <th>Eliminar</th>
                                            </tr>
                                            </thead>
                                            <tbody class="tbody">
                                                <input type="text" name="tuplas" class="form-control @error('tuplas') is-invalid @enderror"
                                                id="tuplas" hidden value="{{old('tuplas')}}">
                                                @error('tuplas')
                                                <small class="invalid-feedback">
                                                    <strong>{{ $message }}</strong>
                                                </small>
                                                @enderror
                                            </tbody>
                                        </table>
                                    </div>
                            </section>
                        </div>
                        <div class="row mt-3">
                            <div>
                                <div style="float:right;" class="total">
                                    Total = L 0.00
                                </div>
                            </div>
                        </div>
                        <div class="row mt-3">
                            <div>
                                <div>
                                    <div style="display: block; float:left"><a href="{{route("cliente_menu.index")}}" onclick="" id="procesar-compra"
                                        class="btn btn-info" >Regresar al menú</a></div>
                                    <div style="display: block; float:right;"><a href="{{route("usuario_pedido.store")}}" type="submit" onclick="" id="procesar-compra"
                                        class="btn btn-success">Guardar</a></div>
                                    <div>
                                    <div style="display: block; float:right">
                                        <button type="button" onclick="cancelar('/');" class="btn btn-warning">Cancelar</button>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <script src={{ asset("/js/core/bootstrap.min.js") }}></script>
    <script src= "/js/compras.js"></script>
    <script src="/js/app.js"></script>
   
</body>
</html>
