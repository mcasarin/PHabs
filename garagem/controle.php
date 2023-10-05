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
<title>Controle de Vagas</title>
</head>
<body>
<section class="container-fluid" style="margin-top:10px;margin-bottom:100px;">
	<div class="row">
		<div class="col-sm"></div>
		<div class="col-sm" style="text-align:center;">
			<h3>Controle de Vagas</h3>
		</div>
		<div class="col-sm"></div>
	</div>

    <div class="row">
    <div class="btn col-6">
		<?php
			if($_SESSION["tipo"] == '0'){//operadores administrativos
		?>
		<form action="proprietarios.php" target="local">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px;margin-left:5px;margin-right:5px;"> Proprietarios </button>
		</form>
		
		<form action="vagas.php" target="local">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px;margin-left:5px;margin-right:5px;"> Vagas </button>
		</form>
		
		<form action="validavagas.php" target="local">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px;margin-left:5px;margin-right:5px;"> Validação de Vagas Controle <br>e Sistema </button>
		</form>
		
		<form action="validaveiculos.php" target="local">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px;margin-left:5px;margin-right:5px;"> Validação de Veículos e Vagas </button>
		</form>
		<?php
			} //end if operadores administrativos
			?>
		<form action="garagem.php" target="local">
			<button class="btn btn-warning btn-sm" style="width: 100%; margin-bottom: 10px;margin-left:5px;margin-right:5px;"> Voltar </button>
		</form>
	</div>
    </div> <!-- end row -->
</section>
</body>
</html>
<?php

?>