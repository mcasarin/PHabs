<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
$id = "";
$nome = "";
$dataregistro = "";
$horaregistro = "";
$catraca = "";
$nome = "";
$empresa = "";
$login = "";
$timestamp = "";
/*
#   
#   Valida carona
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
    <div class="col-8">
<?php
	if($_SESSION["tipo"] == '0'){//administrativo
		$busca = "select id_carona,dataregistro,horaregistro,catraca,nome,empresa,login,timestamp from carona where valid='0'";
		$buscaexe = $conn->query($busca);
		if($buscaexe){
			echo "<table class=\"table table-sm table-striped table-bordered table-hover\">
                    <thead class=\"thead\">
                        <th>Data</th><th>Hora</th><th>Catraca</th><th>Nome</th><th>Empresa</th><th>Login</th><th>Registro</th><th>Validação</th>
                    </thead>
                    <tbody>";
			while($row = $buscaexe->fetch_array(MYSQLI_ASSOC)){
                    $id = $row["id_carona"];
                    $dataregistro = $row["dataregistro"];
                    $horaregistro = $row["horaregistro"];
                    $catraca = $row["catraca"];
                    $nome = $row["nome"];
                    $empresa = $row["empresa"];
                    $login = $row["login"];
					$timestamp = $row["timestamp"];
			
			echo "<tr class=\"table-danger\"><td>$dataregistro</td><td>$horaregistro</td><td>$catraca</td><td>$nome</td><td>$empresa</td><td>$login</td><td>$timestamp</td><td><a href=\"checkvalidacarona.php?id=$id&dataregistro=$dataregistro&horaregistro=$horaregistro&catraca=$catraca&nome=$nome&empresa=$empresa\">[ Validar ]</a></td></tr>";
			} // end while valid
			echo "</tbody></table>";
		} // end busca
	} //end if administrativo
?>
    </div> <!-- end row -->
</section>
</body>
</html>
<?php
//end file
?>