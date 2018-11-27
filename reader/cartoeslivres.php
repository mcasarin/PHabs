<?php
include '../include/function.php';
include '../include/connect.php';
sessao();

$sqlcartoeslivres = "SELECT num,reserva,rg,nome,nomecracha,empresa,status FROM tmp_matriculas where num not in (select sequencia from cartoes) and num > '11000' AND status = '0' LIMIT 40";
$sqlcartoeslivresexe = $conn->query($sqlcartoeslivres);
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8" >
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>
<title>Números de cartões</title>
</head>
<body>
<div class="col-md-2 container col-centered"><a class="btn btn-success btn-block" role="button" href="cartoes.php"> <<< Voltar <<< </a></div>
<br>
<div class="table-responsive">
<table class="table table-hover table-md">
	<thead class="thead-dark"><tr>
	   <th>Reservar</th>
	   <th>Número</th>
    </tr></thead>
<?php
    while($rowc = $sqlcartoeslivresexe->fetch_array(MYSQLI_ASSOC)){
        $numero = $rowc["num"];
		echo "<tr><td><form action=\"editarreserva.php\" method=\"post\">
		<input type=\"hidden\" name=\"numero\" value=\"$numero\">
		<button type=\"submit\" class=\"btn btn-info\"> [Reservar] </button></td>
		<td><h2>$numero</h2></td></tr></form>";
    }
?>
</table>
</body>
</html>
<?php
//end file
?>