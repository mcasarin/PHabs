<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
$sqlchecatag = "SELECT * FROM solicita ORDER BY tag DESC";
$re = $conn->query($sqlchecatag);
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-1.11.3.js"></script>
<script src="../js/bootstrap.js"></script>
<title>Checar TAG</title>
</head>
<body>
<div class="col-md-2 container col-centered bg-"><a class="btn btn-success btn-block" role="button" href="garagem.php"> <<< Voltar <<< </a></div>
<div class="table-responsive">
<table class="table table-hover table-sm">
	<thead class="thead-dark"><tr>
	   <th>Edição</th>
	   <th>Nome do Solicitante</th>
	   <th>Conjunto</th>
	   <th>Carro</th>
	   <th>Placa</th>
	   <th>TAG</th>
	   <th>Data da Solicitação</th>
    </tr></thead>
<?php
while($l = $re->fetch_array(MYSQLI_ASSOC)) {
	$id = $l["id_sol"];
	$nomesolicita = $l["nomesolicita"];
	$empresa = $l["empresa"];
	$carro = $l["carro"];
	$placa = $l["placa"];
	$tag = $l["tag"];
	$datasolicita = $l["datasolicita"];
    $data = date_create($datasolicita);
    $data = date_format($data,"d/m/Y");
	$nomesolicita = mb_strtoupper ("$nomesolicita");
	$carro = mb_strtoupper ("$carro");
	$placa = mb_strtoupper ("$placa");
echo "
	<tr>
		<td>";
		if($tag == 'N/D'){
			echo "<a class=\"btn btn-info\" href=\"include/editarsolicita.php?id=$id\"> [Editar] </a>";
		} else {
			echo "<span class=\"bg-success\">ok!</span>";
		}
		echo "</td>
		<td> $nomesolicita </td>
		<td> $empresa </td>
		<td> $carro </td>
		<td align = 'center'> $placa </td>
		<td> $tag </td>
		<td> $data </td>
	</tr>\n";
	}
	

$conn->close();
?>
</table>
</div>
</body>