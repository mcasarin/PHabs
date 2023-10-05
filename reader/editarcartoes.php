<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
/*
*		Edita, insere e atualização de cadastros cartões do PHabs no BD
*		Versão 2.9 Data 23nov20
*/
//declarar variaveis
$Sequencia = "";
$FC = "";
$Codigo = "";
$Tipo = "";
$Uso = "";
$cartao = "";
$Empresa = "";

if (isset($_GET["formdirect"])) {
	$formdirect = $_GET["formdirect"];
	$Sequencia = $_GET["matricula"];
} else {
	$formdirect = $_POST["formdirect"];
	$Sequencia = $_POST["matricula"];
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.css">
	<script src="../js/jquery-3.6.4.min.js"></script>
	<script src="../js/bootstrap.js"></script>
	<title>Cartões</title>
	<style>
		label {display: inline-block;width: 140px;text-align: right;}
		table {font-family:sans-serif;font-size:15px;}
	</style>
</head>

<body>
	<div class="container">
		<div class="row">
			<div class="table-responsive">
				<table class="table table-hover table-md">
				<form action="updatecartoes.php" method="post">
					<thead class="thead-dark">
						<tr>
								<?php
								if ($formdirect == 'atualiza') {
									echo "<th colspan=\"8\"><h2>Editar Cartão</h2></th>";
									echo "<input type=\"hidden\" name=\"sequencia\" id=\"sequencia\" value='$Sequencia'>";
									echo "<input type=\"hidden\" name=\"formdirect\" id=\"formdirect\" value=\"atualiza\">";
									$sql="select sequencia,FC,Codigo,cartao,tipo,uso,empresa from cartoes where sequencia='$Sequencia'";
									$sqlexe = $conn->query($sql);
									
									if($sqlexe){
										while($row = $sqlexe->fetch_array(MYSQLI_ASSOC)) {
											$Sequencia = $row['sequencia'];
											// echo $Sequencia."<br>";
											$FC = $row['FC'];
											// echo $FC."<br>";
											$Codigo = $row['Codigo'];
											$Tipo = $row['tipo'];
											$Uso = $row['Uso'];
											$cartao = $row['cartao'];
											$Empresa = $row['empresa'];
										} // end while
									}
								} elseif ($formdirect == 'insert') {
									echo "<th colspan=\"8\"><h2>Insere Cartão</h2></th>";
									echo "<input type=\"hidden\" name=\"formdirect\" id=\"formdirect\" value=\"insert\">";
								} elseif ($formdirect == 'apaga') {
									echo "<th colspan=\"8\"><h2>Exclusão Cartão/Conjunto</h2></th>";
									echo "<input type=\"hidden\" name=\"formdirect\" id=\"formdirect\" value=\"delete\">";
								}
								?>
						</tr>
					</thead>
					<tr><td colspan="2"><label for="matricula">Matrícula</label> <input type="number" id="matricula" name="matricula" maxlength="7" value="<?php echo $Sequencia; ?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" autofocus required><div class="col-sm-10 offset-sm-2" id="check_matricula"></div></td></tr>

					<tr><td><label for="fc">FC</label> <input type="text" name="fc" id="fc" maxlength="5" value="<?php echo $FC; ?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onKeyUp="PulaCampo(this)" pattern="^(\d{5})$" title="Mínimo de 5 caracteres" required></td></tr>

					<tr><td><label for="codigo">Código</label> <input type="text" name="codigo" id="codigo" maxlength="5" value="<?php echo $Codigo; ?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" onKeyUp="PulaCampo(this)" pattern="^(\d{5})$" title="Mínimo de 5 caracteres" required></td></tr>

					<tr><td><label for="cartao">Cartão</label> <input type="text" name="cartao" id="cartao" maxlength="10" value="<?php echo $cartao; ?>" oninput="javascript: if (this.value.length > this.maxLength) this.value = this.value.slice(0, this.maxLength);" pattern="^(\d{10})$" title="Mínimo de 10 caracteres" required></td></tr>

					<tr><td><label for="tipo">Tipo</label> 
						<select name="tipo" required>
							<option value="<?php echo $Tipo; ?>">
								<?php
									if($Tipo == "F"){
										echo "Usuário";
									} elseif($Tipo == "V") {
										echo "Visitantes";
									} else {
										echo "";
									}
								?>
							</option>
							<option value="F">Usuário</option>
							<option value="V">Visitantes</option>
						</select>
					</td></tr>

					<tr><td colspan="2"><label for="empresa">Empresa</label> <?php
						echo "<select name=\"empresa\" id=\"empresa\" style=\"font-size:13px\" required>";
						echo "<option value='".$Empresa."'>".$Empresa."</option>";	
						// montagem da combobox empresa
						// populando o combobox
						$sql2 = "SELECT DISTINCT empresa FROM empresas WHERE empresa BETWEEN '00' AND '9999' ORDER BY empresa + 0 ASC;"; //+0 para ordenar campo
						
						// confirmando sucesso
						$result2 = $conn->query($sql2);
						
						// agrupando resultados
						if($result2->num_rows > 0) {
						// combobox

							while ($row1 = $result2->fetch_array(MYSQLI_ASSOC))
								// while para agrupar todos os itens
								echo "<option value=\"$row1[empresa]\">$row1[empresa]</option>";
						}
						echo "</select>";
					?></td></tr>
				</table>
			</div> <!-- fim div table -->
			<br>
			<input type="hidden" name="formdirect" value="<?php echo $formdirect; ?>">
			<!-- Efetuado ajustes no layout via boostrap -->
			<div class="d-flex justify-content-center">
				<div class="col-3"></div>
				<div class="col-2"><input type="submit" class="btn btn-success btn-lg" value="Salvar"></div>
				<div class="col-2"></div>
				<div class="col-3"><input type="reset" class="btn btn-info btn-lg" value="Limpar formulário"></div>
				<div class="col-2"></div>
			</div>
				</form>
		</div> <!-- fim row2 -->
	</div> <!-- fim container -->
	<script>// Checando se o matricula existe no BD
    $(document).ready(function() {
      $("#matricula").keyup(function() {

        let matricula = $(this).val().trim();

        if (matricula != '') {

          $.ajax({
            url: 'consultamatricula.php',
            type: 'post',
            data: {
              matricula: matricula
            },
            success: function(response) {

              $('#check_matricula').html(response);

            }
          });
        } else {
          $("#check_matricula").html("");
        }

      });

    });
	// função pula campo
	function PulaCampo(fields) {
		if (fields.value.length == fields.maxLength) {
			for (var i = 0; i < fields.form.length; i++) {
				if (fields.form[i] == fields && fields.form[(i + 1)] && fields.form[(i + 1)].type != "hidden") {
					fields.form[(i + 1)].focus();
					break;
				}
			}
		}
	}
	// função concatena campos
	window.oninput = function(event){
	var campo = event.target.id; // pega o id do campo que chamou o evento
		if(campo == "fc"){
			document.querySelector('#cartao').value = document.querySelector('#fc').value+document.querySelector('#codigo').value;
		}else if(campo == "codigo"){
			document.querySelector('#cartao').value = document.querySelector('#fc').value+document.querySelector('#codigo').value;
		}
	};
	</script>
</body>
<?php
$conn->close();
//fim do arquivo
?>