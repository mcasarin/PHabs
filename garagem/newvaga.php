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
<script src="../js/jquery-1.12.4.js"></script>
<script src="../js/bootstrap.min.js"></script>
<title>Vagas</title>
</head>
<body>
<table class="table table-sm table-striped table-bordered table-hover">
	<tbody>
		<form action="execvaga.php" method="post">
			<tr><td>Vaga</td><td><input type="number" name="vaga" id="vaga" size="4"></td></tr>
			<tr><td>Proprietário</td><td><select name="prop" id="prop" class="form-control" required>";
		        <option value="off"><i>Selecionar o proprietário</i></option>";
				<?php
				    // montagem da combobox proprietario
                    $sql_prop = "SELECT id_prop,proprietario FROM proprietarios ORDER BY proprietario ASC;";
                    $result_prop = $conn->query($sql_prop);
                    
                    // agrupando resultados
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
				?></select>
			</td></tr>
			<tr><td>Conjunto</td><td><select name="conjunto" id="conjunto" class="form-control" required>";
		        <option value="off">Selecionar o conjunto</option>";	
				<?php
				    // montagem da combobox conjunto
                    // populando o combobox
                    $sql_empresac = "SELECT ID,Empresa FROM empresas WHERE Empresa NOT LIKE 'AUSENTE%' AND Empresa NOT LIKE 'ETWAS%' AND Empresa NOT LIKE 'NETWORK%' ORDER BY Empresa +0 ASC;"; //+0 para ordenar campo
                    
                    // confirmando sucesso
                    $result_empresac = $conn->query($sql_empresac);
                    
                    // agrupando resultados
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
?>
				</select></td></tr>
			<tr><td>Utilizada por</td><td><select name="utiliza" id="utiliza" class="form-control" required>";
		        <option value="off">Selecionar o utilizador</option>";	
				<?php
				    // montagem da combobox utilizador
                    // populando o combobox
                    $sql_empresau = "SELECT ID,Empresa FROM empresas WHERE Empresa NOT LIKE 'AUSENTE%' AND Empresa NOT LIKE 'ETWAS%' AND Empresa NOT LIKE 'NETWORK%' ORDER BY Empresa +0 ASC;"; //+0 para ordenar campo
                    
                    // confirmando sucesso
                    $result_empresau = $conn->query($sql_empresau);
                    
                    // agrupando resultados
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
?>
				</select></td></tr>
			<tr><td>Anotações</td><td><textarea name="anotacao" id="anotacao" rows="2" cols="50"></textarea></td></tr>
			<tr><td colspan="2"><input class="btn btn-success" type="submit" name="gravar" value=" Gravar "></td></tr>
		</form>
	</tbody>
</table>
<br>
<p align="left"><a class="btn btn-outline-secondary" href="vagas.php">Voltar para lista</a></p>
</body>
</html>
<?php
$conn->close;
//eof
?>