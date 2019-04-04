<?php 
//IncluÃ­mos inicialmente la conexiÃ³n a la base de datos
require "../config/Conexion.php";



Class Asignacion
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un mÃ©todo para insertar registros
	public function insertar($idDetalle_Plano,$idConsignatario,$idTransportista,$idPiloto,$idTransporte,$codigo)
	{
		$sql="INSERT INTO detalle_asignacion(idDetalle_plano,idConsignatario,idTransportista,idPiloto,idTransporte,codigo)
		VALUES ('$idDetalle_Plano','$idConsignatario','$idTransportista','$idPiloto','$idTransporte','$codigo')";


		$query = ejecutarConsulta($sql);
		if($query){
        	$sql2="UPDATE detalle_plano set estado = 'A' where idDetalle_plano='$idDetalle_Plano'";	
		    $queryt2 =ejecutarConsulta($sql2);
		}

		return $query;
	}

	//Implementamos un mÃ©todo para editar registros
	public function editar($idDetalle_asignacion,$idDetalle_Plano,$idConsignatario,$idTransportista,$idPiloto,$idTransporte,$codigo)
	{
		$sql="UPDATE detalle_asignacion SET idDetalle_plano='$idDetalle_Plano',idConsignatario='$idConsignatario',idTransportista='$idTransportista',idPiloto = $idPiloto, idTransporte = $idTransporte, codigo ='$codigo' WHERE idDetalle_asignacion='$idDetalle_asignacion'";
		
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para desactivar categorÃ­as
	public function desactivar($idDetalle_Plano, $idDetalle_asignacion)
	{
		$sql="DELETE from detalle_asignacion where idDetalle_asignacion = '$idDetalle_asignacion'";
		$query = ejecutarConsulta($sql);

		if($query){
		   $sql3 = "SELECT * from detalle_asignacion where idDetalle_plano='$idDetalle_Plano'";
          
		   $rpta = ejecutarConsultaSimpleFila($sql3);

		   if($rpta == null){
		  	 	$sql2="UPDATE detalle_plano SET estado='I' WHERE idDetalle_plano='$idDetalle_Plano'";
		   		ejecutarConsulta($sql2);
		   }
		}

		return $query;
	}

	//Implementar un mÃ©todo para mostrar los datos de un registro a modificar
	public function mostrar($idDetalle_asignacion)
	{
		$sql="SELECT * FROM detalle_asignacion WHERE idDetalle_asignacion='$idDetalle_asignacion'";
		return ejecutarConsultaSimpleFila($sql);
	}

    public function listar()
	{
		$sql="SELECT * from detalle_asignacion";
		return ejecutarConsulta($sql);		
	}

	public function contarAsignaciones()
	{
		$sql = "SELECT count(*) as codigo from detalle_asignacion";
		return ejecutarConsultaSimpleFila($sql);
	}
}

?>
