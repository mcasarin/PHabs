<?php
include '../include/function.php';
include '../include/connect.php';
sessao();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<!-- Bootstrap 523 -->
	<link href="../css/bootstrap.css" rel="stylesheet">
	<title>Cartões</title>
</head>
<body>
<div class="container">
    <h3 style="text-align:center;background-color:#FEE39A;">Cartões</h3>
	<div class="row">
		<div class="col-4">
			<?php
				if($_SESSION["tipo"] == '0'){//administrativo
			?>
			<form action="editarcartoes.php" target="local">
				<input type="hidden" name="formdirect" value="insert">
				<button class="btn btn-outline-primary btn-lg"> <b>CADASTRAR Cartões</b> <br> <em>Usuários/Visitantes</em></button>
			</form>
			
			<form action="cartoeslivres.php" target="local">
				<button class="btn btn-outline-primary btn-lg"> Reserva cartões </button>
			</form>

			<form action="cartoesreservados.php" target="local">
				<button class="btn btn-outline-primary btn-lg"> Cartões reservados </button>
			</form>
			<br>
			<form action="consultacartoes.php" target="local">
				<button class="btn btn-outline-primary btn-lg"> Busca Cartões </button>
			</form>
		</div>
		<div class="col-4">
			<a href="index.php" target="local" class="btn btn-outline-primary btn-lg"> Leitura de cartões </a>
			<br><br>
			<a href="../nitcabs/index.php" target="local" class="btn btn-outline-primary btn-lg"> Cadastros em Lote </a>
			<?php
				}//end if administrativo
			?>
		</div>
		<div class="col-4">
				
		</div>
	</div> <!-- end row -->
</div> <!-- end container -->

</body>
</html>
<?php
//end file
?>
