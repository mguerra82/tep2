<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>TEPSA</title>

    <!-- Bootstrap Core CSS -->
    <link href="../public/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <link href="../public/metisMenu/metisMenu.min.css" rel="stylesheet">
    <link href="../public/dist/css/sb-admin-2.css" rel="stylesheet">
    <link href="../public/Assets/css/font-awesome.min.css" rel="stylesheet">
    <link href="../public/Assets/css/toastr.min.css" rel="stylesheet">
    <link href="../public/Assets/datatables/datatables.min.css" rel="stylesheet">
    <link href="../public/Assets/css/jquery.steps.css" rel="stylesheet">



    <!-- Custom Fonts -->
    <link href="../public/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

     <!-- Scripts necesarios -->
    <script src="../public/jquery/jquery.min.js"></script>
    <script src="../public/bootstrap/js/bootstrap.min.js"></script>
    <script src="../public/Assets/datatables/datatables.min.js"></script>
    <script src="../public/Assets/js/jquery.form.js"></script>
    <script src="../public/metisMenu/metisMenu.min.js"></script>
    <script src="../public/dist/js/sb-admin-2.js"></script>
    <script src="../public/Assets/js/jquery.validate.js"></script>
    <script src="../public/Assets/js/jquery.validate.localization.js"></script>
    <script src="../public/Assets/js/knockout-3.4.2.js"></script>
    <script src="../public/Assets/js/knockout.mapping.js"></script>  
    <script src="../public/Assets/js/bootbox.min.js"></script> 
    <script src="../public/Assets/js/toastr.min.js"></script> 
    <script src="../public/Assets/js/moment.min.js"></script> 
    <script src="../public/jquery/jquery.steps.js"></script> 
    <script src="../public/jquery/jquery.qrcode.min.js"></script> 
    <script src="../public/jquery/jquery.printqr.js"></script> 
    <script src="../public/jquery.PrintArea.js"></script>
     <!-- Scripts de vistas -->
    <script src="Scripts/model.js"></script> 
    <script src="Scripts/tipoTransporte.js"></script> 
    <script src="Scripts/producto.js"></script> 
    <script src="Scripts/piloto.js"></script>
    <script src="Scripts/empresa.js"></script>
    <script src="Scripts/Login.js"></script>
    <script src="Scripts/cargo.js"></script>
    <script src="Scripts/empleado.js"></script>
    <script src="Scripts/permiso.js"></script>
    <script src="Scripts/rol.js"></script>
    <script src="Scripts/usuario.js"></script>
    <script src="Scripts/transporte.js"></script>
    <script src="Scripts/tipoBuque.js"></script>
    <script src="Scripts/buque.js"></script>
    <script src="Scripts/planificacion.js"></script>
    <script src="Scripts/equipo.js"></script>
    <script src="Scripts/despacho.js"></script>
    <script src="Scripts/salida.js"></script>

     <!-- Scripts  ajax -->
    <script src="ScriptsAjax/TipoTransporte.js"></script> 
    <script src="ScriptsAjax/Piloto.js"></script> 
    <script src="ScriptsAjax/Producto.js"></script>  
    <script src="ScriptsAjax/Empresa.js"></script>
    <script src="ScriptsAjax/Cargo.js"></script>
    <script src="ScriptsAjax/Empleado.js"></script>
    <script src="ScriptsAjax/Permiso.js"></script>
    <script src="ScriptsAjax/Rol.js"></script>
    <script src="ScriptsAjax/Usuario.js"></script>
    <script src="ScriptsAjax/Transporte.js"></script>
    <script src="ScriptsAjax/TipoBuque.js"></script>
    <script src="ScriptsAjax/Buque.js"></script>
    <script src="ScriptsAjax/Equipo.js"></script>
    <script src="ScriptsAjax/Planificacion.js"></script>
    <script src="ScriptsAjax/Despacho.js"></script>
    <script src="ScriptsAjax/Salida.js"></script>
</head>

