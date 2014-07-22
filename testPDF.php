<?php

require_once 'librerias/fpdf_class.php';

class PDF extends FPDF {

    // Cabacera de pagina
    function Header() {
        // Logo
        $this->Image('images/logo_rect.jpg', 30, 8, 80);
        // Movernos a la derecha
        $this->Cell(110);
        // Arial bold 15
        $this->SetFont('Arial', 'B', 11);
        // Titulo
        $this->Cell(70, 10, 'HECTOR GARCIA BUSTILLOS', 1, 0, 'J');
        
        $this->Ln();
        $this->Cell(110);
        $this->SetFont('Arial', 'B', 11);
        $this->MultiCell(70, 4, "HECTOR GARCIA BUSTILLOS. GONALEZ COSSIO", 1, 'J', false);
        // Salto de linea
        $this->Line($this->GetX(), $this->GetY(), $this->GetX()+200, $this->GetY());
        $this->Ln(20);
    }

    // Pie de pagina
    function Footer() {
        // Posicion: a 1,5 cm de final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Numero de pagina
        $this->Cell(0, 10, 'Page ' . $this->PageNo() . '/{nb}', 0, 0, 'C');
    }

}

$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times', '', 12);
for($i=1;$i<=40;$i++)
    $pdf->Cell(0,10,'Imprimiendo linea numero '.$i,0,1);
$pdf->Output('formato de pureba.pdf','I');
//$pdf->Output('formato de pureba.pdf','F');
?>