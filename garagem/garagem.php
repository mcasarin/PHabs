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
<script src="../js/bootstrap.min.js"></script>
<title>Garagem</title>
</head>
<body>
<div class="container">
        <h3 style="text-align:center;background-color:#FEE39A;">Garagem</h3>
	<div class="row">
		<span class="" style="margin-bottom:20px;"><b>Lembrando:</b> <i>As solicitações de TAG são realizadas pelo site do condomínio.</i></span>
		<div class="col-4">
			<div class="col">
				<form action="check.php" target="local">
					<button class="btn btn-outline-success btn-lg" style="width: 100%; margin-bottom: 10px;margin-left:5px;margin-right:5px;"> Checar placa </button>
				</form>
			</div>
			<div class="col">
				<form action="checkprest.php" target="local">
					<button class="btn btn-outline-warning btn-lg" style="width: 100%; margin-bottom: 10px;margin-left:5px;margin-right:5px;"> Checar Prestador </button>
				</form>
			</div>
		</div>
		<div class="col-4">
			<div class="col">
				<form action="checartag.php" target="local">
					<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px;margin-left:5px;margin-right:5px;"> Checar TAG solicitada </button>
				</form>
			</div>
			<div class="col">
				<form action="formautoriza.php" target="local">
					<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px;margin-left:5px;margin-right:5px;"> Cadastro de autorizações </button>
				</form>
			</div>
		</div>
	</div>
	<?php
		if($_SESSION["tipo"] == '0'){ // operadores administrativos
	?>
	<div class="row">
		
		<div class="col-4">
			<div class="col">
				<form action="relautoriza.php" target="local">
					<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px;margin-left:5px;margin-right:5px;"> Relatório de autorizações </button>
				</form>
			</div>
	
			<div class="col">
				<form action="solicitacaotagsite.php" target="local">
					<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px;margin-left:5px;margin-right:5px;"> Solicitação de tag (site) </button>
				</form>
			</div>
		</div>
		<div class="col-4">
			<div class="col">
				<form action="controle.php" target="local">
					<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px;margin-left:5px;margin-right:5px;"> Controle de vagas </button>
				</form>
			</div>
	
			<div class="col">
				<form action="solicitatag.php" target="local">
					<button class="btn btn-outline-secondary btn-lg" style="width: 100%; margin-bottom: 10px;margin-left:5px;margin-right:5px;"> Solicitar TAG </button>
				</form>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-4">
			<div class="col">
				<form action="solicitacaotaginvalid.php" target="local">
					<button class="btn btn-outline-danger btn-lg" style="width: 100%; margin-bottom: 10px;margin-left:5px;margin-right:5px;"> Solicitação de tag (site)<br>Invalidadas Motivo</button>
				</form>
			</div>
		</div>
    </div> <!-- end row -->
	<?php
		} //end if operadores administrativos
	?>
</div> <!-- container -->

</body>
</html>
<?php

?>