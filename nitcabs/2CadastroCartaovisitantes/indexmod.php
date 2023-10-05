<HTML>
	<head>
		<title>Cadastro Usuario</title>
		<meta http-equiv="Content-Type" content="text/html; charset=iso-8859-1">
		<script src="jquery.js" type="text/javascript"></script>
		<script src="jquery.validate.js" type="text/javascript"></script>
		<script src="additional-methods.js" type="text/javascript"></script>
			<style type="text/css">
				label { display: block; margin-top: 10px; }
				label.error { float: none; color: red; margin: 0 .5em 0 0; vertical-align: top; font-size: 14px }
				p { clear: both; }
				.submit { margin-top: 1em; }
				em { font-weight: bold; padding-right: 1em; vertical-align: top; }
			</style>
			<script type="text/javascript">
				$(document).ready( function() {
					$("#cadusuario").validate({
						// Define as regras
						rules:{
							nome:{
								// será obrigatorio (required) e terá tamanho minimo (minLength)
								required: true, minlength: 3
							},
							rg:{
								// cpf será obrigatorio (required) e terá tamanho minimo (minLength)
								required: true, minlength: 5
							},
							matricula:{
								// numero do manuscrito será obrigatorio (required) e terá tamanho minimo (minLength)
								required: true, minlength: 4
							}
						},
						// Define as mensagens de erro para cada regra
						messages:{
							nome:{
								required: "Digite o Nome do usuario ou o Carro caso seja TAG.",
								minlength: "O nome ou veiculo deve conter, no mínimo, 3 caracteres"
							},
							rg:{
								required: "Digite o RG do usuário ou a placa do Veiculo caso seja TAG. ",
								minlength: "O RG ou TAG deve conter no mínimo, 5 caracteres"
							},
							matricula:{
								required: "Digite o numero da matricula",
								minlength: "O numero da matricula deve conter, no mínimo, 4 caracteres"
							}
						}
					});
				});
			</script>
	</head>

	<title>    </title>
	<body onLoad="document.getElementById('campo1').focus()">
		
			<table>
				<form action = "cadbd.php", method = "POST" >
				<tr>
					<td align = "right" > Qual tipo de cartão  </td>
					<td> 
						<select name = "tipo">
							<option value = "F"> Funcionario </option>
							<option value = "V"> Visitante </option>
						</select>				
					</td>
				</tr>
				<tr>
					<td align = "right" > Insira o numero FC </td>
					<td> <input type = "text" id= 'campo1' name = "nw", maxlength="5", onkeyup="if(this.value.length >= '5') { codigo.focus()};"  > </td>
				</tr>
				<tr>
					<td align = "right" > Insira o codigo </td>
					<td> 
						<input type = "text" name = "codigo" maxlength="5", onkeyup="if(this.value.length >= '5') { matricula.focus()};" > 
						<input type = "hidden" name = "uso"  value = "NÃO" > 
					</td>
				</tr>
				<tr>
					<td align = "right" > Digite a Matricula</td>
					<td> <input type = "text" name = "matricula",  > </td>
				</tr>
				<tr>
					<td align = "right" > 
						Selecione a empresa:
					</td>
				
					<td colspan = "2">
						<?php
							//Verifico se o arquivo existe
							if(file_exists("init.php")) {
								require "init.php";		
							} else {
								echo "Arquivo init.php nao foi encontrado";
								exit;
							}
							//verifico se a função que eu criei existe, vai que alguem pegou meu script e apagou ela = )
							if(!function_exists("Abre_Conexao")) {
								echo "Erro o arquivo init.php foi alterado, nao existe a função Abre_Conexao";
								exit;
							}
							Abre_Conexao();

						?>
			
						<?php					
												  // montagem da combobox do empresa
						  if (isset($_POST['empresa'])) {

							// query no banco da tabela do combo
							$queryitem = "SELECT * FROM empresas WHERE empresa = '".$_POST['empresa']."';";

							// confirmação de resultado
							if($result = mysql_query($queryitem))  {

							  // concatenação
							  if($success = mysql_num_rows($result) > 0) {

								// agrupa para amostragem
								while ($row = mysql_fetch_array($result)) echo $row[serial];
							  }
							  // caso dê falha no bd
							  else { echo "No results found."; }
							}
							// falha na conexao com o bd
							else { echo "Failed to connect to database."; }
						  }
						  // mostra resultados ou...
						  else {

							 echo "<form method='post' action='tt.php'>";

							// populando o combobox
							$queryitem = "SELECT DISTINCT empresa FROM empresas ORDER BY empresa;";

							// confirmando sucesso
							if($result = mysql_query($queryitem))  {

							  // agrupando resultados
							  if($success = mysql_num_rows($result) > 0) {
								// combobox
								echo "<select name='empresa'>";
								echo "<option>-- Selecione --</option>";

								while ($row = mysql_fetch_array($result))
								  // while para agrupar todos os itens
								  echo "<option value='$row[empresa]'>$row[empresa]</option>";

								// fim da combo
								echo "</select>";
							  }
							  // erros
							  else { echo "No results found."; }
							}
							else { echo "Chegou no final, failed."; }

							}
						?>
					</td>
				</tr>				
				<tr>
					
					<td colspan = "2"> 
						<input type="submit" class="submit" name="Enviar" value="Enviar"  alt="Clique aqui ou aperte 'Enter'" style="cursor:pointer;"/>
					</td>
				</tr>
				
			
			</form>
			</table>
			
		
	</body>
</html>


