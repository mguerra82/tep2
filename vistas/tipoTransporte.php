
<?php 
  //Activamos el almacenamiento en el buffer
    ob_start();
    session_start();

    if (!isset($_SESSION["nombre"]))
    {
      header("Location: Login.php");
    }else{
      require_once("Header.php"); 
      if(isset($_SESSION["idUsuario"]) && $_SESSION["Tipo_Transportes"] == 1)
      {
?>
       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div data-bind="visible: model.tipoTransporteController.gridMode()">
                    <div class="col-lg-12">
                        <h2 class="page-header">Tipos de transportes 
                        <a href="#" class="btn btn-success" data-bind="click: model.tipoTransporteController.nuevo"><i class="fa fa-plus-circle"></i> Agregar</a></h2>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="text-primary"><i class="fa fa-list"></i> Lista de tipos de transporte</span>
                                </div>
                                
                    <div class="panel-body">
                        <div class="table-responsive">
                                  
                        <table id="tipoGrid" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Descripcion</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody data-bind="dataTablesForEach : {
                                                    data: model.tipoTransporteController.tipos,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: nombre"></td>
                                        <td data-bind="text: descripcion"></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.tipoTransporteController.editar"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.tipoTransporteController.remover"><i class="fa fa-trash-o"></i></a>
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
    <div data-bind="visible: model.tipoTransporteController.editMode()||model.tipoTransporteController.insertMode()">

        <form name="tipoForm" id="tipoForm" class="form" data-bind="with: model.tipoTransporteController.tipo" method="POST">
            <div class="row">
                <div class="form-group col-sm-7 col-md-7">
                    <label for="nombre">Nombre<span class="text-danger"> *</span></label>
                    <input id="nombre" name="nombre" type="text" class="form-control" data-bind="value: nombre"
                           data-error=".errorNombre"
                           minlength="3" maxlength="100" required>
                    <span class="errorNombre text-danger help-inline"></span>
                </div>
                <div class="form-group col-sm-12 col-md-12">
                    <label for="descripcion">Descripcion</label>
                    <textarea id="descripcion" name="descripcion" type="text" class="form-control" data-bind="value: descripcion"
                           data-error=".errorDescripcion"
                           minlength="3" maxlength="500" required></textarea>
                    <span class="errorDescripcion text-danger help-inline"></span>
                </div>
            </div>
            <div class="form-group">
                <p class="text-center">
                    <button type="button" class="btn btn-info" data-bind="click:  model.tipoTransporteController.guardar"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-danger" data-bind="click:  model.tipoTransporteController.cancelar"><i class="fa fa-undo"></i> Cancel</button>
                </p>
            </div>
        </form>
    </div>

            </div>
        </div>

<script>
        $(document).ready(function () {
            model.tipoTransporteController.initialize();
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