<?php 
//IncluÃ­mos inicialmente la conexiÃ³n a la base de datos
require "../config/Conexion.php";

Class Buque
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un mÃ©todo para insertar registros
	public function insertar($nombre,$idTipo_Buque,$no_bodegas)
	{
		$sql="INSERT INTO buque(nombre,idTipo_Buque,no_bodegas,estado)
		VALUES ('$nombre','$idTipo_Buque','$no_bodegas','A')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para editar registros
	public function editar($idBuque,$nombre,$idTipo_Buque,$no_bodegas)
	{
		$sql="UPDATE buque SET nombre='$nombre',idTipo_Buque = '$idTipo_Buque',no_bodegas='$no_bodegas' WHERE idBuque='$idBuque'";
		
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para desactivar categorÃ­as
	public function desactivar($idBuque)
	{
		$sql="UPDATE buque SET estado='I' WHERE idBuque='$idBuque'";
		return ejecutarConsulta($sql);
	}

	//Implementar un mÃ©todo para mostrar los datos de un registro a modificar
	public function mostrar($idBuque)
	{
		$sql="SELECT * FROM buque WHERE idBuque='$idBuque'";
		return ejecutarConsultaSimpleFila($sql);
	}

    public function listar()
	{
		$sql="SELECT b.no_bodegas,b.idBuque, b.nombre, b.idTipo_Buque, tb.nombre as tipoBuque  FROM buque b INNER JOIN tipo_buque tb on b.idTipo_Buque = tb.idTipo_Buque where b.estado='A'";
		return ejecutarConsulta($sql);		
	}

}

?>