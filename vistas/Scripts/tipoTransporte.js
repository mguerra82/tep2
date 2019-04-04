console.log("Define tipo empresa ");


model.tipoTransporteController = {

    tipo: {
        idTipo_Transporte: ko.observable(""),
        nombre: ko.observable(""),
        descripcion: ko.observable(""),
        estado: ko.observable(""),
    },

    tipos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    mapTipoTransporte: function (tipo) {
        var eTipoTransporte = model.tipoTransporteController.tipo;
        eTipoTransporte.idTipo_Transporte(tipo.idTipo_Transporte);
        eTipoTransporte.nombre(tipo.nombre);
        eTipoTransporte.descripcion(tipo.descripcion);
    },

    nuevo: function () {
        var tipo = {
            idTipo_Transporte: "",
            nombre: "",
            descripcion: "",
        };

        model.tipoTransporteController.mapTipoTransporte(tipo);

        model.tipoTransporteController.insertMode(true);
        model.tipoTransporteController.editMode(false);
        model.tipoTransporteController.gridMode(false);
    },


    editar: function (tipo){
        model.tipoTransporteController.mapTipoTransporte(tipo);

        model.tipoTransporteController.editMode(true);
        model.tipoTransporteController.gridMode(false);
        model.tipoTransporteController.insertMode(false);
    },

    guardar: function () {
        var tipo = model.tipoTransporteController.tipo;
        var tipoParams = ko.toJS(tipo);

        var formData = new FormData($("#tipoForm")[0]);

        if (!model.validateForm('#tipoForm')) {
            return;
        }
        //call api save
        TipoTransporte.Guardar('guardaryeditar',tipoParams, function (data) {
            model.tipoTransporteController.initialize();
            //Ubicacion.ListarUbicaciones(function (data) {
            //    ubicaciones = data;
            //    selfUbicaciones.ubicaciones(ubicaciones);
            //});
                model.tipoTransporteController.insertMode(false);
                model.tipoTransporteController.editMode(false);
                model.tipoTransporteController.gridMode(true);
        });
    },


    remover: function (tipo) {
        bootbox.confirm("¿Esta seguro que quiere remover este tipo empresa " + tipo.nombre + "?", function (result) {
            if (result) {
                //call api remove
                TipoTransporte.Remover('desactivar',tipo, function (data) {
                    model.tipoTransporteController.initialize();
                });
            }
        })
    },

    cancelar: function () {
        model.tipoTransporteController.insertMode(false);
        model.tipoTransporteController.editMode(false);
        model.tipoTransporteController.gridMode(true);

        model.clearErrorMessage('#tipoForm');
    },

    initialize: function () {
        console.log("initialize Tipo Transporte Controller");
        var self = this;
        var tipos = self.tipos();

        TipoTransporte.Listar('listar',function (data){
            var tipos = JSON.parse(data);

            self.tipos(tipos);
        });
    }
};