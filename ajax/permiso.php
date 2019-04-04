<?php 
require_once "../modelos/Permiso.php";

$Permiso = new Permiso();


switch ($_GET["op"]){

	case 'listar':
		$rspta=$Permiso->listar();

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }
	     echo json_encode($data);
	break;
}

?>