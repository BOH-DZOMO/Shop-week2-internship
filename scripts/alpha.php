<?php
require_once('../assets/libraries/fpdf186/fpdf.php');
require_once "../includes/autoloader.inc.php";

class AlphaPDF extends FPDF
{
    protected $extgstates = array();

    // alpha: real value from 0 (transparent) to 1 (opaque)
    // bm:    blend mode, one of the following:
    //          Normal, Multiply, Screen, Overlay, Darken, Lighten, ColorDodge, ColorBurn,
    //          HardLight, SoftLight, Difference, Exclusion, Hue, Saturation, Color, Luminosity
    function SetAlpha($alpha, $bm = 'Normal')
    {
        // set alpha for stroking (CA) and non-stroking (ca) operations
        $gs = $this->AddExtGState(array('ca' => $alpha, 'CA' => $alpha, 'BM' => '/' . $bm));
        $this->SetExtGState($gs);
    }

    function AddExtGState($parms)
    {
        $n = count($this->extgstates) + 1;
        $this->extgstates[$n]['parms'] = $parms;
        return $n;
    }

    function SetExtGState($gs)
    {
        $this->_out(sprintf('/GS%d gs', $gs));
    }

    function _enddoc()
    {
        if (!empty($this->extgstates) && $this->PDFVersion < '1.4')
            $this->PDFVersion = '1.4';
        parent::_enddoc();
    }

    function _putextgstates()
    {
        for ($i = 1; $i <= count($this->extgstates); $i++) {
            $this->_newobj();
            $this->extgstates[$i]['n'] = $this->n;
            $this->_put('<</Type /ExtGState');
            $parms = $this->extgstates[$i]['parms'];
            $this->_put(sprintf('/ca %.3F', $parms['ca']));
            $this->_put(sprintf('/CA %.3F', $parms['CA']));
            $this->_put('/BM ' . $parms['BM']);
            $this->_put('>>');
            $this->_put('endobj');
        }
    }

    function _putresourcedict()
    {
        parent::_putresourcedict();
        $this->_put('/ExtGState <<');
        foreach ($this->extgstates as $k => $extgstate)
            $this->_put('/GS' . $k . ' ' . $extgstate['n'] . ' 0 R');
        $this->_put('>>');
    }

    function _putresources()
    {
        $this->_putextgstates();
        parent::_putresources();
    }

    function Header()
    {
        $this->SetFont('Courier', 'B', 12);
        $this->Cell(190, 10, 'Product Table', 1, 1, "C");
        $this->Ln(5);
        $this->Cell(32, 10, "Code", 1, 0, "C");
        $this->Cell(73, 10, "Name", 1, 0, "C");
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
        $this->SetAlpha(0.3);
        $this->Image('68a464f97bd66.jpg', 60, 90, 100);
        $this->SetAlpha(1);
    }
}

$pdf = new AlphaPDF();
$pdf->AddPage();

$product = new Product();
$data = $product->getProducts();

foreach ($data as $key => $value) {
    $x =  $pdf->GetX();

    $pdf->Cell(32, 5, $value["code_prod"], 1, "");

    $pdf->SetXY($x + 32, $pdf->GetY());
    $pdf->Cell(73, 5, $value["name_prod"], 1, "");

    $pdf->SetXY($x + 105, $pdf->GetY());
    $pdf->Cell(25, 5, $value["weight"], 1, "");

    $pdf->SetXY($x + 130, $pdf->GetY());
    $pdf->Cell(30, 5, $value["cost_price"], 1, "");

    $pdf->SetXY($x + 160, $pdf->GetY());
    $pdf->Cell(30, 5, $value["sale_price"], 1, "");
    $pdf->Ln();
}


$pdf->Output();
?>
