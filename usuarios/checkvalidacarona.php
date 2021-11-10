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
	<h2 class="" style="text-align:center;">Carona</h2><br>
		<span class="badge badge-success" style="text-align:center;text-color:black;"><a href="validacarona.php"> <<< Voltar </a></span><br><br>
		<span class="badge badge-warning" style="text-align:center;">Para validar, clique em SIM do registro que pertence ao usuário que deu carona.</span>
	</div></div>
	<div class="row">
    <div class="col-8">
	<table class="table table-sm table-striped table-bordered table-hover">
<?php
	if($_SESSION["tipo"] == '0'){ // usuário administrativo
		if($_SERVER["REQUEST_METHOD"] == "GET"){
			$id = $_GET["id"];
			$dataregistro = $_GET["dataregistro"];
			$horaregistro = $_GET["horaregistro"];
			$catraca = $_GET["catraca"];
			$nome = $_GET["nome"];
			$empresa = $_GET["empresa"];
			$dataregistrovalid = date("dmY", strtotime(str_replace("-", "",$dataregistro)));
			$tabeladia = "d".$dataregistrovalid;
			$buscausuario = "select Nome,Empresa,Matricula,Descricao,Hora from $tabeladia where Descricao='$catraca' and Hora like '$horaregistro%'";
			$buscausuarioexe = $conn->query($buscausuario);
			echo "<table class=\"table table-sm table-danger\">";
			echo "<th colspan=\"5\">Esta é a carona registrada</th>";
			echo "<tr><td>Data</td><td>Hora</td><td>Catraca</td><td>Nome</td><td>Empresa</td></tr>";
			echo "<tr><td>$dataregistro</td><td>$horaregistro</td><td>$catraca</td><td>$nome</td><td>$empresa</td></tr>";
			echo "</table>";
			echo "<table class=\"table table-sm table-striped table-bordered table-hover\">";
			if($buscausuarioexe){
					echo "<th>Nome</th><th>Empresa</th><th>Matricula</th><th>Descricao</th><th>Hora</th><th>Valida?</th>";
					echo "<tbody>";
					while($row1 = $buscausuarioexe->fetch_array(MYSQLI_ASSOC)){
						$nomed = $row1["Nome"];
						$empresad = $row1["Empresa"];
						$matricula = $row1["Matricula"];
						$descricaod = $row1["Descricao"];
						$horad = $row1["Hora"];
						echo "<tr><td>$nomed</td><td>$empresad</td><td>$matricula</td><td>$descricaod</td><td>$horad</td><td>";
						echo "<form action='salvarvalidacarona.php' method='POST'>";
						echo "<input type='hidden' name='id' value='$id'>
								<input type='hidden' name='nome' value='$nomed'>
								<input type='hidden' name='empresa' value='$empresad'>
								<input type='hidden' name='matricula' value='$matricula'>
								<button type='submit' class='btn btn-danger btn-sm' name='submit'>SIM</button></td></tr>";
					} // end while buscausuario
				} else {
					echo "<tr><td colspan='7'>Nenhum registro encontrado!</td></tr>";
				}// end buscausuario
		} // end method get
	} //end if administrativo
?>
</tbody></table></div> <!-- end row -->
</section>
</body>
</html>
<?php

//end file
?>