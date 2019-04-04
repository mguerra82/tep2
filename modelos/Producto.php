<?php 
//IncluÃ­mos inicialmente la conexiÃ³n a la base de datos
require "../config/Conexion.php";

Class Producto
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un mÃ©todo para insertar registros
	public function insertar($nombre,$descripcion)
	{
		$sql="INSERT INTO producto (nombre,descripcion,estado)
		VALUES ('$nombre','$descripcion','A')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para editar registros
	public function editar($idProducto,$nombre,$descripcion)
	{
		$sql="UPDATE producto SET nombre='$nombre',descripcion='$descripcion' WHERE idProducto='$idProducto'";
		
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para desactivar categorÃ­as
	public function desactivar($idProducto)
	{
		$sql="UPDATE producto SET estado='I' WHERE idProducto='$idProducto'";
		return ejecutarConsulta($sql);
	}

	/*Implementamos un mÃ©todo para activar categorÃ­as
	public function activar($idcategoria)
	{
		$sql="UPDATE categoria SET condicion='1' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}*/

	//Implementar un mÃ©todo para mostrar los datos de un registro a modificar
	public function mostrar($idProducto)
	{
		$sql="SELECT * FROM producto WHERE idProducto='$idProducto'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un mÃ©todo para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM producto where estado='A'";
		return ejecutarConsulta($sql);		
	}
}

?>