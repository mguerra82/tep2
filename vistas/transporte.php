
<?php 
  //Activamos el almacenamiento en el buffer
    ob_start();
    session_start();

    if (!isset($_SESSION["nombre"]))
    {
      header("Location: Login.php");
    }else{
      require_once("Header.php"); 
      if(isset($_SESSION["idUsuario"]) && $_SESSION["Transportes"] == 1)
      {
?>
       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div data-bind="visible: model.transporteController.gridMode()">
                    <div class="col-lg-12">
                        <h2 class="page-header">Transportes 
                        <a href="#" class="btn btn-success" data-bind="click: model.transporteController.nuevo"><i class="fa fa-plus-circle"></i> Agregar</a></h2>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="text-primary"><i class="fa fa-list"></i> Lista de transportes</span>
                                </div>
                                
                    <div class="panel-body">
                      <div class="table-responsive">
                                    
                        <table id="tipoGrid" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Tipo</th>
                                        <th>Placa</th>
                                        <th>Modelo</th>
                                        <th>Transportista</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody data-bind="dataTablesForEach : {
                                                    data: model.transporteController.transportes,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: nombre"></td>
                                        <td data-bind="text: placa"></td>
                                        <td data-bind="text: modelo"></td>
                                        <td data-bind="text: transportista"></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.transporteController.editar"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.transporteController.remover"><i class="fa fa-trash-o"></i></a>
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
    <div data-bind="visible: model.transporteController.insertMode">

        <form name="transporteForm" id="transporteForm" class="form" data-bind="with: model.transporteController.transporte">
            <div class="row">
                <div class="form-group col-sm-6 col-md-6">
                    <label for="nombre">Tipo vehiculo<span class="text-danger"> *</span></label>
                    <input id="nombre" name="nombre" type="text" class="form-control" data-bind="value: nombre"
                           data-error=".errorNombre"
                           minlength="3" maxlength="100" required>
                    <span class="errorNombre text-danger help-inline"></span>
                </div>
                <div class="form-group col-sm-6 col-md-6">
                    <label for="placa">Placa<span class="text-danger"> *</span></label>
                    <input id="placa" name="placa" type="text" class="form-control" data-bind="value: placa"
                           data-error=".errorPlaca"
                           minlength="3" maxlength="100" required>
                    <span class="errorPlaca text-danger help-inline"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-4 col-md-4">
                    <label for="modelo">Modelo<span class="text-danger"> *</span></label>
                    <input id="modelo" name="modelo" type="text" class="form-control" data-bind="value: modelo"
                           data-error=".errorModelo"
                           minlength="3" maxlength="100" required>
                    <span class="errorModelo text-danger help-inline"></span>
                </div>
                <div class="form-group col-sm-4 col-md-4">
                    <label for="rol">Tipo Transporte<span class="text-danger"> *</span></label>
                      <select class="form-control" id="rol" data-bind="options: model.transporteController.tipos, optionsText: 'nombre', optionsValue: 'idTipo_Transporte', value: idTipo_Transporte"></select>
                </div>
                <div class="form-group col-sm-4 col-md-4">
                    <label for="rol">Transporte<span class="text-danger"> *</span></label>
                      <select class="form-control" id="rol" data-bind="options: model.transporteController.empresas, optionsText: 'nombre', optionsValue: 'idEmpresa', value: idEmpresa"></select>
                </div>
            </div>
            <div class="form-group">
                <p class="text-center">
                    <button type="button" class="btn btn-info" data-bind="click:  model.transporteController.guardar"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-danger" data-bind="click:  model.transporteController.cancelar"><i class="fa fa-undo"></i> Cancel</button>
                </p>
            </div>
        </form>
    </div>

            </div>
        </div>

<script>
        $(document).ready(function () {
            model.transporteController.initialize();
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
