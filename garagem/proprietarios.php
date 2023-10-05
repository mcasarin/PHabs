<?php
include '../include/function.php';
include '../include/connect.php';
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
<title>Proprietarios</title>
</head>
<body>
<section class="container-fluid" style="margin-top:10px;margin-bottom:100px;">
    <div class="row">
    <div class="btn col-6">
	<h3>Proprietários</h3>
	<p align="left"><a href="newprop.php" class="btn btn-info">Novo</a></p> 
		<?php
			$sql = "SELECT * FROM proprietarios ORDER BY proprietario ASC";
			$sqlexe = $conn->query($sql);
			echo "<table class=\"table table-sm table-striped table-bordered table-hover\">
                    <thead class=\"thead-light\">
                        <th>Edição</th><th>Proprietários</th><th>Data registro</th>
                    </thead>
                    <tbody>";
			if($sqlexe->num_rows > 0){
				while($linha = $sqlexe->fetch_array(MYSQLI_ASSOC)){
					$id = $linha['id_prop'];
					$propriet = $linha['proprietario'];
					$registro = $linha['registro'];
					echo "<tr><td><a class=\"btn btn-warning\"href=\"editarprop.php?id=$id\">Editar<a/></td><td>$propriet</td><td>$registro</td></tr>";
				}//end while
			}//end if select
			echo "</tbody></table>";
		?>
	</div>
    </div> <!-- end row -->
	<p align="left"><a class="btn btn-outline-secondary" href="controle.php">Voltar para o menu</a></p>
</section>
</body>
</html>
<?php

?>