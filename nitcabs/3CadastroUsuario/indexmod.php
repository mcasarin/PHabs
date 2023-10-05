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
	<body onLoad="document.getElementById('campo1').focus()" bgcolor="#CCCCBB">	
	<table align="center" height="100" width="900" border="2" cellspacing="0" cellpadding="0" bgcolor="#CCCCBB" bordercolor="#FF0000">
		<tr align="center">
			<td align="center" height="100" valign="middle">		 
				<form method="POST" action="caduser.php" name="cadusuario" id="cadusuario">
					<table align = "left">
					<tr>
							<td align = "right" width = "200"> Tipo de Usuário  </td>
							<td width = "80"> 
								<select name = "tipo">
									<option value = "Funcionário"> Funcionário </option>
									<option value = "Estagiário"> Estagiário </option>
									<option value = "Prestador de Serviços"> Prestador de Serviços </option>
									<option value = "Provisório"> Provisório </option>
									<option value = "Outros"> Outros </option>
								</select>				
							</td>					
						</tr>
						<tr> 
							<td align = "right" width = "200"> Nome do Usuário / Veículo </td>
							<td > <input type = "text" name = "nome" size = "77" id = "campo1"  > </td>
							
						</tr>
						<tr>
							<td align = "right" > Digite o Rg /Placa </td>
							<td> <input type = "text" name = "rg" > </td>
						</tr>
						
						<tr>
							<td align = "right" > Digite a Matricula do cartão </td>
							<td> <input type = "text" name = "matricula"  > </td>
						</tr>
						<tr>
							<td colspan = "8"> 
							&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
								<input type="submit" class="submit" name="Enviar" value="Enviar"  alt="Clique aqui ou aperte 'Enter'" style="cursor:pointer;"/>
							</td>
						</tr>
					</table>
				</form>
			</td>
		</tr>
	</table>
		
	</body>
</html>


