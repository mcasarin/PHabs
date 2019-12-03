<?php
include '../include/function.php';
include '../include/connect.php';
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

$nomeu = "";
$rg = "";
$matricula = "";
$empresa = "";
$cadastro = "";
$bloq = "";
$obs = "";

//botao voltar
$voltar = "<form action=\"consultausuarios.php\" method=\"post\">
<button class=\"btn btn-sm btn-success btn-block\" type=\"submit\" name=\"reload\" role=\"button\"> Voltar </button>
</form>";
//botao tentar novamente
$tentarnovamente = "<form action=\"consultausuarios.php\" method=\"post\">
<button class=\"btn btn-sm btn-warning btn-block\" type=\"submit\" name=\"reload\" role=\"button\"> Tentar novamente? </button>
</form>";
switch($tipo) {
	case 'Documento':
			$sqlbuscarg = "SELECT Nome,RG,Matricula,Empresa,DataIncl,Bloq,OBS FROM usuarios WHERE RG LIKE '".$valor."%' ORDER BY RG ASC LIMIT 20";
			$sqlbuscargexe = $conn->query($sqlbuscarg);
			if($sqlbuscargexe->num_rows > 0) {
					
					?>
					<div class="table-responsive">
					<table class="table">
						<thead align="center">
						<th>RG</th><th>Nome</th><th>Matrícula</th><th>Empresa</th><th>Cadastro</th><th>Bloqueado</th><th>OBS</th>
						</thead>
						<tbody>
					<?php
					while($rowa = $sqlbuscargexe->fetch_array(MYSQLI_ASSOC)){
					$rg = $rowa['RG'];
					$nomeu = $rowa['Nome'];
					$matricula = $rowa['Matricula'];
					$empresa = $rowa['Empresa'];
					$cadastro = $rowa['DataIclusao'];
					$bloq = $rowa['Bloq'];
					$obs = $rowa['OBS'];
					
					echo "<tr><td>$rg</td><td>$nomeu</td><td><a href='editarusuarios.php?formdirect=update&matricula=".urlencode($matricula)."'>$matricula</a></td><td>$empresa</td>";
                    echo "<td>$cadastro</td><td>";
						if ($bloq == '1'){
							echo "<b>Sim</b>";
						} else {
							echo "Não";
						}
                    echo "</td><td>$obs</td></tr>";		
					
				} // end while
				echo "</tbody></table></div><div class=\"container\">$voltar</div>";
				$conn->close;
			} else {
				echo "Não foi encontrado nenhum dado!<br>";
				echo $tentarnovamente;
				?>
				<?php
				exit();
			}
		break;
		
    case 'Matricula':
        $sqlbuscamatricula = "SELECT Nome,RG,Matricula,Empresa,DataIncl,Bloq,OBS FROM usuarios WHERE Matricula LIKE '".$valor."%' ORDER BY Matricula ASC LIMIT 20";
        $sqlbuscamatriculaexe = $conn->query($sqlbuscamatricula);
        if($sqlbuscamatriculaexe->num_rows > 0) {
                
                ?>
                <div class="table-responsive">
                <table class="table">
                    <thead align="center">
                    <th>Matrícula</th><th>Nome</th><th>RG</th><th>Empresa</th><th>Cadastro</th><th>Bloqueado</th><th>OBS</th>
                    </thead>
                    <tbody>
                <?php
                while($rowa = $sqlbuscamatriculaexe->fetch_array(MYSQLI_ASSOC)){
                $rg = $rowa['RG'];
                $nomeu = $rowa['Nome'];
                $matricula = $rowa['Matricula'];
                $empresa = $rowa['Empresa'];
                $cadastro = $rowa['DataIclusao'];
				$bloq = $rowa['Bloq'];
				$obs = $rowa['OBS'];
                
                echo "<tr><td>$matricula</td><td>$nomeu</td><td>$rg</td><td>$empresa</td>";
                echo "<td>$cadastro</td><td>";
                    if ($bloq == '1'){
                        echo "<b>Sim</b>";
                    } else {
                        echo "Não";
                    }
                echo "</td><td>$obs</td></tr>";		
                
            } // end while
            echo "</tbody></table></div><div class=\"container\">$voltar</div>";
            $conn->close;
        } else {
            echo "Não foi encontrado nenhum dado!<br>";
			echo $tentarnovamente;
			?>
            <?php
            exit();
        }
    break;
	case 'Nome':
			$sqlbuscanome = "SELECT Nome,RG,Matricula,Empresa,DataIncl,Bloq,OBS FROM usuarios WHERE Nome LIKE '".$valor."%' ORDER BY Nome ASC LIMIT 20";
			$sqlbuscanomeexe = $conn->query($sqlbuscanome);
			if($sqlbuscanomeexe->num_rows > 0) {
					
					?>
					<div class="table-responsive">
					<table class="table">
						<thead align="center">
						<th>Nome</th><th>RG</th><th>Matrícula</th><th>Cadastro</th><th>Bloqueado</th>
						</thead>
						<tbody>
					<?php
					while($rowa = $sqlbuscanomeexe->fetch_array(MYSQLI_ASSOC)){
					$rg = $rowa['RG'];
					$nomeu = $rowa['Nome'];
					$matricula = $rowa['Matricula'];
					$empresa = $rowa['Empresa'];
					$cadastro = $rowa['DataIclusao'];
					$bloq = $rowa['Bloq'];
					$obs = $rowa['OBS'];
					
					echo "<tr><td>$nomeu</td><td>$rg</td><td>$matricula</td><td>$empresa</td>";
                    echo "<td>$cadastro</td><td>";
						if ($bloq == '1'){
							echo "<b>Sim</b>";
						} else {
							echo "Não";
						}
                    echo "</td><td>$obs</td></tr>";		
					
				} // end while
				echo "</tbody></table></div><div class=\"container\">$voltar</div>";
				$conn->close;
			} else {
				echo "Não foi encontrado nenhum dado!<br>";
				echo $tentarnovamente;
				?>
				<?php
				exit();
			}
		break;
	default:
			echo "<div class=\"container\">Você precisa selecionar o tipo de busca.<br>";
			echo $tentarnovamente."</div>";
	} //end switch
} // end request post

?>