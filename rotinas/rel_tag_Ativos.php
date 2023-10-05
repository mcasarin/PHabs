<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/bootstrap.min.js"></script>
</head>
<html>
<body>
<?php
// print Errors
ini_set('display_errors', 1);
ini_set('display_startup_errors', 1);
error_reporting(E_ALL);

include '../include/function.php';
include '../include/connect.php';
sessao();

// Declaração de variaveis
$nome = "";
$empresa = "";
$matricula = "";
$cartao = "";
$coletor = "";
$id = "";
$data = "";
$hora = "";
$acesso = "";
$datainicio = "";
$datafim = "";

$arrayMatriculas = array(24,
26,
30,
46,
48,
53,
57,
65,
68,
75,
76,
85,
86,
104,
106,
107,
109,
111,
125,
126,
127,
152,
153,
178,
180,
191,
195,
196,
197,
202,
203,
213,
233,
239,
252,
273,
281,
282,
283,
307,
317,
321,
324,
326,
327,
331,
343,
344,
345,
348,
349,
353,
370,
377,
390,
401,
412,
420,
422,
423,
424,
425,
466,
468,
481,
488,
491,
501,
505,
511,
515,
516,
518,
525,
530,
541,
542,
548,
550,
551,
553,
556,
558,
559,
562,
564,
567,
569,
571,
578,
587,
591,
602,
605,
609,
612,
624,
636,
637,
646,
650,
653,
654,
655,
657,
659,
670,
672,
681,
682,
691,
692,
693,
694,
706,
708,
709,
714,
724,
731,
733,
735,
744,
745,
756,
761,
763,
766,
771,
774,
783,
784,
785,
793,
801,
803,
805,
807,
814,
815,
816,
817,
818,
821,
822,
823,
826,
827,
830,
841,
848,
863,
869,
873,
875,
880,
882,
887,
888,
890,
893,
894,
898,
900,
901,
902,
904,
906,
907,
908,
910,
914,
918,
920,
921,
923,
924,
925,
926,
927,
930,
932,
934,
936,
937,
938,
939,
940,
945,
947,
948,
950,
953,
961,
965,
966,
967,
968,
970,
971,
972,
973,
976,
983,
984,
985,
987,
989,
990,
991,
992,
994,
995,
996,
997,
999,
120050,
120051,
120052,
120053,
120054,
120055,
120056,
120057,
120058,
120059,
120060,
120062,
120065,
120066,
120067,
120068,
120069,
120070,
120071,
120073,
120074,
120077,
120078,
120079,
120080,
120081,
120082,
120083,
120084,
120085,
120086,
120088,
120089,
120090,
120091,
120092,
120093,
120094,
120095,
120096);


//botao voltar
$voltar = "<form action=\"index.php\" method=\"post\">
<button class=\"btn btn-sm btn-warning btn-block\" type=\"submit\" name=\"reload\" role=\"button\"> Voltar ao início </button>
</form>";
//botao tentar novamente
$tentarnovamente = "<form action=\"select_user.php\" method=\"get\">
<input type=\"hidden\" value=\"$matricula\" name=\"matricula\" id=\"matricula\">
<button class=\"btn btn-sm btn-success btn-block\" type=\"submit\" name=\"reload\" role=\"button\"> Tentar novamente? </button>
</form>";


