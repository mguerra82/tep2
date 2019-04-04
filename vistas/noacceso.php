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
            <div class="container-fluid">
                    <div class="col-lg-12">
                        <h1 class="page-header">NO ACCESO</h1>
                    </div>                    
                    <div class="container-fluid">
                      <h2 class="text-center">NO TIENE ACCESO, POR FAVOR SALGA!!</h2>
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
}
   ob_end_flush();
?>