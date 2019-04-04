console.log("Define tipo empresa ");


model.tipoBuqueController = {

    tipo: {
        idTipo_Buque: ko.observable(""),
        nombre: ko.observable(""),
        descripcion: ko.observable(""),
        estado: ko.observable(""),
    },

    tipos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    mapTipoBuque: function (tipo) {
        var eTipoBuque = model.tipoBuqueController.tipo;
        eTipoBuque.idTipo_Buque(tipo.idTipo_Buque);
        eTipoBuque.nombre(tipo.nombre);
        eTipoBuque.descripcion(tipo.descripcion);
    },

    nuevo: function () {
        var tipo = {
            idTipo_Buque: "",
            nombre: "",
            descripcion: "",
        };

        model.tipoBuqueController.mapTipoBuque(tipo);

        model.tipoBuqueController.insertMode(true);
        model.tipoBuqueController.editMode(false);
        model.tipoBuqueController.gridMode(false);
    },


    editar: function (tipo){
        model.tipoBuqueController.mapTipoBuque(tipo);

        model.tipoBuqueController.editMode(true);
        model.tipoBuqueController.gridMode(false);
        model.tipoBuqueController.insertMode(false);
    },

    guardar: function () {
        var tipo = model.tipoBuqueController.tipo;
        var tipoParams = ko.toJS(tipo);

        var formData = new FormData($("#tipoForm")[0]);

        if (!model.validateForm('#tipoForm')) {
            return;
        }
        //call api save
        TipoBuque.Guardar('guardaryeditar',tipoParams, function (data) {
            model.tipoBuqueController.initialize();
            //Ubicacion.ListarUbicaciones(function (data) {
            //    ubicaciones = data;
            //    selfUbicaciones.ubicaciones(ubicaciones);
            //});
                model.tipoBuqueController.insertMode(false);
                model.tipoBuqueController.editMode(false);
                model.tipoBuqueController.gridMode(true);
        });
    },


    remover: function (tipo) {
        bootbox.confirm("¿Esta seguro que quiere remover este tipo de Buque " + tipo.nombre + "?", function (result) {
            if (result) {
                //call api remove
                TipoBuque.Remover('desactivar',tipo, function (data) {
                    model.tipoBuqueController.initialize();
                });
            }
        })
    },

    cancelar: function () {
        model.tipoBuqueController.insertMode(false);
        model.tipoBuqueController.editMode(false);
        model.tipoBuqueController.gridMode(true);

        model.clearErrorMessage('#tipoForm');
    },

    initialize: function () {
        console.log("initialize Tipo Buque Controller");
        var self = this;
        var tipos = self.tipos();

        TipoBuque.Listar('listar',function (data){
            var tipos = JSON.parse(data);

            self.tipos(tipos);
        });
    }
};