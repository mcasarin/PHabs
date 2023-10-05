<?php
require ('mysql_table_v.php');
include '../include/connect.php';


class PDF extends PDF_MySQL_Table
{
function Header(){
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
    $this->Cell(120,10,utf8_decode('Relatório de Visitantes'),0,0,'C');
    // Line break
    $this->Ln(20);
    // Ensure table header is printed
    parent::Header();
}
// Page footer
function Footer(){
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

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$rg = $_POST['rg'];
    if(isset($_POST['empresa'])){
        $empresa = $_POST['empresa'];
    }
	$datatrini = $_POST['datatrini'];
	$datatrfim = $_POST['datatrfim'];
	$horainicio = $_POST['horainicio'];
    $horafim = $_POST['horafim'];
	$formdirect = $_POST['formdirect'];
	$sessao = date("His");
	$tabelatemp = "relvisitantestemp".$sessao;
	//echo $tabelatemp."<br>";
	$sqlcreatetemp = "CREATE TEMPORARY TABLE $tabelatemp SELECT * FROM relvisitantes LIMIT 0;";
	$sqlcreatetempexe = $conn->query($sqlcreatetemp);
	if($sqlcreatetempexe){
		if($formdirect == "relvisunit"){
			$sql  = "insert into $tabelatemp(Visitante,Empresa,Matricula,RG,EmpresaVis,Acesso,DataAcesso,HoraAcesso,DColetor,Autorizado,Terminal,Login) SELECT Visitante,Empresa,Matricula,RG,EmpresaVis,Acesso,DataAcesso,HoraAcesso,DColetor,Autorizado,Terminal,Login FROM movvis WHERE RG='$rg' AND DataAcesso BETWEEN '$datatrini' and '$datatrfim' AND HoraAcesso BETWEEN '$horainicio' and '$horafim'";
		} elseif($formdirect == "relvisempresa") {
			$sql  = "insert into $tabelatemp(Visitante,Empresa,Matricula,RG,EmpresaVis,Acesso,DataAcesso,HoraAcesso,DColetor,Autorizado,Terminal,Login) SELECT Visitante,Empresa,Matricula,RG,EmpresaVis,Acesso,DataAcesso,HoraAcesso,DColetor,Autorizado,Terminal,Login FROM movvis WHERE Empresa like '$empresa%' AND DataAcesso BETWEEN '$datatrini' and '$datatrfim' AND HoraAcesso BETWEEN '$horainicio' and '$horafim'";
		}
		$sqlexe = $conn->query($sql);
		
$pdf = new PDF();
$pdf->AddPage();
$prop = array('HeaderColor'=>array(255,150,100),
            'color1'=>array(255,255,255),
            'color2'=>array(220,220,220),
            'padding'=>1);
$pdf->Table($conn,'select Visitante,Empresa,Matricula,RG,Acesso,DataAcesso,HoraAcesso,DColetor,Autorizado,Terminal,Login from '.$tabelatemp.' order by RG,DataAcesso,HoraAcesso ASC',$prop);
$pdf->AliasNbPages();
ob_clean();
// force download D
$pdf->Output('D','relatorio_visitante.pdf');
$sqlexe->close(); //free result set
	} //end create temptable
$conn->close();
} //end if post
?>