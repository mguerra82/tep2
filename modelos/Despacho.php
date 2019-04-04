
<?php 
//IncluÃ­mos inicialmente la conexiÃ³n a la base de datos
require "../config/Conexion.php";

Class Despacho
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un mÃ©todo para insertar registros
	public function insertar($idAsignacion,$idAlmeja,$idTolva,$codigo,$hora,$minuto,$segundo,$seccion_bodega,$fecha,$motivo,$horat,$minutot,$segundot)
	{
echo $seccion_bodega;
		$sql="INSERT INTO despacho(idAsignacion,idAlmeja,idTolva,codigo,hora,minuto,segundo,seccion_bodega,fecha,estado)
		VALUES ('$idAsignacion','$idAlmeja','$idTolva','$codigo','$hora','$minuto','$segundo','$seccion_bodega','$fecha','D')";
	echo $sql;	
	   $idDespacho=ejecutarConsulta_retornarID($sql);
		$i=0;
		$sw=true;

		while ($i < count($horat))
		{
			$sql_detalle = "INSERT INTO tiempo_muerto(idDespacho,motivo,hora,minuto,segundo) VALUES ('$idDespacho','$motivo[$i]','$horat[$i]','$minutot[$i]','$segundot[$i]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$i=$i + 1;
		}

		return $sw;
	}

	//Implementamos un mÃ©todo para editar registros
	public function editar($despachoId,$idAsignacion,$codigo,$tiempo,$tiempo_muerto,$tiempo_real)
	{
		$sql="UPDATE despacho SET idAsignacion='$idAsignacion',codigo = '$codigo',tiempo='$tiempo',tiempo_muerto='$tiempo_muerto',tiempo_real='$tiempo_real' WHERE despachoId='$despachoId'";
		
		return ejecutarConsulta($sql);
	}

	//Implementamos un mÃ©todo para desactivar categorÃ­as
	public function desactivar($idDespacho)
	{
		$sql="DELETE from despacho WHERE idDespacho='$idDespacho'";
		return ejecutarConsulta($sql);
	}

	//Implementar un mÃ©todo para mostrar los datos de un registro a modificar
	public function obtenerAsignacion($codigo)
	{
		$sql="SELECT da.idDetalle_asignacion,da.idConsignatario, da.idTransportista, em.nombre as consignatario, e.nombre as transportista, dp.idDetalle_Plano,p.idPlano_Estiba, pr.nombre as producto, CONCAT(pl.nombre, ' ', pl.apellido) as piloto,dp.seccion_bodega, dp.bodega, dp.peso, p.no_importacion, b.idBuque,b.nombre as buque, t.placa, t.modelo from detalle_asignacion da inner join detalle_plano dp on da.idDetalle_plano = dp.idDetalle_Plano inner join plano_estiba p on dp.idPlano_Estiba = p.idPlano_Estiba inner join producto pr on pr.idProducto = dp.idProducto inner join empresa em on em.idEmpresa = da.idConsignatario inner join empresa e on e.idEmpresa = da.idTransportista inner join buque b on p.idBuque = b.idBuque inner join piloto pl on pl.idPiloto = da.idPiloto
		    inner join transporte t on da.idTransporte = t.idTransporte where da.codigo = '$codigo'";

		return ejecutarConsultaSimpleFila($sql);
	}

    public function listar()
	{
		$sql="SELECT d.idDespacho, d.idAlmeja, d.idTolva,d.idAsignacion, ea.descripcion, d.codigo, d.hora, d.minuto, d.segundo, ea.descripcion as almeja, et.descripcion as tolva, da.codigo as codigo_asignacion FROM despacho d INNER JOIN equipo ea on d.idAlmeja = ea.idEquipo inner join equipo et on d.idTolva = et.idEquipo inner join detalle_asignacion da on d.idAsignacion = da.idDetalle_asignacion where d.estado !='A'";

		return ejecutarConsulta($sql);		
	}

	public function getById($id){
		$sql = "SELECT d.bl, d.peso, ea.descripcion, d.hora, d.minuto, d.segundo as tolva, et.descripcion as equipo FROM despacho d INNER JOIN equipo ea on d.idAlmeja = ea.idEquipo inner join equipo et on d.idTolva = et.idEquipo where d.idDespacho = '$id'";

		return ejecutarConsultaSimpleFila($sql);
	}

	public function ListarTiemposMuertos($idDespacho){
		$sql = "SELECT * from tiempo_muerto where idDespacho = '$idDespacho'";

		return ejecutarConsulta($sql);
	}

	public function ListarBodegas($idPlano_Estiba){
		$sql = "SELECT da.idDetalle_asignacion,da.idConsignatario, da.idTransportista, em.nombre as consignatario, e.nombre as transportista, dp.idDetalle_plano,p.idPlano_Estiba, pr.nombre as producto,dp.bodega, pl.nombre as piloto, CONCAT('seccion  no ',dp.seccion_bodega) as nombre_seccion, dp.seccion_bodega, dp.estado, pl.idPiloto, da.codigo, t.idTransporte from detalle_asignacion da inner join detalle_plano dp on da.idDetalle_plano = dp.idDetalle_Plano inner join plano_estiba p 
			on dp.idPlano_Estiba = p.idPlano_Estiba
			inner join producto pr on pr.idProducto = dp.idProducto
            left join empresa em on em.idEmpresa = da.idConsignatario
			left join empresa e on e.idEmpresa = da.idTransportista 
			inner join piloto pl on pl.idPiloto = da.idPiloto
			inner join transporte t on e.idEmpresa = t.idEmpresa
		    WHERE dp.idPlano_Estiba = '$idPlano_Estiba' and dp.estado = 'A' order by seccion_bodega";
		return ejecutarConsulta($sql);
	}

	public function Obtener($codigo){
		$sql = "SELECT da.idDetalle_asignacion,da.idConsignatario, da.idTransportista, em.nombre as consignatario, e.nombre as transportista, dp.idDetalle_Plano,p.idPlano_Estiba, pr.nombre as producto, pl.nombre as piloto,dp.seccion_bodega, dp.bodega, dp.peso, p.no_importacion, b.idBuque,b.nombre as buque, t.placa, t.modelo, d.hora, d.minuto, d.segundo, d.codigo as codigo_despacho, d.idDespacho from detalle_asignacion da inner join detalle_plano dp on da.idDetalle_plano = dp.idDetalle_Plano inner join plano_estiba p on dp.idPlano_Estiba = p.idPlano_Estiba inner join producto pr on pr.idProducto = dp.idProducto inner join empresa em on em.idEmpresa = da.idConsignatario inner join empresa e on e.idEmpresa = da.idTransportista inner join buque b on p.idBuque = b.idBuque inner join piloto pl on pl.idPiloto = da.idPiloto inner join transporte t on da.idTransporte = t.idTransporte inner join despacho d on d.idAsignacion = da.idDetalle_asignacion where d.codigo = '$codigo' and d.estado != 'A'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function contarDespachos()
	{
		$sql = "SELECT count(*) as codigo from despacho";
		return ejecutarConsultaSimpleFila($sql);

	}

}

?>








