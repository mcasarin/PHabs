<?php
include 'function.php';
include 'connect.php';
sessao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.min.js"></script>
</head>
<?php
/*
*  Consulta de visitantes
*/
if($_SERVER['REQUEST_METHOD'] == "POST") {

$tipo = $_POST['tipo'];
$valor = $_POST['valor'];

$rg = "";
$nomevis = "";
$empresaobs = "";
$cadastro = "";
$listanegra = "";
$visitas = "";
$visempresa = "";

			
switch($tipo) {
	case 'Documento':
			$sqlbuscarg = "SELECT RG,Nome,Empresa,Cadastro,ListaNegra,Motivo,Visitas,VisEmpresa FROM visitantes WHERE RG LIKE '".$valor."%' ORDER BY RG ASC LIMIT 20";
			$sqlbuscargexe = $conn->query($sqlbuscarg);
			if($sqlbuscargexe->num_rows > 0) {
					
					?>
					<div class="table-responsive">
					<table class="table">
						<thead align="center">
						<th>RG</th><th>Nome</th><th>Empresa/OBS</th><th>Cadastro</th><th>Restri��o</th><th>Motivo</th><th>Visitas</th><th>�ltima empresa visitada</th>
						</thead>
						<tbody>
					<?php
					while($rowa = $sqlbuscargexe->fetch_array(MYSQLI_ASSOC)){
					$rg = $rowa['RG'];
					$nomevis = $rowa['Nome'];
					$empresaobs = $rowa['Empresa'];
					$cadastro = $rowa['Cadastro'];
					$listanegra = $rowa['ListaNegra'];
					$motivo = $rowa['Motivo'];
					$visitas = $rowa['Visitas'];
					$visempresa = $rowa['VisEmpresa'];
					
					echo "<tr><td>$rg</td><td>$nomevis</td><td>$empresaobs</td><td>$cadastro</td><td>";
					if($listanegra == 'SIM') {
						echo "<p style='text-align:center;background-color:red;'>".$listanegra."</p>";
					} else {
						echo "<p style='text-align:center;background-color:green;'>".$listanegra."</p>";				
					}
					echo "</td><td>$motivo</td><td>$visitas</td><td>$visempresa</td></tr>";		
					
				} // end while
				echo "</tbody></table></div>";
				$conn->close;
			} else {
				echo "N�o foi encontrado nenhum dado!<br>";
				?>
				<form action="../consultavisitantes.php" method="post">
					<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
				</form>
				<?php
				exit();
			}
		break;
		
	case 'Nome':
			$sqlbuscanome = "SELECT RG,Nome,Empresa,Cadastro,ListaNegra,Motivo,Visitas,VisEmpresa FROM visitantes WHERE Nome LIKE '".$valor."%' ORDER BY Nome ASC LIMIT 20;";
			$sqlbuscanomeexe = $conn->query($sqlbuscanome);
			if($sqlbuscanomeexe->num_rows > 0) {
					
					?>
					<div class="table-responsive">
					<table class="table">
						<thead align="center">
						<th>Nome</th><th>RG</th><th>Empresa/OBS</th><th>Cadastro</th><th>Restri��o</th><th>Motivo</th><th>Visitas</th><th>�ltima empresa visitada</th>
						</thead>
						<tbody>
					<?php
					while($rowb = $sqlbuscanomeexe->fetch_array(MYSQLI_ASSOC)){
						$rg = $rowb['RG'];
						$nomevis = $rowb['Nome'];
						$empresaobs = $rowb['Empresa'];
						$cadastro = $rowb['Cadastro'];
						$listanegra = $rowb['ListaNegra'];
						$motivo = $rowb['Motivo'];
						$visitas = $rowb['Visitas'];
						$visempresa = $rowb['VisEmpresa'];
					echo "<tr><td>$nomevis</td><td>$rg</td><td>$empresaobs</td><td>$cadastro</td><td>";
					if($listanegra == 'SIM') {
						echo "<p style='text-align:center;background-color:red;'>".$listanegra."</p>";
					} else {
						echo "<p style='text-align:center;background-color:green;'>".$listanegra."</p>";				
					}
					echo "</td><td>$motivo</td><td>$visitas</td><td>$visempresa</td></tr>";		
				} // end while
				echo "</tbody></table></div>";
				$conn->close;
			} else {
				echo "N�o foi encontrado nenhum dado!<br>";
				?>
				<form action="../consultavisitantes.php" method="post">
					<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
				</form>
				<?php
				exit();
			}
		break;
	
	case 'Usuario':
			$sqlbuscauser = "SELECT Nome,Empresa FROM usuarios WHERE empresa BETWEEN '00' AND '9999' AND Nome LIKE '".$valor."%' AND Bloq = '0' ORDER BY Nome ASC LIMIT 20";
			$sqlbuscauserexe = $conn->query($sqlbuscauser);
			if($sqlbuscauserexe->num_rows > 0) {
					
				?>
					<div class="table-responsive">
					<table class="table">
						<thead align="center">
						<th>Nome</th><th>Empresa</th>
						</thead>
						<tbody>
					<?php
				while($rowc = $sqlbuscauserexe->fetch_array(MYSQLI_ASSOC)){
					echo "<tr><td>$rowc[Nome]</td><td>$rowc[Empresa]</td></tr>";
				} //end while
			echo "</tbody></table></div>";
				$conn->close;
			} else {
				echo "N�o foi encontrado nenhum dado!<br>";
				?>
				<form action="../consultavisitantes.php" method="post">
					<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
				</form>
				<?php
				exit();
			}
		break;
		
	default:
			echo "Voc� precisa selecionar o tipo de busca.<br>";
	} //end switch
} // end request post

?>