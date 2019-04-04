<?php 
session_start(); 
require_once "../modelos/Usuario.php";
require_once "../modelos/Rol.php";

$usuario = new Usuario();
$rol = new Rol();

$idUsuario=isset($_POST["idUsuario"])? limpiarCadena($_POST["idUsuario"]):"";
$username=isset($_POST["username"])? limpiarCadena($_POST["username"]):"";
$email=isset($_POST["email"])? limpiarCadena($_POST["email"]):"";
$idRol=isset($_POST["idRol"])? limpiarCadena($_POST["idRol"]):"";
$password=isset($_POST["password"])? limpiarCadena($_POST["password"]):"";
$idEmpleado=isset($_POST["idEmpleado"])? limpiarCadena($_POST["idEmpleado"]):"";

switch ($_GET["op"]){
	case 'guardaryeditar':
	    $password = hash('sha256',$password);
		if (empty($idUsuario)){
			$rspta=$usuario->insertar($username,$email,$password,$idRol,$idEmpleado);
			echo $rspta ? "Usuario ingresado" : "No se pudo ingresar Usuario";
		}
		else {
			$rspta=$usuario->editar($idUsuario,$username,$email,$password,$idRol,$idEmpleado);
			echo $rspta ? "Registro actualizado" : "error! no se pudo actualizar";
		}
	break;

	case 'desactivar':
		$rspta=$usuario->desactivar($idUsuario);
 		echo $rspta ? "Usuario eliminado" : " no se pudo eliminar usuario";
	break;

	case 'activar':
		$rspta=$usuario->activar($idUsuario);
 		echo $rspta ? "Usuario activado" : " no se puede activar usuario";
	break;

	case 'mostrar':
		$rspta=$usuario->mostrar($idUsuario);
 		//Codificar el resultado utilizando json
 		echo json_encode($rspta);
	break;

	case 'listar':

		$rspta=$usuario->listar();

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
		$rspta=$usuario->verificar($logina, $clavehash);
		
		$fetch=$rspta->fetch_object();

		if (isset($fetch))
	    {
	        //Declaramos las variables de sesión
	        $_SESSION['idUsuario']=$fetch->idUsuario;
	        $_SESSION['idRol']=$fetch->idRol;
	        $_SESSION['nombre']=$fetch->primer_nombre;

         	        //Obtenemos los permisos del usuario
	    	$marcados = $rol->ListarPermisos($fetch->idRol);

	    	//Declaramos el array para almacenar todos los permisos marcados
			$valores=array();

			//Almacenamos los permisos marcados en el array
			while ($per = $marcados->fetch_object())
				{
					array_push($valores, $per->codigo);
				}

			//Determinamos los accesos del usuario
			in_array('pr-esc',$valores)?$_SESSION['Escritorio']=1:$_SESSION['Escritorio']=0;
			in_array('pr-prod',$valores)?$_SESSION['Productos']=1:$_SESSION['Productos']=0;
			in_array('pr-equ',$valores)?$_SESSION['Equipos']=1:$_SESSION['Equipos']=0;
			in_array('pr-con',$valores)?$_SESSION['Consignatarios']=1:$_SESSION['Consignatarios']=0;
			in_array('pr-tbuq',$valores)?$_SESSION['Tipo_Buques']=1:$_SESSION['Tipo_Buques']=0;
			in_array('pr-buq',$valores)?$_SESSION['Buques']=1:$_SESSION['Buques']=0;
			in_array('pr-empl',$valores)?$_SESSION['Empleados']=1:$_SESSION['Empleados']=0;
			in_array('pr-trans',$valores)?$_SESSION['Transportistas']=1:$_SESSION['Transportistas']=0;
			in_array('pr-pil',$valores)?$_SESSION['Pilotos']=1:$_SESSION['Pilotos']=0;
			in_array('pr-tiptrans',$valores)?$_SESSION['Tipo_Transportes']=1:$_SESSION['Tipo_Transportes']=0;
			in_array('pr-transport',$valores)?$_SESSION['Transportes']=1:$_SESSION['Transportes']=0;
			in_array('pr-plan',$valores)?$_SESSION['Planificacion']=1:$_SESSION['Planificacion']=0;
			in_array('pr-desp',$valores)?$_SESSION['Despachos']=1:$_SESSION['Despachos']=0;
			in_array('pr-sal',$valores)?$_SESSION['Salidas']=1:$_SESSION['Salidas']=0;
			in_array('pr-accs',$valores)?$_SESSION['Acceso']=1:$_SESSION['Acceso']=0;
			in_array('pr-rep',$valores)?$_SESSION['Reportes']=1:$_SESSION['Reportes']=0;
	    }

	    echo json_encode($fetch);
	break;
}

?>