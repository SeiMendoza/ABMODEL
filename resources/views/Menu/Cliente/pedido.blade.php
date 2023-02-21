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
    <link href="/css/main.css" rel="stylesheet" media="all">

</head>
<body>
    <div class="page-wrapper bg-red p-t-180 p-b-100 font-robo">
        <div class="wrapper wrapper--w960">
            <div class="card card-2">
                <div class="card-heading"></div>
                <div class="card-body">
                    <h2 class="title">Datos del Pedido:</h2>
                    <form method="POST">
                        <div>
                            <div style="display: none">
                                <input type="number" id="quiosco">
                                <input type="number" id="mesa">
                            </div>
                            <div class=" form-floating">
                                <input type="text" id="name" class="form-control form-control-lg @error('name') is-invalid @enderror"
                                 placeholder="Ingrese su nombre aquí">
                                <label for="name">Ingrese su nombre completo</label>
                                @error('name')
                                <small class="invalid-feedback">
                                <strong>{{ $message }}</strong>
                                </small>
                                @enderror
                            </div>
                        </div>
                        <div class="p-t-30">
                            <button class="btn btn--radius btn--green" type="submit">Search</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <!-- Main JS-->
    <script src={{ asset("/js/core/bootstrap.min.js") }}></script>
</body>
</html>
