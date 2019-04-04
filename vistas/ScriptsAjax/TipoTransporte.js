
TipoTransporte = {
    Listar: function (opcion,callback) {
        $.ajax("../ajax/tipoTransporte.php?op="+opcion, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los tipos de transporte");
            }
        });
    },

    Guardar: function (opcion, tipo, callback) {
        $.ajax("../ajax/tipoTransporte.php?op=" + opcion, {
            type: "POST",
            data: tipo,
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

    Remover: function (opcion, tipo, callback) {
        $.ajax("../ajax/tipoTransporte.php?op=" + opcion, {
            type: "POST",
            data: tipo,
            success: function (data) {
                if (data != null) {
                    toastr.info("Tipo Transporte removido correctamente");

                }
                else {
                    toastr.error("Error al eliminar");
                }
                if (typeof callback === 'function') {
                    callback(data);
                }
            },
            error: function (data) {
                toastr.error("Error al eliminar");
            }
        });
    },


}