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
	<link rel="stylesheet" type="text/css" href="../css/daterangepicker.css" />
	<script src="../js/bootstrap.min.js"></script>
	<script type="text/javascript" src="../js/jquery-3.2.1.js"></script>
	<script type="text/javascript" src="../js/moment-2.18.1.js"></script>
	<script type="text/javascript" src="../js/daterangepicker-3.14.1.js"></script>
<title>Cadastro de Autorização temporária de Visitante</title>
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
</head>
<body>
<div class="row">
<div class="col-lg-8 table-responsive">
<?php
if($_REQUEST["formdirect"] == "update"){ // Edição
	$id = $_REQUEST["id"];
	$periodoini = "";
	$periodofim = "";
	$nomeautoriza = "";
	$empresa = "";
	$nomevisitante = "";
	$rg = "";
	$login = "";
	$terceiro = "";
	$sql = "SELECT * FROM autorizavis WHERE id_aut=$id ORDER BY periodoini DESC";
			$sqlexe = $conn->query($sql);
			if($sqlexe->num_rows > 0){
				while($linha = $sqlexe->fetch_array(MYSQLI_ASSOC)){

					$periodoini = $linha['periodoini'];
					$periodofim = $linha['periodofim'];
					$nomeautoriza = $linha['nomeautoriza'];
					$empresa = $linha['empresa'];
					$nomevisitante = $linha['nomevisitante'];
					$rg = $linha['rg'];
					$login = $linha['login'];
					$terceiro = $linha['terceiro'];
	?>
	<table class="table table-hover">
    <tr><td colspan="4" align="center"><h3><b>Edição de Autorização temporária de Visitante</b></h3></td></tr>
        <form action="salvarautoriza.php" name="cadastroautoriza" id="cadastroautoriza" onsubmit="return validateForm()" method="POST">
		<input type="hidden" name="id" id="id" value="<?php echo $id; ?>" />
		<tr><td><label for="dataregistro">Selecione a data:</label></td>
                <td colspan="2">
                <div class="input-group" id="daterangepicker">
                    <input type="text" size="25" class="form-control" id="dataregistro" name="dataregistro" autocomplete="off" value="<?php echo $periodoini; ?>" required />
                </div>
                <!-- jQuery Script -->
                <script type="text/javascript">
                    // Calendário
					$(function() {
						$('input[name="dataregistro"]').daterangepicker({
							singleDatePicker: true,
							showDropdowns: true,
							startDate: moment(),
							locale: {
								format: 'DD/MM/YYYY',
								// separator: ' - ',
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
				
            </td></tr>
		<tr><td><label for="nomeautoriza">Nome do autorizador: </label></td><td colspan="3"><input size="60" type="text" id="nomeautoriza" name="nomeautoriza" maxlength="60" style = "text-transform: uppercase" value="<?php echo $nomeautoriza; ?>" />
			</td></tr>
		<tr><td><label for="empresa">Conjunto </label></td><td colspan="3"><?php
        // montagem da combobox empresa
            echo "<select name='empresa' id='empresa'>";
            echo "<option value='".$empresa."'>".$empresa."</option>";
            // populando o combobox
            $sql3 = "SELECT DISTINCT empresa FROM empresas WHERE empresa BETWEEN '00' AND '9999' ORDER BY empresa + 0 ASC;"; // +0 para ordenar campo
        
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
		<!-- <tr><td><label for="selterceiro">Prestador de Serviços / Terceiro</label></td>
			<td><input class="form-check-input" type="radio" name="selterceiro" id="selterceiro" value="sim" style="text-align:center;"><label class="form-check-label">&nbsp;&nbsp;<b>SIM</b> </label></td><td><input class="form-check-input" type="radio" name="selterceiro" id="selterceiro" value="nao" checked><label class="form-check-label">&nbsp;&nbsp;Não </label></td><td></td></tr> -->
        <tr><td><label for="nomevisitante">Nome do visitante: </label></td>
			<td colspan="3"><input size="60" type="text" id="nomevisitante" name="nomevisitante" maxlength="60" style = "text-transform: uppercase" value="<?php echo $nomevisitante; ?>" />
			</td></tr>
        <tr><td><label for="rg">RG: </label></td>
			<td colspan="3"><input size="10" type="text" id="rg" name="rg" minlength="5" maxlength="12" value="<?php echo $rg; ?>" />
			</td></tr>

		<tr><td><label for="terceiro">Empresa prestador de serviços/terceiro</td>
			<td colspan="3"><input size="60" type="text" id="terceiro" name="terceiro" maxlength="80" style="text-transform:uppercase;" value="<?php echo $terceiro; ?>" /></td></tr>
		
        <tr align="center"><td colspan="2"><button class="btn btn-primary btn-lg" name="submit" id="submit" alt="Clique aqui ou aperte 'Enter'" style="cursor:pointer;">Atualizar</button></td>
		<td colspan="2"><a href="../index2.php" class="btn btn-warning btn-sm" name="voltamenu" alt="Clique aqui para voltar ao menu" style="cursor:pointer;"> Início </a></td></tr>
        </form>
</table>
<?php
				} // end while
			} // end if busca
} else { // Cadastro
?>
<table class="table table-hover">
    <tr><td colspan="4" align="center"><h3><b>Cadastro de Autorização temporária de Visitante</b></h3></td></tr>
        <form action="salvarautoriza.php" name="cadastroautoriza" id="cadastroautoriza" onsubmit="return validateForm()" method="POST">
		
		<tr><td><label for="dataregistro">Selecione a data:</label></td>
                <td colspan="2">
                <div class="input-group" id="daterangepicker">
                    <input type="text" size="25" class="form-control" id="dataregistro" name="dataregistro" autocomplete="off" required />
                </div>
                <!-- jQuery Script -->
                <script type="text/javascript">
                    // Calendário
					$(function() {
						$('input[name="dataregistro"]').daterangepicker({
							singleDatePicker: true,
							showDropdowns: true,
							startDate: moment(),
							locale: {
								format: 'DD/MM/YYYY',
								// separator: ' - ',
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
				
            </td></tr>
		<tr><td><label for="nomeautoriza">Nome do autorizador: </label></td><td colspan="3"><input size="60" type="text" id="nomeautoriza" name="nomeautoriza" maxlength="60" style = "text-transform: uppercase" />
			</td></tr>
		<tr><td><label for="empresa">Conjunto </label></td><td colspan="3"><?php
        // montagem da combobox empresa
            echo "<select name='empresa' id='empresa'>";
            echo "<option value=''>-- Selecione --</option>";
            // populando o combobox
            $sql3 = "SELECT DISTINCT empresa FROM empresas WHERE empresa BETWEEN '00' AND '9999' ORDER BY empresa + 0 ASC;"; // +0 para ordenar campo
        
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
		<!-- <tr><td><label for="selterceiro">Prestador de Serviços / Terceiro</label></td>
			<td><input class="form-check-input" type="radio" name="selterceiro" id="selterceiro" value="sim" style="text-align:center;"><label class="form-check-label">&nbsp;&nbsp;<b>SIM</b> </label></td><td><input class="form-check-input" type="radio" name="selterceiro" id="selterceiro" value="nao" checked><label class="form-check-label">&nbsp;&nbsp;Não </label></td><td></td></tr> -->
        <tr><td><label for="nomevisitante">Nome do visitante: </label></td>
			<td colspan="3"><input size="60" type="text" id="nomevisitante" name="nomevisitante" maxlength="60" style = "text-transform: uppercase" />
			</td></tr>
        <tr><td><label for="rg">RG: </label></td>
			<td colspan="3"><input size="10" type="text" id="rg" name="rg" minlength="5" maxlength="12" />
			</td></tr>

		<tr><td><label for="terceiro">Empresa prestador de serviços/terceiro</td>
			<td colspan="3"><input size="60" type="text" id="terceiro" name="terceiro" maxlength="80" style="text-transform:uppercase;" /></td></tr>
		
        <tr align="center"><td colspan="2"><button class="btn btn-primary btn-lg" name="submit" id="submit" alt="Clique aqui ou aperte 'Enter'" style="cursor:pointer;">Cadastrar</button></td>
		<td colspan="2"><a href="../index2.php" class="btn btn-warning btn-sm" name="voltamenu" alt="Clique aqui para voltar ao menu" style="cursor:pointer;"> Início </a></td></tr>
        </form>
</table>
<?php
} // end else request
?>
</div><!--end table responsive-->
</div><!--end row-->
<script type="text/javascript">
// Valida formulario
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
  let b = document.forms["cadastroautoriza"]["selterceiro"].value;
  let z = document.forms["cadastroautoriza"]["rg"].value;
  let c = document.forms["cadastroautoriza"]["terceiro"].value;
  if (b == "nao"){
	if (z == "") {
		alert("É necessário preencher com o RG do visitante!");
		return false;
	}
  } else if (b == "sim"){
	  if (c == "" || c == " "){
		alert("É necessário preencher com o nome da empresa do prestador de serviços ou terceiro!");
		return false;
	  }
  }
}

// Habilita campos por seleção
// function selecionaTerceiro(){
// 	var result = document.querySelector('input[id="selterceiro"]:checked').value;
// 	if(result=="sim"){
// 		document.getElementById("terceiro").style.display = 'block';
// 		document.getElementById("rg").style.display = 'none';
// 		document.getElementById("nomevisitante").style.display = 'none';
// 	} else {
// 		document.getElementById("terceiro").style.display = 'none';
// 		document.getElementById("rg").style.display = 'block';
// 		document.getElementById("nomevisitante").style.display = 'block';
// 	}
// }
</script>
</body>
</html>