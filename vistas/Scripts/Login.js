console.log("Define login Controller ");


model.LoginController = {

    login: {
        logina: ko.observable(""),
        clavea: ko.observable(""),
    },

    idEmpresa: ko.observable(""),
    idUsuario: ko.observable(""),
    nombre: ko.observable(""),
    isLogin: ko.observable(false),
    isUser: ko.observable(false),
    isConsignatario: ko.observable(false),
    isTransportista: ko.observable(false),

    verificar: function (){
        console.log("initialize login Controller");
        var self = this;
        var login = model.LoginController.login;

        var data = ko.toJS(login);

        Empresa.Verificar('verificar',data, function (data){
            var d = JSON.parse(data);
            if (d != null) {
                model.LoginController.idEmpresa(d.idEmpresa);
                model.LoginController.nombre(d.nombre);

                $(location).attr("href","Escritorio.php"); 
                toastr.info("Bienvenido");
                model.LoginController.isLogin(true);
            }
        });

        if(model.LoginController.isLogin() == false){
         Usuario.Verificar('verificar',data, function (data){
            var d = JSON.parse(data);
            if (d != null) {

                model.LoginController.idUsuario(d.idEmpresa);
                model.LoginController.nombre(d.username);
                model.LoginController.isUser(true);

                $(location).attr("href","Escritorio.php"); 
                toastr.info("Bienvenido");
            }else{
              toastr.error("Password y/o contraseña incorrecta");
            }

            model.LoginController.isLogin(false);
          });

        }
    },
};