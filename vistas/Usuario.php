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
                <div data-bind="visible: model.usuarioController.gridMode()">
                    <div class="col-lg-12">
                        <h2 class="page-header">Usuarios 
                        <a href="#" class="btn btn-success" data-bind="click: model.usuarioController.nuevo"><i class="fa fa-plus-circle"></i> Agregar</a></h2>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="text-primary"><i class="fa fa-list"></i> Lista de usuarios</span>
                                </div>
                                
                    <div class="panel-body">
                       <div class="table-responsive">
                                  
                        <table id="tipoGrid" class="table table-hover table-responsive">
                                <thead>
                                    <tr>
                                        <th>Nombre de Usuario</th>
                                        <th>Empleado</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody data-bind="dataTablesForEach : {
                                                    data: model.usuarioController.usuarios,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: username"></td>
                                        <td data-bind="text: primer_nombre+' '+primer_apellido"></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.usuarioController.editar"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.usuarioController.remover"><i class="fa fa-trash-o"></i></a>
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
    <div data-bind="visible: model.usuarioController.insertMode">

        <form name="usuarioForm" id="usuarioForm" class="form" data-bind="with: model.usuarioController.usuario">
            <div class="row col col-md-12">
                <div class="form-group col-sm-6 col-md-6">
                    <label for="licencia">Nombre de Usuario<span class="text-danger"> *</span></label>
                    <input id="username" name="username" type="text" class="form-control" data-bind="value: username"
                           data-error=".errorUser"
                           minlength="3" maxlength="25" required>
                    <span class="errorUser text-danger help-inline"></span>
                </div>

                <div class="form-group col-sm-6 col-md-6">
                    <label for="nit">Email<span class="text-danger"> *</span></label>
                    <input id="email" name="email" type="elmail" class="form-control" data-bind="value: email"
                           data-error=".errorEmail"
                           minlength="3" maxlength="100" required>
                    <span class="errorEmail text-danger help-inline"></span>
                </div>
            </div>
            <div class="row col col-md-12">
                <div class="form-group col-sm-4 col-md-4">
                    <label for="Password">Password</label>
                    <input id="password" name="password" type="password" class="form-control" data-bind="value: password"
                           data-error=".errorPassword"
                           minlength="3" maxlength="80" required>
                    <span class="errorPassword text-danger help-inline"></span>
                </div>

                <div class="form-group col-sm-4 col-md-4">
                    <label for="empleado">Empleado<span class="text-danger"> *</span></label>
                      <select class="form-control" id="empleado" data-bind="options: model.usuarioController.empleados, optionsText:'primer_nombre', optionsValue: 'idEmpleado', value: idEmpleado"></select>
                </div>
                <div class="form-group col-sm-4 col-md-4">
                    <label for="rol">Rol<span class="text-danger"> *</span></label>
                      <select class="form-control" id="rol" data-bind="options: model.usuarioController.roles, optionsText: 'nombre', optionsValue: 'idRol', value: idRol"></select>
                </div>
            </div>
            <div class="form-group">
                <p class="text-center">
                    <button type="button" class="btn btn-info" data-bind="click:  model.usuarioController.guardar"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-danger" data-bind="click:  model.usuarioController.cancelar"><i class="fa fa-undo"></i> Cancel</button>
                </p>
            </div>
        </form>
    </div>

            </div>
        </div>

<script>
        $(document).ready(function () {
            model.usuarioController.initialize();
        });
</script>

<?php  
   require_once("Footer.php");
}
   ob_end_flush();
?>