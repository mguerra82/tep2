console.log("Define Empleado Controler ");


model.empleadoController = {

    empleado: {
        idEmpleado: ko.observable(""),
        nit: ko.observable(""),
        dpi: ko.observable(""),
        primer_nombre: ko.observable(""),
        segundo_nombre: ko.observable(""),
        primer_apellido: ko.observable(""),
        segundo_apellido: ko.observable(""),
        direccion: ko.observable(""),
        telefono: ko.observable(""),
        idCargo: ko.observable(""),
        foto: ko.observable(""),
    },

    foto:{},

    empleados: ko.observableArray([]),
    cargos: ko.observableArray([]),
    titulo: ko.observable(""),
    foto: ko.observable(""),
    insertMode: ko.observable(false),
    editMode: ko.observable(false),
    gridMode: ko.observable(true),
    //tipoOpcion: [{ nombre: 'Producto', valor: 'P' }, { nombre: 'Materia Prima', valor: 'M' }, { nombre: 'Vehiculo', valor: 'V' }],


    mapEmpleado: function (empleado) {
        var eEmpleado = model.empleadoController.empleado;
        eEmpleado.idEmpleado(empleado.idEmpleado);
        eEmpleado.nit(empleado.nit);
        eEmpleado.dpi(empleado.dpi);
        eEmpleado.primer_nombre(empleado.primer_nombre);
        eEmpleado.segundo_nombre(empleado.segundo_nombre);
        eEmpleado.primer_apellido(empleado.primer_apellido);
        eEmpleado.segundo_apellido(empleado.segundo_apellido);
        eEmpleado.direccion(empleado.direccion);
        eEmpleado.telefono(empleado.telefono);
        eEmpleado.idCargo(empleado.idCargo);
        eEmpleado.foto(empleado.foto);
    },

    nuevo: function () {
        model.empleadoController.titulo("Nuevo Registro");
        var empleado = {
            idEmpleado: "",
            nit: "",
            dpi: "",
            primer_nombre: "",
            segundo_nombre: "",
            primer_apellido: "",
            segundo_apellido: "",
            direccion: "",
            telefono: "",
            idCargo: "",
            foto: "",
        };

        model.empleadoController.mapEmpleado(empleado);

        model.empleadoController.insertMode(true);
        model.empleadoController.editMode(false);
        model.empleadoController.gridMode(false);
    },


    editar: function (empleado){
        
        model.empleadoController.titulo(empleado.primer_nombre+" "+empleado.primer_apellido);
        model.empleadoController.mapEmpleado(empleado);

        model.empleadoController.editMode(true);
        model.empleadoController.gridMode(false);
        model.empleadoController.insertMode(false);
    },

   getFile: function(file) {
     let reader = new FileReader();
     reader.readAsDataURL(file);

     return new Promise((resolve, reject) => {
       try {
         reader.onload = () => {
           resolve({
             content: reader.result.split(',')[1],
             name: file.name,
             length: file.size,
             contentType: file.type
          })
        }
      } catch (error) {
        reject(error)
      }
    })
  },

    guardar: function () {
        var empleado = model.empleadoController.empleado;
       
     /* var files = $('#foto')[0].files[0];
        var foto;


      if (files != null || files.length > 0) {
        model.empleadoController.getFile(files)
          .then(file => {
             model.empleadoController.foto(file);
             console.log(foto);
          })
          .catch(r1 => {
            console.log(r1);
          });
      }*/
           
        var empleadoParams = ko.toJS(empleado);

        var formData = new FormData($("#empleadoForm")[0]);

        if (!model.validateForm('#empleadoForm')) {
            return;
        }
        //call api save
        Empleado.Guardar('guardaryeditar',empleadoParams,function (data) {
            model.empleadoController.initialize();
            //Ubicacion.ListarUbicaciones(function (data) {
            //    ubicaciones = data;
            //    selfUbicaciones.ubicaciones(ubicaciones);
            //});
                model.empleadoController.insertMode(false);
                model.empleadoController.editMode(false);
                model.empleadoController.gridMode(true);
        });
    },


    remover: function (empleado) {
        bootbox.confirm("¿Esta seguro que quiere remover empleado " + empleado.primer_nombre + "?", function (result) {
            if (result) {
                //call api remove
                Empleado.Remover('desactivar',empleado, function (data) {
                    model.empleadoController.initialize();
                });
            }
        })
    },

    cancelar: function () {
        model.empleadoController.insertMode(false);
        model.empleadoController.editMode(false);
        model.empleadoController.gridMode(true);

        model.clearErrorMessage('#empleadoForm');
    },

    initialize: function () {
        console.log("initialize Empleado Controller");
        var self = this;
        var empleados = self.empleados();

        Empleado.Listar('listar', function (data){
            empleados = JSON.parse(data);
            self.empleados(empleados);
        });

        //listamos los cargos
         Cargo.Listar('listar', function (data){
            var cargos = JSON.parse(data);
            self.cargos(cargos);
        });
    }
};