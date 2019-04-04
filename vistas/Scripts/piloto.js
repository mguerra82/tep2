console.log("Define piloto controller ");


model.pilotoController = {

    piloto: {
        idPiloto: ko.observable(""),
        licencia: ko.observable(""),
        dpi: ko.observable(""),
        nombre: ko.observable(""),
        apellido: ko.observable(""),
        telefono: ko.observable(""),
        idEmpresa: ko.observable(""),
    },

    pilotos: ko.observableArray([]),
    empresas: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    mapPiloto: function (piloto) {
        var ePiloto = model.pilotoController.piloto;
        ePiloto.idPiloto(piloto.idPiloto);
        ePiloto.licencia(piloto.licencia);
        ePiloto.dpi(piloto.dpi);
        ePiloto.nombre(piloto.nombre);
        ePiloto.apellido(piloto.apellido);
        ePiloto.telefono(piloto.telefono);
        ePiloto.idEmpresa(piloto.idEmpresa);
    },

    nuevo: function () {
        var piloto = {
            idPiloto: "",
            licencia: "",
            dpi: "",
            nombre: "",
            apellido:"",
            telefono:"",
            idEmpresa:"",
        };

        model.pilotoController.mapPiloto(piloto);

        model.pilotoController.insertMode(true);
        model.pilotoController.gridMode(false);
    },


    editar: function (piloto){
        model.pilotoController.mapPiloto(piloto);

        model.pilotoController.gridMode(false);
        model.pilotoController.insertMode(true);
    },

    guardar: function () {
        var piloto = model.pilotoController.piloto;
        var pilotoParams = ko.toJS(piloto);

        //var formData = new FormData($("#tipoForm")[0]);

        if (!model.validateForm('#pilotoForm')) {
            return;
        }
        //call api save
        Piloto.Guardar('guardaryeditar',pilotoParams, function (data) {
           // var idEmpresa = model.pilotoController.piloto.idEmpresa();
            model.pilotoController.initialize();
                model.pilotoController.insertMode(false);
                model.pilotoController.gridMode(true);
        });
    },


    remover: function (piloto) {
        bootbox.confirm("¿Esta seguro que quiere remover piloto?", function (result) {
            if (result) {
                //call api remove
                Piloto.Remover('desactivar',piloto, function (data) {
                    model.pilotoController.initialize();
                });
            }
        })
    },

    cancelar: function () {
        model.pilotoController.insertMode(false);
        model.pilotoController.gridMode(true);

        model.clearErrorMessage('#pilotoForm');
    },

    initialize: function () {
        console.log("initialize piloto Controller");
        var self = this;
        var pilotos = self.pilotos();
        //model.pilotoController.piloto();

        Piloto.Listar('listar', function (data){
           //debugger;
            var pilotos = JSON.parse(data);
            self.pilotos(pilotos);
        });

        Empresa.ListarTodo('listarTodo', function (data){
           //debugger;
            var empresas = JSON.parse(data);
            self.empresas(empresas);
        });
    }
};