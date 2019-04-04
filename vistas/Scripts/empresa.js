console.log("Define Empresa ");


model.empresaController = {

    empresa: {
        idEmpresa: ko.observable(""),
        nombre: ko.observable(""),
        nit: ko.observable(""),
        razon_social: ko.observable(""),
        direccion: ko.observable(""),
        contacto: ko.observable(""),
        telefono: ko.observable(""),
        email: ko.observable(""),
        estado: ko.observable(""),
        tipoEmpresa: ko.observable(""),
        password: ko.observable("")
    },

    login:{
        logina: ko.observable(""),
        clavea: ko.observable(""),
    },

    empresas: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    mapEmpresa: function (empresa) {
        var eEmpresa = model.empresaController.empresa;
        eEmpresa.idEmpresa(empresa.idEmpresa);
        eEmpresa.nombre(empresa.nombre);
        eEmpresa.nit(empresa.nit);
        eEmpresa.razon_social(empresa.razon_social);
        eEmpresa.direccion(empresa.direccion);
        eEmpresa.contacto(empresa.contacto);
        eEmpresa.telefono(empresa.telefono);
        eEmpresa.email(empresa.email);
        eEmpresa.estado(empresa.estado);
        eEmpresa.tipoEmpresa(empresa.tipoEmpresa);
        eEmpresa.password(empresa.password);
    },

    nuevoT: function () {
        var empresa = {
            idEmpresa: "",
            nit: "",
            razon_social: "",
            direccion: "",
            contacto: "",
            telefono: "",
            email: "",
            estado: "",
            tipoEmpresa: "T",
            password: "",
        };

        model.empresaController.mapEmpresa(empresa);

        model.empresaController.insertMode(true);
        model.empresaController.editMode(false);
        model.empresaController.gridMode(false);
    },

    nuevoC: function () {
        var empresa = {
            idEmpresa: "",
            nit: "",
            razon_social: "",
            direccion: "",
            contacto: "",
            telefono: "",
            email: "",
            estado: "",
            tipoEmpresa: "C",
            password: "",
        };

        model.empresaController.mapEmpresa(empresa);

        model.empresaController.insertMode(true);
        model.empresaController.editMode(false);
        model.empresaController.gridMode(false);
    },


    editar: function (empresa){
        model.empresaController.mapEmpresa(empresa);

        model.empresaController.editMode(true);
        model.empresaController.gridMode(false);
        model.empresaController.insertMode(false);
    },

    verificar: function (){
        console.log("initialize login Controller");
        var self = this;

        var login = model.empresaController.login;

        var data = ko.toJS(login);

        Empresa.Verificar('verificar',data, function (data){
           debugger;
           console.log(data);
        });
    },

    guardar: function () {
        var empresa = model.empresaController.empresa;
        var empresaParams = ko.toJS(empresa);

        var empresas = model.empresaController.empresas();

        //var formData = new FormData($("#tipoForm")[0]);

        if (!model.validateForm('#empresaForm')) {
            return;
        }

        //validamos correo electronico
        tam = empresas.length;
        if(empresa.idEmpresa() == 0){
            for (i = 0; i < tam; i++) {
               if(empresas[i].email == empresa.email()){
                toastr.error("Correo electronico ya existe");
                return;
               }
            }
        }
        //call api save
        Empresa.Guardar('guardaryeditar',empresaParams, function (data) {
            var tipo = model.empresaController.empresa.tipoEmpresa();
            model.empresaController.initialize(tipo);
            //Ubicacion.ListarUbicaciones(function (data) {
            //    ubicaciones = data;
            //    selfUbicaciones.ubicaciones(ubicaciones);
            //});
                model.empresaController.insertMode(false);
                model.empresaController.editMode(false);
                model.empresaController.gridMode(true);
        });
    },


    remover: function (empresa) {
        bootbox.confirm("¿Esta seguro que quiere remover empersa " + empresa.nombre + "?", function (result) {
            if (result) {
                //call api remove
                Empresa.Remover('desactivar',empresa, function (data) {
                    model.empresaController.initialize(empresa.tipoEmpresa);
                });
            }
        })
    },

    activar: function (empresa) {
        bootbox.confirm("¿Esta seguro que quiere activar empresa " + empresa.nombre + "?", function (result) {
            if (result) {
                //call api remove
                Empresa.Remover('activar',empresa, function (data) {
                    model.empresaController.initialize(empresa.tipoEmpresa);
                });
            }
        })
    },

    cancelar: function () {
        model.empresaController.insertMode(false);
        model.empresaController.editMode(false);
        model.empresaController.gridMode(true);

        model.clearErrorMessage('#empresaForm');
    },

    initialize: function (tipo) {
        console.log("initialize Empresa Controller");
        var self = this;
        var empresas = self.empresas();

        Empresa.Listar('listar',tipo, function (data){
            var empresas = JSON.parse(data);
            self.empresas(empresas);
        });
    }
};