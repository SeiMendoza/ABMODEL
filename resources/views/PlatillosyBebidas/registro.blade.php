<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet" 
integrity="sha384-GLhlTQ8iRABdZLl6O3oVMWSktQOp6b7In1Zl3/Jr59b6EGGoI1aFkw7cmDA6j6gD" crossorigin="anonymous">

<div class="x_content">
    <br />
    @if($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach($errors->all() as $error)
                    <li>
                        {{$error}}
                    </li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post"  action="" enctype="multipart/form-data">
        @csrf
        <div class="item form-group">
            <h1><center>Creacion de Platillos y Bebidas</center></h1>
            <br><br>
            <div style="width:90%; margin-left: 5%;">
                <div style="float:left; width:10%">
                    <label class="col-form-label col-md-3 col-sm-3 label-align" for="first-name">Tipo:</label>
                </div>
                <div class="col-md-6 col-sm-6" style="float:left; width:90%">
                    <select name="tipo" id="tipo" required="required" class="form-control" onchange="producto()">
                        @if(old('tipo') === 0 )
                            <option value="0" style="display:none">Comida</option>
                        @else
                            @if(old('tipo') === 1 )
                                <option value="1" style="display:none">Bebida</option>
                            @else
                                <option value="" style="display:none">--Seleccione una opción--</option>
                            @endif
                        @endif
                        <option value="0">Comida</option>
                        <option value="1">Bebida</option>
                    </select>
                </div>
            </div>

<br><br><br>

            <div style="width:90%; margin-left: 5%;">
                <label class="col-form-label" style="float:left; width:10%">Nombre:</label>
                <div class="">
                    <input maxlength="50" type="text" id="nombre" name="nombre" required="required" class="form-control "
                    value="{{old('nombre')}}" minlength="3" style="float:left; width:40%"
                    placeholder="Ingrese el nombre">
                </div>

                <label class="col-form-label" style="margin-left: 2%;float:left; width:10%">Precio:</label>
                <div class="">
                    <input type="number" id="precio" name="precio" required="required" class="form-control "
                    value="{{old('precio')}}" style="float:left; width:20%" min="1" max="1000"
                    placeholder="0.00">
                </div>

            </div>

            <div style="width:10%; margin-right: 5%; float: right;">
                <div style="float: right;">
                    <img src="" alt="" width="200px" height="200px" style="float: left;" id="imagenmostrada">
                    <br>
                    <input type="file" id="imagen" name="imagen" accept="image/*"
                     value="{{old('imagenPrevisualizacion')}}" style="float: left; color: white;width: 200px;" >
                </div>
            </div>

            <script>
                const $seleccionArchivos = document.querySelector("#imagen"),
                $imagenPrevisualizacion = document.querySelector("#imagenmostrada");

                // Escuchar cuando cambie
                $seleccionArchivos.addEventListener("change", () => {
                // Los archivos seleccionados, pueden ser muchos o uno
                const archivos = $seleccionArchivos.files;
                // Si no hay archivos salimos de la función y quitamos la imagen
                if (!archivos || !archivos.length) {
                    $imagenPrevisualizacion.src = "";
                    return;
                }
                // Ahora tomamos el primer archivo, el cual vamos a previsualizar
                const primerArchivo = archivos[0];
                // Lo convertimos a un objeto de tipo objectURL
                const objectURL = URL.createObjectURL(primerArchivo);
                // Y a la fuente de la imagen le ponemos el objectURL
                $imagenPrevisualizacion.src = objectURL;
                });
            </script>

<br><br><br>

            <div style="width:90%; margin-left: 5%;">
                <label class="col-form-label" style="float:left; width:10%">Descripcion:</label>
                <div class="">
                    <input maxlength="100" type="text" id="descripcion" name="descripcion" required="required" class="form-control "
                    value="{{old('descripcion')}}" minlength="3" style="float:left; width:40%"
                    placeholder="Ingrese la descripcion">
                </div>

                <label class="col-form-label" style="margin-left: 2%;float:left; width:10%">Tamaño:</label>
                <div class="">
                    <input type="text" id="tamanio" name="tamanio" required="required" class="form-control "
                    value="{{old('tamanio')}}" style="float:left; width:20%" 
                    placeholder="Ingrese el tamaño" maxlength="100" minlength="3">
                </div>
            </div>

<br><br><br>

            <!--Seleccionado por refresco-->
            <div style="display: none;" id="refresco" style="width:90%; margin-left: 5%;">
                
                <div style="width:90%; margin-left: 5%;">
                    <label class="col-form-label" style="float:left; width:10%">Cantidad:</label>
                    <div class="">
                        <input type="number" id="cantidad" name="cantidad" required="required" class="form-control "
                        value="{{old('cantidad')}}" style="float:left; width:72%" min="1" max="1000"
                        placeholder="Ingrese la cantidad">
                    </div>
                </div>
            </div>

            <!--Seleccionado por comida-->
            <div style="display: none;" id="comida" style="width:90%; margin-left: 5%;">
                <div style="width:90%; margin-left: 5%;">
                    <label class="col-form-label" style="float:left; width:10%">Disponible:</label>
                    <div class="">
                        <input type="number" id="disponible" name="disponible" required="required" class="form-control "
                        value="{{old('disponible')}}" style="float:left; width:72%" min="1" max="1000"
                        placeholder="Ingrese la cantidad de platillos disponibles">
                    </div>
                </div>
            </div>

<br><br>

            <div style="width:95%; margin-left: 5%;">
                <button type="submit" class="btn btn-success">Guardar</button>
                <a type="button" href="javascript:location.reload()" class="btn btn-warning">Limpiar</a>
            </div>

            <script>
                window.addEventListener('load', function() {
                    var cod = document.getElementById("tipo").value;

                    var c = document.getElementById("comida");
                    var r = document.getElementById("refresco");

                    if (cod == 1) {
                        r.style.display = "block";
                        document.getElementById("disponible").removeAttribute("required");
                        document.getElementById("cantidad").setAttribute("required", true);
                        c.style.display = "none";
                    } else {
                        if (cod == 0) {
                            c.style.display = "block";
                            document.getElementById("cantidad").removeAttribute("required");
                            document.getElementById("disponible").setAttribute("required", true);
                            r.style.display = "none";
                        }
                    }
                });


                function producto(){
                    var cod = document.getElementById("tipo").value;
                    var c = document.getElementById("comida");
                    var r = document.getElementById("refresco");

                    if (cod == 1) {
                        document.getElementById("disponible").value = "";
                        r.style.display = "block";
                        document.getElementById("disponible").removeAttribute("required");
                        document.getElementById("cantidad").setAttribute("required", true);
                        c.style.display = "none";
                    } else {
                        if (cod == 0) {
                            document.getElementById("cantidad").value = "";
                            c.style.display = "block";
                            document.getElementById("cantidad").removeAttribute("required");
                            document.getElementById("disponible").setAttribute("required", true);
                            r.style.display = "none";
                        }
                    }
                }
            </script>

        </div>

    </form>
</div>