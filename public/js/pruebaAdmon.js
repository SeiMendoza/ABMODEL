$(function(){

    $.ajaxSetup({
        headers:{
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Inicialización de Datatables
    $('#table').DataTable({
        "ajax": "/pruebaAdmon",
        "bProcessing": true,
       // "bServerSide": true,
        "columns": [
            {data: 'id'},
            {data: 'nombre'},
            {data: 'descripcion'},
            {data: 'precio'},
            {defaultContent: '<a><i class="btnEditar fa fa-edit text-success"></i></a>'},
            {defaultContent: '<a><i class="btnEliminar fa-solid fa-trash-can text-danger"></i></a>'}
        ],
        language: {
            search: "Buscar:"
        }
    });
    //$('#tabla').DataTable();

    //función para botón editar
    $(document).on('click', '.btnEditar', function(e){
        fila = $(this).closest('tr');
        var id = parseInt(fila.find('td:eq(0)').text()) //captura el valor del campo[x] en el datatable
        $.ajax({
            url: 'producto/'+ id +'/editar',
            method: 'GET',
            success: function(e){
                console.log(id);
                location.href ='producto/'+ id +'/editar';
            }, error: function(e){
                errorAlert('Error al editar')
            }
            
        })
    })


    var fila;

    //Eliminar Productos
    $(document).on('click', '.btnEliminar', function(e){

        e.preventDefault();
        fila = $(this).closest('tr');
        console.log('Ha presionado eliminar Producto en la fila del producto '+fila.find('td:eq(0)').text()); 

        $('#modalDelete').modal('show'); //Mostrar modal
        
    })

    //Confirmar eliminación
    $('#btnConfirmDeleteProduct').click(function(e){
        
        e.preventDefault();
        var id = parseInt(fila.find('td:eq(0)').text()); //captura el valor del campo[x] en el datatable
        var nombre = fila.find('td:eq(1)').text(); //captura el valor del nombre en el datatable

        console.log('Comfirmar elimininacion del producto'+id);

        $.ajax({
            url: 'producto/'+ id +'/borrar',
            method: 'GET',
            cache: false,
            beforeSend: function(){ $('#btnConfirmDeleteProduct').text('Eliminando...'); //por si se demora en borrar
            },success: function(e){

                console.log('¡Producto '+ id + ' eliminado!');
                setTimeout(function(){$('#modalDelete').modal('hide');}, 40); //Ocultar modal
                $('#table').DataTable().ajax.reload(null, false); //recargar Datatable
                
                //Alerta de borrado
                Swal
                .fire({
                    title: '¡Eliminado!',
                    text: 'Producto '+ nombre + ' eliminado corectamente',
                    icon: 'success',
                    confirmButtonText: "Ok",
                })
                
                .then(resultado => {
                    if (resultado.value){
                        $('#btnConfirmDeleteProduct').text('Sí');
                    }
                   
                });

                

            }, error: function(e){
                errorAlert('Error al eliminar');
            }
            
        })
    })

    // Boton de prueba
    $('#boton').click(function (e) { 
        e.preventDefault();                
        
        $.ajax({
            url: '/pruebaAdmon',
            method: 'GET',
            beforeSend: function(e){
                $('#boton').text('Actualizando datos...');
            },
            success: function(res){
                console.log(res);
                alert('Desea actualizar los datos  ');
                // $('#contenido').html('Desea actualizar los datos');
                $('#boton').text('Datos actualizados');
                $('#table').DataTable().ajax.reload();
            },
            error: function(e){
                alert(e);
            }, 
        })
    });
    
});
