<?php
include '../include/function.php';
include '../include/connect.php';
sessao();

$cnpj = '';
$ie = '';
$contato = '';
$telefone = '';
$email = '';
$obs = '';
$conjunto = '';
$andar = '';
$bloco = '';
$controlvaga = '';
$bloqestac = '';
$vgcond = '';
$qtdcond = '';
$vgvis = '';
$qtdvis = '';
$ID = '';

if(isset($_GET["ID"])){
	$ID = $_GET["ID"];

		$sqledicao = "SELECT * FROM empresas WHERE ID = '$ID';";
		$sqledicaoexe = $conn->query($sqledicao);

		//echo $empresa."<br>";
		//echo $sqledicao."<br>";

		while($row = $sqledicaoexe->fetch_array(MYSQLI_ASSOC)){
			$empresa = $row["Empresa"];
			$cnpj = $row["CNPJ"];
			$ie = $row["IE"];
			$contato = $row["contato"];
			$telefone = $row["Telefone"];
			$email = $row["email"];
			$obs =  $row["obs"];
			$conjunto = $row["Conjunto"];
			$andar = $row["Andar"];
			$bloco = $row["Bloco"];
			$controlvaga = $row["ControlVaga"];
			$bloqestac = $row["BloqEstac"];
			$vgcond = $row["VagaCond"];
			$qtdcond = $row["QTDCond"];
			$vgvis = $row["VagaVis"];
			$qtdvis = $row["QTDVis"];
			$ID = $row["ID"];
		} //end while
}

if(isset($_GET["formdirect"])){
	$formdirect = $_GET["formdirect"];
} else {
	$formdirect = $_POST["formdirect"];
}
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
	<meta http-equiv="content-type" content="text/html; charset=UTF-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" href="../css/bootstrap.css">
<script src="../js/jquery-1.11.3.min.js"></script>
<script src="../js/bootstrap.js"></script>

