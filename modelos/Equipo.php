<?php 
//IncluÃ­mos inicialmente la conexiÃ³n a la base de datos
require "../config/Conexion.php";

Class Equipo
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un mÃ©todo para insertar registros
	public function insertar($dimensiones,$fecha_ultimo_mantenimiento,$descripcion,$tipoEquipo)
	{
		//var_dump($dimensiones,$fecha_ultimo_mantenimiento,$descripcion,$tipoEquipo);
		$sql="INSERT INTO equipo (descripcion,dimensiones,estado,fecha_ultimo_mantenimiento,tipoEquipo)
		VALUES ('$descripcion','$dimensiones','A','$fecha_ultimo_mantenimiento','$tipoEquipo')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para editar registros
	public function editar($idEquipo,$dimensiones,$fecha_ultimo_mantenimiento,$descripcion,$tipoEquipo)
	{
		$sql="UPDATE equipo SET dimensiones='$dimensiones',fecha_ultimo_mantenimiento='$fecha_ultimo_mantenimiento',descripcion='$descripcion',tipoEquipo='$tipoEquipo' WHERE idEquipo='$idEquipo'";
		
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para desactivar categorÃ­as
	public function desactivar($idEquipo)
	{
		$sql="UPDATE equipo SET estado='I' WHERE idEquipo='$idEquipo'";
		return ejecutarConsulta($sql);
	}

	/*Implementamos un mÃ©todo para activar categorÃ­as
	public function activar($idcategoria)
	{
		$sql="UPDATE categoria SET condicion='1' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}*/

	//Implementar un mÃ©todo para mostrar los datos de un registro a modificar
	public function mostrar($idEquipo)
	{
		$sql="SELECT * FROM equipo WHERE idEquipo='$idEquipo'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un mÃ©todo para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM equipo where estado='A'";
		return ejecutarConsulta($sql);		
	}

	public function listarByTipo($tipo)
	{
		$sql="SELECT * FROM equipo where estado='A' and tipoEquipo='$tipo'";
		return ejecutarConsulta($sql);		
	}
}

?>