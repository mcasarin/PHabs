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
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/bootstrap.min.js"></script>
</head>
<?php
/*
*  Consulta de usuarios
*/
// Declaração de variáveis
$nomeu = "";
$rg = "";
$matricula = "";
$empresa = "";
$cadastro = "";
$bloq = "";
$obs = "";

// Envio por GET página empresas (consulta edição)

if($_SERVER['REQUEST_METHOD'] == "GET"){
	$empresa = $_GET['empresa'];
	$sqlbuscauserEmpresa = "SELECT Nome,RG,Matricula,Empresa,DataIncl,Bloq,OBS FROM usuarios WHERE Empresa = '".$empresa."' ORDER BY Matricula + 0 ASC";
        $sqlbuscauserEmpresaexe = $conn->query($sqlbuscauserEmpresa);
        if($sqlbuscauserEmpresaexe->num_rows > 0) {
                ?>
                <div class="table-responsive">
                <table class="table">
                    <thead align="center">
                    <th>Matrícula</th><th>Nome</th><th>RG</th><th>Empresa</th><th>Cadastro</th><th>Bloqueado</th><th>OBS</th>
                    </thead>
                    <tbody>
                <?php
                while($rowa = $sqlbuscauserEmpresaexe->fetch_array(MYSQLI_ASSOC)){
                $rg = $rowa['RG'];
                $nomeu = $rowa['Nome'];
                $matricula = $rowa['Matricula'];
                $empresa = $rowa['Empresa'];
                $cadastro = $rowa['DataIncl'];
				$bloq = $rowa['Bloq'];
				$obs = $rowa['OBS'];
				echo "<tr><td><a href='editarusuarios.php?formdirect=update&matricula=".urlencode($matricula)."'>$matricula</a></td>";
                echo "<td>$nomeu</td><td>$rg</td><td>$empresa</td><td>$cadastro</td><td>";
                    if ($bloq == '1'){
                        echo "<b>Sim</b>";
                    } else {
                        echo "Não";
                    }
                echo "</td><td>$obs</td></tr>";
                
            } // end while
            echo "</tbody></table></div>";
            $conn->close;
        } else {
            echo "Não foi encontrado nenhum dado!<br>";
			?>
            <?php
            exit();
        }
}