<title>Editar Empresas</title>
</head>
<body>
<div class="container">
<div class="row">
<div class="table-responsive">
<table class="table table-hover table-md">
	<thead class="thead-dark"><tr>
	<form action="updateempresa.php" method="post">
	<?php
	if($formdirect == 'update'){
		echo "<th colspan=\"8\"><h2>Editar Empresa/Conjunto</h2></th>";
		echo "<input type=\"hidden\" name=\"ID\" id=\"ID\" value='$ID'>";
		echo "<input type=\"hidden\" name=\"formdirect\" id=\"formdirect\" value=\"update\">";
	} elseif($formdirect == 'insert') {
		echo "<th colspan=\"8\"><h2>Insere Empresa/Conjunto</h2></th>";
		echo "<input type=\"hidden\" name=\"formdirect\" id=\"formdirect\" value=\"insert\">";
	} elseif($formdirect == 'apaga') {
		echo "<th colspan=\"8\"><h2>Exclusão Empresa/Conjunto</h2></th>";
		echo "<input type=\"hidden\" name=\"formdirect\" id=\"formdirect\" value=\"delete\">";
	}
	?>
    </tr></thead>
		
		<tr><td colspan="2">Conjunto/Empresa: <input type="text" name="empresaedit" id="empresaedit" size="60" value="<?php echo $empresa;?>"></td></tr>
		<tr><td>CNPJ: <input type="text" name="cnpj" id="cnpj" size="30" value="<?php echo $cnpj;?>"></td>
		<td>Ramo de atividade: <select name="ramoatividade" id="ramoatividade">
		<?php
		if(isset($ie)){
			$sqlramoat = "SELECT valor,opcao from ramoatividade where valor='$ie'";
			$sqlramoatexe = $conn->query($sqlramoat);
			while($rowramoat = $sqlramoatexe->fetch_array()){
				echo "<option value='$rowramoat[valor]'>$rowramoat[opcao]</option>";
			}
		}
		$sqlramo = "SELECT valor,opcao from ramoatividade";
		$sqlramoexe = $conn->query($sqlramo);
		while($rowramo = $sqlramoexe->fetch_array()){
			echo "<option value='$rowramo[valor]'>$rowramo[opcao]</option>";
		}//fim while
		?>
		</select>
		</td></tr>
		<tr><td>Contato (Nome): <input type="text" name="contato" id="contato" value="<?php echo $contato;?>"></td><td>Telefone: <input type="text" name="telefone" id="telefone" value="<?php echo $telefone;?>"></td></tr>
		<tr><td colspan="2">E-mail: <input type="text" name="email" id="email" size="50" value="<?php echo $email;?>"></td></tr>
		<tr><td colspan="2" class="align-middle">OBS: <textarea rows="4" cols="60" name="obs" id="obs"><?php echo $obs;?></textarea></td></tr>
		<tr><td>Conjunto (Número): <input type="text" name="conjunto" id="conjunto" size="10" value="<?php echo $conjunto;?>"></td><td>Andar: <input type="text" name="andar" id="andar" size="10" value="<?php echo $andar;?>"></td></tr>
		<tr><td colspan="2">Atualiza no site (churchil.com.br): <?php
				if($bloco == 'naoSite'){
					echo " <b>NÃO</b> <input type=\"radio\" name=\"atualizasite\" id=\"atualizasite\" value=\"naoSite\" checked>  |  SIM <input type=\"radio\" name=\"atualizasite\" id=\"atualizasite\" value=\"\"></td>";
				} else {
					echo " <b>NÃO</b> <input type=\"radio\" name=\"atualizasite\" id=\"atualizasite\" value=\"naoSite\">  |  SIM <input type=\"radio\" name=\"atualizasite\" id=\"atualizasite\" value=\"\" checked></td>";
				}
				?></tr>
		<tr><td>Diferencia Vagas: <?php
				if($controlvaga == 'SIM') {
					echo "<input type=\"checkbox\" name=\"controlvaga\" id=\"controlvaga\" value=\"1\" checked></td>";
				} elseif($controlvaga == 'NÃO') {
					echo "<input type=\"checkbox\" name=\"controlvaga\" id=\"controlvaga\" value=\"1\" ></td>";
				} else {
					echo "<input type=\"checkbox\" name=\"controlvaga\" id=\"controlvaga\" value=\"1\" ></td>";
				}?>
		<td>Bloqueio Estacionamento: <?php 
				if($bloqestac == 'SIM'){
					echo "<input type=\"checkbox\" name=\"bloqestac\" id=\"bloqestac\" value=\"1\" checked></td></tr>";
				} elseif($bloqestac == 'NÃO') {
					echo "<input type=\"checkbox\" name=\"bloqestac\" id=\"bloqestac\" value=\"1\"></td></tr>";
				} else {
					echo "<input type=\"checkbox\" name=\"bloqestac\" id=\"bloqestac\" value=\"1\"></td></tr>";
				}
		if($formdirect == 'update'){
			echo "<tr><td colspan='2'>Vaga Condomino: <input type='text' name='vgcond' id='vgcond' size='5' value='".$vgcond."'> Quantidade: <input type='text' name='qtdcond' id='qtdcond' size='5' value='".$qtdcond."'> Vaga Visitante: <input type='text' name='vgvis' id='vgvis' size='5' value='".$vgvis."'> Quantidade: <input type='text' name='qtdvis' id='qtdvis' size='5' value='".$qtdvis."'></td></tr>";
		} elseif($formdirect == 'insert'){
			echo "<tr><td colspan='2'>Vaga Condomino: <input type='text' name='vgcond' id='vgcond' size='5' value='".$vgcond."'> Quantidade: <input type='text' name='qtdcond' id='qtdcond' size='5' value='".$qtdcond."'> Vaga Visitante: <input type='text' name='vgvis' id='vgvis' size='5' value='".$vgvis."'> Quantidade: <input type='text' name='qtdvis' id='qtdvis' size='5' value='0'></td></tr>";
		}
		?>
		<tr><td style="text-align:center;">
		<?php
		if($formdirect == 'delete'){
			?>
				<input class="btn btn-success btn-lg" type="submit" name="enviar" id="enviar" value="! EXCLUIR !" />
			<?php
		} else {
			?>
				<input class="btn btn-success btn-lg" type="submit" name="enviar" id="enviar" value=" Enviar " />
			<?php
		} //end if?>
		</td>
		<td><a href="index.php" style="text-align:right;" class="btn btn-warning btn-lg" type="submit" name="cancel" id="cancel"> Cancelar </a></td></tr>
	</form>
</table>
</div> <!-- fim div table -->
</div> <!-- fim row2 -->
</div> <!-- fim container -->
</body>
<?php
//fim do arquivo
?>