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
header('Content-Type: text/html; charset=iso-8859-1');

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
			$sqlbuscarg = "SELECT RG,Nome,Empresa,Cadastro,ListaNegra,Visitas,VisEmpresa FROM visitantes WHERE RG LIKE '".$valor."%' ORDER BY RG ASC LIMIT 20";
			$sqlbuscargexe = $conn->query($sqlbuscarg);
			if($sqlbuscargexe->num_rows > 0) {
				while($rowa = $sqlbuscargexe->fetch_array(MYSQLI_ASSOC))
					$rg = $rowa['RG'];
					$nomevis = $rowa['Nome'];
					$empresaobs = $rowa['Empresa'];
					$cadastro = $rowa['Cadastro'];
					$listanegra = $rowa['ListaNegra'];
					$visitas = $rowa['Visitas'];
					$visempresa = $rowa['VisEmpresa'];
					
					echo $rg;
					echo $nomevis;
					echo $empresaobs;
					echo $cadastro;
					echo $listanegra;
					echo $visitas;
					echo $visempresa;/*
					?>
					<div class="table-responsive">
					<table class="table">
						<thead align="center">
						<th>RG</th><th>Nome</th><th>Empresa/OBS</th><th>Cadastro</th><th>Restrição</th><th>Visitas</th><th>Última empresa visitada</th>
						</thead>
						<tbody>
					<?php
					echo "<tr><td>$rg</td><td>$nomevis</td><td>$empresaobs</td><td>$cadastro</td><td>$listanegra</td><td>$visitas</td><td>$visempresa</td></tr>";		
					echo "</tbody></table></div>";
				$conn->close;
			} else {
				echo "Não foi encontrado nenhum dado!<br>";
				?>
				<form action="../consultavisitantes.php" method="post">
					<button class="btn btn-sm btn-warning btn-block" type="submit" name="reload" role="button"> Tentar novamente? </button>
				</form>
				<?php
				exit();
			}
		break;
		
	case 'Nome':
			$sqlbuscanome = "SELECT Nome,RG,Empresa,Cadastro,ListaNegra,Visitas,VisEmpresa FROM visitantes WHERE Nome LIKE '".$valor."%' ORDER BY Nome ASC LIMIT 20;";
		break;
	
	case 'Usuario':
			echo "busca por usuário";
		break;
		
	default:
			echo "Você precisa selecionar o tipo de busca.<br>";
	} //end switch
} // end request post

?>