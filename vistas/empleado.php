<?php 
  //Activamos el almacenamiento en el buffer
    ob_start();
    session_start();

    if (!isset($_SESSION["nombre"]))
    {
      header("Location: Login.php");
    }else{
      require_once("Header.php"); 
      if(isset($_SESSION["idUsuario"]) && $_SESSION["Empleados"] == 1)
      {
?>
       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div data-bind="visible: model.empleadoController.gridMode()">
                   <div class="col-lg-12">
                        <h2 class="page-header">Empleados 
                        <a href="#" class="btn btn-success" data-bind="click: model.empleadoController.nuevo"><i class="fa fa-plus-circle"></i> Agregar</a></h2>
                    </div>

                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="text-primary"><i class="fa fa-list"></i> Lista de empleados</span>
                                </div>
                                
                    <div class="panel-body">
                      <div class="table-responsive">
                        <table id="empleadoGrid" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombres</th>
                                        <th>Apellidos</th>
                                        <th>Nit</th>
                                        <th>Dpi</th>
                                        <th>Cargo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody data-bind="dataTablesForEach : {
                                                    data: model.empleadoController.empleados,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: primer_nombre + ' '+segundo_nombre"></td>
                                        <td data-bind="text: primer_apellido + ' '+segundo_apellido"></td>
                                        <td data-bind="text: nit"></td>
                                        <td data-bind="text: dpi"></td>
                                        <td data-bind="text: nombre"></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.empleadoController.editar"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.empleadoController.remover"><i class="fa fa-trash-o"></i></a>
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
    <div data-bind="visible: model.empleadoController.editMode()||model.empleadoController.insertMode()">
     <div class="page-header">
         <h3 data-bind="text: model.empleadoController.titulo()"></h3>
     </div>
        <form name="empleadoForm" id="empleadoForm" class="form" data-bind="with: model.empleadoController.empleado">
            <div class="row col col-md-12">
                <div class="form-group col-sm-6 col-md-6">
                    <label for="pnombre">Primer Nombre<span class="text-danger"> *</span></label>
                    <input id="pnombre" name="pnombre" type="text" class="form-control" data-bind="value: primer_nombre"
                           data-error=".errorPnombre"
                           minlength="3" maxlength="25" required>
                    <span class="errorPnombre text-danger help-inline"></span>
                </div>
                <div class="form-group col-sm-6 col-md-6">
                    <label for="snombre">Segundo Nombre</span></label>
                    <input id="snombre" name="pnombre" type="text" class="form-control" data-bind="value: segundo_nombre">
                </div>
            </div>
            <div class="row col col-md-12">
                <div class="form-group col-sm-6 col-md-6">
                    <label for="papellido">Primer Apellido<span class="text-danger"> *</span></label>
                    <input id="pnombre" name="pnombre" type="text" class="form-control" data-bind="value: primer_apellido"
                           data-error=".errorPApellido"
                           minlength="3" maxlength="25" required>
                    <span class="errorPApellido text-danger help-inline"></span>
                </div>
                <div class="form-group col-sm-6 col-md-6">
                    <label for="sapellido">Segundo Apellido</label>
                    <input id="sapellido" name="pnombre" type="text" class="form-control" data-bind="value: segundo_apellido">
                </div>
            </div>
            <div class="row col col-md-12">
                <div class="form-group col-sm-6 col-md-6">
                    <label for="nit">Nit<span class="text-danger"> *</span></label>
                    <input id="nit" name="nit" type="text" class="form-control" data-bind="value: nit"
                           data-error=".errorNit"
                           minlength="3" maxlength="100" required>
                    <span class="errorNit text-danger help-inline"></span>
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
                    <label for="telefono">Telèfono<span class="text-danger"> *</span></label>
                    <input id="telefono" name="telefono" type="text" class="form-control" data-bind="value: telefono"
                           data-error=".errorTelefono"
                           minlength="3" maxlength="100" required>
                    <span class="errorTelefono text-danger help-inline"></span>
                </div>
                <div class="form-group col-sm-6 col-md-6">
                    <label for="telefono">Cargo<span class="text-danger"> *</span></label>
                      <select class="form-control" id="rol" data-bind="options: model.empleadoController.cargos, optionsText: 'nombre', optionsValue: 'idCargo', value: idCargo"></select>
                    </div>
            </div>

            <div class="row col col-md-12">
                <div class="form-group col-sm-12 col-md-12">
                    <label for="direccion">Direccion<span class="text-danger"> *</span></label>
                    <input id="direccion" name="direccion" type="text" class="form-control" data-bind="value: direccion"
                           data-error=".errorDireccion"
                           minlength="3" maxlength="100" required>
                    <span class="errorDireccion text-danger help-inline"></span>
                </div>
            </div>

            <!-- <div class="row col col-md-12">
              <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                <label>Foto:</label>
              <input type="file" class="form-control" name="foto" id="foto">
            </div>-->

            <div class="form-group">
                <p class="text-center">
                    <button type="button" class="btn btn-info" data-bind="click:  model.empleadoController.guardar"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-danger" data-bind="click:  model.empleadoController.cancelar"><i class="fa fa-undo"></i> Cancelar</button>
                </p>
            </div>
            </div>
        </form>
    </div>

            </div>
        </div>

<script>
        $(document).ready(function () {
            model.empleadoController.initialize();
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