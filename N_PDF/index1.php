<?php
require('fpdf/fpdf.php');

class PDF extends FPDF
{
// Cabecera de página
function Header()
{
    // Logo
    $this->Image('logo1.JPEG',10,8,40);
    //Arial bold 15
    $this->SetFont('Arial','B',15);
    // Movernos a la derecha
    $this->Cell(60);
    // Título
    $this->Cell(80,10,'TIENDA GUETO STYLE',0,0,'C');
    // Salto de línea
    $this->Ln(20);
    

    $this -> cell(63, 10, 'Nombre', 1, 0, 'C', 0);
    //$this -> cell(63, 10, 'Talla', 1, 0, 'C', 0);
    $this -> cell(63, 10, 'Color', 1, 0, 'C', 0);
    $this -> cell(63, 10, 'Precio', 1, 1, 'C', 0);
}

// Pie de página
function Footer()
{
    // Posición: a 1,5 cm del final
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Número de página
    $this->Cell(0,10,'Pagina '.$this->PageNo().'/{nb}',0,0,'C');
}
}

require 'cn.php';
$consulta = "SELECT*FROM productos1";
$resultado = $mysqli -> query($consulta);

$pdf = new PDF();
$pdf ->AliasNBPages();
$pdf->AddPage();
$pdf->SetFont('Arial','',16);

while ($row = $resultado -> fetch_assoc()){
    $pdf -> cell(63, 10, utf8_decode($row['nombre']), 1, 0, 'C', 0);
    //$pdf -> cell(63, 10, $row['talla'], 1, 0, 'C', 0);
    $pdf -> cell(63, 10, $row['color'], 1, 0, 'C', 0);
    $pdf -> cell(63, 10, $row['Precio'], 1, 1, 'C', 0);
}
$pdf->Output();
?>