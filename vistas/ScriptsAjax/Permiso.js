console.log("define permiso ajax");

Permiso = {
    Listar: function (opcion,callback) {
        $.ajax("../ajax/permiso.php?op=" + opcion, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los cargos");
            }
        });
    }
}