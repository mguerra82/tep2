<?php
session_start(); 
require_once "../modelos/PlanoEstiba.php";

$plano = new Plano();

$idPlano_estiba=isset($_POST["idPlano_Estiba"])? limpiarCadena($_POST["idPlano_Estiba"]):"";
$no_importacion=isset($_POST["no_importacion"])? limpiarCadena($_POST["no_importacion"]):"";
$peso_total=isset($_POST["peso_total"])? limpiarCadena($_POST["peso_total"]):"";
$idBuque=isset($_POST["idBuque"])? limpiarCadena($_POST["idBuque"]):"";

$idDetalle_plano=isset($_POST["idDetalle_Plano"])? limpiarCadena($_POST["idDetalle_Plano"]):"";
$idProducto=isset($_POST["idProducto"])? limpiarCadena($_POST["idProducto"]):"";
$bodega=isset($_POST["bodega"])? limpiarCadena($_POST["bodega"]):"";
$seccion_bodega=isset($_POST["seccion_bodega"])? limpiarCadena($_POST["seccion_bodega"]):"";
$peso=isset($_POST["peso"])? limpiarCadena($_POST["peso"]):"";


switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idPlano_estiba)){
			$rspta=$plano->insertar($no_importacion,$peso_total,$idBuque);
			echo $rspta ? "Buque y no de importacion registrado" : "no se pudo registrar importacion";
		}
	break;

	case 'guardardetalle':
		if (empty($idDetalle_plano)){
			$rspta=$plano->insertarDetalle($idPlano_estiba,$bodega,$seccion_bodega,$idProducto,$peso);
			echo $rspta ? "Bodega ha sido registrada" : "no se pudo registrar Bodega";
		}
		else {
			$rspta=$plano->editarDetalle($idDetalle_plano,$idPlano_estiba,$bodega,$seccion_bodega,$idProducto,$peso);
			echo $rspta ? "Bodega ha sido actualizada" : "No no se pudo actualizar bodega";
		}
	break;

	case 'editarBodega':
	     $idDetalle_plano = $_POST['idDetalle_plano'];
	     $seccion_bodega = $_POST['seccion_bodega'];
	     $idProducto = $_POST['idProducto'];
	     $peso = $_POST['peso'];

		$rspta=$plano->editarBodega($idDetalle_plano,$seccion_bodega,$idProducto,$peso);
 		echo $rspta ? "bodega actualizada" : "plano no se pudo actualizar";
	break;

	case 'desactivar':
		$rspta=$plano->desactivar($idPlano_estiba);
 		echo $rspta ? "plano de anulado correctamente" : "plano no se pudo eliminar";
	break;

	case 'updateTotal':
		$rspta=$plano->UpdateTotal($idPlano_estiba, $peso_total);
 		echo $rspta ? "plano activado" : "Plano no se puede activar";
	break;

	case 'mostrar':
		$rspta=$plano->mostrar($idPlano_estiba);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$plano->listar();

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;

	case 'listarD':
		$idPlano= $_GET["idPlano_estiba"];
		$bodega= $_GET["bodega"];

		$rspta=$plano->ListarDetalles($idPlano,$bodega);

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;

	case 'listarA':
		$idPlano= $_GET["idPlano_estiba"];
		$bodega= $_GET["bodega"];
		$seccion_bodega= $_GET["seccion_bodega"];

		$rspta=$plano->ListarAsignaciones($idPlano,$bodega,$seccion_bodega);

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;

	case 'listarC':
		$rspta=$plano->ListarCorrelativo();
		
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarB':
	    $idPlano= $_GET["idPlano_estiba"];
		$rspta=$plano->listarBodegas($idPlano);
 		//Codificar el resultado utilizando json
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);
	break;

	case 'listarNoA':
	    $idPlano= $_GET["idPlano_estiba"];
	    
		$rspta=$plano->ListarNoAsignados($idPlano);
 		//Codificar el resultado utilizando json
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);
	break;

	case 'listarDetalleBodegas':
	    $idPlano= $_GET["idPlano_estiba"];
	    
		$rspta=$plano->ListarDetalleBodegas($idPlano);
 		//Codificar el resultado utilizando json
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);
	break;

	case 'eliminarBodega':
		$rspta=$plano->EliminarBodega($idPlano_estiba, $seccion_bodega);
 		echo $rspta ? "bodega removida" : "bodega no se puede remover";
	break;

}
?>
