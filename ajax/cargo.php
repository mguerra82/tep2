<?php 
require_once "../modelos/Cargo.php";

$cargo = new Cargo();

$idCargo=isset($_POST["idCargo"])? limpiarCadena($_POST["idCargo"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idCargo)){
			$rspta=$cargo->insertar($nombre,$descripcion);
			echo $rspta ? "Cargo registrado" : "no se pudo registrar cargo";
		}
		else {
			$rspta=$cargo->editar($idCargo,$nombre,$descripcion);
			echo $rspta ? "Cargo actualizado" : "Cargo no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$cargo->desactivar($idCargo);
 		echo $rspta ? "cargo Desactivado" : "cargo no se puede desactivar";
	break;

	case 'mostrar':
		$rspta=$cargo->mostrar($idCargo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$cargo->listar();

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;
}

?>