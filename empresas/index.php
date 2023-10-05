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
<script src="../js/jquery-3.6.4.min.js"></script>
<script src="../js/bootstrap.js"></script>
<title>Empresas</title>
</head>
<body>
<section class="container-fluid" style="margin-top:10px;margin-bottom:100px;">
    <div class="row">
    <div class="btn col-4">
    <h2>Empresas</h2>
    <?php
			if($_SESSION["tipo"] == '0'){//administrativo
		?>
		<form action="consultaempresa.php" target="local">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px; margin-left:5px;margin-right:5px;"> Consulta </button>
		</form>

		<form action="editarempresa.php" target="local">
			<input type="hidden" name="formdirect" id="formdirect" value="insert">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px; margin-left:5px;margin-right:5px;"> Inserir </button>
		</form>
		<hr>
		<form action="block-users.php" target="local">
			<input type="hidden" name="formdirect" id="formdirect" value="block">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px; margin-left:5px;margin-right:5px;"> Bloquear usuários<br>por empresa </button>
		</form>
		<form action="unblock-users.php" target="local">
			<input type="hidden" name="formdirect" id="formdirect" value="unblock">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px; margin-left:5px;margin-right:5px;"> Desbloquear usuários<br>por empresa </button>
		</form>
		<?php
			}//end if administrativo
		?>
        </div>
    </div> <!-- end row -->
</section>
</body>
</html>
<?php
//end file
?>