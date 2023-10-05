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
					$("#cartao").validate({
						// Define as regras
						rules:{
							nw:{
								// será obrigatorio (required) e terá tamanho minimo (minLength)
								required: true, minlength: 5
							},
							codigo:{
								// cpf será obrigatorio (required) e terá tamanho minimo (minLength)
								required: true, minlength: 5
							},
							matricula:{
								// numero do manuscrito será obrigatorio (required) e terá tamanho minimo (minLength)
								required: true, minlength: 3
							}
						},
						// Define as mensagens de erro para cada regra
						messages:{
							nw:{
								required: "Digite os cinco numeros depois do W: e antes da virgula, caso seja menor começe com 0 ex:00136.",
								minlength: "Tem que ter 5 digitos numericos"
							},
							codigo:{
								required: "Digite os cinco numeros depois da virgula",
								minlength: "Tem que ter 5 digitos numericos"
							},
							matricula:{
								required: "Digite o numero da matricula",
								minlength: "O numero da matricula deve conter, no mínimo, 3 caracteres"
							}
						}
					});
				});
			</script>
	</head>

	<title>    </title>
	<body onLoad="document.getElementById('campo1').focus()"  bgcolor = "silver">
		<form  method = "POST" action = "cadbd.php" name="cartao" id="cartao" >
			<table>
				<?php
					if($_SERVER["REQUEST_METHOD"] == "GET") 
					{	
						$matricula = $_GET["matricula"]; //sequencia no nitcabs
						$matricula +=1;
						if($matricula == '1')
						{
							$matricula = '';
						}
						echo "matricula = $matricula<br>";
						//$nw = $_GET["nw"];//fc no nitcabs
					}
					else
					{
						$matricula = "";
					}
				?>
				<tr>
					<td align = "right" > Qual tipo de cartão  </td>
					<td> 
						<select name = "tipo">
							
							<option value = "V"> Visitante </option>
							<option value = "F"> Funcionario </option>
						</select>				
					</td>
				</tr>
				<tr>
					<td align = "right" > Insira o numero FC </td>
					<td> <input type = "text" id= 'campo1' name = "nw", value = "<?php echo $nw ?>" maxlength="5", onkeyup="if(this.value.length >= '5') { codigo.focus()};"  > </td>
				</tr>
				<tr>
					<td align = "right" > Insira o codigo </td>
					<td> 
						<input type = "text" name = "codigo"  id= 'campo2' maxlength="5", onkeyup="if(this.value.length >= '5') { matricula.focus()};" > 
						<input type = "hidden" name = "uso"  value = "NÃO" > 
					</td>
				</tr>
				<tr>
					<td align = "right" > Digite a Matricula</td>
					<td> <input type = "text" name = "matricula", value = "<?php echo $matricula ?>"  maxlength="5", onkeyup="if(this.value.length >= '5') {campo15.focus()};"  > </td>
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
								echo "<option>95 - WINSTON CHURCHILL</option>";

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
						<input type="submit" class="submit" name="Enviar" value="Enviar" id='campo15'  alt="Clique aqui ou aperte 'Enter'" style="cursor:pointer;"/>
					</td>
				</tr>
				
			
			
			</table>
		</form>	
		
	</body>
</html>


