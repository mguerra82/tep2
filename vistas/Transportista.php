<?php 
  //Activamos el almacenamiento en el buffer
    ob_start();
    session_start();

    if (!isset($_SESSION["nombre"]))
    {
      header("Location: Login.php");
    }else{
      require_once("Header.php"); 
      if(isset($_SESSION["idUsuario"]) && $_SESSION["Transportistas"] == 1)
      {
?>
       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div data-bind="visible: model.empresaController.gridMode()">
                    <div class="col-lg-12">
                        <h2 class="page-header">Transportistas
                        <a href="#" class="btn btn-success" data-bind="click: model.empresaController.nuevoT"><i class="fa fa-plus-circle"></i> Agregar</a></h2>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="text-primary"><i class="fa fa-list"></i> Lista de transportistas</span>
                                </div>
                                
                    <div class="panel-body">
                      <div class="table-responsive">
                                   
                        <table id="tipoGrid" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Nit</th>
                                        <th>Direccion</th>
                                        <th>Email</th>
                                        <th>Contacto</th>
                                        <th>Telefono</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody data-bind="dataTablesForEach : {
                                                    data: model.empresaController.empresas,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: nombre"></td>
                                        <td data-bind="text: nit"></td>
                                        <td data-bind="text: direccion"></td>
                                        <td data-bind="text: email"></td>
                                        <td data-bind="text: contacto"></td>
                                        <td data-bind="text: telefono"></td>
                                        <td><span class="label" data-bind="text: (estado === 'A' ? 'Activo' : 'Inactivo'), css: (estado === 'A' ? 'label-info' : 'label-danger')"></span></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.empresaController.editar"><i class="fa fa-pencil"></i></a>
                                            <!-- ko if: estado == 'A' -->
                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.empresaController.remover"><i class="fa fa-trash-o"></i></a>
                                            <!-- /ko -->
                                            <!-- ko if: estado == 'I' -->
                                            <a href="#" class="btn btn-primary btn-xs" data-bind="click: model.empresaController.activar"><i class="fa fa-check"></i></a>
                                            <!-- /ko -->
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
    <div data-bind="visible: model.empresaController.editMode()||model.empresaController.insertMode()">

        <form name="empresaForm" id="empresaForm" class="form" data-bind="with: model.empresaController.empresa">
            <div class="row col col-md-12">
                <div class="form-group col-sm-6 col-md-6">
                    <label for="licencia">Nombre<span class="text-danger"> *</span></label>
                    <input id="nombre" name="nombre" type="text" class="form-control" data-bind="value: nombre"
                           data-error=".errorNombre"
                           minlength="3" maxlength="25" required>
                    <span class="errorNombre text-danger help-inline"></span>
                </div>
                <div class="form-group col-sm-6 col-md-6">
                    <label for="nit">Nit</label>
                    <input id="nit" name="nit" type="text" class="form-control" data-bind="value: nit"
                           data-error=".errorNit"
                           minlength="3" maxlength="80" required>
                    <span class="errorNit text-danger help-inline"></span>
                </div>
            </div>
            <div class="row col col-md-12">
                <div class="form-group col-sm-12 col-md-12">
                    <label for="nit">Email<span class="text-danger"> *</span></label>
                    <input id="email" name="email" type="elmail" class="form-control" data-bind="value: email"
                           data-error=".errorEmail"
                           minlength="3" maxlength="100" required>
                    <span class="errorEmail text-danger help-inline"></span>
                </div>
            </div>
            <div class="row col col-md-12">
                <div class="form-group col-sm-6 col-md-6">
                    <label for="contacto">Contacto<span class="text-danger"> *</span></label>
                    <input id="contacto" name="contacto" type="text" class="form-control" data-bind="value: contacto"
                           data-error=".errorContacto"
                           minlength="3" maxlength="100" required>
                    <span class="errorContacto text-danger help-inline"></span>
                </div>
                <div class="form-group col-sm-6 col-md-6">
                    <label for="telefono">Telefono<span class="text-danger"> *</span></label>
                    <input id="telefono" name="telefono" type="text" class="form-control" data-bind="value: telefono"
                           data-error=".errorTelefono"
                           minlength="3" maxlength="100" required>
                    <span class="errorTelefono text-danger help-inline"></span>
                </div>
            </div>
            <div class="form-group col-sm-12 col-md-12">
                    <label for="direccion">Direccion</label>
                    <input id="dieccion" name="direccion" type="direccion" class="form-control" data-bind="value: direccion"
                           data-error=".errorDireccion"
                           minlength="3" maxlength="80" required>
                    <span class="errorDireccion text-danger help-inline"></span>
            </div>
            <div class="row col col-md-12">
                <div class="form-group col-sm-12 col-md-12">
                    <label for="razon">Razon Social<span class="text-danger"> *</span></label>
                    <textarea id="razon" name="razon" rows="3" class="form-control" data-bind="value: razon_social"
                           data-error=".errorRazon"
                           minlength="3" maxlength="100" required></textarea>
                    <span class="errorRazon text-danger help-inline"></span>
                </div>
            </div>
            <div class="form-group">
                <p class="text-center">
                    <button type="button" class="btn btn-info" data-bind="click:  model.empresaController.guardar"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-danger" data-bind="click:  model.empresaController.cancelar"><i class="fa fa-undo"></i> Cancel</button>
                </p>
            </div>
        </form>
    </div>

            </div>
        </div>

<script>
        $(document).ready(function () {
            model.empresaController.initialize("T");
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