<?php 
//IncluÃ­mos inicialmente la conexiÃ³n a la base de datos
require "../config/Conexion.php";

Class Piloto
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un mÃ©todo para insertar registros
	public function insertar($licencia,$dpi,$nombre,$apellido,$telefono,$idEmpresa)
	{
		$sql="INSERT INTO piloto(licencia,dpi,nombre,apellido,telefono,estado,idEmpresa)
		VALUES ('$licencia','$dpi','$nombre','$apellido','telefono','A','$idEmpresa')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para editar registros
	public function editar($idPiloto,$licencia,$dpi,$nombre,$apellido,$telefono,$idEmpresa)
	{
		$sql="UPDATE piloto SET licencia='$licencia',dpi='$dpi', nombre='$nombre',apellido='$apellido',telefono='$telefono',idEmpresa='$idEmpresa' WHERE idPiloto='$idPiloto'";
		
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para desactivar categorÃ­as
	public function desactivar($idPiloto)
	{
		$sql="UPDATE piloto SET estado='I' WHERE idPiloto='$idPiloto'";
		return ejecutarConsulta($sql);
	}

	/*Implementamos un mÃ©todo para activar categorÃ­as
	public function activar($idcategoria)
	{
		$sql="UPDATE categoria SET condicion='1' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}*/

	//Implementar un mÃ©todo para mostrar los datos de un registro a modificar
	public function mostrar($idPiloto)
	{
		$sql="SELECT * FROM piloto WHERE idPiloto='$idPiloto'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un mÃ©todo para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM piloto where estado='A'";
		return ejecutarConsulta($sql);		
	}

	//Implementar un mÃ©todo para listar los  pilotos por transportista
	public function listarPorTransportista($idTransportista)
	{
		$sql="SELECT * FROM piloto where estado='A' and idEmpresa='$idTransportista'";
		return ejecutarConsulta($sql);		
	}
}

?>