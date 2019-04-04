<?php 
require_once "../modelos/Transporte.php";

$transporte = new Transporte();

$idTransporte=isset($_POST["idTransporte"])? limpiarCadena($_POST["idTransporte"]):"";
$idTipo_Transporte=isset($_POST["idTipo_Transporte"])? limpiarCadena($_POST["idTipo_Transporte"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$placa=isset($_POST["placa"])? limpiarCadena($_POST["placa"]):"";
$modelo=isset($_POST["modelo"])? limpiarCadena($_POST["modelo"]):"";
$idEmpresa=isset($_POST["idEmpresa"])? limpiarCadena($_POST["idEmpresa"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idTransporte)){
			$rspta=$transporte->insertar($nombre,$placa,$modelo,$idTipo_Transporte,$idEmpresa);
			echo $rspta ? "Transporte registrada" : "no se pudo registrar transporte";
		}
		else {
			$rspta=$transporte->editar($idTransporte,$nombre,$placa,$modelo,$idTipo_Transporte,$idEmpresa);
			echo $rspta ? "Transporte actualizada" : "Transporte no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$transporte->desactivar($idTransporte);
 		echo $rspta ? "Transporte Desactivada" : "Transporte no se puede desactivar";
	break;

	case 'mostrar':
		$rspta=$transporte->mostrar($idTransporte);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		$rspta=$transporte->listar();
 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;

	case 'listarPorEmpresa':

	    $idEmpresa = $_GET["idEmpresa"];

		$rspta=$transporte->listar($idEmpresa);
 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;

	case 'listarT':
	    $idTransportista = $_GET["idTransportista"];

		$rspta=$transporte->listarPorTransportista($idTransportista);

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;
}

?>