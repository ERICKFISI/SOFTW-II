<?php

// Editar la ruta de windows - C:\...
define("RUTABASE", "/var/www/html/motorepuestosjc/public");

// Funcion para realizar la boleta
require(RUTABASE.'/fpdf182/fpdf.php');

class PDF extends FPDF
{
    // Cabecera de página
    function Header()
    {
        // Logo
        //$this->Image(RUTABASE.'/images/prod-2.jpg',10,8,33);
        // Arial bold 15
        $this->SetFont('Arial','B',15);
        $this->Cell(60,10,'Motorepuestos J&C',0,0,'C');
        
        // Movernos a la derecha
        $this->Cell(70);
        // Título
        //$this->Cell(60,10,'BOLETA DE VENTA',1,0,'C');
        $this->MultiCell(60,10,'BOLETA DE VENTA N° ',1,"C", false);
        // Salto de línea
        $this->Ln(2);
        // Cambiamos la fuente
        $this->SetFont('Arial','',11);
        $this->Cell(28,10,'Señor(es): ',0,1,'C');
        $this->Cell(26,10,'Dirección: ',0,1,'C');
        $this->Cell(28,10,'Documento: ',0,1,'C');
        $this->Cell(20,10,'Fecha: ',0,1,'C');
    }

    // Pie de página
    function Footer()
    {
        // Posición: a 1,5 cm del final
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial','I',8);
        // Número de página
        $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
    }

    function tabla($cabecera, $cuerpo)
    {
        $tams = [30, 100, 30, 30];
        for ($i = 0; $i < count($tams); $i++)
            $this->Cell($tams[$i], 7, $cabecera[$i], 1);
        $this->Ln();

        foreach ($cuerpo as $fila)
        {
            $this->Cell($tams[0], 6, $fila[0], 1);
            $this->Cell($tams[1], 6, $fila[1], 1);
            $this->Cell($tams[2], 6, $fila[2], 1);
            $this->Cell($tams[3], 6, $fila[3], 1);
            $this->Ln();
        }
        
    }
}

// Creación del objeto de la clase heredada
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);

$cabecera = ["Cantidad", "Producto", "P. Unit", "Importe"];
$cuerpo = [[3, "Zanahoria", 10, 30],
           [4, "Cereza", 5, 20],
           [6, "Pizarra", 5, 30]
           ];

$pdf->tabla($cabecera, $cuerpo);
$pdf->Output();