/*if($_SERVER['REQUEST_METHOD'] == "POST") {
    $matricula = $_POST['matricula'];
    $datainicio = $_POST['datainicio'];
    $datafim = $_POST['datafim'];
    $horainicio = $_POST['horainicio'];
    $horafim = $_POST['horafim'];*/
    
    date_default_timezone_set('UTC');
	$sessao = date("His");
	/*$tabelatemp = "relusuariotemp".$sessao;
	$sqlcreatetemp = "CREATE TEMPORARY TABLE $tabelatemp SELECT * FROM relusuario LIMIT 0;";
	$sqlcreatetempexe = $conn->query($sqlcreatetemp);
	if($sqlcreatetempexe){
    echo "<div class=\"table-responsive\">
        <table class=\"table w-auto\">
        <div class=\"row\"><div class=\"col-sm-4\"><form action=\"exportar__pdf.php\" method=\"post\" target=\"_blank\">

        <button type=\"submit\" name=\"btnexportpdf\" id=\"btnexportpdf\">Exportar PDF</button>
        </form></div>
        <div class=\"col-sm-4\"></div>
        <div class=\"col-sm-4\">$voltar</div>
			</div>
			<div class=\"table-responsive-sm folha a4_vertical\" id=\"relatorio\">
			<table class=\"table w-auto\">
			<tr><td><img src=\"churchill.jpg\" class=\"img-thumbnail\" height=\"84\" width=\"84\"></td>
				<td><p>Condomínio Edifício Sir Winston Churchill<br>
				Avenida Paulista, 807 - Cerqueira Cesar, São Paulo - SP<br>
				<b>Relatório de tags</b></p>
			</td><tr>
			</table>";
		*/

				$number = count($arrayMatriculas);
				// echo $number."<br>";
				$cc = 0;
				$acessos = 0;
				while ($cc < $number){
					$datatrini = "2021-11-01";
					$datatrfim = "2022-11-01";
					$horainicio = "00:00:00";
					$horafim = "23:59:59";
					while (strtotime($datatrini) <= strtotime($datatrfim)){
						$datalocal = date('dmY',strtotime($datatrini));
						$datalocal = "d".$datalocal;
					
						// $sql  = "insert into $tabelatemp(Nome,Empresa,Matricula,Cartao,ID,Coletor,Data,Hora,Acesso) SELECT Nome,Empresa,Matricula,Cartao,ID,Descricao,Data,Hora,Acesso FROM $datalocal WHERE Matricula='$arrayMatriculas[$cc]' and Hora BETWEEN '$horainicio' and '$horafim'";
						$sql  = "SELECT Nome,Empresa,Matricula,Cartao,ID,Descricao,Data,Hora,Acesso FROM $datalocal WHERE Matricula='$arrayMatriculas[$cc]' and Hora BETWEEN '$horainicio' and '$horafim'";
						// echo $sql."<br>";
						$sqlexe = $conn->query($sql);
						if($sqlexe->num_rows > 0){
							$acessos++;
						}
						$datatrini = date ("Y-m-d", strtotime("+1 days", strtotime($datatrini)));
						
					} // end while data
					echo "Matricula: ".$arrayMatriculas[$cc]." possui ".$acessos."<br>";
					$cc++;
					$acessos = 0;
				}
				
            /*$sqltempfinal = "select Nome,Empresa,Matricula,count(Matricula) as Visitas from $tabelatemp group by nome,empresa,matricula ORDER BY Nome,Empresa,Visitas ASC";
            // echo $tabelatemp."<br>";
            $sqltempfinalexe = $conn->query($sqltempfinal);
            if($sqltempfinalexe->num_rows > 0){
                echo "<table class=\"table table-sm table-striped table-bordered table-hover\">
                    <thead class=\"thead-light\">
                        <th>Nome</th><th>Empresa</th><th>Matricula</th><th>Acessos</th>
                    </thead>
                    <tbody>";
                while($linhatemp = $sqltempfinalexe->fetch_array(MYSQLI_ASSOC)){
                    $nome = $linhatemp["Nome"];
                    $empresa = $linhatemp["Empresa"];
                    $matricula = $linhatemp["Matricula"];
                    $visitas = $linhatemp["Visitas"];
                echo "<tr><td>$nome</td><td>$empresa</td><td>$matricula</td><td>$visitas</td></tr>";
                } // end while temp
                //$sqltempfinal->close(); //free result set
            } else {// end if temp
                echo "Não foi encontrado nenhum dado no período informado.<br />";
                echo $tentarnovamente."<br />";
            }
			echo "</tbody>";
		echo "</table>";
	} else { // end if Create temp table
		echo "<div class=\"alert alert-danger\" role=\"alert\">Falha na criação da tabela temporária para o relatório.</div><br>$voltar";
	}*/
$conn->close(); // close connection bd

/*} // end if POST
*/?>
</body>
</html>
<?php
//end file
?>