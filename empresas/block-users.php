<?php
include '../include/function.php';
sessao();

if($_SERVER['REQUEST_METHOD'] == "POST") {
	$formdirect = $_POST['formdirect'];
} else {
	$formdirect = $_GET['formdirect'];
}

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<link rel="stylesheet" href="../css/churchill.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/bootstrap.js"></script>
<title>Empresas</title>
</head>
<body>

<form name="formblock" action="execute_block-users.php" method="POST">

	<div class="container">
		<div class="row">
			<div class="col">
				<p>Selecione a empresa para <b>BLOQUEAR</b> seus usuários e preencha com o motivo: </p>
			</div>
		</div>
		<div class="row">
			<div class="form-group col">
				<label for="empresa">Empresa/Conjunto: </label>
					<select class="form-control" name="empresa" id="empresa" required>
					  <option value="">-- selecione --</option>
					  <?php
						// montagem da combobox empresa
						// populando o combobox
						$sql2 = "SELECT DISTINCT empresa FROM empresas WHERE empresa BETWEEN '00' AND '9999' ORDER BY empresa + 0 ASC;"; //+0 para ordenar campo
						
						// confirmando sucesso
						$result2 = $conn->query($sql2);
						
						// agrupando resultados
						if($result2->num_rows > 0) {
						// combobox

							while ($row1 = $result2->fetch_array(MYSQLI_ASSOC))
								// while para agrupar todos os itens
								echo "<option value=\"$row1[empresa]\">$row1[empresa]</option>";
						}
						?>
					</select>
			</div>
			<div class="form-group col">
				<label>Motivo: </label>
					<textarea class="form-control" name="obs" id="obs" rows="3" required></textarea>
			</div>
		</div>
		<div class="row">
			<input type="button" class="btn btn-danger btn-lg" value=" Bloquear usuários! " onclick="confirma()">
		</div>
	</div> <!-- end div container -->

</form>

</body>
<script>
        function confirma() {
				if(confirm("Tem certeza que quer bloquear os usuário da empresa: " + document.getElementById("empresa").value )){
					formblock.submit();
				} else {
					return false;
				}
		}
</script>
</html>
<?php
?>