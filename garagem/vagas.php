<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
// Declara variaveis
$id = "";
$vaga = "";
$prop = "";
$anotacao = "";
$registro = "";

if(isset($_POST['conjunto'])) {
	$conjunto = $_POST['conjunto'];
} else {
	$conjunto = "";
}

if(isset($_POST['utiliza'])) {
	$utiliza = $_POST['utiliza'];
} else {
	$utiliza = "";
}

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
<title>Vagas</title>
</head>
<body>
<section class="container-fluid" style="margin-top:10px;margin-bottom:100px;">
	<div class="row">
		<div class="col-sm"></div>
		<div class="col-sm" style="text-align:center;">
			<h3>Vagas</h3>
		</div>
		<div class="col-sm"></div>
	</div>
    <div class="row">
    <div class="col-12">
	<p align="left"><a href="newvaga.php" class="btn btn-info btn-sm">Nova</a> <a class="btn btn-warning btn-sm" href="controle.php"> Voltar </a></p>
	 
		<form action="vagas.php" method="post">
		<label for="conjunto">Filtro por conjunto:</label>
			<?php
			echo "<select name='conjunto' id='conjunto' style='width:250px;'>
				<option value=''></option>";
				// montagem da combobox conjunto
                    // populando o combobox
                    $sql_empresac = "SELECT ID,Empresa FROM empresas WHERE Empresa NOT LIKE 'AUSENTE%' AND Empresa NOT LIKE 'ETWAS%' AND Empresa NOT LIKE 'NETWORK%' AND Empresa NOT LIKE 'PROPRIETARIOS%' ORDER BY Empresa +0 ASC;";
                    $result_empresac = $conn->query($sql_empresac);
                    if($result_empresac->num_rows > 0) {
					// combobox
                        while ($row1 = $result_empresac->fetch_array(MYSQLI_ASSOC)){
							$empresa = $row1['Empresa'];
							$id = $row1['ID'];
							// while para agrupar todos os itens
                            echo "<option value=\"$id\">$empresa</option>";
						}//end while
                    }
					// fim da combo conjunto
					echo "</select>";
			?>
				<input class="btn btn-success btn-sm" type="submit" value="Aplicar" name="aplicar">
			</form>
			<form action="vagas.php" method="post">
		<label for="utiliza">Filtro por utilização:</label>
			<?php
			echo "<select name='utiliza' id='utiliza' style='width:250px;'>
				<option value=''></option>;
				<option value='0'>Não utilizada / Cadastrada</option>";
				// montagem da combobox conjunto
                    // populando o combobox
                    $sql_empresac = "SELECT ID,Empresa FROM empresas WHERE Empresa NOT LIKE 'AUSENTE%' AND Empresa NOT LIKE 'ETWAS%' AND Empresa NOT LIKE 'NETWORK%' AND Empresa NOT LIKE 'PROPRIETARIOS%' ORDER BY Empresa +0 ASC;";
                    $result_empresac = $conn->query($sql_empresac);
                    if($result_empresac->num_rows > 0) {
					// combobox
                        while ($row1 = $result_empresac->fetch_array(MYSQLI_ASSOC)){
							$empresa = $row1['Empresa'];
							$id = $row1['ID'];
							// while para agrupar todos os itens
                            echo "<option value=\"$id\">$empresa</option>";
						}//end while
                    }
					// fim da combo conjunto
					echo "</select>";
			?>
				<input class="btn btn-success btn-sm" type="submit" value="Aplicar" name="aplicar">
			</form>
		<?php
		
			if ($conjunto > 0){
				$sql = "SELECT * FROM garagem WHERE conjunto='$conjunto' ORDER BY vaga ASC";
			} elseif ($utiliza > 0 || $utiliza == '0'){
				$sql = "SELECT * FROM garagem WHERE utiliza='$utiliza' ORDER BY vaga ASC";
			} else {
				$sql = "SELECT * FROM garagem ORDER BY vaga ASC";
			}
			$sqlexe = $conn->query($sql);
			echo "<table class=\"table table-sm table-striped table-bordered table-hover\">
                    <thead class=\"thead-light\">
                        <th>Edição</th><th>Vaga</th><th>Proprietário</th><th>Conjunto</th><th>Utilização</th><th>Anotação</th><th>Registro</th>
                    </thead>
                    <tbody>";
			if($sqlexe->num_rows > 0){
				while($linha = $sqlexe->fetch_array(MYSQLI_ASSOC)){
					$id = $linha['id_gar'];
					$vaga = $linha['vaga'];
					$prop = $linha['proprietario'];
					$conjunto = $linha['conjunto'];
					$utiliza = $linha['utiliza'];
					$anotacao = $linha['anotacao'];
					$registro = $linha['registro'];
					echo "<tr><td><a class=\"btn btn-warning btn-sm\"href=\"editarvaga.php?id=$id\">Editar<a/></td><td><b>$vaga</b></td><td>";
						$sql_prop = "SELECT proprietario FROM proprietarios WHERE id_prop=$prop LIMIT 1";
						$result_prop = $conn->query($sql_prop);
						if($result_prop){
							while($ver_prop = $result_prop->fetch_array(MYSQLI_ASSOC)){
								$nome_prop = $ver_prop['proprietario'];
								echo $nome_prop;
							}
						}
					echo "</td><td>";
						$sql_conjunto = "SELECT Empresa FROM empresas WHERE ID='$conjunto' LIMIT 1;";
						$sql_conjuntoexe = $conn->query($sql_conjunto);
						if($sql_conjuntoexe){
							while($ver_conjunto = $sql_conjuntoexe->fetch_array(MYSQLI_ASSOC)){
								$nome_conjunto = $ver_conjunto['Empresa'];
								echo $nome_conjunto;
							} 
						}
						if($utiliza > 0){
							$sql_utiliza = "SELECT Empresa FROM empresas WHERE ID='$utiliza' LIMIT 1;";
							$sql_utilizaexe = $conn->query($sql_utiliza);
							if($sql_utilizaexe){
								while($ver_utiliza = $sql_utilizaexe->fetch_array(MYSQLI_ASSOC)){
									$nome_utiliza = $ver_utiliza['Empresa'];
										if($nome_utiliza > 0){
											echo "</td>
											<td><a href='validavagatag.php?empresa=$nome_utiliza&vaga=$vaga&conjunto=$conjunto' target='_blank'>";
											echo $nome_utiliza."</a>";
										} elseif($nome_utiliza == 0 || $nome_utiliza == '' || !$nome_utiliza) {
											echo "</td><td>Não Utilizada/Cadastrada";
										}
								}
							}
						} else {
							echo "</td><td>Não Utilizada/Cadastrada";
						}
					echo "</td><td>";
					if(!$anotacao){
						echo "&nbsp";
					} else {
						echo $anotacao;
					}
					echo "</td><td>$registro</td></tr>";
				}//end while
			}//end if select
			echo "</tbody></table>";
		?>
	</div>
    </div> <!-- end row -->
	<br>
<p align="left"><a class="btn btn-outline-secondary" href="controle.php">Voltar para o menu</a></p>
</section>
</body>
</html>
<?php
$conn->close;
//eof
?>