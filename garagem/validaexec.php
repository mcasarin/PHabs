<?php
include '../include/function.php';
include '../include/connect.php';
include '../include/connectremote.php';
sessao();

$ID = "";
$Veiculo = "";
$Placa = "";
$Vaga = "";
$Login = "";
$Conjunto = "";
$motivo = "";

?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<link rel="stylesheet" href="../css/churchill.css">
<script src="../js/jquery-1.11.3.js"></script>
<script src="../js/bootstrap.js"></script>
<title>Solicitação de TAG</title>
</head>
<body>
<div class="col-md-2 container col-centered"><a class="btn btn-success" role="button" href="solicitacaotagsite.php"> <<< Voltar <<< </a></div>

<?php
if($_SERVER["REQUEST_METHOD"] == "GET"){
	$ID = $_GET['ID'];
	$valid = $_GET['valid'];
	$motivo = $_GET['motivo'];
	
	// echo $ID."<br>";
	// echo $valid."<br>";

	switch ($valid){
		case 'S':
			$sql = "update ybd53_facileforms_records set viewed='1',archived='1',exported='1' where record = '$ID';";
			$execSql = $connremote->query($sql);
			if($execSql->num_rows > 0){
				echo "<span class='alert alert-success'>Site atualizado!</span>";
			}
			$sqlVeiculo = "select a.value as Veiculo from ybd53_facileforms_subrecords a where a.name = 'Veiculo' and a.record = '$ID';";
			$execSqlVeiculo = $connremote->query($sqlVeiculo);
			if($execSqlVeiculo->num_rows > 0){
				while($row = $execSqlVeiculo->fetch_assoc()){
					$Veiculo = $row['Veiculo'];
				}
			}
			$sqlPlaca = "select a.value as Placa from ybd53_facileforms_subrecords a where a.name = 'Placa' and a.record = '$ID';";
			$execSqlPlaca = $connremote->query($sqlPlaca);
			if($execSqlPlaca->num_rows > 0){
				while($row = $execSqlPlaca->fetch_assoc()){
					$Placa = $row['Placa'];
				}
			}
			$sqlVaga = "select a.value as Vaga from ybd53_facileforms_subrecords a where a.name = 'Vaga' and a.record = '$ID';";
			$execSqlVaga = $connremote->query($sqlVaga);
			if($execSqlVaga->num_rows > 0){
				while($row = $execSqlVaga->fetch_assoc()){
					$Vaga = $row['Vaga'];
				}
			}
			$sqlLogin = "select a.value as Login from ybd53_facileforms_subrecords a where a.name = 'Login' and a.record = '$ID';";
			$execSqlLogin = $connremote->query($sqlLogin);
			if($execSqlLogin->num_rows > 0){
				while($row = $execSqlLogin->fetch_assoc()){
					$Login = $row['Login'];
				}
			}
			$sqlConjunto = "select a.value as Conjunto from ybd53_facileforms_subrecords a where a.name = 'Conjunto' and a.record = '$ID';";
			$execSqlConjunto = $connremote->query($sqlConjunto);
			if($execSqlConjunto->num_rows > 0){
				while($row = $execSqlConjunto->fetch_assoc()){
					$Conjunto = $row['Conjunto'];
				}
			}
			$sqlinsert = "INSERT INTO solicita (id_sol, tag ,nomesolicita, empresa, carro, placa, datasolicita) VALUES (NULL,'N/D','$Login','$Conjunto','$Veiculo','$Placa',NOW())";
			$execsqlinsert = $conn->query($sqlinsert);
			if($execsqlinsert->num_rows > 0){
				echo "<span class='alert alert-success'>Solicitação de tag encaminhada!</span>";
			}
			$sqlmotivosite = "insert into ybd53_facileforms_subrecords (record,element,title,name,type,value) values ('$ID','385','Validação','validacao','Text','$motivo');";
			$execmotivosite = $connremote->query($sqlmotivosite);
			if($execmotivosite->num_rows > 0){
				echo "<span class='alert alert-success'>Update do motivo no site!</span>";
			}
		break;
		
		case 'N':
				$sql = "update ybd53_facileforms_records set viewed='1',archived='1',exported='0' where id = '$ID';";
				$sql2 = "insert into ybd53_facileforms_subrecords (record,element,title,name,type,value) values ('$ID','385','Validação','validacao','Text','$motivo');";
				$execsql = $connremote->query($sql);
				if($execsql->num_rows > 0){
					echo "<span class='alert alert-warning'>Solicitação invalidada!</span><br><br><br>";
					$execsql2 = $connremote->query($sql2);
					if($execsql2->num_rows > 0){
						echo "<span class='alert alert-danger'>Lembre-se de notificar o condômino.</span>";
					}
				}
		break;
		
	}
} else {
	echo "FAIL!!!";
	// BLANK PAGE
}
$connremote->close();
$conn->close();
?>
</body>
</html>