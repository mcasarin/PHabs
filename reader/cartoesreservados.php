<?php
include '../include/function.php';
include '../include/connect.php';
sessao();

$sqlcartoesreservados = "SELECT num,reserva,rg,nome,nomecracha,empresa,status FROM tmp_matriculas where num not in (select sequencia from cartoes) and num > '11000' AND status = '1' LIMIT 40";
$sqlcartoesreservadosexe = $conn->query($sqlcartoesreservados);
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
<div class="col-md-2 container col-centered bg-"><a class="btn btn-success btn-block" role="button" href="cartoes.php"> <<< Voltar <<< </a></div>
<br>
<div class="table-responsive">
<table class="table table-hover table-sm">
	<thead class="thead-dark"><tr>
	   <th>Número</th>
       <th>Documento</th>
       <th>Nome</th>
       <th>Nome do crachá</th>
       <th>Empresa</th>
    </tr></thead>
<?php
    while($rowc = $sqlcartoesreservadosexe->fetch_array(MYSQLI_ASSOC)){
        $numero = $rowc["num"];
        echo "<tr><td>$numero</td><td>$rg</td><td>$nome</td><td>$nomecracha</td><td>$empresa</td></tr>";
    }
?>
</table>
</body>
</html>
<?php
//end file
?>