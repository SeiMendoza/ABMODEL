$(function () {

    console.log('Iniiciando...');

    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });

    //Inicialización de Datatables- Complementos Disponibles

    var language = {
        "processing": "Procesando...",
        "lengthMenu": "Mostrar _MENU_ registros",
        "zeroRecords": "No se encontraron resultados",
        "emptyTable": "Ningún dato disponible en esta tabla",
        "infoEmpty": "Mostrando registros del 0 al 0 de un total de 0 registros",
        "infoFiltered": "(filtrado de un total de _MAX_ registros)",
        "search": "Buscar:",
        "infoThousands": ",",
        "loadingRecords": "Cargando...",
        "paginate": {
            "first": "Primero",
            "last": "Último",
            "next": "Siguiente",
            "previous": "Anterior"
        },
        "aria": {
            "sortAscending": ": Activar para ordenar la columna de manera ascendente",
            "sortDescending": ": Activar para ordenar la columna de manera descendente"
        },
        "buttons": {
            "copy": "Copiar",
            "colvis": "Visibilidad",
            "collection": "Colección",
            "colvisRestore": "Restaurar visibilidad",
            "copyKeys": "Presione ctrl o u2318 + C para copiar los datos de la tabla al portapapeles del sistema. <br \/> <br \/> Para cancelar, haga clic en este mensaje o presione escape.",
            "copySuccess": {
                "1": "Copiada 1 fila al portapapeles",
                "_": "Copiadas %ds fila al portapapeles"
            },
            "copyTitle": "Copiar al portapapeles",
            "csv": "CSV",
            "excel": "Excel",
            "pageLength": {
                "-1": "Mostrar todas las filas",
                "_": "Mostrar %d filas"
            },
            "pdf": "PDF",
            "print": "Imprimir",
            "renameState": "Cambiar nombre",
            "updateState": "Actualizar",
            "createState": "Crear Estado",
            "removeAllStates": "Remover Estados",
            "removeState": "Remover",
            "savedStates": "Estados Guardados",
            "stateRestore": "Estado %d"
        },
        "autoFill": {
            "cancel": "Cancelar",
            "fill": "Rellene todas las celdas con <i>%d<\/i>",
            "fillHorizontal": "Rellenar celdas horizontalmente",
            "fillVertical": "Rellenar celdas verticalmentemente"
        },
        "decimal": ",",
        "searchBuilder": {
            "add": "Añadir condición",
            "button": {
                "0": "Constructor de búsqueda",
                "_": "Constructor de búsqueda (%d)"
            },
            "clearAll": "Borrar todo",
            "condition": "Condición",
            "conditions": {
                "date": {
                    "after": "Despues",
                    "before": "Antes",
                    "between": "Entre",
                    "empty": "Vacío",
                    "equals": "Igual a",
                    "notBetween": "No entre",
                    "notEmpty": "No Vacio",
                    "not": "Diferente de"
                },
                "number": {
                    "between": "Entre",
                    "empty": "Vacio",
                    "equals": "Igual a",
                    "gt": "Mayor a",
                    "gte": "Mayor o igual a",
                    "lt": "Menor que",
                    "lte": "Menor o igual que",
                    "notBetween": "No entre",
                    "notEmpty": "No vacío",
                    "not": "Diferente de"
                },
                "string": {
                    "contains": "Contiene",
                    "empty": "Vacío",
                    "endsWith": "Termina en",
                    "equals": "Igual a",
                    "notEmpty": "No Vacio",
                    "startsWith": "Empieza con",
                    "not": "Diferente de",
                    "notContains": "No Contiene",
                    "notStartsWith": "No empieza con",
                    "notEndsWith": "No termina con"
                },
                "array": {
                    "not": "Diferente de",
                    "equals": "Igual",
                    "empty": "Vacío",
                    "contains": "Contiene",
                    "notEmpty": "No Vacío",
                    "without": "Sin"
                }
            },
            "data": "Data",
            "deleteTitle": "Eliminar regla de filtrado",
            "leftTitle": "Criterios anulados",
            "logicAnd": "Y",
            "logicOr": "O",
            "rightTitle": "Criterios de sangría",
            "title": {
                "0": "Constructor de búsqueda",
                "_": "Constructor de búsqueda (%d)"
            },
            "value": "Valor"
        },
        "searchPanes": {
            "clearMessage": "Borrar todo",
            "collapse": {
                "0": "Paneles de búsqueda",
                "_": "Paneles de búsqueda (%d)"
            },
            "count": "{total}",
            "countFiltered": "{shown} ({total})",
            "emptyPanes": "Sin paneles de búsqueda",
            "loadMessage": "Cargando paneles de búsqueda",
            "title": "Filtros Activos - %d",
            "showMessage": "Mostrar Todo",
            "collapseMessage": "Colapsar Todo"
        },
        "select": {
            "cells": {
                "1": "1 celda seleccionada",
                "_": "%d celdas seleccionadas"
            },
            "columns": {
                "1": "1 columna seleccionada",
                "_": "%d columnas seleccionadas"
            },
            "rows": {
                "1": "1 fila seleccionada",
                "_": "%d filas seleccionadas"
            }
        },
        "thousands": ".",
        "datetime": {
            "previous": "Anterior",
            "next": "Proximo",
            "hours": "Horas",
            "minutes": "Minutos",
            "seconds": "Segundos",
            "unknown": "-",
            "amPm": [
                "AM",
                "PM"
            ],
            "months": {
                "0": "Enero",
                "1": "Febrero",
                "10": "Noviembre",
                "11": "Diciembre",
                "2": "Marzo",
                "3": "Abril",
                "4": "Mayo",
                "5": "Junio",
                "6": "Julio",
                "7": "Agosto",
                "8": "Septiembre",
                "9": "Octubre"
            },
            "weekdays": [
                "Dom",
                "Lun",
                "Mar",
                "Mie",
                "Jue",
                "Vie",
                "Sab"
            ]
        },
        "editor": {
            "close": "Cerrar",
            "create": {
                "button": "Nuevo",
                "title": "Crear Nuevo Registro",
                "submit": "Crear"
            },
            "edit": {
                "button": "Editar",
                "title": "Editar Registro",
                "submit": "Actualizar"
            },
            "remove": {
                "button": "Eliminar",
                "title": "Eliminar Registro",
                "submit": "Eliminar",
                "confirm": {
                    "_": "¿Está seguro que desea eliminar %d filas?",
                    "1": "¿Está seguro que desea eliminar 1 fila?"
                }
            },
            "error": {
                "system": "Ha ocurrido un error en el sistema (<a target=\"\\\" rel=\"\\ nofollow\" href=\"\\\">Más información&lt;\\\/a&gt;).<\/a>"
            },
            "multi": {
                "title": "Múltiples Valores",
                "info": "Los elementos seleccionados contienen diferentes valores para este registro. Para editar y establecer todos los elementos de este registro con el mismo valor, hacer click o tap aquí, de lo contrario conservarán sus valores individuales.",
                "restore": "Deshacer Cambios",
                "noMulti": "Este registro puede ser editado individualmente, pero no como parte de un grupo."
            }
        },
        "info": "Mostrando _START_ a _END_ de _TOTAL_ registros",
        "stateRestore": {
            "creationModal": {
                "button": "Crear",
                "name": "Nombre:",
                "order": "Clasificación",
                "paging": "Paginación",
                "search": "Busqueda",
                "select": "Seleccionar",
                "columns": {
                    "search": "Búsqueda de Columna",
                    "visible": "Visibilidad de Columna"
                },
                "title": "Crear Nuevo Estado",
                "toggleLabel": "Incluir:"
            },
            "emptyError": "El nombre no puede estar vacio",
            "removeConfirm": "¿Seguro que quiere eliminar este %s?",
            "removeError": "Error al eliminar el registro",
            "removeJoiner": "y",
            "removeSubmit": "Eliminar",
            "renameButton": "Cambiar Nombre",
            "renameLabel": "Nuevo nombre para %s",
            "duplicateError": "Ya existe un Estado con este nombre.",
            "emptyStates": "No hay Estados guardados",
            "removeTitle": "Remover Estado",
            "renameTitle": "Cambiar Nombre Estado"
        }
    };

    $('#complementosDisponibles').DataTable({
        ajax: {
            url: "/admonRestauranteC",
            method: 'POST',
            data: { estado: 1, }
        },
        dataSrc: "",
        language: language,
        bProcessing: true,
        responsive: false,
        bAutoWidth: false,
        //scrollY: 320,
        pageLength: 10,
        lengthMenu: [[10, 20, -1], [10, 20, 'Todos']],
        // "bServerSide": true,
        "columns": [
            { data: 'id' },
            { data: 'nombre' },
            { data: 'precio', },
            { defaultContent: '<button class="btnActivar"><a><i class="fa fa-times-circle text-warning"></i>Desactivar</button>' },
            { defaultContent: '<a><i class="btnEditar fa fa-edit text-success"></i></a>' },
            { defaultContent: '<a><i class="btnEliminar fa-solid fa-trash-can text-danger"></i></a>' }
        ],
        "columnDefs": [
            {
                "targets": 0, // Tu primera columna
                "className": "dt-body-center",
                //"width": "4%"
            }, {
                "targets": 2,
                "render": DataTable.render.number(null, null, 2, 'L '),
                "className": "dt-body-right",
            }, {
                "targets": 3,
                "className": "dt-body-center",

            }, {
                "targets": 4,
                "className": "dt-body-center",
            }, {
                "targets": 5,
                "className": "dt-body-center",
            },
        ],
    });

    //Inicialización de Datatables- Complementos No Disponibles
    $('#complementoNoDisponibles').DataTable({
        ajax: {
            url: "/admonRestauranteC",
            method: 'POST',
            data: { estado: 0, }
        },
        dataSrc: "",
        language: language,
        bProcessing: true,
        responsive: true,
        bAutoWidth: false,
        //scrollY: 320,
        pageLength: 10,
        lengthMenu: [[10, 20, -1], [10, 20, 'Todos']],
        "columns": [
            { data: 'id' },
            { data: 'nombre' },
            { data: 'precio', },
            { defaultContent: '<button class="btnActivar"><a><i class="fa fa-check-circle text-success"></i> Activar</button>' },
            { defaultContent: '<a><i class="btnEditar fa fa-edit text-success"></i></a>' },
            { defaultContent: '<a><i class="btnEliminar fa-solid fa-trash-can text-danger"></i></a>' }
        ],
        "columnDefs": [
            {
                "targets": 0, // Tu primera columna
                "className": "dt-body-center",
                //"width": "4%"
            }, {
                "targets": 2,
                "render": DataTable.render.number(null, null, 2, 'L '),
                "className": "dt-body-right",
            }, {
                "targets": 3,
                "className": "dt-body-center",

            }, {
                "targets": 4,
                "className": "dt-body-center",
            }, {
                "targets": 5,
                "className": "dt-body-center",
            },
        ],
    });

    console.log('Activar complememtos disponibles');

    //función para botón editar
    $(document).on('click', '.btnEditar', function (e) {
        fila = $(this).closest('tr');
        var id = parseInt(fila.find('td:eq(0)').text()) //captura el valor del campo[x] en el datatable
        $.ajax({
            url: 'producto/' + id + '/editar',
            method: 'GET',
            success: function (e) {
                console.log(id);
                location.href = 'producto/' + id + '/editar';
            }, error: function (e) {
                errorAlert('Error al editar')
            }

        })
    })

    var fila;

    //Eliminar Productos
    $(document).on('click', '.btnEliminar', function (e) {

        e.preventDefault();
        fila = $(this).closest('tr');

        //para resaltar la fila sobre la cual se está trabajando
        //$(this).removeClass('resaltado');
        // Agregar la clase "resaltado" a la fila seleccionada
        fila.addClass('resaltado');

        console.log('Ha presionado eliminar Producto en la fila del producto ' + fila.find('td:eq(0)').text());

        $('#modalDeleteComplementos').modal('show'); //Mostrar modal

    })

    //Confirmar eliminación
    $('#btnConfirmDeleteProduct').click(function (e) {

        e.preventDefault();
        var id = parseInt(fila.find('td:eq(0)').text()); //captura el valor del campo[x] en el datatable
        var nombre = fila.find('td:eq(1)').text(); //captura el valor del nombre en el datatable

        console.log('Comfirmar elimininacion del producto' + id);

        $.ajax({
            url: 'producto/' + id + '/borrar',
            method: 'GET',
            cache: false,
            beforeSend: function () {
                $('#btnConfirmDeleteProduct').text('Eliminando...'); //por si se demora en borrar
            }, success: function (e) {

                console.log('¡Producto ' + e.message + ' eliminado!');
                setTimeout(function () { $('#modalDeleteComplementos').modal('hide'); }, 40); //Ocultar modal
                $('.table').DataTable().ajax.reload(null, false); //recargar Datatable

                //Alerta de borrado
                Swal
                    .fire({
                        title: '¡Eliminado!',
                        text: 'Producto ' + nombre + ' eliminado corectamente',
                        icon: 'success',
                        confirmButtonText: "Ok",
                    })

                    .then(resultado => {
                        if (resultado.value) {
                            $('#btnConfirmDeleteProduct').text('Sí');
                        }

                    });



            }, error: function (e) {
                errorAlert('Error al eliminar');
            }

        })
    })

    $(document).on('click', '.btnActivar', function (e) {

        e.preventDefault();
        fila = $(this).closest('tr');
        console.log('Ha presionado activar en la fila del producto ' + fila.find('td:eq(0)').text());
        $('#modalActivarComplementos').modal('show');
    })

    $('#btnConfirmarActivacion').click(function (e) {

        var id = parseInt(fila.find('td:eq(0)').text()); //captura el valor del campo[x] en el datatable
        var nombre = fila.find('td:eq(1)').text(); //captura el valor del nombre en el datatable

        $.ajax({
            url: 'producto/' + id + '/activar',
            method: 'GET',
            type: 'PUT',
            dataType: 'json',
            beforeSend: function () {
                $('#btnConfirmarActivacion').text('Cambiando...'); //por si se demora en borrar
            }, success: function (e) {
                console.log('Cambiando Estado...');
                console.log(e.type + e.action);
                setTimeout(function () { $('#modalActivarComplementos').modal('hide'); }, 40); //Ocultar modal
                $('.table').DataTable().ajax.reload(null, false); //recargar Datatable

                //Alerta de borrado
                Swal
                    .fire({
                        title: e.action,
                        text: e.type + ' ' + e.name + ' ' + e.action,
                        icon: 'success',
                        confirmButtonText: "Ok",
                    })

                    .then(resultado => {
                        if (resultado.value) {
                            $('#btnConfirmarActivacion').text('Sí');
                        }

                    });

            }, error: function (e) {
                errorAlert(e.responseText);
            }

        });
    })

    console.log('Finalizado.');


});



//errorAlert
function errorAlert(msg) {
    Swal
        .fire({
            title: 'Error',
            text: msg,
            icon: 'error',
            confirmButtonText: "Ok",
        })
}

//successAlert
function successAlert(msg) {
    Swal
        .fire({
            title: 'Succes',
            text: msg,
            icon: 'success',
            confirmButtonText: "Ok",
        })
}
