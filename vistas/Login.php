<?php 
  //Activamos el almacenamiento en el buffer
    ob_start();
    session_start();

    if (isset($_SESSION["nombre"]))
    {
      header("Location: Escritorio.php");
    }
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <!-- Bootstrap Core CSS -->
    <link href="../public/bootstrap/css/bootstrap.min.css" rel="stylesheet">

    <!-- MetisMenu CSS -->
    <link href="../public/metisMenu/metisMenu.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link href="../public/dist/css/sb-admin-2.css" rel="stylesheet">
     <link href="../public/Assets/css/toastr.min.css" rel="stylesheet">
     <link href="../public/Assets/css/style.css" rel="stylesheet">

    <!-- Custom Fonts -->
    <link href="../public/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">

    <script src="../public/jquery/jquery.min.js"></script>
    <script src="../public/bootstrap/js/bootstrap.min.js"></script>
    <script src="../public/metisMenu/metisMenu.min.js"></script>
    <script src="../public/dist/js/sb-admin-2.js"></script>
    <script src="../public/Assets/js/jquery.validate.js"></script>
    <script src="../public/Assets/js/knockout-3.4.2.js"></script>
    <script src="../public/Assets/js/knockout.mapping.js"></script>  
    <script src="../public/Assets/js/bootbox.min.js"></script> 
    <script src="../public/Assets/js/toastr.min.js"></script> 

         <!-- Scripts de vistas -->
    <script src="Scripts/model.js"></script> 
    <script src="Scripts/empresa.js"></script>
    <script src="Scripts/Login.js"></script>

     <!-- Scripts  ajax --> 
    <script src="ScriptsAjax/Empresa.js"></script>
    <script src="ScriptsAjax/Usuario.js"></script>

</head>

<body>

    <script type="text/javascript">
            $(document).ready(function () {
               ko.applyBindings();
        });
    </script>
    <div class="panel panel-default>
                        <div class="col-xs-6 col-md-6 col-lg-6">
                  <img src="../files/image/logo.jpg" class="img-responsive">
                </div>
    </div>
    <div class="container">
        <div class="row"> 
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Login </h3>
                    <div class="panel-body">
                        <form role="form" data-bind="with: model.LoginController.login">
                            <fieldset>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Correo electronico" name="email" type="email" data-bind="value: logina"autofocus>
                                </div>
                                <div class="form-group">
                                    <input class="form-control" placeholder="Contrasena" name="password" type="password" data-bind="value: clavea" >
                                </div>
                                <div class="checkbox">
                                    <label>
                                        <input name="remember" type="checkbox" value="Remember Me">Recuerdame
                                    </label>
                                </div>
                                <!-- Change this to a button or input when using this as a form -->
                                <button type="button" data-bind="click: model.LoginController.verificar" class="btn btn-lg btn-success btn-block">ingresar</button>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</body>
</html>

<?php  
   ob_end_flush();
?>