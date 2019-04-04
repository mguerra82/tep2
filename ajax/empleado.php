<?php 
require_once "../modelos/Empleado.php";

$empleado = new Empleado();

$idEmpleado=isset($_POST["idEmpleado"])? limpiarCadena($_POST["idEmpleado"]):"";
$nit=isset($_POST["nit"])? limpiarCadena($_POST["nit"]):"";
$dpi=isset($_POST["dpi"])? limpiarCadena($_POST["dpi"]):"";
$primer_nombre=isset($_POST["primer_nombre"])? limpiarCadena($_POST["primer_nombre"]):"";
$segundo_nombre=isset($_POST["segundo_nombre"])? limpiarCadena($_POST["segundo_nombre"]):"";
$primer_apellido=isset($_POST["primer_apellido"])? limpiarCadena($_POST["primer_apellido"]):"";
$segundo_apellido=isset($_POST["segundo_apellido"])? limpiarCadena($_POST["segundo_apellido"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$idCargo=isset($_POST["idCargo"])? limpiarCadena($_POST["idCargo"]):"";
//$foto=isset($_POST["foto"])? limpiarCadena($_POST["foto"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
	  /* if (!file_exists($_FILES['foto']['tmp_name']) || !is_uploaded_file($_FILES['foto']['tmp_name']))
		{
			//$imagen=$_POST["imagenactual"];
		}
		else 
		{
			$ext = explode(".", $_FILES["foto"]["name"]);
			if ($_FILES['foto']['type'] == "image/jpg" || $_FILES['foto']['type'] == "image/jpeg" || $_FILES['foto']['type'] == "image/png")
			{
				$imagen = round(microtime(true)) . '.' . end($ext);
				move_uploaded_file($_FILES["foto"]["tmp_name"], "../files/empleados/" . $foto);
			}
		}*/
		if (empty($idEmpleado)){
			$rspta=$empleado->insertar($nit,$dpi,$primer_nombre,$segundo_nombre,$primer_apellido,$segundo_apellido,
		       $direccion, $telefono,$idCargo);
			echo $rspta ? "empleado registrado" : 'empleado no se pudo registrar';
		}
		else {
			$rspta=$empleado->editar($idEmpleado,$nit,$dpi,$primer_nombre,$segundo_nombre,$primer_apellido, $segundo_apellido,
		        $direccion, $telefono,$idCargo);
			echo $rspta ? "Empleado actualizado" : "Empleado no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$empleado->desactivar($idEmpleado);
 		echo $rspta ? "Empleado Desactivada" : "Empleado no se puede desactivar";
	break;

	case 'mostrar':
		$rspta=$empleado->mostrar($idEmpleado);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$empleado->listar();

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;
}

?>