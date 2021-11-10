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

//Declaração de variaveis
$usuarios = "";
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


if($_SERVER['REQUEST_METHOD'] == "POST") {
	$usuarios = $_POST['usuarios'];
    //$matricula = $_POST['matricula'];
    $datainicio = $_POST['datainicio'];
    $datafim = $_POST['datafim'];
    $horainicio = $_POST['horainicio'];
    $horafim = $_POST['horafim'];
  
    // date_default_timezone_set('UTC');
	$datatrini = date('Y-m-d',strtotime(str_replace("/","-",$datainicio)));
	$datatrfim = date('Y-m-d',strtotime(str_replace("/","-",$datafim)));
	$sessao = date("His");
	$tabelatemp = "relusuariotemp".$sessao;
	$sqlcreatetemp = "CREATE TEMPORARY TABLE $tabelatemp SELECT * FROM relusuario LIMIT 0;";
	$sqlcreatetempexe = $conn->query($sqlcreatetemp);
	if($sqlcreatetempexe){
    echo "<div class=\"table-responsive\">
        <table class=\"table w-auto\">
		<div class=\"row\"><div class=\"col-sm-4\"><form action=\"exportarpdf_ue.php\" method=\"post\" target=\"_blank\">";
			foreach($usuarios as $v){
				echo "<input type=\"hidden\" name=\"results[]\" value=\"$v\" />";
			}
			echo "<input type=\"hidden\" name=\"datatrini\" id=\"datatrini\" value=$datatrini>
			<input type=\"hidden\" name=\"datatrfim\" id=\"datatrfim\" value=$datatrfim>
			<input type=\"hidden\" name=\"horainicio\" id=\"horainicio\" value=$horainicio>
			<input type=\"hidden\" name=\"horafim\" id=\"horafim\" value=$horafim>
			<button>Exportar PDF</button></form>
			</div>
        <div class=\"col-sm-4\"><form action=\"exportarxls.php\" method=\"post\">
			<input type=\"hidden\" name=\"sql\" id=\"sql\" value=$sql>
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
            
			$contaselect = count($usuarios);
			// echo $contaselect."<br>";
			$cont = 0;
			
			// Loop da Matrícula
			while($cont < $contaselect){
				$matricula = $usuarios[$cont];
				// echo $matricula."<br>";
				$cont2 = 0;
				$contaselect2 = $contaselect;
				$dataloop = $datatrini;
				// Loop da Data
				while($cont2 < $contaselect2){
					
					// Loop Matricula por Data
					while (strtotime($dataloop) <= strtotime($datatrfim)){
						$datalocal = date('dmY',strtotime($dataloop));
						$datalocal = "d".$datalocal;
						// echo "Matricula: ".$matricula."<br>";
						// echo "contagem: ".$cont2."<br>";
						// echo "datalocal: ".$datalocal."<br>";
						$sql  = "insert into $tabelatemp(Nome,Empresa,Matricula,Cartao,ID,Coletor,Data,Hora,Acesso) SELECT Nome,Empresa,Matricula,Cartao,ID,Descricao,Data,Hora,Acesso FROM $datalocal WHERE Matricula='$matricula' and Hora BETWEEN '$horainicio' and '$horafim'";
						// echo "sql: ".$sql."<br />";
						$sqlexe = $conn->query($sql);
						
						$dataloop = date ("Y-m-d", strtotime("+1 days", strtotime($dataloop)));
						// echo $dataloop."<br>";
						
					} // end while Matricula por Data
					$cont2 = $cont2 + 1;
					
				} // end while Data
				$cont = $cont + 1;
				
			} // end while Matrícula

            $sqltempfinal = "select Nome,Empresa,Matricula,Cartao,ID,Coletor,Data,Hora,Acesso from $tabelatemp order by Matricula,Data,Hora ASC";
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
                echo $voltar."<br />";
            }
			echo "</tbody>";
		echo "</table>";
	} else {//end if Create temp table
		echo "<div class=\"alert alert-danger\" role=\"alert\">Falha na criação da tabela temporária para o relatório.</div><br>$voltar";
	}
$conn->close(); // close connection bd
} // end if POST
?>
</body>
</html>
<?php
//end file
?>