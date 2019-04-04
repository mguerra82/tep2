<?php 
//IncluÃ­mos inicialmente la conexiÃ³n a la base de datos
require "../config/Conexion.php";

Class Transporte
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un mÃ©todo para insertar registros
	public function insertar($nombre,$placa,$modelo,$idTipo_Transporte,$idEmpresa)
	{
		$sql="INSERT INTO transporte(nombre,placa,modelo,idTipo_Transporte,estado,idEmpresa)
		VALUES ('$nombre','$placa','$modelo','$idTipo_Transporte','A','$idEmpresa')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para editar registros
	public function editar($idTransporte,$nombre,$placa,$modelo,$idTipo_Transporte,$idEmpresa)
	{
		$sql="UPDATE transporte SET nombre='$nombre',placa='$placa',modelo='$modelo',idTipo_Transporte = $idTipo_Transporte, idEmpresa = '$idEmpresa' WHERE idTransporte='$idTransporte'";
		
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para desactivar categorÃ­as
	public function desactivar($idTrasporte)
	{
		$sql="UPDATE transporte SET estado='I' WHERE idTransporte='$idTrasporte'";
		return ejecutarConsulta($sql);
	}

	//Implementar un mÃ©todo para mostrar los datos de un registro a modificar
	public function mostrar($idTrasporte)
	{
		$sql="SELECT * FROM transporte WHERE idTransporte='$idTrasporte'";
		return ejecutarConsultaSimpleFila($sql);
	}

    public function listar()
	{
		$sql="SELECT t.idTransporte, t.nombre, t.placa, t.modelo, t.idTipo_Transporte, e.nombre as transportista FROM transporte t INNER JOIN tipo_transporte tt on t.idTipo_Transporte = tt.idTipo_Transporte inner join empresa e on t.idEmpresa = e.idEmpresa where t.estado='A'";
		return ejecutarConsulta($sql);		
	}

	//Implementar un mÃ©todo para listar los registros
	public function listarPorEmpresa($idEmpresa)
	{
		$sql="SELECT t.idTransporte, t.nombre, t.placa, t.modelo, t.idTipo_Transporte FROM transporte t INNER JOIN tipo_transporte tt on t.idTipo_Transporte = tt.idTipo_Transporte where t.estado='A' and tt.idEmpresa='$idEmpresa'";
		return ejecutarConsulta($sql);		
	}

		//Implementar un mÃ©todo para listar los  pilotos por transportista
	public function listarPorTransportista($idTransportista)
	{
		$sql="SELECT * FROM transporte where estado='A' and idEmpresa='$idTransportista'";
		return ejecutarConsulta($sql);		
	}
}

?>