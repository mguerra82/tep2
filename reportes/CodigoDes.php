<?php
require_once("../fpdf/fpdf.php");
require_once("../modelos/PlanoEstiba.php");
$plano = new Plano();



$pdf = new FPDF('P', 'mm', 'Letter');
$pdf->AddPage();
$rsptad = $plano->CodigoDes($_GET["idPlano"]);

$pdf->SetX(50);
$pdf->SetFont('Arial', 'B', 18);
$pdf->Cell(50, 20, "Codigos QR para Salidas Importacion No." . $_GET["idPlano"]);
$x = 20;
$x2 = 15;
$y1 = 30;
$y2 = 100;
$y3 = 110;
$cont = 1;

while ($regd = $rsptad->fetch_object()) {
    if ($cont % 5 === 0) {
        $x = 20;
        $x2 = 15;
        $y1 = $y1 + 45;
        $y2 = $y2 + 90;
        $y3 = $y3 + 90;
    }

    $codigo = $regd->codigo;

    $piloto = $regd->piloto;
    //$imagen = QRcode::png($codigo, "test.png");

    $pdf->Image('https://chart.googleapis.com/chart?chs=150x150&cht=qr&chl=' . $codigo . '&.png', $x, $y1, 30, 30, "png");
    $pdf->SetX($x + 7);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell($x + 20, $y2, $regd->codigo);

    $pdf->SetX($x2 + 7);
    $pdf->SetFont('Arial', 'B', 12);
    $pdf->Cell($x2, $y3, $regd->licencia);
    $x = $x + 35;
    $x2 = $x2 + 35;
    $cont++;
}



$pdf->Output();
