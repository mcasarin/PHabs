<?php
require '../include/header.php';
include '../include/function.php';
include '../include/connect.php';
sessao();


if($_SERVER['REQUEST_METHOD']=="POST"){
$formdirect = $_POST["formdirect"];
$rg = $_POST["rg"];
$motivo = $_POST["motivo"];
$empresaobs = $_POST["empresaobs"];
$dataHoje = date('d/m/Y');
$nomeoperador = ucfirst($_SESSION["nome"]);
$motivo = $motivo .", ". $nomeoperador .", ". $dataHoje ." #";

switch ($formdirect){

case "block":

$sql = "UPDATE visitantes SET ListaNegra='SIM',Motivo='$motivo',Empresa='$empresaobs' WHERE rg='$rg';";

$sqlexe = $conn->query($sql);

if($sqlexe){
	echo "<div class='alert alert-success' role='alert'>
		Foi inserida com sucesso a restrição de acesso do RG: ".$rg."!
		</div>";
	$formdirect = "voltar";
	$voltar = "<form action='../consultavisitantes.php' method='get'>
	<input type='hidden' name='formdirect' id='formdirect' value='".$formdirect."'>
	<button class='btn btn-sm btn-success btn-block' type='submit' name='reload' role='button'> Voltar </button>
	</form>";
	echo $voltar;
} else {
	echo "<div class='alert alert-warning' role='alert'>
		Houve uma falha para efetuar a restrição!
		Informe o código de erro: ".$conn->error;
	echo "</div>";
	$formdirect = "tentarnovamente";
	$tentarnovamente = "<form action='../consultavisitantes.php' method='get'>
	<input type='hidden' name='formdirect' id='formdirect' value='".$formdirect."'>
	<button class='btn btn-sm btn-warning btn-block' type='submit' name='reload' role='button'> Tentar novamente? </button>
	</form>";
	echo $tentarnovamente;
}
break;
case "unblock":
$sql = "UPDATE visitantes SET ListaNegra='NÃO',Motivo='$motivo',Empresa='$empresaobs' WHERE rg='$rg';";

$sqlexe = $conn->query($sql);

if($sqlexe){
	echo "<div class='alert alert-success' role='alert'>
		Foi removida com sucesso a restrição de acesso do RG: ".$rg."!
		</div>";
	$formdirect = "voltar";
	$voltar = "<form action='../consultavisitantes.php' method='get'>
	<input type='hidden' name='formdirect' id='formdirect' value='".$formdirect."'>
	<button class='btn btn-sm btn-success btn-block' type='submit' name='reload' role='button'> Voltar </button>
	</form>";
	echo $voltar;
} else {
	echo "<div class='alert alert-warning' role='alert'>
		Houve uma falha para efetuar a restrição!
		Informe o código de erro: ".$conn->error;
	echo "</div>";
	$formdirect = "tentarnovamente";
	$tentarnovamente = "<form action='../consultavisitantes.php' method='get'>
	<input type='hidden' name='formdirect' id='formdirect' value='".$formdirect."'>
	<button class='btn btn-sm btn-warning btn-block' type='submit' name='reload' role='button'> Tentar novamente? </button>
	</form>";
	echo $tentarnovamente;
}
break;
} // switch
} // end POST
?>