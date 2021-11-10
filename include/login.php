<?php
include 'connect.php';
header('Content-Type: text/html; charset=utf-8');
//envio post
$login = $_POST[htmlspecialchars('login')];
$senha = $_POST[htmlspecialchars('senha')];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/bootstrap.min.js"></script>
<title>Ops...</title>
</head>
<body>
<?php
$terminalbr = $_SERVER["REMOTE_ADDR"];
$terminalarr = explode(".", $terminalbr);
$terminal = $terminalarr[3];
//echo $login."<br>";
//echo $senha."<br>";
$sql = "SELECT Login, Senha, Nome, SenhaBloq, Tipo FROM operadores WHERE Login = '".$login."' AND Senha = '".md5($senha)."'";
//echo $sql;
$result = $conn->query($sql);
if ($result->num_rows > 0) {
	while($row = $result->fetch_assoc()) {
			if (!isset($_SESSION)) session_start();
					$_SESSION["usuario"] = $row["Login"];
					$_SESSION["nome"] = $row["Nome"];
					$_SESSION["senhabloq"] = $row["SenhaBloq"];
					$_SESSION["tipo"] = $row["Tipo"];
			if($row["SenhaBloq"] == '0') {
				$usuario=$_SESSION["usuario"];
				$date = date('Y-m-d');
				$hora = date('H:i:s');
				$sqllog = "INSERT INTO logoper (Operador,Operacao,Data,Hora,Terminal) VALUES ('$usuario','Entrada no PHabs','$date','$hora','$terminal')";
				$execlog = $conn->query($sqllog);
				header('Location: ../phabs.php');
			} elseif($row["SenhaBloq"] == '1') {
					?>
					<div class="row">
					<div class="col-xs-6 col-md-4">&nbsp;</div>
					<div class="col-xs-6 col-md-4 col-centered"><h2>Usuário bloqueado!</h2><br>
					<h4>Entre em contato com a Administração.</h4>
					<form action="../index.php">
					<input type="submit" value=" Voltar! " class="btn btn-danger btn-block" id="back">
					</form>
					</div>
					<div class="col-xs-6 col-md-4">&nbsp;</div>
					</div> <!-- class row -->
					<?php
			}
	}
	$conn->close();
} else {
	?>
	<div class="row">
	<div class="col-xs-6 col-md-4">&nbsp;</div>
	<div class="col-xs-6 col-md-4 col-centered"><h2>Usuário ou senha incorretos!</h2>
	<form action="../index.php">
	<input type="submit" value=" Voltar! " class="btn btn-danger btn-block" id="back">
	</form>
	</div>
	<div class="col-xs-6 col-md-4">&nbsp;</div>
	</div> <!-- class row -->
	</body>
	</html>
	<?php 
}
?>