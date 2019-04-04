<?php 
  //Activamos el almacenamiento en el buffer
ob_start();
session_start();

if (!isset($_SESSION["nombre"]))
{
	header("Location: Login.php");
}else{
	require_once("Header.php"); 
	if(isset($_SESSION["idUsuario"]) && $_SESSION["Despachos"] == 1)
     {
?>
	<link href="../public/Assets/css/style.css" rel="stylesheet">
	<!-- Page Content -->
	<div id="page-wrapper">
		<div class="container-fluid">
			<div data-bind="visible: model.despachoController.gridMode()">
				<div class="col-lg-12">
                        <h2 class="page-header">Despachos de carga
                        <a href="#" class="btn btn-success" data-bind="click: model.despachoController.nuevo"><i class="fa fa-plus-circle"></i> Agregar</a></h2>
                    </div>

                    <div class="row">
                        <div class="col-lg-12">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <span class="text-primary"><i class="fa fa-list"></i> Lista de despachos de carga</span>
                                </div>

                                
                   <div class="panel-body">
                    <div class="table-responsive">
                    	
					<table class="table table-hover">
						<thead>
							<tr>
								<th>Codigo Asignacion</th>
								<th>Horas</th>
								<th>Minutos</th>
								<th>Segundos</th>
								<th>Acciones</th>
							</tr>
						</thead>
						<tbody data-bind="dataTablesForEach : {
						data: model.despachoController.despachos,
						options: dataTableOptions}">
					<tr>
						<td data-bind="text: codigo"></td>
						<td><span data-bind="text: (hora < 10? '0'+hora: hora)"></span></td>
						<td><span data-bind="text: (minuto < 10? '0'+minuto: minuto)"></span></td>
						<td><span data-bind="text: (segundo < 10? '0'+segundo: segundo)"></span></td>
						<td>
							<a href="#" class="btn btn-primary btn-xs" data-bind="click: model.despachoController.view"><i class="fa fa-eye"></i></a>
							<a href="#" class="btn btn-danger btn-xs" data-bind="click: model.despachoController.remover"><i class="fa fa-trash-o"></i></a>
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

	<div data-bind="visible: model.despachoController.insertMode()">
		   <div class="form">
    <h3 class="page-header"> Despacho de carga</h3>
    <div class="row">
        
        <div class="form-group col-sm-3 col-md-3">
                    <input id="codigo" name="codigo" type="text" class="form-control" data-bind="value: model.despachoController.codigo"
                           data-error=".errorCodigo"
                           placeholder="ingrese codigo escaneado" 
                           minlength="" maxlength="100" required>
                    <span class="errorCodigo text-danger help-inline"></span>
        </div>
         <div class="col-sm-6 col-md-6">
                    <button type="button" class="btn btn-primary" data-bind="click:  model.despachoController.obtener"> Obtener</button>
                    <button type="button" class="btn btn-danger" data-bind="click:  model.despachoController.cancelar"><i class="fa fa-undo"></i> Volver</button>
            </div> 
    </div>      
   </div>
	 </div>

	 
	<div class="form-group pull-right container-fluid" data-bind="visible: model.despachoController.viewInfoDescarga()" >	
        <button type="button" class="btn btn-danger" data-bind="click:  model.despachoController.cancelar"><i class="fa fa-undo"></i> Volver</button>	
       </div>
       <div class="form-group"></div>

		<div class="row page-header" data-bind="with: model.despachoController.asignacion, visible: model.despachoController.viewInfo()">
			<!-- /.col-lg-4 -->
			<div class="col-lg-12" >
				<div class="panel panel-info">
					<div class="panel-heading">
						Informacion de asignacion
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-6 col-md-6">
								<h4>Buque: <span class="text-info" data-bind="text: buque"></span></h4>
							</div>
							<div>
								<h4>No Importacion: <span class="text-info" data-bind="text: no_importacion"></span></h4>
							</div>                       		
						</div>

						<div class="row">
							<div class="container">
								<h4><b>Informacion del transportista</b></h4>
							</div>
							<div class="col-lg-4 col-md-4">
								<h4>Nombre: <span class="text-info" data-bind="text: transportista"></span></h4>
							</div> 
							<div class="col-lg-4 col-md-4">
								<h4>Transporte: <span class="text-info" data-bind="text: transporte "></span></h4>
							</div>
							<div class="col-lg-4 col-md-4">
								<h4>Piloto: <span class="text-info" data-bind="text: piloto"></span></h4>
							</div>                       		
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="row page-header" data-bind="with: model.despachoController.despacho, visible: model.despachoController.viewInfoDescarga()" >
			<!-- /.col-lg-4 -->
			<div class="col-lg-12" >
				<div class="panel panel-info">
					<div class="panel-heading">
						Informacion de descarga
					</div>
					<div class="panel-body">
						<div class="row">
							<div class="col-lg-3 col-md-3">
								<h4>tiempo total: <span class="text-info" data-bind="text: model.despachoController.tiempoDescarga()"></span>
								</h4>
							</div>                      		
						</div>

						<div class="row">
							<div class="col-lg-3 col-md-3">
								<h4>tolva: <span class="text-info" data-bind="text: tolva"></span></h4>
							</div>
							<div class="col-lg-3 col-md-3">
								<h4>almeja: <span class="text-info" data-bind="text: almeja"></span></h4>
							</div> 
							<div class="col-lg-3 col-md-3">
								<h4>codigo: <span class="text-info" data-bind="text: codigo"></span></h4>
							</div>                       		
						</div>

					</div>
				</div>
			</div>
		</div>

		<div class="row page-header" data-bind="with: model.despachoController.tiempo_muerto, visible: model.despachoController.viewInfoTimeDie()" >
			<!-- /.col-lg-4 -->
			<div class="col-lg-12" >
				<div class="panel panel-info">
					<div class="panel-heading">
						Informacion sobre tiempos muertos
					</div>
					<div class="panel-body">
						<table class="table-hover table">
							<thead>
								<tr>
								  <th>Tiempo</th>
								  <th>Motivo</th>
								</tr>
							</thead>
							<tbody>
								<!-- ko foreach: {data: model.despachoController.tiemposMuertos, as: 'tiempo'} -->
								<tr>
									<td><span data-bind="text: (tiempo.hora < 10? '0'+tiempo.hora: tiempo.hora)"></span>:<span data-bind="text: (tiempo.minuto < 10? '0'+tiempo.minuto: tiempo.minuto)"></span>:<span data-bind="text: (tiempo.segundo < 10? '0'+tiempo.segundo: tiempo.segundo)"></span>
								  <td data-bind="text: motivo"></td>
								</tr>
								<!-- /ko-->
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
		</div>

         <div data-bind="visible: model.despachoController.insertInfo()">
         	<form name="despachoForm" id="despachoForm" class="form" data-bind="with: model.despachoController.despacho" method="POST">
				<div class="row">
					<!--<div class="form-group col-sm-3 col-md-3">
						<label for="bodega">Seccion Bodegas<span class="text-danger"> *</span></label>
						<select class="form-control" id="rol" data-bind="options: model.despachoController.secciones_bodegas, optionsText: 'nombre_seccion', optionsValue: 'seccion_bodega', value: seccion_bodega, event: { change: model.despachoController.selectSeccion(seccion_bodega())}"></select>
					</div>-->
					<div class="form-group col-sm-3 col-md-3">
						<label for="seccion_bodega">Seccion bodega<span class="text-danger"> *</span></label>
						<input id="seccion_bodega" name="seccion_bodega" type="text" class="form-control" data-bind="value: model.despachoController.asignacion.seccion_bodega()" readonly>
					</div>
					<div class="form-group col-sm-3 col-md-3">
						<label for="bodega">No Bodega<span class="text-danger"> *</span></label>
						<input id="bodega" name="bodega" type="text" class="form-control" data-bind="value: model.despachoController.asignacion.bodega()" readonly>
					</div>
					<div class="form-group col-sm-3 col-md-3">
						<label for="Consignatario">Consignatario<span class="text-danger"> *</span></label>
						<input id="producto" name="Consignatario" type="text" class="form-control" data-bind="value: model.despachoController.infoBodega.consignatario()" readonly>
					</div>
					<div class="form-group col-sm-3 col-md-3">
						<label for="producto">Producto<span class="text-danger"> *</span></label>
						<input id="producto" name="producto" type="text" class="form-control" data-bind="value: model.despachoController.infoBodega.producto()" readonly>
					</div>
					<div class="form-group col-sm-3 col-md-3">
						<label for="almeja">Almeja<span class="text-danger"> *</span></label>
						<select class="form-control" id="rol" data-bind="options: model.despachoController.almejas, optionsText: 'descripcion', optionsValue: 'idEquipo', value: idAlmeja"></select>
					</div>
					<div class="form-group col-sm-3 col-md-3">
						<label for="tolva">Tolva<span class="text-danger"> *</span></label>
						<select class="form-control" id="rol" data-bind="options: model.despachoController.tolvas, optionsText: 'descripcion', optionsValue: 'idEquipo', value: idTolva"></select>
					</div>
					<div class="form-group col-sm-3 col-md-3">
						<label for="bol">Codigo<span class="text-danger"> *</span></label>
						<input id="bl" name="bl" type="text" class="form-control" data-bind="value: codigo"
						data-error=".errorcodigo"
						minlength="3" maxlength="100" required readonly>
						<span class="errorcodigo text-danger help-inline"></span>
						<br &>
					<div id="qrcode"></div>
					</div>
					<div class="form-group col-sm-3 col-md-3"><br />
                    <button class="btn btn-primary" data-bind="click:  model.despachoController.generarCodigo"><i class="fa fa-qrcode"></i> Generar</button>

                </div>   
				</div>
			</form>
			<div class="">

				<button class="btn btn-primary pull-right" data-toggle="modal" data-target="#timeDie" data-bind="visible: !model.despachoController.isTimeDie()" class="btn btn-primary pull-right"><i class="fa fa-plus-circle"></i> agregar tiempo muerto</button>

				<div class="row">
					<div class="col-md-6 col-lg-6 col-sm-6">

						<div id="chrono-a" class="chrono">
							<h4>Tiempo Despacho</h4>
							<div class="chrono-container">
								<div class="chrono-hour">00</div>
								<div class="chrono-divider">:</div>
								<div class="chrono-minute">00</div>
								<div class="chrono-divider">:</div>
								<div class="chrono-second">00</div>                
							</div>
							<button class="chrono-start">Iniciar Descarga</button>
						</div>                			
					</div>


					<div type="button" data-bind="visible: model.despachoController.isTimeDie()" class="col-md-6 col-lg-6 col-sm-6">


						<div id="chrono-b" class="chrono">
							<h4>Tiempo Muerto</h4>
							<div class="chrono-container">
								<div class="chrono-hour">00</div>
								<div class="chrono-divider">:</div>
								<div class="chrono-minute">00</div>
								<div class="chrono-divider">:</div>
								<div class="chrono-second">00</div>                
							</div>
							<button class="chrono-start">Iniciar Tiempo Muerto</button>
						</div>                			
					</div>
				</div>
			</div>

			<div class="form-group">
				<p class="text-center">
					<button type="button" id="btn_guardar" class="btn btn-info" data-bind="click:  model.despachoController.guardar, disable: model.despachoController.stop()"><i class="fa fa-save"></i> Guardar</button>
					<button type="button" id="btn_cancelar" class="btn btn-danger" data-bind="click:  model.despachoController.cancelar"><i class="fa fa-undo"></i> Cancelar</button>
				</p>
			</div>
         </div>

</div>
</div>

<!-- Modal -->
<div id="timeDie" class="modal fade" role="dialog">
	<div class="modal-dialog">

		<!-- Modal content-->
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal">&times;</button>
				<h4 class="modal-title">Tiempo muerto</h4>
			</div>
			<div class="modal-body">
				<form id="formMuerto" name="formMuerto" data-bind="with: model.despachoController.tiempo_muerto">
					<div class="form-group">
						<label>Ingrese motivo</label>
						<textarea class="form-control" type="text" name="" rows="3" data-bind="value: motivo" data-error=".errorMotivo"required><span class="errorMotivo text-danger help-inline">Aceptar</textarea>
					</div>
					<div class="form-group">
						<button data-bind="click: model.despachoController.showTimeDie" type="button" class="btn btn-primary"> Aceptar</button>
						
					</div>
				</form>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal">Cerrar</button>
			</div>
		</div>

	</div>
</div>

<script>
	Chrono('#chrono-a');
	Chrono('#chrono-b');

	$(document).ready(function () {
		model.despachoController.initialize();
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