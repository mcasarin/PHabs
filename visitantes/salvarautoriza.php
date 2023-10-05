<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
header("Content-type: text/html; charset=utf-8");

$id = "";
$dataregistro = "";
$nomeautoriza = "";
$empresa = "";
$terceiro = "";
$nomevisitante = "";
$rg = "";

$id = $_POST["id"];
// $dataregistro = explode(" - ", $_POST["dataregistro"]);
// $datain = explode("/",$dataregistro[0]);
$datain = explode("/",$_POST["dataregistro"]);
$dataini = $datain[2]."-".$datain[1]."-".$datain[0];
// $datafi = explode("/",$dataregistro[1]);
// $datafim = $datafi[2]."-".$datafi[1]."-".$datafi[0];
$nomeautoriza = strtoupper($_POST["nomeautoriza"]);
$empresa = $_POST["empresa"];
$terceiro = strtoupper($_POST["terceiro"]);
$nomevisitante = strtoupper($_POST["nomevisitante"]);
$rg = $_POST["rg"];
$login = $_SESSION["usuario"];

/* **** ***** ****
create table autorizavis (
id_aut INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
periodoini date,
periodofim date,
nomeautoriza varchar(100),
empresa varchar(150),
terceiro varchar(120),
nomevisitante varchar(100),
rg varchar(12),
login varchar(30),
registro timestamp);
 **** ***** **** */
 

 
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/bootstrap.min.js"></script>
</head>
<body>
<?php
// Visualização dos valores das variáveis
// echo $dataregistro[0]."<br>";
// echo $dataregistro[1]."<br>";
// echo $dataini."<br>";
// echo $datafim."<br>";
// echo $nomeautoriza."<br>";
// echo $empresa."<br>";
// echo $nomeutiliza."<br>";
// echo $placa."<br>";
if($id > 0){ // update
	$sqlupdate = "UPDATE autorizavis set periodoini='$dataini', periodofim='$dataini', nomeautoriza='$nomeautoriza', empresa='$empresa', terceiro='$terceiro', nomevisitante='$nomevisitante', rg='$rg', login='$login' WHERE id_aut='$id';";
	// echo $sqlupdate."<br>";
	$sqlupdateexe = $conn->query($sqlupdate);
?>
<div class="container">
	<div class="row">
	<?php
		if($sqlupdateexe){
			echo "<div class=\"alert alert-success fade in\" role=\"alert\" style=\"width:250px\">
					<p><strong>Cadastro atualizado com sucesso!</strong></p>
					</div>";
					// LOG OPERADOR
					$terminalbr = $_SERVER["REMOTE_ADDR"];
					$terminalarr = explode(".", $terminalbr);
					$terminal = $terminalarr[3];
					$sqllog = "insert into logoper(Operador,Operacao,Data,Hora,Terminal) values ('".$_SESSION["nome"]."','Alterada registro de visita, nome: ".$nomevisitante.", rg: ".$rg."','".date("Y-m-d")."','".date("H:i:s")."','".$terminal."')";
					$log = $conn->query($sqllog);
					// END LOG OPERADOR
		} else {
			echo "<div class=\"alert alert-danger fade in\" role=\"alert\" style=\"width:250px\">
					<p><strong>Falha ao tentar atualizar o visitante!</strong></p>
					</div>";
					// LOG OPERADOR
					$terminalbr = $_SERVER["REMOTE_ADDR"];
					$terminalarr = explode(".", $terminalbr);
					$terminal = $terminalarr[3];
					$sqllog = "insert into logoper(Operador,Operacao,Data,Hora,Terminal) values ('".$_SESSION["nome"]."','Falha ao atualizar registro de visita, nome: ".$nomevisitante.", rg: ".$rg.", SQL: ".$sqlupdate."','".date("Y-m-d")."','".date("H:i:s")."','".$terminal."')";
					$log = $conn->query($sqllog);
					// END LOG OPERADOR
		}
		echo "<a class='btn btn-warning btn-sm' href='relautoriza.php'> Voltar </a>";

	?>
	</div>
</div>
<?php
} else { // end update to insert

$sqlinsert = "INSERT INTO autorizavis values (NULL, '$dataini', '$dataini', '$nomeautoriza', '$empresa', '$terceiro', '$nomevisitante', '$rg', '$login', NULL);";
// echo $sqlinsert."<br>";
$sqlinsertexe = $conn->query($sqlinsert);
?>
<div class="container">
	<div class="row">
	<?php
		if($sqlinsertexe){
			echo "<div class=\"alert alert-success fade in\" role=\"alert\" style=\"width:250px\">
					<p><strong>Cadastro realizado com sucesso!</strong></p>
					</div>";
					// LOG OPERADOR
					$terminalbr = $_SERVER["REMOTE_ADDR"];
					$terminalarr = explode(".", $terminalbr);
					$terminal = $terminalarr[3];
					$sqllog = "insert into logoper(Operador,Operacao,Data,Hora,Terminal) values ('".$_SESSION["nome"]."','Inserido registro de visita , nome: ".$nomevisitante.", rg: ".$rg."','".date("Y-m-d")."','".date("H:i:s")."','".$terminal."')";
					$log = $conn->query($sqllog);
					// END LOG OPERADOR
		} else {
			echo "<div class=\"alert alert-danger fade in\" role=\"alert\" style=\"width:250px\">
					<p><strong>Falha ao tentar cadastrar o visitante!</strong></p>
					</div>";
		}
		echo "<a class='btn btn-warning btn-sm' href='formautoriza.php'> Voltar </a>";

	?>
	</div>
</div>
<?php
} // end insert
?>
</body>
</html>
<?php
// EOF
?>