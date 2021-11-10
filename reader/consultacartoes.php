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
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/bootstrap.min.js"></script>

<title> Consulta de Cartões </title>
</head>
<body>

	<div class="table-responsive">
		<h3 align="center"> Consulta de Cartões </h3>
		<table class="table" align="center">
			<form action="checkcartoes.php" id="busca" method="POST" class="form-horizontal">
		<tbody>
			<tr><td><label>Valor: </label></td><td><input type="text" id="valor" name="valor" placeholder=" Cartão ou Lote ou Hexcode ou Matrícula " autofocus required size="45" tabindex="0">
			<td rowspan="2" valign="center"><button type="submit" class="btn btn-default" tabindex="1"> Pesquisar </button></td>

			<input type="hidden" name="formdirect" id="formdirect" value="<?php echo $formdirect; ?>">
			</form>
		</tbody>
		</table>
	</div><!-- div table-responsive -->

	<div class="row"><h1>&nbsp;</h1></div>
	<div class="row">
		<div class="col-xs-1 col-md-2">&nbsp;</div><div class="col-xs-8 col-md-4">
		<span class="help-block">Insira o valor para busca do cartão (número de cartão, lote, hexcode ou matrícula), não é necessário o tipo de busca.</span>
		<span class="help-block">A busca retornará no máximo 20 (vinte) itens. Portanto, refaça a busca se não encontrou o cartão. Quanto mais dados mais precisa a busca.</span></div>
	</div>
</body>
</html>
<?php

?>