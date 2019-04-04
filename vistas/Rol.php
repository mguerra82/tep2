<?php 
  //Activamos el almacenamiento en el buffer
    ob_start();
    session_start();

    if (!isset($_SESSION["nombre"]))
    {
      header("Location: Login.php");
    }else{
      require_once("Header.php"); 
      if(isset($_SESSION["idUsuario"]) && $_SESSION["Acceso"] == 1)
      {
?>
       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid">
                <div data-bind="visible: model.rolController.gridMode()">
                    <div class="col-lg-12">
                        <h2 class="page-header">Roles 
                        <a href="#" class="btn btn-success" data-bind="click: model.rolController.nuevo"><i class="fa fa-plus-circle"></i> Agregar</a></h2>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="text-primary"><i class="fa fa-list"></i> Lista de roles</span>
                                </div>
                                
                    <div class="panel-body">
                      <div class="table-responsive">
                          
                        <table id="rolGrid" class="table table-hover">
                            <thead>
                                <tr>
                                    <th>Nombre</th>
                                    <th>Estado</th>
                                    <th>Opcion</th>
                                </tr>
                            </thead>
                            <tbody data-bind="dataTablesForEach : {
                                                    data: model.rolController.roles,
                                                    options: dataTableOptions
                                                  }">
                                <tr>
                                    <td data-bind="text: nombre"></td>
                                    <td><span class="label" data-bind="text: (estado === 'A' ? 'Activo' : 'Inactivo'), css: (estado === 'A' ? 'label-info' : 'label-danger')"></span></td>
                                        <td>   
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.rolController.editar"><i class="fa fa-pencil"></i></a>
                                            <!-- ko if: estado == 'A' -->
                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.rolController.remover"><i class="fa fa-trash-o"></i></a>
                                            <!-- /ko -->
                                            <!-- ko if: estado == 'I' -->
                                            <a href="#" class="btn btn-primary btn-xs" data-bind="click: model.rolController.activar"><i class="fa fa-check"></i></a>
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

                  <!-- formulario registro -->
    <div class="form-group"> </div>
    <div data-bind="visible: (model.rolController.editMode() || model.rolController.insertMode())">

        <form name="rolEdit" id="rolEdit" class="form" data-bind="with: model.rolController.rol">
            <div class="row">
                <div class="form-group col-sm-4 col-md-4">
                    <label for="codigo">Nombre<span class="text-danger"> *</span></label>
                    <input id="nombre" name="nombre" type="text" class="form-control" data-bind="value: nombre"
                           data-error=".errorNombre"
                           minlength="3" maxlength="25" required>
                    <span class="errorNombre text-danger help-inline"></span>
                </div>
            </div>
           

            <label>Permisos<span class="text-danger"> *</span></label>
            <div class="form-group">
                    <!-- ko foreach: {data: model.rolController.permisos, as: 'permiso'} -->
                    <div class="checkbox col-md-3">
                        <label>
                            <input type="checkbox" value="" data-bind="value: permiso.idPermiso, checked: model.rolController.addPermisos"><span data-bind="text: permiso.nombre"></span>
                        </label>
                    </div>
                    <!-- /ko -->
            </div>
            <div class="form-group">
                <p class="text-center">
                    <button type="button" class="btn btn-info" data-bind="click:  model.rolController.guardar"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-danger" data-bind="click:  model.rolController.cancelar"><i class="fa fa-undo"></i> Cancel</button>
                </p>
            </div>
        </form>
    </div>

            </div>
        </div>

<script>
        $(document).ready(function () {
            model.rolController.initialize();
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