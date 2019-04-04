console.log("Define transporte ");


model.transporteController = {

    transporte: {
        idTransporte: ko.observable(""),
        nombre: ko.observable(""),
        placa: ko.observable(""),
        modelo: ko.observable(""),
        idTipo_Transporte:ko.observable(""),
        estado:ko.observable(""),
        idEmpresa:ko.observable(""),
    },

    tipos: ko.observableArray([]),
    transportes: ko.observableArray([]),
    empresas: ko.observableArray([]),
    insertMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    mapTransporte: function (transporte) {
        var eTransporte = model.transporteController.transporte;
        eTransporte.idTransporte(transporte.idTransporte);
        eTransporte.nombre(transporte.nombre);
        eTransporte.placa(transporte.placa);
        eTransporte.modelo(transporte.modelo);
        eTransporte.idTipo_Transporte(transporte.idTipo_Transporte);
        eTransporte.idEmpresa(transporte.idEmpresa);
    },

    nuevo: function () {
        var transporte = {
            idTransporte: "",
            nombre: "",
            placa: "",
            modelo: "",
            idTipo_Transporte: "",
            idEmpresa: ""
        };

        model.transporteController.mapTransporte(transporte);

        model.transporteController.insertMode(true);
        model.transporteController.gridMode(false);
    },


    editar: function (transporte){
        model.transporteController.mapTransporte(transporte);

        model.transporteController.gridMode(false);
        model.transporteController.insertMode(true);
    },

    guardar: function () {
        var transporte = model.transporteController.transporte;
        var transporteParam = ko.toJS(transporte);

        //var formData = new FormData($("#tipoForm")[0]);

        if (!model.validateForm('#transporteForm')) {
            return;
        }
        //call api save
        Transporte.Guardar('guardaryeditar',transporte, function (data) {
            model.transporteController.initialize();
            //Ubicacion.ListarUbicaciones(function (data) {
            //    ubicaciones = data;
            //    selfUbicaciones.ubicaciones(ubicaciones);
            //});
                model.transporteController.insertMode(false);
                model.transporteController.gridMode(true);
        });
    },


    remover: function (transporte) {
        bootbox.confirm("¿Esta seguro que quiere remover este transporte " + transporte.nombre + "?", function (result) {
            if (result) {
                //call api remove
                Transporte.Remover('desactivar',transporte, function (data) {
                    model.transporteController.initialize();
                });
            }
        })
    },

    cancelar: function () {
        model.transporteController.insertMode(false);
        model.transporteController.gridMode(true);

        model.clearErrorMessage('#transporteForm');
    },

    initialize: function () {
        console.log("initialize Transporte Controller");
        var self = this;


        Transporte.Listar('listar', function (data){
            var transportes = JSON.parse(data);

            self.transportes(transportes);
        });

        TipoTransporte.Listar('listar', function (data){
            var tipos = JSON.parse(data);

            self.tipos(tipos);
        });

        Empresa.Listar('listar','T', function (data){
            var empresas = JSON.parse(data);

            self.empresas(empresas);
        });
    }
};