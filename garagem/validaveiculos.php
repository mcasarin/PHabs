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
<title>Valida Veículos</title>
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
	<h4>Validação de veículos cadastrados no sistema (Cabs) versus vagas </h4>
	<p align="left"><a class="btn btn-outline-secondary" href="controle.php">Voltar para o menu</a></p>
<?php

$sql = "SELECT empresas.Empresa as Empresa,empresas.VagaCond as Vagas,usuarios.Empresa as EmpresaUsuario,usuarios.Nome as Veiculo,usuarios.Placa as Placa,usuarios.Matricula as Matricula,usuarios.Bloq as Bloq FROM usuarios INNER JOIN empresas ON empresas.Empresa = usuarios.Empresa WHERE usuarios.Placa > '0' ORDER BY Empresa,Matricula ASC;";
$sqlexe = $conn->query($sql);
echo "<table class=\"table responsive table-striped table-bordered table-hover\">
        <thead class=\"thead-light\">
            <th>Empresa</th><th>Matricula</th><th>Veiculo</th><th>Placa</th><th>Bloqueado</th><th>Vagas</th>
        </thead>
    <tbody>";
if($sqlexe){
	while ($row = $sqlexe->fetch_array(MYSQLI_ASSOC)){
		$empresa = $row['Empresa'];
		$vagas = $row['Vagas'];
		$empresausuario = $row['EmpresaUsuario'];
		$veiculo = $row['Veiculo'];
		$placa = $row['Placa'];
		$matricula = $row['Matricula'];
		$bloq = $row['Bloq'];
		
		echo "<tr><td>$empresa</td><td>$matricula</td>";
		echo "<td>$veiculo</td><td>$placa</td>";
		if($bloq > 0){
			echo "<td><h3>Bloqueado</h3></td>";
		} else {
			echo "<td> -- </td>";
		}
		echo "<td>$vagas</td></tr>";
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