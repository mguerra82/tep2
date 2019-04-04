console.log("define Usuario ajax");

Usuario = {
    Listar: function (opcion,callback) {
        $.ajax("../ajax/usuario.php?op=" + opcion, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los usuarios");
            }
        });
    },

    Guardar: function (opcion, usuario, callback) {
        $.ajax("../ajax/usuario.php?op=" + opcion, {
            type: "POST",
            data: usuario,
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

    Remover: function (opcion, usuario, callback) {
        $.ajax("../ajax/usuario.php?op=" + opcion, {
            type: "POST",
            data: usuario,
            success: function (data) {
                if (data != null) {
                    toastr.info(data);

                }
                else {
                    toastr.error(data);
                }
                if (typeof callback === 'function') {
                    callback(data);
                }
            },
            error: function (data) {
                toastr.error("Error al desactivar");
            }
        });
    },

    Activar: function (opcion, usuario, callback) {
        $.ajax("../ajax/usuario.php?op=" + opcion, {
            type: "POST",
            data: usuario,
            success: function (data) {
                if (data != null) {
                    toastr.info(data);

                }
                else {
                    toastr.error(data);
                }
                if (typeof callback === 'function') {
                    callback(data);
                }
            },
            error: function (data) {
                toastr.error("Error al Activar");
            }
        });
    },

    Verificar: function (opcion, data, callback) {
        $.ajax("../ajax/usuario.php?op=" + opcion, {
            type: "POST",
            data: data,
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }
            },
            error: function (data) {
                toastr.error("Password y/o contraseña incorrecta");
            }
        });
    }
}