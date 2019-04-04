console.log("Define tipo empresa ");


model.productoController = {

    tipo: {
        idProducto: ko.observable(""),
        nombre: ko.observable(""),
        descripcion: ko.observable(""),
        estado: ko.observable(""),
    },

    tipos: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    mapProducto: function (tipo) {
        var eProducto = model.productoController.tipo;
        eProducto.idProducto(tipo.idProducto);
        eProducto.nombre(tipo.nombre);
        eProducto.descripcion(tipo.descripcion);
    },

    nuevo: function () {
        var tipo = {
            idProducto: "",
            nombre: "",
            descripcion: "",
        };

        model.productoController.mapProducto(tipo);

        model.productoController.insertMode(true);
        model.productoController.editMode(false);
        model.productoController.gridMode(false);
    },


    editar: function (tipo){
        model.productoController.mapProducto(tipo);

        model.productoController.editMode(true);
        model.productoController.gridMode(false);
        model.productoController.insertMode(false);
    },

    guardar: function () {
        var tipo = model.productoController.tipo;
        var tipoParams = ko.toJS(tipo);

        //var formData = new FormData($("#tipoForm")[0]);

        if (!model.validateForm('#tipoForm')) {
            return;
        }
        //call api save
        Producto.Guardar('guardaryeditar',tipoParams, function (data) {

            model.productoController.initialize();
            //Ubicacion.ListarUbicaciones(function (data) {
            //    ubicaciones = data;
            //    selfUbicaciones.ubicaciones(ubicaciones);
            //});
                model.productoController.insertMode(false);
                model.productoController.editMode(false);
                model.productoController.gridMode(true);
        });
    },


    remover: function (tipo) {
        bootbox.confirm("¿Esta seguro que quiere remover " + tipo.nombre + "?", function (result) {
            if (result) {
                //call api remove
                Producto.Remover('desactivar',tipo, function (data) {
                    model.productoController.initialize();
                });
            }
        })
    },

    cancelar: function () {
        model.productoController.insertMode(false);
        model.productoController.editMode(false);
        model.productoController.gridMode(true);

        model.clearErrorMessage('#tipoForm');
    },

    initialize: function () {
        console.log("initialize Producto Controller");
        var self = this;
        var tipos = self.tipos();

        Producto.Listar('listar', function (data){
            var tipos = JSON.parse(data);

            self.tipos(tipos);
        });
    }
};