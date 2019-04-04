console.log("define Pilotos ajax");

Piloto = {
    Listar: function (opcion,callback) {
        $.ajax("../ajax/piloto.php?op=" + opcion,{
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los Pilotos");
            }
        });
    },

    ListarP: function (opcion,idTransportista,callback) {
        $.ajax("../ajax/piloto.php?op=" + opcion+"&idTransportista="+idTransportista, {
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
        $.ajax("../ajax/piloto.php?op=" + opcion, {
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
        $.ajax("../ajax/piloto.php?op=" + opcion, {
            type: "POST",
            data: tipo,
            success: function (data) {
                if (data != null) {
                    toastr.info("Piloto removido correctamente");

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