<?php
include '../include/function.php';
include '../include/connect.php';
sessao();

?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>
<title>Empresas</title>
</head>
<body>
<section class="container-fluid" style="margin-top:10px;margin-bottom:100px;">
    <div class="row">
    <div class="btn col-4">
    <h3>Empresas</h3>
    <?php
			if($_SESSION["tipo"] == '0'){//administrativo
		?>
<<<<<<< HEAD
		<form action="consultacadastro.php" target="local">
=======
		<form action="consultaempresa.php" target="local">
>>>>>>> daf2cd98c9680322351e26e75b575be1ae1b475f
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px; margin-left:5px;margin-right:5px;"> Consulta </button>
		</form>

		<form action="editarempresa.php" target="local">
			<input type="hidden" name="formdirect" id="formdirect" value="insert">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px; margin-left:5px;margin-right:5px;"> Inserir </button>
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