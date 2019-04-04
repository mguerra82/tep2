<?php 
//IncluÃ­mos inicialmente la conexiÃ³n a la base de datos
require "../config/Conexion.php";

Class Empresa
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un mÃ©todo para insertar registros
	public function insertar($nombre,$nit,$razon_social,$direccion,$contacto,$telefono,$email,$tipoEmpresa,$password)
	{
		$sql="INSERT INTO empresa(nombre,nit,razon_social,direccion,contacto,telefono,email,tipoEmpresa,password,estado)
		VALUES ('$nombre','$nit','$razon_social','$direccion','$contacto','$telefono','$email','$tipoEmpresa','$password','A')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para editar registros
	public function editar($idEmpresa,$nombre,$nit,$razon_social,$direccion,$contacto,$telefono,$email,$tipoEmpresa,$password)
	{
		$sql="UPDATE empresa SET nombre='$nombre', nit='$nit', razon_social='$razon_social', direccion='$direccion',contacto='$contacto',telefono='$telefono', email='$email', tipoEmpresa='$tipoEmpresa',password='$password' WHERE idEmpresa='$idEmpresa'";
		
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para desactivar 
	public function desactivar($idEmpresa)
	{
		$sql="UPDATE empresa SET estado='I' WHERE idEmpresa='$idEmpresa'";
		return ejecutarConsulta($sql);
	}

	public function activar($idEmpresa)
	{
		$sql="UPDATE empresa SET estado='A' WHERE idEmpresa='$idEmpresa'";
		return ejecutarConsulta($sql);
	}

	//Implementar un mÃ©todo para mostrar los datos de un registro a modificar
	public function mostrar($idEmpresa)
	{
		$sql="SELECT * FROM empresa WHERE idEmpresa='$idEmpresa' AND estado='A'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un mÃ©todo para listar los registros
	public function listar($tipo)
	{
		$sql="SELECT * FROM empresa where tipoEmpresa='$tipo'";
		return ejecutarConsulta($sql);		
	}

    //listar todo
	public function listarTodo()
	{
		$sql="SELECT * FROM empresa where estado='A'";
		return ejecutarConsulta($sql);		
	}

	//Función para verificar el acceso al sistema
	public function verificar($login,$clave)
    {
    	$sql="SELECT * FROM empresa WHERE email='$login' AND password='$clave' AND estado='A'";
    
	return ejecutarConsulta($sql);  
    }
}

?>
