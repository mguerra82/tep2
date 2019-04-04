<?php 
require_once "../modelos/Buque.php";

$buque = new Buque();

$idBuque=isset($_POST["idBuque"])? limpiarCadena($_POST["idBuque"]):"";
$idTipo_Buque=isset($_POST["idTipo_Buque"])? limpiarCadena($_POST["idTipo_Buque"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$no_bodegas= isset($_POST["no_bodegas"]) ? limpiarCadena ($_POST["no_bodegas"]):"";



switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idBuque)){
			$rspta=$buque->insertar($nombre,$idTipo_Buque,$no_bodegas);
			echo $rspta ? "Buque registrada" : "no se pudo registrar Buque";
		}
		else {
			$rspta=$buque->editar($idBuque,$nombre,$idTipo_Buque,$no_bodegas);
			echo $rspta ? "Buque actualizado" : "Buque no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$buque->desactivar($idBuque);
 		echo $rspta ? "Buque Desactivado" : "buque no se puede desactivar";
	break;

	case 'mostrar':
		$rspta=$buque->mostrar($idBuque);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		$rspta=$buque->listar();
 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }
	     echo json_encode($data);

	break;
}

?>