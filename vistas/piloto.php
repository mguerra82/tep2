<?php 
  //Activamos el almacenamiento en el buffer
    ob_start();
    session_start();

    if (!isset($_SESSION["nombre"]))
    {
      header("Location: Login.php");
    }else{
      require_once("Header.php"); 
      if(isset($_SESSION["idUsuario"]) && $_SESSION["Pilotos"] == 1)
      {
?>
       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div data-bind="visible: model.pilotoController.gridMode()">
                    <div class="col-lg-12">
                        <h2 class="page-header">Pilotos 
                        <a href="#" class="btn btn-success" data-bind="click: model.pilotoController.nuevo"><i class="fa fa-plus-circle"></i> Agregar</a></h2>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="text-primary"><i class="fa fa-list"></i> Lista de pilotos</span>
                                </div>
                                
                      <div class="panel-body">
                        <div class="table-responsive">
                             
                        <table id="tipoGrid" class="table table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>Licencia</th>
                                        <th>DPI</th>
                                        <th>Nombre</th>
                                        <th>Apellido</th>
                                        <th>Telefono</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody data-bind="dataTablesForEach : {
                                                    data: model.pilotoController.pilotos,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: licencia"></td>
                                        <td data-bind="text: dpi"></td>
                                        <td data-bind="text: nombre"></td>
                                        <td data-bind="text: apellido"></td>
                                         <td data-bind="text: telefono"></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.pilotoController.editar"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.pilotoController.remover"><i class="fa fa-trash-o"></i></a>
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
    <div data-bind="visible: model.pilotoController.insertMode">

        <form name="pilotoForm" id="pilotoForm" class="form" data-bind="with: model.pilotoController.piloto">
            <div class="row col col-md-12">
                <div class="form-group col-sm-6 col-md-6">
                    <label for="licencia">Licencia<span class="text-danger"> *</span></label>
                    <input id="licencia" name="licencia" type="text" class="form-control" data-bind="value: licencia"
                           data-error=".errorLicencia"
                           minlength="3" maxlength="25" required>
                    <span class="errorLicencia text-danger help-inline"></span>
                </div>
                <div class="form-group col-sm-6 col-md-6">
                    <label for="dpi">DPI</label>
                    <input id="dpi" name="dpi" type="text" class="form-control" data-bind="value: dpi"
                           data-error=".errorDpi"
                           minlength="3" maxlength="80" required>
                    <span class="errorDpi text-danger help-inline"></span>
                </div>
            </div>
            <div class="row col col-md-12">
                <div class="form-group col-sm-6 col-md-6">
                    <label for="nombre">Nombre<span class="text-danger"> *</span></label>
                    <input id="nombre" name="nombre" type="text" class="form-control" data-bind="value: nombre"
                           data-error=".errorNombre"
                           minlength="3" maxlength="100" required>
                    <span class="errorNombre text-danger help-inline"></span>
                </div>
                <div class="form-group col-sm-6 col-md-6">
                    <label for="descripcion">Apellido</label>
                    <input id="apellido" name="apellido" type="text" class="form-control" data-bind="value: apellido"
                           data-error=".errorApellido"
                           minlength="3" maxlength="80" required>
                    <span class="errorApellido text-danger help-inline"></span>
                </div>
            </div>
            <div class="row col col-md-12">
                <div class="form-group col-sm-6 col-md-6">
                    <label for="telefono">Telèfono<span class="text-danger"> *</span></label>
                    <input type="number" id="telefono" name="telefono" type="text" class="form-control" data-bind="value: telefono"
                           data-error=".errorTelefono"
                           minlength="8" maxlength="12" required>
                    <span class="errorTelefono text-danger help-inline"></span>
                </div>
                 <div class="form-group col-sm-6 col-md-6">
                    <label for="rol">Transporte<span class="text-danger"> *</span></label>
                      <select class="form-control" id="idEmpresa" data-bind="options: model.pilotoController.empresas, optionsText: 'nombre', optionsValue: 'idEmpresa', value: idEmpresa"></select>
                </div>
            </div>
            <div class="form-group">
                <p class="text-center">
                    <button type="button" class="btn btn-info" data-bind="click:  model.pilotoController.guardar"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-danger" data-bind="click:  model.pilotoController.cancelar"><i class="fa fa-undo"></i> Cancel</button>
                </p>
            </div>
        </form>
    </div>

            </div>
        </div>

<script>
        $(document).ready(function () {
            model.pilotoController.initialize();
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
