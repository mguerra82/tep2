<?php 
  //Activamos el almacenamiento en el buffer
    ob_start();
    session_start();

    if (!isset($_SESSION["nombre"]))
    {
      header("Location: Login.php");
    }else{
      require_once("Header.php"); 
     ?>
       <!-- Page Content -->
        <div id="page-wrapper">
          <?php 
            if (isset($_SESSION["idUsuario"]))
             {
           ?>
             <div class="">
                <div class=" from-group card col-xs-9 col-sm-9 col-md-9 col-lg-9">
                  <h3 class="page-header">Dashborard administrador <?php echo $_SESSION['nombre']; ?></h3>
                </div>
                <div class="card container col-xs-3 col-md-3 col-lg-3">
                  <img src="../files/image/logo.jpg" class="img-responsive">
                </div>
             </div>
             <?php 
             }
           ?>

          <?php 
            if (isset($_SESSION["idEmpresa"]))
              {
           ?>
             <div class="">
                <div class=" from-group card col-xs-9 col-sm-9 col-md-9 col-lg-9">
                  <h1>Dashborard <?php echo $_SESSION['nombre']; ?></h1>
                </div>
                <div class="card container col-xs-3 col-md-3 col-lg-3">
                  <img src="../files/image/logo.jpg" class="img-responsive">
                </div>
             </div>
             <hr/>
             <div class="from-group row">
                 <div class="col-lg-3 col-md-6">
                    <div class="panel panel-primary">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-3">
                                    <i class="fa fa-bar-chart fa-5x"></i>
                                </div>
                                <div class="col-xs-9 text-right">
                                    <div class="huge">200</div>
                                    <div>Descargas</div>
                                </div>
                            </div>
                        </div>
                        <a href="#">
                            <div class="panel-footer">
                                <span class="pull-left">Ver Descargas</span>
                                <span class="pull-right"><i class="fa fa-arrow-circle-right"></i></span>
                                <div class="clearfix"></div>
                            </div>
                        </a>
                    </div>
                </div>
             </div>

          <?php 
             }
           ?>
        </div>
<?php  
   require_once("Footer.php");
   }
ob_end_flush();
?>
