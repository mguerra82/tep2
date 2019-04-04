<?php 
//IncluÃ­mos inicialmente la conexiÃ³n a la base de datos
require "../config/Conexion.php";

Class TipoBuque
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un mÃ©todo para insertar registros
	public function insertar($nombre,$descripcion)
	{
		$sql="INSERT INTO tipo_buque (nombre,descripcion,estado)
		VALUES ('$nombre','$descripcion','A')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para editar registros
	public function editar($idTipo_Buque,$nombre,$descripcion)
	{
		$sql="UPDATE tipo_buque SET nombre='$nombre',descripcion='$descripcion' WHERE idTipo_Buque='$idTipo_Buque'";
		
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para desactivar categorÃ­as
	public function desactivar($idTipo_Buque)
	{
		$sql="UPDATE tipo_buque SET estado='I' WHERE idTipo_Buque='$idTipo_Buque'";
		return ejecutarConsulta($sql);
	}

	/*Implementamos un mÃ©todo para activar categorÃ­as
	public function activar($idcategoria)
	{
		$sql="UPDATE categoria SET condicion='1' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}*/

	//Implementar un mÃ©todo para mostrar los datos de un registro a modificar
	public function mostrar($idTipo_Buque)
	{
		$sql="SELECT * FROM tipo_buque WHERE idTipo_Buque='$idTipo_Buque'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un mÃ©todo para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM tipo_buque where estado='A'";
		return ejecutarConsulta($sql);		
	}
}

?>