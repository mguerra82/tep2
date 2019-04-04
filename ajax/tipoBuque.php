<?php 
require_once "../modelos/TipoBuque.php";

$tipoBuque = new TipoBuque();

$idTipo_Buque=isset($_POST["idTipo_Buque"])? limpiarCadena($_POST["idTipo_Buque"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idTipo_Buque)){
			$rspta=$tipoBuque->insertar($nombre,$descripcion);
			echo $rspta ? "Tipo Buque registrado" : "no se pudo registrar tipo buque";
		}
		else {
			$rspta=$tipoBuque->editar($idTipo_Buque,$nombre,$descripcion);
			echo $rspta ? "Tipo Buque actualizado" : "Tipo Buque no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$tipoBuque->desactivar($idTipo_Buque);
 		echo $rspta ? "Tipo Buque Desactivado" : "Tipo Buque no se puede desactivar";
	break;

	case 'mostrar':
		$rspta=$tipoBuque->mostrar($idTipo_Buque);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':


		$rspta=$tipoBuque->listar();
 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;
}

?>