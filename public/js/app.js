
function rellenar() {
    document.getElementById("nombre2").value = document.getElementById("nombre").value;
    document.getElementById("descripcion2").value = document.getElementById("descripcion").value;
    document.getElementById("precio2").value = document.getElementById("precio").value;
}

function rellenar2() {
    document.getElementById("nombre3").value = document.getElementById("nombre").value;
    document.getElementById("descripcion3").value = document.getElementById("descripcion").value;
    document.getElementById("precio3").value = document.getElementById("precio").value;
}

const $seleccionArchivos = document.querySelector("#imagen");
const $imagenPrevisualizacion = document.querySelector("#imagenmostrada");

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

window.addEventListener('load', function() {
    var cod = document.getElementById("tipo").value;
    var x = document.getElementById("comida");
    var y = document.getElementById("bebida");

    if (cod == 1) {
        var z = document.getElementById("espacio");
        z.style.display = "none";
        document.getElementById('cantidad').disabled = false;
        document.getElementById('disponible').disabled = true;
        document.getElementById('disponible').value = '';
        document.getElementById("disponible").removeAttribute("required");
        document.getElementById("cantidad").setAttribute("required", true);
        x.style.display = "none";
        y.style.display = "block";
    } else {
        if (cod == 2) {
            var z = document.getElementById("espacio");
            z.style.display = "none";
            document.getElementById('cantidad').disabled = true;
            document.getElementById('disponible').disabled = false;
            document.getElementById('cantidad').value = '';
            document.getElementById("cantidad").removeAttribute("required");
            document.getElementById("disponible").setAttribute("required", true);
            x.style.display = "block";
            y.style.display = "none";
        }
    }
});

function producto() {
    var z = document.getElementById("espacio");
    z.style.display = "none";
    var cod = document.getElementById("tipo").value;
    var x = document.getElementById("comida");
    var y = document.getElementById("bebida");
    if (cod == 1) {
        document.getElementById('cantidad').disabled = false;
        document.getElementById('disponible').disabled = true;
        document.getElementById('disponible').value = '';
        document.getElementById("disponible").removeAttribute("required");
        document.getElementById("cantidad").setAttribute("required", true);
        x.style.display = "none";
        y.style.display = "block";
    } else {
        if (cod == 2) {
            document.getElementById('cantidad').disabled = true;
            document.getElementById('disponible').disabled = false;
            document.getElementById('cantidad').value = '';
            document.getElementById("cantidad").removeAttribute("required");
            document.getElementById("disponible").setAttribute("required", true);
            x.style.display = "block";
            y.style.display = "none";
        }
    }
}

function quitarerror() {
    const elements = document.getElementsByClassName('menerr');
    while (elements[0]) {
        elements[0].parentNode.removeChild(elements[0]);
    }
}
//funcion para el alerta para regresar
function cancelar(ruta) {

    Swal
        .fire({
            title: "¿Cancelar registro?",
            text: "¿Desea cancelar lo que esta haciendo?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonText: "Si",
            cancelButtonText: "No",
        })
        .then(resultado => {
            if (resultado.value) {
                // Hicieron click en "Sí"
                window.location.href = '/' + ruta;
            } else {
                // Dijeron que no
            }
        });

}

window.Jquery = require('jquery');