<?php 
require_once "../modelos/Piloto.php";

$piloto = new Piloto();

$idPiloto=isset($_POST["idPiloto"])? limpiarCadena($_POST["idPiloto"]):"";
$licencia=isset($_POST["licencia"])? limpiarCadena($_POST["licencia"]):"";
$dpi=isset($_POST["dpi"])? limpiarCadena($_POST["dpi"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$apellido=isset($_POST["apellido"])? limpiarCadena($_POST["apellido"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$idEmpresa=isset($_POST["idEmpresa"])? limpiarCadena($_POST["idEmpresa"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idPiloto)){
			$rspta=$piloto->insertar($licencia,$dpi,$nombre,$apellido,$telefono,$idEmpresa);
			echo $rspta ? "Piloto registrado" : "No se pudo registrar Piloto";
		}
		else {
			$rspta=$piloto->editar($idPiloto,$licencia,$dpi,$nombre,$apellido,$telefono,$idEmpresa);
			echo $rspta ? "Piloto actualizado" : "Piloto no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$piloto->desactivar($idPiloto);
 		echo $rspta ? "Piloto Desactivada" : "Piloto no se puede desactivar";
	break;

	case 'mostrar':
		$rspta=$piloto->mostrar($idPiloto);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
	    //$idEmpresa = $_GET["idEmpresa"];
		$rspta=$piloto->listar();

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;

	case 'listarT':
	    $idTransportista = $_GET["idTransportista"];

		$rspta=$piloto->listarPorTransportista($idTransportista);

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;
}

?>