console.log("Salida controller ");


model.salidaController = {

    salida: {
        idSalida: ko.observable(""),
        idDespacho: ko.observable(""),
        bl: ko.observable(""),
        peso: ko.observable(""),
        estado: ko.observable(""),
    },

    infoDescarga: {
        codigo: ko.observable(""),
        idDescarga: ko.observable(""),
        tiempo: ko.observable(""),
        consignatario: ko.observable(""),
        producto: ko.observable(""),
    },

    salidas: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    isInsertSalida: ko.observable(false),
    codigo: ko.observable(""),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    mapSalida: function (salida) {
        var eSalida = model.salidaController.salida;
        eSalida.idSalida(salida.idSalida);
        eSalida.idDespacho(salida.idDespacho);
        eSalida.bl(salida.bl);
        eSalida.peso(salida.peso);
    },

    mapInfoDescarga: function(despacho){
        var eInfo = model.salidaController.infoDescarga;
        eInfo.consignatario(despacho.consignatario);
        eInfo.producto(despacho.producto);
        eInfo.codigo(despacho.codigo_despacho);

        var hora = (parseInt(despacho.hora) < 10? '0'+despacho.hora: despacho.hora);
        var minuto = (parseInt(despacho.minuto) < 10? '0'+despacho.minuto: despacho.minuto);
        var segundo = (parseInt(despacho.segundo) < 10? '0'+despacho.segundo: despacho.segundo);

        eInfo.tiempo(hora+':'+minuto+':'+segundo);
    },

    nuevo: function () {
        var salida = {
            idSalida: "",
            idDespacho: "",
            bl: "",
            peso: "",
        };

        model.salidaController.codigo('');
        model.salidaController.mapSalida(salida);

        model.salidaController.insertMode(true);
        model.salidaController.gridMode(false);
        model.salidaController.isInsertSalida(false);
    },


    editar: function (salida){
        model.salidaController.mapSalida(salida);

        model.salidaController.gridMode(false);
        model.salidaController.insertMode(false);
        model.salidaController.isInsertSalida(true);
        model.salidaController.codigo(salida.codigo);
        model.salidaController.obtener();
    },

    guardar: function () {
        var salida = model.salidaController.salida;
        var salidaParams = ko.toJS(salida);

        //var formData = new FormData($("#tipoForm")[0]);

        if (!model.validateForm('#salidaForm')) {
            return;
        }
        //call api save
        Salida.Guardar('guardaryeditar',salidaParams, function (data) {

            model.salidaController.initialize();
            //Ubicacion.ListarUbicaciones(function (data) {
            //    ubicaciones = data;
            //    selfUbicaciones.ubicaciones(ubicaciones);
            //});
                model.salidaController.insertMode(false);
                model.salidaController.gridMode(true);
                model.salidaController.isInsertSalida(false);
        });
    },


    remover: function (salida) {
        bootbox.confirm("¿Esta seguro que quiere eliminar registro?", function (result) {
            if (result) {
                //call api remove
                Salida.Remover('desactivar',salida, function (data) {
                    model.salidaController.initialize();
                });
            }
        })
    },

    cancelar: function () {
        model.salidaController.insertMode(false);
        model.salidaController.isInsertSalida(false);
        model.salidaController.gridMode(true);

        model.clearErrorMessage('#salidaForm');
    },

    obtener: function(){
      var codigo = model.salidaController.codigo();
      var idSalida = model.salidaController.salida.idSalida();

      if(idSalida === ""){
        var salidas = model.salidaController.salidas();
        for(var i=0; i<salidas.length; i++){
            if(codigo.toUpperCase() === salidas[i].codigo){
                toastr.error("Error! salida ya ha sido registrada");
                return;
            }
        }
      }
      
      Despacho.Obtener('obtener',codigo, function (data){
            despacho = JSON.parse(data);
            if(despacho === null){
                toastr.info("no se encontro ninguna descarga");
                return;
            }

            model.salidaController.salida.idDespacho(despacho.idDespacho);
            model.salidaController.mapInfoDescarga(despacho);

            model.salidaController.isInsertSalida(true);
        });

    },

    initialize: function () {
        var self = this;
        var salidas = self.salidas();

        Salida.Listar('listar', function (data){
            salidas = JSON.parse(data);
            self.salidas(salidas);
        });
    }
};