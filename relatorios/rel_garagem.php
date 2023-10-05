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
include '../include/function.php';
include '../include/connect.php';
sessao();
/*
* 
*  Alterada arquivo para relatório de uso de garagem, filtro por ano
*    Data 23dez21
*
*/
//Declaração de variaveis
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

//botao voltar
$voltar = "<form action=\"index.php\" method=\"post\">
<button class=\"btn btn-sm btn-warning btn-block\" type=\"submit\" name=\"reload\" role=\"button\"> Voltar ao início </button>
</form>";
//botao tentar novamente
$tentarnovamente = "<form action=\"select_user.php\" method=\"get\">
<input type=\"hidden\" value=\"$matricula\" name=\"matricula\" id=\"matricula\">
<button class=\"btn btn-sm btn-success btn-block\" type=\"submit\" name=\"reload\" role=\"button\"> Tentar novamente? </button>
</form>";



    // $matricula = $_POST['matricula'];
    $datainicio = "2019-01-01";
    $datafim = "2019-12-31";
    $horainicio = "00:00";
    $horafim = "23:59";
    
    date_default_timezone_set('UTC');
	$datatrini = date('Y-m-d',strtotime(str_replace("/","-",$datainicio)));
    $datatrfim = date('Y-m-d',strtotime(str_replace("/","-",$datafim)));
	$sessao = date("His");
	$tabelatemp = "relgaragemtemp".$sessao;
	$sqlcreatetemp = "CREATE TEMPORARY TABLE $tabelatemp SELECT * FROM relusuario LIMIT 0;";
	$sqlcreatetempexe = $conn->query($sqlcreatetemp);
	if($sqlcreatetempexe){
    echo "<div class=\"table-responsive\">
        <table class=\"table w-auto\">
        <div class=\"row\"><div class=\"col-sm-4\"><form action=\"exportarpdf.php\" method=\"post\" target=\"_blank\">
		<input type=\"hidden\" name=\"matricula\" id=\"matricula\" value=$matricula>
			<input type=\"hidden\" name=\"datatrini\" id=\"datatrini\" value=$datatrini>
			<input type=\"hidden\" name=\"datatrfim\" id=\"datatrfim\" value=$datatrfim>
			<input type=\"hidden\" name=\"horainicio\" id=\"horainicio\" value=$horainicio>
			<input type=\"hidden\" name=\"horafim\" id=\"horafim\" value=$horafim>
        <button type=\"submit\" name=\"btnexportpdf\" id=\"btnexportpdf\">Exportar PDF</button>
        </form></div>
        <div class=\"col-sm-4\"><form action=\"exportarxls.php\" method=\"post\">
        <button type=\"submit\" name=\"btnexportxls\" id=\"btnexportxls\">Exportar XLS</button>
        </form></div>
        <div class=\"col-sm-4\">$voltar</div>
			</div>
			<div class=\"table-responsive-sm folha a4_vertical\" id=\"relatorio\">
			<table class=\"table w-auto\">
			<tr><td><img src=\"churchill.jpg\" class=\"img-thumbnail\" height=\"84\" width=\"84\"></td>
				<td><p>Condomínio Edifício Sir Winston Churchill<br>
				Avenida Paulista, 807 - Cerqueira Cesar, São Paulo - SP<br>
				<b>Relatório de usuários</b></p>
			</td><tr>
			</table>";

            
            while (strtotime($datatrini) <= strtotime($datatrfim)){
                $datalocal = date('dmY',strtotime($datatrini));
                $datalocal = "d".$datalocal;
            
                $sql  = "insert into $tabelatemp(Nome,Empresa,Matricula,Cartao,ID,Coletor,Data,Hora,Acesso) SELECT Nome,Empresa,Matricula,Cartao,ID,Descricao,Data,Hora,Acesso FROM $datalocal WHERE Descricao='ESTACIONAMENTO' and Hora BETWEEN '$horainicio' and '$horafim'";
                
                $sqlexe = $conn->query($sql);
                
                $datatrini = date ("Y-m-d", strtotime("+1 days", strtotime($datatrini)));
                
            } // end while data
            $sqltempfinal = "select Nome,Empresa,Matricula,Cartao,ID,Coletor,Data,Hora,Acesso from $tabelatemp ORDER BY Data,Hora ASC";
            
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
                $sqltempfinal->close(); //free result set
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

?>
</body>
</html>
<?php
//end file
?>
