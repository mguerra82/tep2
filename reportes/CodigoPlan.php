<?php
require_once("../fpdf/fpdf.php");
require_once("../modelos/PlanoEstiba.php");
$plano = new Plano();



$pdf = new FPDF('P', 'mm', 'Letter');
$pdf->AddPage();
$rsptad = $plano->CodigoQR($_GET["idPlano"]);
$transport = $plano->Empresa($_GET["idPlano"]);

$pdf->SetX(30);
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(30, 15, "Codigos QR para Despachos Importacion No." . $_GET["idPlano"]);
$Ye = 30;

$x = 20;
$x2 = 15;
$y1 = 30;
$y2 = 100;
$y3 = 110;

foreach ($transport as $emp) {
    $idEmpresa = $emp["idEmpresa"];
    $pdf->SetX(50);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell(50, $Ye,"Empresa de Transporte: ". $emp["transportista"]);
    $cont = 1;

    foreach ($rsptad as $regd) {
        $idTransport = $regd["idTransportista"];

        if($idEmpresa===$idTransport) {

            if ($cont % 5 === 0) {
                $x = 20;
                $x2 = 15;
                $y1 = $y1 + 45;
                $y2 = $y2 + 90;
                $y3 = $y3 + 90;
            }
            $codigo = $regd["codigo"];
            $piloto = $regd["piloto"];
            $licencia = $regd["licencia"];

            $pdf->Image('https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=' . $codigo . '&.png', $x, $y1, 30, 30, "png");
            $pdf->SetX($x + 7);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell($x + 20, $y2, $codigo);

            $pdf->SetX($x2 + 7);
            $pdf->SetFont('Arial', 'B', 12);
            $pdf->Cell($x2, $y3, $licencia);
            //$Ye = $y3;
            $x = $x + 35;
            $x2 = $x2 + 35;           
            $cont++;         
        }
        
    }
    $pdf->AddPage();
    
    $pdf->SetX(30);
    $pdf->SetFont('Arial', 'B', 18);
    $pdf->Cell(30, 15, "Codigos QR para Despachos Importacion No." . $_GET["idPlano"]);
    $Ye = 30;

    $x = 20;
    $x2 = 15;
    $y1 = 30;
    $y2 = 100;
    $y3 = 110;

    
}


$pdf->Output();
