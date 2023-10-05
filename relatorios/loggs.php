<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
header("Content-type: text/html; charset=utf-8");


?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.min.css">
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/jquery-ui-1.12.1.js"></script>
<script src="../js/bootstrap.min.js"></script>
</head>
<body>
<?php
$sql = "select operador,Operacao,date(Data) as Datau,Hora from logoper order by date(Data) desc, Hora desc";
$sqlexe = $conn->query($sql);
echo "<table class=\"table table-sm table-striped table-bordered table-hover\">
      <thead class=\"thead-light\">
          <th>Operador</th><th>Operação</th><th>Data</th><th>Hora</th>
      </thead>
      <tbody>";
while ($row = $sqlexe->fetch_array(MYSQLI_ASSOC)){
	$operador = $row['operador'];
	$Operacao = $row['Operacao'];
	$Data = $row['Datau'];
	$Hora = $row['Hora'];
	echo "<tr><td>".$operador."</td><td>".$Operacao."</td><td>".$Data."</td><td>".$Hora."</td></tr>";
}
echo "</tbody></table>";

$conn->close;
?>
</body>
</html>