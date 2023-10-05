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
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/bootstrap.min.js"></script>
<title>Vagas</title>
</head>
<body>
<section class="container-fluid" style="margin-top:10px;margin-bottom:100px;">
    <div class="row">
		<div class="col-12">
			<?php
			$sql = "SELECT * FROM garagem WHERE id_gar = $id";
			$sqlexe = $conn->query($sql);
			echo "<table class=\"table responsive table-striped table-bordered table-hover\">
                    <thead class=\"thead-light\">
                        <th>Vaga</th><th colspan=\"2\">&nbsp;</th>
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
					echo "<form action=\"execvaga.php\" method=\"post\"><input type=\"hidden\" name=\"id\" id=\"id\" value=\"".$id."\">";
					echo "<tr><td><input type=\"number\" name=\"vaga\" id=\"vaga\" value=\"".$vaga."\" min=\"1\" max=\"999\" required></td><td colspan=\"2\">&nbsp;</td></tr>
                    <th>Proprietário</th><th>Conjunto</th><th>Utiliza</th>
					<tr><td><select name=\"prop\" id=\"prop\" class=\"form-control\" required>";
				
					// busca proprietario previamente selecionado
						$sql_propi = "SELECT id_prop,proprietario FROM proprietarios WHERE id_prop=$prop;";
						$result_propi = $conn->query($sql_propi);
						// agrupando resultados
						if($result_propi->num_rows > 0) {
						// combobox
							while ($rowi = $result_propi->fetch_array(MYSQLI_ASSOC)){
								$idi = $rowi['id_prop'];
								$propi = $rowi['proprietario'];
								// while para agrupar todos os itens
								echo "<option value=\"$idi\">$propi</option>";
							}//end while
						} else {
							echo "<option value=\"off\"><i>Selecione</i></option>";
						}
					// fim da busca nome proprietario
					
					// montagem da combobox proprietario
						$sql_prop = "SELECT id_prop,proprietario FROM proprietarios ORDER BY proprietario ASC;";
						$result_prop = $conn->query($sql_prop);
						if($result_prop->num_rows > 0) {
						// combobox
							while ($row = $result_prop->fetch_array(MYSQLI_ASSOC)){
								$id = $row['id_prop'];
								$prop = $row['proprietario'];
								// while para agrupar todos os itens
								echo "<option value=\"$id\">$prop</option>";
							}//end while
						}
					// fim da combo proprietario
					
				echo "</select></td>
				<td><select name=\"conjunto\" id=\"conjunto\" class=\"form-control\" required>";
				
					// busca conjunto previamente selecionado
                    $sql_empresaci = "SELECT ID,Empresa FROM empresas WHERE ID=$conjunto";
                    $result_empresaci = $conn->query($sql_empresaci);
                    if($result_empresaci->num_rows > 0) {
					// combobox
                        while ($rowci = $result_empresaci->fetch_array(MYSQLI_ASSOC)){
							$empresa = $rowci['Empresa'];
							$id = $rowci['ID'];
							// while para agrupar todos os itens
                            echo "<option value=\"$id\">$empresa</option>";
						}//end while
                    } else {
						echo "<option value=\"off\"><i>Selecione</i></option>";
					}
					// fim da combo conjunto
					
				    // montagem da combobox conjunto
                    // populando o combobox
                    $sql_empresac = "SELECT ID,Empresa FROM empresas WHERE Empresa NOT LIKE 'AUSENTE%' AND Empresa NOT LIKE 'ETWAS%' AND Empresa NOT LIKE 'NETWORK%' ORDER BY Empresa +0 ASC;";
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

				echo "</select></td>
				<td><select name=\"utiliza\" id=\"utiliza\" class=\"form-control\">";
					// busca utilizador previamente selecionado
                    $sql_empresaui = "SELECT ID,Empresa FROM empresas WHERE ID=$utiliza;";
                    $result_empresaui = $conn->query($sql_empresaui);
                    if($result_empresaui->num_rows > 0) {
					// combobox
                        while ($rowui = $result_empresaui->fetch_array(MYSQLI_ASSOC)){
							$empresaui = $rowui['Empresa'];
							$idui = $rowui['ID'];
							// while para agrupar todos os itens
                            echo "<option value=\"$idui\">$empresaui</option>";
						}//end while
                    } else {
						echo "<option value=\"0\"><i>Vaga não utilizada</i><option>";
					}

					// fim da combo utilizador	
			
				    // montagem da combobox utilizador
                    $sql_empresau = "SELECT ID,Empresa FROM empresas WHERE Empresa NOT LIKE 'AUSENTE%' AND Empresa NOT LIKE 'ETWAS%' AND Empresa NOT LIKE 'NETWORK%' ORDER BY Empresa +0 ASC;";
                    $result_empresau = $conn->query($sql_empresau);
                    if($result_empresau->num_rows > 0) {
					// combobox
                        while ($row2 = $result_empresau->fetch_array(MYSQLI_ASSOC)){
							$empresau = $row2['Empresa'];
							$idu = $row2['ID'];
							// while para agrupar todos os itens
                            echo "<option value=\"$idu\">$empresau</option>";
						}//end while
                    }
					// fim da combo utilizador
				
				echo "</td></tr>
				<th colspan=\"2\">Anotação</th><th>Registro</th>
				<tr><td colspan=\"2\"><textarea name=\"anotacao\" id=\"anotacao\" rows=\"4\" cols=\"50\">$anotacao</textarea></td>
				<td>$registro</td></tr>
				<tr><td colspan=\"3\"><input class=\"btn btn-success\" type=\"submit\" name=\"salvar\" value=\"Salvar\">&nbsp;&nbsp;&nbsp;<input class=\"btn btn-danger excluir\" type=\"submit\" name=\"excluir\" id=\"excluir\" onclick=\"return confirm('Tem certeza que quer excluir uma vaga?')\" value=\"Excluir\"></td></tr>";
				}//end while
			}//end if select
			echo "</form></tbody></table>";
		?>
<p align="left"><a class="btn btn-outline-secondary" href="vagas.php">Voltar para lista</a></p>
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