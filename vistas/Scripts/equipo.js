console.log("Define equipo ");


model.equipoController = {

    tipo: {
        idEquipo: ko.observable(""),
        dimensiones: ko.observable(""),
        descripcion: ko.observable(""),
        estado: ko.observable(""),
        fecha_ultimo_mantenimiento: ko.observable(""),
        tipoEquipo: ko.observable(""),
    },

    tipos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    mapEquipo: function (tipo) {
        var eEquipo = model.equipoController.tipo;
        eEquipo.idEquipo(tipo.idEquipo);
        eEquipo.dimensiones(tipo.dimensiones);
        eEquipo.descripcion(tipo.descripcion);
        eEquipo.tipoEquipo(tipo.tipoEquipo);
        eEquipo.fecha_ultimo_mantenimiento(tipo.fecha_ultimo_mantenimiento);
    },

    nuevo: function () {
        var tipo = {
            idEquipo: "",
            dimensiones: "",
            descripcion: "",
            tipoEquipo: "",
            fecha_ultimo_mantenimiento: "",
        };

        model.equipoController.mapEquipo(tipo);

        model.equipoController.insertMode(true);
        model.equipoController.editMode(false);
        model.equipoController.gridMode(false);
    },


    editar: function (tipo){
        model.equipoController.mapEquipo(tipo);

        model.equipoController.editMode(true);
        model.equipoController.gridMode(false);
        model.equipoController.insertMode(false);
    },

    guardar: function () {
        var tipo = model.equipoController.tipo;
        var tipoParams = ko.toJS(tipo);

        var formData = new FormData($("#tipoForm")[0]);

        if (!model.validateForm('#tipoForm')) {
            return;
        }
        //call api save
        Equipo.Guardar('guardaryeditar',tipoParams, function (data) {
            model.equipoController.initialize();
            //Ubicacion.ListarUbicaciones(function (data) {
            //    ubicaciones = data;
            //    selfUbicaciones.ubicaciones(ubicaciones);
            //});
                model.equipoController.insertMode(false);
                model.equipoController.editMode(false);
                model.equipoController.gridMode(true);
        });
    },


    remover: function (tipo) {
        bootbox.confirm("¿Esta seguro que quiere remover " + tipo.descripcion + "?", function (result) {
            if (result) {
                //call api remove
                Equipo.Remover('desactivar',tipo, function (data) {
                    model.equipoController.initialize();
                });
            }
        })
    },

    cancelar: function () {
        model.equipoController.insertMode(false);
        model.equipoController.editMode(false);
        model.equipoController.gridMode(true);

        model.clearErrorMessage('#tipoForm');
    },

    initialize: function () {
        console.log("initialize Equipo Controller");
        var self = this;
        var tipos = self.tipos();

        Equipo.Listar('listar',function (data){
            var tipos = JSON.parse(data);

            self.tipos(tipos);
        });
    }
};