console.log("define despacho ajax");

Despacho = {
    Listar: function (opcion,callback) {
        $.ajax("../ajax/despacho.php?op=" + opcion, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los despachos");
            }
        });
    },

    ObtenerAsignacion: function (opcion,codigo,callback) {
        $.ajax("../ajax/despacho.php?op=" + opcion+"&codigo="+codigo,{
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los despachos");
            }
        });
    },

    ContarDespachos: function (opcion,callback) {
        $.ajax("../ajax/despacho.php?op=" + opcion,{
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los despachos");
            }
        });
    },


    GetById: function (opcion,idDespacho,callback) {
        $.ajax("../ajax/despacho.php?op=" + opcion+"&idDespacho="+idDespacho,{
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los despachos");
            }
        });
    },

    Obtener: function (opcion,codigo,callback) {
        $.ajax("../ajax/despacho.php?op=" + opcion+"&codigo="+codigo,{
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener el despacho");
            }
        });
    },

    ListarTiemposMuertos: function (opcion,idDespacho,callback) {
        $.ajax("../ajax/despacho.php?op=" + opcion+"&idDespacho="+idDespacho,{
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los despachos");
            }
        });
    },

    ListarBodegas: function (opcion,idPlano,callback) {
        $.ajax("../ajax/despacho.php?op=" + opcion+"&idPlano_estiba="+idPlano,{
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los despachos");
            }
        });
    },

    Guardar: function (opcion, despacho, callback) {
         console.log("ajax despacho");
	 console.log(despacho);
	 $.ajax("../ajax/despacho.php?op=" + opcion, {
            type: "POST",
            data: despacho,
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

    Remover: function (opcion, despacho, callback) {
        $.ajax("../ajax/despacho.php?op=" + opcion, {
            type: "POST",
            data: despacho,
            success: function (data) {
                if (data != null) {

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
