console.log("define Planificacion ajax");

Planificacion = {
    Listar: function (opcion,callback) {
        $.ajax("../ajax/planoEstiba.php?op=" + opcion, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
console.log("LISTADO");
                    console.log(data);
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener planos de estiba");
            }
        });
    },

    ListarCorrelativo: function (opcion,callback) {
        $.ajax("../ajax/planoEstiba.php?op=" + opcion, {
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

    contarAsignaciones: function (opcion,callback) {
        $.ajax("../ajax/asignacionPlano.php?op=" + opcion, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error las asignaciones de estiba");
            }
        });
    },

    ListarDetalles: function (opcion,idPlano_estiba, bodega, callback) {
        $.ajax("../ajax/planoEstiba.php?op="+opcion+'&idPlano_estiba='+idPlano_estiba+"&bodega="+bodega,{
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener las bodegas");
            }
        });
    },

    ListarBodegas: function (opcion,idPlano,callback) {
        $.ajax("../ajax/planoEstiba.php?op=" + opcion + '&idPlano_estiba='+idPlano, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener las bodegas");
            }
        });
    },

    ListarDetalleBodegas: function (opcion,idPlano,callback) {
        $.ajax("../ajax/planoEstiba.php?op=" + opcion + '&idPlano_estiba='+idPlano, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener las bodegas");
            }
        });
    },


    ListarNoAsignados: function (opcion,idPlano,callback) {
        $.ajax("../ajax/planoEstiba.php?op=" + opcion + '&idPlano_estiba='+idPlano, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al no asignados");
            }
        });
    },

    ListarAsignaciones: function (opcion,idPlano_estiba, bodega, seccion_bodega, callback) {
        $.ajax("../ajax/planoEstiba.php?op="+opcion+'&idPlano_estiba='+idPlano_estiba+"&bodega="+bodega+"&seccion_bodega="+seccion_bodega,{
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener las bodegas");
            }
        });
    },

    Guardar: function (opcion, plano, callback) {
        $.ajax("../ajax/planoEstiba.php?op=" + opcion, {
            type: "POST",
            data: plano,
            success: function (data) {
                if (data != null) {
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

    UpdateTotal: function (opcion, plano, callback) {
        $.ajax("../ajax/planoEstiba.php?op=" + opcion, {
            type: "POST",
            data: plano,
            success: function (data) {
            },
            error: function (data) {
                toastr.error("Error al guardar");
            }
        });
    },

    GuardarDetalle: function (opcion, plano, callback) {
        $.ajax("../ajax/planoEstiba.php?op=" + opcion, {
            type: "POST",
            data: plano,
            success: function (data) {
                if (data != null) {
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

    editarBodega: function (opcion, bodega, callback) {
        $.ajax("../ajax/planoEstiba.php?op=" + opcion, {
            type: "POST",
            data: bodega,
            success: function (data) {
                if (data != null) {
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

    ListarEquipos: function (opcion,idPlano,callback) {
        $.ajax("../ajax/asignacionEquipo.php?op=" + opcion + '&idPlano='+idPlano, {
            type: "GET",
            success: function (data) {
                if (typeof callback === 'function') {
                    callback(data);
                }

            }, error: function (data) {
                toastr.error("Error al obtener los equipos");
            }
        });
    },

    GuardarAsignacion: function (opcion, asignacion, callback) {
console.log("asignacion transportista");
console.log(asignacion);
        $.ajax("../ajax/asignacionPlano.php?op=" + opcion, {
            type: "POST",
            data: asignacion,
            success: function (data) {
console.log("asingnacion 2");
console.log(data);             
   if (data != null) {
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

    GuardarEquipo: function (opcion, equipo, callback) {
        $.ajax("../ajax/asignacionEquipo.php?op=" + opcion, {
            type: "POST",
            data: equipo,
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

    Remover: function (opcion, plano, callback) {
        $.ajax("../ajax/planoEstiba.php?op=" + opcion, {
            type: "POST",
            data: plano,
            success: function (data) {
                if (data != null) {

                }
                else {
                    toastr.error(data);
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

    EliminarBodega: function (opcion, bodega, callback) {
        $.ajax("../ajax/planoEstiba.php?op=" + opcion, {
            type: "POST",
            data: bodega,
            success: function (data) {
                if (data != null) {

                }
                else {
                    toastr.error(data);
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

     EliminarAsignacion: function (opcion, asignacion, callback) {
        $.ajax("../ajax/asignacionPlano.php?op=" + opcion, {
            type: "POST",
            data: asignacion,
            success: function (data) {
                if (data != null) {
                }
                else {
                    toastr.error(data);
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
