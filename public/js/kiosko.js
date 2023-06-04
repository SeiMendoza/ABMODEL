function colocarNombre() {
    var file = document.querySelector('#imagen');
    var file = document.querySelector('#imagen').files[0];
    var info = file.name;
    if (info == '') {
        info = 'Ningún archivo seleccionado'
    }
    document.getElementById('label').innerHTML = '<i class="fa fa-file-image"></i> ' + info;

}

function elegirImagen() {
    document.querySelector('#imagen').click();
}