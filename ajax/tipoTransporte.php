<?php 
require_once "../modelos/TipoTransporte.php";

$tipoTransporte = new TipoTransporte();

$idTipo_Transporte=isset($_POST["idTipo_Transporte"])? limpiarCadena($_POST["idTipo_Transporte"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idTipo_Transporte)){
			$rspta=$tipoTransporte->insertar($nombre,$descripcion);
			echo $rspta ? "Tipo Transporte registrada" : "no se pudo registrar tipo transporte";
		}
		else {
			$rspta=$tipoTransporte->editar($idTipo_Transporte,$nombre,$descripcion);
			echo $rspta ? "Tipo Transporte actualizada" : "Tipo Transporte no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$tipoTransporte->desactivar($idTipo_Transporte);
 		echo $rspta ? "Tipo Transporte Desactivada" : "Tipo Transporte no se puede desactivar";
	break;

	case 'mostrar':
		$rspta=$tipoTransporte->mostrar($idTipo_Transporte);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':


		$rspta=$tipoTransporte->listar();
 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;
}

?>