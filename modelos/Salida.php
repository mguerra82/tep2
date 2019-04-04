<?php 
//IncluÃ­mos inicialmente la conexiÃ³n a la base de datos
require "../config/Conexion.php";

Class Salida
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un mÃ©todo para insertar registros
	public function insertar($idDespacho,$bl,$peso)
	{
		$sql="INSERT INTO salida(idDespacho,bl,peso,estado)
		VALUES ('$idDespacho','$bl','$peso','A')";

		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para editar registros
	public function editar($idSalida,$bl,$peso)
	{
		$sql="UPDATE salida SET bl='$bl', peso='$peso' WHERE idSalida='$idSalida'";
		
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para desactivar categorÃ­as
	public function desactivar($idSalida)
	{
		$sql="UPDATE salida SET estado='E' WHERE idSalida='$idSalida'";
		return ejecutarConsulta($sql);
	}

	/*Implementamos un mÃ©todo para activar categorÃ­as
	public function activar($idcategoria)
	{
		$sql="UPDATE categoria SET condicion='1' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}*/

	//Implementar un mÃ©todo para mostrar los datos de un registro a modificar
	public function mostrar($idSalida)
	{
		$sql="SELECT * FROM salida WHERE idSalida='$idSalida'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un mÃ©todo para listar los registros
	public function listar()
	{
		$sql="SELECT s.idSalida, s.idDespacho, s.bl, s.peso, d.codigo, d.seccion_bodega, d.idAsignacion, d.codigo  FROM salida s inner join despacho d on s.idDespacho = d.idDespacho where s.estado='A'";
		return ejecutarConsulta($sql);		
	}
}

?>