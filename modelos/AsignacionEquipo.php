<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class AsignacionEquipo
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($idPlano,$idEquipo)
	{

		$i=0;
		$sw=true;

		while ($i < count($idEquipo))
		{
			$sql = "INSERT INTO asignacion_equipo(idPlano,idEquipo)VALUES('$idPlano','$idEquipo[$i]')";
			ejecutarConsulta($sql) or $sw = false;
			$i=$i + 1;
		}

		if($sw){
			$sql2 = "UPDATE plano_estiba set estado = 'E' where idPlano_Estiba = '$idPlano'";
			ejecutarConsulta($sql2);
		}

		return $sw;
	}

		//Implementamos un método para editar registros
	public function editar($idPlano,$idEquipo)
	{
		//Eliminamos todos los equipos asignados para volverlos a registrar
		$sqldel="DELETE FROM asignacion_equipo WHERE idPlano='$idPlano'";
		ejecutarConsulta($sqldel);

		$i=0;
		$sw=true;

		while ($i < count($idEquipo))
		{
			$sql_detalle = "INSERT INTO asignacion_equipo(idPlano,idEquipo) VALUES('$idPlano','$idEquipo[$i]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$i=$i + 1;
		}

	    if($sw){
			$sql2 = "UPDATE plano_estiba set estado = 'E' where idPlano_Estiba = '$idPlano'";
			ejecutarConsulta($sql2);
		}

		return $sw;
	}



	public function listar($idPlano)
	{
		$sql="SELECT * from asignacion_equipo where idPlano='$idPlano'";
		return ejecutarConsulta($sql);
	}	
}

?>