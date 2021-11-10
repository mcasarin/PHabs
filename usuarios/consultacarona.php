<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
/*
#   
#   Consulta carona
#   data: 13ago21
#
*/
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/bootstrap.js"></script>
<title>Carona</title>
</head>
<body>
<section class="container-fluid" style="margin-top:10px;margin-bottom:100px;">
    <div class="row"><div class="col-8">
	<h2 class="" style="text-align:center;">Carona</h2>
	</div></div>
	<div class="row">
    <div class="col-4">
<?php
	if($_SESSION["tipo"] == '0'){//administrativo
?>
		<form action="validacarona.php" target="local" method="post">
			<input type="hidden" name="formdirect" id="formdirect" value="carona">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px; margin-left:5px;margin-right:5px;"> Validação de Registros<br>Carona </button>
		</form>
<hr>
		<form action="relatoriocarona.php" target="local" method="post">
			<input type="hidden" name="formdirect" id="formdirect" value="consultacarona">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px; margin-left:5px;margin-right:5px;"> Relatório Carona </button>
        </form>
        
        </div>
		<?php
			}//end if administrativo
		?>
    </div> <!-- end row -->
</section>
</body>
</html>
<?php
//end file
?>