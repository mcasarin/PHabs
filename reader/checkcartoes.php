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
*  Consulta de cartões
*/
// Declaração de variáveis
$matricula = "";
$lotefc = "";
$hexcode = "";
$cartao = "";
$tipo = "";
$uso = "";
$empresa = "";

// Envio por POST página consultacartoes.php

if($_SERVER['REQUEST_METHOD'] == "POST"){
	$valor = $_POST['valor'];
	$sqlbuscacartao = "SELECT sequencia,fc,codigo,cartao,tipo,uso,empresa FROM cartoes WHERE sequencia LIKE '%".$valor."%' OR fc LIKE '%".$valor."%' OR codigo LIKE '%".$valor."%' OR cartao LIKE '%$".$valor."%' ORDER BY sequencia +0 ASC";
	// echo $sqlbuscacartao."<br>";
        $sqlbuscacartaoexe = $conn->query($sqlbuscacartao);
        if($sqlbuscacartaoexe->num_rows > 0) {
                ?>
                <div class="table-responsive">
                <table class="table">
                    <thead align="center">
                    <th>Matrícula</th><th>Lote/FC</th><th>Hexcode/Codigo</th><th>Cartão</th><th>Tipo</th><th>Uso</th><th>Empresa</th>
                    </thead>
                    <tbody>
                <?php
                while($rowa = $sqlbuscacartaoexe->fetch_array(MYSQLI_ASSOC)){
					$matricula = $rowa['sequencia'];
					$lotefc = $rowa['fc'];
					$hexcode = $rowa['codigo'];
					$cartao = $rowa['cartao'];
					$tipo = $rowa['tipo'];
					$uso = $rowa['uso'];
					$empresa = $rowa['empresa'];
                
				echo "<tr><td><a href='editarcartoes.php?formdirect=update&matricula=".urlencode($matricula)."'>".$matricula."</a></td>
				<td>".$lotefc."</td><td>".$hexcode."</td><td>".$cartao."</td><td>".$tipo."</td><td>".$uso."</td><td>".$empresa."</td></tr>";	
                
            } // end while
			?>
            </tbody></table></div>
			<?php
			echo $voltar;
            $conn->close;
        } else {
            echo "Não foi encontrado nenhum dado!<br>";
			echo $voltar;
			?>
            <?php
            exit();
        }


// botao voltar carregando opção do menu (relatorio ou consulta) - formdirect
$voltar = "<form action=\"consultacartoes.php\" method=\"post\">
<input type=\"hidden\" name=\"formdirect\" id=\"formdirect\" value=\"".$formdirect."\">
<button class=\"btn btn-sm btn-success btn-block\" type=\"submit\" name=\"reload\" role=\"button\"> Voltar </button>
</form>";

} // end request post

?>