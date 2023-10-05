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

$arrayMatriculas = array(16273,
17354,
537980,
18176,
18139,
900056,
17725,
23379,
17107,
16692,
18238,
22363,
17106,
537990,
11455,
16690,
16837,
16935,
22654,
17694,
17223,
17355,
17696,
16602,
17323,
16583,
17494,
16421,
23351,
11316,
17344,
17759,
11823,
18142,
17817,
17697,
18281,
16541,
17583,
18177,
11625,
23165,
17568,
22380,
17779,
17783,
537292,
22442,
16877,
17083,
23056,
16444,
11783,
16516,
16787,
16604,
23538,
17316,
17584,
17060,
16868,
537995,
23362);

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
	$tabelatemp = "relusuariotemp".$sessao;
	$sqlcreatetemp = "CREATE TEMPORARY TABLE $tabelatemp SELECT * FROM relusuario LIMIT 0;";
	$sqlcreatetempexe = $conn->query($sqlcreatetemp);
	if($sqlcreatetempexe){
    echo "<div class=\"table-responsive\">
        <table class=\"table w-auto\">
        <div class=\"row\"><div class=\"col-sm-4\"><form action=\"../relatorios/exportarpdf_ue.php\" method=\"post\" target=\"_blank\">

        <button type=\"submit\" name=\"btnexportpdf\" id=\"btnexportpdf\">Exportar PDF</button>
        </form></div>
        <div class=\"col-sm-4\"></div>
        <div class=\"col-sm-4\">$voltar</div>
			</div>
			<div class=\"table-responsive-sm folha a4_vertical\" id=\"relatorio\">
			<table class=\"table w-auto\">
			<tr><td><img src=\"../img/churchill.jpg\" class=\"img-thumbnail\" height=\"84\" width=\"84\"></td>
				<td><p>Condomínio Edifício Sir Winston Churchill<br>
				Avenida Paulista, 807 - Cerqueira Cesar, São Paulo - SP<br>
				<b>Relatório de usuários</b></p>
			</td><tr>
			</table>";


				$number = count($arrayMatriculas);
				// echo $number."<br>";
				$cc = 0;
				while ($cc < $number){
					$datatrini = "2022-12-06";
					$datatrfim = "2022-12-07";
					$horainicio = "00:00:00";
					$horafim = "23:59:59";
					while (strtotime($datatrini) <= strtotime($datatrfim)){
						$datalocal = date('dmY',strtotime($datatrini));
						$datalocal = "d".$datalocal;
					
						$sql  = "insert into $tabelatemp(Nome,Empresa,Matricula,Cartao,ID,Coletor,Data,Hora,Acesso) SELECT Nome,Empresa,Matricula,Cartao,ID,Descricao,Data,Hora,Acesso FROM $datalocal WHERE Matricula='$arrayMatriculas[$cc]' and Hora BETWEEN '$horainicio' and '$horafim'";
						// echo $sql."<br>";
						$sqlexe = $conn->query($sql);
						
						$datatrini = date ("Y-m-d", strtotime("+1 days", strtotime($datatrini)));
						
					} // end while data
					// echo $arrayMatriculas[$cc]."<br>";
					$cc++;
				}
            $sqltempfinal = "select Nome,Empresa,Matricula,Cartao,ID,Coletor,Data,Hora,Acesso from $tabelatemp order by Matricula,Data,Hora ASC";
            // echo $tabelatemp."<br>";
            $sqltempfinalexe = $conn->query($sqltempfinal);
            if($sqltempfinalexe->num_rows > 0){
                echo "<table class=\"table table-sm table-striped table-bordered table-hover\">
                    <thead class=\"thead-light\">
                        <th>Nome</th><th>Empresa</th><th>Matricula</th><th>Cartão</th><th>ID</th><th>Coletor</th><th>Data</th><th>Hora</th><th>Acesso</th>
                    </thead>
                    <tbody>";
                while($linhatemp = $sqltempfinalexe->fetch_array(MYSQLI_ASSOC)){
                    $nome = $linhatemp["Nome"];
                    $empresa = $linhatemp["Empresa"];
                    $matricula = $linhatemp["Matricula"];
                    $cartao = $linhatemp["Cartao"];
                    $id = $linhatemp["ID"];
                    $coletor = $linhatemp["Coletor"];
                    $data = $linhatemp["Data"];
                    $hora = $linhatemp["Hora"];
                    $acesso = $linhatemp["Acesso"];  
                echo "<tr><td>$nome</td><td>$empresa</td><td>$matricula</td><td>$cartao</td><td>$id</td><td>$coletor</td><td>$data</td><td>$hora</td><td>$acesso</td></tr>";
                } // end while temp
                // $sqltempfinal->close; //free result set
            } else {// end if temp
                echo "Não foi encontrado nenhum dado no período informado.<br />";
                echo $tentarnovamente."<br />";
            }
			echo "</tbody>";
		echo "</table>";
	} else { // end if Create temp table
		echo "<div class=\"alert alert-danger\" role=\"alert\">Falha na criação da tabela temporária para o relatório.</div><br>$voltar";
	}
$conn->close(); // close connection bd

/*} // end if POST
*/?>
</body>
</html>
<?php
//end file
?>