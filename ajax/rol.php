<?php
session_start(); 
require_once "../modelos/Rol.php";

$rol=new Rol();

$idRol=isset($_POST["idRol"])? limpiarCadena($_POST["idRol"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':

		if (empty($idRol)){
			$rspta=$rol->insertar($nombre,$_POST['permiso']);
			echo $rspta ? "Rol registrado" : "No se pudieron registrar todos los datos del rol";
		}
		else {
			$rspta=$rol->editar($idRol,$nombre,$_POST['permiso']);
			echo $rspta ? "Rol actualizado" : "Rol no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$rol->desactivar($idRol);
 		echo $rspta ? "Rol Desactivado" : "Rol no se puede desactivar";
	break;

	case 'activar':
		$rspta=$rol->activar($idRol);
 		echo $rspta ? "Rol activado" : "Rol no se puede activar";
	break;

	case 'mostrar':
		$rspta=$rol->mostrar($idRol);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listarA':
		$rspta=$rol->listarActivos();

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;

	case 'listar':
		$rspta=$rol->listar();

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;

		case 'listarP':
		$idRol= $_GET["idRol"];
		$rspta=$rol->ListarPermisos($idRol);

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;

}
?>