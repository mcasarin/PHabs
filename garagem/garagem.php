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
<script src="../js/jquery-1.11.3.js"></script>
<script src="../js/bootstrap.min.js"></script>
<title>Garagem</title>
</head>
<body>
<section class="container-fluid" style="margin-top:10px;margin-bottom:100px;">
    <div class="row">
    <div class="btn col-4">
	<h3>Garagem</h3>
		<form action="solicitatag.php" target="local">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px;margin-left:5px;margin-right:5px;"> Solicitar TAG </button>
		</form>
		
		<form action="checartag.php" target="local">
			<button class="btn btn-outline-primary btn-lg" style="width: 100%; margin-bottom: 10px;margin-left:5px;margin-right:5px;"> Checar TAG solicitada </button>
		</form>
	</div>
    </div> <!-- end row -->
</section>
</body>
</html>
<?php

?>