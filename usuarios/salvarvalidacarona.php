<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
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
<title>Valida carona</title>
</head>
<body>
<?php
header("Content-type: text/html; charset=utf-8");
if($_SERVER["REQUEST_METHOD"] == "POST") {
	$id = $_POST["id"];
	$nomeuser = $_POST["nome"];
	$empresauser = $_POST["empresa"];
	$matriculauser = $_POST["matricula"];
	$terminalbr = $_SERVER["REMOTE_ADDR"];
	$terminalvalid = $terminalarr[3];
	$loginvalid = $_SESSION["usuario"];
	$registra = "update carona set nomeuser='$nomeuser',empresauser='$empresauser',matriculauser='$matriculauser',terminalvalid='$terminalvalid',loginvalid='$loginvalid',valid='1' where id_carona='$id';";
	$registraexe = $conn->query($registra);
	if($registraexe){
		?>
		<div class="alert alert-success fade in" role="alert" style="width:250px">
			<p><strong>Validação realizada com sucesso!<br>Aguarde! Você será redirecionado à tela anterior.</strong></p>
		</div>
		<?php
		header("Refresh:3; url=validacarona.php");
	} else {
		echo "Falha ao inserir o registro!<br>";
		printf("Errormessage: %s\n", $conn->error);
		?>
		<form action="validacarona.php" method="post">
			<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
		</form>
		<?php
	}
}