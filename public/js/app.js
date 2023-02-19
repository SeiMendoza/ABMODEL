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

window.addEventListener('load', function() {
    var cod = document.getElementById("tipo").value;

    if (cod == 1) {
        document.getElementById('cantidad').disabled = false;
        document.getElementById('disponible').disabled = true;
        document.getElementById('disponible').value = '';
        document.getElementById("disponible").removeAttribute("required");
        document.getElementById("cantidad").setAttribute("required", true);
    } else {
        if (cod == 0) {
            document.getElementById('cantidad').disabled = true;
            document.getElementById('disponible').disabled = false;
            document.getElementById('cantidad').value = '';
            document.getElementById("cantidad").removeAttribute("required");
            document.getElementById("disponible").setAttribute("required", true);
        }
    }
});

function producto(){
    var cod = document.getElementById("tipo").value;

    if (cod == 1) {
        document.getElementById('cantidad').disabled = false;
        document.getElementById('disponible').disabled = true;
        document.getElementById('disponible').value = '';
        document.getElementById("disponible").removeAttribute("required");
        document.getElementById("cantidad").setAttribute("required", true);
    } else {
        if (cod == 0) {
            document.getElementById('cantidad').disabled = true;
            document.getElementById('disponible').disabled = false;
            document.getElementById('cantidad').value = '';
            document.getElementById("cantidad").removeAttribute("required");
            document.getElementById("disponible").setAttribute("required", true);
        }
    }
}

function quitarerror(){
    const elements = document.getElementsByClassName('menerr');
    while (elements[0]){
        elements[0].parentNode.removeChild(elements[0]);
    }
}