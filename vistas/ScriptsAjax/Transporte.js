console.log("define transporte ajax");

Transporte = {
    Listar: function (opcion,callback) {
        $.ajax("../ajax/transporte.php?op="+opcion, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los Transporte");
            }
        });
    },

    ListarPorEmpresa: function (opcion,idEmpresa,callback) {
        $.ajax("../ajax/transporte.php?op="+opcion+"&idEmpresa="+idEmpresa, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los Transporte");
            }
        });
    },

    ListarP: function (opcion,idTransportista,callback) {
        $.ajax("../ajax/transporte.php?op=" + opcion+"&idTransportista="+idTransportista, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener planos de estiba");
            }
        });
    },

    Guardar: function (opcion, tipo, callback) {
        $.ajax("../ajax/transporte.php?op=" + opcion, {
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
        $.ajax("../ajax/transporte.php?op=" + opcion, {
            type: "POST",
            data: tipo,
            success: function (data) {
                if (data != null) {
                    toastr.info(data);

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