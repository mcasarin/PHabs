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
	<link rel="stylesheet" href="../css/bootstrap.css">
	<script src="../js/jquery-1.12.4.js"></script>
	<script src="../js/jquery-ui-1.12.1.js"></script>
	<script src="../js/bootstrap.js"></script>
	<title>Cartões</title>
<title>PHabs</title>
</head>
<body>
<section class="container-fluid" style="margin-top:10px;margin-bottom:100px;">
    <div class="row">
    <div class="btn col-4">
    <h3>Cartões</h3>
    <?php
			if($_SESSION["tipo"] == '0'){//administrativo
		?>
		<form action="editarcartoes.php" target="local">
			<input type="hidden" name="formdirect" value="insert">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px; margin-left:5px;margin-right:5px;"> <b>CADASTRAR Cartões</b> <br> <em>Usuários/Visitantes</em></button>
		</form>
		
		<form action="cartoeslivres.php" target="local">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px; margin-left:5px;margin-right:5px;"> Reserva cartões </button>
		</form>

		<form action="cartoesreservados.php" target="local">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px; margin-left:5px;margin-right:5px;"> Cartões reservados </button>
		</form>
		<br>
		<form action="consultacartoes.php" target="local">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px; margin-left:5px;margin-right:5px;"> Busca Cartões </button>
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