<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Rol
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($nombre,$permisos)
	{
		$sql="INSERT INTO rol(nombre,estado)
		VALUES ('$nombre','A')";
		//return ejecutarConsulta($sql);
		$idRolnew=ejecutarConsulta_retornarID($sql);

		$i=0;
		$sw=true;

		while ($i < count($permisos))
		{
			$sql_detalle = "INSERT INTO rol_permiso(idRol,idPermiso) VALUES('$idRolnew','$permisos[$i]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$i=$i + 1;
		}

		return $sw;
	}

		//Implementamos un método para editar registros
	public function editar($idRol,$nombre,$permisos)
	{

		$sql="UPDATE rol SET nombre='$nombre' WHERE idRol='$idRol'";
		ejecutarConsulta($sql);

		//Eliminamos todos los permisos asignados para volverlos a registrar
		$sqldel="DELETE FROM rol_permiso WHERE idRol='$idRol'";
		ejecutarConsulta($sqldel);

		$i=0;
		$sw=true;

		while ($i < count($permisos))
		{
			$sql_detalle = "INSERT INTO rol_permiso(idRol,idPermiso) VALUES('$idRol','$permisos[$i]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$i=$i + 1;
		}

		return $sw;
	}

	//Implementamos un método para desactivar 
	public function desactivar($idRol)
	{
		$sql="UPDATE rol SET estado='I' WHERE idRol='$idRol'";
		return ejecutarConsulta($sql);
	}
		//Implementamos un método para activar 
	public function activar($idRol)
	{
		$sql="UPDATE rol SET estado='A' WHERE idRol='$idRol'";
		return ejecutarConsulta($sql);
	}

	public function mostrar($idRol)
	{
		$sql="SELECT * from rol where idRol = '$idRol'";
		return ejecutarConsulta($sql);
	}

	public function listar()
	{
		$sql="SELECT * from rol";
		return ejecutarConsulta($sql);
	}

    public function listarActivos()
	{
		$sql="SELECT * from rol where estado='A'";
		return ejecutarConsulta($sql);
	}

	public function ListarPermisos($idRol)
	{
		$sql="SELECT rp.idPermiso, p.codigo from rol_permiso rp inner join permiso p on rp.idpermiso = p.idpermiso where rp.idRol='$idRol'";
		return ejecutarConsulta($sql);
	}	
}

?>