<body>

    <script>
        $(document).ready(function () {
            console.log("applyBindings");
            ko.applyBindings();

            $('[data-toggle="tooltip"]').tooltip();
        });
    </script>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0;">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="#"><strong>SCB Tepsa V.1.0</strong></a>
                <a class="navbar-brand" href="#"><img width="auto" style="width: 150px; height: 35px;" src="../files/image/logo.jpg" class="img-fluid"></a>
            </div>

            <ul class="nav navbar-top-links navbar-right">
                            <!-- /.dropdown -->
                 <li>
                    <a class="text-center" href="#">
                        <strong><?php echo $_SESSION['nombre']; ?></strong>
                    </a>
                </li>
                <li class="dropdown">
                    <a class="dropdown-toggle" data-toggle="dropdown" href="#">
                        <i class="fa fa-user fa-fw"></i> <i class="fa fa-caret-down"></i>
                    </a>
                    <ul class="dropdown-menu dropdown-user">
                        <li class="divider"></li>
                        <li><a href="../ajax/empresa.php?op=salir"><i class="fa fa-sign-out fa-fw"></i> Salir</a>
                        </li>
                    </ul>
                    <!-- /.dropdown-user -->
                </li>
             </ul>
            <!-- /.navbar-header -->

            <div class="navbar-default sidebar" role="navigation">
                <div class="sidebar-nav navbar-collapse">
                    <ul class="nav" id="side-menu">
                        <li class="sidebar-search">
                            <div class="input-group custom-search-form">
                                <input type="text" class="form-control" placeholder="Search...">
                                <span class="input-group-btn">
                                <button class="btn btn-default" type="button">
                                    <i class="fa fa-search"></i>
                                </button>
                            </span>
                            </div>
                        </li>
                        <li>
                            <a href="Escritorio.php"><i class="fa fa-dashboard fa-fw"></i> Dashboard</a>
                        </li>
        <?php 
            if (isset($_SESSION["idUsuario"]))
             {
        ?>

                        <li>
                            <a href="#"><i class="fa fa-cog"></i> Cagalogos tepsa<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                            <?php 
                            if ($_SESSION['Productos']==1)
                                    {
                                ?>
                                <li>
                                    <a href="producto.php"><i class="fa fa-circle-o"></i> Productos</a>
                                </li>
                                <?php 
                              }
                            ?>
                            
                            <?php 
                            if ($_SESSION['Equipos']==1)
                                    {
                                ?>
                                 <li>
                                    <a href="equipo.php"><i class="fa fa-circle-o"></i> Equipos</a>
                                </li>
                             <?php 
                              }
                            ?>


                            <?php 
                            if ($_SESSION['Consignatarios']==1)
                                    {
                                ?>
                                <li>
                                    <a href="Consignatario.php"><i class="fa fa-circle-o"></i> Consignatarios</a>
                                </li>
                            <?php 
                              }
                            ?>

                            <?php 
                           if ($_SESSION['Tipo_Buques']==1)
                            {
                        ?>

                        
                                <li>
                                    <a href="tipoBuque.php"><i class="fa fa-circle-o"></i> Tipo Buques</a>
                                </li>
                        <?php 
                           }
                        ?>

                        <?php 
                           if ($_SESSION['Buques']==1)
                            {
                        ?>
                                <li>
                                    <a href="buque.php"><i class="fa fa-circle-o"></i> Buques</a>
                                </li>
                        <?php 
                           }
                        ?>


                            </ul>
                        </li>
   
                        <?php 
                           if ($_SESSION['Empleados']==1)
                            {

                         ?>
                        <li>
                            <a href="#"><i class="fa fa-users"></i> Personal<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>  
                                    <a href="Cargo.php"><i class="fa fa-circle-o"></i> Cargo empleados</a>
                                </li>
                                <li>
                                    <a href="empleado.php"><i class="fa fa-circle-o"></i> Empleados</a>
                                </li>
                            </ul>
                        </li>
                        <?php 
                           }
                         ?>

                        

                        <li>
                            <a href="#"><i class="fa fa-bus"></i> Catalogos Transportista<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">

                        <?php 
                           if ($_SESSION['Transportistas']==1)
                            {
                        ?>
                                <li>
                                    <a href="Transportista.php"><i class="fa fa-circle-o"></i> Transportistas</a>
                                </li>
                        <?php 
                           }
                        ?>

                        <?php 
                           if ($_SESSION['Pilotos']==1)
                            {
                        ?>
                                <li>
                                    <a href="piloto.php"><i class="fa fa-circle-o"></i> Pilotos</a>
                                </li>
                        <?php 
                           }
                        ?>

                        <?php 
                           if ($_SESSION['Tipo_Transportes']==1)
                            {
                        ?>
                                <li>
                                    <a href="tipoTransporte.php"><i class="fa fa-circle-o"></i> Tipo Transporte</a>
                                </li>
                        <?php 
                           }
                        ?>

                        <?php 
                           if ($_SESSION['Transportes']==1)
                            {
                        ?>
                                <li>
                                    <a href="transporte.php"><i class="fa fa-circle-o"></i> Transportes</a>
                                </li>
                        <?php 
                           }
                        ?>
                            </ul>
                        </li>
         
                        <?php 
                           if ($_SESSION['Planificacion']==1)
                            {
                        ?>
                        <li>
                            <a href="Planificacion.php"><i class="fa fa-bank"></i> Planificacion</a>
                        </li>
                        <?php 
                           }
                        ?>


                        <li>
                            <a href="Despacho.php"><i class="fa fa-file"></i> Despacho de Carga</a>
                        </li>
                        <li>
                            <a href="Salida.php"><i class="fa fa-truck"></i> Salida de Puerto</a>
                        </li>
                        <?php 
                           if ($_SESSION['Reportes']==1)
                            {
                        ?>
                         <li>
                            <a href="#"><i class="fa fa-bar-chart"></i>Reportes<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                            <li>
                                <a href="RptDescarga.php"><i class="fa fa-bank"></i>Reporte de Descarga</a>
                            </li>
                            </ul>
                        </li>
                        <?php 
                           }
                        ?>

                        <?php 
                           if ($_SESSION['Acceso']==1)
                            {
                        ?>
                        <li>
                            <a href="#"><i class="fa fa-user"></i> Accesso<span class="fa arrow"></span></a>
                            <ul class="nav nav-second-level">
                                <li>
                                    <a href="Permiso.php"><i class="fa fa-circle-o"></i> Permisos</a>
                                </li>
                                <li>
                                    <a href="Rol.php"><i class="fa fa-circle-o"></i> Roles</a>
                                </li>
                                 <li>
                                    <a href="Usuario.php"><i class="fa fa-circle-o"></i> Usuarios</a>
                                </li>
                            </ul>
                        </li>
                        <?php 
                           }
                        ?>

        <?php 
          }//fin if
        ?>
                    </ul>
                </div>
            </div>
        </nav>

    </div>
