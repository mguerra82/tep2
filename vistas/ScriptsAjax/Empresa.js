console.log("define Empresa ajax");

Empresa = {
    Listar: function (opcion,tipo,callback) {
        $.ajax("../ajax/empresa.php?op=" + opcion + '&tipo='+tipo, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los empresa");
            }
        });
    },

    ListarTodo: function (opcion,callback) {
        $.ajax("../ajax/empresa.php?op=" + opcion, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los empresa");
            }
        });
    },

    Guardar: function (opcion, empresa, callback) {
        $.ajax("../ajax/empresa.php?op=" + opcion, {
            type: "POST",
            data: empresa,
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

    Remover: function (opcion, empresa, callback) {
        $.ajax("../ajax/empresa.php?op=" + opcion, {
            type: "POST",
            data: empresa,
            success: function (data) {
                if (data != null) {
                    toastr.info("Empresa desactivada correctamente");

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
    },

    Activar: function (opcion, empresa, callback) {
        $.ajax("../ajax/empresa.php?op=" + opcion, {
            type: "POST",
            data: empresa,
            success: function (data) {
                if (data != null) {
                    toastr.info("Empresa activada correctamente");

                }
                else {
                    toastr.error("Error al Activar");
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
        $.ajax("../ajax/empresa.php?op=" + opcion, {
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