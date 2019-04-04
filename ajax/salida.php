<?php 
require_once "../modelos/Salida.php";

$salida = new Salida();

$idSalida=isset($_POST["idSalida"])? limpiarCadena($_POST["idSalida"]):"";
$idDespacho=isset($_POST["idDespacho"])? limpiarCadena($_POST["idDespacho"]):"";
$bl=isset($_POST["bl"])? limpiarCadena($_POST["bl"]):"";
$peso=isset($_POST["peso"])? limpiarCadena($_POST["peso"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idSalida)){
			$rspta=$salida->insertar($idDespacho,$bl,$peso);
			echo $rspta ? "Salida registrada" : "No se pudo registrar Salida";
		}
		else {
			$rspta=$salida->editar($idSalida,$bl,$peso);
			echo $rspta ? "Salida actualizado" : "Salida no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$salida->desactivar($idSalida);
 		echo $rspta ? "Piloto Desactivada" : "Piloto no se puede desactivar";
	break;

	case 'mostrar':
		$rspta=$salida->mostrar($idSalida);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
	    //$idEmpresa = $_GET["idEmpresa"];
		$rspta=$salida->listar();

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;
}

?>