<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
/*
#   
#   Entrada de menu Operadores
#   data: 19abr23
#
*/
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link href="../css/bootstrap.css" rel="stylesheet">

<title>Operadores</title>
</head>
<body>
<div class="container">
        <h3 style="text-align:center;background-color:#FEE39A;">Operadores</h3>
	<div class="row">

    	<div class="col-4">
    	<?php
			if($_SESSION["tipo"] == '0'){ // administrativo
		?>

		<form action="editaroperadores.php" target="local">
			<input type="hidden" name="formdirect" id="formdirect" value="insert">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px; margin-left:5px;margin-right:5px;"> Adicionar </button>
		</form>
		<form action="consultaoperadores.php" target="local" method="get">
			<input type="hidden" name="formdirect" id="formdirect" value="consulta">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px; margin-left:5px;margin-right:5px;"> Consulta </button>
		</form>
        
		<?php
			} // end if administrativo
		?>
		</div>
    </div> <!-- end row -->
</div> <!-- end container -->
</body>
</html>
<?php
//end file
?>