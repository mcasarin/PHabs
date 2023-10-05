<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
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
<style>
a:link {
  color: black;
  background-color: transparent;
  text-decoration: none;
}
a:visited {
  color: black;
  background-color: transparent;
  text-decoration: none;
}
a:hover {
  color: red;
  background-color: transparent;
  text-decoration: underline;
}
a:active {
  color: blue;
  background-color: transparent;
  text-decoration: underline;
}
</style>
<title>Carona</title>
</head>
<body>
<section class="container-fluid" style="margin-top:10px;margin-bottom:100px;">
    <div class="row"><div class="col-8">
	<h2 style="text-align:center;">Carona (Validados)</h2><br>
	<span class="badge badge-success"><a href="carona.php"> <<< Menu Carona </a></span>
	</div></div><br>
	<div class="row">
    <div class="col-8">
<?php
	if($_SESSION["tipo"] == '0'){ // administrativo
		$busca = "select id_carona,dataregistro,horaregistro,catraca,login,timestamp,matriculauser,nomeuser,empresauser,loginvalid from carona where valid='1';";
		$buscaexe = $conn->query($busca);
		if($buscaexe){
			echo "<table class='table table-sm table-striped table-bordered table-hover'>
                    <thead class='thead'>
                        <th>Data</th><th>Hora</th><th>Catraca</th><th>Nome</th><th>Empresa</th><th>Matrícula</th><th>Login Cadastro</th><th>Login Validação</th><th>Registro</th>
                    </thead>
                    <tbody>";
			while($row = $buscaexe->fetch_array(MYSQLI_ASSOC)){
                    $id = $row["id_carona"];
                    $dataregistro = $row["dataregistro"];
                    $horaregistro = $row["horaregistro"];
                    $catraca = $row["catraca"];
                    $nome = $row["nomeuser"];
                    $empresa = $row["empresauser"];
					$matricula = $row["matriculauser"];
                    $login = $row["login"];
					$loginv = $row["loginvalid"];
					$timestamp = $row["timestamp"];
			echo "<tr class='table-hover'><td>$dataregistro</td><td>$horaregistro</td><td>$catraca</td><td>$nome</td><td>$empresa</td><td>$matricula</td><td>$login</td><td>$loginv</td><td>$timestamp</td></tr>";
			} // end while valid
			echo "</tbody></table>";
		} // end busca
	} //end if administrativo
?>
    </div></div> <!-- end row -->
</section>
</body>
</html>
<?php
//end file
?>