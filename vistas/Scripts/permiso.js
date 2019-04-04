console.log("permiso controller ");


model.permisoController = {
    permisos: ko.observableArray([]),

    initialize: function () {
        var self = this;
        var permisos = self.permisos();

        Permiso.Listar('listar', function (data){
            permisos = JSON.parse(data);
            self.permisos(permisos);
        });
    }
};