<?php
include '../include/function.php';
include '../include/connect.php';
sessao();


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
<title>Valida Vagas</title>
<style>
h3 {
	font-family: Verdana;
	color: red;
}
</style>
</head>
<body>
<section class="container-fluid" style="margin-top:10px;margin-bottom:100px;">
    <div class="row">
    <div class="col-12">
	<h4>Validação de vagas cadastradas no controle versus vagas no sistema (Cabs)</h4>
	<p align="left"><a class="btn btn-outline-secondary" href="controle.php">Voltar para o menu</a></p>
<?php

$sql = "SELECT count(garagem.utiliza) as VagasControle,empresas.VagaCond as VagasSistema,garagem.utiliza as IDControle,empresas.empresa as Empresa from garagem INNER JOIN empresas ON empresas.ID=garagem.utiliza GROUP BY garagem.utiliza HAVING COUNT(garagem.utiliza) > 0 ORDER BY count(garagem.utiliza) DESC;";
$sqlexe = $conn->query($sql);
echo "<table class=\"table responsive table-striped table-bordered table-hover\">
                    <thead class=\"thead-light\">
                        <th>Vagas Controle</th><th>Vagas Sistema</th><th>Divergência</th><th>ID Controle</th><th>Empresa</th>
                    </thead>
                    <tbody>";
if($sqlexe){
	while ($row = $sqlexe->fetch_array(MYSQLI_ASSOC)){
		$vagascontrole = $row['VagasControle'];
		$vagassistema = $row['VagasSistema'];
		$IDControle = $row['IDControle'];
		$empresa = $row['Empresa'];
		
		echo "<tr><td>$vagascontrole</td><td>$vagassistema</td>";
		if($vagascontrole <> $vagassistema){
			echo "<td><h3>".($vagascontrole - $vagassistema)."</h3></td>";
		} else {
			echo "<td> -- </td>";
		}
		echo "<td>$IDControle</td><td>$empresa</td></tr>";
	}//end while sqlexe
}//end if sqlexe
?>
</tbody></table>
<p align="left"><a class="btn btn-outline-secondary" href="controle.php">Voltar para o menu</a></p>
</div></div></section>
</body></html>
<?php
//eof
?>