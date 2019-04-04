<?php 
  //Activamos el almacenamiento en el buffer
    ob_start();
    session_start();

    if (!isset($_SESSION["nombre"]))
    {
      header("Location: ../vistas/Login.php");
    }else{
      if(isset($_SESSION["idUsuario"]) && $_SESSION["Reportes"] == 1)
     {
?>
<?php
require('Factura.php');

$logo = "logo.jpg";
$ext_logo = "jpg";
$empresa = "TEPSA S.A";
$documento = "Reporte Plano Estiba";
$direccion = "Puerto San Jose, Escuintla";
$telefono = "0000-0000";
$email = "tepsa@gmail.com";

//Obtenemos los datos de la cabecera de la venta actual
require_once "../modelos/PlanoEstiba.php";
$plano = new Plano();
//$rsptav = $venta->ventacabecera($_GET["id"]);
//Recorremos todos los valores obtenidos
//$regv = $rsptav->fetch_object();

//Establecemos la configuración de la factura
$pdf = new PDF_Invoice( 'L', 'mm', 'A4' );
$pdf->AddPage();

//Enviamos los datos de la empresa al método addSociete de la clase Factura
$pdf->addSociete(utf8_decode($empresa),
                  $documento."\n" .
                  utf8_decode("Dirección: ").utf8_decode($direccion)."\n".
                  utf8_decode("Teléfono: ").$telefono."\n" .
                  "Email : ".$email,$logo,$ext_logo);
//$pdf->fact_dev( "regv->tipo_comprobante", "regv->serie_comprobante-regv->num_comprobante" );
$pdf->temporaire( "" );
$pdf->addDate(date("d/m/Y"));

//Enviamos los datos del cliente al método addClientAdresse de la clase Factura
//$pdf->addClientAdresse(utf8_decode('$regv->cliente'),"Domicilio: ".utf8_decode('$regv->direccion'),'$regv->tipo_documento'.": ".'$regv->num_documento',"Email: ".'$regv->email',"Telefono: ".'$regv->telefono');

//Establecemos las columnas que va a tener la sección donde mostramos los detalles de la venta
$cols=array( "BL"=>18,
             "CONSIGNATARIO"=>50,
             "BODEGA"=>20,
             "SECC. BODEGA"=>30,
             "PRODUCTO"=>60,
             "PESO"=>29,
			 "PESO DESCARGADO"=>40,
			 "DIFERENCIA"=>30);
$pdf->addCols( $cols);
$cols=array( "BL"=>"L",
             "CONSIGNATARIO"=>"L",
             "BODEGA"=>"C",
             "SECC. BODEGA"=>"C",
             "PRODUCTO"=>"L",
             "PESO" =>"R",
			 "PESO DESCARGADO"=>"R",
			 "DIFERENCIA"=>"R");
$pdf->addLineFormat( $cols);
$pdf->addLineFormat($cols);
//Actualizamos el valor de la coordenada "y", que será la ubicación desde donde empezaremos a mostrar los datos
$y= 48;

//Obtenemos todos los detalles de la venta actual
$rsptad = $plano->ReportePlano($_GET["idPlano_Estiba"]);

while ($regd = $rsptad->fetch_object()) {
  $line = array( "BL"=> "$regd->bl",
                "CONSIGNATARIO"=> utf8_decode("$regd->nombre"),
                "BODEGA"=> "$regd->bodega",
                "SECC. BODEGA"=>"$regd->seccion_bodega",
                "PRODUCTO"=> "$regd->producto",
                "PESO" => "$regd->peso",
                "PESO DESCARGADO"=> "$regd->peso2",
		"DIFERENCIA"=>"$regd->diferencia");
            $size = $pdf->addLine( $y, $line );
            $y   += $size + 2;
}

//Convertimos el total en letras
$pdf->Output('Reporte Tepsa','I');
?>
<?php  
}else{
     header("Location: ../vistas/noacceso.php");
   }
}
   ob_end_flush();
?>

