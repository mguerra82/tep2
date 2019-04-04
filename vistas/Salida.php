
<?php 
  //Activamos el almacenamiento en el buffer
    ob_start();
    session_start();

    if (!isset($_SESSION["nombre"]))
    {
      header("Location: Login.php");
    }else{
      require_once("Header.php"); 
      if(isset($_SESSION["idUsuario"]) && $_SESSION["Salidas"] == 1)
     {
?>
       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div data-bind="visible: model.salidaController.gridMode()">
                   <div class="col-lg-12">
                        <h2 class="page-header">Salidas de puerto 
                        <a href="#" class="btn btn-success" data-bind="click: model.salidaController.nuevo"><i class="fa fa-plus-circle"></i> Agregar</a></h2>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="text-primary"><i class="fa fa-list"></i> Lista de salidas de puerto</span>
                                </div>
                                
                     <div class="panel-body">
                       <div class="table-responsive">
                               
                        <table id="salidaGrid" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Codigo Descarga</th>
                                        <th>bl</th>
                                        <th>Peso Real</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody data-bind="dataTablesForEach : {
                                                    data: model.salidaController.salidas,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: codigo"></td>
                                        <td data-bind="text: bl"></td>
                                        <td data-bind="text: peso"></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.salidaController.editar"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.salidaController.remover"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                    </tr>

                                </tbody>
                          </table>
                       </div>   
                            </div>
                        </div>
                    </div> 
                            </div> 
                </div>

          <!-- Formulario de registro  -->
                  <div class="form-group"> </div>
    <div class="form-group"> </div>
    <div data-bind="visible: model.salidaController.insertMode">
   <div class="form">
    <h3 class="page-header"> Salida De Puerto</h3>
    <div class="row">
        
        <div class="form-group col-sm-3 col-md-3">
                    <input id="codigo" name="codigo" type="text" class="form-control" data-bind="value: model.salidaController.codigo"
                           data-error=".errorCodigo"
                           placeholder="ingrese codigo escaneado" 
                           minlength="" maxlength="100" required>
                    <span class="errorCodigo text-danger help-inline"></span>
        </div>
         <div class="col-sm-6 col-md-6">
                    <button type="button" class="btn btn-primary" data-bind="click:  model.salidaController.obtener"> Obtener</button>
                    <button type="button" class="btn btn-danger" data-bind="click:  model.salidaController.cancelar"><i class="fa fa-undo"></i> Volver</button>
            </div> 
    </div>      
   </div>

    </div>

    <div class="page-header"></div>
<div class="" data-bind="visible: model.salidaController.isInsertSalida()">

    <div class="page-header">
        <div class="" data-bind="with: model.salidaController.infoDescarga">
            <label><b>Informacion de descarga</b></label>
            <h5><b>Tiempo Descarga:</b> <span data-bind="text: tiempo"></h5>
            <h5><b>Codigo: </b><span data-bind="text: codigo"></span></h5>
            <h5><b>Consignatario: </b><span data-bind="text: consignatario"></span></h5>
            <h5><b>Producto: </b><span data-bind="text: producto"></span></h5><br />
        </div>
    </div>
        <form  name="salidaForm" id="salidaForm" class="form" data-bind="with: model.salidaController.salida">
            <div class="row">
                <div class="form-group col-sm-6 col-md-6">
                    <label for="bl">Bl<span class="text-danger"> *</span></label>
                    <input id="bl" name="bl" type="text" class="form-control" data-bind="value: bl"
                           data-error=".errorBol"
                           minlength="3" maxlength="100" required>
                    <span class="errorBol text-danger help-inline"></span>
                </div>
                <div class="form-group col-sm-6 col-md-6">
                    <label for="peso">Peso Real<span class="text-danger"> *</span></label>
                    <input id="peso" name="placa" type="number" step="0.01" class="form-control" data-bind="value: peso"
                           data-error=".peso" required>
                    <span class="peso text-danger help-inline"></span>
                </div>
            </div>
            <div class="form-group">
                <p class="text-center">
                    <button type="button" class="btn btn-info" data-bind="click:  model.salidaController.guardar"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-danger" data-bind="click:  model.salidaController.cancelar"><i class="fa fa-undo"></i> Cancelar</button>
                </p>
            </div>
        </form>
        </div>
    </div> 
</div>

<script>
        $(document).ready(function () {
            model.salidaController.initialize();
        });
</script>

<?php  
   require_once("Footer.php");
}else{
     header("Location: noacceso.php");
   }
}
   ob_end_flush();
?>