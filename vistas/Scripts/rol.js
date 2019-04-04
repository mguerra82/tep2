console.log("Define Rol ");


model.rolController = {

    rol: {
        idRol: ko.observable(""),
        nombre: ko.observable(""),
        estado: ko.observable(""),
        permiso: ko.observableArray([]),
    },


    roles: ko.observableArray([]),
    permisos: ko.observable([]),
    addPermisos: ko.observableArray([]),
    editMode: ko.observable(false),
    insertMode: ko.observable(false),
    gridMode: ko.observable(true),


    mapRol: function (rol) {
    	Rol.ListarPermisos('listarP',rol.idRol,function (data) {
        	var permisos = JSON.parse(data);
        	model.rolController.addPermisos([]);
        	for(var i=0; i<permisos.length; i++){
               model.rolController.addPermisos.push(permisos[i].idPermiso);
        	}
        });
        var eRol = model.rolController.rol;
        eRol.idRol(rol.idRol);
        eRol.nombre(rol.nombre)
        eRol.estado(rol.estado);
    },


    nuevo: function () {

        var rol = {
            idRol: "",
            nombre: ""
        };

        model.rolController.mapRol(rol);

        model.rolController.insertMode(true);
        model.rolController.gridMode(false);
    },

    editar: function (rol) {        
        model.rolController.mapRol(rol);

        model.rolController.insertMode(true);
        model.rolController.editMode(true);
        model.rolController.gridMode(false);
    },



    guardar: function () {
        var rol = model.rolController.rol;
        var perms = model.rolController.addPermisos();
	
        rol.permiso(perms);
        var rolParam = ko.toJS(rol);
	console.log(rolParam);
     

            if(!model.validateForm('#rolEdit')) {
                return;
             }
            //call api save
          Rol.Guardar('guardaryeditar',rolParam, function (data) {

            model.rolController.initialize();
            //Ubicacion.ListarUbicaciones(function (data) {
            //    ubicaciones = data;
            //    selfUbicaciones.ubicaciones(ubicaciones);
            //});
                model.rolController.insertMode(false);
                model.rolController.editMode(false);
                model.rolController.gridMode(true);

            });
    },


    remover: function (rol) {
        bootbox.confirm("¿Esta seguro que quiere desactivar el rol " + rol.nombre + "?", function (result) {
            if (result) {
                //call api remove
                Rol.Remover('desactivar',rol, function (data) {
                    model.rolController.initialize();  
                });

            }
        })
    },

    activar: function (rol) {
        bootbox.confirm("¿Esta seguro que quiere volver activar el rol " + rol.nombre + "?", function (result) {
            if (result) {
                //call api remove
                Rol.Remover('activar',rol, function (data) {
                    model.rolController.initialize();  
                });

            }
        })
    },

    cancelar: function () {
        model.rolController.insertMode(false);
        model.rolController.editMode(false);
        model.rolController.gridMode(true);

        model.clearErrorMessage('#rolEdit');
    },

    initialize: function () {
        console.log("initialize rol controller");
        var selfRoles = this;
        var roles = this.roles();

        Rol.Listar('listar',function (data) {
            var roles = JSON.parse(data);
            selfRoles.roles(roles);
        });

        Permiso.Listar('listar',function (data) {
        	var permisos = JSON.parse(data);
            model.rolController.permisos(permisos);
        });
    }
};
