<?php
include '../include/function.php';
sessao();
// header("Refresh: 15; url=check.php");
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
<title>Checagem de Visitante</title>
</head>
<body onload="document.buscavisita.doc.focus();">

	<div class="container">

		<div class="row">
			<div class="col" style="text-align:center;">
			<h3>Busca por RG ou nome (Documento)</h3>
			<br>
				<form class="form-inline" target="buscaframe" method="post" action="buscavisita.php" name="buscavisita" id="buscavisita">
					<div class="col">
						<input class="form-control" type="text" maxlength="100" name="doc" id="doc" style="text-transform:uppercase" autofocus />
					</div>
					<div class="col-sm">
						<input type="submit" class="btn btn-primary" name="botaobusca" value=" Buscar ">
					</div>
					<div class="col-sm">
						<button type="reset" class="btn btn-warning" name="botaolimpa" onclick="self.location.reload();"> Limpar </button>
					</div>
				</form>
			</div>
		</div>
		<div class="row">
			<div class="col-2"></div>
			<div id="conteudo" class="col">
				<iframe id="buscaframe" name="buscaframe" style="dysplay:none;border:0;width:650;height:400;" ALLOWTRANSPARENCY="true">
						
				</iframe>
			</div>
			<div class="col-2"></div>
		</div>

	</div> <!-- fim container -->

</body>
</html>
<?php
?>