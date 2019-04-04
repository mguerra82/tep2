<?php 
  //Activamos el almacenamiento en el buffer
    ob_start();
    session_start();

    if (!isset($_SESSION["nombre"]))
    {
      header("Location: Login.php");
    }else{
      require_once("Header.php"); 
      if(isset($_SESSION["idUsuario"]) && $_SESSION["Planificacion"] == 1)
      {
?>
       <!-- Page Content -->
        <div id="page-wrapper">
          <div class="row">
            
            <div class="">
              <div data-bind="visible: model.planificacionController.gridMode()">
               <div class="col-lg-12">
                        <h2 class="page-header">Planificacion 
                        <a href="#" class="btn btn-success" data-bind="click: model.planificacionController.nuevo" data-toggle="modal" data-target="#planificacion"><i class="fa fa-plus-circle"></i> Agregar</a></h2>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="text-primary"><i class="fa fa-list"></i> Lista de planificaciones</span>
                                </div>
                                
                      <div class="panel-body">
                        <div class="table-responsive">
                          
                        <table id="cargoGrid" class="table table-hover">
                                <thead>
                                    <tr>
                                        <th>No.Importacion</th>
                                        <th>Buque</th>
                                        <th>Peso Total</th>
                                        <th>Estado</th>
                                        <th>Acciones</th>
					<th>Codigos QR</th>
                                    </tr>
                                </thead>
                                <tbody data-bind="dataTablesForEach : {
                                                    data: model.planificacionController.planos,
                                                    options: dataTableOptions
                                                  }">
                                    <tr>
                                        <td data-bind="text: no_importacion "></td>
                                        <td data-bind="text: buque"></td>
                                        <td data-bind="text: peso_total"></td>
                                        <td><span class="label" data-bind="text: (estado === 'I' ? 'Iniciado' : 'En proceso'), css: (estado === 'I' ? 'label-info' : 'label-success')"></span></td>
                                        <td>
                                          <a href="#" class="btn btn-primary btn-xs" data-bind="click:model.planificacionController.asignacionBodegas "><i class="fa fa-plus-circle"></i> Asignar bodegas</a>

                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click:model.planificacionController.remover"><i class="fa fa-trash-o"></i></a>
                                        </td>
                                        <td>
                                            <a href="#" class="btn btn-info btn-xs" data-bind="click:model.planificacionController.imprimirQR " targe><i class="fa fa-qrcode" aria-hidden="true"></i> QR Asignación</a>

                                            <a href="#" class="btn btn-success btn-xs"  data-bind="click:model.planificacionController.imprimirDes" targe><i class="fa fa-qrcode" aria-hidden="true"></i> QR Despacho</a>
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
            </div>

                      <!-- Formulario de registro  -->
            <div class="form-group"> </div>
                <div class="form-group"> </div>
                <div data-bind="visible:model.planificacionController.insertMode()">
                      <ul class="nav nav-tabs">
                        <li class="active"><a data-toggle="tab" href="#plano">Plano de estiba</a></li>
                        <li id="at"><a data-toggle="tab" href="#transporte">Asignacion Transportista</a></li>
                      </ul>

                  <div class="form-group"></div><hr />


                      <!--Encabezado del plano de estiba -->
                <div>
                  <h3 class="page-header">Plano de Estiba <a href="#" class="btn btn-danger" data-bind="click: model.planificacionController.cancelar, visible: model.planificacionController.showSelectBodega()"><i class="fa fa-undo"></i> Volver</a></h3>
                </div>
                        <div class="tab tab-pane" data-bind="visible:model.planificacionController.showHead()">
                          <div class="col-lg-12">
                                  <div class="panel panel-default">
                                      <div class="panel-heading">
                                          Planificacion
                                      </div>
                                      <!-- /.panel-heading -->
                                      <div class="panel-body">
                                          <div class="form-group col-sm-3 col-md-3">
                                            <label>Numero de Importacion</label>
                                              <h1 class="text-info" data-bind="text: model.planificacionController.plano.no_importacion()" for="no_importacion"></h1>
                                          </div> 

                                          <div class="form-group col-sm-3 col-md-3">
                                            <label>Buque</label>
                                              <h1 class="text-info"  data-bind="text: model.planificacionController.buque()"></h1>
                                          </div>


                                          <div class="form-group col-sm-3 col-md-3">
                                            <label>Peso Total:</label>
                                              <h1 class="text-info"  data-bind="text: model.planificacionController.plano.peso_total().toFixed(2)" for="no_importacion"></h1>
                                          </div>

                                             <div class="form-group col-sm-3 col-md-3">
                                                <label class="text-right"> Numero de Bodegas</label>
                                                <h1 class="text-info"  data-bind="text: model.planificacionController.no_bodegas()" ></h1>
                                              </div>  
                                      </div>
                                    </div>
                                      <!-- /.panel-body -->
                                  </div>
                                        <!-- /.panel -->
                                 </div>                             
                            

                      <div class="tab-content">
                        <div id="plano" class="tab-pane fade in active">

                          <div>

                            <div data-bind="visible: model.planificacionController.showSelectBodega(), with: model.planificacionController.detalle">
                               <h5 class="page-header">Seleccione bodega</h5>
                                 <div class="from">
                                    <div class="form-group col-sm-4 col-md-4">
                                              <select class="form-control" id="rol" data-bind="options: model.planificacionController.bodegas, optionsText: 'seccion_bodega', optionsValue: 'bodega', value: bodega"></select>
                                     </div>  

                                  <div class="form-group col-md-4 col-sm-4">
                                    <button type="button" class="btn btn-primary" data-bind="click:  model.planificacionController.bodega"><i class="fa fa-arrow-right"></i> Seleccionar</button>
                                  </div>                                  
                                 </div>                              
                            </div>

                                <div data-bind="visible:model.planificacionController.showDetalle()">
                                  <div class="col-lg-12">
                                    <h4 class="page-header">Detalle Bodega<span data-bind="text: model.planificacionController.detalle.bodega()"></span></h4>
                                  </div>
                                  <form name="detalleForm" id="detalleForm" class="form" data-bind="with: model.planificacionController.detalle">
                                    <div class="row">
                                      <div class="form-group col-sm-2 col-md-2">
                                            <label for="seccion_bodega">Seccion bodega<span class="text-danger"> *</span></label>
                                            <input id="peso" name="peso" type="number" class="form-control" data-bind="value: seccion_bodega"
                                                   data-error=".seccion_bodega" required>
                                            <span class="seccion_bodega text-danger help-inline"></span>
                                        </div>
                                        <div class="form-group col-sm-3 col-md-3">
                                            <label for="buque">Producto<span class="text-danger"> *</span></label>
                                              <select class="form-control" id="rol" data-bind="options: model.planificacionController.productos, optionsText: 'nombre', optionsValue: 'idProducto', value: idProducto"></select>
                                        </div>
                                        <div class="form-group col-sm-2 col-md-2">
                                            <label for="peso_bodega">Peso<span class="text-danger"> *</span></label>
                                            <input id="peso" name="peso" type="number" class="form-control" data-bind="value: peso"
                                                   data-error=".peso" required>
                                            <span class="peso text-danger help-inline"></span>
                                        </div>

                                        <div class="form-group col-sm-2 col-md-2"><br />
                                           <button type="button" class="btn btn-success" data-bind="click:  model.planificacionController.addDetalle"><i class="fa fa-plus-square"></i> Agregar</button>
                                        </div>
                                    </div>
                                </form>
                                  <br />
                                  <table class="table table-hover table-responsive table-bordered">
                                      <thead>
                                          <tr>
                                              <th>Seccion Bodega</th>
                                              <th>Producto</th>
                                              <th>Peso</th>
                                              <th>Acciones</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <!-- ko foreach: model.planificacionController.detalleBodega -->
                                      <tr>
                                        <td data-bind="text: seccion_bodega"></td>
                                        <td data-bind="text: producto"></td>
                                        <td data-bind="text: peso"></td>
                                        <td width="10%">
                                            <a href="#" class="btn btn-danger btn-xs" data-bind="click:model.planificacionController.removeDetalle"><i class="fa fa-minus"></i></a>
                                            <a href="#" class="btn btn-warning btn-xs" data-bind="click:model.planificacionController.editarBodega"><i class="fa fa-pencil"></i></a>
                                        </td>
                                    </tr>
                                    <!-- /ko -->
                                      </tbody>
                                  </table>  

                                  <div class="pull-right form-group">
                                    <h3 class="text-info">Peso total bodega <span data-bind="text: model.planificacionController.detalle.peso_bodega().toFixed(2)"></span> </h3>
                                  </div> 

                                  <button type="button" class="btn btn-primary" data-bind="click:  model.planificacionController.siguienteBodega"><i class="fa fa-arrow-right"></i> Seleccione sieguiente bodega</button>                               
                                </div>
                          
                          </div>
                        </div>

                        <div id="transporte" class="tab-pane fade">
                          <h5 class="page-header">Seleccione bodega para asignacion de consignatario y transportista</h3>
                               <div class="form">
                                     <div class="form-group col-sm-4 col-md-4">
                                              <select class="form-control" id="rol" data-bind="options: model.planificacionController.bodegasAsignacion, optionsText: 'seccion_bodega', optionsValue: 'bodega', value: model.planificacionController.bod"></select>
                                     </div>

                                      <div class="form-group col-sm-4 col-md-4 col-lg-6">
                                              <a href="#" class="btn btn-primary" data-bind="click:model.planificacionController.getDataBodegas"><i class="fa fa-arrow-right"></i>Seleccionar</a>                                        
                                      </div>
                               </div>



                                  <table class="table table-hover table-responsive table-bordered">
                                      <thead>
                                          <tr>
                                              <th>Bodega</th>
                                              <th>Producto</th>
                                              <th>Peso</th>
                                              <th>Estado</th>
                                              <th>Acciones</th>
                                          </tr>
                                      </thead>
                                      <tbody>
                                        <!-- ko foreach: model.planificacionController.detallesAsignacion -->
                                      <tr>
                                        <td data-bind="text: seccion_bodega"></td>
                                        <td data-bind="text: producto"></td>
                                        <td data-bind="text: peso"></td>
                                        <td><span class="label" data-bind="text: (estado === 'A' ? 'Asignado' : 'Sin asignar'), css: (estado === 'A' ? 'label-info' : 'label-warning')"></span></td>
                                        <td width="15%">
                                            <a href="#" data-toggle="modal" data-target="#asignacion" class="btn btn-primary btn-sm" data-bind="click:model.planificacionController.asignacionConsignatario"><i class="fa fa-address-card"></i> asignar</a>
                                        </td>
                                    </tr>
                                    <!-- /ko -->
                                      </tbody>
                                  </table>  
                        </div>
                      </div>
                </div>
                </div>
          </div>
        </div>

<!-- Modal -->
<div id="asignacion" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false" >
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Asignacion Plano de Estiba</h4><br />
        <div class="form-group">
          <label>Producto: <span data-bind="text: model.planificacionController.asignacion.producto()"></span></label><br />
          <label>Bodega no: <span data-bind="text: model.planificacionController.asignacion.bodega()"></span></label><br />
          <label>Seccion: <span data-bind="text: model.planificacionController.asignacion.seccion_bodega()"></span></label>
        </div>
      </div>
      <div class="modal-body">
          <form name="asignacionForm" id="asignacionForm" class="form" data-bind="with: model.planificacionController.asignacion">
            <div class="row">
                <div class="form-group col-sm-4 col-md-4">
                    <label for="consignatario">Consignatario<span class="text-danger"> *</span></label>
                      <select class="form-control" id="consignatario" data-bind="options: model.planificacionController.consignatarios, optionsText: 'nombre', optionsValue: 'idEmpresa', value: idConsignatario"></select>
                </div>
                 <div class="form-group col-sm-4 col-md-4">
                    <label for="transportista">Transportista<span class="text-danger"> *</span></label>
                      <select class="form-control" id="transportista" data-bind="options: model.planificacionController.transportistas, optionsText: 'nombre', optionsValue: 'idEmpresa', value: idTransportista, event: { change: model.planificacionController.getPilotos}"></select>
                </div>


                <div class="form-group col-sm-4 col-md-4">
                    <label for="transporte">Transporte<span class="text-danger"> *</span></label>
                      <select class="form-control" id="idTransporte" data-bind="options: model.planificacionController.transportes, optionsText: 'nombre', optionsValue: 'idTransporte', value: idTransporte"></select>
                </div>

                <div class="form-group col-sm-4 col-md-4">
                    <label for="piloto">Piloto<span class="text-danger"> *</span></label>
                      <select class="form-control" id="piloto" data-bind="options: model.planificacionController.pilotos, optionsText: function(type) {return type.nombre+ ' '+type.apellido}, optionsValue: 'idPiloto', value: idPiloto"></select>
                </div>
                <div class="form-group col-sm-4 col-md-4">
                    <label for="codigo">Codigo qr<span class="text-danger"> *</span></label>
                    <input id="codigo" name="codigo" type="text" class="form-control" data-bind="value: codigo"
                           data-error=".codigo" required disabled>
                    <span class="peso text-danger help-inline"></span>
                </div>

                <div class="form-group col-sm-3 col-md-3"><br />
                    <button class="btn btn-primary" data-bind="click:  model.planificacionController.generarCodigo"><i class="fa fa-qrcode"></i> Generar</button>
                </div>

                <div id="print" class="form-group col-sm-12 col-md-12">
		      <div id="qrcode" ></div>
                </div>
                <div class="form-group col-sm-12 col-md-12">
                  <input type="button" onclick="imprimir()" value="Imprimir Código"/>
                </div>
                <div class="form-group col-sm-12 col-md-12">
                    <p class="pull-right">
                        <button type="button" class="btn btn-info" data-bind="click:  model.planificacionController.guardarAsignacion"><i class="fa fa-save"></i> Guardar</button>
                    </p>
                </div> 
            </div>
        </form>

          <div>
            <h4>Asignaciones</h4>
          </div>

            <table class="table table-hover table-responsive table-bordered">
              <thead>
                  <tr>
                      <th>Secion Bodega</th>
                      <th>Producto</th>
                      <th>Consignatario</th>
                      <th>Transportista</th>
                      <th>Piloto</th>
                      <th>Acciones</th>
                  </tr>
              </thead>
              <tbody>
                <!-- ko foreach: model.planificacionController.asignaciones -->
              <tr>
                <td data-bind="text: seccion_bodega"></td>
                <td data-bind="text: producto"></td>
                <td data-bind="text: consignatario"></td>
                <td data-bind="text: transportista"></td>
                <td data-bind="text: piloto"></td>
                <td width="15%">
                    <a href="#" class="btn btn-warning btn-sm" data-bind="click:model.planificacionController.editarAsignacion"><i class="fa fa-pencil"></i></a>
                    <a href="#" class="btn btn-danger btn-sm" data-bind="click:model.planificacionController.removeAsignacion"><i class="fa fa-trash-o"></i></a>
                </td>
            </tr>
            <!-- /ko -->
              </tbody>
          </table>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Volver</button>
      </div>
    </div>

  </div>
</div>

<!-- Modal editar bodega -->
<div id="editBodega" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Editar Bodega</h4><br />
      </div>
      <div class="modal-body">
          <form name="asignacionForm" id="asignacionForm" class="form" data-bind="with: model.planificacionController.asignacion">
            <div class="row">
                    <div class="form-group col-sm-3 col-md-3">
                        <label for="seccion_bodega">Seccion Bodega<span class="text-danger"> *</span></label>
                        <input id="peso" name="seccion_bodega" type="text" class="form-control" data-bind="value: seccion_bodega"
                               data-error=".seccion_bodega" required>
                        <span class="seccion_bodega text-danger help-inline"></span>
                    </div>

                    <div class="form-group col-sm-3 col-md-3">
                        <label for="buque">Producto<span class="text-danger"> *</span></label>
                          <select class="form-control" id="rol" data-bind="options: model.planificacionController.productos, optionsText: 'nombre', optionsValue: 'idProducto', value: idProducto"></select>
                    </div>
                    <div class="form-group col-sm-3 col-md-3">
                        <label for="peso_bodega">Peso<span class="text-danger"> *</span></label>
                        <input id="peso" name="peso" type="number" class="form-control" data-bind="value: peso"
                               data-error=".peso" required>
                        <span class="peso text-danger help-inline"></span>
                    </div>

                <div class="form-group col-sm-12 col-md-12">
                    <p class="pull-right">
                        <button type="button" class="btn btn-info" data-bind="click:  model.planificacionController.guardarBodega" data-dismiss="modal"><i class="fa fa-save"></i> Guardar</button>
                    </p>
                </div> 
              </div>
        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Volver</button>
      </div>
    </div>

  </div>
</div>


<!-- Modal insertar nueva planificacion -->
<div id="planificacion" class="modal fade" role="dialog" data-backdrop="static" data-keyboard="false">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Nueva planificacion</h4><br />
      </div>
      <div class="modal-body">
      <form name="planoForm" id="planoForm" class="form" data-bind="with: model.planificacionController.plano">
        <div class="form-group"></div>
          <div class="row">
              <div class="form-group col-sm-6 col-md-6">
                  <label for="no_importacion">Numero Importacion<span class="text-danger"> *</span></label>
                  <input id="no_importacion" name="no_importacion" type="text" class="form-control" data-bind="value: no_importacion"
                         data-error=".no_importacion"
                         minlength="3" maxlength="100" required disabled>
                  <span class="no_importacion text-danger help-inline"></span>
              </div>
              <div class="form-group col-sm-6 col-md-6">
                  <label for="buque">Buque<span class="text-danger"> *</span></label>
                    <select class="form-control" id="rol" data-bind="options: model.planificacionController.buques, optionsText: 'nombre', optionsValue: 'idBuque', value: idBuque"></select>
              </div>
          <div class="form-group col-md-12">
              <p class="text-right">
                <button type="button" class="btn btn-info" data-bind="click:  model.planificacionController.Guardar"><i class="fa fa-save"></i> Guardar</button>
              </p>
          </div>  
          </div>                             
      </form>
      </div>
      <div class="modal-footer">
        <button type="button" data-bind="click:  model.planificacionController.cancelar" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-undo"></i> Volver</button>
      </div>
    </div>

  </div>
</div>



<script>
        $(document).ready(function () {
            model.planificacionController.initialize();
        });
function imprimir()
{
  $("#qrcode").printArea();
}

</script>

<?php  
   require_once("Footer.php");
   }else{
     header("Location: noacceso.php");
   }
}
   ob_end_flush();
?>
