<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);
include '../include/function.php';
include '../include/connect.php';
sessao();
/*
*		Insere cartão do PHabs no BD
*		Versão 2.9 Data 03out20
*/
//declarando variáveis
$formdirect = "";
$matricula = "";
$cartao = "";
$fc = "";
$codigo = "";
$tipo = "";
$empresa = "";

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
<?php
header("Content-type: text/html; charset=utf-8");

if($_SERVER["REQUEST_METHOD"] == "POST") {
	
	$matricula = $_POST['matricula'];
	$cartao = $_POST['cartao'];
	$fc = $_POST['fc'];
	$codigo = $_POST['codigo'];
	$tipo = $_POST['tipo'];
	$empresa = $_POST['empresa'];
	
}
//verifica direcionamento
if(isset($_GET["formdirect"])){
	$formdirect = $_GET["formdirect"];
} else {
	$formdirect = $_POST["formdirect"];
}

switch ($formdirect){
        case 'atualiza':
			$sql="UPDATE cartoes set FC='$fc', Codigo='$codigo', Cartao='$cartao', tipo='$tipo', Empresa='$empresa' where sequencia='$matricula';";
			$result = $conn->query($sql);
			
			if($result){
				$sqlrede = "UPDATE rede1 SET cartao='$cartao' where matricula='$matricula';";
				$sqlredex = $conn->query($sqlrede);
				if($sqlredex){
				echo "<div class='alert alert-success' role='alert' style='width:250px'>
					<p><strong>Cartão atualizado com sucesso!</strong></p>
					</div>";
				echo "<div><a class='btn btn-outline-warning btn-lg' href='cartoes.php'> Voltar </a></div>";
				}
			} else {
				echo "<div class='alert alert-warning' role='alert' style='width:250px'>
					<p><strong>Algo deu errado na atualização!</strong><br>Tente novamente...<br>CodeError(".$conn->error.")</p>
					</div>";
				echo "<div><a class='btn btn-outline-warning btn-lg' href='cartoes.php'> Voltar </a></div>";
			}
		break;
		case 'insert':
		$sql = "select count(*) as ctnMatricula from cartoes where sequencia='$matricula'";
		  $result = $conn->query($sql);
		  if ($result->num_rows) {
			$row = mysqli_fetch_array($result);
			$count = $row['ctnMatricula'];
			
			if ($count > 0) {
			  echo "<div class=\"alert alert-warning fade in\" role=\"alert\" style=\"width:250px\">
					<p><strong>Algo deu errado na inserção!</strong><br><i>Matrícula já existe!</i></p>
					</div>";
			} else {
				  $sqlinsertcartao = "INSERT INTO cartoes(sequencia,FC,codigo,tipo,uso,cartao,empresa) values ('$matricula','$fc','$codigo','$tipo','NÃO','$cartao','$empresa')";
				// echo $sqlinsertcartao."<br>";
				$sqlinsertcartaoexe = $conn->query($sqlinsertcartao);
				if($sqlinsertcartaoexe){
					header( "refresh:2;url=editarcartoes.php?formdirect=insert" );
					echo "<div class=\"alert alert-success fade in\" role=\"alert\" style=\"width:250px\">
						<p><strong>Cartão inserido com sucesso!</strong></p>
						</div>";
				} else { //msg de falha na atualização
					echo "<div class=\"alert alert-warning fade in\" role=\"alert\" style=\"width:250px\">
					<p><strong>Algo deu errado na inserção!</strong><br>Tente novamente...<br>CodeError(".$conn->error.")</p>
					</div>";
				}
			}
		  }
		break;
		case 'apaga':
		break;
}
$conn->close();