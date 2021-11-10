<?php
include '../include/function.php';
include '../include/connect.php';
sessao();
?>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<link rel="stylesheet" href="../css/bootstrap.min.css">
	<link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.css" />
	<script src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/jquery/latest/jquery.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/momentjs/latest/moment.min.js"></script>
	<script type="text/javascript" src="https://cdn.jsdelivr.net/npm/daterangepicker/daterangepicker.min.js"></script>
<title>Cadastro autorização temporária Garagem</title>
<style>
#nameError {
  display: none;
  font-size: 0.8em;
}

#nameError.visible {
  display: block;
}

input.invalid {
  border-color: red;
}
</style>
<script>
function validateForm() {
  let x = document.forms["cadastroautoriza"]["nomeautoriza"].value;
  if (x == "" || x == " ") {
    alert("É necessário preencher com o nome do autorizador!");
    return false;
  }
  let y = document.forms["cadastroautoriza"]["empresa"].value;
  if (y == "") {
    alert("É necessário selecionar o conjunto!");
    return false;
  }
  let z = document.forms["cadastroautoriza"]["placa"].value;
  if (z == "") {
    alert("É necessário preencher com a placa do utilizador!");
    return false;
  }
}
</script>
</head>
<body>
<div class="row">
<div class="col-lg-8 table-responsive">
<table class="table table-hover">
    <tr><td colspan="4" align="center"><h3><b>Cadastro de Autorização temporária da Garagem</b></h3></td></tr>
        <form action="salvarautoriza.php" name="cadastroautoriza" id="cadastroautoriza" onsubmit="return validateForm()" method="POST">
		
		<tr><td><label for="dataregistro">Selecione a data ou período:</label></td>
                <td>
                <div class="input-group" id="daterangepicker">
                    <input type="text" size="25" class="form-control" id="dataregistro" name="dataregistro" autocomplete="off" required />
                </div>
                <!-- jQuery Script -->
                <script type="text/javascript">
                    // Calendário
					$(function() {
						$('input[name="dataregistro"]').daterangepicker({
							startDate: moment(),
							locale: {
								format: 'DD/MM/YYYY',
								separator: ' - ',
								applyLabel: 'Selecionar',
								cancelLabel: 'Fechar',
								customRangeLabel: 'Custom',
								weekLabel: 'W',
								daysOfWeek: [
									'Dom',
									'Seg',
									'Ter',
									'Qua',
									'Qui',
									'Sex',
									'Sab'
								],
								monthNames: [
									'Janeiro',
									'Fevereiro',
									'Março',
									'Abril',
									'Maio',
									'Junho',
									'Julho',
									'Agosto',
									'Setembro',
									'Outubro',
									'Novembro',
									'Dezembro'
								],
								firstDay: 1
							}							
						});
					});
					
                </script><!-- end calendario -->
				
            </td><td> </td><td>
			
				</td></tr>
		<tr><td><label for="nomeautoriza">Nome do autorizador: </label></td><td colspan="3"><input size="60" type="text" id="nomeautoriza" name="nomeautoriza" maxlength="60" style = "text-transform: uppercase" />
			</td></tr>
		<tr><td><label for="empresa">Conjunto </label></td><td colspan="3"><?php
        // montagem da combobox empresa
            echo "<select name='empresa' id='empresa'>";
            echo "<option value=''>-- Selecione --</option>";
            // populando o combobox
            $sql3 = "SELECT DISTINCT empresa FROM empresas WHERE empresa BETWEEN '00' AND '9999' AND VagaCond > '0' OR VagaVis > '0' ORDER BY empresa + 0 ASC;"; // +0 para ordenar campo
        
           // confirmando sucesso
            $result3 = $conn->query($sql3);
        
           // agrupando resultados
            if($result3->num_rows > 0) {
            // combobox
            
            while ($row = $result3->fetch_array(MYSQLI_ASSOC))
                // while para agrupar todos os itens
                echo "<option value='$row[empresa]'>$row[empresa]</option>";
            }
            echo "</select>";
                // fim da combo<br>
                $conn->close();
        ?>
        </td></tr>
        <tr><td><label for="nomeutiliza">Nome do utilizador: </label></td><td colspan="3"><input size="60" type="text" id="nomeutiliza" name="nomeutiliza" maxlength="60" style = "text-transform: uppercase" />
		</td></tr>
        <tr><td><label for="placa">Placa: </label></td><td colspan="3"><input size="10" type="text" id="placa" name="placa" style="text-transform: uppercase" minlength="6" maxlength="7"></td></tr>
		
        <tr align="center"><td colspan="2"><button class="btn btn-primary btn-lg" name="submit" id="submit" alt="Clique aqui ou aperte 'Enter'" style="cursor:pointer;">Cadastrar</button></td>
		<td colspan="2"><a href="garagem.php" class="btn btn-warning btn-sm" name="voltamenu" alt="Clique aqui para voltar ao menu" style="cursor:pointer;">Voltar</a></td></tr>
        </form>
</table>
</div><!--end table responsive-->
</div><!--end row-->
</body>
</html>