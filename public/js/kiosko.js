$(function () {

    console.log('Document cargado'); // message start
    var comprobarNombre = $('#name').val();

    if (comprobarNombre.length == 0) { //comprobar si el nombre está vacío, en caso de estarlo cargar la fecha de hoy.
        var fechaActual = new Date();
        // Formatear la fecha actual para el campo de fecha (YYYY-MM-DD)
        var fechaFormateada = fechaActual.toISOString().slice(0, 10);
        $('#fecha').val(fechaFormateada);
    }



    $('#fecha').on('change', function (e) {
        e.stopPropagation();
        console.log('Disparado por fecha!');
        $('#kiosko').removeClass('text-danger');
        console.log(e);
        var fecha = $(this).val(); //obtener la fecha clicada por el usuario
        var nombre = $('#name').val(); //obtener el nombre ingresado por el usuario
        console.log($(this).val());
        console.log(nombre);
        $('#kiosko').empty(); //limpiar el select kiosko

        //Peticion para obtner TODOS los kioskos
        $.ajax({
            url: '/kioskos',
            method: 'GET',
            success: function (kioskos) {
                console.log(kioskos)
                addSelectKioskos(kioskos, fecha, nombre); //llama funcion que agrega los option al select
                console.log('Campo de kiosko recargado!');
            }
        })

        console.log('Entando en disparador de change en #fecha!');

    })

    $('#fecha').trigger('change'); //desencadenar el evento change del input fecha para cargar los kioskos disponibles hoy

    console.log('Terminado'); // messsage finish

})

function addSelectKioskos(kiosko, fecha, nombre) {
    //ajax anidado para obtener las fechas en que hay reservaciones
    $.ajax({
        url: '/kiosko/reservaciones',
        method: 'GET',
        success: function (reservacion) {

            console.log(reservacion);
            console.log(kiosko);
            var disponible = true;

            if ($('#kiosko').html().trim() === '') { //para que no se repita 2 veces el ingreso en el select de kiosko (provicional)

                for (let i = 0; i < kiosko.length; i++) {
                    for (let j = 0; j < reservacion.length; j++) {

                        if (reservacion[j].kiosko == kiosko[i].codigo && reservacion[j].fecha == fecha) { //comprobamos si hay un resrvacion en este kiosko con la fecha enviada desde el formulario

                            console.log('Reservacion de ' + reservacion[j].nombreCliente + ' en el kisoko ' + kiosko[i].codigo); //confirmacion

                            if (!(nombre == reservacion[j].nombreCliente)) { // si la reservacion registrada es de la misma persona, dar disponibilidad al kisoko (edicion de reservación)
                                disponible = false;
                                console.log('Misma!!');
                            }

                        }
                    }

                    if (disponible) {
                        $('#kiosko').append(new Option(kiosko[i].codigo, kiosko[i].id)); //Agregar opcion al select
                        console.log('En esta fecha no hay reservaciones en el kisoko ' + kiosko[i].codigo + '!'); // message
                    }

                    disponible = true;
                }
            }

            //Comprobación si después de iterar en todos los kisokos no hay ninguno disponible
            if ($('#kiosko').html().trim() === '')
                selectVacio();

        }, error: function (e) {
            errorAlert(e)
        }
    })

}

//Mensaje cuando no hay kioskos disponibles en la fecha elegida
function selectVacio() {
    if ($('#kiosko').html().trim() === '') {
        $('#kiosko').append(new Option('No hay kioskos disponibles en esta fecha :(', 0));
        $('#kiosko').addClass('text-danger');
        //$('#kiosko').addClass('fa fa-check'); intento de agregar icono (salió mal XD)
    }
}

// function colocarNombre() {
//     var file = document.querySelector('#imagen');
//     var file = document.querySelector('#imagen').files[0];
//     var info = file.name;
//     if (info == '') {
//         info = 'Ningún archivo seleccionado'
//     }
//     document.getElementById('label').innerHTML = '<i class="fa fa-file-image"></i> ' + info;

// }

// function elegirImagen() {
//     document.querySelector('#imagen').click();
// }