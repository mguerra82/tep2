Equipo = {
    Listar: function (opcion,callback) {
        $.ajax("../ajax/equipo.php?op="+opcion, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los Equipos");
            }
        });
    },

    ListarByTipo: function (opcion,tipo,callback) {
        $.ajax("../ajax/equipo.php?op="+opcion+"&tipo="+tipo, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los Equipos");
            }
        });
    },

    Guardar: function (opcion, tipo, callback) {
        $.ajax("../ajax/equipo.php?op=" + opcion, {
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
        $.ajax("../ajax/equipo.php?op=" + opcion, {
            type: "POST",
            data: tipo,
            success: function (data) {
                if (data != null) {
                    toastr.info("Equipo removido correctamente");

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