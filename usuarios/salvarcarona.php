<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
$dataregistro = "";
$horaregistro = "";
$catraca = "";
$nome = "";
$empresa = "";
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" href="../js/bootstrap-datepicker-1.9.0-dist/css/bootstrap-datepicker3.css">
	<script src="../js/jquery-3.3.1.min.js"></script>
	<script src="../js/bootstrap.min.js"></script>
<title>Cadastro carona</title>
</head>
<body>
<?php
header("Content-type: text/html; charset=utf-8");
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$dataregistro = $_POST["dataregistro"];
	// echo "date1 ".$dataregistro."<br>";
	$dataregistro = date("Y-m-d", strtotime(str_replace("/", "-",$dataregistro)));
	// echo "date2 ".$dataregistro."<br>";
	$horaregistro = $_POST["horaregistro"];
	$catraca = $_POST["catraca"];
	$nome = $_POST["nome"];
	$nome = ltrim($nome);
	$nome = preg_replace('/[^A-Za-z0-9\. -]/', '', $nome);
	$empresa = $_POST["empresa"];
	$terminalbr = $_SERVER["REMOTE_ADDR"];
	// echo $terminal."<br>";
	$terminalarr = explode(".", $terminalbr);
	$terminal = $terminalarr[3];
	$login = $_SESSION["usuario"];
	$registra = "INSERT INTO carona (dataregistro,horaregistro,catraca,nome,empresa,terminal,login,valid) values ('$dataregistro','$horaregistro','$catraca','$nome','$empresa','$terminal','$login','0');";
	$registraexe = $conn->query($registra);
	if($registraexe){
		?>
		<div class="alert alert-success fade in" role="alert" style="width:250px">
			<p><strong>Cadastro realizado com sucesso!<br>Aguarde! Você será redirecionado à tela anterior.</strong></p>
		</div>
		<?php
		header("Refresh:3; url=cadastrocarona.php");
	} else {
		echo "Falha ao inserir o registro!<br>";
		printf("Errormessage: %s\n", $conn->error);
		?>
		<form action="cadastrocarona.php" method="post">
			<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
		</form>
		<?php
	}
}