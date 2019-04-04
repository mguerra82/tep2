<?php 
  //Activamos el almacenamiento en el buffer
    ob_start();
    session_start();

    if (!isset($_SESSION["nombre"]))
    {
      header("Location: Login.php");
    }else{
      require_once("Header.php"); 
      if(isset($_SESSION["idUsuario"]) && $_SESSION["Buques"] == 1)
      {
?>
       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div data-bind="visible: model.buqueController.gridMode()">
                    <div class="col-lg-12">
                        <h2 class="page-header">Buques 
                        <a href="#" class="btn btn-success" data-bind="click: model.buqueController.nuevo"><i class="fa fa-plus-circle"></i> Agregar</a></h2>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="text-primary"><i class="fa fa-list"></i> Lista de buques</span>
                                </div>
                                
                    <div class="panel-body">
                        <div class="table-responsive">
                            
                        <table class="table table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>No. Bodegas</th>
                                        <th>Tipo Buque</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody data-bind="dataTablesForEach : {
                                                    data: model.buqueController.buques,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: nombre"></td>
                                        <td data-bind="text: no_bodegas"></td>
                                        <td data-bind="text: tipoBuque"></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.buqueController.editar"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.buqueController.remover"><i class="fa fa-trash-o"></i></a>
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
    <div data-bind="visible: model.buqueController.insertMode">

        <form name="buqueForm" id="buqueForm" class="form" data-bind="with: model.buqueController.buque">
                <div class="form-group col-sm-4 col-md-4">
                    <label for="nombre">Nombre<span class="text-danger"> *</span></label>
                    <input id="nombre" name="nombre" type="text" class="form-control" data-bind="value: nombre"
                           data-error=".errorNombre"
                           minlength="3" maxlength="100" required>
                    <span class="errorNombre text-danger help-inline"></span>
                </div>
                <div class="form-group col-sm-4 col-md-4">
                    <label for="nombre">No. Bodegas<span class="text-danger"> *</span></label>
                    <input type="number" id="no_bodegas" name="no_bodegas" type="text" class="form-control" data-bind="value: no_bodegas" data-error=".errorNo_Bodegas" required>
                    <span class="errorNo_Bodegas text-danger help-inline"></span>
                </div>
                <div class="form-group col-sm-4 col-md-4">
                    <label for="rol">Tipo Buque<span class="text-danger"> *</span></label>
                      <select class="form-control" id="rol" data-bind="options: model.buqueController.tipos, optionsText: 'nombre', optionsValue: 'idTipo_Buque', value: idTipo_Buque"></select>
                </div>
            <div class="form-group">
                <p class="text-center">
                    <button type="button" class="btn btn-info" data-bind="click:  model.buqueController.guardar"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-danger" data-bind="click:  model.buqueController.cancelar"><i class="fa fa-undo"></i> Cancel</button>
                </p>
            </div>
        </form>
    </div>

            </div>
        </div>

<script>
        $(document).ready(function () {
            model.buqueController.initialize();
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