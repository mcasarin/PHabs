<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
/*
#   
#   Entrada de menu Cadastros em Lote
#   data: 14ago23
#
*/
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../css/bootstrap.css" rel="stylesheet">
	<title> Cadastros em Lote </title>
</head>
<body>
<div class="container">
    <div class="row">
        <h4 style="text-align:center;background-color:#FEE39A;">Cadastro em Lote</h4>
		<div class="row">
			<div class="col" style="background-color: #ccffee;">
			<form action = "2aCadastroCartaolote/cadastros.php" method="POST" enctype="multipart/form-data">
				<label for="fileCadCartaoUsuarioLote" class="form-label">1) Selecione um arquivo com dados e formato esperado.</label>
				<input type="file" class="form-control" name="fileCadCartaoUsuarioLote" id="fileCadCartaoUsuarioLote" required>
				<input type="submit" class="btn btn-outline-primary" value="Cartão de Usuários em Lote">
			</form>
			</div>
			<div class="col" style="background-color:#ffffb3;">
			<form action = "3aCadastroUsuariolote/caduser.php" method="post" enctype="multipart/form-data">
				<label for="fileCadUsuarioLote" class="form-label">2) Selecione um arquivo com dados e formato esperado.</label>
				<input type="file" class="form-control" name="fileCadUsuarioLote" id="fileCadUsuarioLote" required>
				<input type="submit" class="btn btn-outline-primary" value="Usuários em Lote">
			</form>
			</div>
			<div class="col" style="background-color:#ffb3b3;">
			<form action = "2aCadastroCartaoloteVisitante/cadastros.php" method="post" enctype="multipart/form-data">
				<label for="fileCadCartaoVisitanteLote" class="form-label">3) Selecione um arquivo com dados e formato esperado.</label>	
				<input type="file" class="form-control" name="fileCadCartaoVisitanteLote" id="fileCadCartaoVisitanteLote" required>
				<input type="submit" class="btn btn-outline-primary" value="Cartão de Vistantes em Lote">
			</form>
			</div>
		</div>	
	</div>
	<hr>
	<div class="row">
		<div class="col">
				<b>Instruções de uso dos Cadastros em Lote.</b>
			<br><br>
				<h6>Antes de clicar em algum dos botões de cadastro em lote é necessario preencher os arquivos com suas respectivas informações.</h6>
				<p>1) Para cadastrar cartões de usuarios em lote: <br>
				- Faça o download do arquivo modelo: <a href="2aCadastroCartaolote/cadcartao.csv" download> Cadastro de cartões de usuário em lote </a><br>
				- Mantenha alguns itens de limitação da mesma forma, são eles: <br>
					-- a letra g na primeira linha e última coluna;<br>
					-- a palavra fim na última linha primeira coluna;<br>
				- Coluna nw é o lote do cartão;<br>
				- Coluna codigo é o código do cartão;<br>
				- As outras duas colunas são, respectivamente, matricula e empresa;<br>
				- Salve o arquivo e envie com o respectivo botão.
				</p>
				<p>2) Para cadastrar os usuários em seus cartões preenche o arquivo conforme indicado no próprio arquivo:<br>
				- Faça o download do arquivo modelo: <a href="3aCadastroUsuariolote/caduser.csv" download> Cadastro de usuário em lote </a>
				</p>
				<p>3) Para cadastrar cartões visitantes em lote o processo é o mesmo do cartão de usuários, exceto por: <br>
				- Empresa manter somente o número 95, indicando o conjunto do condomínio;<br>
				- Faça o download do arquivo modelo: <a href="2aCadastroCartaoloteVisitante/cadcartao.csv" download> Cadastro de cartões de visitantes em lote </a></p>
		</div>
	</div>
</div>
</body>
</html>