<?php 
require_once "../modelos/Producto.php";

$producto = new Producto();

$idProducto=isset($_POST["idProducto"])? limpiarCadena($_POST["idProducto"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$descripcion=isset($_POST["descripcion"])? limpiarCadena($_POST["descripcion"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
		if (empty($idProducto)){
			$rspta=$producto->insertar($nombre,$descripcion);
			echo $rspta ? "Producto registrado" : "no se pudo registrar producto";
		}
		else {
			$rspta=$producto->editar($idProducto,$nombre,$descripcion);
			echo $rspta ? "Producto actualizado" : "Producto no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$producto->desactivar($idProducto);
 		echo $rspta ? "Producto Desactivado" : "Producto no se puede desactivar";
	break;

	case 'mostrar':
		$rspta=$producto->mostrar($idProducto);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
		$rspta=$producto->listar();

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }

	     echo json_encode($data);

	break;
}

?>