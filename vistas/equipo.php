<?php 
  //Activamos el almacenamiento en el buffer
    ob_start();
    session_start();

    if (!isset($_SESSION["nombre"]))
    {
      header("Location: Login.php");
    }else{
      require_once("Header.php"); 
      if(isset($_SESSION["idUsuario"]) && $_SESSION["Equipos"] == 1)
      {
?>
       <!-- Page Content -->
        <div id="page-wrapper">
            <div class="container-fluid row">
                <div data-bind="visible: model.equipoController.gridMode()">
                    <div class="col-lg-12">
                        <h2 class="page-header">Equipos 
                        <a href="#" class="btn btn-success" data-bind="click: model.equipoController.nuevo"><i class="fa fa-plus-circle"></i> Agregar</a></h2>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="text-primary"><i class="fa fa-list"></i> Lista de equipos</span>
                                </div>
                                
                     <div class="panel-body">
                      <div class="table-responsive">
                          
                        <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>Descripcion</th>
                                        <th>Dimensiones</th>
                                        <th>Tipo Equipo</th>
                                        <th>Acciones</th>
                                    </tr>
                                </thead>
                                <tbody data-bind="dataTablesForEach : {
                                                    data: model.equipoController.tipos,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: descripcion"></td>
                                        <td data-bind="text: dimensiones"></td>
                                        <td data-bind="text: tipoEquipo"></td>
                                        <td>
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click: model.equipoController.editar"><i class="fa fa-pencil"></i></a>
                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click: model.equipoController.remover"><i class="fa fa-trash-o"></i></a>
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
    <div data-bind="visible: model.equipoController.editMode()||model.equipoController.insertMode()">

        <form name="tipoForm" id="tipoForm" class="form" data-bind="with: model.equipoController.tipo" method="POST">
            <div class="row">
                <div class="form-group col-sm-6 col-md-6">
                    <label for="nombre">Descripció<span class="text-danger"> *</span></label>
                    <input id="descripcion" name="descripcion" type="text" class="form-control" data-bind="value: descripcion"
                           data-error=".errorNombre"
                           minlength="3" maxlength="100" required>
                    <span class="errorDescripcion text-danger help-inline"></span>
                </div>
                <div class="form-group col-sm-6 col-md-6">
                    <label for="dimensiones">Dimensiones</label>
                    <textarea id="dimensiones" name="dimensiones" type="text" class="form-control" data-bind="value: dimensiones"
                           data-error=".errorDimensiones"
                           minlength="3" maxlength="500" required></textarea>
                    <span class="errorDimensiones text-danger help-inline"></span>
                </div>
            </div>
            <div class="row">
                <div class="form-group col-sm-6 col-md-6">
                    <label for="nombre">Tipo Equipo<span class="text-danger"> *</span></label>
                    <select class="form-control" id="tipoEquipo" name="tipoEquipo" data-bind="value: tipoEquipo">
                      <option value="A">Almeja</option>
                      <option value="T">Tolva</option>
                    </select>
                    <span class="errorDescripcion text-danger help-inline"></span>
                </div>
                <div class="form-group col-sm-6 col-md-6">
                    <label for="dimensiones">Fecha Ultimo Mantenimiento</label>
                    <input id="fecha_ultimo_mantenimiento" name="fecha_ultimo_mantenimiento" type="date" class="form-control" data-bind="value: fecha_ultimo_mantenimiento">
                </div>
            </div>
            <div class="form-group">
                <p class="text-center">
                    <button type="button" class="btn btn-info" data-bind="click:  model.equipoController.guardar"><i class="fa fa-save"></i> Guardar</button>
                    <button type="button" class="btn btn-danger" data-bind="click:  model.equipoController.cancelar"><i class="fa fa-undo"></i> Cancel</button>
                </p>
            </div>
        </form>
    </div>

            </div>
        </div>

<script>
        $(document).ready(function () {
            model.equipoController.initialize();
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