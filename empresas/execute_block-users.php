<?php
require '../include/header.php';
include '../include/function.php';
include '../include/connect.php';
sessao();

if($_SERVER['REQUEST_METHOD']=="POST"){
$empresa = $_POST["empresa"];
// echo $empresa."<br>";
$obs = $_POST["obs"];
// echo $obs."<br>";
$datahoje = date('Y-m-d');
$datahojeobs = date('d/m/Y');
$nomeoperador = ucfirst($_SESSION["nome"]);
$obs = $obs .", ". $nomeoperador .", ". $datahojeobs . " #";

$sql = "UPDATE usuarios SET Bloq='1',Validade='$datahoje',obs='$obs' WHERE empresa = '$empresa';";

$sqlexe = $conn->query($sql);

if($sqlexe){
	echo "<div class='alert alert-success' role='alert'>
		Usuários da empresa: ".$empresa." bloqueados com sucesso!
		</div>";
	$formdirect = "voltar";
	$voltar = "<form action='block-users.php' method='post'>
	<input type='hidden' name='formdirect' id='formdirect' value='".$formdirect."'>
	<button class='btn btn-sm btn-success btn-block' type='submit' name='reload' role='button'> Voltar </button>
	</form>";
	echo $voltar;
} else {
	echo "<div class='alert alert-warning' role='alert'>
		Houve uma falha para efetuar o bloqueio!
		Informe o código de erro: ".$conn->error;
	echo "</div>";
	$formdirect = "tentarnovamente";
	$tentarnovamente = "<form action='block-users.php' method='post'>
	<input type='hidden' name='formdirect' id='formdirect' value='".$formdirect."'>
	<button class='btn btn-sm btn-warning btn-block' type='submit' name='reload' role='button'> Tentar novamente? </button>
	</form>";
	echo $tentarnovamente;
}
$conn->close();
}