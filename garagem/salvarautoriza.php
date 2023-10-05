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
$nomeutiliza = "";
$placa = "";

$id = $_POST["id"];
$dataregistro = explode(" - ", $_POST["dataregistro"]);
$datain = explode("/",$dataregistro[0]);
$dataini = $datain[2]."-".$datain[1]."-".$datain[0];
$datafi = explode("/",$dataregistro[1]);
$datafim = $datafi[2]."-".$datafi[1]."-".$datafi[0];
$nomeautoriza = $_POST["nomeautoriza"];
$empresa = $_POST["empresa"];
$terceiro = $_POST["terceiro"];
$nomeutiliza = $_POST["nomeutiliza"];
$placa = $_POST["placa"];
$login = $_SESSION["usuario"];

/* **** ***** ****
create table autoriza (
id_aut INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
periodoini date,
periodofim date,
nomeautoriza varchar(100),
empresa varchar(150),
terceiro varchar(120),
nomeutiliza varchar(100),
placa varchar(8),
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
$sqlinsert = "UPDATE autoriza set periodoini='$dataini', periodofim='$datafim', nomeautoriza='$nomeautoriza', empresa='$empresa', terceiro='$terceiro', nomeutiliza='$nomeutiliza', placa='$placa', login='$login' WHERE id_aut='$id';";
// echo $sqlinsert."<br>";
$sqlinsertexe = $conn->query($sqlinsert);
?>
<div class="container">
	<div class="row">
	<?php
		if($sqlinsertexe){
			echo "<div class=\"alert alert-success fade in\" role=\"alert\" style=\"width:250px\">
					<p><strong>Cadastro atualizado com sucesso!</strong></p>
					</div>";
		} else {
			echo "<div class=\"alert alert-danger fade in\" role=\"alert\" style=\"width:250px\">
					<p><strong>Falha ao tentar cadastrar o veículo!</strong></p>
					</div>";
		}
		echo "<a class='btn btn-warning btn-sm' href='relautoriza.php'> Voltar </a>";

	?>
	</div>
</div>
<?php
} else { // end update to insert

$sqlinsert = "INSERT INTO autoriza values (NULL, '$dataini', '$datafim', '$nomeautoriza', '$empresa', '$terceiro', '$nomeutiliza', '$placa', '$login', NULL);";
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
		} else {
			echo "<div class=\"alert alert-danger fade in\" role=\"alert\" style=\"width:250px\">
					<p><strong>Falha ao tentar cadastrar o veículo!</strong></p>
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