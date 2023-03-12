function cambiarCheck(){
    console.log('Cambio')
    document.getElementById('activarPlatillo').innerHTML = '<div onclick="cambiarCheck()" id="activarPlatillo" class="form-check form-switch text-end"><input data-bs-toggle="modal" data-bs-target="#modalactivarPlatillo{{ $p->id }}" class="form-check-input" type="checkbox" name="chckBox_disponible" id="disponible" style="position:absolute; bottom: 90.5%; left: 290px"> </div>'
}