// Envio por POST página usuários (consulta/edição)
if($_SERVER['REQUEST_METHOD'] == "POST") {
$tipo = $_POST['tipo'];
$valor = htmlspecialchars($_POST['valor']);
$formdirect = $_POST['formdirect'];


//botao voltar carregando opção do menu (relatorio ou consulta) - formdirect
$voltar = "<div class='row'><div class='col-md-2 container col-centered'><form action='consultausuarios.php' method='post'>
<input type='hidden' name='formdirect' id='formdirect' value='".$formdirect."'>
<button class='btn btn-sm btn-success btn-block' type='submit' name='reload' role='button'> <<< Voltar <<< </button>
</form></div></div>";

//botao tentar novamente carregando opção do menu (relatorio ou consulta) - formdirect
$tentarnovamente = "<form action=\"consultausuarios.php\" method=\"post\">
<input type=\"hidden\" name=\"formdirect\" id=\"formdirect\" value=\"".$formdirect."\">
<button class=\"btn btn-sm btn-warning btn-block\" type=\"submit\" name=\"reload\" role=\"button\"> Tentar novamente? </button>
</form>";

echo $voltar;

switch($tipo) {
	case 'Documento':
			$sqlbuscarg = "SELECT Nome,RG,Matricula,Empresa,DataIncl,Bloq,OBS FROM usuarios WHERE RG LIKE '".$valor."%' ORDER BY RG ASC";
			$sqlbuscargexe = $conn->query($sqlbuscarg);
			if($sqlbuscargexe->num_rows > 0) {
					
					?>
				<div class="table-responsive">
					<table class="table table-hover table-condensed" style="width:100%;font-size:smaller;">
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
					$cadastro = $rowa['DataIncl'];
					$cadastro = date_format(date_create($cadastro),"d/m/Y");
					$bloq = $rowa['Bloq'];
					$obs = $rowa['OBS'];
					if ($formdirect == "reluserunit"){
						echo "<tr><td>$rg</td><td>$nomeu</td><td><a href='../relatorios/select_user.php?formdirect=reluserunit&matricula=".urlencode($matricula)."'>$matricula</a></td>";
					} elseif ($formdirect == "consulta" || $formdirect == "edit") {
						echo "<tr><td>$rg</td><td>$nomeu</td><td><a href='editarusuarios.php?formdirect=update&matricula=".urlencode($matricula)."'>$matricula</a></td>";
					}
					echo "<td>$empresa</td><td>$cadastro</td><td>";
						if ($bloq == '1'){
							echo "<b>Sim</b>";
						} else {
							echo "Não";
						}
                    echo "</td><td>$obs</td></tr>";		
					
				} // end while
				echo "</tbody></table></div><div class=\"container\">$voltar</div>";
				$conn->close();
			} else {
				echo "Não foi encontrado nenhum dado!<br>";
				echo $tentarnovamente;
				?>
				<?php
				exit();
			}
		break;
		
    case 'Matricula':
        $sqlbuscamatricula = "SELECT Nome,RG,Matricula,Empresa,DataIncl,Bloq,OBS FROM usuarios WHERE Matricula LIKE '".$valor."' ORDER BY Matricula ASC";
        $sqlbuscamatriculaexe = $conn->query($sqlbuscamatricula);
        if($sqlbuscamatriculaexe->num_rows > 0) {
                
                ?>
            <div class="table-responsive">
                <table class="table table-hover table-condensed" style="width:100%;font-size:smaller;">
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
                $cadastro = $rowa['DataIncl'];
				$cadastro = date_format(date_create($cadastro),"d/m/Y");
				$bloq = $rowa['Bloq'];
				$obs = $rowa['OBS'];
                if ($formdirect == "reluserunit"){
					echo "<tr><td><a href='../relatorios/select_user.php?formdirect=reluserunit&matricula=".urlencode($matricula)."'>$matricula</a></td>";
				} elseif ($formdirect == "consulta" || $formdirect == "edit") {
					echo "<tr><td><a href='editarusuarios.php?formdirect=update&matricula=".urlencode($matricula)."'>$matricula</a></td>";
				}
                echo "<td>$nomeu</td><td>$rg</td><td>$empresa</td><td>$cadastro</td><td>";
                    if ($bloq == '1'){
                        echo "<b>Sim</b>";
                    } else {
                        echo "Não";
                    }
                echo "</td><td>$obs</td></tr>";		
                
            } // end while
            echo "</tbody></table></div><div class=\"container\">$voltar</div>";
            $conn->close();
        } else {
            echo "Não foi encontrado nenhum dado!<br>";
			echo $tentarnovamente;
			?>
            <?php
            exit();
        }
    break;
	case 'Nome':
			$sqlbuscanome = "SELECT Nome,RG,Matricula,Empresa,DataIncl,Bloq,OBS FROM usuarios WHERE Nome LIKE '%".$valor."%' ORDER BY Nome ASC";
			$sqlbuscanomeexe = $conn->query($sqlbuscanome);
			if($sqlbuscanomeexe->num_rows > 0) {
					
					?>
				<div class="table-responsive">
					<table class="table table-hover table-condensed" style="width:100%;font-size:smaller;">
						<thead align="center">
							<tr>
								<th>Nome</th><th>RG</th><th>Matrícula</th><th>Empresa</th><th>Cadastro</th><th>Bloqueado</th><th>OBS</th>
							</tr>
						</thead>
						<tbody>
					<?php
					while($rowa = $sqlbuscanomeexe->fetch_array(MYSQLI_ASSOC)){
					$rg = $rowa['RG'];
					$nomeu = $rowa['Nome'];
					$matricula = $rowa['Matricula'];
					$empresa = $rowa['Empresa'];
					$cadastro = $rowa['DataIncl'];
					$cadastro = date_format(date_create($cadastro),"d/m/Y");
					$bloq = $rowa['Bloq'];
					$obs = $rowa['OBS'];
					
					echo "<tr><td>$nomeu</td><td>$rg</td>";
					if ($formdirect == "reluserunit"){
						echo "<td><a href='../relatorios/select_user.php?formdirect=reluserunit&matricula=".urlencode($matricula)."'>$matricula</a></td>";
					} elseif ($formdirect == "consulta" || $formdirect == "edit") {
						echo "<td><a href='editarusuarios.php?formdirect=update&matricula=".urlencode($matricula)."'>$matricula</a></td>";
					}
					echo "<td>$empresa</td><td>$cadastro</td><td>";
						if ($bloq == '1'){
							echo "<b>Sim</b>";
						} else {
							echo "Não";
						}
                    echo "</td><td>$obs</td></tr>";		
					
				} // end while
				echo "</tbody></table></div><div class=\"container\">$voltar</div>";
				$conn->close();
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