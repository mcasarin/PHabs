<?php
include 'include/function.php';
include 'include/connect.php';
sessao();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="css/bootstrap.css">
<script type="text/javascript" src="https://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>
<script src="include/script_new.js" ></script>
<script src="js/bootstrap.js"></script>

<title>Baixa de Visitantes </title>
</head>
<body>
<div class="container">
<div class="row">
	<div class="col-xs-3 col-md-4">&nbsp;</div>
	<div class="col-xs-6 col-md-8 col-centered bg-sucess"><h3>Baixa de Visitantes</h3></div>
	<div class="col-xs-3 col-md-4">&nbsp;</div>
</div> <!-- class row -->
		<div class="container">
			<button class="btn-sm btn-info" disabled style="margin-right: 5px;margin-bottom: 5px">Busca dinâmica: </button>
			<input name="busca" id="busca" type="text" tabindex="1" autocomplete="off" />
				<div class="container-fluid" name="resultadobusca" id="resultadobusca"></div>
		</div>
		<div class="btn btn-group">
			<button class="btn-sm btn-info" disabled style="margin-right: 5px;margin-bottom: 10px">Buscar por: </button>
				<form action="include/checkbaixa.php" method="post" target="baixadisplay">
					<input type="hidden" name="opt" value="doc" id="doc" />
					<button type="submit" value="submit" class="btn btn-outline-info" style="margin: 5px;">Documento</button>
				</form>
				<form action="include/checkbaixa.php" method="post" target="baixadisplay">
					<input type="hidden" name="opt" value="cartao" id="cartao" />
					<button type="submit" class="btn btn-outline-info" style="margin: 5px;">Cartão</button>
				</form>
				<form action="include/checkbaixa.php" method="post" target="baixadisplay">
					<input type="hidden" name="opt" value="nome" id="nome" />
					<button type="submit" class="btn btn-outline-info" style="margin: 5px;">Nome</button>
				</form>
		</div>
		<div class="container-fluid">
			<iframe class="iframe" name="baixadisplay" width="600" height="400" style="border:0;position:absolute;overflow:hidden">
			</iframe>
		</div>
	</div> <!-- fim container -->
</body>
</html>