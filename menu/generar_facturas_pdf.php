<?php
require('../fpdf186/fpdf.php');
$pdf = new FPDF();
$pdf->AddPage('L'); 
$pdf->SetFont('Arial', 'B', 12);
$pdf->Cell(0, 10, 'Lista de Facturas', 0, 1, 'C');
$pdf->Ln(10);
include_once("../conexion.php");
$query = "SELECT * FROM Facturas";
$stmt = sqlsrv_query($conn, $query);
if ($stmt === false) {
    die(print_r(sqlsrv_errors(), true));
}


$pdf->Cell(15, 10, 'ID', 1);
$pdf->Cell(60, 10, 'Descripcion', 1);
$pdf->Cell(40, 10, 'Categoria', 1);
$pdf->Cell(25, 10, 'Cantidad', 1);
$pdf->Cell(30, 10, 'Precio Unit.', 1);
$pdf->Cell(25, 10, 'ITEBIS', 1);
$pdf->Cell(30, 10, 'Descuento', 1);
$pdf->Cell(30, 10, 'Total', 1);
$pdf->Ln();

$pdf->SetFont('Arial', '', 10);
while ($row = sqlsrv_fetch_array($stmt, SQLSRV_FETCH_ASSOC)) {
    $pdf->Cell(15, 10, $row['ID'], 1);
    $pdf->Cell(60, 10, substr($row['DESCRIPCION'], 0, 35), 1);
    $pdf->Cell(40, 10, substr($row['CATEGORIA'], 0, 20), 1);
    $pdf->Cell(25, 10, $row['CANTIDAD'], 1);
    $pdf->Cell(30, 10, number_format($row['PRECIO_UNITARIO'], 2), 1);
    $pdf->Cell(25, 10, number_format($row['ITEBIS'], 2), 1);
    $pdf->Cell(30, 10, number_format($row['DESCUENTO'], 2), 1);
    $pdf->Cell(30, 10, number_format($row['TOTAL_GENERAL'], 2), 1);
    $pdf->Ln();
}
$pdf->Output();
?>
