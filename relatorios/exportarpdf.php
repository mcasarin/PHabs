<?php
require ('mysql_table.php');
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
    $this->Cell(120,10,utf8_decode('Condomínio Edifício Sir Winston Churchill'),0,0,'C');
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
    $matricula = $_POST['matricula'];
    $datatrini = $_POST['datatrini'];
    $datatrfim = $_POST['datatrfim'];
    $horainicio = $_POST['horainicio'];
    $horafim = $_POST['horafim'];
	
	$sessao = date("His");
	$tabelatemp = "relusuariotemp".$sessao;
	//echo $tabelatemp."<br>";
	$sqlcreatetemp = "CREATE TEMPORARY TABLE $tabelatemp SELECT * FROM relusuario LIMIT 0;";
	$sqlcreatetempexe = $conn->query($sqlcreatetemp);
	if($sqlcreatetempexe){
		while (strtotime($datatrini) <= strtotime($datatrfim)){
                $datalocal = date('dmY',strtotime($datatrini));
                $datalocal = "d".$datalocal;
            
                $sql  = "insert into $tabelatemp(Nome,Empresa,Matricula,Cartao,ID,Coletor,Data,Hora,Acesso) SELECT Nome,Empresa,Matricula,Cartao,ID,Descricao,Data,Hora,Acesso FROM $datalocal WHERE Matricula='$matricula' and Hora BETWEEN '$horainicio' and '$horafim'";
                
                $sqlexe = $conn->query($sql);
                
                $datatrini = date ("Y-m-d", strtotime("+1 days", strtotime($datatrini)));
                
            } // end while data
        

$pdf = new PDF();
$pdf->AddPage();
$prop = array('HeaderColor'=>array(255,150,100),
            'color1'=>array(255,255,255),
            'color2'=>array(220,220,220),
            'padding'=>1);
// $pdf->Table($conn,'SELECT Nome,Empresa,Matricula,Cartao,ID,Coletor,DATE_FORMAT(Data,"%d/%m/%Y") as Data,Hora,Acesso from '.$tabelatemp.' ORDER BY Matricula,Data,Hora ASC',$prop);
$pdf->Table($conn,'SELECT Nome,Empresa,Matricula,Cartao,ID,Coletor,DATE_FORMAT(Data,"%d/%m/%Y") as Dia,Hora,Acesso from '.$tabelatemp.' ORDER BY Matricula,Data,Hora ASC',$prop);
$pdf->AliasNbPages();
ob_clean();
// force download D
$pdf->Output('D','relatorio_usuarios.pdf');
	} //end create temptable
$conn->close();
}//end if POST
?>