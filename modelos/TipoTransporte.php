<?php 
//IncluÃ­mos inicialmente la conexiÃ³n a la base de datos
require "../config/Conexion.php";

Class TipoTransporte
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un mÃ©todo para insertar registros
	public function insertar($nombre,$descripcion)
	{
		$sql="INSERT INTO tipo_transporte (nombre,descripcion,estado)
		VALUES ('$nombre','$descripcion','A')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para editar registros
	public function editar($idTipo_Transporte,$nombre,$descripcion)
	{
		$sql="UPDATE tipo_transporte SET nombre='$nombre',descripcion='$descripcion' WHERE idTipo_Transporte='$idTipo_Transporte'";
		
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para desactivar categorÃ­as
	public function desactivar($idTipo_Transporte)
	{
		$sql="UPDATE tipo_transporte SET estado='I' WHERE idTipo_Transporte='$idTipo_Transporte'";
		return ejecutarConsulta($sql);
	}

	/*Implementamos un mÃ©todo para activar categorÃ­as
	public function activar($idcategoria)
	{
		$sql="UPDATE categoria SET condicion='1' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}*/

	//Implementar un mÃ©todo para mostrar los datos de un registro a modificar
	public function mostrar($idTipo_Transporte)
	{
		$sql="SELECT * FROM tipo_transporte WHERE idTipo_Transporte='$idTipo_Transporte'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un mÃ©todo para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM tipo_transporte where estado='A'";
		return ejecutarConsulta($sql);		
	}
}

?>