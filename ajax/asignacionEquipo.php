<?php
session_start(); 
require_once "../modelos/AsignacionEquipo.php";

$asignacion=new AsignacionEquipo();

$idPlano=isset($_POST["idPlano"])? limpiarCadena($_POST["idPlano"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
			$rspta=$asignacion->editar($idPlano,$_POST['idEquipo']);
			echo $rspta ? "Equipo asignado" : "No se pudieron asignar el equipo";
	break;

	case 'listar':
	    $idPlano = $_GET['idPlano'];
		$rspta=$asignacion->listar($idPlano);

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;
}
?>