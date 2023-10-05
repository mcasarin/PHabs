<?php
include '../include/function.php';
include '../include/connect.php';
sessao();

$matricula = $_POST["numero"];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>
<title>Reserva de cartões</title>
</head>
<body>
<div class="col-md-2 container col-centered bg-"><a class="btn btn-success btn-block" role="button" href="cartoeslivres.php"> <<< Voltar <<< </a></div>
<br>
<div class="table-responsive">
<table class="table table-hover table-sm">
	<thead class="thead-dark"><tr>
	   <th colspan="3" style="text-align:center;">Reserva</th>
    </tr></thead>
    <tr><td colspan="2" size="50">Matrícula: </td><td><input type="text" name="matricula" value="<?php echo $matricula; ?>"></td></tr>
    <tr><td colspan="2" size="50">Nome: </td><td><input type="text" name="nome" maxlength="150" size="80" required></td></tr>
    <tr><td colspan="2" size="50">Nome do crachá: </td><td><input type="text" name="nomecracha" maxlength="120" size="60" required></td></tr>
    <tr><td colspan="2" size="50">Documento: </td><td><input type="text" name="doc" required></td></tr>
    <tr><td colspan="2" size="50">Empresa: </td><td> 
        <?php
        // montagem da combobox empresa
		echo "<select name='empresa' id='empresa' required>";
		echo "<option value=''>-- Selecione --</option>";
		// populando o combobox
		$sql2 = "SELECT DISTINCT empresa FROM empresas WHERE empresa BETWEEN '00' AND '9999' ORDER BY empresa + 0 ASC;"; //+0 para ordenar campo
		
		// confirmando sucesso
		$result2 = $conn->query($sql2);
		
		// agrupando resultados
		if($result2->num_rows > 0) {
			// combobox

			
			while ($row = $result2->fetch_array(MYSQLI_ASSOC))
				// while para agrupar todos os itens
				echo "<option value='$row[empresa]'>$row[empresa]</option>";
		}
		echo "</select></td></tr>";
		// fim da combo
		        	$conn->close;
        ?>
    <tr><td></td></tr>
</table>
</body>
</html>
<?php
//end file
?>