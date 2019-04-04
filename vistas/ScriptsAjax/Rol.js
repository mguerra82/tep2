console.log("define rol ajax");

Rol = {
    Listar: function (opcion,callback) {
        $.ajax("../ajax/rol.php?op=" + opcion, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los roles");
            }
        });
    },

    ListarPermisos: function (opcion,idRol,callback) {
        $.ajax("../ajax/rol.php?op=" + opcion + '&idRol='+idRol, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los permisos");
            }
        });
    },

    Guardar: function (opcion, rol, callback) {
        console.log("Llamada ajax"); 
	 console.log(rol);
	  $.ajax("../ajax/rol.php?op=" + opcion, {
            type: "POST",
            data: rol,
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

    Remover: function (opcion, rol, callback) {
        $.ajax("../ajax/rol.php?op=" + opcion, {
            type: "POST",
            data: rol,
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
