console.log("Define Buque ");


model.buqueController = {

    buque: {
        idBuque: ko.observable(""),
        nombre: ko.observable(""),
        idTipo_Buque:ko.observable(""),
        no_bodegas: ko.observable(""),
        estado:ko.observable(""),
    },

    tipos: ko.observableArray([]),
    buques: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    mapBuque: function (buque) {
        var eBuque = model.buqueController.buque;
        eBuque.idBuque(buque.idBuque);
        eBuque.nombre(buque.nombre);
        eBuque.idTipo_Buque(buque.idTipo_Buque);
        eBuque.no_bodegas(buque.no_bodegas);
    },

    nuevo: function () {
        var buque = {
            idBuque: "",
            nombre: "",
            idTipo_Buque: "",
            no_bodegas:"",
        };

        model.buqueController.mapBuque(buque);

        model.buqueController.insertMode(true);
        model.buqueController.gridMode(false);
    },


    editar: function (buque){
        model.buqueController.mapBuque(buque);

        model.buqueController.gridMode(false);
        model.buqueController.insertMode(true);
    },

    guardar: function () {
        var buque = model.buqueController.buque;
        var buqueParam = ko.toJS(buque);

        //var formData = new FormData($("#tipoForm")[0]);

        if (!model.validateForm('#buqueForm')) {
            return;
        }
        //call api save
        Buque.Guardar('guardaryeditar',buque, function (data) {
            model.buqueController.initialize();
            //Ubicacion.ListarUbicaciones(function (data) {
            //    ubicaciones = data;
            //    selfUbicaciones.ubicaciones(ubicaciones);
            //});
                model.buqueController.insertMode(false);
                model.buqueController.gridMode(true);
        });
    },


    remover: function (buque) {
        bootbox.confirm("¿Esta seguro que quiere remover este buque " + buque.nombre + "?", function (result) {
            if (result) {
                //call api remove
                Buque.Remover('desactivar',buque, function (data) {
                    model.buqueController.initialize();
                });
            }
        })
    },

    cancelar: function () {
        model.buqueController.insertMode(false);
        model.buqueController.gridMode(true);

        model.clearErrorMessage('#buqueForm');
    },

    initialize: function () {
        console.log("initialize Buque Controller");
        var self = this;
        var buques = self.buques();

        Buque.Listar('listar', function (data){
            console.log(data);
            buques = JSON.parse(data);
            console.log(buques);
            self.buques(buques);
        });

        TipoBuque.Listar('listar', function (data){
            var tipos = JSON.parse(data);

            self.tipos(tipos);
        });
    }
};