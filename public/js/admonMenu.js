$.ajaxSetup({
    headers:{
        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
    }
});


$('.deleteProduct').click(function(e){
    
    var id;

    e.preventDefault();//evitar recargar la página
    id = $(this).attr('id'); //recuperar el id del registro enviado
    $('#modalDelete').modal('show'); //llamar a mostrar el modal de confirmacion de borrado

    $('#btnConfirmDeleteProduct').click(function(){
        
        $.ajax({
            url:'producto/'+ id +'/borrar',
            method: 'GET',
            beforeSend: function(){ $('#btnConfirmDeleteProduct').text('Eliminando...'); //por si se demora en borrar
            },
            success: function(data){
                setTimeout(function(){$('#modalDelete').modal('hide');}, 80);
                $('#btnConfirmDeleteProduct').text('Sí');
                location.reload();
                //$('#cDN').load(location.href+'#cND');
                //$('.table').DataTable().ajax.reload(null, false);
            }
        });

    });

    console.log("Hola Mundo"); 
});
