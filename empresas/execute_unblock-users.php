<?php
require '../include/header.php';
include '../include/function.php';
include '../include/connect.php';
if($_SERVER['REQUEST_METHOD']=="POST"){
$empresa = $_POST["empresa"];
// echo $empresa."<br>";
$obs = $_POST["obs"];
// echo $obs."<br>";
$timestamp = strtotime("+5 years");
$datacinco = date("Y-m-d",$timestamp);
$sql = "UPDATE usuarios SET Bloq='0',Validade='$datacinco',obs='$obs' WHERE empresa = '$empresa';";
echo $sql."<br>";
$sqlexe = $conn->query($sql);

if($sqlexe){
	echo "<div class=\"alert alert-success\" role=\"alert\">
		Usuários da empresa: ".$empresa." bloqueados com sucesso!
		</div>";
	$formdirect = "voltar";
	$voltar = "<form action=\"block-users.php\" method=\"post\">
	<input type=\"hidden\" name=\"formdirect\" id=\"formdirect\" value=\"".$formdirect."\">
	<button class=\"btn btn-sm btn-success btn-block\" type=\"submit\" name=\"reload\" role=\"button\"> Voltar </button>
	</form>";
	echo $voltar;
} else {
	echo "<div class=\"alert alert-wraning\" role=\"alert\">
		Houve uma falha para efetuar o bloqueio!
		Informe o código de erro: ".$conn->error;
	echo "</div>";
	$formdirect = "tentarnovamente";
	$tentarnovamente = "<form action=\"block-users.php\" method=\"post\">
	<input type=\"hidden\" name=\"formdirect\" id=\"formdirect\" value=\"".$formdirect."\">
	<button class=\"btn btn-sm btn-warning btn-block\" type=\"submit\" name=\"reload\" role=\"button\"> Tentar novamente? </button>
	</form>";
}
$conn->close();
}