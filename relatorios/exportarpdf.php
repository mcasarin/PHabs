<?php
require ('mysql_table.php');
include '../include/connect.php';


class PDF extends PDF_MySQL_Table
{
function Header()
{
    // Logo
    $this->Image('churchill.jpg',11,11,20,0);
    $this->SetFont('Arial','B',12);
    // Move to the right
    $this->Cell(50);
    // Title
    $this->Cell(120,10,utf8_decode('Condomínio Edifício Sir Winston Churchill'),0,1,'C');
    $this->SetFont('Arial','I',8);
    $this->Cell(50);
    $this->Cell(120,10,utf8_decode('Avenida Paulista, 807 - Cerqueira Cesar, São Paulo - SP'),0,0,'C');
    //new line
    $this->SetFont('Arial','B',12);
    $this->Ln();
    $this->Cell(50);
    $this->Cell(120,10,utf8_decode('Relatório de Usuários'),0,0,'C');
    // Line break
    $this->Ln(20);
    // Ensure table header is printed
    parent::Header();
}
// Page footer
function Footer() {
    // Position at 1.5 cm from bottom
    $this->SetY(-15);
    // Arial italic 8
    $this->SetFont('Arial','I',8);
    // Page number
    $this->Cell(0,10,utf8_decode('Página(s) ').$this->PageNo().'/{nb}',1,1,'R');
    //$this->Cell(0,10,utf8_decode('Página(s) ').$this->PageNo().'/{nb}',1,1,'C');
    $tDate = date("d/m/Y, g:i a");
    $this->Cell(0,5,'Data: '.$tDate,0,1,'R');
    //$this->Cell(0,10,'Data: '.$tDate,0,false,'C',0,'',0,false,'T','M');
}
}


$pdf = new PDF();
$pdf->AddPage();
$prop = array('HeaderColor'=>array(255,150,100),
            'color1'=>array(210,245,255),
            'color2'=>array(255,255,210),
            'padding'=>1);
$pdf->Table($conn,'SELECT nome,empresa,matricula,cartao,id,data,hora,Coletor,Acesso FROM relusuario ORDER BY Data,hora DESC',$prop);
$pdf->AliasNbPages();
$pdf->Output();
?>