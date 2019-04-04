<?php 
  //Activamos el almacenamiento en el buffer
    ob_start();
    session_start();

    if (!isset($_SESSION["nombre"]))
    {
      header("Location: Login.php");
    }else{
      require_once("Header.php"); 
      if(isset($_SESSION["idUsuario"]) && $_SESSION["Reportes"] == 1)
      {
?>
<div id="page-wrapper">
<form action="../reportes/Reporte.php" method="GET" target="_blank">
  <b>Numero de Importacion</b><input type="text" name="idPlano_Estiba" id="idPlano_Estiba" class="form-control"><br>
  <input type="submit" value="Buscar" class="btn btn-primary">
</form>
</div>
<?php  
   require_once("Footer.php");
   }else{
     header("Location: noacceso.php");
   }
}
   ob_end_flush();
?>
