<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery-3.6.4.min.js"></script>
<script src="../js/bootstrap.js"></script>
<style>
html {
	font-style:arial;
}
th {
	font-size:9px;
}
td {
	font-size:9px;
}
p {
	text-align: center;
	font-size:14px;
}
.folha { background-color: #fff; padding: 0.5em; }
.a4_vertical { width: 793px; height: 1122px; }
.a4_horizontal { width: 1122px; height: 793px; }
</style>
</head>
<html>
<body>
<?php
include '../include/function.php';
include '../include/connect.php';
sessao();

//Declaração de variaveis
$empresa = "";
$datainicio = "";
$datafim = "";
$horainicio = "";
$horafim = "";
$formdirect = "";

//botao voltar
$voltar = "<form action=\"index.php\" method=\"post\">
<button class=\"btn btn-sm btn-warning btn-block\" type=\"submit\" name=\"start\" role=\"button\"> Voltar ao início </button>
</form>";
//botao tentar novamente
$tentarnovamente = "<form action=\"select_empresa_v.php\" method=\"get\">
<input type=\"hidden\" value=\"relvisempresa\" name=\"formdirect\" id=\"formdirect\">
<button class=\"btn btn-sm btn-success btn-block\" type=\"submit\" name=\"reload\" role=\"button\"> Tentar novamente? </button>
</form>";


if($_SERVER['REQUEST_METHOD'] == "POST") {
    $empresa = $_POST['empresa'];
    $datainicio = $_POST['datainicio'];
    $datafim = $_POST['datafim'];
    $horainicio = $_POST['horainicio'];
    $horafim = $_POST['horafim'];
	$formdirect = $_POST['formdirect'];
    
    date_default_timezone_set('UTC');
	$datatrini = date('Y-m-d',strtotime(str_replace("/","-",$datainicio)));
	$datatrfim = date('Y-m-d',strtotime(str_replace("/","-",$datafim)));
	$sessao = date("His");
	$tabelatemp = "relvisitantestemp".$sessao;
	$sqlcreatetemp = "CREATE TEMPORARY TABLE $tabelatemp SELECT * FROM relvisitantes LIMIT 0;";
	$sqlcreatetempexe = $conn->query($sqlcreatetemp);
	if($sqlcreatetempexe){
		//echo "Tabela temporária criada!<br>";
		echo "<div class=\"row\"><div class=\"col-sm-4\"><form action=\"exportarpdf_v.php\" method=\"post\" target=\"_blank\">
			<input type=\"hidden\" name=\"empresa\" id=\"empresa\" value=$empresa>
			<input type=\"hidden\" name=\"datatrini\" id=\"datatrini\" value=$datatrini>
			<input type=\"hidden\" name=\"datatrfim\" id=\"datatrfim\" value=$datatrfim>
			<input type=\"hidden\" name=\"horainicio\" id=\"horainicio\" value=$horainicio>
			<input type=\"hidden\" name=\"horafim\" id=\"horafim\" value=$horafim>
			<input type=\"hidden\" name=\"formdirect\" id=\"formdirect\" value=$formdirect>
			<button>Exportar PDF</button></form>
			</div>
			<div class=\"col-sm-4\"><form action=\"exportarxls_v.php\" method=\"post\">
				<button type=\"submit\" name=\"btnexportxls\" id=\"btnexportxls\">Exportar XLS</button>
			</form></div>
			<div class=\"col-sm-4\">$voltar</div>
			</div>
			<div class=\"table-responsive-sm folha a4_vertical\" id=\"relatorio\">
			<table class=\"table w-auto\">
			<tr><td><img src=\"churchill.jpg\" class=\"img-thumbnail\" height=\"84\" width=\"84\"></td>
				<td><p>Condomínio Edifício Sir Winston Churchill<br>
				Avenida Paulista, 807 - Cerqueira Cesar, São Paulo - SP<br>
				<b>Relatório de Visitantes</b></p>
			</td><tr>
			</table>";
				
				
					$datalocal = date('dmY',strtotime($datatrini));
					$datalocal = "d".$datalocal;
				
					$sql  = "insert into $tabelatemp(Visitante,Empresa,Matricula,RG,EmpresaVis,Acesso,DataAcesso,HoraAcesso,DColetor,Autorizado,Terminal,Login) SELECT Visitante,Empresa,Matricula,RG,EmpresaVis,Acesso,DataAcesso,HoraAcesso,DColetor,Autorizado,Terminal,Login FROM movvis WHERE Empresa like '$empresa%' AND DataAcesso BETWEEN '$datatrini' and '$datatrfim' AND HoraAcesso BETWEEN '$horainicio' and '$horafim'";
					//echo $sql."<br>";
					$sqlexe = $conn->query($sql);

			$sqltempfinal = "select Visitante,Empresa,Matricula,RG,EmpresaVis,Acesso,DataAcesso,HoraAcesso,DColetor,Autorizado,Terminal,Login from $tabelatemp order by RG,DataAcesso,HoraAcesso ASC";
			$sqltempfinalexe = $conn->query($sqltempfinal);
			if($sqltempfinalexe->num_rows > 0){
				echo "<table class=\"table table-sm table-striped table-bordered table-hover\">
                    <thead class=\"thead-light\">
                        <th>Visitante</th><th>Empresa</th><th>Cartão</th><th>RG</th><th>Empresa Visitante</th><th>Acesso</th><th>Data</th><th>Hora</th><th>Dispositivo</th><th>Autorizador</th><th>Terminal</th><th>Login</th>
                    </thead>
                    <tbody>";
                while($linhatemp = $sqltempfinalexe->fetch_array(MYSQLI_ASSOC)){
                    $visitante = $linhatemp["Visitante"];
                    $empresa = $linhatemp["Empresa"];
                    $matricula = $linhatemp["Matricula"];
                    $rg = $linhatemp["RG"];
                    $terminal = $linhatemp["Terminal"];
                    $login = $linhatemp["Login"];
                    $empresavis = $linhatemp["EmpresaVis"];
                    $acesso = $linhatemp["Acesso"];
					$dataacesso = $linhatemp["DataAcesso"];
					$horaacesso = $linhatemp["HoraAcesso"];
					$dcoletor = $linhatemp["DColetor"];
					$autorizado = $linhatemp["Autorizado"];				
                echo "<tr><td>$visitante</td><td>$empresa</td><td>$matricula</td><td>$rg</td><td>$empresavis</td><td>$acesso</td><td>$dataacesso</td><td>$horaacesso</td><td>$dcoletor</td><td>$autorizado</td><td>$terminal</td><td>$login</td></tr>";
                } // end while temp
                $sqltempfinalexe->close(); //free result set
				echo "</table></div>";
				echo "<div id=\"novorelatorio\"></div>";
			} else {//end if sqltempfinalexe
				echo "Não foi encontrado nenhum dado no período informado.<br />";
                echo $tentarnovamente."<br />";
			}
	} else {//end if Create temp table
		echo "<div class=\"alert alert-danger\" role=\"alert\">Falha na criação da tabela temporária para o relatório.</div><br>$voltar";
	}
	
	$conn->close(); // close connection bd
} //end if POST
?>