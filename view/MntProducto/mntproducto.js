var tabla;

function init() {
    $('#producto_form').on('submit',function(e){
        guardaryeditar(e);
    });
}

$(document).ready(function() {
    tabla = $('#productos_data').DataTable({
        "aProcessing": true,        //Activamos el procesamiento del datatables
        "aServerSide": true,        //Paginación y filtrado realizados por el servidor
        dom: "Bfrtip",              //Definimos los elementos del control de tabla
        buttons: [
            'copyHtml5',
            'excelHtml5',
            'csvHtml5',
            'pdf'
        ],
        "ajax":{
            url: '../../controller/producto.php?op=listar',
            type: "get",
            dataType: "json",
            error: function(e) {
                console.log(e.responseText);
            }
        },
        "bDestroy": true,
        "responsive": true,
        "bInfo": true,
        "iDisplayLength": 10,        //Por cada 10 registros hace una páginación
        "order": [[ 0, "asc" ]],    //Ordenar (columna, orden)
        "language": {
            "sProcessing":          "Procesando...",
            "sLengthMenu":          "Mostrar _MENU_ registros",
            "sZeroRecords":         "No se encontraron resultados",
            "sEmptyTable":          "Ningún dato disponible en esta tabla",
            "sInfo":                "Mostrando un total de _TOTAL_ registros",
            "sInfoEmpty":           "Mostrando un total de 0 registros",
            "sInfoFiltered":        "(filtrado de un total de _MAX_ registros)",
            "sInfoPostFix":         "",
            "sSearch":              "Buscar:",
            "sUrl":                 "",
            "sInfoThousands":       ",",
            "sLoadingRecords":      "Cargando...",
            "oPaginate": {
                "sFirst":           "Primero",
                "sLast":            "Último",
                "sNext":            "Siguiente",
                "sPrevious":        "Anterior"
            },
            "oAria": {
                "sSortAscending":   ": Activar para ordenar la columna de manera ascendente",
                "sSortDescending":  ": Activar para ordenar la columna de manera descendente"
            }
        }
    });
});

function guardaryeditar(e) {
    e.preventDefault();
    var formData = new FormData($('#producto_form')[0]);
    $.ajax({
        url: '../../controller/producto.php?op=guardaryeditar',
        type: 'POST',
        data: formData,
        contentType: false,
        processData: false,
        success: function(datos) {
            console.log(datos);
            $('#producto_form')[0].reset();
            $('#modalmantenimiento').modal('hide');
            $('#productos_data').DataTable().ajax.reload();
            swal.fire(
                'Registrado',
                'El registro se realizo correctamente',
                'success'
            )
        }
    });
}

function editar(prod_id) {
    $('#mdltitulo').html('Editar Registro');

    $.post('../../controller/producto.php?op=mostrar',{prod_id:prod_id},function(data) {
        data = JSON.parse(data);
        $('#prod_id').val(data.prod_id);
        $('#prod_nom').val(data.prod_nom);
        console.log(data);
    });


    $('#modalmantenimiento').modal('show');
}

function eliminar(prod_id) {
    swal.fire({
        title: "Estas seguro?",
        text: "¡No podrás revertir esto!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonText: "¡Sí, bórralo!",
        cancelButtonText: "¡No, cancela!",
        reverseButtons: true
    }).then((result) => {
        if (result.isConfirmed) {
            /* console.log(prod_id); */
            $.post("../../controller/producto.php?op=eliminar", {prod_id:prod_id}, function (data) {
                $('#productos_data').DataTable().ajax.reload();
            });

            swal.fire(
                'Eliminado!',
                'El registro se elimino correctamente.',
                'success'
            )
        } 
    })
}

$(document).on('click', '#btnnuevo', function() {
    $('#mdltitulo').html('Nuevo Registro');
    $('#producto_form')[0].reset();
    $('#prod_id').val('');
    $('#modalmantenimiento').modal('show');
});

init();

