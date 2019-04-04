<?php 
//IncluÃ­mos inicialmente la conexiÃ³n a la base de datos
require "../config/Conexion.php";

Class Usuario
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un mÃ©todo para insertar registros
	public function insertar($username,$email,$password,$idRol,$idEmpleado)
	{
		$sql="INSERT INTO usuario(username,email,password,idRol,idEmpleado,estado)
		VALUES ('$username','$email','$password','$idRol','$idEmpleado','A')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para editar registros
	public function editar($idUsuario,$username,$email,$password,$idRol,$idEmpleado)
	{
		$sql="UPDATE usuario SET username='$username', email='$email', password='$password', idRol='$idRol',idEmpleado='$idEmpleado' WHERE idUsuario='$idUsuario'";
		
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para desactivar 
	public function desactivar($idUsuario)
	{
		$sql="UPDATE usuario SET estado='I' WHERE idUsuario='$idUsuario'";
		return ejecutarConsulta($sql);
	}

	public function activar($idUsuario)
	{
		$sql="UPDATE usuario SET estado='A' WHERE idUsuario='$idUsuario'";
		return ejecutarConsulta($sql);
	}

	//Implementar un mÃ©todo para mostrar los datos de un registro a modificar
	public function mostrar($idUsuario)
	{
		$sql="SELECT * FROM usuario u INNER JOIN empleado e ON u.idEmpleado = e.idEmpleado WHERE u.idUsuario='$idUsuario'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un mÃ©todo para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM usuario u INNER JOIN empleado e ON u.idEmpleado = e.idEmpleado where u.estado='A'";
		return ejecutarConsulta($sql);		
	}

	//Función para verificar el acceso al sistema
	public function verificar($login,$clave)
    {
    	$sql="SELECT * FROM usuario u INNER JOIN empleado e ON u.idEmpleado = e.idEmpleado WHERE u.email='$login' OR u.username='$login' AND u.password='$clave' AND u.estado='A'";
	
	return ejecutarConsulta($sql);  
    }
}

?>
