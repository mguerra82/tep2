<?php 
//Incluímos inicialmente la conexión a la base de datos
require "../config/Conexion.php";

Class Plano
{
	//Implementamos nuestro constructor
	public function __construct()
	{

	}

	//Implementamos un método para insertar registros
	public function insertar($no_importacion,$peso_total,$idBuque)
	{
		$sql="INSERT INTO plano_estiba(no_importacion,peso_total,idBuque,estado)
		VALUES ('$no_importacion','$peso_total','$idBuque','I')";
		//return ejecutarConsulta($sql);
		return ejecutarConsulta($sql);
	}

	public function insertarDetalle($idPlano_estiba,$bodega,$seccion_bodega,$idProducto,$peso)
	{
		$sql="INSERT INTO detalle_plano(idPlano_Estiba,bodega,seccion_bodega,idProducto,peso,estado)
		VALUES ('$idPlano_estiba','$bodega','$seccion_bodega','$idProducto','$peso','I')";
	       	//return ejecutarConsulta($sql);
		return ejecutarConsulta($sql);
	}

	public function editarDetalle($idDetalle_plano,$idPlano_estiba,$bodega,$seccion_bodega,$idProducto,$peso)
	{
		$sql="UPDATE detalle_plano set idPlano_Estiba = '$idPlano_estiba', bodega = '$bodega', seccion_bodega = '$seccion_bodega', idProducto = '$idProducto', peso = '$peso' where idDetalle_Plano = '$idDetalle_plano'";
		//return ejecutarConsulta($sql);
		return ejecutarConsulta($sql);
	}


		//Implementamos un método para editar registros
	/*public function editar($idRol,$nombre,$permisos)
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
			$sql_detalle = "INSERT INTO rol_permiso(idRol, idpermiso) VALUES('$idRol', '$permisos[$i]')";
			ejecutarConsulta($sql_detalle) or $sw = false;
			$i=$i + 1;
		}

		return $sw;
	}*/

	//Implementamos un método para desactivar 
	public function desactivar($idPlano)
	{
		$sql="UPDATE plano_estiba SET estado='D' WHERE idPlano_Estiba='$idPlano'";
		return ejecutarConsulta($sql);
	}

	//Implementamos un método para activar 
	public function editarBodega($idPlano_estiba,$idDetalle_plano,$seccion_bodega,$idProducto,$peso)
	{
		$sql="UPDATE detalle_plano SET seccion_bodega ='$seccion_bodega', idProducto = '$idProducto', peso ='$peso' WHERE idDetalle_Plano='$idDetalle_plano'";

		return ejecutarConsulta($sql);
	}

	public function mostrar($idPlano)
	{
		$sql="SELECT * from plano_estiba where idPlano_Estiba = '$idPlano'";
		return ejecutarConsulta($sql);
	}

	public function listar()
	{
		$sql="SELECT p.idPlano_Estiba, p.no_importacion, p.idBuque, p.peso_total, p.estado, b.nombre as buque, b.no_bodegas from plano_estiba p inner join buque b on p.idBuque = b.idBuque where p.estado != 'D'";
		return ejecutarConsulta($sql);
	}


	public function ListarDetalles($idPlano,$bodega)
	{

		$sql="SELECT dp.idPlano_Estiba, dp.idDetalle_Plano, p.nombre as producto, dp.peso, dp.idProducto, dp.peso, dp.bodega, dp.seccion_bodega, dp.peso_bodega, dp.estado from detalle_plano dp inner join producto p on dp.idProducto = p.idProducto where dp.idPlano_Estiba='$idPlano' and dp.bodega = '$bodega'";
		return ejecutarConsulta($sql);
	}	


	public function ListarAsignaciones($idPlano,$bodega,$seccion_bodega)
	{
		$sql="SELECT da.idDetalle_asignacion,da.idConsignatario, da.idTransportista, em.nombre as consignatario, e.nombre as transportista, dp.idDetalle_Plano,p.idPlano_Estiba, pr.nombre as producto, pl.nombre as piloto,dp.seccion_bodega, dp.bodega, dp.estado, pl.idPiloto, da.codigo, t.idTransporte from detalle_asignacion da inner join detalle_plano dp on da.idDetalle_plano = dp.idDetalle_Plano inner join plano_estiba p 
			on dp.idPlano_Estiba = p.idPlano_Estiba
			inner join producto pr on pr.idProducto = dp.idProducto
            left join empresa em on em.idEmpresa = da.idConsignatario
			left join empresa e on e.idEmpresa = da.idTransportista 
			inner join piloto pl on pl.idPiloto = da.idPiloto
			inner join transporte t on e.idEmpresa = t.idEmpresa
			where dp.bodega='$bodega' and p.idPlano_Estiba='$idPlano' and dp.seccion_bodega='$seccion_bodega' and da.idTransporte = t.idTransporte ";
		return ejecutarConsulta($sql);
	}

	public function ListarCorrelativo()
	{
		$sql="SELECT IFNULL(count(idPlano_Estiba),0) as correlativo FROM plano_estiba where estado != 'A'";
		return ejecutarConsultaSimpleFila($sql);
	}

	public function ListarBodegas($idPlano)
	{
		$sql="SELECT bodega, CONCAT('bodega no ', bodega) AS seccion_bodega FROM detalle_plano where idPlano_Estiba = '$idPlano' group by bodega";
		return ejecutarConsulta($sql);
	}

	public function CambiarEstado($idDetalle_plano, $estado){
		$sql = "UPDATE from detalle_plano set estado = '$estado' where idDetalle_Plano='$idDetalle_plano'";
		return ejecutarConsulta($sql);
	}


	public function ListarNoAsignados($idPlano)
	{
		$sql="SELECT * from detalle_plano where idPlano_Estiba = '$idPlano' and estado = 'I'";
		return ejecutarConsulta($sql);
	}

	public function ListarDetalleBodegas($idPlano)
	{
		$sql="SELECT * from detalle_plano where idPlano_Estiba = '$idPlano'";
		return ejecutarConsulta($sql);
	}

	public function EliminarBodega($idPlano, $seccion_bodega)
	{
		$sql="DELETE from detalle_plano where idPlano_Estiba = '$idPlano' and seccion_bodega = '$seccion_bodega'";
		return ejecutarConsulta($sql);
	}

	public function UpdateTotal($idPlano, $peso_total){
		$sql = "UPDATE plano_estiba set peso_total = '$peso_total' where idPlano_Estiba = '$idPlano'";
		return ejecutarConsulta($sql);
	}
        
	public function ReportePlano($idPlano_Estiba)
	{
		$sql = " select s.bl,dp.bodega,dp.seccion_bodega, dp.peso,p.nombre as producto,e.nombre,s.peso as peso2, dp.peso - s.peso as diferencia 
	from detalle_plano dp, detalle_asignacion da, despacho d, salida s, empresa e,producto p
	where dp.idPlano_Estiba = '$idPlano_Estiba' and dp.idDetalle_Plano = da.idDetalle_plano 
	and da.idDetalle_asignacion = d.idAsignacion and d.idDespacho = s.idDespacho
	and da.idConsignatario = e.idEmpresa and dp.idProducto = p.idProducto ";
		return ejecutarConsulta($sql);
	}
	public function CodigoQR($idPlano)
	{
		$sql = " SELECT da.idTransportista, e.nombre as transportista, pl.nombre as piloto,pl.licencia, pl.idPiloto, da.codigo, t.idTransporte 
				 from detalle_asignacion da inner join detalle_plano dp on da.idDetalle_plano = dp.idDetalle_Plano 
				 inner join plano_estiba p on dp.idPlano_Estiba = p.idPlano_Estiba 
				 inner join producto pr on pr.idProducto = dp.idProducto 
				 left join empresa em on em.idEmpresa = da.idConsignatario 
				 left join empresa e on e.idEmpresa = da.idTransportista 
				 inner join piloto pl on pl.idPiloto = da.idPiloto 
				 inner join transporte t on e.idEmpresa = t.idEmpresa 
				 where p.idPlano_Estiba='$idPlano' and da.idTransporte = t.idTransporte";
		return ejecutarConsulta($sql);
	}

	public function CodigoDes($idPlano)
	{
		$sql = " SELECT d.idDespacho, d.idAsignacion, d.codigo, da.codigo as codigo_asignacion,concat(p.nombre,' ',p.apellido) as piloto,p.licencia
				FROM despacho d INNER JOIN equipo ea on d.idAlmeja = ea.idEquipo 
				inner join equipo et on d.idTolva = et.idEquipo 
				inner join detalle_asignacion da on d.idAsignacion = da.idDetalle_asignacion
				inner join detalle_plano dp on da.idDetalle_plano = dp.idDetalle_Plano
				inner join piloto p on da.idPiloto = p.idPiloto 
				where dp.idPlano_Estiba = '$idPlano' and d.estado !='A'";
		return ejecutarConsulta($sql);
	}
	public function Empresa($idPlano){
		$sql = " SELECT e.idEmpresa, e.nombre as transportista 
						from detalle_asignacion da 
						inner join detalle_plano dp on da.idDetalle_plano = dp.idDetalle_Plano 
						inner join plano_estiba p on dp.idPlano_Estiba = p.idPlano_Estiba 
						inner join empresa e on e.idEmpresa = da.idTransportista 
						where p.idPlano_Estiba='$idPlano' 
						group by e.idEmpresa ";
		return ejecutarConsulta($sql);
	}

}

?>
