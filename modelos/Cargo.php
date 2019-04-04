<?php 
//IncluÃ­mos inicialmente la conexiÃ³n a la base de datos
require "../config/Conexion.php";

Class Cargo
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un mÃ©todo para insertar registros
	public function insertar($nombre,$descripcion)
	{
		$sql="INSERT INTO cargo (nombre,descripcion,estado)
		VALUES ('$nombre','$descripcion','A')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para editar registros
	public function editar($idCargo,$nombre,$descripcion)
	{
		$sql="UPDATE cargo SET nombre='$nombre',descripcion='$descripcion' WHERE idCargo='$idCargo'";
		
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para desactivar categorÃ­as
	public function desactivar($idCargo)
	{
		$sql="UPDATE cargo SET estado='I' WHERE idCargo='$idCargo'";
		return ejecutarConsulta($sql);
	}

	/*Implementamos un mÃ©todo para activar categorÃ­as
	public function activar($idcategoria)
	{
		$sql="UPDATE categoria SET condicion='1' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}*/

	//Implementar un mÃ©todo para mostrar los datos de un registro a modificar
	public function mostrar($idCargo)
	{
		$sql="SELECT * FROM cargo WHERE idCargo='$idCargo'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un mÃ©todo para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM cargo where estado='A'";
		return ejecutarConsulta($sql);		
	}
}

?>