console.log("Cargo controller ");


model.CargoController = {

    cargo: {
        idCargo: ko.observable(""),
        nombre: ko.observable(""),
        descripcion: ko.observable(""),
        estado: ko.observable(""),
    },

    cargos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    mapCargo: function (cargo) {
        var eCargo = model.CargoController.cargo;
        eCargo.idCargo(cargo.idCargo);
        eCargo.nombre(cargo.nombre);
        eCargo.descripcion(cargo.descripcion);
    },

    nuevo: function () {
        var cargo = {
            idProducto: "",
            nombre: "",
            descripcion: "",
        };

        model.CargoController.mapCargo(cargo);

        model.CargoController.insertMode(true);
        model.CargoController.editMode(false);
        model.CargoController.gridMode(false);
    },


    editar: function (cargo){
        model.CargoController.mapCargo(cargo);

        model.CargoController.editMode(true);
        model.CargoController.gridMode(false);
        model.CargoController.insertMode(false);
    },

    guardar: function () {
        var cargo = model.CargoController.cargo;
        var cargoParams = ko.toJS(cargo);

        //var formData = new FormData($("#tipoForm")[0]);

        if (!model.validateForm('#cargoForm')) {
            return;
        }
        //call api save
        Cargo.Guardar('guardaryeditar',cargoParams, function (data) {

            model.CargoController.initialize();
            //Ubicacion.ListarUbicaciones(function (data) {
            //    ubicaciones = data;
            //    selfUbicaciones.ubicaciones(ubicaciones);
            //});
                model.CargoController.insertMode(false);
                model.CargoController.editMode(false);
                model.CargoController.gridMode(true);
        });
    },


    remover: function (cargo) {
        bootbox.confirm("¿Esta seguro que quiere remover " + cargo.nombre + "?", function (result) {
            if (result) {
                //call api remove
                Cargo.Remover('desactivar',cargo, function (data) {
                    model.CargoController.initialize();
                });
            }
        })
    },

    cancelar: function () {
        model.CargoController.insertMode(false);
        model.CargoController.editMode(false);
        model.CargoController.gridMode(true);

        model.clearErrorMessage('#cargoForm');
    },

    initialize: function () {
        var self = this;
        var cargos = self.cargos();

        Cargo.Listar('listar', function (data){
            cargos = JSON.parse(data);
            self.cargos(cargos);
        });
    }
};