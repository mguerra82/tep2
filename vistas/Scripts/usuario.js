console.log("Define Usuario ");


model.usuarioController = {

    usuario: {
        idUsuario: ko.observable(""),
        username: ko.observable(""),
        email: ko.observable(""),
        estado: ko.observable(""),
        password: ko.observable(""),
        idRol: ko.observable(""),
        idEmpleado: ko.observable("")
    },


    usuarios: ko.observableArray([]),
    empresas: ko.observableArray([]),
    empleados: ko.observableArray([]),
    roles: ko.observableArray([]),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    mapUsuario: function (usuario) {
        var eUsuario = model.usuarioController.usuario;
        eUsuario.idUsuario(usuario.idUsuario);
        eUsuario.username(usuario.username);
        eUsuario.email(usuario.email);
        eUsuario.password(usuario.password);
        eUsuario.idRol(usuario.idRol);
        eUsuario.idEmpleado(usuario.idEmpleado);
    },

    nuevo: function () {
        var usuario = {
            idUsuario: "",
            username: "",
            email: "",
            password: "",
            idRol: "",
            idEmpleado: ""
        };

        model.usuarioController.mapUsuario(usuario);

        model.usuarioController.insertMode(true);
        model.usuarioController.gridMode(false);
    },


    editar: function (usuario){

        model.usuarioController.mapUsuario(usuario);

        model.usuarioController.gridMode(false);
        model.usuarioController.insertMode(true);
    },

    guardar: function () {
        var usuario = model.usuarioController.usuario;
        var usuarioParam = ko.toJS(usuario);

        var empresas = model.usuarioController.empresas();
        var usuarios = model.usuarioController.usuarios();


        if (!model.validateForm('#usuarioForm')) {
            return;
        }

        //validamos correo electronico empresas
        tam = empresas.length;
        if(usuario.idUsuario() == 0){
            for (i = 0; i < tam; i++) {
               if(empresas[i].email == usuario.email()){
                toastr.error("Correo electronico ya existe");
                return;
               }
            }
        }

        //validamos correo electronico usuarios
        tamU = usuarios.length;
        if(usuario.idUsuario() == 0){
            for (i = 0; i < tamU; i++) {
               if(usuarios[i].email == usuario.email() || usuarios[i].username == usuario.username()){
                toastr.error("Correo electronico y/o nombre de usuario ya existe");
                return;
               }
            }
        }

        //call api save
        Usuario.Guardar('guardaryeditar',usuarioParam, function (data) {

            model.usuarioController.initialize();
                model.usuarioController.insertMode(false);
                model.usuarioController.gridMode(true);
        });
    },


    remover: function (usuario) {
        bootbox.confirm("¿Esta seguro que quiere remover usuario " + usuario.username + "?", function (result) {
            if (result) {
                //call api remove
                Usuario.Remover('desactivar',usuario, function (data) {
                    model.usuarioController.initialize();
                });
            }
        })
    },

    cancelar: function () {
        model.usuarioController.insertMode(false);
        model.usuarioController.gridMode(true);

        model.clearErrorMessage('#usuarioForm');
    },

    initialize: function () {
        console.log("initialize Usuario Controller");
        var self = this;

        Usuario.Listar('listar', function (data){
            var usuarios = JSON.parse(data);
            self.usuarios(usuarios);
        });

        Empresa.ListarTodo('listarTodo', function (data){
            var empresas = JSON.parse(data);
            self.empresas(empresas);
        });

        Empleado.Listar('listar', function (data){
            var empleados = JSON.parse(data);
            self.empleados(empleados);
        });

        Rol.Listar('listar', function (data){
            var roles = JSON.parse(data);
            self.roles(roles);
        });
    }
};