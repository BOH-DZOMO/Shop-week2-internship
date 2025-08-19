<?php
require_once "../assets/libraries/fpdf186/fpdf.php";
require_once "../includes/autoloader.inc.php";
//for setmargins 0.6 puts the border at the edge of the paper
class PDF extends FPDF
{

    function Header()
    {
        $this->SetFont('Courier', 'B', 12);
        $this->Cell(190, 10, 'Product Table', 1, 1, "C");
        $this->Ln(5);
        $this->Cell(42, 10, "Code", 1, 0, "C");
        $this->Cell(63, 10, "Name", 1, 0, "C");
        $this->Cell(25, 10, "Weight", 1, 0, "C");
        $this->Cell(30, 10, "Cost Price", 1, 0, "C");
        $this->Cell(30, 10, "Sale Price", 1, 1, "C");
        $this->SetFont('Courier', '', 10);
    }
    function Footer()
    {
        $this->SetY(-10);
        $this->SetFont('Courier', 'I', 10);
        $this->Cell(0, 10, 'Page ' . $this->PageNo(), 0, 0, 'C');
    }
}
$pdf = new PDF();
// $pdf->SetMargins(1,0,200);
$pdf->SetAutoPageBreak(true, 10);
$pdf->AddPage();



// `code_prod`, `name_prod`, `description`, `image`, `weight`, `cost_price`, `sale_price`

$product = new Product();
$data = $product->getProducts();

foreach ($data as $key => $value) {
    $x =  $pdf->GetX();

    $pdf->Cell(42, 5, $value["code_prod"], 1, "");


    $pdf->SetXY($x + 42, $pdf->GetY());
    $pdf->Cell(63, 5, $value["name_prod"], 1, "");

    $pdf->SetXY($x + 105, $pdf->GetY());
    $pdf->Cell(25, 5, $value["weight"], 1, "");

    $pdf->SetXY($x + 130, $pdf->GetY());
    $pdf->Cell(30, 5, $value["cost_price"], 1, "");


    $pdf->SetXY($x + 160, $pdf->GetY());
    $pdf->Cell(30, 5, $value["sale_price"], 1, "");
    $pdf->Ln();
}



$pdf->Output();



// $pdf = new FPDF();
// // $pdf->SetMargins(1,0,200);
// $pdf->AddPage();
// $pdf->SetFont('Courier', 'B', 14);
// $pdf->Cell(190, 10, 'Product Table', 1, 1, "C");
// $pdf->Ln();
// $pdf->Cell(25, 10, "Code", 1, 0, "C");
// $pdf->Cell(45, 10, "Name", 1, 0, "C");
// $pdf->Cell(35, 10, "Image", 1, 0, "C");
// $pdf->Cell(25, 10, "Weight", 1, 0, "C");
// $pdf->Cell(30, 10, "Cost Price", 1, 0, "C");
// $pdf->Cell(30, 10, "Sale Price", 1, 1, "C");

// $pdf->SetFont('Courier', '', 10);

// // `code_prod`, `name_prod`, `description`, `image`, `weight`, `cost_price`, `sale_price`

// $product = new Product();
// $data = $product->getProducts();
// $y1 = 0;
// $y2 = 0;
// foreach ($data as $key => $value) {
//     $x = $pdf->GetX();
//     $y = $pdf->GetY() > $y1 ? $pdf->GetY() : $y1;

//     $pdf->MultiCell(25, 5, $value["code_prod"], 1, "");
//     $y1 = $pdf->GetY();

//     $pdf->SetXY($x + 25, $y);
//     $pdf->MultiCell(45, 5, $value["name_prod"], 1, "");
//     $y1 = $y1 > $pdf->GetY() ? $y1 : $pdf->GetY();

//     $pdf->SetXY($x + 70, $y);
//     $pdf->MultiCell(35, 5, $value["image"], 1, "");
//     $y1 = $y1 > $pdf->GetY() ? $y1 : $pdf->GetY();

//     $pdf->SetXY($x + 105, $y);
//     $pdf->Cell(25, $y1-$y, $value["weight"], 1, "");
//     $y1 = $y1 > $pdf->GetY() ? $y1 : $pdf->GetY();

//     $pdf->SetXY($x + 130, $y);
//     $pdf->Cell(30, $y1-$y, $value["cost_price"], 1, "");
//     $y1 = $y1 > $pdf->GetY() ? $y1 : $pdf->GetY();

//     $pdf->SetXY($x + 160, $y);
//     $pdf->Cell(30, $y1-$y, $value["sale_price"], 1, "");
//     $y1 = $y1 > $pdf->GetY() ? $y1 : $pdf->GetY();

//     $pdf->Ln();
// }



// $pdf->Output();
