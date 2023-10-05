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
<title>Proprietarios</title>
</head>
<body>
<table class="table table-sm table-striped table-bordered table-hover">
    <thead class="thead-light">
        <th>Nome</th><th>&nbsp;</th>
    </thead>
	<tbody>
		<form action="execprop.php" method="post">
			<tr><td><input type="text" name="prop" id="prop" size="100"></td><td><input class="btn btn-success" type="submit" name="gravar" value=" Gravar "></td></tr>
		</form>
	</tbody>
</table>
<p align="left"><a class="btn btn-outline-secondary" href="proprietarios.php">Voltar para lista</a></p>
</body>
</html>
<?php
//eof
?>