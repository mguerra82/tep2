<?php 
require_once "../modelos/AsignacionPlano.php";

$asignacion = new Asignacion();

$idDetalle_asignacion=isset($_POST["idDetalle_asignacion"])? limpiarCadena($_POST["idDetalle_asignacion"]):"";
$idDetalle_Plano=isset($_POST["idDetalle_Plano"])? limpiarCadena($_POST["idDetalle_Plano"]):"";
$idConsignatario=isset($_POST["idConsignatario"])? limpiarCadena($_POST["idConsignatario"]):"";
$idTransportista=isset($_POST["idTransportista"])? limpiarCadena($_POST["idTransportista"]):"";
$idPiloto=isset($_POST["idPiloto"])? limpiarCadena($_POST["idPiloto"]):"";
$idTransporte=isset($_POST["idTransporte"])? limpiarCadena($_POST["idTransporte"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idDetalle_asignacion)){
			$rspta=$asignacion->insertar($idDetalle_Plano,$idConsignatario,$idTransportista,$idPiloto,$idTransporte,$codigo);

			echo $rspta ? "Asignacion registrada" : "no se pudo registrar asignacion";
		}
		else {
			$rspta=$asignacion->editar($idDetalle_asignacion,$idDetalle_Plano,$idConsignatario,$idTransportista,$idPiloto,$idTransporte,$codigo);
			echo $rspta ? "Asignacion actualizada" : "Asignacion no se pudo actualizar";
		}
	break;

	case 'eliminar':
		$rspta=$asignacion->desactivar($idDetalle_Plano, $idDetalle_asignacion);
 		echo $rspta ? "Asignacion Eliminada" : "Asignacion no se puede eliminar";
	break;


	case 'mostrar':
		$rspta=$asignacion->mostrar($idDetalle_asignacion);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'contar':
		$rspta=$asignacion->contarAsignaciones();
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		$rspta=$asignacion->listar();
 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;
}

?>
