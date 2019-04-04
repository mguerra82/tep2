<?php 
session_start(); 
require_once "../modelos/Empresa.php";

$empresa = new Empresa();

$idEmpresa=isset($_POST["idEmpresa"])? limpiarCadena($_POST["idEmpresa"]):"";
$nombre=isset($_POST["nombre"])? limpiarCadena($_POST["nombre"]):"";
$nit=isset($_POST["nit"])? limpiarCadena($_POST["nit"]):"";
$razon_social=isset($_POST["razon_social"])? limpiarCadena($_POST["razon_social"]):"";
$direccion=isset($_POST["direccion"])? limpiarCadena($_POST["direccion"]):"";
$contacto=isset($_POST["contacto"])? limpiarCadena($_POST["contacto"]):"";
$telefono=isset($_POST["telefono"])? limpiarCadena($_POST["telefono"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$tipoEmpresa=isset($_POST["tipoEmpresa"])? limpiarCadena($_POST["tipoEmpresa"]):"";
$password=isset($_POST["password"])? limpiarCadena($_POST["password"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
	    $password = hash('sha256',$password);
		if (empty($idEmpresa)){
			$rspta=$empresa->insertar($nombre,$nit,$razon_social,$direccion,$contacto,$telefono,$email,$tipoEmpresa,$password);
			echo $rspta ? "Registro ingresado" : "No se pudo ingresar Registro";
		}
		else {
			$rspta=$empresa->editar($idEmpresa,$nombre,$nit,$razon_social,$direccion,$contacto,$telefono,$email,$tipoEmpresa,$password);
			echo $rspta ? "Registro actualizado" : "error! no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$empresa->desactivar($idEmpresa);
 		echo $rspta ? "Registro Desactivada" : " no se puede desactivar";
	break;

	case 'activar':
		$rspta=$empresa->activar($idEmpresa);
 		echo $rspta ? "Registro Activado" : " no se puede activar";
	break;

	case 'mostrar':
		$rspta=$empresa->mostrar($idEmpresa);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':
	    $tipo= $_GET["tipo"];

		$rspta=$empresa->listar($tipo);

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }
	     echo json_encode($data);
	break;

	case 'listarTodo':

		$rspta=$empresa->listarTodo();

 		//Vamos a declarar un array
 		$data= Array();

        while($row = $rspta->fetch_assoc()){
		    array_push($data, $row);
	     }
	     echo json_encode($data);
	break;

	case 'verificar':
		$logina=$_POST['logina'];
	    $clavea=$_POST['clavea'];

	    //Hash SHA256 en la contraseña
		$clavehash=hash("SHA256",$clavea);
		$rspta=$empresa->verificar($logina, $clavehash);
		
		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['idEmpresa']=$fetch->idEmpresa;
	        $_SESSION['nombre']=$fetch->nombre;
	        $_SESSION['tipo']=$fetch->tipoEmpresa;
	    }

	    echo json_encode($fetch);
	break;

	case 'salir':
		//Limpiamos las variables de sesión   
        session_unset();
        //Destruìmos la sesión
        session_destroy();
        //Redireccionamos al login
        header("Location: ../index.php");
	break;
}

?>
