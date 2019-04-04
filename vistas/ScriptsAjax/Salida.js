console.log("define Empresa ajax");

Salida = {
    Listar: function (opcion,callback) {
        $.ajax("../ajax/salida.php?op=" + opcion, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener las salidas");
            }
        });
    },

    Guardar: function (opcion, salida, callback) {
        $.ajax("../ajax/salida.php?op=" + opcion, {
            type: "POST",
            data: salida,
            success: function (data) {
                if (data != null) {
                    toastr.info(data);
                }
                else {
                    toastr.error("Error al guardar");
                }
                if (typeof callback === 'function') {
                    callback(data);
                }
            },
            error: function (data) {
                toastr.error("Error al guardar");
            }
        });
    },

    Remover: function (opcion, salida, callback) {
        $.ajax("../ajax/salida.php?op=" + opcion, {
            type: "POST",
            data: salida,
            success: function (data) {
                if (data != null) {

                }
                else {
                    toastr.error("Error al desactivar");
                }
                if (typeof callback === 'function') {
                    callback(data);
                }
            },
            error: function (data) {
                toastr.error("Error al desactivar");
            }
        });
    }

}