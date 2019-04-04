<?php 
  //Activamos el almacenamiento en el buffer
    ob_start();
    session_start();

    if (!isset($_SESSION["nombre"]))
    {
      header("Location: Login.php");
    }else{
      require_once("Header.php"); 
      if(isset($_SESSION["idUsuario"]) && $_SESSION["Acceso"] == 1)
      {
?>
       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                    <div class="col-lg-12">
                        <h1 class="page-header">Permisos</h1>
                    </div>                    
                    <div class="panel-body">
                        <table id="permisoGrid" class="table table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th class="info">Nombre</th>
                                        <th class="info">Codigo</th>
                                    </tr>
                                </thead>
                                <tbody>
                                <!-- ko foreach: {data: model.permisoController.permisos, as: 'permiso'} -->
                                    <tr>
                                        <td data-bind="text: permiso.nombre"></td>
                                        <td data-bind="text: permiso.codigo"></td>
                                    </tr>
                                   <!-- /ko -->
                                </tbody>
                          </table>
                    </div>
            </div>
        </div>

<script>
        $(document).ready(function () {
            model.permisoController.initialize();
        });
</script>

<?php  
   require_once("Footer.php");
   }else{
     header("Location: escritorio.php");
   }
}
   ob_end_flush();
?>