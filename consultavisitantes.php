<?php
include 'include/function.php';
sessao();

if($_SERVER['REQUEST_METHOD'] == "GET") {
$formdirect = $_GET['formdirect'];

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="css/bootstrap.min.css">
	<script src="js/jquery-3.6.4.min.js"></script>
	<script src="js/bootstrap.min.js"></script>

<title>Consulta de Visitantes </title>
</head>
<body>
<div class="container">
	<div class="row">
		<h3 style="text-align:center;background-color:#FEE39A;"> Consulta de Visitantes </h3>
		
		<div class="col-6">
			<form action="include/checkvisitante.php" id="busca" method="POST" class="form-horizontal">
				<div class="row">
					<div class="col-4">
						<label>Valor: </label>
					</div>
					<div class="col-8">
						<input type="text" id="valor" name="valor" autofocus required size="25" style="margin-bottom: 10px;" placeholder="Nome ou documento">
					</div>
				</div>
				<div class="row">
					<div class="col-4">
						<p>Tipo de pesquisa: </p>
					</div>
					<div class="col-8">
						<input type="radio" id="documento" value="Documento" name="tipo" class="btn btn-sm btn-check">
						<label class="btn btn-outline-success" for="documento"> Documento </label>
						<input type="radio" id="nome" value="Nome" name="tipo" class="btn-check">
						<label class="btn btn-outline-success" for="nome"> Nome </label>
						<input type="radio" id="usuario" value="Usuario" name="tipo" class="btn-check">
						<label class="btn btn-outline-success" for="usuario"> Usuário </label>
					</div>
				</div>
		</div>
		<div class="col-2">
			<div class="row align-items-center">
				<div class="col">
					<input type="hidden" name="formdirect" id="formdirect" value="<?php echo $formdirect;?>">
					<button type="submit" class="btn btn-outline-danger" style="margin: 20px;"> Pesquisar </button>
				</div>
			</form>
			</div>
		</div>
	</div>

	<div class="row">
		<div class="col-8">
			<p class="">Insira o valor para busca do cadastro, não esqueça de selecionar o <i>tipo de pesquisa</i> para o valor digitado.</p>
			<p class="">A busca retornará no máximo 20 (vinte) itens. Portanto, refaça a busca se não encontrou o visitante. Quanto mais dados de nome e documentos mais precisa a busca</p>
		</div>
	</div>
</div> <!-- end container -->
</body>
</html>
<?php
} // end IF
?>
