<?php 
require_once "../modelos/Equipo.php";

$equipo = new Equipo();

$idEquipo=isset($_POST["idEquipo"])? limpiarCadena($_POST["idEquipo"]):"";
$dimensiones=isset($_POST["dimensiones"])? limpiarCadena($_POST["dimensiones"]):"";
$fecha_ultimo_mantenimiento=isset($_POST["fecha_ultimo_mantenimiento"])? limpiarCadena($_POST["fecha_ultimo_mantenimiento"]):"";
$descripcion = isset($_POST["descripcion"])?limpiarCadena($_POST["descripcion"]):"";
$tipoEquipo = isset($_POST["tipoEquipo"])?limpiarCadena($_POST["tipoEquipo"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idEquipo)){
			$rspta=$equipo->insertar($dimensiones,$fecha_ultimo_mantenimiento,$descripcion,$tipoEquipo);
			echo $rspta ? "Equipo registrado" : "no se pudo registrar equipo";
		}
		else {
			$rspta=$equipo->editar($idEquipo,$dimensiones,$fecha_ultimo_mantenimiento,$descripcion,$tipoEquipo);
			echo $rspta ? "Equipo actualizado" : "Equipo no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$equipo->desactivar($idEquipo);
 		echo $rspta ? "Equipo Desactivado" : "Equipo no se puede desactivar";
	break;

	case 'mostrar':
		$rspta=$equipo->mostrar($idEquipo);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$equipo->listar();

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;

	case 'listarByTipo':
	    $tipo = $_GET["tipo"];
		$rspta=$equipo->listarByTipo($tipo);

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;
}

?>