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
	<link href="../css/bootstrap.css" rel="stylesheet">

<title> Consulta de Cartões </title>
</head>
<body>

<div class="container">
    <h3 style="text-align:center;background-color:#FEE39A;">Consulta de Cartões</h3>
	<div class="row">
		
	<form action="checkcartoes.php" id="busca" method="POST" class="row g-3">
		
		<div class="input-group mb-3">
			<span class="input-group-text">Valor: </span>
			<input type="text" id="valor" name="valor" class="form-control" placeholder=" Cartão ou Lote ou Hexcode ou Matrícula " autofocus required size="45" tabindex="0">
		
			<button type="submit" class="btn btn-primary"> Pesquisar </button>
		</div>	
			<input type="hidden" name="formdirect" id="formdirect" value="<?php echo $formdirect; ?>">
			</form>
		</div>
	</div><!-- div table-responsive -->

	<div class="row"><h1>&nbsp;</h1></div>
	<div class="row">
		<div class="col-xs-1 col-md-2">&nbsp;</div><div class="col-xs-8 col-md-4">
		<span class="help-block">Insira o valor para busca do cartão (número de cartão, lote, hexcode ou matrícula), não é necessário o tipo de busca.
		</span>
		<span class="help-block">A busca retornará no máximo 20 (vinte) itens. Portanto, refaça a busca se não encontrou o cartão. Quanto mais dados mais precisa a busca.</span></div>
	</div>
	<br>
	<div class="row">
		<div class="col col-lg-4">&nbsp;</div>
		<div class="col-md-auto">
			<a class="btn btn-outline-warning btn-lg" href="cartoes.php"> Voltar </a>
		</div>
	</div>
</body>
</html>
<?php
// eof
?>