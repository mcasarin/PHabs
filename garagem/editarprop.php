<?php
include '../include/function.php';
include '../include/connect.php';
sessao();

if($_SERVER['REQUEST_METHOD'] == "GET") {
	$id = $_GET['id'];
	
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
<title>Vagas</title>
</head>
<body>
<section class="container-fluid" style="margin-top:10px;margin-bottom:100px;">
    <div class="row">
		<div class="btn col-6">
			<?php
			$sql = "SELECT * FROM proprietarios WHERE id_prop = $id";
			$sqlexe = $conn->query($sql);
			echo "<table class=\"table table-sm table-striped table-bordered table-hover\">
                    <thead class=\"thead-light\">
                        <th>Nome</th><th>&nbsp;</th><th>&nbsp;</th>
                    </thead>
                    <tbody>";
			if($sqlexe->num_rows > 0){
				while($linha = $sqlexe->fetch_array(MYSQLI_ASSOC)){
					$id = $linha['id_prop'];
					$prop = $linha['proprietario'];
					echo "<form action=\"execprop.php\" method=\"post\"><input type=\"hidden\" name=\"id\" id=\"id\" value=\"".$id."\">";
					echo "<tr><td><input type=\"text\" name=\"prop\" id=\"prop\" value=\"".$prop."\"></td>
					<td><input class=\"btn btn-success\" type=\"submit\" name=\"salvar\" value=\"Salvar\"></td><td><input class=\"btn btn-danger excluir\" type=\"submit\" name=\"excluir\" id=\"excluir\" onclick=\"return confirm('Tem certeza que quer excluir um proprietário? Vagas podem ficar orfãs caso tenham vínculo com ele.')\" value=\"Excluir\"></td></tr>";
				}//end while
			}//end if select
			echo "</form></tbody></table>";
		?>
<p align="left"><a class="btn btn-outline-secondary" href="proprietarios.php">Voltar para lista</a></p>
		</div>
	</div>
</section>
</body>
</html>
<?php
$conn->close;
}//end if get
//eof
?>