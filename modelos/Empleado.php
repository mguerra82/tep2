<?php 
//IncluÃ­mos inicialmente la conexiÃ³n a la base de datos
require "../config/Conexion.php";

Class Empleado
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un mÃ©todo para insertar registros
	public function insertar($nit,$dpi,$primer_nombre,$segundo_nombre,$primer_apellido, $segundo_apellido,
		$direccion, $telefono,$idCargo)
	{
		$sql="INSERT INTO empleado(nit,dpi,primer_nombre,segundo_nombre,primer_apellido,segundo_apellido,direccion,telefono,idCargo,estado)
		VALUES ('$nit','$dpi','$primer_nombre','$segundo_nombre','$primer_apellido','$segundo_apellido','$direccion','$telefono','$idCargo','A')";
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para editar registros
	public function editar($idEmpleado,$nit,$dpi,$primer_nombre,$segundo_nombre,$primer_apellido, $segundo_apellido,
		$direccion, $telefono,$idCargo)
	{
		$sql="UPDATE empleado SET nit='$nit',dpi='$dpi', primer_nombre='$primer_nombre',
		      segundo_nombre='$segundo_nombre',primer_apellido='$primer_apellido', segundo_apellido='$segundo_apellido',direccion='$direccion',telefono='$telefono',idCargo='$idCargo' WHERE idEmpleado='$idEmpleado'";
		
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para desactivar categorÃ­as
	public function desactivar($idEmpleado)
	{
		$sql="UPDATE empleado SET estado='I' WHERE idEmpleado='$idEmpleado'";
		return ejecutarConsulta($sql);
	}

	/*Implementamos un mÃ©todo para activar categorÃ­as
	public function activar($idcategoria)
	{
		$sql="UPDATE categoria SET condicion='1' WHERE idcategoria='$idcategoria'";
		return ejecutarConsulta($sql);
	}*/

	//Implementar un mÃ©todo para mostrar los datos de un registro a modificar
	public function mostrar($idEmpleado)
	{
		$sql="SELECT * FROM empleado WHERE idEmpleado='$idEmpleado'";
		return ejecutarConsultaSimpleFila($sql);
	}

	//Implementar un mÃ©todo para listar los registros
	public function listar()
	{
		$sql="SELECT * FROM empleado e inner join cargo c on e.idCargo = c.idCargo where e.estado='A'";
		return ejecutarConsulta($sql);		
	}
}

?>