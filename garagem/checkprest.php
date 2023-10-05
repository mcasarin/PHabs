<?php
include '../include/function.php';
sessao();
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/bootstrap.min.js"></script>
<title>Checagem de placa</title>
</head>
<body onload="document.buscaplaca.placa.focus();">

	<div class="container">

		<div class="row">
			<div class="col" style="text-align:center;">
				<h3>Busca por Prestador de serviços / Terceiros</h3>
				<h6>Consulta autorizações para o dia e por conjunto</h6>
				<br>
				<form class="row g-3" target="buscaframe" method="post" action="include/buscaprestador.php" name="buscaprestador" id="buscapreatador">
					<div class="col-auto">
					<?php
					// montagem da combobox empresa
						echo "<select class='form-select' name='empresa' id='empresa'>";
						echo "<option value=''>-- Selecione o conjunto --</option>";
						// populando o combobox
						$sql3 = "SELECT DISTINCT empresa FROM empresas WHERE empresa BETWEEN '00' AND '9999' AND VagaCond > '0' OR VagaVis > '0' ORDER BY empresa + 0 ASC;"; // +0 para ordenar campo
					
					// confirmando sucesso
						$result3 = $conn->query($sql3);
					
					// agrupando resultados
						if($result3->num_rows > 0) {
						// combobox
						
						while ($row = $result3->fetch_array(MYSQLI_ASSOC))
							// while para agrupar todos os itens
							echo "<option value='$row[empresa]'>$row[empresa]</option>";
						}
						echo "</select>";
							// fim da combo<br>
							$conn->close();
					?>
					</div>
						<div class="col-auto">
							<input type="submit" class="btn btn-primary" name="botaobusca" value=" Buscar ">
						</div>
						<div class="col-auto">
							<button type="reset" class="btn btn-warning" name="botaolimpa" onclick="self.location.reload();"> Limpar </button>
						</div>
					
					
			</div>
		</div>
					
				</form>
			
		
		<div class="row">
			<div class="col-2"></div>
			<div id="conteudo" class="col">
				<iframe id="buscaframe" name="buscaframe" style="dysplay:none;border:0;width:420;height:400;" ALLOWTRANSPARENCY="true">
						
				</iframe>
			</div>
			<div class="col-2"></div>
		</div>

	</div> <!-- fim container -->

</body>
</html>
<?php
?>
