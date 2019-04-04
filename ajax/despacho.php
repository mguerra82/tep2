<?php 
require_once "../modelos/Despacho.php";

error_reporting(E_ERROR | E_PARSE);

$despacho = new Despacho();

$idDespacho=isset($_POST["idDespacho"])? limpiarCadena($_POST["idDespacho"]):"";
$idAsignacion=isset($_POST["idAsignacion"])? limpiarCadena($_POST["idAsignacion"]):"";
$idAlmeja=isset($_POST["idAlmeja"])? limpiarCadena($_POST["idAlmeja"]):"";
$idTolva=isset($_POST["idTolva"])? limpiarCadena($_POST["idTolva"]):"";
$codigo=isset($_POST["codigo"])? limpiarCadena($_POST["codigo"]):"";
$hora=isset($_POST["hora"])? limpiarCadena($_POST["hora"]):"";
$minuto=isset($_POST["minuto"])? limpiarCadena($_POST["minuto"]):"";
$segundo=isset($_POST["segundo"])? limpiarCadena($_POST["segundo"]):"";
$seccion_bodega=isset($_POST["seccion_bodega"])? limpiarCadena($_POST["seccion_bodega"]):"";
$fecha=isset($_POST["fecha"])? limpiarCadena($_POST["fecha"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idDespacho)){
			$rspta=$despacho->insertar($idAsignacion,$idAlmeja,$idTolva,$codigo,$hora,$minuto,$segundo,$seccion_bodega,$fecha,$_POST['motivo'],$_POST['horat'], $_POST['minutot'],$_POST['segundot']);
			echo $rspta ? "descarga ha sido realizada" : "nose no se pudo realizar descarga";
		}
		else {
			$rspta=$despacho->editar($despachoId,$idAsignacion,$codigo,$tiempo,$tiempo_muerto,$tiempo_real);
			echo $rspta ? "Despacho actualizado" : "Despacho no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$despacho->desactivar($idDespacho);
 		echo $rspta ? "despacho anulado" : "despacho no se puede anular";
	break;

	case 'getById':
		$rspta=$despacho->mostrar($idDespacho);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'contar':
		$rspta=$despacho->contarDespachos();
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'obtenerA':
	    $codigo = $_GET["codigo"];
		$rspta=$despacho->obtenerAsignacion($codigo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$despacho->listar();

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;

	case 'listarTiempoM':
	    $despachoId = $_GET["idDespacho"];
		$rspta=$despacho->ListarTiemposMuertos($despachoId);

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;

	case 'listarBodegas':
	    $idPlano = $_GET["idPlano_estiba"];
		$rspta=$despacho->ListarBodegas($idPlano);

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;

	case 'obtener':
	    $codigo = $_GET["codigo"];
		$rspta=$despacho->Obtener($codigo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;
}

?>