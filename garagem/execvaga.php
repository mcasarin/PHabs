<?php
include '../include/function.php';
include '../include/connect.php';
sessao();

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$id = $_POST['id'];
	$vaga = $_POST['vaga'];
	$prop = $_POST['prop'];
	$conjunto = $_POST['conjunto'];
	$utiliza = $_POST['utiliza'];
	$anotacao = $_POST['anotacao'];
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-1.11.3.js"></script>
<script src="../js/bootstrap.min.js"></script>
<title>Vagas</title>
</head>
<body>
<section class="container-fluid" style="margin-top:10px;margin-bottom:100px;">
    <div class="row">
		<div class="btn col-6">
			<?php
			if(isset($_POST['salvar'])){
				$sql_salvar = "UPDATE garagem SET vaga='$vaga',proprietario='$prop',conjunto='$conjunto',utiliza='$utiliza',anotacao='$anotacao' WHERE id_gar = '$id';";
				$sql_salvarexe = $conn->query($sql_salvar);
				if($sql_salvarexe){
					echo "<div class=\"alert alert-success\"><b>Salvo</b> com sucesso!</div> ";
				} else {
					echo "<div class=\"alert alert-danger\">Falha ao salvar...</div> ";
				}
			} elseif($_POST['excluir']){
				$sql_excluir = "DELETE FROM garagem WHERE id_gar = '$id';";
				$sql_excluirexe = $conn->query($sql_excluir);
				if($sql_excluir){
					echo "<div class=\"alert alert-success\"><b>Excluído</b> com sucesso!</div> ";
				} else {
					echo "<div class=\"alert alert-danger\">Falha ao excluir...</div> ";
				}
			} elseif($_POST['gravar']){
				$sql_gravar = "INSERT INTO garagem (vaga,proprietario,conjunto,utiliza,anotacao) VALUES ('$vaga','$prop','$conjunto','$utiliza','$anotacao')";
				$sql_gravarexe = $conn->query($sql_gravar);
				if($sql_gravarexe){
					echo "<div class=\"alert alert-success\"><b>Gravado</b> com sucesso!</div> ";
				} else {
					echo "<div class=\"alert alert-danger\">Falha ao gravar...</div> ";
				}
			}
			?>
<p align="left"><a class="btn btn-outline-secondary" href="vagas.php">Voltar para lista</a></p>
		</div>
	</div>
</section>
</body>
</html>
<?php
$conn->close;
}//end if get
//eof
?>