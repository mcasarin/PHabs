<?php
include 'include/function.php';
sessao();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.min.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="js/bootstrap.min.js"></script>

<title>Consulta de Visitantes </title>
</head>
<body>

	<div class="table-responsive">
		<h3 align="center"> Consulta de Visitantes </h3>
		<table class="table" align="center">
			<form action="include/checkvisitante.php" id="busca" method="POST" class="form-horizontal">
		<tbody>
			<tr><td><label>Valor: </label></td><td><input type="text" id="valor" name="valor" placeholder=" Nome ou Documento " autofocus required size="35">
			<td rowspan="2" valign="center"><button type="submit" class="btn btn-default"> Pesquisar </button></td>

			<tr><td><label>Tipo: </label></td><td><select id="tipo" name="tipo" required>
				<option>-- Selecione o tipo de busca --</option>
				<option value="Documento"> Documento </option>
				<option value="Nome"> Nome </option>
				<option value="Usuario"> Usuário </option>		
			</select></div>
			</td></tr>
			</form>
		</tbody>
		</table>
	</div><!-- div table-responsive -->

	<div class="row"><h1>&nbsp;</h1></div>
	<div class="row">
		<div class="col-xs-1 col-md-2">&nbsp;</div><div class="col-xs-8 col-md-4">
		<span class="help-block">Insira o valor para busca do cadastro, não esqueça de selecionar o tipo de pesquisa para o valor digitado.</span>
		<span class="help-block">A busca retornará no máximo 20 (vinte) itens. Portanto, refaça a busca se não encontrou o visitante. Quanto mais dados de nome e documentos mais precisa a busca</span></div>
	</div>
</body>
</html>
<?php
?>
